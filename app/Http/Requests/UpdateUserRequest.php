<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'firstname' => 'string|min:3|max:39',
            'lastname' => 'string|min:3|max:39',
            'phone_number' => 'string|regex:/^\+7\d{10}$/|unique:users',
            'avatar' => 'image|mimes:jpg,png|max:2048',
        ];
    }
}
