@extends('layouts.front')

@section('title', $marketing->title)

@section('style')
    <!--TODO:トップとその他のcssファイルを分ける -->
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
    <!-- 記事のスタイル(markdown風) -->
    <link href="{{ asset('css/article.css') }}" rel="stylesheet">
@stop

@section('content')

    @include('front.marketing.parts.header')

    <!-- Page Content -->
    <section class="py-5">
        <div class="container article">

            <div class="row">

                <!-- Blog Post Content Column -->
                <div class="col-lg-8">

                    <!-- Title -->
                    <h1>{{$marketing->title}}</h1>

                    <!-- Author -->
                    <p class="lead">
                        by {{$marketing->user->name}} <span
                                class="float-right">{{$marketing->created_at->diffForHumans()}}</span>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    {{--<p><span class="glyphicon glyphicon-time"></span>{{$marketing->created_at->diffForHumans()}}</p>--}}

                    {{--<hr>--}}

                    <!-- Preview Image -->
                {{--<img class="img-responsive" width="80%" src="{{$marketing->image ? $marketing->image->path : ''}}" alt="">--}}

                {{--<hr>--}}

                <!-- Post Content -->
                    <p>{!! $marketing->content !!}</p>

                    <hr>

                </div>

                <!-- Blog Sidebar Widgets Column -->
                <div class="col-lg-4">
                    @include('front.marketing.parts.side_nav')
                </div>

            </div>
            <!-- /.row -->
            @include('includes.comment')
        </div>
    </section>
@stop