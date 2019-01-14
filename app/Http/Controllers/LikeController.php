<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Http\Request;
use Validator;
use Auth;
// use App\Http\Requests\LikeRequest;

class LikeController extends Controller
{
    public function like(Request $request) {

    	if(!Auth::user()){
    		return response()->json(['status' => false, 'message' => 'Ban can dang nhap']);
    	}

    	// 'data.ip' => ['required', 'unique:servers,ip,'.$this->id.',NULL,id,hostname,'.$request->input('hostname')]

    	$validator = Validator::make($request->all(), [
	      'post_id' => 'required|unique:likes,post_id,user_id'. Auth::user()->id,
	    ], $messages = [
	      'post_id.required' => 'PostID khong ton tai',
	      'post_id.unique' => 'Ban da like/dislike bai viet nay roi',
	    ]);

	    if ($validator->fails()) {
	        return response()->json(['status' => false, 'message' => $validator->errors()]);
	    } else {

	      // DB::beginTransaction();
	      $like = new Like($request->all());
	      $like->user_id = Auth::user()->id;
	      $like->save();

	      Post::increaseLikes($request->input('post_id'));
	      // DB::commit();

	      return response()->json(['status' =>true]);
	    }
	  }

	public function dislike(LikeRequest $request) {
    	// Kiểm tra dữ liệu
	    $validator = $request->validate();

	    if ($validator->fails()) {
	        return response()->json($validator->errors());
	    } else {
	      // DB::beginTransaction();
	      $like = Like::create($request->all());

	      // DB::commit();
	      $request->session()->flash('post_create', 'Tạo thành công!');
	      return response()->json(['status' => '']);
	    }
	  }

}
