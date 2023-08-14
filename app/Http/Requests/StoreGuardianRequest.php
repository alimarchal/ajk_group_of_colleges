<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGuardianRequest extends FormRequest
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
            'father_name' => 'nullable|string|max:255',
            'father_phone' => 'nullable|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'father_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mother_name' => 'nullable|string|max:255',
            'mother_phone' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'mother_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'guardian_is' => 'nullable|in:father,mother,other',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_relation' => 'nullable|string|max:255',
            'guardian_phone' => 'nullable|string|max:255',
            'guardian_occupation' => 'nullable|string|max:255',
            'guardian_email' => 'nullable|email|max:255',
            'guardian_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'guardian_address' => 'nullable|string',
        ];
    }
}
