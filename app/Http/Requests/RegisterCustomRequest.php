<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomRequest extends FormRequest
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
            'level_id' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'max' => ':attribute is too long',
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
