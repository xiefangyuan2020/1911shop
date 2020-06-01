<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//闭包路由
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('hello', function () {
    echo 'hello me laravel';
});

//走控制器方法的路由
Route::get('index', 'TestController@index'); 

//三种显示模板视图的方法
// Route::get('add', function () {
//     return view('add');
// });
//Route::get('add', 'TestController@add'); 

//Route::view('add','add');
Route::post('addDo', 'TestController@addDo'); 

//注册一个路由支持多种请求方式
//Route::any('add', 'TestController@add'); 
			 //支持get和post两种方式
Route::match(['get','post'],'add', 'TestController@add'); 


//必须参数
Route::get('user/{id}', function ($id) {
	return 'User ' . $id;
});
// Route::get('goods/{id}', function ($id) {
// 	return 'Goods ' . $id;
// });
//Route::get('goods/{id}','TestController@goods');

Route::get('goods/{id}/{name}','TestController@goods')->where(['name'=>'[a-zA-Z]+']);

//可选参数
Route::get('show/{id?}','TestController@show');
Route::get('detail/{id}/{name?}','TestController@detail');

Route::domain('admin.1911.com')->group(function (){
	//商品品牌
	Route::prefix('brand')->middleware('login')->group(function(){
		Route::get('/', 'Admin\BrandController@index'); 
		Route::get('create', 'Admin\BrandController@create'); 
		Route::post('store', 'Admin\BrandController@store'); 
		Route::get('edit/{id}', 'Admin\BrandController@edit'); 
		Route::post('update/{id}', 'Admin\BrandController@update'); 
		Route::get('destroy/{id}', 'Admin\BrandController@destroy');
	});

	//商品分类
	Route::prefix('cate')->middleware('login')->group(function(){
		Route::get('/','Admin\CateController@index');
		Route::get('create','Admin\CateController@create');
		Route::post('store','Admin\CateController@store');
		Route::get('edit/{id}','Admin\CateController@edit');
		Route::post('update/{id}','Admin\CateController@update');
		Route::get('destroy/{id}', 'Admin\CateController@destroy');
	});

	//商品管理
	Route::prefix('goods')->middleware('login')->group(function(){
		Route::get('/','Admin\GoodsController@index');
		Route::get('create','Admin\GoodsController@create');
		Route::post('store','Admin\GoodsController@store');
		Route::get('edit/{id}','Admin\GoodsController@edit');
		Route::post('update/{id}','Admin\GoodsController@update');
		Route::get('destroy/{id}', 'Admin\GoodsController@destroy');
		Route::post('checkName', 'Admin\GoodsController@checkName');
	});

	//管理员管理
	Route::prefix('admin')->middleware('login')->group(function(){
		Route::get('/','Admin\AdminController@index');
		Route::get('create','Admin\AdminController@create');
		Route::post('store','Admin\AdminController@store');
		Route::get('edit/{id}','Admin\AdminController@edit');
		Route::post('update/{id}','Admin\AdminController@update');
		Route::get('destroy/{id}', 'Admin\AdminController@destroy');
	});

	//文章管理
	Route::prefix('article')->middleware('login')->group(function(){
		Route::get('/','Admin\ArticleController@index');
		Route::get('create','Admin\ArticleController@create');
		Route::post('store','Admin\ArticleController@store');
		Route::get('edit/{id}','Admin\ArticleController@edit');
		Route::post('update/{id}','Admin\ArticleController@update');
		Route::get('destroy/{id}', 'Admin\ArticleController@destroy');
	});

	//登录
	Route::get('/login','Admin\LoginController@index');
	Route::post('/loginDO','Admin\LoginController@loginDO');
	Route::get('/logout','Admin\LoginController@logout');

	//练习cookie 
	Route::get('/setcookie','Admin\LoginController@setcookie');
	Route::get('/getcookie','Admin\LoginController@setcookie');

});

Route::domain('www.1911.com')->group(function (){
	//微商城前台
	Route::get('/', 'Index\IndexController@index')->name('shop.index'); //首页
	Route::get('/login', 'Index\LoginController@login');  //登录
	Route::post('/logindo', 'Index\LoginController@logindo'); //执行登录
	Route::get('/reg', 'Index\LoginController@reg'); //注册
	Route::post('/regdo', 'Index\LoginController@regdo'); //执行注册
	Route::get('/sendSms', 'Index\LoginController@sendSms'); //手机号注册
	Route::get('/sendEmail', 'Index\LoginController@sendEmail'); //邮箱注册
	Route::get('/proinfo/{id}', 'Index\ProController@proinfo')->name('shop.goods'); //商品详情
	Route::get('/addcar', 'Index\ProController@addcar'); //加入购物车
	Route::get('/cart', 'Index\CartController@index')->middleware('checkmember')->name('shop.cart'); //购物车列表
	Route::get("/pay","Index\CartController@pay");//确认订单

	Route::get("/news","Index\NewsController@index");
});
