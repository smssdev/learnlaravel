<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:40',
            'description' => 'string',
            'priority' => 'required|integer|between:1,5'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'حقل العنوان مطلوب.',
            'title.max' => 'حقل العنوان يجب أن لا يزيد عن 40.',
            'priority.required' => 'حقل الأولوية مطلوب.',
            'priority.integer'  => 'يجب إدخال الأولوية كرقم صحيح.',
            'priority.between'  => 'يجب أن تكون قيمة الأولوية بين 1 و 5.'
        ];
    }
}
