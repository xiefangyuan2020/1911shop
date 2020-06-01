<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    /* 关联到模型的数据表
	*
	* @var string
	*/
	protected $table = 'goods';

	/**
	* The primary key associated with the table.
	*
	* @var string
	*/
	protected $primaryKey = 'goods_id';

	/**
	* 表明模型是否应该被打上时间戳
	*
	* @var bool
	*/
	public $timestamps = false;

	/**
	*白名单
	* 可以被批量赋值的属性.
	*
	* @var array
	*/
	//protected $fillable = ['cate_name','parent_id','is_show','is_nav_show','cate_desc'];

	//黑名单
	protected $guarded = [];

	//获取幻灯片数据
	public static function getSliceData(){
		$where['is_slice'] = 1;
		$where['is_show'] = 1;
		return self::select('goods_id','goods_img')->where($where)->take(5)->get();
	}

	//获取推荐数据
	public static function getBestData(){
		return self::select("goods_id","goods_name","goods_img","goods_price")->where('is_best',1)->take(6)->get();
	}

	//获取新品数剧
	public static function getNewData(){
		return self::select('goods_id','goods_img','goods_name','goods_price')->where('is_new',1)->orderBy('goods_id',"desc")->take(3)->get();
	}

	//获取商品详情
    public static function getGoodsInfoId($id){
        return self::find($id);
    }
    //获取商品列表
    public static function getGoodsInfo(){
        return self::orderBy("goods_id","desc")->get();
    }
    public static function getGoodsInfoPid($id){
        return self::whereIn("cate_id",$id)->orderBy("goods_id","desc")->get();
    }
    
}
