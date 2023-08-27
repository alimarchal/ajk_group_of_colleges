<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;


use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
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
//        dd($this->request->get('discount_type'));
        $discount_type = $this->request->get('discount_type');
        return [
            'fee_type_id' => 'required|exists:fee_types,id',
            'student_id' => ['required','exists:students,id'],
            'discount_type' => 'required|in:No-Discount,Flat,Percentage',
            'discounted_number' => 'required',
//            'discounted_number' => function ($attribute, $value, $fail) use ($discount_type) {
//                if (in_array($discount_type, ['Flat', 'Percentage'])) {
//                    if (!$value) {
//                        $fail('The discounted number is required when discount type is Flat or Percentage.');
//                    }
//                }
//            },
            'issue_date' => 'required|date',
            'due_date' => 'required|date',
        ];
    }
}
