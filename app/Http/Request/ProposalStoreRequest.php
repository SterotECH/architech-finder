<?php

namespace App\Http\Request;

use App\Core\FormRequest;
use App\Enums\UserRole;

class ProposalStoreRequest extends FormRequest {
  public function authorize(): bool
  {
    return auth()->user()->role === UserRole::ARCHITECT;
  }

  public function rules(): array
  {
    return [
      'project_id' => 'required|exists:projects,id',
      // 'architect_id' => 'required|exists:architects,id',
      'approach' => 'required|string|max:1000',
      'milestone_title' => 'array',
      'milestone_description' => 'array',
      'fees' => 'nullable|numeric|min:0',
    ];
  }
}
