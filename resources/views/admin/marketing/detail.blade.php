@extends('layouts.admin')

@section('content')

    <div class="col-sm-7">
        <h2>マーケティング詳細</h2>
        <table class="table table-bordered">
            <tr>
                <th>画像</th>
                <td><img height="50" src="{{$marketing->image ? $marketing->image->path : ''}}" alt=""></td>
            </tr>
            <tr>
                <th>タイトル</th>
                <td>{{$marketing->title}}</td>
            </tr>
            <tr>
                <th>ライター</th>
                <td>{{$marketing->user->name}}</td>
            </tr>
            <tr>
                <th>内容</th>
                <td>{!! $marketing->content !!}</td>
            </tr>
            <tr>
                <th>タグ</th>
                <td>
                    @foreach($marketing->tags as $tag)
                        {{$loop->last ? $tag->name : $tag->name . ','}}
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>公開ステータス</th>
                <td>{{config('admin.publish_status')[$marketing->is_published]}}</td>
            </tr>
            <tr>
                <th>公開URL</th>
                <td><a href="">{{url("marketing/{$marketing->slug}")}}</a></td>
            </tr>
        </table>
    </div>
@stop