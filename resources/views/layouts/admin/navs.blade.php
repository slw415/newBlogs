<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#"><span class="text-warning">SLW</span>菜鸟博客后台</a>
    <span class="col-md-2"style="color: #dddddd;font-size: 10px">很高兴见到你</span>
    <!-- 这个 div 加上 justify-content-end 样式即可 -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <div class="btn-group open">
            <a class="btn " href="#"style="color: #dddddd"><img width="50px"height="50px" src="{{$img->imgfile}}"/> {{$img->name}}</a>
            <a class="btn  dropdown-toggle" data-toggle="dropdown" href="#"style="margin-top: 12px;color: #dddddd"></a>
            <ul class="dropdown-menu"style="background: #2a2730;color: #f5f5f5">
                <li class="nav-item" id="logout"><a class="nav-link" href="{{url('/admin/edit')}}"style="color: #dddddd"> 修改个人信息 </a></li>
                <li class="nav-item" id="logout"><a class="nav-link" href="{{url('/admin/logout')}}"style="color: #dddddd"> 退出 </a></li>
            </ul>
        </div>
        <ul class="navbar-nav" id="headerNav">
            <li class="nav-item" id="navMainPage"><a class="nav-link" href="{{url('/')}}"target="_blank"> 前台首页 </a></li>

            {{--   <li class="nav-item" id="navTechPage"><a class="nav-link" href="#"> 技术 </a></li>
               <li class="nav-item" id="navFoodPage"><a class="nav-link" href="#"> 摄影 </a></li>
               <li class="nav-item" id="navEssayPage"><a class="nav-link" href="#"> 随笔 </a></li>--}}
        </ul>
    </div>
</nav>