<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /* 关联到模型的数据表
	*
	* @var string
	*/
	protected $table = 'admin';

	/**
	* The primary key associated with the table.
	*
	* @var string
	*/
	protected $primaryKey = 'admin_id';

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

}
