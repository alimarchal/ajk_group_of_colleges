<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuardianRequest extends FormRequest
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
            'father_name' => 'required|string|max:255',
            'father_phone' => 'required|string|max:20',
            'father_occupation' => 'nullable|string|max:255',
            'father_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size if needed

            'mother_name' => 'required|string|max:255',
            'mother_phone' => 'required|string|max:20',
            'mother_occupation' => 'nullable|string|max:255',
            'mother_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size if needed

            'guardian_is' => 'required|string|in:father,mother,other',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_relation' => 'nullable|string|max:255',
            'guardian_phone' => 'nullable|string|max:20',
            'guardian_occupation' => 'nullable|string|max:255',
            'guardian_email' => 'nullable|email|max:255',
            'guardian_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size if needed
            'guardian_address' => 'nullable|string|max:500',
        ];
    }
}
