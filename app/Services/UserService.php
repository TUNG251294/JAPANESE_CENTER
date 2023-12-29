<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function getUser($id)
    {
        return User::findOrFail($id);
    }

    public function getAccountRole()
    {
        return Auth::user()->roles[0]->name;
    }

    public function deleteUser($user)
    {
        $user->delete();
    }
}
