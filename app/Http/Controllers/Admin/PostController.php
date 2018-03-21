<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Requests\LoginPostRequest;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use PhpParser\Node\Stmt\TraitUseAdaptation\Precedence;

class PostController extends Controller
{
    //显示页表页面
    public function index(Request $request)
    {
        $input=$request->input('input');
        //从数据库获取它们并将其添加到缓存中，
        if(!Cache::has('permissions')) {
            Cache::rememberForever('permissions', function () use ($input) {
                return  $admins=Permission::where(function ($query) use ($input){
                    $query->where('name','like','%'.$input.'%');
                })->orWhere(function ($query) use ($input){
                    $query->where('title','like','%'.$input.'%');
                })->paginate(5);
            });
        }
        $admins=Cache::get('permissions');
        $img=Auth::user();
        return view('admin.permissions.index',compact('admins','input','img'));
    }
    // 显示创建权限页面
    public function create()
    {
        $img=Auth::user();
        return view('admin.permissions.create',compact('img'));
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
        $img=Auth::user();
        $permission=Permission::find($id);
        return view('admin.permissions.edit',compact('permission','img'));
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
        $img=Auth::user();
        $role=Role::all();
        return view('admin.permissions.loginshow',compact('role','img'));
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
            $admin=new Admin();
            $newName=$admin->saveFile($imgfile);
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
    public function cache(Request $request)
    {
        Cache::forget('permissions');
        $request->session()->flash('message', '[ 缓存更新成功！]');
        return redirect('/admin/permissions');
    }


}
