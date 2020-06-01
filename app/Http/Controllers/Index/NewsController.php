<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\Redis;

class NewsController extends Controller
{
    public function index(){
    	$page = request()->page?:1;

    	$title = request()->title;
    	$where = [];
    	if($title){
    		$where[] = ['title','like',"%$title%"];
    	}

    	//redis缓存
    	$news = Redis::get('news_'.$page.'_'.$title);
    	dump('news_'.$page.'_'.$title);
    	dump($news);
    	if(!$news){
    		$pageSize = config('app.pageSize');
    		$news = News::where($where)->paginate($pageSize);
    		$news = serialize($news);
    		Redis::setex('news_'.$page.'_'.$title,60,$news);

    	}

    	$news = unserialize($news);
    	
    	return view('index.news',['news'=>$news,'title'=>$title]);
    }
}
