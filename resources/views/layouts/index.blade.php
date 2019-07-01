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
  </head>
  <body>
      <div class="header">
          <div class="navbar navbar-inverse navbar-static-top">
              <div class="navbar-header">
                  <a
                    class="navbar-brand"
                    href="{{ route('describe.index') }}"
                  >Describe</a>
                  <a href="" class="fas fa-crow fa-3x"></a>
              </div>
              <input
                type="text"
                class="search-text"
                placeholder="SearchWords..."></input>
              <div class="icon-search">
                  <a href="" class="fas fa-search fa-2x"><a>
              </div>
              <p class="openBtn"><i class="fas fa-chevron-down fa-2x"></i></p>
              <p class="textArea">Logout</p>
          </div>
      </div>
  </body>
      @yield('content')
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
    </footer>
</html>
