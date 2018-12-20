@extends('layouts.blog')
@section('content')
  <header class="masthead" style="background-image: url('/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Edit Blog</h1>
            <span class="subheading">A Blog Theme by Start Bootstrap</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row">
      <div class="col-9">
        <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('posts.update', ['id' => $post->id]) }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" value="{{old('title') ? old('title') : $post->title}}" name='title' aria-describedby="emailHelp" placeholder="Enter email">
            @if($errors->has('title'))
              <span class="help-block errors-message">{{ $errors->first('title') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control ckeditor" id="content" name='content' placeholder="Content" cols="30" rows='15'>{{old('content') ?  old('content') : $post->content }}</textarea>
            @if($errors->has('content'))
              <span class="help-block errors-message">{{ $errors->first('content') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name='image_url' value="{{ old('image_url') }}" placeholder="Content">
            <br>
            <img class="img-thumbnail" src="{{ $post->image_url }}">
            @if($errors->has('image_url'))
              <span class="help-block errors-message">{{ $errors->first('image_url') }}</span>
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>

      <div class="col-3">
        <div class="row" style="border: 1px solid;">
          <div class="col-12 user-infor">
            <a href="https://www.facebook.com/zoro.kunkun">
              <img width='100%' class="circles" src="https://scontent.fhan4-1.fna.fbcdn.net/v/t31.0-8/860425_695227343875090_8043973826892118225_o.jpg?_nc_cat=104&_nc_ht=scontent.fhan4-1.fna&oh=6d594f7f03076f13843933e8bcbad27a&oe=5C98F807">
            </a>
            <hr />
          </div>

          <div class="col-12 user-infor">
            <p>Hoàng Văn Quân</p>
            <p>Tuổi: 19</p>
            <p>Giới tính: Nam</p>
            <p>Bài viết: 100</p>
            <p>Đã thích: 100</p>
            <p>Được thích: 100</p>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/css/posts.css">
@stop
<script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace( 'summary-ckeditor' );
</script>