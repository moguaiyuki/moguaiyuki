@extends('layouts.front')

@section('head_meta')
    <meta name="keywords" content="About Me">
    <meta name="description" content="京都の大学院生です。PHPでブログ作ったついでに、色々書いてます。">
    <meta property="og:title" content="Moguai Blog About Me">
    <meta property="og:description" content="京都の大学院生です。PHPでブログ作ったついでに、色々書いてます。">
    <meta property="og:url" content="http://moguaiyuki.com/about-me">
    <!-- twitter 用-->
    <meta property="og:image" content="{{asset('images/image2.jpg')}}" />
    <meta name="twitter:card" content="summary_large_image" />
    {{--<meta name="twitter:site" content="@" />--}}
@stop

@section('title', 'Moguai Blog | About Me')

@section('style')
    <!--TODO:トップとその他のcssファイルを分ける -->
    <link href="{{ asset('css/top.css') }}" rel="stylesheet">
@stop

@section('content')

    @include('front.about_me.parts.header')

    <!-- ABOUT SECTION -->
    <section id="about" class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>プロフィール</h1>
                    <h2>1.基本情報</h2>
                    <ul>
                        <li>出身：愛知県</li>
                        <li>趣味；サッカー、サウナ、旅行、プログラミング</li>
                        <li>大学：京都大学工学部情報学科数理工学専攻計算力学分野</li>
                        <li>大学院：京都大学大学院情報学研究科社会情報学専攻分散情報システム分野</li>
                    </ul>
                    <h2>2.過去の経験</h2>
                    <h3>2-1.生い立ち</h3>
                    2歳から10歳までを香港で過ごし、その後は名古屋の中学、高校へ行き、現在は京都で大学院生をしています。
                    <h3>2-2.職歴</h3>
                    <ul>
                        <li>株式会社セルバ:PHPでwebアプリケーション作成・越境ECマーケティング(2016/8~2018/5)</li>
                        <li>DeNA:プロダクト開発コース(2018/8)</li>
                        <li>Wantedly:international teamで二週間勤務(2018/8)</li>
                        <li>メルカリ BOLD INTERNSHIP:アメリカオハイオ州で新規事業立案(2017/11)</li>
                        <li>ファーストリテイリング GLOBAL STUDY PROGRAM:韓国ソウルで戦略立案(2017/2)</li>
                        <li>NRI:テクニカルエンジニアとして二週間勤務(2017/1)</li>
                        <li>BayCurrent Consulting:コンサルタント(2017/1)</li>
                    </ul>
                    <h3>2-3.資格</h3>
                    <ul>
                        <li>TOEIC 900</li>
                        <li>応用情報技術者</li>
                        <li>基本情報技術者</li>
                    </ul>
                    <h2>3.関連リンク</h2>
                    <ul>
                        <li><a href="https://www.wantedly.com/companies/selva-i/post_articles/81984">Wantedly インタビュー記事</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('images/asset/gorilla.jpg')}}" alt="" class="about-img img-fluid rounded-circle d-none d-md-block">
                </div>
            </div>
        </div>
    </section>


@stop
