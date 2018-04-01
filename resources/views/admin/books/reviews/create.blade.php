@extends('layouts.admin')

@section('content')
    @include('includes.tiny_mce_editor')

    <h1>本レビュー登録</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'Admin\BookReviewsController@store']) !!}
    <input type="hidden" name="book_id" value="{{$book_id}}">
    <div class="form-group">
        {!! Form::label('title', 'タイトル:') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('content', '内容:') !!}
        {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('status', '公開ステータス：') !!}
        @foreach(config('admin.publish_status') as $key => $value)
            {!! Form::radio('status', $key, $loop->first? true : null) !!}{{$value}}
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::submit('登録', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop

@section('scripts')

@stop