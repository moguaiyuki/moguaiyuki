@extends('layouts.admin')

@section('content')

    <h1>TED TALK 登録</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'Admin\TedTalksController@store', 'files'=>true]) !!}
    
    <div class="form-group">
        {!! Form::label('title', 'タイトル:') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('presenter', 'プレゼンター:') !!}
        {!! Form::text('presenter', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('url', 'URL:') !!}
        {!! Form::text('url', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('', 'プレゼン公開日:') !!}
        {!! Form::selectRange('presented_year', 1990, 2018, 2000) !!}
        年
        {!! Form::selectRange('presented_month', 1, 12) !!}
        月
    </div>
    <div class="form-group">
        {!! Form::label('image_id', ' 画像:') !!}
        {!! Form::file('image_id', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('subtitle', '日本語字幕:') !!}
        あり
        {!! Form::radio('subtitle', '1', ['class'=>'form-control']) !!}
        なし
        {!! Form::radio('subtitle', '0', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_favorite', 'お気に入り:') !!}
        {!! Form::checkbox('is_favorite', '1', ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('status', 'ステータス:') !!}
        見たい
        {!! Form::radio('status', '0', ['class'=>'form-control']) !!}
        見た
        {!! Form::radio('status', '1', ['class'=>'form-control']) !!}
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