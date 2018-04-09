@extends('layouts.front')

@section('style')
    <!--TODO:トップとその他のcssファイルを分ける -->
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@stop

@section('content')

    @include('front.english.parts.header')

    <!-- Page Content -->
    <section class="py-5">
        <div class="container">

            <div class="row">

                <!-- Blog Post Content Column -->
                <div class="col-lg-8">

                    <!-- Title -->
                    <h1>{{$english->title}}</h1>

                    <!-- Author -->
                    <p class="lead">
                        by {{$english->user->name}} <span
                                class="float-right">{{$english->created_at->diffForHumans()}}</span>
                    </p>

                    <hr>

                    <!-- Date/Time -->
                    <p><span class="glyphicon glyphicon-time"></span>{{$english->created_at->diffForHumans()}}</p>

                    <hr>

                    <!-- Preview Image -->
                {{--<img class="img-responsive" width="80%" src="{{$english->image ? $english->image->path : ''}}" alt="">--}}

                {{--<hr>--}}

                <!-- Post Content -->
                    <p>{!! $english->content !!}</p>

                    <hr>

                </div>

                <!-- Blog Sidebar Widgets Column -->
                <div class="col-lg-4">
                    @include('front.english.parts.side_nav')
                </div>

            </div>
            <!-- /.row -->
        </div>
    </section>
@stop