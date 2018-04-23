@extends('layouts.admin')

@section('content')

    <h1>本一覧</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>画像</th>
            <th>タイトル</th>
            <th>レビュー記事</th>
            <th>状態</th>
            <th>本棚</th>
            <th>タグ</th>
            <th>編集・削除</th>
        </tr>
        </thead>
        <tbody>
        @forelse($books as $book)
            <tr>
                <td>{{$book->id}}</td>
                <td><img height="50" src="{{$book->image ? $book->image->path : ''}}" alt=""></td>
                <td><a href="{{route('admin.books.show', $book->id)}}">{{$book->title}}</a></td>
                <td>@if($book->review)<a href="{{route('books.show', $book->review->slug)}}">レビュー</a>@else <a href="{{route('admin.books.reviews.register', $book->id)}}">レビュー登録</a> @endif</td>
                <td>{{config('admin.book_status')[$book->status]}}</td>
                <td>{{$book->is_bookshelf==1 ? "本棚" : ""}}</td>
                <td>
                    @foreach ($book->tags as $tag)
                        {{$loop->last ? $tag->name : $tag->name . ','}}
                    @endforeach
                </td>
                <td>
                    <a href="{{route('admin.books.edit', $book->id)}}">編集</a>
                    ・
                    <a class="dropdown-item" href="#"
                       onclick="event.preventDefault();
                                                     document.getElementById({{$book->id}}).submit();">
                        削除
                    </a>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\BooksController@destroy', $book->id], 'id'=>$book->id, 'style'=>'display: none;']) !!}
                    {!! Form::submit('') !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @empty
            <tr>
                <td>本はありません</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$books->render()}}
        </div>
    </div>

@stop