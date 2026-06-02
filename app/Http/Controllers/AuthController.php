<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\SendOTPMail;
use App\Mail\SendPasswordResetMail;

class AuthController extends Controller
{

    /**
     * Registrasi pengguna baru.
     *
     * Membuat akun pengguna baru dan mengembalikan token akses.
     */
    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|max:21|regex:/^[a-zA-Z0-9]+$/|confirmed',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'address' => 'nullable|string',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
        ]);

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'is_verified' => false,
            'otp_code' => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        try {
            Mail::to($user->email)->send(new SendOTPMail($otp, $user->full_name));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning("Failed to send OTP email: " . $e->getMessage());
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // Catat sesi pertama pengguna saat registrasi agar perangkat ini langsung dipercaya
        \App\Models\UserSession::create([
            'user_id' => $user->id,
            'token' => $token,
            'user_agent' => $request->userAgent(),
            'ip_address' => $request->ip(),
            'login_at' => now(),
            'expires_at' => now()->addDays(7),
        ]);

        return $this->successResponse([
            'access_token' => $token, 
            'token_type' => 'Bearer', 
            'user' => $user
        ], 'Registration successful', 201);
    }

    /**
     * Autentikasi pengguna (Login).
     *
     * Memverifikasi kredensial pengguna dan mengembalikan token akses.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|max:21|regex:/^[a-zA-Z0-9]+$/',
            'otp_code' => 'nullable|string|size:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        $ipAddress = $request->ip();
        $userAgent = $request->userAgent();

        // 1. Cek apakah ini perangkat baru yang tidak dikenal
        // Hanya lakukan cek jika user sudah punya session tersimpan sebelumnya
        $hasAnySession = \App\Models\UserSession::where('user_id', $user->id)->exists();
        $isKnownDevice = \App\Models\UserSession::where('user_id', $user->id)
            ->where('ip_address', $ipAddress)
            ->where('user_agent', $userAgent)
            ->exists();

        if ($hasAnySession && !$isKnownDevice) {
            // Jika user mengirimkan kode OTP untuk verifikasi perangkat ini
            if ($request->filled('otp_code')) {
                if ($user->otp_code !== $request->otp_code) {
                    return $this->errorResponse('Kode verifikasi OTP salah.', 400);
                }

                if (now()->greaterThan($user->otp_expires_at)) {
                    return $this->errorResponse('Kode verifikasi OTP telah kedaluwarsa.', 400);
                }

                // Bersihkan kode OTP setelah sukses diverifikasi
                $user->otp_code = null;
                $user->otp_expires_at = null;
                $user->save();

                // Catat log kesuksesan verifikasi ke SecurityMonitoring
                \App\Models\SecurityMonitoring::create([
                    'event_type' => 'new_device_authorized',
                    'severity' => 'info',
                    'user_id' => $user->id,
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                    'action' => 'authorize_device',
                    'description' => 'Pengguna sukses memverifikasi login perangkat baru lewat OTP.',
                    'details' => json_encode(['verified_at' => now()->toIso8601String()]),
                ]);
            } else {
                // Belum mengirimkan OTP, kirimkan email verifikasi & minta OTP di frontend
                $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $user->otp_code = $otp;
                $user->otp_expires_at = now()->addMinutes(10);
                $user->save();

                // Catat log mencurigakan ke SecurityMonitoring
                \App\Models\SecurityMonitoring::create([
                    'event_type' => 'suspicious_login',
                    'severity' => 'medium',
                    'user_id' => $user->id,
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                    'action' => 'require_otp',
                    'description' => 'Percobaan login dari perangkat/browser baru terdeteksi.',
                    'details' => json_encode(['requested_at' => now()->toIso8601String()]),
                ]);

                // Kirim email verifikasi perangkat baru
                try {
                    Mail::to($user->email)->send(new SendOTPMail($otp, $user->full_name));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning("Failed to send device verification email: " . $e->getMessage());
                }

                return response()->json([
                    'success' => false,
                    'requires_otp' => true,
                    'message' => 'Login dari perangkat baru terdeteksi. Silakan masukkan kode OTP yang dikirim ke email Anda.'
                ], 200);
            }
        }

        // 2. Berhasil login (bisa dari perangkat dikenal, login pertama sekali, atau setelah verifikasi OTP sukses)
        $token = $user->createToken('auth_token')->plainTextToken;

        // Catat sesi login ini agar dipercaya di kemudian hari
        \App\Models\UserSession::create([
            'user_id' => $user->id,
            'token' => $token,
            'user_agent' => $userAgent,
            'ip_address' => $ipAddress,
            'login_at' => now(),
            'expires_at' => now()->addDays(7),
        ]);

        return $this->successResponse(['access_token' => $token, 'token_type' => 'Bearer', 'user' => $user], 'Login successful');
    }

    /**
     * Keluar dari sesi (Logout).
     *
     * Mencabut dan menghapus token akses yang sedang aktif.
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->deletedResponse('Logged out successfully');
    }

    /**
     * Profil Pengguna Saat Ini.
     *
     * Mengembalikan data profil untuk pengguna yang sedang terautentikasi.
     */
    public function me(Request $request)
    {
        return $this->successResponse($request->user());
    }

    public function refresh()
    {
        // Sanctum doesn't have a built-in refresh, but we can revoke and re-issue
        // However, for simplicity in Sanctum, we usually just login again.
        return response()->json(['message' => 'Feature not implemented in Sanctum. Please login again if token expires.'], 501);
    }

    /**
     * Verifikasi kode OTP email.
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'otp' => 'required|string|size:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->errorResponse('User tidak ditemukan.', 404);
        }

        if ($user->otp_code !== $request->otp) {
            return $this->errorResponse('Kode OTP salah atau tidak valid.', 400);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            return $this->errorResponse('Kode OTP telah kedaluwarsa.', 400);
        }

        // OTP verified successfully
        $user->email_verified_at = now();
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        return $this->successResponse(['user' => $user], 'Email berhasil diverifikasi!');
    }

    /**
     * Kirim ulang kode OTP.
     */
    public function resendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->errorResponse('User tidak ditemukan.', 404);
        }

        $otp = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->otp_code = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        try {
            Mail::to($user->email)->send(new SendOTPMail($otp, $user->full_name));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::warning("Failed to resend OTP email: " . $e->getMessage());
        }

        return $this->successResponse([], 'Kode OTP baru telah dikirim!');
    }

    /**
     * Lupa Password (Forgot Password).
     */
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.exists' => 'Email tidak ditemukan di sistem kami.'
        ]);

        $user = User::where('email', $request->email)->first();
        $token = Str::random(64);

        // Simpan token ke password_reset_tokens
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => now()]
        );

        $frontendUrl = config('app.frontend_url', 'http://localhost:5173');
        $resetUrl = $frontendUrl . '/login?reset=true&email=' . urlencode($user->email) . '&token=' . $token;

        try {
            Mail::to($user->email)->send(new SendPasswordResetMail($resetUrl, $user->full_name));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error("Failed to send password reset email: " . $e->getMessage());
            return $this->errorResponse('Gagal mengirim email reset password. Silakan coba lagi nanti.', 500);
        }

        return $this->successResponse([], 'Link reset password telah dikirim ke email Anda.');
    }

    /**
     * Reset Password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $resetToken = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$resetToken) {
            return $this->errorResponse('Token reset password tidak valid.', 400);
        }

        // Cek kedaluwarsa token (60 menit)
        if (now()->subMinutes(60)->gt($resetToken->created_at)) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return $this->errorResponse('Token reset password telah kedaluwarsa. Silakan request link baru.', 400);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Hapus token yang sudah terpakai
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return $this->successResponse([], 'Password berhasil direset! Silakan login dengan password baru.');
    }
}
