@extends('layouts.admin.app')

@section('title','权限列表')


@section('content')
    <ul class="nav nav-pills"id="first_ul">
        <li class="nav-item">
            <a class="nav-link " href="#">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="#">权限列表</a>
        </li>
    </ul>
    <form class="form-inline">
        <input type="text" class="form-control "style="width: 350px;margin-left: 5px" id="user" placeholder="输入用户或者权限名">
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <button type="button" class="btn btn-primary btn-lg"style="margin: 20px 0 20px 7px">添加权限</button>
    <table class="table table-condensed">
        <tbody>
        <tr>
            <th data-field="name">用户账号</th>
            <th data-field="pwd">用户密码</th>
            <th data-field="t_name">教师姓名</th>
        </tr>
        <tr>
            <th data-field="name">用户账号</th>
            <th data-field="pwd">用户密码</th>
            <th data-field="t_name">教师姓名</th>
        </tr>
        <tr>
            <th data-field="name">用户账号</th>
            <th data-field="pwd">用户密码</th>
            <th data-field="t_name">教师姓名</th>
        </tr>
        <tr>
            <th data-field="name">用户账号</th>
            <th data-field="pwd">用户密码</th>
            <th data-field="t_name">教师姓名</th>
        </tr>
        </tbody>
    </table>

@endsection

@section('js')

@endsection