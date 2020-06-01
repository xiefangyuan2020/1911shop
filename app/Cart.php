<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     /* 关联到模型的数据表
	*
	* @var string
	*/
	protected $table = 'cart';

	/**
	* The primary key associated with the table.
	*
	* @var string
	*/
	protected $primaryKey = 'cart_id';

	/**
	* 表明模型是否应该被打上时间戳
	*
	* @var bool
	*/
	public $timestamps = false;

}
