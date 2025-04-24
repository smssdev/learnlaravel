<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'someTimes|integer',
            'phone' => 'someTimes|string',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|string',
            'bio' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'user_id.integer'  => 'يجب إدخال المستخدم كرقم صحيح.',
        ];
    }
}
