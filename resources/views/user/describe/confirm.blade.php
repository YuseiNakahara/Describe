@extends ('layouts.index')
@section ('content')

<div class=all>
    <h2 class="confirm-header">投稿内容確認</h2>
    <div class="main-wrap">
    <div class="panel panel-success">
        <div class="panel-confirm">
          投稿内容
        </div>
        <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tbody>
            <tr>
                <th class="table-column">Title</th>
                <td class="td-text">{{ $inputs['title'] }}</td>
            </tr>
            <tr>
                <th class="table-column">Content</th>
                <td class='td-text'>{{ $inputs['content'] }}</td>
            </tr>
            <tr>
                <th class="table-column">URL</th>
                <td class='td-text'>{{ $inputs['url'] }}</td>
            </tr>
            </tbody>
        </table>
        </div>
    </div>
    <div class="btn-bottom-wrapper">
        {!! Form::open(['route' => 'describe.store', 'method' => 'POST']) !!}
        {!! Form::hidden('user_id', Auth::id()) !!}
        {!! Form::hidden('title', $inputs['title']) !!}
        {!! Form::hidden('content', $inputs['content']) !!}
        {!! Form::hidden('url', $inputs['url']) !!}
        <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button>
        {!! Form::close() !!}
    </div>
</div>


@endsection

