<?php

namespace App\Services;

use App\Models\CourseUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StudentService
{
    public function getStudentList($request)
    {
        $query = User::role('STUDENT')->orderBy('name', 'ASC');
        if ($searchKey = $request->searchKey) {
            $query->where('name', 'like', '%' . $searchKey . '%');
        }

        return $query->paginate(15);
    }

    public function getCourseStudents($courseId)
    {
        $courseStudents = CourseUser::with('user')->select('course_user.*')
            ->join('users', 'course_user.user_id', 'users.id')
            ->where('course_user.course_id', $courseId)
            ->whereHas('user.roles', function ($query) {    //Model CourseUser call user() method
                $query->where('name', 'STUDENT');
            })->orderBy('name', 'asc')
            ->paginate(15);

        return $courseStudents;
    }

    public function updateStudent($request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $request->validated();
        $user->update($request->all());
        Auth::setUser($user);
    }

    public function updateStudentInfo($user, $request)
    {
        $request->validated();
        $user->update($request->all());
    }

    public function saveRegisterCourse($request)
    {
        $request->validate([
            'course_id' => 'required',
            'user_id' => 'required',
        ]);
        CourseUser::updateOrCreate(
            [
                'course_id' => $request->course_id,
                'user_id' => $request->user_id,
            ],
            []
        );
    }
}
