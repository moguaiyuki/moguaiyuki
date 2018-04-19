@extends('layouts.admin')

@section('content')

    <h1>本登録</h1>

    {!! Form::open(['method'=>'POST', 'action'=>'Admin\BooksController@searchBooksInfo']) !!}
    <div class="form-group">
        {!! Form::label('book', '本検索:') !!}
        {!! Form::text('book', null, ['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('検索', ['class'=>'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
    @if(isset($json_decode))
        @foreach (array_chunk($json_decode['items'], 4, true) as $row)
            <div class="row">
                <div class="card-deck">
                    @foreach($row as $item)
                        <div class="well mb-3">
                            @if (isset($item['volumeInfo']['imageLinks']))
                                <img src="{{$item['volumeInfo']['imageLinks'] ? $item['volumeInfo']['imageLinks']['thumbnail'] : ''}}"
                                     alt=""
                                     class="well-img-top img-fluid">
                            @endif
                            <div class="well-body">

                                <h4 class="well-title">{{$item['volumeInfo']['title']}}</h4>
                                @if (isset($item['volumeInfo']['authors']))
                                    <small class="text-muted">written by {{$item['volumeInfo']['authors'][0]}}</small>
                                @endif
                                @if (isset($item['volumeInfo']['description']))
                                    <hr>
                                    <p class="card-text">{!! str_limit($item['volumeInfo']['description'], 300) !!}</p>
                                @endif
                                <hr>
                                {!! Form::open(['method'=>'POST', 'action'=>'Admin\BooksController@store', 'files'=>true]) !!}
                                {!! Form::hidden('title', $item['volumeInfo']['title'], ['class'=>'form-control']) !!}
                                @if (isset($item['volumeInfo']['authors']))
                                    {!! Form::hidden('author', $item['volumeInfo']['authors'][0], ['class'=>'form-control']) !!}
                                @endif
                                @if (isset($item['volumeInfo']['description']))
                                    {!! Form::hidden('description', $item['volumeInfo']['description'] , ['class'=>'form-control']) !!}
                                @endif
                                @if (isset($item['volumeInfo']['imageLinks']))
                                    {!! Form::hidden('image_url', $item['volumeInfo']['imageLinks']['thumbnail'], ['class'=>'form-control']) !!}
                                @else
                                    <div class="form-group">
                                        {!! Form::label('image_id', '画像:') !!}
                                        {!! Form::file('image_id', null, ['class'=>'form-control']) !!}
                                    </div>
                                @endif
                                <div class="form-group">
                                    {!! Form::label('amazon_url', 'URL:') !!}
                                    {!! Form::text('amazon_url', null, ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('tag', 'タグ:') !!}
                                    @forelse($tags as $tag_id => $tag_name)
                                        {!! Form::label($tag_name, $tag_name) !!}
                                        {!! Form::checkbox('tag[]', $tag_id, false, ['class'=>'checkbox-inline', 'id'=>$tag_name]) !!}
                                    @empty
                                        現在本に関連するタグは登録されていません
                                    @endforelse
                                </div>
                                <div class="form-group" id="tag">
                                    {!! Form::label('name', '新規タグ:') !!}
                                    {!! Form::button('タグ追加', ['class'=>'btn btn-success add_tag', 'id'=>'add_tag']) !!}
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
                                    {!! Form::checkbox('is_bookshelf', 1, ['class'=>'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('登録', ['class'=>'btn btn-primary']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::submit('続けてレビューも登録する', ['class'=>'btn btn-info', 'id'=>'review']) !!}
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        {!! Form::open(['method'=>'POST', 'action'=>'Admin\BooksController@store', 'files'=>true]) !!}
        <div class="form-group">
            {!! Form::label('title', 'タイトル:') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('author', '著者:') !!}
            {!! Form::text('author', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', '概要:') !!}
            {!! Form::text('description', null, ['class'=>'form-control']) !!}
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
            {!! Form::label('tag', 'タグ:') !!}
            @forelse($tags as $tag_id => $tag_name)
                {!! Form::label($tag_name, $tag_name) !!}
                {!! Form::checkbox('tag[]', $tag_id, false, ['class'=>'checkbox-inline', 'id'=>$tag_name]) !!}
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
            {!! Form::checkbox('is_bookshelf', 1, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('登録', ['class'=>'btn btn-primary']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('続けてレビューも登録する', ['class'=>'btn btn-info', 'id'=>'review']) !!}
        </div>
        {!! Form::close() !!}

    @endif
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
            $('.add_tag').click(function () {
                /*$('<input>').attr({
                    type: 'text',
                    name: 'name[]',
                    value: '',
                    class: 'form-control col-sm-2'
                }).after(this);*/
                $(this).after('<input type="text" name="name[]" value="" class="form-control col-sm-2">')
            });
        });
    </script>

@endsection