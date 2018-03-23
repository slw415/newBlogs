<?php

namespace App\Http\Controllers\Admin;

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
        //从数据库获取它们并将其添加到缓存中，
        if(!Cache::has('articles')) {
            Cache::rememberForever('links', function () use ($input) {
                return Article::where('title', 'like', '%' . $input . '%')->paginate(5);
            });
        }
        $list=Cache::get('links');
        return View::make('admin.articles.index', compact('img', 'list', 'input'));
    }
    public function cache(Request $request)
    {
        Cache::forget('articles');
        $request->session()->flash('message', '[ 缓存更新成功！]');
        return redirect('/admin/articles');
    }
}
