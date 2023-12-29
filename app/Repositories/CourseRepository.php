<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;

class CourseRepository
{

    protected $course;
    protected $courseUser;
    protected $user;

    public function __construct(Course $course, CourseUser $courseUser, User $user)
    {
        $this->course = $course;
        $this->courseUser = $courseUser;
        $this->user = $user;
    }

    public function create($attributes)
    {
        return $this->course->create($attributes);
    }

    public function update($attributes)
    {
        return $this->course->update($attributes);
    }

    public function saveCourseTeacher($courseId, $teacherId)
    {
        $this->courseUser->create([
            'course_id' => $courseId,
            'user_id' => $teacherId,
        ]);
    }

    public function getCourseTeacher($courseId)
    {
        $teacher = $this->user::role('TEACHER')
            ->select('users.id', 'course_user.id as courseUserId')
            ->join('course_user', 'course_user.user_id', 'users.id')
            ->where('course_user.course_id', $courseId)
            ->first();

        return $teacher;
    }
}
