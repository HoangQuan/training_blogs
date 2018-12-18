<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class PostsController extends Controller
{
  public function index(Request $request)
  {
    $posts = Post::orderBy('id', 'desc')->paginate(6); // simplePaginate for only next and prevous link
    if ($request->ajax()) {
      $view = view('posts._list', compact('posts'))->render();
      return response()->json(['html'=>$view, 'url' => $posts->nextPageUrl(), 'hasMore' => $posts->hasMorePages()]);
    }
    return view("posts.index", compact('posts'));
  }

  public function show($id) {
    $post = Post::find($id);
    $new_posts = Post::whereNotIn('id', [$id])->orderBy('updated_at')->take(5)->get();
    return view("posts.show", compact('post', 'new_posts'));
  }


  public function create() {
    return view("posts.create");
  }

  public function store(Request $request) {
    // Kiểm tra dữ liệu
    $validator = Validator::make($request->all(), [
      'title' => 'required|unique:posts|max:255',
      'content' => 'required',
      'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ], $messages = [
      'title.required' => trans('post.title_required'),
      'title.unique' => trans('post.title_unique'),
      'content.required' => trans('post.title_content'),
      'image_url.required' => trans('post.image_require'),
      'image_url.image' => trans('post.image_image'),
      'image_url.mimes' => trans('post.image_mimes'),
      'image_url.max' => trans('post.image_max'),
    ]);

    if ($validator->fails()) {
        $request->flash();
        return view('posts.create')->withErrors($validator);
    } else {
      // DB::beginTransaction();
      $image = $request->file('image_url');
      $image_name = time().'-'.$image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
      $store_path = '/upload/images/posts/'.$request->input('type').'/';
      $destinationPath = public_path($store_path);
      $image->move($destinationPath, $image_name);
      

      $post = Post::create([
        'title' => $request->input('title'),
        'image_url' => $store_path.$image_name,
        'content' => $request->input('content'),
        'user_id' => 1,
      ]);

      // DB::commit();
      $request->session()->flash('post_create', 'Tạo thành công!');
      return redirect('posts');
    }
  }
}
