<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
  public function index(Request $request)
  {
    $posts = Post::paginate(20); // simplePaginate for only next and prevous link
    if ($request->ajax()) {
      $view = view('posts._list', compact('posts'))->render();
      return response()->json(['html'=>$view, 'url' => $posts->nextPageUrl(), 'hasMore' => $posts->hasMorePages()]);
    }
    return view("posts.index", compact('posts'));
  }
}
