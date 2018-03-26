@extends('layouts.admin')

@section('content')

    <h1>本登録</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'Admin\BooksController@store', 'files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('title', 'Title:') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('author', '著者:') !!}
        {!! Form::text('author', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('image_id', '画像:') !!}
        {!! Form::file('image_id', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('amazon_url', 'URL:') !!}
        {!! Form::text('amazon_url', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('status', '状態:') !!}
        買いたい
        {!! Form::radio('status', 0, null) !!}
        積読
        {!! Form::radio('status', 1, null) !!}
        読んでる
        {!! Form::radio('status', 2, null) !!}
        読んだ
        {!! Form::radio('status', 3, null) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_bookshelf', '本棚:') !!}
        {!! Form::checkbox('is_bookshelf', 1, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('登録', ['class'=>'btn btn-primary']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('続けてレビューも登録する', ['class'=>'btn btn-info', 'id'=>'review']) !!}
    </div>
    {!! Form::close() !!}

@stop

@section('scripts')
    {{--レビューの登録有無--}}
    <script>
        $(document).ready(function(){
            $('#review').click(function(){
                $('<input>').attr({
                    type: 'hidden',
                    name: 'review',
                    value: '1'
                }).appendTo('form');
            });
        });
    </script>

@endsection