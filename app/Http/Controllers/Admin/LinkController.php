<?php

namespace App\Http\Controllers\Admin;

use App\Model\Link;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class LinkController extends Controller
{
    public function index()
    {
        $data = Link::where([])->orderBy('link_order','asc')->get();

        return view('admin.link.index',['data'=>$data]);
    }

    public function store()
    {
        $input = Input::except('_token');  //出去token以外
        $input['add_time'] = time();
        $message = [
            'link_name.required'=>'链接名称不能为空！',
            'link_url.required'=>'文章内容不能为空！',
        ];

        $rules = [
            'link_name'=>'required',
            'link_url'=>'required',
        ];
        $validator = Validator::make($input,$rules,$message);

        if($validator->passes()){
            $result = Link::create($input);
            if($result){
                return redirect('admin/link');
            }else{
                return back()->with('errors','数据填充失败,请稍后重试');
            }
        }else{
            return back()->withErrors($validator);
        }

    }

    public function create()
    {

        return view('admin.link.add');
    }

    public function show()
    {

    }

    public function update($id)
    {
        $data = Input::except('_token','_method');

        $message = [
            'link_name.required'=>'链接名称不能为空！',
            'link_url.required'=>'文章内容不能为空！',
        ];

        $rules = [
            'link_name'=>'required',
            'link_url'=>'required',
        ];

        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            $result = Link::where('id',$id)->update($data);
            if($result){
                return redirect('admin/link');
            }else{
                return back()->with('errors','修改友情链接失败');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    public function edit($id)
    {

       $field = Link::where('id',$id)->first();

        return view('admin.link.edit',compact('field'));
//        return view('admin.article.edit')->with('data',$data)->with('field',$field);
    }

    public function destroy($id)
    {
        $result=Link::where('id',$id)->delete();
        if($result){
            $info=[
                'status'=>0,
                'msg'=>'删除成功',
            ];
            return $info;
        }else{
            $info=[
                'status'=>1,
                'msg'=>'删除失败',
            ];
            return $info;
        }

    }

    public function changesort(Request $request)
    {
        $order=$request->input('link_order');
        $id=$request->input('id');
        $link=Link::where('id',$id)->update(['link_order'=>$order]);
        if($link){
            $info=[
                'status'=>0,
                'msg'=>'更新成功',
            ];
            return $info;
        }else{
            $info=[
                'status'=>1,
                'msg'=>'更新失败',
            ];
            return $info;
        }
    }

}
