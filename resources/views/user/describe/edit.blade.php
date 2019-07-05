@extends ('layouts.index')
@section ('content')

<div class="edit-title">
  <h1 class="brand-header">投稿編集</h1>
</div>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['describe.update', $describes->id], 'method' => 'PUT']) !!}
      <div class="form-group {{ $errors->has('title')? 'has-error' : '' }}">
        {!! Form::input('text', 'title', $describes->title, ['class' => 'form-control']) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group {{ $errors->has('title')? 'has-error' : '' }}">
        {!! Form::input('text', 'URL', $describes->url, ['class' => 'form-control']) !!}
        <span class="help-block">{{ $errors->first('url') }}</span>
      </div>
      <div class="form-group {{ $errors->has('content')? 'has-error' : '' }}">
        {!! Form::textarea('content', $describes->content, ['class' => 'form-control']) !!}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {!! Form::submit('更新', ['name' => 'update', 'class'  => 'btn btn-success pull-right'])!!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

