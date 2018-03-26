<!doctype html>
<html>
<head>
    <meta charset="gb2312">
    <title>@yield('title')</title>
    <meta name="keywords" content="个人博客,施力炜个人博客" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('css/home/base.css')}}" rel="stylesheet">
    <link href="{{asset('css/home/index.css')}}" rel="stylesheet">
    <script src="{{asset('js/home/modernizr.js')}}"></script>
</head>
<body>
<script>
    window.onload = function ()
    {
        var oH2 = document.getElementsByTagName("h2")[0];
        var oUl = document.getElementsByTagName("ul")[0];
        oH2.onclick = function ()
        {
            var style = oUl.style;
            style.display = style.display == "block" ? "none" : "block";
            oH2.className = style.display == "block" ? "open" : ""
        }
    }
</script>
@include('layouts.home.header')
<article>
@yield('content')
</article>
@include('layouts.home.footer')
</body>
</html>
