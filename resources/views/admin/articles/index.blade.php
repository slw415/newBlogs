@extends('layouts.admin.app')

@section('title','文章显示列表')

@section('css')

@endsection

@section('content')
    <div class="container">
    <ul class="nav nav-pills"id="first_ul">
        <li class="nav-item">
            <a class="nav-link " href="{{url('/admin')}}">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/articles')}}">文章列表</a>
        </li>
    </ul>
        <div class="mt-2 ml-2 ">
    <form class="form-inline" method="get" action="{{url('/admin/list')}}">
        {{csrf_field()}}
        <input type="text" name="input" class="form-control "style="width: 350px;" id="user" placeholder="输入标题"value="{{isset($input)?$input:''}}">
        <button type="submit" class="btn btn-primary"style="cursor: pointer">搜索</button>
    </form>
        <div class="mt-2 ml-1"><p>目前共查找到<strong class="text-primary">{{$list->total()}}</strong>个职位！且每页显示<strong class="text-primary">{{$list->perPage()}}</strong>条数。</p></div>
            <div class="mt-2 ml-2">
                <a href="{{url('/admin/articles/create')}}"><button type="button" class="btn btn-primary btn-lg"style="cursor: pointer">添加文章</button></a>
            </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>分类</th>
            <th>标题</th>
            <th>作者</th>
            <th>简介</th>
            <th>缩略图</th>
            <th>浏览人数</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @if(count($list)>0)
            @foreach($list as $v)
                <tr id="list{{$v->id}}">
                    <td>{{$v->id}}</td>
                    <td>{{$v->nav->name}}</td>
                    <td class="ps1">{{str_limit($v->title, $limit = 5, $end = '...')}}</td>
                    <td class="ps2">{{str_limit($v->user, $limit = 5, $end = '...')}}</td>
                    <td class="ps3">{{str_limit($v->introduction, $limit = 5, $end = '...')}}</td>
                    <td><img src="{{$v->imgfile}}"width="50px"height="50px"/></td>
                    <th>{{$v->watch}}</th>
                    <td>{{$v->updated_at}}</td>
                    <td><span><a class="btn btn-small btn-primary" href="{{url('/admin/articles/'.$v->id.'/edit')}}"><i class="icon-edit"></i>修改</a></span>&nbsp;
                        <span><a class="del btn btn-small btn-danger" href="#"><i class="icon-trash icon-large"></i>删除</a></span>
                        <span><a class="recommend btn btn-small btn-success" href="#"><i class="icon-edit"></i>推荐</a></span>
                    </td>
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
        $("#list{{$v->id}}").find('.ps1').mouseover(function () {
            layer.tips("{!! str_replace(array("\r", "\n"), array('', '\n'), addslashes($v->introduction)) !!}",$("#list{{$v->id}}").find('.ps1'), {
                tips: [4, '#78BA32']
            });
        });
        $("#list{{$v->id}}").find('.ps2').mouseover(function () {
            layer.tips("{!! str_replace(array("\r", "\n"), array('', '\n'), addslashes($v->introduction)) !!}",$("#list{{$v->id}}").find('.ps2'), {
                tips: [4, '#78BA32']
            });
        });
        $("#list{{$v->id}}").find('.ps3').mouseover(function () {
            layer.tips("{!! str_replace(array("\r", "\n"), array('', '\n'), addslashes($v->introduction)) !!}",$("#list{{$v->id}}").find('.ps3'), {
                tips: [4, '#78BA32']
            });
        });
        $('#list{{$v->id}}').find('td .del').click(function () {
            layer.confirm('您确定要删除这篇文章？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('{{ url('/admin/articles/'.$v->id) }}', {
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
        $('#list{{$v->id}}').find('td .recommend').click(function () {
            layer.confirm('您确定要推荐这篇文章？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('{{ url('/admin/articles/new/recommend') }}', {
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