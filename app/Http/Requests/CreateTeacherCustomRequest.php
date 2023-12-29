<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTeacherCustomRequest extends FormRequest
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
        return [
            'name' => 'required',
            'password' => 'required|min:6|confirmed',
            'gender' => 'required',
            'birthday' => 'required',
            'phone_number' => 'required|max:11|unique:users',
            'email' => 'required|email|unique:users',
            'hometown',
            'address',
            'workplace',
            'level_id',
        ];
    }
    public function messages()
    {
        return [
            // 'required' => ':attribute không được bỏ trống',
            // 'unique' => ':attribute đã được sử dụng',
            // 'email' => ':attribute phải đúng định dạng',
            // 'confirmed' => ':attribute chưa chính xác',
            // 'min:6' => ':attribute phải có ít nhất 6 ký tự',
            'max' => ':attribute is too long',
            // 'numeric' => ':attribute phải là số',
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
        ];
    }
}
