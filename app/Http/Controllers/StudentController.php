<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudentRequest;
use App\Http\Requests\UpdateStudentInfoRequest;
use App\Services\CourseService;
use App\Services\StudentService;
use App\Services\TeacherService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
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
        $students = $this->studentService->getStudentList($request);

        return view('users.student.list', compact('students'), ['searchKey' => $request->searchKey, 'account' => Auth::user()]);
    }

    public function show($userId)
    {
        $user = $this->userService->getUser($userId);

        return view('users.student.info', compact('user'), ['account' => Auth::user()]);
    }

    public function editStudent($userId)
    {
        $user = $this->userService->getUser($userId);

        return view('users.student.update-info', compact('user'), ['account' => Auth::user()]);
    }

    public function updateStudentCustom(UpdateStudentRequest $request)
    {
        try {
            $this->studentService->updateStudent($request);

            return back()->withSuccess('You have updated the account successfully');
        } catch (\Exception) {
            return back()->withInput($request->input())
                ->with('error', 'You have encountered an error while updating the account.');
        }
    }

    public function registerCourse(string $courseId)
    {
        $course = $this->courseService->getCourse($courseId);
        $teacherName = $this->teacherService->getCourseTeacherName($courseId);

        return view('users.student.register', compact('course', 'teacherName'), ['account' => Auth::user()]);
    }

    public function registerCourseCustom(Request $request)
    {
        try {
            $this->studentService->saveRegisterCourse($request);

            return back()->withSuccess('Your course has been registered.');
        } catch (\Exception) {
            return back()->with('error', 'Register failed. Please try again.');
        }
    }

    public function updateStudentInfoCustom($userId, UpdateStudentInfoRequest $request)
    {
        try {
            $user = $this->userService->getUser($userId);
            $this->studentService->updateStudentInfo($user, $request);

            return back()->withSuccess('You have updated the account successfully');
        } catch (\Exception) {
            return back()->withInput($request->input())
                ->with('error', 'You have encountered an error while updating the account.');
        }
    }
}
