<?php

namespace App\Http\Controllers\Admin;

use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;


class HomeController extends Controller
{
   public function index(Request $request)
   {
       $input = $request->input('input');
       $img = Auth::user();


          $list= User::where('name', 'like', '%' . $input . '%')
                   ->orWhere('email', 'like', '%' . $input . '%')->paginate(10);

       return View::make('admin.home.index', compact('img', 'list', 'input'));
   }
    //ajax删除权限
    public function destroy(Request $request)
    {
        $input = $request->except('_method', '_token');
        $del=User::where('id',$input['id'])->delete();
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
}
