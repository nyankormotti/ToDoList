<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoneTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->path() == 'doneTask') {
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
            'strat_date' => 'nullable|date_format:Y/m/d|before_or_equal:end_date',
            'end_date' => 'nullable|date_format:Y/m/d'
        ];
    }

    public function messages()
    {
        return [
            'strat_date.date_format' => '開始日が正しくありません',
            'strat_date.before_or_equal' => '終了日が開始日より前です',
            'end_date.date_format' => '終了日が正しくありません'
        ];
    }
}
