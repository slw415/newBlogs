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
    <link href="{{ asset('/layouts/css/layui.css') }}"rel="stylesheet">
    <style>
        body,button, input, select, textarea,h1 ,h2, h3, h4, h5, h6 { font-family: Microsoft YaHei,'宋体' , Tahoma, Helvetica, Arial, "\5b8b\4f53", sans-serif;}
        a{
            color: #333;text-decoration:none;
        }
        a:hover{
            color: #007bff;text-decoration:none ;
        }
       .black{
           background: #f2f2f2;border: 1px solid #ccc;
       }

        body{
            background: #f5f8fa;
        }
        .gray{
            border: 1px solid #ccc;

        }

         .fileinput-button {
             position: relative;
             display: inline-block;
             overflow: hidden;
         }

        .fileinput-button input{
            position:absolute;
            right: 0px;
            top: 0px;
            opacity: 0;
            -ms-filter: 'alpha(opacity=0)';
            font-size: 200px;
        }
        #pull_right{
            text-align:center;
        }
        .pull-right {
            /*float: left!important;*/
        }
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > a,
        .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #428bca;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination > li:first-child > a,
        .pagination > li:first-child > span {
            margin-left: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }
        .pagination > li:last-child > a,
        .pagination > li:last-child > span {
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
        .pagination > li > a:hover,
        .pagination > li > span:hover,
        .pagination > li > a:focus,
        .pagination > li > span:focus {
            color: #2a6496;
            background-color: #eee;
            border-color: #ddd;
        }
        .pagination > .active > a,
        .pagination > .active > span,
        .pagination > .active > a:hover,
        .pagination > .active > span:hover,
        .pagination > .active > a:focus,
        .pagination > .active > span:focus {
            z-index: 2;
            color: #fff;
            cursor: default;
            background-color: #428bca;
            border-color: #428bca;
        }
        .pagination > .disabled > span,
        .pagination > .disabled > span:hover,
        .pagination > .disabled > span:focus,
        .pagination > .disabled > a,
        .pagination > .disabled > a:hover,
        .pagination > .disabled > a:focus {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .clear{
            clear: both;
        }
        .asterisk{color: #ff0000;width:10px; font-size:20px;float: left; margin-top:4px; height: 30px;}
    </style>
    @yield('css')
</head>
<body>
    @include('layouts.admin.navs')
    <div class="row ">
        <div class="col-md-2" id="two_ul">
    @include('layouts.admin.uls')
        </div>

        <div class="col-md-10">

        @yield('content')

        </div>
    </div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script src="{{asset('/layer/layer.js')}}"></script>
    <script src="{{asset('/layouts/layui.js')}}"></script>
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

    $("#two_ul").find("dt").click(function() {
            if( $(this).siblings().is(':hidden')) {
                $(this).siblings().slideDown();
            }else {
                $(this).siblings().slideUp();
            }

    });


</script>
@yield('js')
</body>
</html>