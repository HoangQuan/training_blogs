@extends('layouts.blog')

@section('js')
<script type="text/javascript">
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $('.like-icon').on('click', function(){
    var id = $(this).data('id');
    $.ajax({
      type : 'POST',
      url: '/ajax/like',
      data: {post_id: id},
      success : function(data){
        if(data.status){
          var like = $('.fa-thumbs-up').html();
          $('.fa-thumbs-up').html(1 + parseInt(like) );
        }else{
          alert(data.message.post_id);
        }
      },error: function(data){

      },
  })
  });
</script>
@stop

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
          <span class="icon fa fa-eye" aria-hidden="true">{{$post->view_count}}</span>
          <span class="icon fa fa-thumbs-up" aria-hidden="true">{{$post->like_count}}</span>
          <span class="icon fa fa-thumbtack" aria-hidden="true">1000</span>
          
          <img width='100%' src="{{$post->image_url}}">
          <p>{!! $post->content !!}</p>

          <div>
            Bài viết này có hữu ích với bạn không? 
            <span class="icon fa fa fa-thumbs-up like-icon" data-id="{{$post->id}}"></span> Hoặc <span class="icon fa fa fa-thumbs-down dislike-icon" data-id="{{$post->id}}"></span>
          </div>
        </div>

        <div class="col-3" style="border: 1px solid;">
          @include('partials.user_infor')
          
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
<style type="text/css">
  .like-icon {
    zoom: 2;
    color: #e00606;
  }

  .dislike-icon {
    zoom: 2;
    color: #e00606;
    margin-left: 10px;
  }

  .like-icon:hover, .dislike-icon:hover {
    color: #212529;
    zoom: 3;
  }

</style>
@stop