<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
            'title' => 'someTimes|string|max:40',
            'description' => 'someTimes|nullable|string',
            'priority' => 'someTimes|integer|between:1,5',
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'حقل العنوان يجب أن لا يزيد عن 40.',
            'priority.integer'  => 'يجب إدخال الأولوية كرقم صحيح.',
            'priority.between'  => 'يجب أن تكون قيمة الأولوية بين 1 و 5.',
        ];
    }
}
