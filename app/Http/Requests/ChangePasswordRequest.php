<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'myMenu/changePassword') {
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
            'old_pass' => 'required|alpha_num_check|pass_verifi|size:8',
            'password' => 'required|alpha_num_check|size:8|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'old_pass.required' => '入力必須です。',
            'old_pass.alpha_num_check' => '半角英数字にて入力してください。',
            'old_pass.pass_verifi' => '現在のパスワードが違います。',
            'old_pass.size' => '8桁にて入力してください。',
            'password.required' => '入力必須です。',
            'password.alpha_num_check' => '半角英数字にて入力してください。',
            'password.size' => '8桁にて入力してください。',
            'password.confirmed' => 'パスワードが確認欄と一致していません。'
        ];
    }
}
