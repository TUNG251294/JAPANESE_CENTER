<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Services\CourseService;
use App\Services\StudentService;
use App\Services\TeacherService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    protected $courseService;
    protected $studentService;
    protected $teacherService;

    public function __construct(CourseService $courseService, StudentService $studentService, TeacherService $teacherService)
    {
        $this->courseService = $courseService;
        $this->studentService = $studentService;
        $this->teacherService = $teacherService;
    }

    public function index(Request $request)
    {
        $courses = $this->courseService->getCourseList($request);

        return view('courses.list', compact('courses'), ['searchKey' => $request->searchKey, 'account' => Auth::user()]);
    }

    public function create()
    {
        $teachers = $this->teacherService->getAllTeacher();

        return view('courses.create', compact('teachers'), ['account' => Auth::user()]);
    }

    public function store(StoreCourseRequest $request): RedirectResponse
    {
        $success = $this->courseService->saveCourse($request);

        if ($success) {
            return back()->withSuccess('You have created the course successfully.');
        }
        return back()->withInput($request->input())
            ->with('error', 'Create failed. Please try again.');
    }

    public function edit($courseId)
    {
        $course = $this->courseService->getCourse($courseId);
        $teachers = $this->teacherService->getAllTeacher();
        $teacherId = $this->teacherService->getCourseTeacherId($courseId);

        return view('courses.update', compact('course', 'teachers', 'teacherId'), ['account' => Auth::user()]);
    }

    public function update(UpdateCourseRequest $request): RedirectResponse
    {
        $success = $this->courseService->updateCourse($request);

        if ($success) {
            return back()->withSuccess('You have updated the course successfully.');
        }
        return back()->withInput($request->input())
            ->with('error', 'Update failed. Please try again.');
    }

    public function showPersonalCourses()
    {
        $courses = $this->courseService->getPersonalCourses();

        return view('courses.personal-list', compact('courses'), ['account' => Auth::user()]);
    }

    public function showCourseInfo(string $courseId)
    {
        $course = $this->courseService->getCourse($courseId);
        $teacherName = $this->teacherService->getCourseTeacherName($courseId);

        return view('courses.info', compact('course', 'teacherName'), ['account' => Auth::user()]);
    }

    public function showManageSession(string $courseId)
    {
        $attendances = $this->teacherService->getAttendanceList($courseId);

        return view('courses.manage-session', compact('attendances'), ['account' => Auth::user()]);
    }

    public function destroy(Request $request)
    {
        try {
            $this->courseService->deleteCourse($request);

            return redirect('/courses/list')->withSuccess('You deleted a course successfully.');
        } catch (\Exception) {
            return back()->with('error', 'Delete failed. Please try again.');
        }
    }
}
