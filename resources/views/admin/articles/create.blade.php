@extends('layouts.admin.app')

@section('title','创建文章')

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
            <a class="nav-link disabled" href="{{url('/admin/articles')}}">文章列表</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/articles/create')}}">创建文章</a>
        </li>
    </ul>
        <div class="container"style="margin-top: 20px">
            <form action="{{url('/admin/articles')}}" method="post"enctype="multipart/form-data"id="formData">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">选择分类</label>
                    <select class="form-control" name="cid">
                        @foreach($nav as $v)
                            <option value="{{$v->id}}">{{$v->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">标题</label>
                    <input type="text" class="form-control" id="title" placeholder="请输入标题"name="title">
                </div>
                <div class="form-group">
                    <label for="user">作者</label>
                    <input type="text" class="form-control" id="user" placeholder="请输入作者"name="user">
                </div>
                <div class="form-group">
                    <label for="keyword">标签</label>
                    <input type="text" class="form-control" id="keyword" name='keyword'placeholder="请输入标签">
                </div>
                <div class="form-group">
                    <label for="introduction">简介</label>
                    <input type="text" class="form-control" id="introduction" name="introduction"placeholder="请输入简介">
                </div>
                <div class="form-group">
               <span class="btn btn-success fileinput-button">
                <span>上传缩略图</span>
                <input type="file" id="file" name="imgfile">
                </span>
                    <img id="previewImage" width="100" height="100" style="visibility:hidden">
                </div>
                <div class="form-group">
                    <span>文章内容</span>
                @include('vendor.ueditor.assets')
            <!-- 实例化编辑器 -->
                <script type="text/javascript">

                    var ue = UE.getEditor('container');
                    ue.ready(function() {
                        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                    });
                </script>

                <!-- 编辑器容器 -->
                <script id="container" name="content" type="text/plain"></script>
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
<script>
    document.getElementById('file').onchange = function (evt) {
        // 如果浏览器不支持FileReader，则不处理
        if (!window.FileReader) return;
        var files = evt.target.files;
        for (var i = 0, f; f = files[i]; i++) {
            //不是图片不处理
            if (!f.type.match('image.*')) {

                continue;
            }
            var reader = new FileReader();
            reader.onload = (function (theFile) {
                return function (e) {
                    document.getElementById('previewImage').src = e.target.result;
                    $('#previewImage').css('visibility','visible');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    }
</script>
@endsection