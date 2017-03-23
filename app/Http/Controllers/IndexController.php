<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\CommonController;
use App\Model\Article;
use App\Model\Category;
use App\Model\Link;
use App\Model\Navs;
use App\Model\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Model\User;

use App\Jobs\OrderJob;

class IndexController extends Controller
{
    public function index()
    {
        //点击量最高的几篇文章
        $hot = Article::orderBy('viewnum','desc')->take(6)->get();
        //$hos = Article::orderBy('viewnum','desc')->limit(6)->get();
        //图文列表5篇
        $data = Article::orderBy('addtime','DESC')->paginate(5);
        //最新发布的几篇文章
        $new = Article::orderBy('addtime','DESC')->get();

        //友情链接
        $links = Link::orderBy('link_order','ASC')->get();
        return view('home.index',compact('hot','data','new','links'));
    }


    public function cate($cate_id)
    {
        //当前分类的子分类
        $submenu = Category::where('cate_pid',$cate_id)->get();
        $info = Category::find($cate_id);
        //图文列表5篇
        Category::where('cate_id',$cate_id)->increment('cate_view');
        $data = Article::where('cate_id',$cate_id)->orderBy('addtime','DESC')->paginate(4);
        return view("home.list")->with('info',$info)->with('data',$data)->with('submenu',$submenu);
    }


    public function article($id)
    {
        $info = Article::select('article.*','category.cate_name','category.cate_id')
            ->Join('category','article.cate_id','=','category.cate_id')
            ->where('article.id',$id)
            ->first();
        $prev = Article::where('id','<',$id)->orderBy('id','desc')->first();
        $next = Article::where('id','>',$id)->orderBy('id','asc')->first();

        //取得相关文章
        $data = Article::where('cate_id',$info->cate_id)->take(6)->get();
        //查看字段自增
        Article::where('id',$id)->increment('viewnum');

        return view("home.new",compact('info','data'))->with('prev',$prev)->with('next',$next);
    }


    public function test()
    {
        /*$users=User::where('user_id',1)
            ->select('username','password')
            ->get();*/
//        $users=User::select('username','password')->find(1);
//        $users=User::select('username','password')->where('user_id',1)->first();
//        $users =User::where([])->get(['username as user','password']);
//        $users =User::all(['username as user','password']);toSql
        $sql = Article::orderBy('viewnum','desc')
            ->limit(6)
            ->skip(4)
            ->toSql();
//            ->keyBy();以什么为键值对
        $sql = Article::orderBy('viewnum','desc')
            ->skip(6)
            ->limit(7)
            ->toSql();
        dd($sql);
    }

    public function test1()
    {
        $res = $this->dispatch(new OrderJob([
            'order_no'       =>      time(),
            'price'         =>      26.78,
            'addtime'       =>      date('Y-m-d H:i:s'),
            'status'        =>      1,
            'userid'        =>      1,
        ]));
        dd($res);
    }


    public function getdata(Request $request,$id=0,$name=null)
    {
        return $id.'--'.$name;
    }

}
