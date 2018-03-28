@extends('layouts.admin')

@section('content')

    <h1>旅行一覧</h1>

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>画像</th>
            <th>タイトル</th>
            <th>国</th>
            <th>日程</th>
            <th>内容</th>
            <th>タグ</th>
            <th>公開ステータス</th>
            <th>登録日</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($travels as $travel)
            <tr>
                <td>{{$travel->id}}</td>
                <td><img width="50" src="{{$travel->image ? $travel->image->path : ''}}" alt=""></td>
                <td>{{$travel->title}}</td>
                <td>{{$travel->country}}</td>
                <td>{{$travel->start_date->format('Y/m/d')}}~{{$travel->end_date->format('Y/m/d')}}</td>
                <td>{!! str_limit($travel->content,30) !!}</td>
                <td>
                    @forelse ($travel->tags as $tag)
                        @if ($loop->last)
                            {{$tag->name}}
                        @else
                            {{$tag->name . ','}}
                        @endif
                    @empty　
                    @endforelse
                </td>
                <td>{{config('master.publish_status')[$travel->is_published]}}</td>
                <td>{{$travel->created_at->format('Y/m/d')}}</td>
            </tr>
        @empty
            <tr>
                <td>旅行の記録はありません</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$travels->render()}}
        </div>
    </div>

@stop