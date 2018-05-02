@extends('layouts.front')

@section('head_meta')
    <meta name="keywords" content="本">
    <meta name="description" content="読んだ本のまとめや読みたい本等を個人的にメモしていきます。">
    <meta property="og:title" content="Moguai Blog Books">
    <meta property="og:description" content="読んだ本のまとめや読みたい本等を個人的にメモしていきます。">
    <meta property="og:url" content="http://moguaiyuki.com/books">
    <!-- twitter 用-->
    <meta property="og:image" content="{{asset('images/image2.jpg')}}" />
    <meta name="twitter:card" content="summary_large_image" />
    {{--<meta name="twitter:site" content="@" />--}}
@stop

@section('title', 'Moguai Blog Books')

@section('style')
    <!--TODO:トップとその他のcssファイルを分ける -->
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@stop

@section('content')

    @include('front.books.parts.header')

    <!--本セクション-->
    <section class="py-5">
        <div class="container">

            @if(isset($search_tag))
                <div class="row">
                    <h2>タグ検索：<span class="btn btn-outline-success disabled">{{$search_tag->name}}</span></h2>
                </div>
            @endif

            <div class="row">

                <div class="col-lg-8">
                    <!-- Book filter -->
                    <div class="col-md-12">
                        <div id="isotope-filters">
                            <button data-filter="*" class="btn active"><span>本棚</span></button>
                            <button data-filter=".review" class="btn"><span>レビュー</span></button>
                            <button data-filter=".book_status_1" class="btn"><span>読んでる</span></button>
                            <button data-filter=".book_status_2" class="btn"><span>読んだ</span></button>
                            <button data-filter=".book_status_0" class="btn"><span>読みたい</span></button>
                            <button data-filter=".book_status_3" class="btn"><span>積読</span></button>
                        </div>
                    </div>
                    <!-- Book section -->
                    <section id="book-wrapper">
                        <div class="container">
                            {{--@foreach(array_chunk($books->all(), 4, true) as $row)--}}
                                <div class="row isotope-container">
                                    {{--@foreach($row as $item)--}}
                                    @foreach($books as $item)
                                        <div class="col-md-3 col-xs-2 {{'book_status_'.$item->status}} {{$item->review ? 'review' : ''}}">
                                            <!--Book Item-->
                                            <div class="book-item">
                                                <img src="{{$item->image ? $item->image->path : ''}}" alt="book01"
                                                     class="img-responsive">

                                                <div class="book-item-overlay">
                                                    <div class="book-item-details text-center">

                                                        <!-- book Header -->
                                                        <h3>{{$item->title}}</h3>

                                                        <!-- Book Strips -->
                                                        <span></span>

                                                        <!-- Book Description -->
                                                        @if ($item->review)
                                                            <p>
                                                                <a class="btn btn-outline-info" href="{{route('books.show', $item->review->slug)}}">記事を見る</a>
                                                            </p>
                                                        @else
                                                            <p>
                                                                <a class="btn btn-outline-info" href="{{$item->amazon_url}}">amazonで見る</a>
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            {{--@endforeach--}}
                        </div>
                    </section>
                </div>
                <div class="col-lg-4">
                    <!-- Blog Categories Well -->
                    @include('front.books.parts.side_nav')

                </div>

            </div>

            <div class="row">
                <div class="col-xs-6 mx-auto">
                    {{$books->render()}}
                </div>
            </div>


        </div>

    </section>

@stop

@section('script')
    <!-- Isotope -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    {{--<script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.min.js"></script>--}}
    <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
    <script>
        /* ============================================
                       Books filter
        =============================================== */
        $(window).on('load', function () {
            //Initialize Isotope
            $('.isotope-container').isotope({});
            // filter items on button click
            $('#isotope-filters').on('click', 'button', function () {

                // get filter value
                var filterValue = $(this).attr('data-filter');

                //filter books
                $('.isotope-container').isotope({filter: filterValue});

                //active button
                $('#isotope-filters').find('.active').removeClass('active');
                $(this).addClass('active');

            });
        });
    </script>
@stop