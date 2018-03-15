@extends('layouts.admin.app')

@section('title','权限')

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
            <a class="nav-link disabled" href="{{url('/admin/all/roles/permissions/'.$role['id'])}}">显示权限</a>
        </li>
    </ul>
        <div class="jumbotron"style="margin-top: 20px">
            <div class="container">
                <div style="margin-top: -20px;margin-bottom: 10px">
                <a class="btn btn-large btn-info" href="#">
                    <i class="icon-info-sign"></i>当前角色所拥有的权限</a>
                </div>
                @foreach($permissions as $v)
                    <label class="checkbox-inline">
                        <input type="checkbox" id="inlineCheckbox1"name="option"
                               value="{{$v->id}}"id="option{{$v->id}}" {{ $role->permissions->contains('id',$v->id) ? 'checked' : '' }}><a class="btn btn-small btn-primary" href="#">{{$v->name}} </a>
                    </label>
                    @endforeach
                <div>
                    <button type="button" class="btn btn-primary"id="button" style="margin-left: 15px;cursor: pointer">保存</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#button').click(function () {
            var chk_value =[];
            $('input[name="option"]:checked').each(function(){//遍历每一个名字为option的复选框，其中选中的执行函数
                chk_value.push($(this).val());//将选中的值添加到数组chk_value中
            });
            layer.confirm('您确定要这些权限？', {
                btn: ['确定', '取消'] //按钮
            }, function () {
                $.post('{{ url('/admin/roles/permissions/'.$role->id) }}', {
                    '_token': "{{ csrf_token() }}",
                    'chk_value': chk_value
                }, function (data) {
                    if (data.status == 0) {
                        layer.msg(data.msg, {icon: 6, time: 1500});
                    } else {
                        layer.msg(data.msg, {icon: 5, time: 1500});
                    }
                })
            })
        })
    </script>
@endsection