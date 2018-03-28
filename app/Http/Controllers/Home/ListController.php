<?php

namespace App\Http\Controllers\Home;

use App\Model\Article;
use App\Model\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function index($id)
    {
        $navs=Nav::where('pid',0)->get();
        $nav=Nav::where('id',$id)->first();
        $list=Article::whereHas('nav',function ($query) use($id){
            $query->where('pid',$id)->orWhere('id',$id);
        })->with('nav')->orderby('updated_at','desc')->paginate(10);
        return view('home.list',compact('navs','nav','list'));
    }
}
