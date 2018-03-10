<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/popper.js/1.12.5/umd/popper.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">SLW菜鸟博客后台</a>
        <span class="col-md-2"style="color: #dddddd;font-size: 10px"><strong>{{$username}}</strong>很高兴见到你</span>
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
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-lg-2 modal-content">
              <ul class="list-group">
                  <li class="list-group-item">创建用户</li>
                  <li class="list-group-item">免费 Window 空间托管</li>
                  <li class="list-group-item">图像的数量</li>
                  <li class="list-group-item">24*7 支持</li>
          </ul>
        </div>
    </div>
</div>
    @yield('content')
</body>
</html>