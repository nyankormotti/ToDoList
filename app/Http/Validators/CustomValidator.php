<?php
namespace App\Http\Validators;

use Illuminate\Validation\Validator;
use App\User;
use Illuminate\Support\Facades\Auth;

class CustomValidator extends Validator
{
    public function validateAlphaNumCheck($attribute, $value, $parameters)
    {
        return preg_match('/^[A-Za-z\d]+$/', $value);
    }

    public function validatePassVerifi( $attribute, $value, $parameters){
        $id = Auth::id();
        $user = User::where('id', $id)->first();

        if (Auth::attempt(['email' => $user->email, 'password' => $value])) {
            return true;
        } else {
            return false;
        }
    }
}