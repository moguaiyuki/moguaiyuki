@extends('layouts.admin')

@section('content')

    <div class="col-sm-7">
        <h2>英語詳細</h2>
        <table class="table table-bordered">
            <tr>
                <th>画像</th>
                <td><img height="50" src="{{$english->image ? $english->image->path : ''}}" alt=""></td>
            </tr>
            <tr>
                <th>タイトル</th>
                <td>{{$english->title}}</td>
            </tr>
            <tr>
                <th>ライター</th>
                <td>{{$english->user->name}}</td>
            </tr>
            <tr>
                <th>内容</th>
                <td>{!! $english->content !!}</td>
            </tr>
            <tr>
                <th>タグ</th>
                <td>
                    @foreach($english->tags as $tag)
                        {{$loop->last ? $tag->name : $tag->name . ','}}
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>公開ステータス</th>
                <td>{{config('admin.publish_status')[$english->is_published]}}</td>
            </tr>
            <tr>
                <th>公開URL</th>
                <td><a href="">{{url("english/{$english->slug}")}}</a></td>
            </tr>
        </table>
    </div>
@stop