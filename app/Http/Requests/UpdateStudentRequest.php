<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        dd($this->request->all());
        return [
            'admission_no' => 'required|unique:students,admission_no,' . $student->id,
            'roll_no' => 'required|unique:students,roll_no,' . $student->id,
            'email' => 'required|email|unique:students,email,' . $student->id,
            'institute_class_id' => 'nullable|exists:institute_classes,id',
            'section_id' => 'nullable|exists:sections,id',
            'category_id' => 'nullable|exists:categories,id',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required|in:male,female,other',
            'dob' => 'required|date',
            'religion' => 'nullable',
            'cast' => 'nullable',
            'mobile_no' => 'required',
            'admission_date' => 'nullable|date',
            'blood_group_id' => 'nullable|exists:blood_groups,id',
            'house' => 'nullable',
            'height' => 'nullable',
            'weight' => 'nullable',
            'measure_date' => 'nullable|date',
            'fees_discount' => 'nullable|integer',
            'medical_history' => 'nullable',
        ];
    }
}
