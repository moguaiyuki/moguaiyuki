@extends('layouts.admin')

@section('content')

    <h1>英語一覧</h1>

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
        @forelse ($englishes as $english)
            <tr>
                <td>{{$english->id}}</td>
                <td><img width="50" src="{{$english->image ? $english->image->path : ''}}" alt=""></td>
                <td><a href="{{route('admin.english.show', $english->id)}}">{{$english->title}}</a></td>
                <td>{!! str_limit($english->content,30) !!}</td>
                <td>
                    @foreach ($english->tags as $tag)
                        {{$loop->last ? $tag->name : $tag->name . ','}}
                    @endforeach
                </td>
                <td>{{config('admin.publish_status')[$english->is_published]}}</td>
                <td>{{$english->created_at->format('Y/m/d')}}</td>
                <td><a href="{{route('admin.english.edit', $english->id)}}">編集</a>・削除</td>
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
            {{$englishes->render()}}
        </div>
    </div>

@stop