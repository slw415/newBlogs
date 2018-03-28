@extends('layouts.admin.app')

@section('title','创建权限')

@section('css')
    <style>
       .table a{
            color: #2a2730;text-decoration:none
        }
      .table a:hover{
            color: #0069d9;text-decoration:none
        }
    </style>
@endsection

@section('content')
    <div class="container">
    <ul class="nav nav-pills"id="first_ul">
        <li class="nav-item">
            <a class="nav-link " href="{{asset('/admin')}}">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/permissions')}}">权限列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/permissions/create')}}">创建权限</a>
        </li>
    </ul>
        <div class="container"style="margin-top: 20px">
            <form action="{{url('/admin/permissions')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">权限名<span class="asterisk">*</span></label>
                    <input type="text" class="form-control"name="name" id="name" placeholder="输入权限名">
                </div>
                <div class="form-group">
                    <label for="title">权限备注<span class="asterisk">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="输入权限备注">
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
            </form>
            @if (count($errors) > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style="color: #f0ad4e;margin-left: 30px;margin-bottom: 10px;">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

@endsection

@section('js')

@endsection