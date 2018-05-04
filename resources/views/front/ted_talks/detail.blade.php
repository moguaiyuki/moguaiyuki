@extends('layouts.front')

@section('title', $review->talk->title)

@section('style')
    <!--TODO:トップとその他のcssファイルを分ける -->
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
    <link href="{{ asset('css/article.css') }}" rel="stylesheet">
@stop

@section('content')

    @include('front.ted_talks.parts.header')

    <!-- Page Content -->
    <section class="py-5">
        <div class="container article">

            <div class="row">

                <!-- Blog Post Content Column -->
                <div class="col-lg-8">

                    <!-- Title -->
                    <h1>{{$review->talk->title}}</h1>

                    <!-- Author -->
                    <p class="lead">
                        by {{$review->user->name}} <span
                                class="float-right">{{$review->created_at->diffForHumans()}}</span>
                    </p>

                    <hr>

                    <!-- Preview Image -->
                {{--<img class="img-responsive" width="80%" src="{{$review->image ? $review->image->path : ''}}" alt="">--}}

                {{--<hr>--}}

                <!-- Post Content -->
                    <p>{!! $review->content !!}</p>

                    <hr>

                </div>

                <!-- Blog Sidebar Widgets Column -->
                <div class="col-lg-4">
                    @include('front.ted_talks.parts.side_nav')
                </div>

            </div>
            <!-- /.row -->
            @include('includes.comment')
        </div>
    </section>
@stop