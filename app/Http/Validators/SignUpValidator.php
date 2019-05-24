<?php
namespace App\Http\Validators;

use Illuminate\Validation\Validator;

class SignUpValidator extends Validator
{
    public function validateAlphaNumCheck($attribute, $value, $parameters)
    {
        return preg_match('/^[A-Za-z\d]+$/', $value);
    }
}