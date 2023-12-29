<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Requests\UpdateTeacherInfoRequest;
use App\Services\CourseService;
use App\Services\StudentService;
use App\Services\TeacherService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    protected $courseService;
    protected $studentService;
    protected $teacherService;
    protected $userService;

    public function __construct(CourseService $courseService, StudentService $studentService, TeacherService $teacherService, UserService $userService)
    {
        $this->courseService = $courseService;
        $this->studentService = $studentService;
        $this->teacherService = $teacherService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $teachers = $this->teacherService->getTeacherList($request);

        return view('users.teacher.list', compact('teachers'), ['searchKey' => $request->searchKey, 'account' => Auth::user()]);
    }

    public function show($userId)
    {
        $user = $this->userService->getUser($userId);

        return view('users.teacher.info', compact('user'), ['account' => Auth::user()]);
    }

    public function editTeacher($userId)
    {
        $user = $this->userService->getUser($userId);

        return view('users.teacher.update-info', compact('user'), ['account' => Auth::user()]);
    }

    public function updateTeacherCustom(UpdateTeacherRequest $request)
    {
        try {
            $this->teacherService->updateTeacher($request);

            return back()->withSuccess('You have updated the account successfully');
        } catch (\Exception) {
            return back()->withInput($request->input())
                ->with('error', 'You have encountered an error while updating the account.');
        }
    }

    public function updateTeacherInfoCustom($userId, UpdateTeacherInfoRequest $request)
    {
        try {
            $user = $this->userService->getUser($userId);
            $this->teacherService->updateTeacherInfo($user, $request);

            return back()->withSuccess('You have updated the account successfully');
        } catch (\Exception) {
            return back()->withInput($request->input())
                ->with('error', 'You have encountered an error while updating the account.');
        }
    }

    public function createCourseAttendance($courseId)
    {
        $course = $this->courseService->getCourse($courseId);   //only use to create url POST
        $courseStudents = $this->studentService->getCourseStudents($courseId);

        if ($courseStudents->isEmpty()) {
            return back()->with('error', 'You can not attendance a empty course');
        }
        return view('users.teacher.attendance', compact('course', 'courseStudents'), ['account' => Auth::user()]);
    }

    public function storeAttendance(Request $request): RedirectResponse
    {
        try {
            $this->teacherService->saveAttendance($request);

            return back()->withSuccess('You have attendance successfully.');
        } catch (\Exception) {
            return back()->with('error', 'Attendance failed. Please try again.');
        }
    }

    public function endCourse(Request $request): RedirectResponse
    {
        try {
            $this->teacherService->calculateAttendanceRate($request);

            return back()->with('endCourseSuccess', 'You have ended the course successfully.');
        } catch (\Exception) {
            return back()->with('endCourseError', 'End the course failed. Please try again.');
        }
    }
}
