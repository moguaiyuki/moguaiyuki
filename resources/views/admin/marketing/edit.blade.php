@extends('layouts.admin')

@section('content')
    @include('includes.tiny_mce_editor')

    <h1>マーケテイング編集</h1>

    {!! Form::model($marketing, ['method'=>'PATCH', 'action'=>['Admin\MarketingController@update', $marketing->id], 'files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('title', 'タイトル:') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('slug_title', 'slug用タイトル[英語表記]:') !!}
        {!! Form::text('slug_title', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('content', '内容:') !!}
        {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('image_id', '画像:') !!}
        {!! Form::file('image_id', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tag', 'タグ:') !!}
        @forelse($tags as $tag_id => $tag_name)
            {!! Form::label($tag_name, $tag_name) !!}
            {!! Form::checkbox('tag[]', $tag_id, in_array($tag_id, $marketing_tags), ['class'=>'checkbox-inline', 'id'=>$tag_name]) !!}
        @empty
            現在本に関連するタグは登録されていません
        @endforelse
    </div>
    <div class="form-group" id="tag">
        {!! Form::label('name', '新規タグ:') !!}
        {!! Form::button('タグ追加', ['class'=>'btn btn-success', 'id'=>'add_tag']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_published', '公開ステータス：') !!}
        @foreach(config('admin.publish_status') as $key => $value)
            {!! Form::radio('is_published', $key, $loop->first? true : null) !!}{{$value}}
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::submit('登録', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}

@stop

@section('scripts')
    {{--新規タグ--}}
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
@endsection