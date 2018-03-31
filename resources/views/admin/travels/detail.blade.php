@extends('layouts.admin')

@section('content')

    <div class="col-sm-7">
        <h2>旅詳細</h2>
        <table class="table table-bordered">
            <tr>
                <th>タイトル</th>
                <td>{{$travel->title}}</td>
            </tr>
            <tr>
                <th>内容</th>
                <td>{!! $travel->content !!}</td>
            </tr>
            <tr>
                <th>国</th>
                <td>{{$travel->country}}</td>
            </tr>
            <tr>
                <th>画像</th>
                <td><img height="50" src="{{$travel->image ? $travel->image->path : ''}}" alt=""></td>
            </tr>
            <tr>
                <th>タグ</th>
                <td>
                    @foreach($travel->tags as $tag)
                        {{$loop->last ? $tag->name : $tag->name . ','}}
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>日程</th>
                <td>{{$travel->start_date->format('Y年m月d日')}}~{{$travel->end_date->format('Y年m月d日')}}</td>
            </tr>
            <tr>
                <th>公開ステータス</th>
                <td>{{config('admin.publish_status')[$travel->is_published]}}</td>
            </tr>
        </table>
    </div>
@stop