<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'loginTask') {
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
            'email' => 'required|email',
            'password' => 'required|alpha_num_check|size:8'
        ];

    }


    public function messages()
    {
        return [
            'email.required' => '入力必須です。',
            'email.email' => 'メールアドレスの形式で入力してください。',
            'password.required' => '入力必須です。',
            'password.alpha_num_check' => '半角英数字にて入力してください。',
            'password.size' => '8桁にて入力してください。',
        ];
    }
}
