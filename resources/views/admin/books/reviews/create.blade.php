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
        {!! Form::label('status', 'ステータス：') !!}
        下書き
        {!! Form::radio('status', 0, ['class'=>'form-control']) !!}
        公開
        {!! Form::radio('status', 1, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop

@section('scripts')

@stop