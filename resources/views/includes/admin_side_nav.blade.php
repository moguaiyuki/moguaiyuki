<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="/admin"><i class="fa fa-dashboard fa-fw"></i>ダッシュボード</a>
            </li>

            <!-- ユーザー -->
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i>ユーザー<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin.users.index')}}">一覧</a>
                    </li>
                    <li>
                        <a href="{{route('admin.users.create')}}">登録</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <!-- TED TALK -->
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i>TED Talk<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin.ted-talks.index')}}">一覧</a>
                    </li>
                    <li>
                        <a href="{{route('admin.ted-talks.create')}}">登録</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <!-- 本 -->
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i>本<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin.books.index')}}">一覧</a>
                    </li>
                    <li>
                        <a href="{{route('admin.books.create')}}">登録</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <!-- 旅行 -->
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i>旅行<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin.travels.index')}}">一覧</a>
                    </li>
                    <li>
                        <a href="{{route('admin.travels.create')}}">登録</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <!-- 旅行 -->
            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i>プログラミング<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{route('admin.programing.index')}}">一覧</a>
                    </li>
                    <li>
                        <a href="{{route('admin.programing.create')}}">登録</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i> Posts<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{--route('posts.index')--}}">All Posts</a>
                    </li>

                    <li>
                        <a href="{{--route('posts.create')--}}">Create Post</a>
                    </li>

                    <li>
                        <a href="{{--route('comments.index')--}}">All Comments</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>


            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i>Categories<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{--route('categories.index')--}}">All Categories</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>


            <li>
                <a href="#"><i class="fa fa-wrench fa-fw"></i>Media<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{--route('media.index')--}}">All Media</a>
                    </li>

                    <li>
                        <a href="{{--route('media.create')--}}">Upload Media</a>
                    </li>

                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>


    </div>
    <!-- /.sidebar-collapse -->
</div>