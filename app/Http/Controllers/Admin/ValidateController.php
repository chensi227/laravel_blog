<?php

namespace App\Http\Controllers\Admin;

use App\Tool\Validate\ValidateCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Crypt;

class ValidateController extends Controller
{
    //生成验证码
    public function create(Request $request)
    {
        $validateCode = new ValidateCode;
        $request->session()->put('date_code', $validateCode->getCode());
        return $validateCode->doimg();
    }

    //验证验证码
    public function check(Request $request)
    {
        $code = strtolower($request->input('code', ''));
        $code_session=$request->session()->get('date_code');
        if($code!=$code_session){
            $data['status']=1;
            $data['message']='验证码不正确';
            return json_encode($data);
        }
    }

    //Ajax 验证原密码是否正确
    public function checkpass(Request $request)
    {
        $pass=strtolower($request->input('opass', ''));
        $user=User::first();

        if(Crypt::decrypt($user->password)==$pass){
            $data['status']=1;
            $data['message']='密码正确';
            return json_encode($data);
        }else{
            $data['status']=2;
            $data['message']='密码输入错误请重新输入';
            return json_encode($data);
        }


    }

}
