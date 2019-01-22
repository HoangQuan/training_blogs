@extends('layouts.blog')

@section('js')
<script src="/slick/slick.js"></script>
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
          alert(data.message);
        }
      },error: function(data){

      },
  })
  });

  $('#comment-submit').on('click', function(){
    var id = $(this).data('id');
    var content = $('#comment-text').val();
    $.ajax({
        type : 'POST',
        url: '/ajax/comment',
        data: {post_id: id, content: content},
        success : function(data){
          if(data.status){
            $('#comment-text').val('');
            $('#comment-area').prepend(data.html);
          }else{
            alert(data.message);
          }
        },error: function(data){

        },
    })
  });

  $(document).ready(function(){
    $('.slick-slider').slick({
      dots: false,
      infinite: false,
      speed: 300,
      slidesToShow: 4,
      autoplay: true,
      autoplaySpeed: 1000,
      slidesToScroll: 3,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
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
              <a href="#">{{$post->user->name}}</a>
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
            <span class="icon fa fa fa-thumbs-up like-icon" data-id="{{$post->id}}"></span> Hoặc <span class="icon fa fa fa-thumbs-down dislike-icon" data-dislike-id="{{$post->id}}"></span>
          </div>

          <div class="container pb-cmnt-container">
              <div class="row">
                  <div class="col-md-9 col-md-offset-6">
                      <div class="panel panel-info">
                          <div class="panel-body">
                              <form class="form-inline">
                                  <textarea placeholder="Write your comment here!" class="pb-cmnt-textarea" id='comment-text' required></textarea>
                              </form>
                              <button data-id="{{$post->id}}" class="btn btn-primary pull-right" id="comment-submit" style="margin-top: 10px; float: right;" type="button">Send</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <h1>Comments</h1>
          <div class="col-sm-12" id="comment-area">
            @foreach($post->comments as $comment)
              @include('posts.comment_list', ['comment' => $comment])
            @endforeach
          </div>
          <hr>
          @if(count($rel_posts))
            <h3>Bài viết cùng tác giả</h3>
            <div class="slick-slider">
              @foreach($rel_posts as $post)
                <div class='slick-slider-item'>
                  <div class='slick-slider-image'>
                    <img src="{{$post->image_url}}">
                  </div>
                  <div class='slick-slider-title'>
                    <h3>{{$post->title}}</h3>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
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
<link href="{{ asset('slick/slick.css') }}" rel="stylesheet">
<link href="{{ asset('slick/slick-theme.css') }}" rel="stylesheet">
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

  .pb-cmnt-container {
      font-family: Lato;
      margin-top: 100px;
  }

  .pb-cmnt-textarea {
      resize: none;
      padding: 20px;
      height: 130px;
      width: 100%;
      border: 1px solid #F2F2F2;
  }


  .panel-shadow {
      box-shadow: rgba(0, 0, 0, 0.3) 7px 7px 7px;
  }
  .panel-white {
    border: 1px solid #dddddd;
  }
  .panel-white  .panel-heading {
    color: #333;
    background-color: #fff;
    border-color: #ddd;
  }
  .panel-white  .panel-footer {
    background-color: #fff;
    border-color: #ddd;
  }

  .post .post-heading {
    height: 95px;
    padding: 20px 15px;
  }
  .post .post-heading .avatar {
    width: 60px;
    height: 60px;
    display: block;
    margin-right: 15px;
  }
  .post .post-heading .meta .title {
    margin-bottom: 0;
  }
  .post .post-heading .meta .title a {
    color: black;
  }
  .post .post-heading .meta .title a:hover {
    color: #aaaaaa;
  }
  .post .post-heading .meta .time {
    margin-top: 8px;
    color: #999;
  }
  .post .post-image .image {
    width: 100%;
    height: auto;
  }
  .post .post-description {
    padding: 0px 10px 0px 15px;
  }
  .post .post-description p {
    font-size: 14px;
    margin-top: 0px;
    margin-bottom: 10px;
  }
  .post .post-description .stats {
    margin-top: 20px;
  }
  .post .post-description .stats .stat-item {
    display: inline-block;
    margin-right: 15px;
  }
  .post .post-description .stats .stat-item .icon {
    margin-right: 8px;
  }
  .post .post-footer {
    border-top: 1px solid #ddd;
    padding: 15px;
  }
  .post .post-footer .input-group-addon a {
    color: #454545;
  }
  .post .post-footer .comments-list {
    padding: 0;
    margin-top: 20px;
    list-style-type: none;
  }
  .post .post-footer .comments-list .comment {
    display: block;
    width: 100%;
    margin: 20px 0;
  }
  .post .post-footer .comments-list .comment .avatar {
    width: 35px;
    height: 35px;
  }
  .post .post-footer .comments-list .comment .comment-heading {
    display: block;
    width: 100%;
  }
  .post .post-footer .comments-list .comment .comment-heading .user {
    font-size: 14px;
    font-weight: bold;
    display: inline;
    margin-top: 0;
    margin-right: 10px;
  }
  .post .post-footer .comments-list .comment .comment-heading .time {
    font-size: 12px;
    color: #aaa;
    margin-top: 0;
    display: inline;
  }
  .post .post-footer .comments-list .comment .comment-body {
    margin-left: 50px;
  }
  .post .post-footer .comments-list .comment > .comments-list {
    margin-left: 50px;
  }
</style>
@stop