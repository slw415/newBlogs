@extends('layouts.home.app')

@section('title','施帅帅blog首页')

@section("content")

        <div class="pics">
            <ul>
                @foreach($watch as $v)
                <li><a href="#" target="_blank"><img src="{{$v->imgfile}}"></a><span> {{str_limit($v->title, $limit = 40, $end = '...')}}</span></li>
                @endforeach
            </ul>
        </div>
        <div class="sleftbox">
            <div class="tuijian">
                <h2 class="hometitle">编程文章</h2>
                <ul>
                @foreach($programming as $v)
                    <li>
                        <div class="tpic"><img src="{{$v->imgfile}}"></div>
                        <b>{{$v->title}}</b><span>{{str_limit($v->introduction, $limit = 30, $end = '...')}}</span><a href="{{url('/article/'.$v->id)}}" target="_blank"  class="readmore">阅读</a>
                    </li>
                @endforeach
                </ul>
            </div>
            <div class="newblogs">
                <h2 class="hometitle">最新文章</h2>
                <ul>
                    @foreach($new as $v)
                        <li>
                            <h3 class="blogtitle"><a href="{{url('/article/'.$v->id)}}" target="_blank" >{{$v->title}}</a></h3>
                            <div class="bloginfo"><span class="blogpic"><a href="{{url('/article/'.$v->id)}}" title="{{$v->title}}"><img src="{{$v->imgfile}}" alt="{{$v->title}}" /></a></span>
                                <p>{{str_limit($v->introduction, $limit = 200 ,$end = '...')}}</p>
                            </div>
                            <div class="autor"><span class="lm f_l"><a href="{{url('list/'.$v->nav->id)}}" title="{{$v->nav->name}}" target="_blank"  class="classname">{{$v->nav->name}}</a></span><span class="dtime f_l">{{substr($v->updated_at, 0, 10)}}</span><span class="viewnum f_l">浏览（<a href="/">{{$v->watch}}</a>）</span><span class="f_r"><a href="{{url('/article/'.$v->id)}}" class="more">阅读原文>></a></span></div>
                        </li>
                    @endforeach
                        <div id="pull_right">
                            <div class="pull-right">
                                {!! $new->links() !!}
                            </div>
                        </div>
                </ul>
            </div>
        </div>
        <div class="srightbox">
            <div class="aboutme">
                <h2 class="ab_title">关于我</h2>
                @if(count($user)>0)
                    <div class="avatar"><img src="{{empty($user->imgfile)?'images/b04.jpg':$user->imgfile}}" /></div>
                @else
                <div class="avatar"><img src="{{asset('images/b04.jpg')}}" /></div>
                @endif
                <div class="ab_con">
                    @if(count($user)>0)
                    <p>网名：{{$user->name}} </p>
                    @if($user->job)
                            <p>职业：{{$user->job}} </p>
                        @endif
                     @if($user->website)
                    <p>个人网站：{{$user->website}}</p>
                        @endif
                    <p>邮箱：{{$user->email}}</p>
                        <p style="text-align: center"><a class="btn btn-small btn-success" href="{{url('/edit')}}">
                                <i class=" icon-heart"></i>&nbsp;修改资料</a></p>
                        @else
                        <p style="text-align: center">您还未登录，请先登录</p>
                        <p style="text-align: center"> <span><a href="{{ route('login') }}">登录</a></span>
                            <span><a href="{{ route('register') }}">注册</a></span>
                        </p>
                        @endif
                </div>
            </div>
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
                <h2 class="ab_title"><a href="#">点击排行</a></h2>
                <ul>
                    @foreach($watch as $v)
                    <li><b><a href="{{url('/article/'.$v->id)}}" target="_blank">{{$v->title}}</a></b>
                        <p>{{str_limit($v->introduction, $limit = 30, $end = '...')}}</p>
                    </li>
                        @endforeach
                </ul>
                <div class="ad"><img src="{{asset('picture/ad300x100.jpg')}}"></div>
            </div>
            <div class="paihang">
                <h2 class="ab_title"><a href="/">站长推荐</a></h2>
                <ul>
                    @foreach($recommend as $v)
                    <li><b><a href="{{url('/article/'.$v->id)}}" target="_blank">{{$v->title}}</a></b>
                        <p>{{str_limit($v->introduction, $limit = 30, $end = '...')}}</p>
                    </li>
                    @endforeach
                </ul>
                <div class="ad"><img src="{{asset('picture/ad01.jpg')}}"></div>
            </div>
            <div class="links">
                <h2 class="ab_title">友情链接</h2>
                <ul>
                    @foreach($links as $v)
                    <li><a href="{{$v->url}}">{{$v->name}}</a></li>
                        @endforeach
                </ul>
            </div>
            <div class="weixin">
                <h2 class="ab_title">个人微信</h2>
                <ul>
                    <img src="{{asset('picture/wx.png')}}">
                </ul>
            </div>
        </div>

@endsection