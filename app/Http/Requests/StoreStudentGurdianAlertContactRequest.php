<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentGurdianAlertContactRequest extends FormRequest
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
            'home_number_emergency_contact' => 'nullable|string|max:255',
            'phone_network_id' => 'nullable|exists:phone_networks,id',
            'mobile_number_for_sms_alert' => 'nullable|string|max:255',
            'email_address_for_school_report' => 'nullable|email|max:255',
        ];
    }
}
