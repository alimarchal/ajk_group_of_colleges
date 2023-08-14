<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
        return [
            'admission_no' => 'required|unique:students',
            'roll_no' => 'required|unique:students',
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
            'email' => 'required|email|unique:students',
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

    /**
     * Get custom validation messages.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'admission_no.required' => 'Admission number is required.',
            'admission_no.unique' => 'Admission number must be unique.',
            'roll_no.required' => 'Roll number is required.',
            'roll_no.unique' => 'Roll number must be unique.',
            'institute_class_id.exists' => 'Selected institute class is invalid.',
            'section_id.exists' => 'Selected section is invalid.',
            'category_id.exists' => 'Selected category is invalid.',
            'firstname.required' => 'First name is required.',
            'lastname.required' => 'Last name is required.',
            'gender.required' => 'Gender is required.',
            'gender.in' => 'Invalid gender selected.',
            'dob.required' => 'Date of birth is required.',
            'dob.date' => 'Invalid date of birth.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'Email is already registered.',
            'admission_date.date' => 'Invalid admission date.',
            'blood_group_id.exists' => 'Selected blood group is invalid.',
            'measure_date.date' => 'Invalid measure date.',
            'fees_discount.integer' => 'Fees discount must be an integer.',
        ];
    }
}
