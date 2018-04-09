<!--
*サイドのカテゴリー表示
-->
<div class="well">
    <h4>トピック</h4>
    <div class="row">
        <div class="col-xs-6 mx-auto">
            <ul class="list-unstyled">
                <li><a href="{{route('books.index')}}">本</a>
                </li>
                <li><a href="{{route('ted-talks.index')}}">TED TALK</a>
                </li>
                <li><a href="{{route('programing.index')}}">プログラミング</a>
            </ul>
        </div>
        <div class="col-xs-6 mx-auto">
            <ul class="list-unstyled">
                <li><a href="{{route('english.index')}}">英語</a>
                </li>
                <li><a href="{{route('marketing.index')}}">マーケティング</a>
                </li>
                <li><a href="{{route('travels.index')}}">旅行</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /.row -->
</div>

<!-- Blog Categories Well -->
<div class="well">
    <h4>マーケティングに関連するタグ</h4>
    @foreach(array_chunk($tags, 3, true) as $row)
        <div class="row">
            @foreach($row as $id=>$name)
                <div class="col-xs-4 mx-auto">
                    <a href="{{route('marketing.search-tag',$id)}}" class="btn btn-outline-success btn-sm">{{$name}}</a>
                </div>
            @endforeach
        </div>
        <br>
@endforeach
<!-- /.row -->
</div>