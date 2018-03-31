@extends('layouts.home.app')

@section('title',$article->title)

@section("content")

    <div class="leftbox">
        <div class="infos">
            <div class="newsview">
                <h2 class="intitle">您现在的位置是：<a href="/">首页</a>&nbsp;>&nbsp;@if(count($nav->nav)>0)<a href="{{url('list/'.$nav->nav->id)}}">{{isset($nav->nav->name)?$nav->nav->name:''}}</a>&nbsp;>&nbsp;@endif<a href="{{url('list/'.$nav->id)}}">{{$nav->name}}</a></h2>
                <h3 class="news_title">{{$article->title}}</h3>
                <div class="news_author"><span class="au01">{{$article->user}}</span><span class="au02">{{substr($article->updated_at, 0, 10)}}</span><span class="au03">共<b>{{$article->watch}}</b>人浏览</span></div>
                <div class="tags">
                    @if($article->keyword1)<a href="#">{{$article->keyword1}}</a>@endif @if($article->keyword2)<a href="#">{{$article->keyword2}}</a>@endif
                    @if($article->keyword3)<a href="#">{{$article->keyword3}}</a>@endif @if($article->keyword4)<a href="#" >{{$article->keyword4}}</a>@endif
                    @if($article->keyword5)<a href="#">{{$article->keyword5}}</a>@endif
                </div>
                <div class="news_about"><strong>简介</strong>{{$article->introduction}}</div>
                <div class="news_infos">
                    {!! $article->content !!}
                </div>
            </div>
        </div>
        <div class="nextinfo">
            <p>上一篇：@if(count($prev)>0)<a href='{{url('/article/'.$prev->id)}}'>{{$prev->title}}</a>@else 没有上一篇@endif</p>
            <p>下一篇：@if(count($next)>0)<a href='{{url('/article/'.$next->id)}}'>{{$next->title}}</a>@else 没有下一篇@endif</p>
        </div>
        <div class="otherlink">
            <h2>相关文章</h2>
            <ul>
                @foreach($relevant as $v)
                    <li><a href="" title="{{$v->title}}">{{$v->title}}</a></li></ul>
                @endforeach
        </div>

        <div class="news_pl">
            <h2>文章评论</h2>
            <ul>
            <hr/>
                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            @if(count($comment)>0)

                            @foreach($comment as $v)

                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object img-circle" src="{{asset($v['con']['user']['imgfile'])}}" alt="64x64" style="width: 64px; height: 64px;">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading"><span class=" text-info">{{$v['con']['user']['name']}}&nbsp;</span><span style="font-size: 10px;">{{$v['con']['created_at_show']}}</span></h4>
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
                                                    <h4 class="media-heading"><span class=" text-info">{{$v1['con']['user']['name']}}</span>@ <span class=" text-primary">{{$v['con']['user']['name']}}</span>&nbsp;<span style="font-size: 10px;">{{$v['con']['created_at_show']}}</span></h4>
                                                    <div class="mt-2">{!!$v1['con']['body']!!}</div>
                                                </div>
                                            </div>
                                            <hr/>
                                            @endforeach
                                    @endif
                            @endforeach
                            @else
                                <div class="alert alert-info">还没有童鞋评论，小编要伤心了</div>
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
                                            layer.confirm('您确定要提交评论？', {
                                                btn: ['确定', '取消'] //按钮
                                            }, function () {
                                                $.post('{{ url('/comment') }}', {
                                                    '_token': "{{ csrf_token() }}",
                                                    'id': "{{ $article->id }}",
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
                                                content: '您还未登陆！无法评论',
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
                                            content: '您还未登陆！无法评论',
                                            btn: ['童鞋go', '取消'],
                                            yes: function (index, layero) {
                                                window.location.href = '/login';
                                            },
                                            cancel: function () {
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
                                                layer.confirm('您确定要提交评论？', {
                                                    btn: ['确定', '取消'] //按钮
                                                }, function () {
                                                    $.post('{{ url('/comment') }}', {
                                                        '_token': "{{ csrf_token() }}",
                                                        'id': "{{ $article->id }}",
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
                                <hr/>

                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
    <div class="rightbox">
        <div class="search">
            <form action="{{'/search'}}" method="get" name="searchform" id="searchform">
                <input name="keyboard" id="keyboard" class="input_text" placeholder="请输入文章标题" style="color: rgb(153, 153, 153);" onfocus="if(value=='请输入关键字'){this.style.color='#000';value=''}" onblur="if(value==''){this.style.color='#999';value='请输入关键字'}" type="text"value="{{isset($input)?$input:''}}">
                <input name="show" value="title" type="hidden">
                <input name="tempid" value="1" type="hidden">
                <input name="tbname" value="news" type="hidden">
                <input name="Submit" class="input_submit" value="搜索" type="submit">
            </form>
        </div>
        <div class="paihang">
            <h2 class="ab_title"><a href="/">本栏推荐</a></h2>
            <ul>
                @foreach($recommend as $v)
                <li><b><a href="{{url('/article/'.$v->id)}}" target="_blank">{{$v->title}}</a></b>
                    <p>{{str_limit($v->introduction, $limit = 30, $end = '...')}}</p>
                </li>
                 @endforeach
            </ul>
            <div class="ad"><img src="{{asset('picture/ad300x100.jpg')}}"></div>
        </div>
        <div class="paihang">
            <h2 class="ab_title"><a href="/">点击排行</a></h2>
            <ul>
                @foreach($watch as $v)
                <li><b><a href="{{url('/article/'.$v->id)}}" target="_blank">{{$v->title}}</a></b>
                    <p>{{str_limit($v->introduction, $limit = 30, $end = '...')}}</p>
                </li>
                @endforeach
            </ul>
            <div class="ad"><img src="{{asset('picture/ad01.jpg')}}"></div>
        </div>
        <div class="weixin">
            <h2 class="ab_title">个人微信</h2>
            <ul>
                <img src="{{asset('picture/wx.png')}}"/>
            </ul>
        </div>
    </div>
@endsection

@section('js')

@endsection