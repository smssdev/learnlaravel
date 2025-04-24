<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // أي مستخدم مسموح له بهذا الطلب
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'phone' => 'required|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date_format:d-m-Y',
            'bio' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'حقل المستخدم مطلوب.',
            'user_id.integer'  => 'يجب إدخال المستخدم كرقم صحيح.',
            'phone.required' => 'حقل الهاتف مطلوب.',
        ];
    }
}
