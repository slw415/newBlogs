<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'title' => 'required',
            'user' => 'required',
            'introduction'=>'required',
            'content'=>'required',
        ];

    }
    public function messages()
    {
        return [
            'title.required'=>'标题必填',
            'user.required'=>'作者必填',
            'introduction.required'=>'简介必填',
            'content.required'=>'内容必填'

        ];
    }
}
