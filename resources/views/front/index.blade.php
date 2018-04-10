@extends('layouts.front')

@section('style')
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@stop

@section('content')
<section id="showcase">
    <div>
        <div>
            <div class="carousel-item top-image active">
                <div class="container">
                    <div class="carousel-caption text-xs-center text-lg-right mb-5">
                        {{--<h1 class="display-3">Heading One</h1>--}}
                        <p class="lead">京都の情報系大学院生です。</p>
                        <p class="lead">PHP,JavaScript,HTML,CSSを使ってサイトを作ったついでにブログを書いています。誰かの参考になれば幸いです。。</p>
                        <a href="{{route('profile')}}" class="btn btn-info btn-lg">プロフィールはこちら</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOME ICON SECTION -->
<section id="home-icons" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 text-center">
                <i class="fa fa-book mb-2"></i>
                <h3>本</h3>
                <p>本を読んだらすぐにアウトプットする習慣をつけるために読んだ本のまとめや読みたい本等を個人的にメモしていきます。</p>
                <a class="btn btn-dark btn-sm" href="{{route('books.index')}}">記事を見る</a>
            </div>
            <div class="col-md-4 mb-4 text-center">
                <i class="fa fa-comment mb-2"></i>
                <h3>TED TALK</h3>
                <p>主にテクノロジー系の話題をピックアップしますが、ジャンル問わずに個人的に面白かったTED TALKもまとめていきます。</p>
                <a class="btn btn-dark btn-sm" href="{{route('ted-talks.index')}}">記事を見る</a>
            </div>
            <div class="col-md-4 mb-4 text-center">
                <i class="fa fa-laptop mb-2"></i>
                <h3>プログラミング</h3>
                <p>PHP,Laravel,python,swift等について書いてます。動画で学ぶ好きなので、動画講義の紹介なんかもしています。</p>
                <a class="btn btn-dark btn-sm" href="{{route('programing.index')}}">記事を見る</a>
            </div>
        </div>
    </div>
</section>

<section id="home-icons" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4 text-center">
                <i class="fa fa-adn mb-2"></i>
                <h3>英語</h3>
                <p>個人的な英語勉強のログとともに、TOEICの勉強法やその他普段の英語の勉強法とか書いていきます。</p>
                <a class="btn btn-dark btn-sm" href="{{route('english.index')}}">記事を見る</a>
            </div>
            <div class="col-md-4 mb-4 text-center">
                <i class="fa fa-shopping-cart mb-2"></i>
                <h3>マーケティング</h3>
                <p>普段のアルバイトでのマーケティング業務での気づきや、参考となる記事、動画について書いていきます。</p>
                <a class="btn btn-dark btn-sm" href="{{route('marketing.index')}}">記事を見る</a>
            </div>
            <div class="col-md-4 mb-4 text-center">
                <i class="fa fa-plane mb-2"></i>
                <h3>旅行</h3>
                <p>自分の旅行のログです。行った国の食べ物や景色を紹介していきたいです。</p>
                <a class="btn btn-dark btn-sm" href="{{route('travels.index')}}">記事を見る</a>
            </div>
        </div>
    </div>
</section>
@stop