<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
public function rules(): array
{
    return [
        'name' => [
            'required',
            'string',
            'max:255',
        ],

        'phone' => [
            'required',
            'string',
            'max:30',
        ],

        'email' => [
            'required',
            'email',
            'max:255',
        ],

        'comment' => [
            'required',
            'string',
            'max:2000',
        ],
    ];
}

public function messages(): array
{
    return [
        'name.required' => 'Имя обязательно для заполнения',
        'phone.required' => 'Телефон обязателен для заполнения',
        'email.required' => 'Email обязателен для заполнения',
        'email.email' => 'Некорректный формат email',
        'comment.required' => 'Комментарий обязателен',
    ];
}
}
