<?php

namespace App\Core;

use App\Core\Request;
use App\Core\Validator;
use App\Core\Exceptions\NotAuthorizeException;

abstract class FormRequest extends Request
{
    protected array $errors = [];

    abstract public function rules(): array;

    abstract public function authorize(): bool;

    public function validate(array $data): void
    {
        if (authorize(fn () => $this->authorize())) {
            $validator = new Validator();
            $validator->validate((array)$this->all(), $this->rules());
            $this->errors = $validator->errors();
        }
    }

    public function failed(): bool
    {
        return !empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
