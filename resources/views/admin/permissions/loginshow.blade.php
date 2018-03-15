@extends('layouts.admin.app')

@section('title','创建用户')

@section('css')

@endsection

@section('content')
    <div class="container">
    <ul class="nav nav-pills"id="first_ul">
        <li class="nav-item">
            <a class="nav-link " href="{{url('/admin')}}">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/create')}}">创建后台用户</a>
        </li>
    </ul>
        <form role="form">
            <div class="form-group">
                <label for="name">名称</label>
                <input type="text" class="form-control" id="name" placeholder="请输入名称">
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input type="password" class="form-control" id="password" placeholder="请输入密码">
            </div>
            <div class="form-group">
                <label for="mobile">手机号</label>
                <input type="text" class="form-control" id="mobile" placeholder="请输入手机号">
            </div>
            <div class="form-group">
                <label for="inputfile">图片输入</label>
                <input type="file" id="inputfile">
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox">请打勾
                </label>
            </div>
            <button type="submit" class="btn btn-default">提交</button>
        </form>
    </div>
@endsection

@section('js')

@endsection