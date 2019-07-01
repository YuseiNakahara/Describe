@extends('layouts.index')
@section('content')

<div class=all>
  <h2 class="create-header">投稿画面</h2>
    <div class="main-wrap">
      {!! Form::open(['route' => 'describe.confirm', 'method' => 'GET']) !!}
        <div class="form-create">
          <input type="hidden" name="user_id" value='1'>
            <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
              <p class="help-block">
                {!! Form::input(
                              'text',
                              'title',
                              null,
                              [
                                'class' => 'form',
                                'placeholder' => 'title'
                              ])!!}
              </p>
              {{$errors->first('title')}}
            </div>
            <div class="form-group @if(!empty($errors->first('content'))) has-error @endif">
              <p class="help-block">
                {!! Form::textarea(
                                'content',
                                null,
                                [
                                  'class' => 'form-controll',
                                  'placeholder' => 'Please write here...'
                                ]) !!}
              </p>
              {{$errors->first('content')}}
            </div>
            <div class="form-group @if(!empty($errors->first('url'))) has-error @endif">
              <p class="help-block">
                {!! Form::input(
                              'text',
                              'url',
                              null,
                              [
                                'class' => 'form',
                                'placeholder' => 'URL'
                              ])!!}
              </p>
              {{$errors->first('url')}}
            </div>
            <button type="submit" class="btn btn-success pull">Add</button>
        </div>
      {!! Form::close() !!}
    </div>
</div>
@endsection