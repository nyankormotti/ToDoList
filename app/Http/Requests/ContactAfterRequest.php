<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactAfterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'contact__after') {
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
            'comment' => 'between:0,1000'
        ];
    }

    public function messages()
    {
        return [
            'comment.between' => '500文字以内で入力してください。'
        ];
    }
}
