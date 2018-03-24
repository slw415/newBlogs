<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Model\Article;
use App\Model\Nav;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->input('input');
        $img = Auth::user();

            $list=Article::where('title', 'like', '%' . $input . '%')->paginate(10);


        return View::make('admin.articles.index', compact('img', 'list', 'input'));
    }
    public function create()
    {
        $img=Auth::user();
        $nav=Nav::select('id','name')->orderBy('pid', 'ASC')->get();
        return view('admin.articles.create',compact('img','nav'));
    }
    public function store(Request $request)
    {
        $input=$request->except('_token');
        $imgfile=$request->file('imgfile');
        //判断这个文件是否存在和判断文件上传过程中是否出错
        if($request->hasFile('imgfile')&& $imgfile->isValid())
        {
            $admin=new Admin();
            $newName=$admin->saveFile($imgfile);
            $create=Article::create(['cid'=>$input['cid'],'title'=>$input['title'],'user'=>$input['user'],'imgfile'=>'/photo/'.$newName,'keyword'=>$input['keyword'],'introduction'=>$input['introduction'],'content'=>$input['introduction'],'watch'=>0]);
            if($create)
            {
                return redirect('/admin/articles');
            }else {
                return back()->with('errors', '填充失败，请稍后重试');
            }
        }else{
            return back()->withErrors('图片不存在或者上传失败!');
        }

    }

}
