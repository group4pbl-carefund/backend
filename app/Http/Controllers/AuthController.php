<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->successResponse(['access_token' => $token, 'token_type' => 'Bearer', 'user' => $user], 'Registration successful', 201);
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
}
