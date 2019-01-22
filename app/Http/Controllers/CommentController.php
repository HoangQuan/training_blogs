<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use Validator;
use Auth;
// use App\Http\Requests\LikeRequest;

class CommentController extends Controller
{
    public function comment(Request $request) {

    	if(!Auth::user()){
    		return response()->json(['status' => false, 'message' => 'Ban can dang nhap']);
    	}

    	// 'data.ip' => ['required', 'unique:servers,ip,'.$this->id.',NULL,id,hostname,'.$request->input('hostname')]

    	$validator = Validator::make($request->all(), [
	      'post_id' => 'required',
	      'content' => 'required',
	    ], $messages = [
	      'post_id.required' => 'PostID khong ton tai',
	      'content.unique' => 'Ban chua nhap noi dung',
	    ]);

	    if ($validator->fails()) {
	        return response()->json(['status' => false, 'message' => $validator->errors()->first()]);
	    } else {

	    $comment = Comment::create([
	    	'user_id' => Auth::user()->id,
	    	'post_id' => $request->input('post_id'),
	    	'content' => $request->input('content'),
	   	]);

	      $view = view('posts.comment_list', compact('comment'))->render();
	      return response()->json(['status' => true, 'html'=>$view]);
	    }
	  }
}
