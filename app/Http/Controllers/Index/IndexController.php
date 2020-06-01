<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cate;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function index(){
        /********memcache********/
        //$slice = Cache::get('slice');
        //dump($slice);

        //辅助函数
        //$slice = cache('slice');


        /******redis*******/
        $slice = Redis::get('slice');
        //dump($slice);


        if(!$slice){
            //echo "DB==";
            //首页幻灯片
            $slice = Goods::getSliceData();
            //Cache::put('slice',$slice,60);

            /*****memcache操作*****/
            //辅助函数的存
            //cache(['slice'=>$slice],60);

            /********redis*********/
            $slice = serialize($slice);
            Redis::setex('slice',60,$slice);

        }
        $slice = unserialize($slice);
        //dd($slice);

    	//获取顶级分类
    	$cate = Cate::getTopData();
    	//dd($cate);
    	//商品展示
    	$best = Goods::getBestData();

    	$new = Goods::getNewData();


    	return view('index.index',compact('slice','cate','best','new'));
    }
}
