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
                    <a href="about.html" class="nav-link">About Me</a>
                </li>
                <li class="nav-item">
                    <a href="blog.html" class="nav-link">Blog</a>
                </li>
                <li class="nav-item">
                    <a href="contact.html" class="nav-link">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>