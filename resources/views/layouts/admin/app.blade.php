<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">

    <style>
        a{
            color: #dddddd;text-decoration:none
        }
        a:hover{
            color: #fff;text-decoration:none
        }
        .list-group li{
            background: #2a2730;border: 1px solid #5e5e5e;color: #dddddd;
        }
        .list-group li:hover{
            background: #5e5d5d;border: 1px solid #5e5e5e;color: #fff;
        }
        body{
            background: #f5f8fa;
        }

        .breadcrumb > li + li:before {
            color: #CCCCCC;
            content: "/ ";
            padding: 0 5px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="/"><span class="text-warning">SLW</span>菜鸟博客后台</a>
        <span class="col-md-2"style="color: #dddddd;font-size: 10px">很高兴见到你</span>
        <!-- 这个 div 加上 justify-content-end 样式即可 -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav" id="headerNav">
                <li class="nav-item" id="navMainPage"><a class="nav-link" href="#"> 前台首页 </a></li>
                <li class="nav-item" id="logout"><a class="nav-link" href="{{url('/admin/logout')}}"> 退出 </a></li>
             {{--   <li class="nav-item" id="navTechPage"><a class="nav-link" href="#"> 技术 </a></li>
                <li class="nav-item" id="navFoodPage"><a class="nav-link" href="#"> 摄影 </a></li>
                <li class="nav-item" id="navEssayPage"><a class="nav-link" href="#"> 随笔 </a></li>--}}
            </ul>
        </div>
</nav>

    <div class="row">
        <div class="col-md-2">
              <ul class="list-group">
                  <a href="{{url('/admin/gate')}}"><li class="list-group-item ">权限管理</li></a>
                  <a href="{{url('/admin/gate')}}"><li class="list-group-item ">权限管理</li></a>
          </ul>
        </div>

        <div class="col-md-6">

        @yield('content')
        </div>
    </div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script>
    $(function(){

        $("#first_ul li a").mouseover(function() {

            $(this).addClass('active');  //添加当前元素的样式

        });
        $("#first_ul li a").mouseout(function() {

            $(this).removeClass('active');  // 删除元素的样式

        });
    });
</script>
@yield('js')
</body>
</html>