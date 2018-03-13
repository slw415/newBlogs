<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.gate.index');
    }
    public function show($id)
    {
        $post=Admin::findOrFail($id);
         if(Gate::denies('meiyou',$post)){
                abort(403,'Sorry');
            }

    }
}
