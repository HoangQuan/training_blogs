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

	static public function increaseViews($id) {
		return Post::where('id', $id)->update([
      'view_count'=> DB::raw('view_count+1')
    ]);
	}
}