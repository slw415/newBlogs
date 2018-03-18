<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $input=$request->input('input');
        $img=Auth::user();
        $list=Admin::with('roles')->where('name','like','%'.$input.'%')->paginate(5);
        return view('admin.list.index',compact('img','list','input'));
    }
    public function edit(Request $request,$id)
    {
        $img=Auth::user();
        $role=Role::all()->toArray();
        $data=Admin::where('id',$id)->first()->toArray();
        $rl_id=DB::table('admin_role')->where('admin_id',$id)->select('role_id')->first();
        return view('admin.list.edit',compact('img','data','role','rl_id'));
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
            $newName=$this->saveFile($imgfile);
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
    //头像存储
    public function saveFile($file)
    {
        //图片规定后缀
        $fileTypes = ["png", "jpg", "gif","jpeg"];
        // 获取图片后缀
        $extension = $file->extension();
        //是否是要求的图片
        $isInFileType = in_array($extension,$fileTypes);
        if ($isInFileType)
        {
            //新的文件名（保证不重叠）
            $newName=date('YmdHis').mt_rand(100,900).'.'.$extension;
            //存储到photo目录
            $store_result = $file->storeAs('', $newName, ['disk'=>'photo']);
            return $newName;
        }else{
            return back()->withErrors( '图片格式不符合要求，请重新添加');
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

}
