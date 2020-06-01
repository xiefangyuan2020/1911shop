<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;

class Cartcontroller extends Controller
{
    public function index(){
    	$user = session('user');
    	$cart = Cart::where(['user_id'=>$user->member_id])->get();
    	//dd($cart);

    	$cart_id = array_column($cart->toArray(),'cart_id');
    	$buy_number = array_column($cart->toArray(),'buy_number');
    	//dd($buy_number);
    	$buyData = array_combine($cart_id,$buy_number);
    	//dd($buyData);

    	$buycount = array_sum($buy_number);

    	return view('index.car',['cart'=>$cart,'buyData'=>$buyData,'buycount'=>$buycount]);
    }

    public function par(){
        return view('index.par');
    }
   
}
