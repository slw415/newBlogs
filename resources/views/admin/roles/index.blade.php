@extends('layouts.admin.app')

@section('title','角色列表')

@section('css')

@endsection

@section('content')
    <div class="container">
    <ul class="nav nav-pills"id="first_ul">
        <li class="nav-item">
            <a class="nav-link " href="{{url('/admin')}}">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/roles')}}">角色列表</a>
        </li>
    </ul>
        <div class="ml-3">
        <a class="btn btn-primary" href="{{url('admin/roles/new/cache')}}" >
            <i class="icon-refresh icon-spin"></i>更新缓存</a>
        </div>
        @if (\Illuminate\Support\Facades\Session::has('message'))
            <div class="alert alert-success "id="message">
                {{\Illuminate\Support\Facades\Session::get('message')}}
            </div>
        @endif
        <div class="mt-2 ml-2">
    <form class="form-inline" method="get" action="{{url('/admin/roles')}}">
        {{csrf_field()}}
        <input type="text" name="input" class="form-control "style="width: 350px;margin-left: 5px" id="user" placeholder="输入角色名或者备注"value="{{isset($input) ?$input:''}}">
        <button type="submit" class="btn btn-primary"style="cursor: pointer">搜索</button>
    </form>
            <div class="mt-2 ml-2">
    <a href="{{url('/admin/roles/create')}}"><button type="button" class="btn btn-primary btn-lg"style="cursor: pointer">添加角色</button></a>
            </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>角色</th>
            <th>备注</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>

        @if(count($admin)>0)
            @foreach($admin as $v)
            <tr id="list{{$v->id}}"style="line-height: 35px">
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->title}}</td>
                <td>{{$v->created_at}}</td>
                <td>{{$v->updated_at}}</td>
                <td><span><a class="btn btn-small btn-primary" href="{{url('/admin/roles/'.$v->id.'/edit')}}"><i class="icon-edit"></i>修改</a></span>&nbsp;<span><a class="del btn btn-small btn-danger" href="#"><i class="icon-trash icon-large"></i>删除</a></span>
                    <span><a class="btn btn-small btn-success" href="{{url('/admin/all/roles/permissions/'.$v->id)}}"><i class=" icon-star"></i>权限</a></span>
                </td>
            </tr>
           @endforeach
        @endif
        </tbody>
    </table>
    </div>
    </div>
    {!! $admin->links() !!}
@endsection

@section('js')
    <script>
        @foreach($admin as $v)
        $('#list{{$v->id}}').find('td .del').click(function () {
            layer.confirm('您确定要删除这条记录？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('{{ url('/admin/roles/'.$v->id) }}', {
                    '_method': 'delete',
                    '_token': "{{ csrf_token() }}",
                    'id': "{{ $v->id }}"
                }, function (data) {
                    if (data.status == 0) {
                        layer.msg(data.msg, {icon: 6, time: 1500});
                    } else {
                        layer.msg(data.msg, {icon: 5, time: 1500});
                    }
                })
            })
        })
        @endforeach
    </script>
@endsection