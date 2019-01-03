@if(Auth::check())
  <div class="row user-infor1" style="border: 1px solid;">
    <div class="col-12 user-infor">
      <a href="https://www.facebook.com/zoro.kunkun">
        <img width='100%' class="circles" src="https://scontent.fhan4-1.fna.fbcdn.net/v/t31.0-8/860425_695227343875090_8043973826892118225_o.jpg?_nc_cat=104&_nc_ht=scontent.fhan4-1.fna&oh=6d594f7f03076f13843933e8bcbad27a&oe=5C98F807">
      </a>
      <hr />
    </div>

    <div class="col-12 user-infor">
      <p>{{Auth::user()->name}}</p>
      <p>Tuổi: 19</p>
      <p>Giới tính: Nam</p>
      <p>Bài viết: 100</p>
      <p>Đã thích: 100</p>
      <p>Được thích: 100</p>
      <form  id="logoutForm" action="{{ route('logout') }}" method="POST">
        {{ csrf_field() }}
        <p id="logout" class="fa fa-sign-out">Logout</p>
      </form>
    </div>
  </div>
@else
  <a href="{{route('login')}}">Login</a>
@endif
@section('js')
<script type="text/javascript">
    $('#logout').on('click', function(){
      var conf = confirm('Bạn có muốn đăng xuất???');
      if(conf) {
        $('#logoutForm').submit();
        return true;
      }
      return false;
    });
</script>
@stop
