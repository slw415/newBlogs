<div class="row">
    <div class="col-md-2">
        <ul class="list-group " id="two_ul">
            <li class="black list-group-item"><a href="{{url('/admin')}}"><i class="icon-home"></i> Home</a></li>
            @can('User-management')

                <li class=" black list-group-item "><a href="{{url('/admin/create')}}"><i class=" icon-user-md"></i> 后台用户创建</a></li>
                <li class=" black list-group-item "><a href="{{url('/admin/list')}}"><i class=" icon-user-md"></i> 后台用户列表</a></li>
                <li class=" black list-group-item "><a href="{{url('/admin/permissions')}}"><i class="icon-book"></i> 权限管理</a></li>
                <li class=" black list-group-item "><a href="{{url('/admin/roles')}}"><i class=" icon-magic "></i> 角色管理</a></li>
            @endcan
        </ul>
    </div>
</div>