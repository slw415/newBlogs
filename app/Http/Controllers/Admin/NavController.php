<?php

namespace App\Http\Controllers\Admin;

use App\Model\Nav;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NavController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->input('input');
        $img = Auth::user();
        $list=(new Nav())->tree();
        return view('admin.navs.index', compact('img', 'list', 'input'));
    }
    public function create()
    {
        $img=Auth::user();
        $nav=Nav::where('pid',0)->get();
        return view('admin.navs.create',compact('img','nav'));
    }
    public function store(Request $request)
    {
        $input=$request->except('_token');

        $create=Nav::create(['name'=>$input['name'],'title'=>$input['title'],'pid'=>$input['pid']]);
        if ($create) {
            return redirect('admin/navs');
        } else {
            return back()->with('errors', '填充失败，请稍后重试');
        }
    }
    public function edit(Request $request,$id)
    {
        $img=Auth::user();
        $links=Nav::where('id',$id)->first()->toArray();
        return view('admin.navs.edit',compact('img','links','id'));
    }
    public function update(Request $request,$id)
    {
        $input=$request->except('_token','_method');
        $update=Nav::where('id',$id)->update(['name'=>$input['name'],'title'=>$input['title']]);
        if ($update) {
            return redirect('admin/navs');
        } else {
            return back()->with('errors', '填充失败，请稍后重试');
        }
    }
    //ajax删除权限
    public function destroy(Request $request)
    {
        $input = $request->except('_method', '_token');
       if($input['pid']==0)
       {
           $detch=Nav::where('pid',$input['id'])->delete();
       }
        $del=Nav::where('id',$input['id'])->delete();
        if ($del||$detch)
        {
            $status = '0';
            $msg = "删除成功！";
        }else{
            $status = '1';
            $msg = "删除失败！";
        }
        return response()->json(['status' => $status, 'msg' => $msg]);
    }
}
