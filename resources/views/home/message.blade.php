@extends('layouts.home.app')

@section('title','留言')

@section("content")
    <div class="container ">
        <div class="row">
            <div class="col-md-9 mx-auto">
                <div class="leftbox">
                    <div class="newblogs">
                        <h2 class="hometitle"><span>巴尔比厄开博时并没抱多大的期望；他只是希望和一些人聊聊天。</span>留言板</h2>
                    </div>
                <div class="blog-post">
                    发布留言
                </div>
                <hr />
                    @if(count($comment)>0)
                        @foreach($comment as $v)
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object img-circle" src="{{asset($v['con']['user']['imgfile'])}}" alt="64x64" style="width: 64px; height: 64px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading"><span class=" text-info">{{$v['con']['user']['name']}}</span>&nbsp;<span style="font-size: 10px;">{{$v['con']['created_at_show']}}</span></h4>
                                    <div class="mt-2">{!!$v['con']['body']!!}</div>
                                    @if(auth()->check() && auth()->guard('users')->user()->id != $v['con']['user_id'])
                                        <div class="mt-2 pull-right"><span class="layui-btn layui-btn-radius layui-btn-sm "id="replay{{$v['con']['id']}}">回复</span></div>
                                    @elseif(!auth()->check())
                                        <div class="mt-2 pull-right"><span class="layui-btn layui-btn-radius layui-btn-sm "id="red{{$v['con']['id']}}">回复</span></div>
                                    @endif

                                </div>
                            </div>
                        <hr/>
                            @if(count($v['son'])>0)
                                @foreach($v['son'] as $v1)
                                    <div class="media ml-4">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object img-circle" src="{{asset($v1['con']['user']['imgfile'])}}" alt="64x64" style="width: 64px; height: 64px;">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading"><span class=" text-info">{{$v1['con']['user']['name']}}</span>@<span class=" text-primary"> {{$v['con']['user']['name']}}</span>&nbsp;<span style="font-size: 10px;">{{$v['con']['created_at_show']}}</span></h4>
                                            <div class="mt-2">{!!$v1['con']['body']!!}</div>
                                        </div>
                                    </div>
                                    <hr/>
                                @endforeach
                            @endif
                        @endforeach
                    @else
                        <div class="alert alert-info">还没有留言，小编要伤心了</div>
                    @endif
                <textarea id="demo" style="display: none;" name="body"></textarea>
                <button class="layui-btn layui-btn-radius layui-btn-sm mt-1"id="comment">提交</button>
                <script>
                    layui.use('layedit', function(){
                        var layedit = layui.layedit;
                        index =   layedit.build('demo',{
                            height: 60, //设置编辑器高度
                            tool: [
                                'strong' //加粗
                                ,'italic' //斜体
                                ,'underline' //下划线
                                ,'del' //删除线
                                ,'face' //表情
                            ]
                        }); //建立编辑器
                        var active = {
                            content: function () {
                                body = (layedit.getContent(index));
                                return body;
                            }
                        }

                        $('#comment').click(function () {
                            @if(\Illuminate\Support\Facades\Auth::guard('users')->check())
                            layer.confirm('您确定要提交留言？', {
                                btn: ['确定', '取消'] //按钮
                            }, function () {
                                $.post('{{ url('/message') }}', {
                                    '_token': "{{ csrf_token() }}",
                                    'body':active['content']
                                }, function (data) {
                                    location.reload();
                                    if (data.status == 0) {
                                        layer.msg(data.msg, {icon: 6, time: 1500});
                                    }
                                    if(data.status== 1) {
                                        layer.msg(data.msg, {icon: 5, time: 1500});
                                    }
                                    if(data.status==2){
                                        layer.msg(data.msg, {icon: 5, time: 1500});
                                    }
                                })
                            })
                            @else
                            layer.open({
                                content: '您还未登陆！无法留言',
                                btn: ['童鞋go', '取消'],
                                yes: function(index, layero) {
                                    window.location.href='/login';
                                },
                                cancel: function() {
                                    //右上角关闭回调

                                }
                            });
                            @endif
                        })
                    });

                    @foreach($comment as $v)
                    $('#red{{$v['con']['id']}}').one('click',function () {
                        layer.open({
                            content: '您还未登陆！无法留言',
                            btn: ['童鞋go', '取消'],
                            yes: function(index, layero) {
                                window.location.href='/login';
                            },
                            cancel: function() {
                                //右上角关闭回调

                            }
                        });

                    })

                    $('#replay{{$v['con']['id']}}').one('click',function () {
                        $('#replay{{$v['con']['id']}}').parent().parent().parent().after(
                            '<textarea id="index"name="body" style="display: none;"class="mt-6"></textarea> '+
                            ' <button class="layui-btn layui-btn-radius layui-btn-sm mt-1"id="sub">提交</button>'
                        )
                        layui.use('layedit', function () {
                            var layedit = layui.layedit;
                            index = layedit.build('index', {
                                height: 60, //设置编辑器高度
                                tool: [
                                    'strong' //加粗
                                    , 'italic' //斜体
                                    , 'underline' //下划线
                                    , 'del' //删除线
                                    , 'face' //表情
                                ]
                            });
                            //建立编辑器
                            var active = {
                                content: function () {
                                    body = (layedit.getContent(index));
                                    return body;
                                }
                            }
                            $('#sub').click(function () {
                                layer.confirm('您确定要提交留言？', {
                                    btn: ['确定', '取消'] //按钮
                                }, function () {
                                    $.post('{{ url('/message') }}', {
                                        '_token': "{{ csrf_token() }}",
                                        'body':active['content'],
                                        'pid':'{{$v['con']['id']}}'
                                    }, function (data) {
                                        location.reload();
                                        if (data.status == 0) {
                                            layer.msg(data.msg, {icon: 6, time: 1500});
                                        }
                                        if(data.status== 1) {
                                            layer.msg(data.msg, {icon: 5, time: 1500});
                                        }
                                        if(data.status==2){
                                            layer.msg(data.msg, {icon: 5, time: 1500});
                                        }
                                    })
                                })
                            })
                        })
                    })

                    @endforeach
                </script>
            </div>
        </div>
    </div>
    </div>
@endsection