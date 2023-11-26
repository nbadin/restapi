<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'firstname' => 'required|string|min:3|max:40',
            'lastname' => 'required|string|min:3|max:40',
            'phone_number' => 'required|string|regex:/^\+7\d{10}$/|unique:users',
            'avatar' => 'nullable|image|mimes:jpg,png|max:2048',
        ];
    }
}
