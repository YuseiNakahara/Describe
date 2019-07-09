@extends ('layouts.index')
@section ('content')

<body>
  <div class="box">
    <div class="main">
      <div class="icon-search">
        <a href="{{ route('describe.index') }}" class="fas fa-search fa-2x"><a>
        {!! Form::input('text', 'searchword', empty($searchword['keyword']) ? null : $searchword['keyword'], ['class' => 'search-text', 'placeholder' => 'Search words...']) !!}
      </div>
      <h2 class="brand-header">投稿一覧</h2>
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
                    <div class="user-name">
                      <i class="fas fa-user-alt"></i>
                      <p class="user">{{ Auth::user()->name }}</p>
                    </div>
                  </div>
                  <div class="show">
                    <a
                      class="btn btn-primary"
                      href="describe/{{ $describe->id }}">
                      詳細
                    </a>
                  </div>
                </div>
              @endforeach
            </article>
            <div class="paginate">
              {{ $paginate->links() }}
            </div>
          {!! Form::close() !!}
        </div>
    </div>
</body>

@endsection