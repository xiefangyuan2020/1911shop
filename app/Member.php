<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
     /* 关联到模型的数据表
	*
	* @var string
	*/
	protected $table = 'member';

	/**
	* The primary key associated with the table.
	*
	* @var string
	*/
	protected $primaryKey = 'member_id';

	/**
	* 表明模型是否应该被打上时间戳
	*
	* @var bool
	*/
	public $timestamps = false;

}
