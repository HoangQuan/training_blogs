@foreach($posts as $post)
  <div class="post-preview">
    <div class="index-img-list"><img src="{{$post->image_url}}"></div>
    <div index-content>
      <a href="{{ route('posts.show', ['id'=> $post->id])}}">
        <h3 class="post-title">
          {{ $post->title}}
        </h3>
      </a>
      <p class="post-subtitle">
        {!! str_limit($post->content, $limit = 100, $end = trans('common.view_more')) !!}
      </p>
    </div>
    <p class="post-meta">Posted by
      <a href="#">Quanhv</a>
      on {{$post->created_at}}</p>
  </div>
  <hr>
@endforeach