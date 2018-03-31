@extends('layouts.admin')

@section('styles')
@stop

@section('content')
    @include('includes.tiny_mce_editor')

    <h1>旅行編集</h1>

    {!! Form::model($travel, ['method'=>'PATCH', 'action'=>['Admin\TravelsController@update', $travel->id], 'files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('title', 'タイトル:') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('content', '内容:') !!}
        {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('country', '国名（英語表記）:') !!}
        {!! Form::text('country', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('image_id', '画像:') !!}
        {!! Form::file('image_id', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tag', 'タグ:') !!}
        @forelse($tags as $tag_id => $tag_name)
            {!! Form::label($tag_name, $tag_name) !!}
            {!! Form::checkbox('tag[]', $tag_id, in_array($tag_id, $travel_tags), ['class'=>'checkbox-inline', 'id'=>$tag_name]) !!}
        @empty
            現在旅行に関連するタグは登録されていません
        @endforelse
    </div>
    <div class="form-group" id="tag">
        {!! Form::label('name', '新規タグ:') !!}
        {!! Form::button('タグ追加', ['class'=>'btn btn-success', 'id'=>'add_tag']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('start_date', '旅のはじまり:') !!}
        {!! Form::date('start_date', null) !!}
    </div>
    <div>
        {!! Form::label('end_date', '旅のおわり:') !!}
        {!! Form::date('end_date', null) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_published', '公開ステータス') !!}
        @foreach(config('admin.publish_status') as $key => $value)
            {!! Form::label('$value', $value) !!}
            {!! Form::radio('is_published', $key, null, ['id'=>'$value']) !!}
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::submit('登録', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

@stop

@section('scripts')
    {{--タグフォームの追加--}}
    <script>
        $(document).ready(function () {
            $('#add_tag').click(function () {
                $('<input>').attr({
                    type: 'text',
                    name: 'name[]',
                    value: '',
                    class: 'form-control col-sm-2'
                }).appendTo('#tag');
            });
        });
    </script>
@stop