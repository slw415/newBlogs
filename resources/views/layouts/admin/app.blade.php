<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/css/font-awesome.min.css')}}">
    <link href="{{ asset('/layer/mobile/need/layer.css') }}">
    <style>
        body,button, input, select, textarea,h1 ,h2, h3, h4, h5, h6 { font-family: Microsoft YaHei,'宋体' , Tahoma, Helvetica, Arial, "\5b8b\4f53", sans-serif;}
        a{
            color: #dddddd;text-decoration:none;
        }
        a:hover{
            color: #fff;text-decoration:none
        }
       .black{
           background: #2a2730;
       }

        body{
            background: #f5f8fa;
        }


    </style>
    @yield('css')
</head>
<body>
    @include('layouts.admin.navs')
    @include('layouts.admin.uls')
        <div class="col-md-10">

        @yield('content')
        </div>

<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="{{asset('/layer/layer.js')}}"></script>
<script>
    $(function(){

        $("#first_ul li a").mouseover(function() {

            $(this).addClass('active');  //添加当前元素的样式

        });
        $("#first_ul li a").mouseout(function() {

            $(this).removeClass('active');  // 删除元素的样式

        });
        $("#two_ul li").mouseover(function() {

            $(this).addClass('active');  //添加当前元素的样式
            $(this).removeClass('black');  // 删除元素的样式


        });
        $("#two_ul li ").mouseout(function() {
            $(this).removeClass('active');  // 删除元素的样式
            $(this).addClass('black');  //添加当前元素的样式
        });

    });

    function message() {
        var message=document.getElementById('message');
        message.style.display='none';
    }
    setTimeout("message()",2000);


</script>
@yield('js')
</body>
</html>