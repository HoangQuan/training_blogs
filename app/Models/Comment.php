<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Comment extends Model
{
	// 

	protected $table = 'comments';

	protected $fillable = [
		'user_id',
		'post_id',
		'content',
	];

	// Quan hệ 1 comment - thuoc 1 user
	public function user()
	{	

		// return User::find($this->user_id);
		// Nếu chuẩn quy tắc thì ko cần viết key
		// return $this->belongsTo('App\User', 'foreign_key', 'other_key');
		// return $this->belongsTo('App\User');
	    return $this->belongsTo('App\User', 'user_id', 'id');
	}
}
