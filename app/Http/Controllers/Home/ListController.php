<?php

namespace App\Http\Controllers\Home;

use App\Http\Requests\CommentRequest;
use App\Model\Article;
use App\Model\Comment;
use App\Model\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ListController extends Controller
{
    public function index($id)
    {
        $navs=Nav::where('pid',0)->orderBy('created_at','asc')->get();
        $nav=Nav::where('id',$id)->first();
        $list=Article::whereHas('nav',function ($query) use($id){
            $query->where('pid',$id)->orWhere('id',$id);
        })->with('nav')->orderby('updated_at','desc')->paginate(10);
        //推荐
        $recommend=Article::whereHas('nav',function ($query) use($id){
            $query->where('pid',$id)->orWhere('id',$id);
        })->with('nav')->where('recommend',1)->orderby('updated_at','desc')->take(6)->get();
        $watch=Article::whereHas('nav',function ($query) use($id){
            $query->where('pid',$id)->orWhere('id',$id);
        })->with('nav')->orderby('watch','desc')->take(3)->get();;
        return view('home.list',compact('navs','nav','list','recommend','watch'));
    }
    public function search(Request $request){
        $navs=Nav::where('pid',0)->orderBy('created_at','asc')->get();
        $input=$request->input('keyboard');
        $list=Article::where('title','like','%'.$input.'%')->with('nav')->orderby('watch','desc')->paginate(10);
        $recommend=Article::where('recommend',1)->orderBy('updated_at','desc')->take(6)->get();
        $watch=Article::orderBy('watch','desc')->take(3)->get();
        return view('home.search',compact('navs','list','recommend','watch','input'));
    }
    /**
     *
     *文章显示
     */
    public function article($id)
    {
        $navs=Nav::where('pid',0)->orderBy('created_at','asc')->get();
        $nav=Nav::whereHas('articles',function ($query)use($id){
            $query->where('id',$id);
        })->with('nav')->first();

        $article=Article::where('id',$id)->first();
        //上一篇
        $prev = Article::where('id','<',$id)->orderBy('id','desc')->first();
        //下一篇
        $next = Article::where('id','>',$id)->orderBy('id','asc')->first();
        //相关文章
        $cid =Article::where('id',$id)->select('cid','watch')->first();
        $relevant=Article::where('cid',$cid['cid'])->where('id','<>',$id)->get();
        $recommend=Article::where('recommend',1)->orderBy('updated_at','desc')->take(6)->get();
        $watch=Article::orderBy('watch','desc')->take(3)->get();
        //记录浏览次数
        Article::where('id',$id)->update(['watch'=>$cid['watch']+1]);
        //评论
            $arr = Comment::whereHas('article', function ($query) use ($id) {
                $query->where('id', $id);
            })->with('article', 'user')->get()->toArray();
            $comment = $this->getTree($arr);

        return view('home.article',compact('navs','nav','article','prev','next','relevant','recommend','watch','comment'));
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

    public function comment(CommentRequest $request)
    {
        $input=$request->except('_token');
        // 将数据存入数据库
        $create=Comment::create(array_merge($request->all(), ['article_id'=>$input['id'],'user_id' => Auth::guard('users')->user()->id]));
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
