@extends('layouts.admin.app')

@section('title','修改角色')

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
            <a class="nav-link disabled" href="{{url('/admin/roles')}}">角色列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/roles/'. $role['id'].'/edit')}}">角色修改</a>
        </li>
    </ul>
        <div class="container"style="margin-top: 20px">
            <form action="{{url('/admin/roles/'.$role['id'])}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <label for="name">权限名<span class="asterisk">*</span></label>
                    <input type="text" class="form-control"name="name" id="name" placeholder="输入权限名"value="{{$role['name']}}">
                </div>
                <div class="form-group">
                    <label for="title">权限备注<span class="asterisk">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="输入权限备注"value="{{$role['title']}}">
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