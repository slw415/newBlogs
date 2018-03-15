@extends('layouts.admin.app')

@section('title','权限列表')

@section('css')

@endsection

@section('content')
    <div class="container">
    <ul class="nav nav-pills"id="first_ul">
        <li class="nav-item">
            <a class="nav-link " href="{{url('/admin')}}">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/permissions')}}">权限列表</a>
        </li>
    </ul>
    <form class="form-inline" method="get" action="{{url('/admin/permissions')}}">
        {{csrf_field()}}
        <input type="text" name="input" class="form-control "style="width: 350px;margin-left: 5px" id="user" placeholder="输入权限名或者备注"value="{{isset($input) ?$input:''}}">
        <button type="submit" class="btn btn-primary"style="cursor: pointer">搜索</button>
    </form>
    <a href="{{url('/admin/permissions/create')}}"><button type="button" class="btn btn-primary btn-lg"style="margin: 20px 0 20px 7px;cursor: pointer">添加权限</button></a>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>权限</th>
            <th>备注</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>

        @if(count($admins)>0)
            @foreach($admins as $v)
            <tr id="list{{$v->id}}" style="line-height: 35px">
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->title}}</td>
                <td>{{$v->created_at}}</td>
                <td>{{$v->updated_at}}</td>
                <td><span><a class="btn btn-small btn-primary" href="{{url('/admin/permissions/'.$v->id.'/edit')}}"><i class="icon-edit"></i>修改</a></span>&nbsp;<span><a class="del btn btn-small btn-danger" href="#"><i class="icon-trash icon-large"></i>删除</a></span></td>
            </tr>
           @endforeach
        @endif
        </tbody>
    </table>
    </div>
    {!! $admins->links() !!}
@endsection

@section('js')
    <script>
        @foreach($admins as $v)
        $('#list{{$v->id}}').find('td .del').click(function () {
            layer.confirm('您确定要删除这条记录？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('{{ url('/admin/permissions/'.$v->id) }}', {
                    '_method': 'delete',
                    '_token': "{{ csrf_token() }}",
                    'id': "{{ $v->id }}"
                }, function (data) {
                     location.reload();
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