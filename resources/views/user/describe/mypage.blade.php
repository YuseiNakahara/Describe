@extends ('layouts.index')
@section ('content')

<body>
  <div class="box">
    <div class="main">
      <h2 class="brand-header">MyPage</h2>
        <div class="container">
          {!! Form::open(['route' => 'describe.index', 'method' => 'GET']) !!}
            <article class="Item_content">
              @foreach ($describes as $describe)
                <div class="form-main">
                  <img src="" class="avatar-img">
                  <a class="postImage" href="{{ $describe['image_url'] }}">
                    <div class="imgbox">
                      <img width="100%" height="200" src="{{ $describe['image_url'] }}">
                    </div>
                  </a>
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
                      <span class="point-color">{{ count($describe->comments) }}</span>
                      <i class="far fa-heart"></i>
                      <span class="pointer">{{ count($describe->hearts) }}</span>
                    </div>
                    <div class="show">
                        <a
                        class="btn btn-success"
                        href="route('describe.edit', $describe->id)">
                        編集
                        </a>
                    </div>
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
