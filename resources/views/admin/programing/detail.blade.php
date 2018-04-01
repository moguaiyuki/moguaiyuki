@extends('layouts.admin')

@section('content')

    <div class="col-sm-7">
        <h2>プログラミング詳細</h2>
        <table class="table table-bordered">
            <tr>
                <th>画像</th>
                <td><img height="50" src="{{$programing->image ? $programing->image->path : ''}}" alt=""></td>
            </tr>
            <tr>
                <th>タイトル</th>
                <td>{{$programing->title}}</td>
            </tr>
            <tr>
                <th>ライター</th>
                <td>{{$programing->user->name}}</td>
            </tr>
            <tr>
                <th>内容</th>
                <td>{!! $programing->content !!}</td>
            </tr>
            <tr>
                <th>タグ</th>
                <td>
                    @foreach($programing->tags as $tag)
                        {{$loop->last ? $tag->name : $tag->name . ','}}
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>公開ステータス</th>
                <td>{{config('admin.publish_status')[$programing->is_published]}}</td>
            </tr>
            <tr>
                <th>公開URL</th>
                <td><a href="">{{url("programing/{$programing->slug}")}}</a></td>
            </tr>
        </table>
    </div>
@stop