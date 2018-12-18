@extends('layouts.blog')
@section('content')
  <header class="masthead" style="background-image: url('/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Clean Blog</h1>
            <span class="subheading">A Blog Theme by Start Bootstrap</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="row">
      <div class="col-9">
        <form class="form-horizontal" enctype="multipart/form-data" action="{{ route('posts.store') }}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name='title' aria-describedby="emailHelp" placeholder="Enter email">
            @if($errors->has('title'))
              <span class="help-block errors-message">{{ $errors->first('title') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="content">Content</label>
            <input type="text" class="form-control" id="content" name='content' placeholder="Content">
            @if($errors->has('content'))
              <span class="help-block errors-message">{{ $errors->first('content') }}</span>
            @endif
          </div>
          <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name='image_url' placeholder="Content">
            @if($errors->has('image_url'))
              <span class="help-block errors-message">{{ $errors->first('image_url') }}</span>
            @endif
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
@stop
@section('css')
<link rel="stylesheet" type="text/css" href="/css/posts.css">
@stop