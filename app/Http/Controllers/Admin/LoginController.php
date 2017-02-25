<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use App\Model\User;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //登录验证
    public function login()
    {
        if($input=Input::all()){
            $code=strtolower($input['code']);
            if($code!=session('date_code')){
                return back()->with('msg',1);
            }
            $username=$input['username'];
            $password=$input['password'];
            $user=User::first();
            if($user->username==$username && Crypt::decrypt($user->password)==$password)
            {
                session(['user'=>$username]);
                return redirect('admin/index');
            }else{
                return back()->with('msg',2);
            }
        }else{
            return view('admin.login');
        }
    }

    //退出
    public function outlogin()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

    //更改密码
    public function changepass()
    {
        if($input=Input::all()){
            //laravel的表单验证
            $message=[
                'password.required'     =>      '新密码不能为空',
                'password.between'      =>      '新密码必须在6到20位之间',
                'password.confirmed'    =>      '重复密码和新密码不一致',
            ];
            $rules=[
                'password'      =>      'required|between:6,20|confirmed',

            ];
            $validator=Validator::make($input,$rules,$message);
            if($validator->passes()){
//                $user=User::first();
//                $user=new User;
//                $user->password=Crypt::encrypt($input['password']);
//                $user->update();
                $password=Crypt::encrypt($input['password']);
                $user=new User;
                $user->where('user_id',1)->update(['password'=>$password]);
                return redirect('admin/info');
            }else{
                return back()->withErrors($validator);
            }
        }else{
            return view('admin.pass');
        }
    }

}
