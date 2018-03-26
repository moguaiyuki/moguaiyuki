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
            </tr>
        @empty
            <tr>
                <td>本はありません</td>
            </tr>
        @endif
        </tbody>
    </table>

@stop