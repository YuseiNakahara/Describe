@extends ('layouts.index')
@section ('content')
@include('user.describe._script')

<h1 class="brand-header">投稿詳細</h1>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      <img src="" class="avatar-img">
      <div class="panel-show">
        {{ $describe->title}}の内容
        <td class="col-xs-1">
            {!! Form::open(['route' => ['describe.destroy', $describe->id], 'method' => 'DELETE']) !!}
            <button class="btn btn-danger" type="submit">
                <i class="fa fa-trash-o" aria-hidden="true">削除</i>
            </button>
            {!! Form::close() !!}
        </td>
      </div>
      <p class="create-date">{{ $describe->created_at }}</p>
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $describe->title }}</td>
          </tr>
          <tr>
            <th class="table-column">Content</th>
            <td class='td-text'>{{ $describe->content }}</td>
          </tr>
          <tr>
            <th class="table-column">サイト画像</th>
            <td class='td-text'>{{ $describe->image_url }}</td>
          </tr>
          <tr>
            <th class="table-column">サイトURL</th>
            <td class='td-text'>{{ $describe->url }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="show-comment">
        <p class="all-comment"></p>
    </div>
  </div>
  <div class="comment">
    @foreach($describe->comments as $comment)
        <div class="comment-wrap">
            <i class="fas fa-user-alt">
                {{ Auth::user()->name }}
            </i>
            <div class="comment-list">
                {{ $comment->comment }}
                @if(Auth::id() === $comment->user_id)
                    <i id="btn_open" class="fas fa-ellipsis-h fa-2x">
                        <div id="modal">
                            <div id="modal_content">
                                {!! Form::open(['route' => ['describe.deletecomment', $comment->id], 'method' => 'DELETE']) !!}
                                    <p>{{ $comment->comment }}
                                    <button class="btn_close" href="">削除</button></p>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </i>
                @else
                        <div id="modal">
                            <div id="modal_content">
                                <p>{{ $comment->comment }}</p>
                            </div>
                        </div>
                @endif
            </div>
        </div>
    @endforeach
  <div class="comment-box">
    {!! Form::open(['route' => 'describe.comment', $describe->id, 'method' => 'GET']) !!}
    {!! Form::input('hidden', 'user_id', Auth::id()) !!}
    {!! Form::input('hidden', 'describe_id', $describe->id) !!}
      <div class="comment-title">
        <img src="" class="avatar-img"><p>コメントの投稿</p>
      </div>
      <div class="comment-body">
        {!! Form::textarea('comment', null, ['class' => 'form-control', 'placeholder' => 'Please comment...']) !!}
        <span class="help-block"></span>
        <div class="comment-bottom">
            <button type="submit" class="btn btn-success">
                <i class="far fa-comments"></i>
            </button>
        </div>
    {!! Form::close() !!}
  </div>
@endsection

