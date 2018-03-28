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
                <td>@forelse ($talk->tags as $tag)
                        @if ($loop->last)
                            {{$tag->name}}
                        @else
                            {{$tag->name . ','}}
                        @endif
                    @empty
                        タグはありません　
                    @endforelse
                </td>
                <td>{{$talk->presented_at ? $talk->presented_at->format('Y年m月') : ''}}</td>
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