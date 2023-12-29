<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeacherService
{

    public function getAllTeacher()
    {
        $teachers = User::role('TEACHER')->orderBy('name')->get();

        return $teachers;
    }

    public function getTeacherList($request)
    {
        $query = User::role('TEACHER')->orderBy('name', 'asc');
        if ($searchKey = $request->searchKey) {
            $query->where('name', 'like', '%' . $searchKey . '%');
        }

        return $query->paginate(15);
    }

    public function getCourseTeacherId($courseId)
    {
        $teacherId = User::role('TEACHER')->select('users.id')->join('course_user', 'course_user.user_id', 'users.id')
            ->where('course_user.course_id', $courseId)
            ->pluck('id')
            ->first();

        return $teacherId;
    }

    public function getCourseTeacherName($courseId)
    {
        $teacherName = User::role('TEACHER')->select('users.name')
            ->join('course_user', 'course_user.user_id', 'users.id')
            ->where('course_user.course_id', $courseId)
            ->pluck('name')
            ->first();

        return $teacherName;
    }

    public function updateTeacher($request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $request->validated();
        $user->update($request->all());
        Auth::setUser($user);
    }

    public function updateTeacherInfo($user, $request)
    {
        $request->validated();
        $user->update($request->all());
    }

    public function getAttendanceList($courseId)
    {
        $attendances = Attendance::with(['courseUser.user', 'courseUser.course', 'courseUser.session'])->select('course_user_id', Attendance::raw('count(attendances.id) as present_count'))
            ->join('course_user', 'attendances.course_user_id', 'course_user.id')
            ->where('course_user.course_id', $courseId)
            ->groupBy('course_user_id')
            ->paginate(15);
        // SELECT course_user_id, COUNT(attendances.id) as present_count FROM attendances JOIN course_user ON attendances.course_user_id = course_user.id  WHERE course_user.course_id = $courseId GROUP BY course_user_id;
        return $attendances;
    }

    public function saveAttendance($request)
    {
        $request->validate([
            'courseUser' => 'required',
            'courseUser.*' => 'required',
        ]);
        for ($i = 0; $i < count($request->courseUser); $i++) {
            Attendance::updateOrCreate(
                [
                    'attendance_date' => $request->courseUser[$i]['attendance_date'],
                    'course_user_id' => $request->courseUser[$i]['course_user_id'],
                ],
                [
                    'is_present' => $request->courseUser[$i]['is_present'],
                ]
            );
        };
        // DB::table('attendances')->insert($request->courseUser); //This query used to insert new records without overriding old data.
    }

    public function calculateAttendanceRate($request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $courseStudents = CourseUser::select('course_user.*')->join('users', 'course_user.user_id', 'users.id')
            ->where('course_user.course_id', $request->id)
            ->whereHas('user.roles', function ($query) {
                $query->where('name', 'STUDENT');
            })->get();
        $course = Course::findOrFail($request->id);
        $totalSession = $course['total_session'];
        for ($i = 0; $i < count($courseStudents); $i++) {
            $attendance = Attendance::select('course_user_id', Attendance::raw('count(id) as present_count'))
                ->where('is_present', 1)
                ->where('course_user_id', $courseStudents[$i]['id'])
                ->groupBy('course_user_id')
                ->first();
            Session::updateOrCreate(
                [
                    'course_user_id' => $courseStudents[$i]['id'],
                ],
                [
                    'actual_session' => $attendance['present_count'],
                    'rate' => $attendance['present_count'] * 100 / $totalSession,
                ]
            );
        };
    }
}
