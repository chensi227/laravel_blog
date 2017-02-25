<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    //get.admin.category  全部分类列表
    public function index()
    {
//        $data = Category::all();
//        $data=Category::where([])->orderBy('cate_order','asc')->get();
        $data=Category::orderBy('cate_order','asc')->get();
//        $data=Category::where([])->orderBy('cate_order','asc')->paginate(5);

        $data=Category::_getTree($data);
//        $data=(new Category)->tree();
//        $data=Category::_tree($data);
//        return view('admin.category.index')->with('data',$data);
//        return view('admin.category.index',compact('data'));
        return view('admin.category.index',['data'=>$data]);
    }

    //post admin index
    public function store()
    {
//        $input=Input::all();
        $input=Input::except('_token');  //出去token以外
//        dd($input);
        $result=Category::create($input);
        if($result){
            return redirect('admin/category');
        }else{
           return redirect('admin/create');
        }

    }

    //添加分类
    public function create()
    {
        $data=Category::where('cate_pid',0)->get();
//        dd($data);
//        return view('admin.category.add',compact('data'));
//        return view('admin.category.add')->with('data',$data);
        return view('admin.category.add',['data'=>$data]);
    }

    public function show()
    {

    }
    //更新
    public function update($cate_id)
        
    {
        $input=Input::except('_token','_method');
        $result=Category::where('cate_id',$cate_id)->update($input);
        if($result){
            return redirect('admin/category');
        }else{
            return back()->with('errors','数据填充失败,请稍后重试');
        }
    }

    public function edit($cate_id)
    {
//        $category=Category::where('cate_id',$cate_id)->first();
        $data=Category::where('cate_pid',0)->get();
        $field=Category::find($cate_id);
//        dd($field);
        return view('admin.category.edit',compact('field','data'));

    }

    public function changesort(Request $request)
    {
        $sort=$request->input('cate_sort');
        $cate_id=$request->input('cate_id');
        $cate=Category::where('cate_id',$cate_id)->update(['cate_order'=>$sort]);
        if($cate){
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

    public function destroy($cate_id)
    {
        $result=Category::where('cate_id',$cate_id)->delete();
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


}
