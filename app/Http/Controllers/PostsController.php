<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;
use File;

class PostsController extends Controller
{
  public function __construct()
  {
    // $this->middleware('auth');
    $this->setting = 1;
  }

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
    // $this->middleware('auth');
    $post = Post::find($id);
    Post::increaseViews($id);
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
      $image_name = time().'-'.$image->getClientOriginalName();
      $store_path = '/upload/images/posts/';
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

  public function edit($id) {
    $post = Post::find($id);
    return view("posts.edit", compact('post'));
  }

  public function update(Request $request, $id) {
    // Kiểm tra dữ liệu
    $validator = Validator::make($request->all(), [
      'title' => 'required|unique:posts,title,'.$id.'|max:255',
      'content' => 'required',
      'image_url' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ], $messages = [
      'title.required' => trans('post.title_required'),
      'title.unique' => trans('post.title_unique'),
      'content.required' => trans('post.title_content'),
      'image_url.required' => trans('post.image_require'),
      'image_url.image' => trans('post.image_image'),
      'image_url.mimes' => trans('post.image_mimes'),
      'image_url.max' => trans('post.image_max'),
    ]);

    $post = Post::find($id);
    if ($validator->fails()) {
        $request->flash();
        return view('posts.edit', compact('post'))->withErrors($validator);
    } else {
      // DB::beginTransaction();
      $update_columns = [
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'user_id' => 1,
      ];
      if ($request->has('image_url')) {
        $image = $request->file('image_url');
        $image_name = time().'-'.$image->getClientOriginalName();
        $store_path = '/upload/images/posts/';
        $destinationPath = public_path($store_path);
        $image->move($destinationPath, $image_name);
        // unlink(public_path($post->image_url));
        File::delete(public_path($post->image_url));
        $update_columns['image_url'] = $store_path.$image_name;
      }
      $post->update($update_columns);
      Post::updateOrCreate($update_columns);

      // DB::commit();
      $request->session()->flash('post_create', 'Sửa thành công!');
      return redirect('posts');
    }
  }

}
