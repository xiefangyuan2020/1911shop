<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\validation\Rule;

class StoreAdminPost extends FormRequest
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
            'admin_name' =>[
                'bail',
                'required',
                'regex:/^[\x{4e00}-\x{9fa5}\dA-Za-z]{1,18}$/u',
                Rule::unique('admin')->ignore(request()->id,'admin_id')
            ],
            'admin_pwd' => 'bail|required|regex:/^\w{6,12}$/', 
            'admin_pwds' => 'bail|required|same:admin_pwd', 
            'admin_tel' => 'bail|required|regex:/^1[34578][0-9]{9}$/',
            'admin_email' => 'bail|required|email',
        ];
    }

     public function messages(){
        return [
            "admin_name.required"=>"管理员名称不可为空",
            "admin_name.unique"=>"管理员名称已存在",
            "admin_name.regex"=>"管理员名称格式不正确",
            "admin_pwd.required"=>"管理员密码不可为空",
            "admin_pwd.regex"=>"管理员密码必须为6至12位",
            "admin_pwds.required"=>"确认密码不可为空",
            "admin_pwds.same"=>"确认密码必须和密码一致",
            "admin_tel.required"=>"管理员手机号不可为空",
            "admin_tel.regex"=>"管理员手机号格式不正确",
            "admin_email.required"=>"管理员邮箱不可为空",
            "admin_email.email"=>"管理员邮箱格式不正确",
        ];
    }
}
