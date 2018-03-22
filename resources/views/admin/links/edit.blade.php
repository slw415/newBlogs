@extends('layouts.admin.app')

@section('title','修改友情链接')

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
            <a class="nav-link disabled" href="{{url('/admin/links')}}">友情链接</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/links/'. $links['id'].'/edit')}}">友情链接修改</a>
        </li>
    </ul>
        <div class="container"style="margin-top: 20px">
            <form action="{{url('/admin/links/'.$links['id'])}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-group">
                    <label for="url">友情地址</label>
                    <input type="text" class="form-control"name="url" id="url" placeholder="输入友情地址"value="{{$links['url']}}">
                </div>
                <div class="form-group">
                    <label for="name">友情站点</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="输入友情站点"value="{{$links['name']}}">
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