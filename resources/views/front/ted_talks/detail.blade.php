@extends('layouts.front')

@section('style')
    <!--TODO:トップとその他のcssファイルを分ける -->
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@stop

@section('content')

    @include('front.ted_talks.parts.header')

    <!-- Page Content -->
    <section class="py-5">
        <div class="container">

            <div class="row">

                <!-- Blog Post Content Column -->
                <div class="col-lg-8">

                    <!-- Title -->
                    <h1>{{$talk->title}}</h1>

                    <!-- Author -->
                    <p class="lead">
                        by {{$talk->user->name}} <span
                                class="float-right">{{$talk->created_at->diffForHumans()}}</span>
                    </p>

                    <hr>

                    <!-- Preview Image -->
                {{--<img class="img-responsive" width="80%" src="{{$talk->image ? $talk->image->path : ''}}" alt="">--}}

                {{--<hr>--}}

                <!-- Post Content -->
                    <p>{!! $talk->content !!}</p>

                    <hr>

                </div>

                <!-- Blog Sidebar Widgets Column -->
                <div class="col-lg-4">
                    @include('front.ted_talks.parts.side_nav')
                </div>

            </div>
            <!-- /.row -->
        </div>
    </section>
@stop