<?php

namespace App\Http\Controllers\Home;

use App\Model\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function index($id)
    {
        $navs=Nav::where('pid',0)->get();
        $nav=Nav::where('id',$id)->first();
        return view('home.list',compact('navs','nav'));
    }
}
