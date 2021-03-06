@extends('layouts.front')

@section('title', $review->book->title)

@section('style')
    <!--TODO:トップとその他のcssファイルを分ける -->
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
    <link href="{{ asset('css/article.css') }}" rel="stylesheet">
@stop

@section('content')

    @include('front.books.parts.header')

    <!-- Page Content -->
    <div class="container article">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Title -->
                <h1>{{$review->book->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by {{$review->user->name--}} <span class="float-right">{{$review->created_at->diffForHumans()}}</span>
                </p>

                <hr>

                <!-- Date/Time -->
                {{--<p><span class="glyphicon glyphicon-time"></span>{{$review->created_at->diffForHumans()}}</p>

                <hr>--}}

                <!-- Preview Image -->
                {{--<img class="img-responsive" width="80%" src="{{$review->image ? $review->image->path : ''}}" alt="">--}}

                {{--<hr>--}}

                <!-- Post Content -->
                <p>{!! $review->content !!}</p>

                <hr>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-lg-4">
                @include('front.books.parts.side_nav')
            </div>

        </div>
        <!-- /.row -->
        @include('includes.comment')
    </div>
@stop