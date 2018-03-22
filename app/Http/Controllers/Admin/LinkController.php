<?php

namespace App\Http\Controllers\Admin;

use App\Model\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;


class LinkController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->input('input');
        $img = Auth::user();
        //从数据库获取它们并将其添加到缓存中，
        if(!Cache::has('links')) {
            Cache::rememberForever('links', function () use ($input) {
                return Link::where('name', 'like', '%' . $input . '%')->paginate(5);
            });
        }
        $list=Cache::get('links');
        return View::make('admin.links.index', compact('img', 'list', 'input'));

    }
    public function create()
    {
        $img=Auth::user();
        return view('admin.links.create',compact('img'));
    }
    public function store(Request $request)
    {
        $input=$request->except('_token');
        $create=Link::create(['name'=>$input['name'],'url'=>$input['url']]);
        if ($create) {
            return redirect('admin/links');
        } else {
            return back()->with('errors', '填充失败，请稍后重试');
        }
    }
    public function edit(Request $request,$id)
    {
        $img=Auth::user();
        $links=Link::where('id',$id)->first()->toArray();
        return view('admin.links.edit',compact('img','links','id'));
    }
    public function update(Request $request,$id)
    {
        $input=$request->except('_token','_method');
        $update=Link::where('id',$id)->update(['name'=>$input['name'],'url'=>$input['url']]);
        if ($update) {
            return redirect('admin/links');
        } else {
            return back()->with('errors', '填充失败，请稍后重试');
        }
    }    //ajax删除权限
    public function destroy(Request $request)
    {
        $input = $request->except('_method', '_token');
        $del=Link::where('id',$input['id'])->delete();
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
    public function cache(Request $request)
    {
        Cache::forget('links');
        $request->session()->flash('message', '[ 缓存更新成功！]');
        return redirect('/admin/links');
    }
}
