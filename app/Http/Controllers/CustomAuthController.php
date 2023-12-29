<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminCustomRequest;
use App\Http\Requests\CreateTeacherCustomRequest;
use App\Http\Requests\RegisterCustomRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\CustomAuthService;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    protected $customAuthService;

    public function __construct(CustomAuthService $customAuthService)
    {
        $this->customAuthService = $customAuthService;
    }

    public function index()
    {
        // $role = Role::create(['name' => 'student']);
        // $permission = Permission::create(['name' => 'view-course-list']);
        // $role = Role::find(3);
        // $permission = Permission::find(4);
        // $role->givePermissionTo($permission);

        return view('form.auth.login');
    }

    public function customLogin(Request $request)
    {
        $credentials = $this->customAuthService->getCredentials($request);

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('course_list'));
        }
        return redirect("login")->withErrors('Login details are not valid');    //truyền vào biến errors của session
    }

    public function registration()
    {
        return view('form.auth.registration');
    }

    public function createAdmin()
    {
        return view('form.auth.create-admin', ['account' => Auth::user()]);
    }

    public function createTeacher()
    {
        return view('form.auth.create-teacher', ['account' => Auth::user()]);
    }

    public function createStudent()
    {
        return view('form.auth.create-student', ['account' => Auth::user()]);
    }

    public function customRegistration(RegisterCustomRequest $request)
    {
        $success = $this->customAuthService->saveRegistration($request);

        if ($success) {
            return back()->withSuccess('You have registered successfully. Login to sign in.');
        }
        return back()->withInput($request->input())
            ->with('error', 'Register failed. Please try again.');
    }

    public function createAdminCustom(CreateAdminCustomRequest $request)
    {
        $success = $this->customAuthService->saveAdmin($request);

        if ($success) {
            return back()->withSuccess('You have created the admin account successfully');
        }
        return back()->withInput($request->input())
            ->with('error', 'You have encountered an error while creating the account.');
    }

    public function createTeacherCustom(CreateTeacherCustomRequest $request)
    {
        $success = $this->customAuthService->saveTeacher($request);

        if ($success) {
            return back()->withSuccess('You have created the teacher account successfully');
        }
        return back()->withInput($request->input())
            ->with('error', 'You have encountered an error while creating the account.');
    }

    public function createStudentCustom(RegisterCustomRequest $request)
    {
        $success = $this->customAuthService->saveRegistration($request);

        if ($success) {
            return back()->withSuccess('You have created the student account successfully');
        }
        return back()->withInput($request->input())
            ->with('error', 'You have encountered an error while creating the account.');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();
        return Redirect('/login');
    }
}
