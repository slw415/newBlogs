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
            'title' => 'required',
        ];

    }
    public function messages()
    {
        return [
            'name.required'=>'导航栏名必填',
            'title.required'=>'导航栏英文名必填',
        ];
    }
}
