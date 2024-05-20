<?php

namespace App\Http\Request;

use App\Core\FormRequest;

class ClientStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
          'first_name' => 'required|string|max:100',
          'address' => 'required|string|max:255',
          // 'terms' => 'required|accepted'
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
  }
