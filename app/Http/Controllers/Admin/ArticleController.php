<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Requests\ArticleRequest;
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
        $list = Article::where('title', 'like', '%' . $input . '%')->orderBy('updated_at', 'desc')->paginate(10);
        return View::make('admin.articles.index', compact('img', 'list', 'input'));
    }

    public function create()
    {
        $img = Auth::user();
        $nav = Nav::select('id', 'name')->orderBy('pid', 'ASC')->get();
        return view('admin.articles.create', compact('img', 'nav'));
    }

    public function store(ArticleRequest $request)
    {
        $input = $request->except('_token');
        $imgfile = $request->file('imgfile');
        //判断这个文件是否存在和判断文件上传过程中是否出错
        if ($request->hasFile('imgfile') && $imgfile->isValid()) {
            $admin = new Admin();
            $newName = $admin->saveFile($imgfile);
            $create = Article::create(['cid' => $input['cid'], 'title' => $input['title'], 'user' => $input['user'], 'imgfile' => '/photo/' . $newName,
                'keyword1' => $input['keyword1'], 'keyword2' => $input['keyword2'], 'keyword3' => $input['keyword3'], 'keyword4' => $input['keyword4'], 'keyword5' => $input['keyword5'],
                'introduction' => $input['introduction'], 'content' => $input['introduction'], 'watch' => 0]);
            if ($create) {
                return redirect('/admin/articles');
            } else {
                return back()->with('errors', '填充失败，请稍后重试');
            }
        } else {
            return back()->withErrors('图片不存在或者上传失败!');
        }

    }

    public function edit($id)
    {
        $img = Auth::user();
        $art = Article::with('nav')->where('id', $id)->first();
        $nav = Nav::select('id', 'name')->orderBy('pid', 'ASC')->get();
        //找到对应的分类值
        $cid = $art->nav;

        return view('admin.articles.edit', compact('img', 'art', 'nav', 'cid'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->except('_token', '_method', 'img');
        $imgfile = $request->file('imgfile');
        $img = $request->input('img');
        //判断这个文件是否存在和判断文件上传过程中是否出错
        if ($request->hasFile('imgfile') && $imgfile->isValid()) {
            $admin = new Admin();
            $newName = $admin->saveFile($imgfile);
            $create = Article::where('id', $id)->update(array_merge($input, ['imgfile' => '/photo/' . $newName]));
            if ($create) {
                $request->session()->flash('message', '[ 更新成功！]');
                return redirect('/admin/articles');
            }
        } else {
            $create = Article::where('id', $id)->update(array_merge($input, ['imgfile' => $img]));
            if ($create) {
                $request->session()->flash('message', '[ 更新成功！]');
                return redirect('/admin/articles');
            }
        }

    }

    //ajax删除权限
    public function destroy(Request $request)
    {

        $input = $request->except('_method', '_token');
        $del=Article::where('id',$input['id'])->delete();
        if ($del)
        {
            $status = '0';
            $msg = "删除成功！";
        }else{
            $status = '1';
            $msg = "删除失败！";
        }
        return response()->json(['status' => $status, 'msg' => $msg]);
    }
    //推荐文章
    public function recommend(Request $request)
    {
        $input = $request->except( '_token');
        $update= Article::where('id',$input['id'])->update(['recommend'=>1]);
        if($update)
        {
            $status = '0';
            $msg = "推荐成功！";
        }else{
            $status = '1';
            $msg = "推荐失败！";
        }
        return response()->json(['status' => $status, 'msg' => $msg]);
    }

}
