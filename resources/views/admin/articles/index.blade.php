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
        <div class="ml-3 ">
        <a class="btn btn-primary" href="{{url('admin/articles/new/cache')}}">
            <i class="icon-refresh icon-spin"></i>更新缓存</a>
        </div>
        @if (\Illuminate\Support\Facades\Session::has('message'))
            <div class="alert alert-success ml-3"id="message">
                {{\Illuminate\Support\Facades\Session::get('message')}}
            </div>
        @endif
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
            <th>标题</th>
            <th>作者</th>
            <th>简介</th>
            <th>标签</th>
            <th>缩略图</th>
            <th>流量人数</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @if(count($list)>0)
            @foreach($list as $v)
                <tr id="list{{$v->id}}">
                    <td>{{$v->id}}</td>
                    <td>{{$v->title}}</td>
                    <td>{{$v->user}}</td>
                    <td>{{$v->introduction}}</td>
                    <td>{{$v->keyword}}</td>
                    <td></td>
                    <th>{{$v->watch}}</th>
                    <td>{{$v->created_at}}</td>
                    <td>{{$v->updated_at}}</td>
                    <td><span><a class="btn btn-small btn-primary" href="{{url('/admin/articles/'.$v->id.'/edit')}}"><i class="icon-edit"></i>修改</a></span>&nbsp;<span><a class="del btn btn-small btn-danger" href="#"><i class="icon-trash icon-large"></i>删除</a></span></td>
                </tr>
            @endforeach
        @else
            <div class="text-muted">对不起！没有符合条件的记录！</div>
        @endif
        </tbody>
    </table>

    </div>
        {!! $list->links() !!}
    </div>
@endsection

@section('js')
    <script>
        @foreach($list as $v)
        $('#list{{$v->id}}').find('td .del').click(function () {
            layer.confirm('您确定要删除这条记录？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('{{ url('/admin/links/'.$v->id) }}', {
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