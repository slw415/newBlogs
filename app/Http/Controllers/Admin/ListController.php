<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->input('input');
        $img = Auth::user();
        //从数据库获取它们并将其添加到缓存中，
        if(!Cache::has('list')) {
               Cache::rememberForever('list', function () use ($input) {
                return Admin::with('roles')->where('name', 'like', '%' . $input . '%')->paginate(5);
            });
        }
        $list=Cache::get('list');
        return View::make('admin.list.index', compact('img', 'list', 'input'));

    }
    public function edit(Request $request,$id)
    {
        $img=Auth::user();
        $role=Role::all()->toArray();
        $data=Admin::where('id',$id)->first()->toArray();
        $rl_id=DB::table('admin_role')->where('admin_id',$id)->select('role_id')->first();
        return view('admin.list.edit',compact('img','data','role','rl_id','id'));
    }
    public function update(Request $request,$id)
    {

        $input=$request->except('_token','_method','role_id','img');

        $role_id=$request->input('role_id');
        $imgfile=$request->file('imgfile');
        $img=$request->input('img');
        //判断这个文件是否存在和判断文件上传过程中是否出错
        if($request->hasFile('imgfile')&& $imgfile->isValid())
        {
            $admin=new Admin();
            $newName=$admin->saveFile($imgfile);
            $create=Admin::where('id',$id)->update(array_merge($input,['imgfile'=>'/photo/'.$newName]));
            $id=Admin::where('name',$input['name'])->select('id')->first();
            $db=DB::table('admin_role')->where('admin_id',$id)->update(['role_id'=>$role_id,'admin_id'=>$id['id']]);
            if($create)
            {
                return redirect('/admin');
            }
        }else{
            $create=Admin::where('id',$id)->update(array_merge($input,['imgfile'=>$img]));
            $id=Admin::where('name',$input['name'])->select('id')->first();
            $db=DB::table('admin_role')->where('admin_id',$id)->update(['role_id'=>$role_id,'admin_id'=>$id['id']]);
            if($create)
            {
                return redirect('/admin');
            }
        }

    }

    public function destroy(Request $request)
    {
        $input=$request->input('id');
        $admin=Admin::find($input)->delete();
        $del=DB::table('admin_role')->where('admin_id',$input)->delete();
        if ($del&&$admin)
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
        Cache::forget('list');
        $request->session()->flash('message', '[ 缓存更新成功！]');
        return redirect('/admin/list');
    }

}
