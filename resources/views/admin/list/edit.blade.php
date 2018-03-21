@extends('layouts.admin.app')

@section('title','修改后台用户')

@section('css')

@endsection
<style>
    .fileinput-button {
        position: relative;
        display: inline-block;
        overflow: hidden;
    }

    .fileinput-button input{
        position:absolute;
        right: 0px;
        top: 0px;
        opacity: 0;
        -ms-filter: 'alpha(opacity=0)';
        font-size: 200px;
    }
</style>
@section('content')
    <div class="container">
    <ul class="nav nav-pills"id="first_ul">
        <li class="nav-item">
            <a class="nav-link " href="{{url('/admin')}}">首页</a>
        </li>
        <li class="nav-item">
            <a class="nav-link disabled" href="{{url('/admin/list/'.$id.'/edit')}}">修改后台用户</a>
        </li>
    </ul>
        <div class="ml-3">
        <form role="form"method="post"action="{{url('/admin/list/'.$data['id'])}}" enctype="multipart/form-data"id="formData">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PATCH">
            <div class="form-group">
                <label for="name">名称</label>
                <input type="text" class="form-control" id="name" placeholder="请输入名称"name="name" value="{{$data['name']}}">
            </div>
            <div class="form-group">
                <label for="mobile">手机号</label>
                <input type="text" class="form-control" id="mobile" name='mobile'placeholder="请输入手机号"value="{{$data['mobile']}}">
            </div>
            <div class="form-group">
                <label for="birthday">生日(例：1995-09-25)</label>
                <input type="text" class="form-control" id="birthday" name="birthday"placeholder="请输入生日"value="{{$data['birthday']}}">
            </div>
            <div class="form-group">
               <span class="btn btn-success fileinput-button">
                <span>上传图片</span>
                <input type="file" id="file" name="imgfile" >
                </span>
                <img src="{{asset($data['imgfile'])}}"width="100" height="100" id="imgfile">
                <input type="hidden"value="{{$data['imgfile']}}"name="img"/>
                <img id="previewImage" width="100" height="100" style="visibility:hidden">
            </div>
            　　 <div class="form-group">
                <label for="name">选择角色</label>
                <select class="form-control"name="role_id"id="role_id">
                    @foreach($role as $v)
                        <option value="{{$v['id']}}">{{$v['title']}}</option>
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
                        $('#imgfile').css('display','none');
                    };
                })(f);
                reader.readAsDataURL(f);
            }
        }
            $(function () {

                var rl={{$rl_id->role_id}}
                $('#role_id option').each(function () {
                    if($(this).val() ==rl){
                        $(this).attr("selected",true);
                    }
                })
            })


    </script>

@endsection