<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function editAccount()
    {
        $role = $this->userService->getAccountRole();
        if ($role === "ADMIN") {
            return view('users.admin.update', ['account' => Auth::user()]);
        }
        if ($role === "TEACHER") {
            return view('users.teacher.update', ['account' => Auth::user()]);
        }
        return view('users.student.update', ['account' => Auth::user()]);
    }

    public function destroy(Request $request)
    {
        try {
            $user = $this->userService->getUser($request->id);
            $this->userService->deleteUser($user);

            return back()->withSuccess('You deleted an account successfully.');
        } catch (\Exception) {
            return back()->with('error', 'Delete failed. Please try again.');
        }
    }
}
