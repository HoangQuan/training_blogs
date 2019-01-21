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
    <span class="fa fa-eye" aria-hidden="true">{{(int)$post->view_count}}</span>
    <span class="fa fa-thumbs-up" aria-hidden="true">{{(int)$post->like_count}}</span>
    <span class="fa fa-thumbtack" aria-hidden="true">1000</span>
    <p class="post-meta">Posted by
      <!-- {{ $post->user_id }} -->
      <a href="">{{ $post->user->email }}</a>
      at {{$post->created_at}}</p>
  </div>
  <hr>
@endforeach