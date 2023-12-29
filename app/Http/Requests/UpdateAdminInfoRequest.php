<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->userId;    // or $userId = $this->request->get('userId');
        return [
            'name' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'phone_number' => [
                'required',
                'max:11',
                Rule::unique('users')->ignore($userId),
            ],
            'hometown',
            'address',
            'workplace',
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
        ];
    }
}
