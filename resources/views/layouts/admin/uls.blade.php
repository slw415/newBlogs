

        <dl class="list-group " >
            <dt class="black list-group-item item1"><a href="{{url('/admin')}}"><i class="icon-home"></i> Home</a></dt>
        </dl>
                <dl  class="list-group ">
                    @can('User-management')
                <dt class="black list-group-item item2"><a href="#"><i class="icon-coffee"></i> 后台用户管理</a></dt>
                <dd class=" gray list-group-item "><a href="{{url('/admin/create')}}"><i class=" icon-user-md"></i> 后台用户创建</a></dd>
                <dd class=" gray list-group-item "><a href="{{url('/admin/list')}}"><i class=" icon-user-md"></i> 后台用户列表</a></dd>
                <dd class=" gray list-group-item "><a href="{{url('/admin/permissions')}}"><i class="icon-book"></i> 权限管理</a></dd>
                <dd class=" gray list-group-item "><a href="{{url('/admin/roles')}}"><i class=" icon-magic "></i> 角色管理</a></dd>
            @endcan
        </dl>