<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NavRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'title' => 'required|between:15,20',
        ];

    }
    public function messages()
    {
        return [
            'name.required'=>'导航栏名必填',
            'title.required'=>'导航栏文言必填',
            'title.max'=>'导航栏文言字数10到15之间'
        ];
    }
}
