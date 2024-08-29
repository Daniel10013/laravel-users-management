<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class OWASP_Password implements ValidationRule
{
    private array $errors;
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->passwordIsValid($value) == false){
            $fail($this->getMessage());
        }
    }

    private function passwordIsValid(string $password): bool{
        $isValid = true;
        if(strlen($password) < 10){
            $this->errors[] = 'Password lengt must be at least 10 characters';
        }
        if (!preg_match('/[A-Z]/', $password)) {
            $this->errors[] = 'Password must contain at least one uppercase letter';
            $isValid = false;
        }
        if (!preg_match('/[a-z]/', $password)) {
            $this->errors[] = 'Password must contain at least one lowercase letter';
            $isValid = false;
        }
        if (!preg_match('/\d/', $password)) {
            $this->errors[] = 'Password must contain at least one digit';
            $isValid = false;
        }
        if (!preg_match('/[\W_]/', $password)) {
            $this->errors[] = 'Password must contain at least one special character';
            $isValid = false;
        }

        return $isValid;
    }

    private function getMessage(): string{
        $errorString = "";
        foreach($this->errors as $error){
            $errorString .= $error . ". ";
        }

        return $errorString;
    }
}
