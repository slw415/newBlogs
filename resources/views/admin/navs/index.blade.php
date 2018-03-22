@extends('layouts.admin.app')

@section('title','友情链接列表')

@section('css')

@endsection

@section('content')
    <div class="container">
    <ul class="nav nav-pills"id="first_ul">
        <li class="nav-item">
            <a class="nav-link " href="{{url('/admin')}}">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/links')}}">友情链接列表</a>
        </li>
    </ul>
        <div class="ml-3 ">
        <a class="btn btn-primary" href="{{url('admin/links/new/cache')}}">
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
        <input type="text" name="input" class="form-control "style="width: 350px;" id="user" placeholder="输入用户"value="{{isset($input)?$input:''}}">
        <button type="submit" class="btn btn-primary"style="cursor: pointer">搜索</button>
    </form>
        <div class="mt-2 ml-1"><p>目前共查找到<strong class="text-primary"></strong>个职位！且每页显示<strong class="text-primary"></strong>条数。</p></div>
            <div class="mt-2 ml-2">
                <a href="{{url('/admin/links/create')}}"><button type="button" class="btn btn-primary btn-lg"style="cursor: pointer">添加友情链接</button></a>
            </div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>name</th>
            <th>创建时间</th>
            <th>更新时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    </div>

    </div>
@endsection

@section('js')
    <script>

    </script>

@endsection