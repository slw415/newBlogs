<?php

namespace App\Http\Controllers\Admin;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class RoleController extends Controller
{
    //显示页表页面
    public function index(Request $request)
    {
        $input=$request->input('input');
        if(!Cache::has('roles')) {
            Cache::rememberForever('roles', function () use ($input) {
                return   $admin=Role::where(function ($query) use ($input){
                    $query->where('name','like','%'.$input.'%');
                })->orWhere(function ($query) use ($input){
                    $query->where('title','like','%'.$input.'%');
                })->paginate(5);
            });
        }
        $admin=Cache::get('roles');
        $img=Auth::user();
        return view('admin.roles.index',compact('admin','input','img'));
    }
    // 显示创建角色页面
    public function create()
    {
        $img=Auth::user();
        return view('admin.roles.create',compact('img'));
    }
    //post保存创建的角色
    public function store(Request $request)
    {
        $input=$request->except('_token');
        $create=Role::create(['name'=>$input['name'],'title'=>$input['title']]);
        if ($create) {
            return redirect('admin/roles');
        } else {
            return back()->with('errors', '填充失败，请稍后重试');
        }
    }
    //修改角色
    public function edit($id)
    {
        $img=Auth::user();
        $role=Role::find($id);
        return view('admin.roles.edit',compact('role','img'));
    }
    //更新角色
    public function update(Request $request,$id)
    {
        $input=$request->except('_token','_method');
        $update=Role::where('id',$id)->update(['name'=>$input['name'],'title'=>$input['title']]);
        if ($update) {
            return redirect('admin/roles');
        } else {
            return back()->with('errors', '填充失败，请稍后重试');
        }
    }
    //ajax删除角色
    public function destroy(Request $request)
    {
        $input = $request->except('_method', '_token');
        $del=Role::where('id',$input['id'])->delete();
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
    //显示权限
    public function permissions(Role $role)
    {
        $permissions = Permission::all();
        $img=Auth::user();
       return view('admin.roles.permissions',compact('permissions', 'role','img'));
    }
    //更改当前权限
    public function permission(Request $request,$id)
    {
        $input=$request->input('chk_value');
        if($input){
            DB::table('permission_role')->where('role_id',$id)->delete();
        }
        //数据库事物失败回滚数据
       $arr= DB::transaction(function () use($input,$id){
           $arr=true;
            for($i=0;$i<count($input);$i++) {
                DB::table('permission_role')->insert(
                    ['role_id' => (int)$id, 'permission_id' => $input[$i]]
                );
                }
                return $arr;
                });

        if ($arr)
        {
            $status = '0';
            $msg = "保存记录成功！";
        }else{
            $status = '1';
            $msg = "保存记录失败！";
        }
        return response()->json(['status' => $status, 'msg' => $msg]);
    }
    public function cache(Request $request)
    {
        Cache::forget('roles');
        $request->session()->flash('message', '[ 缓存更新成功！]');
        return redirect('/admin/roles');
    }
}
