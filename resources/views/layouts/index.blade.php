<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>Describe</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link
      href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
      rel="stylesheet"
    >
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="modal.js"></script>
    <link rel="stylesheet" href="modal.css">
    @include('user.describe._script')
  </head>
  <body>
      <header class="header list">
          <div class="navbar navbar-inverse navbar-static-top">
              <div class="navbar-header">
                <a
                  class="navbar-brand"
                  href="{{ route('describe.index') }}"
                >Describe</a>
                <a href="" class="fas fa-crow fa-3x"></a>
              </div>
              <ul>
                {!! Form::open(['route' => 'logout', Auth::id(), 'method' => 'POST']) !!}
                {!! Form::input('hidden', 'user_id', Auth::id()) !!}
                  <li class="navTitle"><i class="fas fa-chevron-down fa-2x"></i>
                    <ul class="subList">
                      <li><a class="logout" href="{{ route('logout') }}">LOGOUT</a></li>
                    </ul>
                  </li>
                {!! Form::close() !!}
              </ul>
          </div>
      </header>
      <main>
        @yield('content')
      </main>
      <footer>
      <div class="fotter">
          <div class="icon-tag">
              <div class="icon">
                <a
                  href="{{ route('describe.index') }}"
                  class="fas fa-home fa-3x">
                </a>
              </div>
              <div class="icon">
                <a
                  href="{{ route('describe.create') }}"
                  class="far fa-plus-square fa-3x">
                </a>
              </div>
              <div class="icon">
                  <a href="" class="far fa-heart fa-3x"><a>
              </div>
              <div class="icon">
                  <a
                    href="{{ route('describe.mypage') }}"
                    class="far fa-user fa-3x">
                  <a>
              </div>
          </div>
      </div>
      <script type="text/javascript">
        $(".navTitle").click(function(){
          var $subList = $(this).children('ul');
            if($subList.css('display') == 'none'){
              $subList.slideDown(500);
            }else{
              $subList.slideUp(500);
            }
        });
      </script>
    </footer>
  </body>
</html>
