<?php

namespace App\Http\Services;

use App\Models\User;

class UserService
{
    public function getAllUsers()
    {
        return User::paginate(10);
    }

    public function updateUser(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function deleteUser(User $user)
    {
        return $user->delete();
    }
}
