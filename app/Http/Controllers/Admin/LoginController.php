<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
   |--------------------------------------------------------------------------
   | Login Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles authenticating users for the application and
   | redirecting them to your home screen. The controller uses a trait
   | to conveniently provide its functionality to your applications.
   |
   */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    /*
     * 显示后台登录模板
     *
     */
    public function showLoginForm()
     {
         return view('admin.login');
     }
     /*
      * 验证name字段
      */
    public function username()
    {
        return 'name';
    }

    /*
     * 生成guard（‘admin’）
     */
    protected function guard()
    {
        return auth()->guard('admin');
    }
    /*
     * 验证表单
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string|max:6',
            'password' => 'required|string|min:6',
        ],[
            $this->username().'required'=>'账号必须填写',
            $this->username().'string'=>'账号必须填写字符串',
            $this->username().'max'=>'账号不大于6位',
            'password.required'=>'密码必须填写',
            'password.string'=>'密码必须填写字符串',
            'password.min'=>'密码最小6位',
        ]);

    }
    //重写提交登录失败信息
    protected function sendFailedLoginResponse(Request $request)
    {

        $name = $request->name;
        $user=Admin::where('name',$name)->first();
        if(empty($user))
        {
            throw ValidationException::withMessages([
                'name'=>'没有此用户'
            ]);
            return false;
        }
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password'=>'密码错误'
            ]);
            return false;
        }

    }
    //用户通过身份认证
    protected function sendLoginResponse(Request $request)
    {

      // 设置记住我的时间为60分钟
        $rememberTokenExpireMinutes = 60;
        // 首先获取 记住我 这个 Cookie 的名字, 这个名字一般是随机生成的,
        // 类似 remember_admin_59ba36addc2b2f9401580f014c7f58ea4e30989d
        $rememberTokenName = Auth::guard('admin')->getRecallerName();
        // 再次设置一次这个 Cookie 的过期时间
        Cookie::queue($rememberTokenName, Cookie::get($rememberTokenName), $rememberTokenExpireMinutes);
        // 下面的代码是从 AuthenticatesUsers 中的 sendLoginResponse() 直接复制而来
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());

    }


    protected function authenticated(Request $request, $user)
    {


        info('测试日志');
//        return response()->json(['msg'=>200]);
    }

}
