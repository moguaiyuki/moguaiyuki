@extends('layouts.admin')

@section('content')

    <h1>本一覧</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>画像</th>
            <th>タイトル</th>
            <th>状態</th>
            <th>yonda</th>
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
                <td>{{$book->status}}</td>
                <td>{{$book->yonda}}</td>
                <td>
                    @foreach ($book->tags as $tag)
                        @if ($loop->last)
                            {{$tag->name}}
                        @else
                            {{$tag->name . ','}}
                        @endif
                    @endforeach
                </td>
                <td><a href="{{route('admin.books.edit', $book->id)}}">編集</a>・削除</td>
            </tr>
        @empty
            <tr>
                <td>本はありません</td>
            </tr>
        @endif
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$books->render()}}
        </div>
    </div>

@stop