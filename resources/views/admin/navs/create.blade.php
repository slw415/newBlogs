@extends('layouts.admin.app')

@section('title','创建导航栏')

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
            <a class="nav-link disabled" href="{{url('/admin/navs')}}">导航列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/navs/create')}}">创建导航链接</a>
        </li>
    </ul>
        <div class="container">
            <form action="{{url('/admin/navs')}}" method="post">
                {{csrf_field()}}
                    <div class="form-group">
                    <label for="name">选择导航栏</label>
                    <select class="form-control" name="cid">
                        <option value="0">1级导航</option>

                        @foreach($nav as $v)

                        <option value="{{$v['id']}}">{{$v['name']}}</option>
                         @endforeach
                    </select>
                    </div>
                <div class="form-group">
                    <label for="name">导航栏名字<span class="asterisk">*</span></label>
                    <input type="text" class="form-control"name="name" id="name" placeholder="输入导航栏名字">
                </div>
                <div class="form-group">
                    <label for="title">导航名言<span class="asterisk">*</span></label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="导航名言">
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