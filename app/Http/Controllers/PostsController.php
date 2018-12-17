<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
    	$posts = Post::paginate(6);
        return view("posts.index", compact('posts'));
    }
}
