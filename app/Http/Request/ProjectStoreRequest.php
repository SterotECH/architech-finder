<?php

namespace App\Http\Request;

use App\Core\FormRequest;

class ProjectStoreRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'name' => 'required|string|max:255',
      'description' => 'required|string|min:100',
      'type' => 'required|string|max:255',
    ];
  }
}
