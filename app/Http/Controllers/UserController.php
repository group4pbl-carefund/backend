<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Menampilkan daftar semua pengguna.
     *
     * Mengambil semua record pengguna dari database.
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return $this->successResponse(UserResource::collection($users));
    }

    /**
     * Menampilkan detail pengguna tertentu.
     *
     * Mengambil detail spesifik dari seorang pengguna berdasarkan ID.
     */
    public function show(User $user)
    {
        return $this->successResponse(new UserResource($user));
    }

    /**
     * Memperbarui data pengguna.
     *
     * Mengupdate informasi profil pengguna yang sudah ada.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $updatedUser = $this->userService->updateUser($user, $request->validated());

        return $this->updatedResponse(new UserResource($updatedUser), 'User updated successfully');
    }

    /**
     * Menghapus pengguna.
     *
     * Menghapus record pengguna dari database secara permanen.
     */
    public function destroy(User $user)
    {
        $this->userService->deleteUser($user);

        return $this->deletedResponse('User deleted successfully');
    }
}
