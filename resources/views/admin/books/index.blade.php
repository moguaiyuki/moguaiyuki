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
        </tr>
        </thead>
        <tbody>
        @forelse($books as $book)
            <tr>
                <td>{{$book->id}}</td>
                <td><img height="50" src="{{$book->image ? $book->image->path : ''}}" alt=""></td>
                <td>{{$book->title}}</td>
                <td>{{$book->status}}</td>
                <td>{{$book->yonda}}</td>
                <td>@forelse ($book->tags as $tag)
                        @if ($loop->last)
                            {{$tag->name}}
                        @else
                            {{$tag->name . ','}}
                        @endif
                    @empty
                        タグはありません　
                    @endforelse
                </td>
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