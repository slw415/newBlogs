@extends('layouts.admin.app')

@section('title','后台首页')

@section('css')
<style>

</style>
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3 ml-2 border border-primary w-25 p-3 text-primary" >
                <h4>PHP版本:</h4>
                <p>{{PHP_VERSION}}</p>
            </div>
            <div class="col-md-3 ml-2 border border-success w-25 p-3 text-primary" >
                <h4>ZEND版本：</h4>
                <p>{{zend_version()}}</p>
            </div>
            <div class="col-md-3 ml-2 border border-info w-25 p-3 text-primary" >
                <h4>当前浏览器：</h4>
                <p>{{$br}}</p>
            </div>
    </div>
        <div class="row">
            <div class="col-md-3 ml-2 border border-primary w-25 p-3 text-primary"  >
                <h4>浏览器语言</h4>
                <p>{{$lang}}</p>
            </div>
            <div class="col-md-3 ml-2 border border-success w-25 p-3 text-primary" >
                <h4>访客操作系统</h4>
                <p>{{$os}}</p>
            </div>
            <div class="col-md-3 ml-2 border border-info w-25 p-3 text-primary" >
                <h4>当前浏览器：</h4>
                <p>{{$br}}</p>
            </div>
        </div>
        <div class="row">
        <div class="col-md-3 ml-2 border border-primary w-25 p-3 text-primary" >
            <h4>服务器IP</h4>
            <p>{{GetHostByName($_SERVER['SERVER_NAME'])}}</p>
        </div>
        <div class="col-md-3 ml-2 border border-success w-25 p-3 text-primary" >
            <h4>PHP运行方式</h4>
            <p>{{  php_sapi_name() }}</p>
        </div>
        <div class="col-md-3 ml-2 border border-info w-25 p-3 text-primary" >
            <h4>系统版本号</h4>
            <p>{{php_uname('r')  }}</p>
        </div>
        </div>
    </div>



@endsection