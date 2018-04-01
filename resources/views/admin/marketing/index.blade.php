@extends('layouts.admin')

@section('content')

    <h1>マーケティング一覧</h1>

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
        @forelse ($marketings as $marketing)
            <tr>
                <td>{{$marketing->id}}</td>
                <td><img width="50" src="{{$marketing->image ? $marketing->image->path : ''}}" alt=""></td>
                <td><a href="{{route('admin.marketing.show', $marketing->id)}}">{{$marketing->title}}</a></td>
                <td>{!! str_limit($marketing->content,30) !!}</td>
                <td>
                    @foreach ($marketing->tags as $tag)
                        {{$loop->last ? $tag->name : $tag->name . ','}}
                    @endforeach
                </td>
                <td>{{config('admin.publish_status')[$marketing->is_published]}}</td>
                <td>{{$marketing->created_at->format('Y/m/d')}}</td>
                <td><a href="{{route('admin.marketing.edit', $marketing->id)}}">編集</a>・削除</td>
            </tr>
        @empty
            <tr>
                <td>マーケティングの記録はありません</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$marketings->render()}}
        </div>
    </div>

@stop