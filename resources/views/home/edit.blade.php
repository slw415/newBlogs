@extends('layouts.home.app')

@section('title','前台修改账户信息')

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
    .col-center-block {
        float: none;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
    .asterisk{color: #ff0000;width:10px; font-size:20px;float: left; margin-top:4px; height: 30px;}
</style>
@section('content')
    <div class="col-md-6 col-center-block ">
        @if (\Illuminate\Support\Facades\Session::has('message'))
            <div class="alert alert-success ml-3"id="message">
                {{\Illuminate\Support\Facades\Session::get('message')}}
            </div>
        @endif
    <div class="container mt-3">
        <div >
            <form role="form"method="post"action="{{url('/update')}}" enctype="multipart/form-data"id="formData">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name">名称<span class="asterisk">*</span></label>
                    <input type="text" class="form-control " id="name" placeholder="请输入名称"name="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="email">邮箱<span class="asterisk">*</span></label>
                    <input type="text" class="form-control" id="email" name='email'placeholder="请输入email"value="{{$user->email}}">
                </div>
                <div class="form-group">
                    <label for="website">个人网站</label>
                    <input type="text" class="form-control" id="website" name='website'placeholder="请输入网站"value="{{$user->website}}">
                </div>
                <div class="form-group">
                    <label for="birthday">生日(例：1995-09-25)<span class="asterisk">*</span></label>
                    <input type="text" class="form-control" id="birthday" name="birthday"placeholder="请输入生日"value="{{$user->birthday}}">
                </div>
                <div class="form-group">
               <span class="btn btn-success fileinput-button">
                <span>上传图片</span>
                <input type="file" id="file" name="imgfile" >
                </span>
                    <img src="{{!empty($user->imgfile)?$user->imgfile:'images/b04.jpg'}}"width="100" height="100" id="imgfile"style="display: inline">
                    <input type="hidden"name="img"value="{{!empty($user->imgfile)?$user->imgfile:'images/b04.jpg'}}"/>
                    <img id="previewImage" width="100" height="100" style="visibility:hidden;display: inline">
                </div>
                <div class="form-group">
                    <label for="job">职业</label>
                    <input type="text" class="form-control" id="job" name='job'placeholder="职业"value="{{$user->job}}">
                </div>
                <button type="submit" class="btn  btn-default">提交</button>
            </form>
        </div>
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


    </script>

@endsection


