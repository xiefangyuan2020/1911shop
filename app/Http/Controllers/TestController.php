<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
    	echo "我是laravel";
    }

    public function add(){
    	$data = request()->post();
    	dump($data);
    	return view('add');
    }

    public function addDo(Request $request){
    	//接收所有值
    	//$data = $request->input();
    	//$data = $request->all();
    	$data = $request->post();
    	dump($data);

    	//只接收一个值
    	//$tt = $request->name;
    	// $tt = $request->input('pwd');
    	$tt = $request->post('pwd');
    	dump($tt);

    	//不接受指定的值
    	$kk = $request->except('pwd');
    	dump($kk);

    	$cc = $request->except(['_token','pwd']);
    	dump($cc);

    	//只接收指定的值
    	$da = $request->only('name');
    	dump($da);

    	$da = $request->only(['name','pwd']);
    	dump($da);
    }

     public function user($id){
    	echo $id;
    }

    public function goods($id,$name){
    	echo $id.'-'.$name;
    }

    public function show($id=0){
    	echo $id;
    }

     public function detail($id,$name=null){
    	echo $id.'-'.$name;
    }

}
