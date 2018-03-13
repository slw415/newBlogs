@extends('layouts.admin.app')

@section('title','权限列表')


@section('content')
    <div class="container">
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
        <button type="submit" class="btn btn-primary"style="cursor: pointer">搜索</button>
    </form>
    <button type="button" class="btn btn-primary btn-lg"style="margin: 20px 0 20px 7px;cursor: pointer">添加权限</button>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>用户</th>
            <th>角色</th>
            <th>权限</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>001</td>
            <td>Rammohan </td>
            <td>Reddy</td>
            <td>A+</td>
            <td>A+</td>
        </tr>
        <tr>
            <td>002</td>
            <td>Smita</td>
            <td>Pallod</td>
            <td>A</td>
            <td>A+</td>
        </tr>
        <tr>
            <td>003</td>
            <td>Rabindranath</td>
            <td>Sen</td>
            <td>A+</td>
            <td>A+</td>
        </tr>
        </tbody>
    </table>
    </div>
@endsection

@section('js')

@endsection