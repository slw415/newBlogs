<?php

namespace App\Http\Controllers\Admin;

use App\Model\Nav;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NavController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->input('input');
        $img = Auth::user();

        return view('admin.navs.index', compact('img', 'list', 'input'));
    }
}
