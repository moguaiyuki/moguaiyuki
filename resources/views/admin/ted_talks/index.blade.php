@extends('layouts.admin')

@section('content')

    <h1>TED Talk</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>画像</th>
            <th>タイトル</th>
            <th>記事</th>
            <th>トークURL</th>
            <th>タグ</th>
            <th>プレゼン日時</th>
            <th>編集・削除</th>
        </tr>
        </thead>
        <tbody>
        @forelse($talks as $talk)
            <tr>
                <td>{{$talk->id}}</td>
                <td><img height="50" src="{{$talk->image ? $talk->image->path : ''}}" alt=""></td>
                <td><a href="{{route('admin.ted-talks.show', $talk->id)}}">{{$talk->title}}</a></td>
                <td>{{--<a href="{{route('admin.reviews.show', $talk->id)}}">記事を見る</a>--}}</td>
                <td>{{$talk->url}}</td>
                <td>
                    @foreach ($talk->tags as $tag)
                        {{$loop->last ? $tag->name : $tag->name . ','}}
                    @endforeach
                </td>
                <td>{{$talk->presented_at ? $talk->presented_at->format('Y年m月') : ''}}</td>
                <td><a href="{{route('admin.ted-talks.edit', $talk->id)}}">編集</a>
                    ・
                    <a class="dropdown-item" href="#"
                       onclick="event.preventDefault();
                               document.getElementById({{$talk->id}}).submit();">
                        削除
                    </a>
                    {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\TedTalksController@destroy', $talk->id], 'id'=>$talk->id, 'style'=>'display: none;']) !!}
                    {!! Form::submit('') !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @empty
            <tr>
                <td>トークはありません</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$talks->render()}}
        </div>
    </div>

@stop