@extends('layouts.admin.app')

@section('title','前台个人列表')

@section('css')

@endsection

@section('content')
    <div class="container">
    <ul class="nav nav-pills"id="first_ul">
        <li class="nav-item">
            <a class="nav-link " href="{{url('/admin')}}">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/home')}}">前台个人列表</a>
        </li>
    </ul>
        <div class="mt-2 ml-2 ">
    <form class="form-inline" method="get" action="{{url('/admin/home')}}">
        {{csrf_field()}}
        <input type="text" name="input" class="form-control "style="width: 350px;" id="user" placeholder="输入用户名或者邮箱"value="{{isset($input)?$input:''}}">
        <button type="submit" class="btn btn-primary"style="cursor: pointer">搜索</button>
    </form>
        <div class="mt-2 ml-1"><p>目前共查找到<strong class="text-primary">{{$list->total()}}</strong>个职位！且每页显示<strong class="text-primary">{{$list->perPage()}}</strong>条数。</p></div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>IP</th>
            <th>姓名</th>
            <th>邮箱</th>
            <th>工作</th>
            <th>个人网站</th>
            <th>生日</th>
            <th>头像</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @if(count($list)>0)
            @foreach($list as $v)
                <tr id="list{{$v->id}}">
                    <td>{{$v->id}}</td>
                    <td>{{$v->ip}}</td>
                    <td>{{$v->name}}</td>
                    <td>{{$v->email}}</td>
                    <td>{{$v->job}}</td>
                    <td>{{$v->website}}</td>
                    <td>{{$v->birthday}}</td>
                    <td><img style="width:50px;height: 50px" src="{{asset($v->imgfile)}}"></td>
                    <td>{{$v->updated_at}}</td>
                    <td><span><a class="del btn btn-small btn-danger" href="#"><i class="icon-trash icon-large"></i>删除</a></span></td>
                </tr>
            @endforeach
        @else
            <div class="text-muted">对不起！没有符合条件的记录！</div>
        @endif
        </tbody>
    </table>

    </div>
        <div id="pull_right">
            <div class="pull-right">
                {!! $list->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @foreach($list as $v)
        $('#list{{$v->id}}').find('td .del').click(function () {
            layer.confirm('您确定要删除这条记录？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('{{ url('/admin/home/'.$v->id) }}', {
                    '_method': 'delete',
                    '_token': "{{ csrf_token() }}",
                    'id': "{{ $v->id }}"
                }, function (data) {
                    if (data.status == 0) {
                        location.reload();
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