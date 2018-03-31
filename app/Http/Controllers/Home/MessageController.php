<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\CommentRequest;
use App\Model\Message;
use App\Model\Nav;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $navs=Nav::where('pid',0)->orderBy('created_at','asc')->get();
        //留言
        $arr = Message::with( 'user')->get()->toArray();
        $comment = $this->getTree($arr);
        $user=Auth::guard('users')->user();
        foreach ($arr as &$item) {
            $c = Carbon::parse($item['created_at']);
            if ($c->greaterThan(now()->subDay(3))) {
                $item['created_at_show'] = $c->diffForHumans();
            } else {
                $item['created_at_show'] = $c->toDateString();
            }
        }
        return view('home.message',compact('navs','comment','user'));
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
    public function message(CommentRequest $request)
    {
        // 将数据存入数据库
        $create=Message::create(array_merge($request->all(), ['user_id' => Auth::guard('users')->user()->id]));
        if($create)
        {
            $status = '0';
            $msg = "发布成功！";
        }else{
            $status = '2';
            $msg = "发布失败！";
        }
        return response()->json(['status' => $status, 'msg' => $msg]);
    }

}
