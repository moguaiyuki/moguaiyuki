@extends('layouts.admin')

@section('content')

    <h1>プログラミング一覧</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>画像</th>
            <th>タイトル</th>
            <th>内容</th>
            <th>タグ</th>
            <th>公開ステータス</th>
            <th>登録日</th>
            <th>編集・削除</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($programings as $programing)
            <tr>
                <td>{{$programing->id}}</td>
                <td><img width="50" src="{{$programing->image ? $programing->image->path : ''}}" alt=""></td>
                <td><a href="{{route('admin.programing.show', $programing->id)}}">{{$programing->title}}</a></td>
                <td>{!! str_limit($programing->content,30) !!}</td>
                <td>
                    @foreach ($programing->tags as $tag)
                        {{$loop->last ? $tag->name : $tag->name . ','}}
                    @endforeach
                </td>
                <td>{{config('admin.publish_status')[$programing->is_published]}}</td>
                <td>{{$programing->created_at->format('Y/m/d')}}</td>
                <td><a href="{{route('admin.programing.edit', $programing->id)}}">編集</a>・削除</td>
            </tr>
        @empty
            <tr>
                <td>プログラミングの記録はありません</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$programings->render()}}
        </div>
    </div>

@stop