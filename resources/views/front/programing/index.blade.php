@extends('layouts.front')

@section('head_meta')
    <meta name="keywords" content="プログラミング,swift,PHP,Laravel,python,udemy,udacity,coursera">
    <meta name="description" content="PHP,Laravel,python,swift等について書いてます。動画で学ぶ好きなので、動画講義の紹介なんかもしています。">
    <meta property="og:title" content="Moguai Blog Programing">
    <meta property="og:description" content="PHP,Laravel,python,swift等について書いてます。動画で学ぶ好きなので、動画講義の紹介なんかもしています。">
    <meta property="og:url" content="http://moguaiyuki.com/programing">
    <!-- twitter 用-->
    <meta property="og:image" content="{{asset('images/image2.jpg')}}" />
    <meta name="twitter:card" content="summary_large_image" />
    {{--<meta name="twitter:site" content="@" />--}}
@stop

@section('title', 'Moguai Blog　Programing')

@section('style')
    <!--TODO:トップとその他のcssファイルを分ける -->
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@stop

@section('content')

    @include('front.programing.parts.header')

    <!--プログラミングセクション-->
    <section class="py-5">
        <div class="container">

            @if(isset($search_tag))
                <div class="row">
                    <h2>タグ検索：<span class="btn btn-outline-success disabled">{{$search_tag->name}}</span></h2>
                </div>
            @endif

            <div class="row">

                <div class="col-lg-8">
                    @foreach(array_chunk($programing->all(), 3, true) as $row)
                        <div class="row">
                            <div class="card-deck">
                                @foreach($row as $item)
                                    <div class="card mb-3">
                                        <a href="{{route('programing.show', $item->slug)}}">
                                            <img src="{{$item->image ? $item->image->path : ''}}" alt=""
                                                 class="card-img-top img-fluid">
                                        </a>
                                        <div class="card-body">
                                            <h4 class="card-title">{{$item->title}}</h4>
                                            <small class="text-muted">{{$item->created_at->diffForHumans()}}</small>
                                            <a href="{{route('programing.show', $item->slug)}}"
                                               class="btn btn-info btn-sm float-right">記事を見る</a>
                                            <hr>
                                            {{--<p class="card-text">{!! str_limit($item->content, 30) !!}</p>--}}
                                        </div>
                                        {{--<hr>--}}
                                        <div>
                                            @foreach($item->tags as $tag)
                                                <a href="{{route('programing.search-tag',$tag->id)}}"
                                                   class="btn btn-outline-info btn-sm m-2">{{$tag->name}}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                </div>
                <div class="col-lg-4">
                    <!-- Blog Categories Well -->
                    @include('front.programing.parts.side_nav')

                </div>

            </div>


            <div class="row">
                <div class="col-xs-6 mx-auto">
                    {{$programing->render()}}
                </div>
            </div>
        </div>

    </section>



@stop