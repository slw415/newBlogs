<?php

namespace App\Http\Requests;

use App\Rules\CheckBirthday;
use App\Rules\CheckMobile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class LoginPostRequest extends FormRequest
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
                'password' => 'required|alpha_num|min:6',
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
                'password.required'=>'密码必须填写',
                'password.alpha_num'=>'密码必须是字母或数字',
                'password.max:6'=>'密码最少为6位',
                'mobile.required'=>'手机号必须填写',
                'birthday.required'=>'生日必须填写',
            ];
    }
}
