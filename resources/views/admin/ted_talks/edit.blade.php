@extends('layouts.admin')

@section('content')

    <h1>TED TALK 編集</h1>

    {!! Form::model($talk, ['method'=>'PATCH', 'action'=>['Admin\TedTalksController@update', $talk->id], 'files'=>true]) !!}

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
        {!! Form::radio('subtitle', 1, null) !!}
        なし
        {!! Form::radio('subtitle', 0, null) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tag', 'タグ:') !!}
        @forelse($tags as $tag_id => $tag_name)
            {!! Form::label($tag_name, $tag_name) !!}
            {!! Form::checkbox('tag[]', $tag_id, in_array($tag_id, $talk_tags), ['class'=>'checkbox-inline', 'id'=>$tag_name]) !!}
        @empty
            現在TED TALKに関連するタグは登録されていません
        @endforelse
    </div>
    <div class="form-group" id="tag">
        {!! Form::label('name', '新規タグ:') !!}
        {!! Form::button('タグ追加', ['class'=>'btn btn-success', 'id'=>'add_tag']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('is_favorite', 'お気に入り:') !!}
        {!! Form::checkbox('is_favorite', 1, null) !!}
    </div>
    <div class="form-group">
        {!! Form::label('status', 'ステータス:') !!}
        見たい
        {!! Form::radio('status', 0, null) !!}
        見た
        {!! Form::radio('status', 1, null) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('登録', ['class'=>'btn btn-primary']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('続けてレビューも編集する', ['class'=>'btn btn-info', 'id'=>'review']) !!}
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