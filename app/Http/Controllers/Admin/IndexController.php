<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    public function index()
    {
        /*//获取当前首页
        $username=Auth::user()->name;*/
        return view('admin/index');
    }
    public function logout(Request $request)
    {
        //情空所有sessioncookie
        $request->session()->flush();
        $cookie= Auth::guard('admin')->getRecallerName();
        $cookie1=Cookie::forget($cookie);
        return redirect('/admin/login')->withCookie($cookie1);
    }
}
