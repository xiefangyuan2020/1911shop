<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	/**
	* 关联到模型的数据表
	*
	* @var string
	*/
	protected $table = 'article';

	/**
	* The primary key associated with the table.
	*
	* @var string
	*/
	protected $primaryKey = 'article_id';

	/**
	* 表明模型是否应该被打上时间戳
	*
	* @var bool
	*/
	public $timestamps = false;


	// 黑名单
	protected $guarded = [];

}
