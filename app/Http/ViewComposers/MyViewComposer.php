<?php namespace App\Http\ViewComposers;
use App\Model\Article;
use App\Model\Navs;
use Illuminate\Contracts\View\View;
class MyViewComposer
{
    public function compose(View $view)
    {
        $navs = Navs::all();
        //最新发布的几篇文章
        $new = Article::orderBy('addtime','DESC')->get();
        //点击量最高的几篇文章
        $hot = Article::orderBy('viewnum','desc')->take(6)->get();
        $view->with('navs',$navs)->with('new',$new)->with('hot',$hot);
    }
}