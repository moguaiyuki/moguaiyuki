@extends('layouts.front')

@section('style')
    <!--TODO:トップとその他のcssファイルを分ける -->
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@stop

@section('content')

    @include('front.programing.parts.header')

    <!-- Page Content -->
    <section class="py-5">
        <div class="container">

            <div class="row">

                <!-- Blog Post Content Column -->
                <div class="col-lg-8">

                    <!-- Title -->
                    <h1>{{$programing->title}}</h1>

                    <!-- Author -->
                    <p class="lead">
                        by {{$programing->user->name}} <span
                                class="float-right">{{$programing->created_at->diffForHumans()}}</span>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p><span class="glyphicon glyphicon-time"></span>{{$programing->created_at->diffForHumans()}}</p>

                    <hr>

                    <!-- Preview Image -->
                {{--<img class="img-responsive" width="80%" src="{{$programing->image ? $programing->image->path : ''}}" alt="">--}}

                {{--<hr>--}}

                <!-- Post Content -->
                    <p>{!! $programing->content !!}</p>

                    <hr>

                </div>

                <!-- Blog Sidebar Widgets Column -->
                <div class="col-lg-4">
                    @include('front.programing.parts.side_nav')
                </div>

            </div>
            <!-- /.row -->
            @include('includes.comment')
        </div>
    </section>
@stop