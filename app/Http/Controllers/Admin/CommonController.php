<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //图片上传
    public function upload(Request $request)
    {
//        $file = Input::file('Filedata');
        $file = $request->file('Filedata');
        //判断上传文件是否有效
        if($file->isValid()){
            $realPath = $file->getRealPath();  //临时文件的绝对路径
            $entension = $file -> getClientOriginalExtension(); //上传文件的后缀
            $newName = date('YmdHis').'_'.uniqid().'.'.$entension;
//            $path=$file->move(app_path().'/uploads',$newName);
            $path=$file->move(base_path().'/public/uploads',$newName);

            $filepath = 'uploads/'.$newName;

            return $filepath;
        }
    }


}
