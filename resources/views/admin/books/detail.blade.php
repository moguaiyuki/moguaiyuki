@extends('layouts.admin')

@section('content')

    <div class="col-sm-7">
        <h2>本詳細</h2>
        <table class="table table-bordered">
            <tr>
                <th>タイトル</th>
                <td>{{$book->title}}</td>
            </tr>
            <tr>
                <th>著者</th>
                <td>{{$book->author}}</td>
            </tr>
            <tr>
                <th>URL</th>
                <td><a href="{{$book->amazon_link}}">{{$book->amazon_link}}</a></td>
            </tr>
            <tr>
                <th>タグ</th>
                <td>
                    @foreach($book->tags as $tag)
                        @if ($loop->last)
                            {{$tag->name}}
                        @else
                            {{$tag->name . ','}}
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>画像</th>
                <td><img height="50" src="{{$book->image ? $book->image->path : ''}}" alt=""></td>
            </tr>
            <tr>
                <th>状態</th>
                <td>{{config('admin.book_status')[$book->status]}}</td>
            </tr>
            {{--<tr>
                <th>お気に入り</th>
                <td>@if ($book->is_favorite)お気に入り@endif</td>
            </tr>--}}
            <tr>
                <th>本棚</th>
                <td>@if($book->is_bookshelf) 本棚にあり @endif</td>
            </tr>
        </table>
    </div>

    @if ($book->review)

        <div class="col-sm-7">
            <h2>レビュー 詳細</h2>
            <table class="table table-bordered">
                <tr>
                    <th>タイトル</th>
                    <td>{{$book->review->title}}</td>
                </tr>
                <tr>
                    <th>レビュー</th>
                    <td>{!! $book->review->content !!}</td>
                </tr>
                <tr>
                    <th>公開ステータス</th>
                    <td>{{config('admin.publish_status')[$book->review->status]}}</td>
                </tr>
            </table>
        </div>

    @endif
@stop