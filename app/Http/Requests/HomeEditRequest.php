<?php

namespace App\Http\Requests;

use App\Rules\CheckBirthday;
use Illuminate\Foundation\Http\FormRequest;

class HomeEditRequest extends FormRequest
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
            'email' => 'email',
            'birthday' => ['required',new CheckBirthday],
            'imgfile'=>'dimensions:min_width=300,max_width=400',
        ];

    }
    public function messages()
    {
        return [
            'title.required'=>'标题必填',
            'email.email'=>'请输入一个正确的邮箱！',
            'birthday.required'=>'生日必填',
            'imgfile.dimensions'=>'图片宽度必须大于300小于400',
        ];
    }
}
