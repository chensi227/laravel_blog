@extends('layouts.home')
@section('info')
    <title>{{$info->title}}--{{Config::get('web.title')}}</title>
@endsection
@section('content')
    <article class="blogs">
        <h1 class="t_nav"><span>您当前的位置：<a href="{{url('/')}}">首页</a>&nbsp;&gt;&nbsp;<a href="{{url('cate/'.$info->cate_id)}}">{{$info->cate_name}}</a>&nbsp;&gt;&nbsp;<a href="/">日记</a></span><a href="/" class="n1">网站首页</a><a href="{{url('cate/'.$info->cate_id)}}" class="n2">{{$info->cate_name}}</a></h1>
        <div class="index_about">
            <h2 class="c_titile">{{$info->title}}</h2>
            <p class="box_c"><span class="d_time">发布时间：{{date('Y-m-d',$info->addtime)}}</span><span>编辑：{{$info->author}}</span><span>查看次数：{{$info->viewnum}}</span></p>
            <ul class="infos">
                {!! $info->content !!}
            </ul>
            <div class="keybq">
                <p><span>关键字词</span>：{{$info->tag}}</p>

            </div>
            <div class="ad"> </div>
            <div class="nextinfo">
                @if($prev)
                    <p>上一篇：<a href="{{url('art/'.$prev->id)}}">{{$prev->title}}</a></p>
                @else
                    <p>这是第一篇</p>
                @endif

                @if($next)
                    <p>下一篇：<a href="{{url('art/'.$next->id)}}">{{$next->title}}</a></p>
                @else
                    <p>这是最后一篇</p>
                @endif
            </div>
            <div class="otherlink">
                <h2>相关文章</h2>
                <ul>
                    @if($data)
                        @foreach($data as $v)
                            <li><a href="{{url('art/'.$v->id)}}" title="现在，我相信爱情！">{{$v->title}}</a></li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <aside class="right">
            <!-- Baidu Button BEGIN -->
            <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
            </script>
            <!-- Baidu Button END -->
            <div class="blank"></div>
            <div class="news">
                @parent
            </div>
        </aside>
    </article>
@endsection