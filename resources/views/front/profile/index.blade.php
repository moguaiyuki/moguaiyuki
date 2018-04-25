@extends('layouts.profile')

@section('style')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="container">
        <header id="main-header">
            <div class="row no-gutters">
                <div class="col-lg-4 col-md-5">
                    <img src="images/asset/namakemono.jpeg" alt="">
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="d-flex flex-column">
                        <div class="p-5 bg-info text-white">
                            <div class="name d-flex flex-row justify-content-between align-items-center">
                                <h1 class="display-4">Moguai</h1>
                                <div><i class="fa fa-twitter"></i></div>
                                <div><i class="fa fa-facebook"></i></div>
                                <div><i class="fa fa-instagram"></i></div>
                                <div><i class="fa fa-github"></i></div>
                            </div>
                        </div>
                        <div class="p-4 bg-black">
                            京都大学情報学研究科社会情報学専攻分散情報システム分野
                        </div>
                        <div>
                            <div class="d-flex flex-row text-white align-items-stretch text-center">
                                <div class="port-item p-4" data-toggle="collapse" data-target="#myself" style="background-color: #008080">
                                    <i class="fa fa-user d-block"></i>自己紹介
                                </div>
                                <div class="port-item p-4" data-toggle="collapse" data-target="#past" style="background-color: #2f4f4f">
                                    <i class="fa fa-folder-open d-block"></i>過去
                                </div>
                                <div class="port-item p-4" data-toggle="collapse" data-target="#current" style="background-color: #2e8b57">
                                    <i class="fa fa-graduation-cap d-block"></i>現在
                                </div>
                                <div class="port-item p-4" data-toggle="collapse" data-target="#future" style="background-color: #6495ed">
                                    <i class="fa fa-plane d-block"></i>将来
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- 自己紹介 -->
        @include('front.profile.parts.myself')

        <!-- 過去　-->
        @include('front.profile.parts.past')

        <!--現在-->
        @include('front.profile.parts.current')

        <!--将来-->
        @include('front.profile.parts.future')

    </div>
@stop

@section('script')
    {{--<script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>--}}
    <script src="{{asset('js/jquery.js')}}"></script>
    <!-- Waypoints -->
    {{--<script src="{{asset('js/waypoints/jquery.waypoints.min.js')}}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.5/waypoints.min.js"></script>
    <script>
        $('.port-item').click(function(){
            $('.collapse').collapse('hide');
        });

        /* ============================================
                       プログレスバーアニメーション
        =============================================== */
        $(function() {
            /*$("#progress-elements").waypoint(function() {
                alert("you reached to progress element area");
                this.destroy();
            }, {
                offset: 'bottom-in-view'
            });*/
            $('.progress-bar').each(function() {
                $(this).animate({
                    width: $(this).attr("aria-valuenow") + "%"
                }, 1000);
            });
        });

    </script>

@stop