
        <dl class="list-group " >
                <dt class="black list-group-item item1"><a href="{{url('/cache')}}"><i class="icon-repeat"></i>清理前台缓存</a></dt>
        </dl>
        <dl class="list-group " >
            <dt class="black list-group-item item1"><a href="{{url('/admin')}}"><i class="icon-home"></i> Home</a></dt>
        </dl>
        @can('Home-Mangent')
        <dl  class="list-group ">
                <dt class="black list-group-item item2"><a href="#"><i class="icon-coffee"></i> 前台用户管理</a></dt>
                <dd class=" gray list-group-item "><a href="{{url('/admin/home')}}"><i class=" icon-user-md"></i> 前台用户管理</a></dd>
        </dl>
        @endcan
        @can('User-management')
                <dl  class="list-group ">
                <dt class="black list-group-item item2"><a href="#"><i class="icon-coffee"></i> 后台用户管理</a></dt>
                <dd class=" gray list-group-item "><a href="{{url('/admin/create')}}"><i class=" icon-user-md"></i> 后台用户创建</a></dd>
                <dd class=" gray list-group-item "><a href="{{url('/admin/list')}}"><i class=" icon-user-md"></i> 后台用户列表</a></dd>
                <dd class=" gray list-group-item "><a href="{{url('/admin/permissions')}}"><i class="icon-book"></i> 权限管理</a></dd>
                <dd class=" gray list-group-item "><a href="{{url('/admin/roles')}}"><i class=" icon-magic "></i> 角色管理</a></dd>
                </dl>
            @endcan
        @can('Frindship-link')
        <dl  class="list-group ">
                <dt class="black list-group-item item2"><a href="#"><i class="icon-link"></i> 友情链接</a></dt>
                <dd class=" gray list-group-item "><a href="{{url('/admin/links')}}"><i class=" icon-link"></i> 友情链接管理</a></dd>
        </dl>
        @endcan
        @can('Nav-management')
        <dl  class="list-group ">
                <dt class="black list-group-item item2"><a href="#"><i class=" icon-bookmark"></i> 导航栏</a></dt>
                <dd class=" gray list-group-item "><a href="{{url('/admin/navs')}}"><i class=" icon-bookmark"></i>导航栏管理</a></dd>
        </dl>
        @endcan
        @can('Article-Mangment')
        <dl  class="list-group ">
                <dt class="black list-group-item item2"><a href="#"><i class=" icon-pencil"></i> 文章管理</a></dt>
                <dd class=" gray list-group-item "><a href="{{url('/admin/articles')}}"><i class="icon-pencil"></i>文章管理</a></dd>
        </dl>
        @endcan