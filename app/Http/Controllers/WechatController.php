<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WechatController extends Controller
{
    //
    public function __construct()
    {
//        $this->middleware('web', ['except' => ['wechat']]);
        $this->middleware('web')->except('wechat');
    }

    public function wechat()
    {
       return 'hello';
    }
}
