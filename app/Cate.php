<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    /* 关联到模型的数据表
	*
	* @var string
	*/
	protected $table = 'cate';

	/**
	* The primary key associated with the table.
	*
	* @var string
	*/
	protected $primaryKey = 'cate_id';

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

	public static function getTopData(){
		return self::select('cate_id','cate_name')->where(['parent_id'=>0])->take(4)->get();
	}

}
