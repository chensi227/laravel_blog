@extends('layouts.home')
@section('info')
    <title>{{$info->cate_name}}--{{Config::get('web.title')}}</title>
    <meta name="keywords" content="{{$info->cate_keywords}}" />
    <meta name="description" content="{{$info->cate_desc}}" />
@endsection
@section('content')
    <article>
        <h1 class="t_nav"><span>{{$info->cate_title}}</span><a href="{{url('/')}}" class="n1">网站首页</a><a href="{{url("cate/$info->cate_id")}}" class="n2">{{$info->cate_name}}</a></h1>
        <div class="newblog left">
            @foreach($data as $value)
                <h2>{{$value->title}}</h2>
                <p class="dateview"><span>&nbsp;{{date('Y-m-d',$value->addtime)}}</span><span>作者：{{$value->author}}</span><span>分类：[<a href="{{url("cate/$info->cate_id")}}">{{$info->cate_name}}</a>]</span></p>
                <figure><img src="{{url($value->thumb)}}"></figure>
                <ul class="nlist">
                    <p>{{$value->description}}</p>
                    <a title="/" href="/" target="_blank" class="readmore">阅读全文>></a>
                </ul>
                <div class="line"></div>
            @endforeach
            <div class="page">
                {{$data->links()}}
            </div>
        </div>
        <aside class="right">
            @if($submenu->all())
                <div class="rnav">
                    <ul>
                        @foreach($submenu as $index => $item)
                            <li class="rnav{{$index+1}}"><a href="{{url('cate'."/$item->cate_id")}}" target="_blank">{{$item->cate_name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endif

                    <!-- Baidu Button BEGIN -->
                <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
                <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
                <script type="text/javascript" id="bdshell_js"></script>
                <script type="text/javascript">
                    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
                </script>
                <!-- Baidu Button END -->

            <div class="news" style="float: left;">
                @parent
            </div>


        </aside>
    </article>
@endsection


