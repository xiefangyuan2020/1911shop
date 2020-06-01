<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Illuminate\Support\Facades\Cookie;


class LoginController extends Controller
{
    public function index(){
    	return view('admin.login');
    }

    public function loginDO(Request $request){
    	$post = $request->except('_token');
    	//dd($post);
    	$admin = Admin::where('admin_name',$post['admin_name'])->first();
    	//dd($admin);
    	//dd(decrypt($admin->admin_pwd));
    	if(!$admin || decrypt($admin->admin_pwd)!=$post['admin_pwd']){
    		return redirect('/login')->with('msg','用户名或密码有误');
    	}

    	//七天免登陆
    	if(isset($post['isremember'])){
    		Cookie::queue('admin',serialize($admin),60*24*7);
    	}

    	session(['admin'=>$admin]);
    	return redirect('/goods');
    }

    //设置cookie
    public function setcookie(){
    	//三种设置cookie方式
    	//return response('欢迎来到laravel学院')->cookie('name','乐柠',1);
    	// Cookie::queue(Cookie::make('name','沙河',1));
    	// Cookie::queue('name','美少女',1);
    	Cookie::queue('name','china',1);
    }
    public function getcookie(){
    	//两种获取cookie 
    	//echo request()->cookie('name');
    	echo Cookie::get('name');
    }

    //退出
    public function logout(){
    	request()->session()->flush();
    	return redirect('/login');
    }

}
