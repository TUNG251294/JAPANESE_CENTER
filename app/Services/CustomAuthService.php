<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class CustomAuthService
{
    public function getCredentials($request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        return $credentials;
    }

    public function saveRegistration($request)
    {
        $request->validated();
        $success = true;
        DB::beginTransaction();
        try {
            $user = $this->create($request->all());
            $user->assignRole('STUDENT');
            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
            $success = false;
        }

        return $success;
    }

    public function saveAdmin($request)
    {
        $request->validated();
        $success = true;
        DB::beginTransaction();
        try {
            $user = $this->create($request->all());
            $user->assignRole('ADMIN');
            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
            $success = false;
        }

        return $success;
    }

    public function saveTeacher($request)
    {
        $request->validated();
        $success = true;
        DB::beginTransaction();
        try {
            $user = $this->create($request->all());
            $user->assignRole('TEACHER');
            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
            $success = false;
        }

        return $success;
    }

    public function create(array $data)
    {
        return User::create($data);
    }
}
