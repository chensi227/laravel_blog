<?php

namespace App\Http\Controllers\Admin;

use App\Model\Article;
use App\Model\Category;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    //全部文章列表
    public function index()
    {
//        $list=Article::orderBy('addtime','desc')->get();
        $list = Article::select('id','title','viewnum','author','addtime')->orderBy('addtime','desc')->paginate(5);
//        return view('admin.article.index',['data'=>$list]);
        return view('admin.article.index')->with('data',$list);
    }

    //添加文章
    public function create()
    {
        $data=(new Category)->tree();
//        $data=Category::_getTree($data);

        return view('admin.article.add',compact('data'));
    }

    //
    public function store()
    {
//        $list = request();
//        dd($list);exit;
        $data = Input::except('_token');
        $data['addtime'] = time();

        $message = [
            'title.required'=>'文章名称不能为空！',
            'content.required'=>'文章内容不能为空！',
        ];

        $rules = [
            'title'=>'required',
            'content'=>'required',
        ];

        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            $result = Article::create($data);
            if($result){
                return redirect('admin/article');
            }else{
                return back()->with('errors','数据填充失败,请稍后重试');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //admin/article/{article}/edit
    public function edit($article_id)
    {
        $data=(new Category)->tree();
        $field = Article::find($article_id);
//        $field = Article::where('id',$article_id)->first();
//        dd($field);

        return view('admin.article.edit',compact('data','field'));
//        return view('admin.article.edit')->with('data',$data)->with('field',$field);

    }

    // admin/article/{article}
    public function update($article_id)
    {
        $data = Input::except('_token','_method');
        $data['updatetime'] = time();

        $message = [
            'title.required'=>'文章名称不能为空！',
            'content.required'=>'文章内容不能为空！',
        ];

        $rules = [
            'title'=>'required',
            'content'=>'required',
        ];

        $validator = Validator::make($data,$rules,$message);
        if($validator->passes()){
            $result = Article::where('id',$article_id)->update($data);
            if($result){
                return redirect('admin/article');
            }else{
                return back()->with('errors','修改文章失败');
            }
        }else{
            return back()->withErrors($validator);
        }
    }

    //admin/article/{article}
    public function destroy($article_id)
    {
        $result=Article::where('id',$article_id)->delete();
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
