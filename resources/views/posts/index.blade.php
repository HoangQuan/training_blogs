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
        <div class="col-lg-8 col-md-10 mx-auto">
          @if(Session::has('post_create'))
            <p class="alert {{ Session::has('post_create') ? 'alert-info' : '' }}">{{ Session::get('post_create') }}</p>
          @endif
          <div id='list-posts'>
            @include('posts._list')
          </div>

          {{ $posts->links() }}
          <!-- Pager -->
          <div class="clearfix" id="load_more_div" >
            <a class="btn btn-primary float-right" data-href='#' onclick="loadMore();">Older Posts &rarr;</a>
          </div>
        </div>
        <div class="col-3">
          @include('partials.user_infor')
        </div>
      </div>
      </div>
    </div>
    <hr>
@stop


@section('css')
<link rel="stylesheet" type="text/css" href="/css/posts.css">
@stop

@section('js')
  <script type="text/javascript">
    hasMore = "{{ $posts->hasMorePages()}}";
    if (hasMore) {
      html = '<a class="btn btn-primary float-right" onclick="loadMore();" data-href="{{$posts->nextPageUrl()}}">Older Posts &rarr;</a>'
    }    
    $('#load_more_div').html(html);

    // $(document).ready(function() {
      function loadMore(){
        var url = $('#load_more_div .float-right').data('href');
        console.log(url);
        $.ajax({
            type : 'GET',
            url: url,
            success : function(data){
              console.log(data);
              if(data.length == 0){
              }else{
                $('#list-posts').append(data.html);
                if(data.hasMore)
                  var html = '<a class="btn btn-primary float-right" onclick="loadMore();" data-href="' + data.url + '">Older Posts &rarr;</a>';
                else
                  html = '';
                $('#load_more_div').html(html);
              }
            },error: function(data){

            },
        })
      };
    // });
  </script>
@stop