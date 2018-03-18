@extends('layouts.admin.app')

@section('title','后台用户列表')

@section('css')

@endsection

@section('content')
    <div class="container">
    <ul class="nav nav-pills"id="first_ul">
        <li class="nav-item">
            <a class="nav-link " href="{{url('/admin')}}">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/list')}}">后台用户列表</a>
        </li>
    </ul>
    <form class="form-inline" method="get" action="{{url('/admin/list')}}">
        {{csrf_field()}}
        <input type="text" name="input" class="form-control "style="width: 350px;margin-left: 5px" id="user" placeholder="输入用户"value="{{isset($input)?$input:''}}">
        <button type="submit" class="btn btn-primary"style="cursor: pointer">搜索</button>
    </form>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>用户</th>
            <th>手机</th>
            <th>生日</th>
            <th>角色</th>
            <th>头像</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $v)
        <tr id="list{{$v->id}}">
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->mobile}}</td>
            <td>{{$v->birthday}}</td>
            @foreach($v->roles  as $v1)

                <td><a class="btn btn-small btn-primary" href="#">{{$v1->name}}</a></td>
            @endforeach
            <td><img style="width:50px;height: 50px" src="{{asset($v->imgfile)}}"/></td>
            <td>{{$v->created_at}}</td>
            <td>{{$v->updated_at}}</td>
            <td><a class="btn btn-small btn-primary" href="{{url('/admin/list/'.$v->id.'/edit')}}"><i class="icon-edit"></i>修改</a>
                <a class="del btn btn-small btn-danger" href="#"><i class="icon-trash icon-large"></i>删除</a>
            </td>
        </tr>
         @endforeach

        </tbody>
    </table>
    </div>

@endsection

@section('js')
    <script>

        @foreach($list as $v)
        $('#list{{$v->id}}').find('td .del').click(function () {
            layer.confirm('您确定要删除这条记录？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('{{ url('/admin/list/'.$v->id) }}', {
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