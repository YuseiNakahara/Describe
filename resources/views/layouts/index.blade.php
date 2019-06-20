<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Describe</title>
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('/cssbootstrap.css') }}" rel="stylesheet">
  <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Stanley
    Template URL: https://templatemag.com/stanley-bootstrap-freelancer-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <!-- Static navbar -->
    <div class="header">
        <div class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ route('describe.index') }}">Describe</a>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar-left">

    </div>

    @yield('content')

    <div id="copyrights">
        <div class="container">
        <p>
            &copy; <strong>Describe</strong>. All Rights Reserved
        </p>
        <div class="credits">
            Created with Describe project by <a href="https://twitter.com/">TwitterDM</a>
        </div>
        </div>
    </div>
    <div class="fotter">
        <div class="icon-tag">
            <div class="icon">
                <a href="" class="fas fa-home fa-3x"></a>
            </div>
            <div class="icon">
                <a href="" class="fas fa-search fa-3x"><a>
            </div>
            <div class="icon">
                <a href="{{ route('describe.create') }}" class="far fa-plus-square fa-3x"></a>
            </div>
            <div class="icon">
                <a href="" class="far fa-heart fa-3x"><a>
            </div>
            <div class="icon">
                <a href="" class="far fa-user fa-3x"><a>
            </div>
        </div>
    </div>


    <!-- JavaScript Libraries -->
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/php-mail-form/validate.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

    <!-- Template Main Javascript File -->
    <script src="js/main.js"></script>

</body>
</html>
