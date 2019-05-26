<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'myMenu/registCategory') {
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
            'category1' => 'required|between:0,8',
            'category2' => 'required|between:0,8',
            'category3' => 'required|between:0,8',
            'category4' => 'required|between:0,8',
            'category5' => 'required|between:0,8'
        ];
    }

    public function messages()
    {
        return [
            'category1.required' => '入力必須です。',
            'category1.between' => '8文字以内で入力してください。',
            'category2.required' => '入力必須です。',
            'category2.between' => '8文字以内で入力してください。',
            'category3.required' => '入力必須です。',
            'category3.between' => '8文字以内で入力してください。',
            'category4.required' => '入力必須です。',
            'category4.between' => '8文字以内で入力してください。',
            'category5.required' => '入力必須です。',
            'category5.between' => '8文字以内で入力してください。'
            
        ];
    }
}
