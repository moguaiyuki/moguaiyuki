@extends('layouts.admin')

@section('content')
    @include('includes.tiny_mce_editor')

    <h1>TED TALKレビュー登録</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'Admin\TedReviewsController@store']) !!}
    <input type="hidden" name="talk_id" value="{{$talk_id}}">
    <div class="form-group">
        {!! Form::label('title', 'タイトル(slug用タイトルのため英語表記):') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('content', '内容:') !!}
        {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('status', 'ステータス：') !!}
        @foreach(config('admin.publish_status') as $key => $value)
            {!! Form::radio('status', $key, $loop->first? true : false) !!}{{$value}}
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::submit('登録', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
@stop

@section('scripts')

@stop