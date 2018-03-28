<?php

namespace App\Http\Controllers\Home;

use App\Admin;
use App\Http\Requests\HomeEditRequest;
use App\Model\Article;

use App\Model\Link;
use App\Model\Nav;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index()
    {
        $minutes=60;
        //获取最新的文章
        if(!Cache::has('new')) {
            Cache::remember('new', $minutes, function () {
                return Article::with('nav')->orderBy('updated_at','desc')->paginate(8);
            });

        }
        $new=Cache::get('new');
        //获取点击量最高的文章
        if(!Cache::has('watch')) {
            Cache::remember('watch', $minutes, function () {
                return Article::orderBy('watch','desc')->take(3)->get();
            });

        }
        $watch=Cache::get('watch');
        //查询编程文章
        if(!Cache::has('programming')) {
            Cache::remember('programming', $minutes, function () {
                return Article::whereHas('nav',function ($query) {
                    $query->where('id', 1)->orWhere('pid', 1);
                })->orderBy('updated_at','desc')->take(6)->get();
            });
        }
        $programming=Cache::get('programming');
        //查询推荐文章
        if(!Cache::has('recommend')) {
            Cache::remember('recommend', $minutes, function () {
                return Article::where('recommend',1)->orderBy('updated_at','desc')->take(6)->get();
            });

        }
        $recommend=Cache::get('recommend');
        //友情链接
        $links=Link::all();
        //导航栏
        $navs=Nav::where('pid',0)->get();
        //当前用户
        $user=Auth::guard('users')->user();

        return view('welcome',compact('new','watch','programming','recommend','links','navs','user'));

    }
    public function edit()
    {
        $navs=Nav::where('pid',0)->get();
        $user=Auth::guard('users')->user();
        return view('home.edit',compact('navs','user'));
    }

    public function update(HomeEditRequest $request)
    {

        $input=$request->except('_token','img');
        $id=Auth::guard('users')->user()->id;
        $imgfile=$request->file('imgfile');
        $img=$request->input('img');
        //判断这个文件是否存在和判断文件上传过程中是否出错
        if($request->hasFile('imgfile')&& $imgfile->isValid())
        {
            $admin=new Admin();
            $newName=$admin->saveFile($imgfile);
            $create=User::where('id',$id)->update(array_merge($input,['imgfile'=>'/photo/'.$newName]));
            if($create)
            {
                $request->session()->flash('message', '[ 更新信息成功！]');
                return redirect('/edit');
            }
        }else{
            $create=User::where('id',$id)->update(array_merge($input,['imgfile'=>$img]));
            if($create)
            {
                $request->session()->flash('message', '[ 更新信息成功！]');
                return redirect('/edit');

            }
        }

    }
        //清理前台缓存
        public function cache()
        {
            Cache::forget('new');
            Cache::forget('watch');
            Cache::forget('programming');
            Cache::forget('recommend');
            return redirect('/admin');
        }
}
