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

    public function validateSameEmailVerifi($attribute, $value, $parameters){
        $user = User::where('email', $value)->where('delete_flg',false)->count();

        if($user == 0){
            return false;
        } else{
            return true;
        }
    }

    public function validateSameAuthKeyVerifi($attribute, $value, $parameters){
        $auth_key = session()->get( 'auth_key');
        if($auth_key !== $value){
            return false;
        } else{
            return true;
        }
    }
}