@extends('layouts.admin')

@section('content')

    <h1>本登録</h1>

    {!! Form::model($book, ['method'=>'PATCH', 'action'=>['Admin\BooksController@update', $book->id], 'files'=>true]) !!}
    <div class="form-group">
        {!! Form::label('title', 'タイトル:') !!}
        {!! Form::text('title', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('author', '著者:') !!}
        {!! Form::text('author', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        <div>
            <img height="50" src="{{$book->image ? $book->image->path : ''}}" alt="">
        </div>
        <!-- laravel file manager -->
        <div class="input-group">
        <span class="input-group-btn">
            <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
            <i class="fa fa-picture-o"></i> 画像選択
            </a>
        </span>
            <input id="thumbnail" class="form-control" type="text" name="filepath">
        </div>
        <img id="holder" style="margin-top:15px;max-height:100px;">
        <!-- /laravel file manager -->
    </div>
    <div class="form-group">
        {!! Form::label('amazon_url', 'URL:') !!}
        {!! Form::text('amazon_url', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('tag', 'タグ:') !!}
        @forelse($tags as $tag_id => $tag_name)
            {!! Form::label($tag_name, $tag_name) !!}
            {!! Form::checkbox('tag[]', $tag_id, in_array($tag_id, $book_tags), ['class'=>'checkbox-inline', 'id'=>$tag_name]) !!}
        @empty
            現在本に関連するタグは登録されていません
        @endforelse
    </div>
    <div class="form-group" id="tag">
        {!! Form::label('name', '新規タグ:') !!}
        {!! Form::button('タグ追加', ['class'=>'btn btn-success', 'id'=>'add_tag']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('status', '状態:') !!}
        @foreach(config('admin.book_status') as $key => $value)
            @if($loop->first)
                {!! Form::radio('status', $key, true, null) !!} {{$value}}
            @else
                {!! Form::radio('status', $key, null) !!} {{$value}}
            @endif
        @endforeach
    </div>
    <div class="form-group">
        {!! Form::label('is_bookshelf', '本棚:') !!}
        {!! Form::checkbox('is_bookshelf', 1, null) !!}
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
        $(document).ready(function () {
            $('#review').click(function () {
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

@stop