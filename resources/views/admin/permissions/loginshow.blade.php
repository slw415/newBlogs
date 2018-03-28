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
        <div class="ml-3">
        <form role="form"method="post"action="{{url('/admin/create/post')}}" enctype="multipart/form-data"id="formData">
            {{csrf_field()}}
            <div class="form-group">
                <label for="name">名称<span class="asterisk">*</span></label>
                <input type="text" class="form-control" id="name" placeholder="请输入名称"name="name">
            </div>
            <div class="form-group">
                <label for="password">密码<span class="asterisk">*</span></label>
                <input type="password" class="form-control" id="password" placeholder="请输入密码"name="password">
            </div>
            <div class="form-group">
                <label for="mobile">手机号<span class="asterisk">*</span></label>
                <input type="text" class="form-control" id="mobile" name='mobile'placeholder="请输入手机号">
            </div>
            <div class="form-group">
                <label for="birthday">生日(例：1995-09-25)<span class="asterisk">*</span></label>
                <input type="text" class="form-control" id="birthday" name="birthday"placeholder="请输入生日">
            </div>
            <div class="form-group"><span class="asterisk">*</span>
               <span class="btn btn-success fileinput-button">
                <span>上传图片</span>
                <input type="file" id="file" name="imgfile">
                </span>
                <img id="previewImage" width="100" height="100" style="visibility:hidden">
            </div>
            　　 <div class="form-group">
                <label for="name">选择角色<span class="asterisk">*</span></label>

                <select class="form-control"name="role_id">
                    @foreach($role as $v)
                    <option value="{{$v->id}}">{{$v->title}}</option>
                    @endforeach
                </select>

            </div>
            <button type="submit" class="btn btn-default">提交</button>
        </form>
    </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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