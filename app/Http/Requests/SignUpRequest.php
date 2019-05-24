<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'signup'){
            return true;
        } else {
            return false;
        }
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|between:0,30',
            'email' => 'required|email|unique:users',
            'password' => 'required|alpha_num_check|size:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '入力必須です。',
            'name.between' => '30文字以内で入力してください。',
            'email.required' =>'入力必須です。',
            'email.email' =>'メールアドレスの形式で入力してください。',
            'email.unique' =>'このメールアドレスはすでに使用されています。',
            'password.required' =>'入力必須です。',
            'password.alpha_num_check' =>'半角英数字にて入力してください。',
            'password.size' =>'8桁にて入力してください。',
            'password.confirmed' => 'パスワードが確認欄と一致していません。'
        ];
    }
}
