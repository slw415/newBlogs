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

                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="blog-post">
                            ss
                            </div>
                            <hr />
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#">
                                            <img class="media-object img-circle" src="{{asset('images/b04.jpg')}}" alt="64x64" style="width: 64px; height: 64px;">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">ssssssssss</h4>
                                            ssssssssssssssssssssssssssssssssss
                                    </div>
                                </div>
                            <hr/>
                            <div class="media">
                                <div class="media-left">
                                    <a href="#">
                                        <img class="media-object img-circle" src="{{asset('images/b04.jpg')}}" alt="64x64" style="width: 64px; height: 64px;">
                                    </a>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">ssssssssss</h4>
                                    ssssssssssssssssssssssssssssssssss
                                </div>
                            </div>
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