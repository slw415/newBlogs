@extends('layouts.admin.app')

@section('title','评论列表')

@section('css')

@endsection

@section('content')
    <div class="container">
    <ul class="nav nav-pills"id="first_ul">
        <li class="nav-item">
            <a class="nav-link " href="{{url('/admin')}}">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/message')}}">评论列表</a>
        </li>
    </ul>
        <div class="mt-2 ml-2 ">
    <form class="form-inline" method="get" action="{{url('/admin/message')}}">
        {{csrf_field()}}
        <input type="text" name="input" class="form-control "style="width: 350px;" id="user" placeholder="输入评论内容或者文章标题"value="{{isset($input)?$input:''}}">
        <button type="submit" class="btn btn-primary"style="cursor: pointer">搜索</button>
    </form>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>文章标题</th>
            <th>文章作者</th>
            <th>评论用户</th>
            <th>评论内容</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>

        @if(count($list)>0)
            @foreach($list as $v)
                <tr id="list{{$v['con']['id']}}">
                    <td>{{$v['con']['id']}}</td>
                    <td>{{$v['con']['article']['title']}}</td>
                    <td>{{$v['con']['article']['user']}}</td>
                    <td >{{$v['con']['user']['name']}}</td>
                    <td class="ps1">{{str_limit($v['con']['body'], $limit = 10, $end = '...')}}</td>
                    <td>{{$v['con']['updated_at']}}</td>
                    <td>
                        <a class="del btn btn-small btn-danger" href="#"><i class="icon-trash icon-large"></i>删除</a>
                    </td>
                </tr>
                @if(count($v['son'])>0)
                    @foreach($v['son'] as $v1)
                        <tr id="list{{$v1['con']['id']}}">
                            <td>{{$v1['con']['id']}}</td>
                            <td>|-&nbsp;{{$v1['con']['article']['title']}}</td>
                            <td >|-&nbsp;{{$v1['con']['article']['user']}}</td>
                            <td >|-&nbsp;{{$v1['con']['user']['name']}}</td>
                            <td class="ps1">|-&nbsp;{{str_limit($v1['con']['body'], $limit = 10, $end = '...')}}</td>
                            <td>{{$v1['con']['updated_at']}}</td>
                            <td>
                                <a class="del btn btn-small btn-danger" href="#"><i class="icon-trash icon-large"></i>删除</a>
                            </td>
                        </tr>
                    @endforeach
                    @endif

            @endforeach
        @else
            <div class="text-muted">对不起！没有符合条件的记录！</div>
        @endif
        </tbody>
    </table>

        </div>

    </div>
@endsection

@section('js')
    <script>
        @foreach($list as $v)
        $("#list{{$v['con']['id']}}").find('.ps1').mouseover(function () {
            layer.tips("{{$v['con']['body']}}",$("#list{{$v['con']['id']}}").find('.ps1'), {
                tips: [4, '#78BA32']
            });
        });
        $('#list{{$v['con']['id']}}').find('td .del').click(function () {
            layer.confirm('您确定要删除这条记录？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('{{ url('/admin/message/'.$v['con']['id']) }}', {
                    '_method': 'delete',
                    '_token': "{{ csrf_token() }}",
                    'id': "{{ $v['con']['id'] }}",
                    'pid': "{{ $v['con']['pid'] }}"
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
        @if(count($v['son'])>0)
            @foreach($v['son'] as $v1)
        $("#list{{$v1['con']['id']}}").find('.ps1').mouseover(function () {
            layer.tips("{{$v1['con']['body']}}",$("#list{{$v1['con']['id']}}").find('.ps1'), {
                tips: [4, '#78BA32']
            });
        });
        $('#list{{$v1['con']['id']}}').find('td .del').click(function () {
            layer.confirm('您确定要删除这条记录？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('{{ url('/admin/message/'.$v1['con']['id']) }}', {
                    '_method': 'delete',
                    '_token': "{{ csrf_token() }}",
                    'id': "{{ $v1['con']['id'] }}",
                    'pid': "{{ $v1['con']['pid'] }}"
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
        @endif
        @endforeach
    </script>

@endsection