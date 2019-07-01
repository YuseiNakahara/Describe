@extends ('layouts.index')
@section ('content')

<h1 class="brand-header">投稿編集</h1>

<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'describe.update', $describe->id, 'method' => 'PUT']) !!}
      <div class="form-group">
        <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
      </div>
      <div class="form-group">
        {!! Form::input('text', 'title', $describe->title, ['class' => 'form-control', 'placehoder' => 'Title']) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', $describe->content, ['class' => 'form-control', 'placehoder' => 'Post Editing...']) !!}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      <div class="form-group">
          {!! Form::input('text', $describe->url, ['class' => 'form-control', 'placehoder' => 'URL']) !!}
      </div>
      {!! Form::submit('update', ['name' => 'confirm', 'class'  => 'btn btn-success pull-right'])!!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

