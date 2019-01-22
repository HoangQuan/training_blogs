<div class="panel panel-white post panel-shadow" style="margin-bottom: 10px;">
  <div class="post-heading">
      <div class="pull-left image" style="width: 15%; float: left;">
          <img src="https://lorempixel.com/640/480/" class="img-circle avatar" alt="user profile image" width="100%">
      </div>
      <div class="pull-left meta" style="width: 65%; float: left;">
          <div class="title h5">
              <a href="#"><b>{{$comment->user->name}}</b></a>
              made a post.
          </div>
          <h6 class="text-muted time">{{$comment->created_at->diffForHumans()}}</h6>
      </div>
  </div> 
  <div class="post-description"> 
      <p>{{$comment->content}}</p>
      <!-- <div class="stats">
          <a href="#" class="btn btn-default stat-item">
              <i class="fa fa-thumbs-up icon"></i>2
          </a>
          <a href="#" class="btn btn-default stat-item">
              <i class="fa fa-thumbs-down icon"></i>12
          </a>
      </div> -->
  </div>
</div>
