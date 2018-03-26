@extends('layouts.admin')

@section('content')

    <div class="col-sm-7">
        <h2>TED TALK 詳細</h2>
        <table class="table table-bordered">
            <tr>
                <th>タイトル</th>
                <td>{{$talk->title}}</td>
            </tr>
            <tr>
                <th>プレゼンター</th>
                <td>{{$talk->presentor}}</td>
            </tr>
            <tr>
                <th>URL</th>
                <td><a href="{{$talk->url}}">{{$talk->url}}</a></td>
            </tr>
            <tr>
                <th>プレゼン公開日</th>
                <td>{{$talk->presented_at->format('Y年m月')}}</td>
            </tr>
            <tr>
                <th>画像</th>
                <td><img height="50" src="{{$talk->image ? $talk->image->path : ''}}" alt=""></td>
            </tr>
            <tr>
                <th>日本語字幕</th>
                <td>{{$talk->subtitle}}</td>
            </tr>
            <tr>
                <th>お気に入り</th>
                <td>@if ($talk->is_favorite)お気に入り@endif</td>
            </tr>
            <tr>
                <th>ステータス</th>
                <td>@if($talk->status) 見たい @else 見た @endif</td>
            </tr>
        </table>
    </div>

    @if ($talk->review)

        <div class="col-sm-7">
            <h2>レビュー 詳細</h2>
            <table class="table table-bordered">
                <tr>
                    <th>タイトル</th>
                    <td>{{$talk->review->title}}</td>
                </tr>
                <tr>
                    <th>レビュー</th>
                    <td>{!! $talk->review->content !!}</td>
                </tr>
                <tr>
                    <th>公開ステータス</th>
                    <td>@if($talk->review->status) 公開 @else 下書き @endif</td>
                </tr>
            </table>
        </div>

    @endif


@stop