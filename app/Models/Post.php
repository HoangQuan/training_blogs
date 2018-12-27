<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

}