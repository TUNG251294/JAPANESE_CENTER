<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
use App\Repositories\CourseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CourseService
{
    protected $courseRepo;

    public function __construct(CourseRepository $courseRepo)
    {
        $this->courseRepo = $courseRepo;
    }

    public function getCourse($id)
    {
        return Course::findOrFail($id);
    }

    public function getCourseList($request)
    {
        $query = Course::with('users')->orderBy('opening_date', 'desc');
        if ($searchKey = $request->searchKey) {
            $query->where('name', 'like', '%' . $searchKey . '%');
        }

        return $query->paginate(15);
    }

    public function getPersonalCourses()
    {
        $courses = Course::select('courses.*')
            ->join('course_user', 'course_user.course_id', 'courses.id')
            ->where('course_user.user_id', Auth::user()->id)
            ->orderBy('opening_date', 'desc')->paginate(15);
        // SELECT courses.* FROM courses JOIN course_user ON courses.id = course_user.course_id AND course_user.user_id = $id;
        return $courses;
    }

    public function saveCourse($request)
    {
        $request->validated();
        $request['schedule_dates'] = implode(',', $request->schedule_dates ?? []);  //convert array to string
        $success = true;
        DB::beginTransaction();
        try {
            $course = $this->courseRepo->create($request->all());
            $this->courseRepo->saveCourseTeacher($course->id, $request->teacher_id);
            DB::commit();
        } catch (\Exception) {
            DB::rollBack();
            $success = false;
        }

        return $success;
    }

    public function updateCourse($request)
    {
        $request->validated();
        $request['schedule_dates'] = implode(',', $request->schedule_dates ?? []);
        $course = Course::findOrFail($request->id);
        $curTeacher = $this->courseRepo->getCourseTeacher($course->id);
        $success = true;
        DB::beginTransaction();
        try {
            $this->courseRepo->update($request->all());
            if ($curTeacher->id != $request->teacher_id) {
                CourseUser::where('id', $curTeacher->courseUserId)->update(['user_id' => $request->teacher_id]);
            }
            DB::commit();
        } catch (\Exception) {
            DB::rollback();
            $success = false;
        }

        return $success;
    }

    public function deleteCourse($request)
    {
        $course = Course::findOrFail($request->id);
        $course->delete();
    }
}
