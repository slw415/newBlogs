<header>
    <div id="mnav">
        <h2><span class="navicon"></span></h2>
        <ul>
            <li><a href="/">网站首页</a></li>
            @foreach($navs as $v)
                <li><a href="/about.html">{{$v->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <nav>
        <ul>
            <li style="color:#fff;font-family:Source Serif Pro, PT Sans, Trebuchet MS, Helvetica, Arial;font-size: 20px;margin-right: 270px;">施帅帅blog</li>
            <li><a href="/">网站首页</a></li>
            @foreach($navs as $v)
            <li><a href="/about.html">{{$v->name}}</a></li>
            @endforeach
        </ul>
    </nav>
</header>