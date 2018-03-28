@extends('layouts.home.app')

@section('title','施帅帅blog首页')

@section("content")
    <div class="leftbox">
        <div class="newblogs">
            <h2 class="hometitle"><span>{{$nav->title}}</span>{{$nav->name}}</h2>
            <ul>
                
                @foreach($list as $v)
                <li>
                    <h3 class="blogtitle"><a href="/jstt/css3/2018-03-25/811.html" target="_blank" >{{$v->title}}</a></h3>
                    <div class="bloginfo"><span class="blogpic"><a href="/jstt/css3/2018-03-25/811.html" title="{{$v->title}}"><img src="{{$v->imgfile}}" alt="{{$v->title}}" /></a></span>
                        <p>{{$v->introduction}}</p>
                    </div>
                    <div class="autor"><span class="lm f_l"><a href="/jstt/css3/" title="css3" target="_blank"  class="classname">{{$v->nav->name}}</a></span><span class="dtime f_l">{{$v->created_at}}</span><span class="viewnum f_l">浏览（<a href="/">{{$v->watch}}</a>）</span><span class="f_r"><a href="/jstt/css3/2018-03-25/811.html" class="more">阅读原文>></a></span></div>
                </li>
                @endforeach

            </ul>
            <div class="pagelist"><a title="Total record">&nbsp;<b>146</b> </a>&nbsp;&nbsp;&nbsp;<b>1</b>&nbsp;<a href="/jstt/index_2.html">2</a>&nbsp;<a href="/jstt/index_3.html">3</a>&nbsp;<a href="/jstt/index_4.html">4</a>&nbsp;<a href="/jstt/index_5.html">5</a>&nbsp;<a href="/jstt/index_6.html">6</a>&nbsp;<a href="/jstt/index_2.html">下一页</a>&nbsp;<a href="/jstt/index_13.html">尾页</a></div>
        </div>
    </div>
    <div class="rightbox">
        <div class="search">
            <form action="/e/search/index.php" method="post" name="searchform" id="searchform">
                <input name="keyboard" id="keyboard" class="input_text" value="请输入关键字" style="color: rgb(153, 153, 153);" onfocus="if(value=='请输入关键字'){this.style.color='#000';value=''}" onblur="if(value==''){this.style.color='#999';value='请输入关键字'}" type="text">
                <input name="show" value="title" type="hidden">
                <input name="tempid" value="1" type="hidden">
                <input name="tbname" value="news" type="hidden">
                <input name="Submit" class="input_submit" value="搜索" type="submit">
            </form>
        </div>
        <div class="paihang">
            <h2 class="ab_title"><a href="/">本栏推荐</a></h2>
            <ul>
                <li><b><a href="/jstt/css3/2018-03-20/808.html" target="_blank">十条设计原则教你学会如何设计网页布局!30...</a></b>
                    <p>网页常见的布局有很多种,单列布局,多列布局.其中单列布局是国外很多网站比较常用的.咱们很多站长以及门户...</p>
                </li>
                <li><b><a href="/jstt/css3/2018-03-14/806.html" target="_blank">用js+css3来写一个手机栏目导航30...</a></b>
                    <p>有些站长说想做一个手机适应的网站,但是导航太难了,如果要使用框架的话,代码非常多,冗余.再用dreamwear打...</p>
                </li>
                <li><b><a href="/jstt/css3/2018-03-14/805.html" target="_blank">6条网页设计配色原则,让你秒变配色高手30...</a></b>
                    <p>网页设计好不好看,颜色是毋庸置疑要排首位的,所以关于颜色的搭配技巧以及原则,对于每一个要学习web前端设...</p>
                </li>
                <li><b><a href="/jstt/css3/2017-08-08/787.html" target="_blank">三步实现滚动条触动css动画效果30...</a></b>
                    <p>现在很多网站都有这种效果，我就整理了一下，分享出来。利用滚动条来实现动画效果，ScrollReveal.js 用于...</p>
                </li>
                <li><b><a href="/jstt/bj/2017-07-13/784.html" target="_blank">【心路历程】请不要在设计这条路上徘徊啦30...</a></b>
                    <p> 我整理了一下网友给我的来信，如果你还在踌躇不前，不妨来看看，到底要不要坚持下去！我也欢迎大家给我来...</p>
                </li>
                <li><b><a href="/jstt/bj/2015-01-09/740.html" target="_blank">【匆匆那些年】总结个人博客经历的这四年…30...</a></b>
                    <p>博客从最初的域名购买，到上线已经有四年的时间了，这四年的时间，有笑过，有怨过，有悔过，有执着过，也...</p>
                </li>
            </ul>
            <div class="ad"><img src="picture/ad300x100.jpg"></div>
        </div>
        <div class="paihang">
            <h2 class="ab_title"><a href="/">点击排行</a></h2>
            <ul>
                <li><b><a href="/jstt/bj/2015-01-09/740.html" target="_blank">【匆匆那些年】总结个人博客经历的这四年…30...</a></b>
                    <p>博客从最初的域名购买，到上线已经有四年的时间了，这四年的时间，有笑过，有怨过，有悔过，有执着过，也...</p>
                </li>
                <li><b><a href="/jstt/bj/2013-07-28/530.html" target="_blank">如果要学习web前端开发，需要学习什么？30...</a></b>
                    <p>遇到很多新手，都会问，如果要学习web前端开发，需要学习什么？难不难？多久能入门？怎么能快速建一个网站...</p>
                </li>
                <li><b><a href="/jstt/web/2014-01-18/644.html" target="_blank">我的个人博客之――阿里云空间选择30...</a></b>
                    <p>之前服务器放在电信机房， 联通用户访问速度很不稳定，经常出现访问速度慢的问题，换到阿里云解决了之前的...</p>
                </li>
                <li><b><a href="/jstt/bj/2014-11-06/732.html" target="_blank">分享我的个人博客访问量如何做到IP从10到600的(图文)30...</a></b>
                    <p>我的个人博客总共展示了三个版本，界面也经历了由“简单”到“复杂”再到“简单”，颜色从“色泽单一”到...</p>
                </li>
                <li><b><a href="/jstt/bj/2014-10-18/731.html" target="_blank">帝国cms常用标签调用方法总结（不得不收藏哦）30...</a></b>
                    <p>整理了一些常用的帝国cms调用，灵动标签和万能标签的调用方法举例。幻灯片、标题、一级栏目、二级栏目、带...</p>
                </li>
                <li><b><a href="/jstt/web/2015-02-25/745.html" target="_blank">【已评选】给我模板PSD源文件，我给你设计HTML！30...</a></b>
                    <p>只要你有PSD模板（原创）即可参与评选活动！集思广益，各位爱好设计的小伙伴们，拿出你们最得意的作品，曾...</p>
                </li>
            </ul>
            <div class="ad"><img src="picture/ad01.jpg"></div>
        </div>
        <div class="weixin">
            <h2 class="ab_title">官方微信</h2>
            <ul>
                <img src="picture/wx.jpg">
            </ul>
        </div>
    </div>
@endsection

