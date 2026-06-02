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
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar_url'] = '/storage/' . $path;
            unset($data['avatar']); // Remove uploaded file object from data array
        }

        $updatedUser = $this->userService->updateUser($user, $data);

        return $this->updatedResponse(new UserResource($updatedUser), 'User updated successfully');
    }

    /**
     * Update profil pengguna yang sedang login.
     */
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $data = $request->validate([
            'full_name' => 'sometimes|string|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'address' => 'nullable|string',
        ]);

        $updatedUser = $this->userService->updateUser($user, $data);
        return $this->updatedResponse(new UserResource($updatedUser), 'Profile updated');
    }

    /**
     * Upload avatar untuk pengguna yang sedang login.
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = $request->user();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar_url = '/storage/' . $path;
            $user->save();
        }

        return $this->updatedResponse(new UserResource($user), 'Avatar updated');
    }

    /**
     * Upload gambar untuk TinyMCE editor.
     */
    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ]);

        $path = $request->file('file')->store('editor', 'public');

        return response()->json([
            'location' => asset('/storage/' . $path),
        ]);
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
