<?php

namespace App\Core;

class Validator
{
    use \App\Traits\Validator;

    protected array $errors = [];

    public function validate(array $data, array $rules): bool
    {
        $valid = true;

        foreach ($rules as $field => $rule) {
            $rulesArray = explode('|', $rule);

            foreach ($rulesArray as $singleRule) {
                $params = explode(':', $singleRule);
                $methodName = $params[0];
                $params = isset($params[1]) ? explode(',', $params[1]) : [];

                if ($methodName === 'nullable' && empty($data[$field])) {
                    continue;
                }

                if (!$this->$methodName($data[$field], ...$params)) {
                    $valid = false;
                    $message = $this->getErrorMessage($methodName, $params);
                    $this->storeValidationError($field, $message, $params);
                }
            }
        }

        return $valid;
    }



    protected function getErrorMessage(string $rule, array $params): string
    {

        $defaultMessages = [
            'required' => "%s is required.",
            'email' => "%s must be a valid email address.",
            'min' => "%s must be at least :min characters.",
            'max' => "%s may not be greater than :max characters.",
            'regex' => "%s is invalid.",
            'nullable' => "%s is required.",
            'string' => "%s must be a string.",
            'url' => "%s must be a valid URL.",
            'phone' => "%s must be a valid phone number.",
            'password' => "%s must be a valid password.",
            'fileType' => "%s must be a valid file type.",
            'maxFileSize' => "%s must be a valid file size.",
            'unique' => "%s must be unique.",
            'exists' => "No matching records found",
            'same' => "%s must be same.",
            'different' => "%s must be different.",
            'in' => "%s must be in :params.",
            'notIn' => "%s must not be in:params.",
            'between' => "%s must be between.",
            'notBetween' => "%s must not be between.",
            'date' => "%s must be a date.",
            'dateFormat' => "%s must be a date format.",
            'before' => "%s must be before.",
            'after' => "%s must be after.",
            'beforeOrEqual' => "%s must be before or equal. :params",
            'afterOrEqual' => "%s must be after or equal.:params",
            'boolean' => "%s must be a boolean.",
            'numeric' => "%s must be a numeric.",
            'integer' => "%s must be an integer.",
            'float' => "%s must be a float.",
            'array' => "%s must be an array.",
            'object' => "%s must be an object.",
            'file' => "%s must be a file.",
            'image' => "%s must be an image.",
            'alpha' => "%s must be alpha.",
            'alphaNum' => "%s must be alpha numeric.",
            'alphaDash' => "%s must be alpha dash.",
            'alphaNumDash' => "%s must be alpha numeric dash.",
            'alphaNumSpace' => "%s must be alpha numeric space.",
            'alphaNumDashSpace' => "%s must be alpha numeric dash space.",
            'alphaSpace' => "%s must be alpha space.",
            'alphaDashSpace' => "%s must be alpha dash space.",
            'passwordVerify' => "No Matching account found for that email and password"
        ];

        $message = $defaultMessages[$rule] ?? "%s is invalid.";

        if ($params !== null) {
            foreach ($params as $key => $value) {
                $message = str_replace("%$key", $value, $message);
            }
        }

        return $message;
    }


    public function errors(): array
    {
        return $this->errors;
    }

    protected function storeValidationError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }

    public function clearErrors(): void
    {
        $this->errors = [];
    }

}
