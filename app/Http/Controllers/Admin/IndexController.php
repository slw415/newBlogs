<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        /*//获取当前首页
        $username=Auth::user()->name;*/
        $img=Auth::user();
        return view('admin/index',compact('img'));
    }
    public function logout(Request $request)
    {
        //情空所有sessioncookie
        $request->session()->flush();
        $cookie= Auth::guard('admin')->getRecallerName();
        $cookie1=Cookie::forget($cookie);
        return redirect('/admin/login')->withCookie($cookie1);
    }
    public function edit(Request $request)
    {
        $img=Auth::user();
        $id=Auth::user()->id;
        $role=Role::all()->toArray();
        $data=Admin::where('id',$id)->first()->toArray();
        $rl_id=DB::table('admin_role')->where('admin_id',$id)->select('role_id')->first();
        return view('admin.edit',compact('img','data','role','rl_id','id'));
    }
    public function update(Request $request)
    {

        $id=Auth::user()->id;
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
                $request->session()->flash('message', '[ 缓存更新成功！]');
                return redirect('/admin/edit');
            }
        }else{
            $create=Admin::where('id',$id)->update(array_merge($input,['imgfile'=>$img]));
            $id=Admin::where('name',$input['name'])->select('id')->first();
            $db=DB::table('admin_role')->where('admin_id',$id)->update(['role_id'=>$role_id,'admin_id'=>$id['id']]);
            if($create)
            {
                $request->session()->flash('message', '[ 缓存更新成功！]');
                return redirect('/admin/edit');
            }
        }

    }

}
