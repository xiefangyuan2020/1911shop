<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\validation\Rule;

class StoreArticlePost extends FormRequest
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
            'article_name' =>[
                'bail',
                'required',
                'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
                Rule::unique('article')->ignore(request()->id,'article_id')
            ], 
            'class_id' => 'required',
            'is_sing' => 'required',
            'is_show' => 'required',
        ];
    }


    public function messages(){
        return [
            "article_name.regex"=>"商品名称可以包含中文、数字、字母、下划线",  
            "article_name.unique"=>"文章标题已存在",
            "article_name.required"=>"文章标题不能为空",
            'class_id.required' => '商品分类必选' ,
            'is_sing.required'=>'文章重要性不能为空',
            'is_show.required'=>'是否显示不能为空',
        ];
    }
}
