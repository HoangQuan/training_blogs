<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Models\Post;
class LikeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $post = Post::find($this->input('post_id'));
        return $post;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post_id' => 'required|unique:likes',
        ];
    }

    public function messages()
    {
        return [
            'post_id.required' => 'Bài viết không tồn tại',
            'body.unique'  => 'Bạn đã like/dislike bài viết này rồi',
        ];
    }

    public function attributes()
    {
        return [
            'post_id' => 'Bài viết',
        ];
    }
}
