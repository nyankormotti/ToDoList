<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'contact') {
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
            'email' => 'required|email|between:0,100',
            'comment' => 'between:0,1000'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '入力必須です。',
            'email.email' => 'メールアドレスの形式で入力してください。',
            'email.between' => '100文字以内で入力してください。',
            'comment.between' => '500文字以内で入力してください。'
        ];
    }
}
