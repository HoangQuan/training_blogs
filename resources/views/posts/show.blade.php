@extends('layouts.blog')
@section('content')
  <!-- Page Header -->
  <header class="masthead" style="background-image: url('/img/post-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="post-heading">
            <h1>{{$post->title}}</h1>
            <span class="meta">Posted by
              <a href="#">Quan hv</a>
              on {{$post->created_at}}</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Post Content -->
  <article>
    <div class="container">
      <div class="row">
        <div class="col-9">
          <h1>{{$post->title}}</h1>
          
          <img width='100%' src="{{$post->image_url}}">
          <p>{!! $post->content !!}</p>
        </div>

        <div class="col-3" style="border: 1px solid;">
          <h6>{{ trans('common.new_post') }}</h6>
          @foreach($new_posts as $new_post)
            <div class="row" style="margin-bottom: 20px;">
              <div class="col-4"><img class="img-thumbnail" src="{{$new_post->image_url}}"></div>
              <div class="col-8 sidebar-title"><p><a href="{{route('posts.show', ['id' => $new_post->id] )}}">{{str_limit($new_post->title, $limit = 30, $end = trans('common.view_more'))}}</a></p></div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </article>
  <hr>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/css/posts.css">
@stop