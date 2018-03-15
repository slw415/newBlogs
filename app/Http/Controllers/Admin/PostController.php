<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Stmt\TraitUseAdaptation\Precedence;

class PostController extends Controller
{
    //显示页表页面
    public function index(Request $request)
    {
        $input=$request->input('input');
        $admins=Permission::where(function ($query) use ($input){
            $query->where('name','like','%'.$input.'%');
        })->orWhere(function ($query) use ($input){
            $query->where('title','like','%'.$input.'%');
        })->paginate(5);

        return view('admin.permissions.index',compact('admins','input'));
    }
    // 显示创建权限页面
    public function create()
    {
        return view('admin.permissions.create');
    }
    //post保存创建的权限
    public function store(Request $request)
    {
        $input=$request->except('_token');
        $create=Permission::create(['name'=>$input['name'],'title'=>$input['title']]);
        if ($create) {
            return redirect('admin/permissions');
        } else {
            return back()->with('errors', '填充失败，请稍后重试');
        }
    }
    //修改权限
    public function edit($id)
    {

        $permission=Permission::find($id);
        return view('admin.permissions.edit',compact('permission'));
    }
    //更新权限
    public function update(Request $request,$id)
    {
        $input=$request->except('_token','_method');
        $update=Permission::where('id',$id)->update(['name'=>$input['name'],'title'=>$input['title']]);
        if ($update) {
            return redirect('admin/permissions');
        } else {
            return back()->with('errors', '填充失败，请稍后重试');
        }
    }
    //ajax删除权限
    public function destroy(Request $request)
    {
        $input = $request->except('_method', '_token');
        $del=Permission::where('id',$input['id'])->delete();
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

    public function show($id)
    {
        $post=Admin::findOrFail($id);
         if(Gate::denies('meiyou',$post)){
                abort(403,'Sorry');
            }

    }
    public function loginshow()
    {
        return view('admin.permissions.loginshow');
    }
}
