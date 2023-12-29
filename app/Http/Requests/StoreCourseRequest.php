<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'name' => 'required|unique:courses',
            'level_id' => 'required',
            'fee' => 'required',
            'opening_date' => 'required',
            'ending_date' => 'required',
            'estimated_students',
            'status' => 'required',
            'schedule_dates',
            'total_session' => 'required',
            'teacher_id' => 'required',
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
            'fee' => 'Fee',
            'opening_date' => 'Opening Date',
            'ending_date' => 'Ending Date',
            'estimated_students' => "Estimated Students",
            'status' => 'Status',
            'schedule_dates' => 'Schedule Dates',
            'total_session' => 'Total Sessions',
            'teacher_id' => 'Teacher Id',
        ];
    }
}
