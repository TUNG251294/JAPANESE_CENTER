<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateAdminInfoRequest;
use App\Services\AdminService;
use App\Services\CourseService;
use App\Services\StudentService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    protected $adminService;
    protected $courseService;
    protected $studentService;
    protected $userService;

    public function __construct(AdminService $adminService, CourseService $courseService, StudentService $studentService, UserService $userService)
    {
        $this->adminService = $adminService;
        $this->courseService = $courseService;
        $this->studentService = $studentService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $admins = $this->adminService->getAdminList($request);

        return view('users.admin.list', compact('admins'), ['searchKey' => $request->searchKey, 'account' => Auth::user()]);
    }

    public function show($userId)
    {
        $user = $this->userService->getUser($userId);

        return view('users.admin.info', compact('user'), ['account' => Auth::user()]);
    }

    public function editAdmin($userId)
    {
        $user = $this->userService->getUser($userId);

        return view('users.admin.update-info', compact('user'), ['account' => Auth::user()]);
    }

    public function updateAdminCustom(UpdateAdminRequest $request)
    {
        try {
            $this->adminService->updateAdmin($request);

            return back()->withSuccess('You have updated the account successfully');
        } catch (\Exception) {
            return back()->withInput($request->input())
                ->with('error', 'You have encountered an error while updating the account.');
        }
    }

    public function createReceiptFee($courseId)
    {
        $course = $this->courseService->getCourse($courseId);        //only used to create POST url
        $courseStudents = $this->studentService->getCourseStudents($courseId);

        return view('users.admin.receipt-fee', compact('course', 'courseStudents'), ['account' => Auth::user()]);
    }

    public function storeReceiptFee(Request $request): RedirectResponse
    {
        try {
            $this->adminService->saveReceiptFee($request);

            return back()->withSuccess('You have updated the fee receipt successfully');
        } catch (\Exception) {
            return back()->with('error', 'Failed to update the fee receipt. Please try again.');
        }
    }

    public function updateAdminInfoCustom($userId, UpdateAdminInfoRequest $request)
    {
        try {
            $user = $this->userService->getUser($userId);
            $this->adminService->updateAdminInfo($user, $request);

            return back()->withSuccess('You have updated the account successfully');
        } catch (\Exception) {
            return back()->withInput($request->input())
                ->with('error', 'You have encountered an error while updating the account.');
        }
    }
}
