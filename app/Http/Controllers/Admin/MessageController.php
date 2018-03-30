<?php

namespace App\Http\Controllers\Admin;

use App\Model\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->input('input');
        $img = Auth::user();
        //评论
        $arr= Comment::with(['article'=> function ($query)use($input){
            $query->where('title','like','%'.$input.'%');
        }])->with('user')->orWhere('body','like','%'.$input.'%')->get()->toArray();
        $list = $this->getTree($arr);
        return view('admin.message.index', compact('img', 'list', 'input'));
    }
    public function getTree($data,$pid=0)
    {
        $arr=[];
        foreach ($data as $key => $v)
        {
            if($v['pid']==$pid)
            {
                $arr[$v['id']]['con']=$v;
                $arr[$v['id']]['son']=$this->getTree($data,$v['id']);
            }
        }
        return $arr;
    }
    public function destroy(Request $request)
    {
        $input = $request->except('_method', '_token');
        if($input['pid']==0)
        {
            $detch=Comment::where('pid',$input['id'])->delete();
        }
        $del=Comment::where('id',$input['id'])->delete();
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
