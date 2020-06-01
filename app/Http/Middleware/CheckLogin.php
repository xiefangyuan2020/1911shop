<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //先从session里取出用户信息，如果没有此用户信息 则取下cookie内的信息。如果cookie内有此信息，把此信息重新设置到session内，否则跳转到登录页面
        $admin = session('admin');
        //dd($admin);
        if(!$admin){
            //七天免登陆
            $cookie_admin = request()->cookie('admin');
            if($cookie_admin){
                //echo "走的免登陆";
                session(['admin'=>unserialize($cookie_admin)]);
            }else{
                return redirect('/login');
            }
            
        }

        return $next($request);
    }

}
