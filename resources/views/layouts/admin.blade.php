<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="noindex,nofollow">
    <meta name="format-detection" content="telephone=no">
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>Admin</title>

    <!-- Bootstrap Core CSS -->

    <link href="{{asset('css/libs.css')}}" rel="stylesheet">


{{--<link href="{{asset('css/app.css')}}" rel="stylesheet">--}}


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    @yield('styles')

</head>

<body id="admin-page" style="padding-top: 0px;">

<div id="wrapper">

    <!-- Navigation -->
    @include('includes.admin_nav')


    {{--<div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a href="/profile"><i class="fa fa-dashboard fa-fw"></i>Profile</a>
                </li>


                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Posts<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="">All Posts</a>
                        </li>

                        <li>
                            <a href="">Create Post</a>
                        </li>

                    </ul>
                    <!-- /.nav-second-level -->
                </li>

            </ul>

        </div>

    </div>--}}

</div>


<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>
                @yield('content')
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="{{asset('js/libs.js')}}"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
@yield('scripts')
<script>
    {{--var route_prefix = "{{ url(config('lfm.prefix')) }}";--}}
    // $('#lfm').filemanager('image', {prefix: route_prefix});
    $('#lfm').filemanager('image');
</script>


</body>

</html>
