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
           {{--     <div class="form-group">
                    <label for="keyword">标签</label>
                    <input type="text" class="form-control" id="keyword" name='keyword'placeholder="请输入标签">
                </div>--}}
                <div class="form-group"id="addSite">
                <span ><a class="btn btn-small btn-primary" href="#"><i class=" icon-heart"></i>添加标签</a></span>
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
  /*      <div class="layui-form-item">
        <label class="layui-form-label">复选框</label>
        <div class="layui-input-block">
        <input type="checkbox" name="like[write]" title="写作">
        <input type="checkbox" name="like[read]" title="阅读">
        </div>
        </div>*/

    $("#addSite").click(function () {
        layer.open({
            title: '添加标签',
            type: 1,
            area: ['700px', '400px'],
            content: '<blockquote class="layui-elem-quote layui-text">请选择你的标签</blockquote>' +
            '<div class="layui-form-item ">' +
            '<div class="layui-inline">' +
            '<label class="layui-form-label">编程</label>' +
            '<input type="checkbox" name="key1" title="Laravel"value="Laravel" >Laravel' +
            '<input type="checkbox" name="key1" title="Php"value="Php" >Php' +
            '<input type="checkbox" name="key1" title="Java"value="Java">Java' +
            '<input type="checkbox" name="key1" title="Js"value="Js">Js' +
            '<input type="checkbox" name="key1" title="Css"value="Css">Css' +
            '<input type="checkbox" name="key1" title="Html5"value="Html5">Html5' +
            '</div></div>' +
            '<div class="layui-form-item ">' +
            '<div class="layui-inline">' +
            '<label class="layui-form-label">其他</label>' +
            '<input type="checkbox" name="key1" title="网站"value="网站">网站' +
            '<input type="checkbox" name="key1" title="服务器"value="服务器">服务器' +
            '<input type="checkbox" name="key1" title="手机"value="手机">手机' +
            '<input type="checkbox" name="key1" title="git"value="git">git' +
            '</div></div>' ,

            btnAlign: 'c',
            btn: ['确定', '取消'],
            yes: function (index, layero) {
                var str = $("input[name=isIndividual]").val();
                if (str == "on") {
                    str = "1";
                } else {
                    str = "0";
                }

                if ($("input[name=key1]:checked").length==0) {
                    layer.msg('请选择1个标签', {icon: 5, time: 2000, area: '200px', type: 0, anim: 6,}, function () {
                        $("input[name=key1]").focus();
                    });
                    return false;
                } else if ($("input[name=key1]:checked").length >5 ) {
                    layer.msg('最多选择5个标签', {icon: 5, time: 2000, area: '200px', type: 0, anim: 6,}, function () {
                        $("input[name=key1]").focus();
                    });
                    return false;
                }
                var formData = [];
                     $('input[name="key1"]:checked').each(function() {
                         formData.push($(this).val());
                     })
               var demo=$('#demo')
                console.log(formData);
                     //删除原有标签元素
                     if(demo)
                     {
                         demo.remove();
                     }
                    if (formData) {
                        $('#addSite').after(
                            '<div class="form-group" id="demo">'+
                            '<input id="key1"type="text" name="keyword1"size="4"  readonly="true"style="display: none;"/> '+
                            '<input id="key2"type="text" name="keyword2"size="4"  readonly="true"style="display: none;"/> '+
                            '<input id="key3"type="text" name="keyword3"size="4"  readonly="true"style="display: none;"/> '+
                            '<input id="key4"type="text" name="keyword4"size="4"  readonly="true"style="display: none;"/> '+
                            '<input id="key5"type="text" name="keyword5"size="4"  readonly="true"style="display: none;"/> '+
                            '</div>'
                        );
                        console.log(formData[0])
                        if(formData[0]){
                            $('#key1').val(formData[0]);
                            $('#key1').css('display','inline');
                        }
                        if(formData[1]){
                            $('#key2').val(formData[1]);
                            $('#key2').css('display','inline');
                        }
                        if(formData[2]){
                            $('#key3').val(formData[2]);
                            $('#key3').css('display','inline');
                        }
                         if(formData[3]){
                            $('#key4').val(formData[3]);
                             $('#key4').css('display','inline');
                        }
                        if(formData[4]){
                            $('#key5').val(formData[4]);
                            $('#key5').css('display','inline');
                        }


                layer.close(index);
                        parent.document.getElementById('my_iframe').contentWindow.location.reload(true);

                    } else {
                        layer.msg("保存失败...", {type: 1});
                    }

            },

        });
    })
</script>
@endsection