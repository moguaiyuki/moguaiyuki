<!--
*フロント側のナビゲーションバー
-->
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
        <a href="{{route('index')}}" class="navbar-brand">Moguai Blog</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navNavbar"><span
                    class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a href="{{route('index')}}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('about-me')}}" class="nav-link">About Me</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                    <div class="dropdown-menu bg-dark">
                        <a class="dropdown-item" href="{{route('books.index')}}">本</a>
                        <a class="dropdown-item" href="{{route('ted-talks.index')}}">TED TALK</a>
                        <a class="dropdown-item" href="{{route('programing.index')}}">プログラミング</a>
                        <a class="dropdown-item" href="{{route('english.index')}}">英語</a>
                        <a class="dropdown-item" href="{{route('marketing.index')}}">マーケティング</a>
                        <a class="dropdown-item" href="{{route('travels.index')}}">旅行</a>
                    </div>
                </li>
                {{--<li class="nav-item">
                    <a href="contact.html" class="nav-link">Contact</a>
                </li>--}}
            </ul>
        </div>
    </div>
</nav>