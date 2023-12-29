<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->user()->id ?? null;
        return [
            'name' => 'required',
            'password' => 'required|min:6|confirmed',
            'gender' => 'required',
            'birthday' => 'required',
            'phone_number' => [
                'required',
                'max:11',
                Rule::unique('users')->ignore($userId),
            ],
            // 'email' => 'required|email|unique:users',
            'hometown',
            'address',
            'workplace',
            'level_id' => 'required',
            'old_password' => [
                'required', function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('Old Password didn\'t match');
                    }
                },
            ],
        ];
    }
    public function messages()
    {
        return [
            'max' => 'The :attribute is too long',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Fullname',
            'email' => 'Email',
            'password' => 'Password',
            'gender' => 'Gender',
            'birthday' => 'Date of birth',
            'phone_number' => 'Phone number',
            'hometown' => 'Hometown',
            'address' => 'Address',
            'workplace' => 'Work place',
            'level_id' => 'Level',
            'old_password'=> 'Old password',
        ];
    }
}
