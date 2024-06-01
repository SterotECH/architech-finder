<?php

namespace App\Http\Request;

use App\Core\FormRequest;
use App\Enums\UserRole;

class ProposalUpdateRequest extends FormRequest
{
  public function rules(): array
  {
    return [
      'project_id' => 'required|exists:projects,id',
      'architect_id' => 'required|exists:architects,id',
      'approach' => 'required|string|max:1000',
      'timeline' => 'nullable|string|max:255',
      'fees' => 'nullable|numeric|min:0',
    ];
  }

  public function authorize(): bool
  {
    return auth()->user()->role === UserRole::ARCHITECT;
  }
}
