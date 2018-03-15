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
    </div>
@endsection

@section('js')

@endsection