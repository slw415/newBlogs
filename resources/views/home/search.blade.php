@extends('layouts.home.app')

@section('title','搜索页')

@section("content")
    <div class="leftbox">
        <div class="newblogs">
         {{--  <h2 class="hometitle"><span>{{$nav->title}}</span>{{$nav->name}}</h2>--}}
            <ul>
                @if(count($list)>0)
                @foreach($list as $v)
                <li>
                    <h3 class="blogtitle"><a href="/jstt/css3/2018-03-25/811.html" target="_blank" >{{$v->title}}</a></h3>
                    <div class="bloginfo"><span class="blogpic"><a href="/jstt/css3/2018-03-25/811.html" title="{{$v->title}}"><img src="{{$v->imgfile}}" alt="{{$v->title}}" /></a></span>
                        <p>{{$v->introduction}}</p>
                    </div>
                    <div class="autor"><span class="lm f_l"><a href="/jstt/css3/" title="css3" target="_blank"  class="classname">{{$v->nav->name}}</a></span><span class="dtime f_l">{{substr($v->updated_at, 0, 10)}}</span><span class="viewnum f_l">浏览（<a href="/">{{$v->watch}}</a>）</span><span class="f_r"><a href="/jstt/css3/2018-03-25/811.html" class="more">阅读原文>></a></span></div>
                </li>
                @endforeach
                @else
                    <div class="alert alert-info">此人比较懒，啥也没写</div>
                @endif
            </ul>
            <div id="pull_right">
                <div class="pull-right">
                    {!! $list->links() !!}
                </div>
            </div>
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
                <li><b><a href="/jstt/css3/2018-03-20/808.html" target="_blank">{{$v->title}}</a></b>
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
                <li><b><a href="/jstt/bj/2015-01-09/740.html" target="_blank">{{$v->title}}</a></b>
                    <p>{{str_limit($v->introduction, $limit = 30, $end = '...')}}</p>
                </li>
                @endforeach
            </ul>
            <div class="ad"><img src="{{asset('picture/ad01.jpg')}}"></div>
        </div>
        <div class="weixin">
            <h2 class="ab_title">个人微信</h2>
            <ul>
                <img src="{{asset('picture/wx.png')}}">
            </ul>
        </div>
    </div>
@endsection

