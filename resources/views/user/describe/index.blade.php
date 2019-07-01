@extends ('layouts.index')
@section ('content')

<body>
  <div class="box">
    <div class="main">
      <h2 class="brand-header">投稿一覧</h2>
        <div class="container">
          {!! Form::open(['route' => 'describe.index', 'method' => 'GET']) !!}
            <article class="Item_content">
              @foreach ($describes as $describe)
                <div class="form-main">
                  <img src="" class="avatar-img">
                  <a class="postImage" href=""><img width="240" height="170" src="{{ $describe['image_url'] }}"></a>
                  <div class="form-one">
                    <p class="form-group">
                      <a class="title-url" href="{{$describe->url}}">{{ $describe->title }}</a>
                    </p>
                    <div class="form-group">
                      <span class="help-block">{{ $describe->content }}</span>
                    </div>
                    <div class="form-group">
                      <a class="help-block" href="{{$describe->url}}">{{ $describe->url }}</a>
                    </div>
                    <div  class="Item_title">
                      <a class="user_icon"></a>
                    </div>
                    <div class="form-group">
                      <i class="far fa-comment-alt"></i>
                      <span class="point-color">{{ count($describe->comment) }}</span>
                    </div>
                  </div>
                  <div class="show">
                    <a
                      class="btn btn-primary"
                      href="{{ route('describe.show', $describe->id) }}">
                      詳細
                    </a>
                  </div>
                </div>
              @endforeach
            </article>
          {!! Form::close() !!}
        </div>
    </div>
  </div>
</body>

@endsection