@extends('layouts.admin')

@section('content')

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>アイコン</th>
                <th>名前</th>
                <th>メール</th>
                <th>権限</th>
                <th>編集・削除</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><img height="50" src="{{$user->image ? $user->image->path : ''}}" alt="image"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->role ? $user->role->name : ''}}</td>
                <td><a href="{{route('admin.users.edit', $user->id)}}">編集</a>・削除</td>
            </tr>
            @empty
            <tr>
                <p>ユーザーなし</p>
            </tr>
            @endforelse
        </tbody>
    </table>

@stop