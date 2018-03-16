<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Requests\LoginPostRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $role=Role::all();
        return view('admin.permissions.loginshow',compact('role'));
    }
    public function loginpost(LoginPostRequest $request)
    {
        $input=$request->except('_token');
        $imgfile=$request->file('imgfile');
        //查找数据库是否有当前用户名
        $admin=Admin::where('name',$input['name'])->first();
        if ($admin)
        {
            return back()->withErrors('用户已经存在!');
        }

        //判断这个文件是否存在和判断文件上传过程中是否出错
        if($request->hasFile('imgfile')&& $imgfile->isValid())
        {
            $newName=$this->saveFile($imgfile);
            $create=Admin::create(array_merge($input,['password'=>bcrypt($input['password']),'imgfile'=>'/photo/'.$newName]));
            $id=Admin::where('name',$input['name'])->select('id')->first();
            $db=DB::table('admin_role')->insert(['role_id'=>$input['role_id'],'admin_id'=>$id['id']]);
            if($create&&$db)
            {
                return redirect('/admin');
            }
        }else{
            return back()->withErrors('图片不存在或者上传失败!');
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


}
