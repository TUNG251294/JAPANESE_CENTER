<?php

namespace App\Services;

use App\Models\CourseUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminService
{
    public function getAdminList($request)
    {
        $query = User::role('ADMIN')->orderBy('name', 'asc');
        if ($searchKey = $request->searchKey) {
            $query->where('name', 'like', '%' . $searchKey . '%');
        }

        return $query->paginate(15);
    }

    public function updateAdmin($request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $request->validated();
        $user->update($request->all());
        Auth::setUser($user);
    }

    public function updateAdminInfo($user, $request)
    {
        $request->validated();
        $user->update($request->all());
    }

    public function saveReceiptFee($request)
    {
        $request->validate([
            'courseStudent' => 'required',
            'courseStudent.*' => 'required',
        ]);
        for ($i = 0; $i < count($request->courseStudent); $i++) {
            CourseUser::updateOrCreate(
                [
                    'user_id' => $request->courseStudent[$i]['user_id'],
                    'course_id' => $request->courseStudent[$i]['course_id'],
                ],
                [
                    'is_fee' => $request->courseStudent[$i]['is_fee'],
                ]
            );
        };
        // DB::table('course_user')->insert($request->courseStudent);  //This query used to insert new records without overriding old data.
    }
}
