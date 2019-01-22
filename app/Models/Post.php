<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
class Post extends Model
{
	// 

	protected $table = 'posts';

	protected $fillable = [
		'title',
		'user_id',
		'content',
		'image_url',
		'view_count',
		'like_count',
		'status',
	];

	// Quan hệ 1 post - thuoc 1 user
	public function user()
	{	

		// return User::find($this->user_id);
		// Nếu chuẩn quy tắc thì ko cần viết key
		// return $this->belongsTo('App\User', 'foreign_key', 'other_key');
		// return $this->belongsTo('App\User');
	    return $this->belongsTo('App\User', 'user_id', 'id');
	}

	static public function increaseViews($id) {
		return Post::where('id', $id)->update([
	      'view_count'=> DB::raw('view_count+1')
	    ]);
	}

	static public function increaseLikes($id) {
		return Post::where('id', $id)->update([
	      'view_count'=> DB::raw('like_count+1')
	    ]);
	}

	// 1 post - cos nhieu comment
    public function comments() {
        // return $this->hasMany('App\Models\Post', 'foreign_key', 'local_key');
        return $this->hasMany('App\Models\Comment');
    }
}