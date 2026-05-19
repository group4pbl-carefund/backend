<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOTPMail;

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
            'password' => 'required|string|min:8|confirmed',
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

        return $this->successResponse([
            'access_token' => $token, 
            'token_type' => 'Bearer', 
            'user' => $user,
            'otp_bypass_debug' => $otp
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
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

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
        $user->is_verified = true;
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

        return $this->successResponse([
            'otp_bypass_debug' => $otp
        ], 'Kode OTP baru telah dikirim!');
    }
}
