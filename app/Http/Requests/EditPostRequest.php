<?php

namespace App\Http\Requests;

use App\Rules\CheckBirthday;
use App\Rules\CheckMobile;
use Illuminate\Foundation\Http\FormRequest;

class EditPostRequest extends FormRequest
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
            'name' => 'required|alpha_num|max:6',
            'mobile'=> ['required',new CheckMobile],
            'birthday' => ['required',new CheckBirthday]
        ];

    }
    public function messages()
    {
        return[
            'name.required'=>'名字必须填写',
            'name.alpha_num'=>'名字必须是字母或数字',
            'name.max:6'=>'名字最多为6位',
            'mobile.required'=>'手机号必须填写',
            'birthday.required'=>'生日必须填写',
        ];
    }
}
