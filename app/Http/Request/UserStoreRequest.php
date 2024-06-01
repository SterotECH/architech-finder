<?php

namespace App\Http\Request;

use App\Core\FormRequest;

class UserStoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:2|max:100',
            'last_name' => 'required|string|min:2|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:16',
            'phone_number' => 'required|string|min:10|max:20|unique:users,phone_number|regex:/^([0-9\s\-\+\(\)]*)$/',
            'role' => 'required|string',
            'location' => 'required|string|max:255'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
