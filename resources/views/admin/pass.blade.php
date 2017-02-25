@extends('layouts.admin')
@section('content')
        <!--面包屑导航 开始-->
<div class="crumb_warp">
    <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
    <i class="fa fa-home"></i> <a href="" onclick="parent.location.href='/admin/index'">首页</a> &raquo; 修改密码
    {{--<a href="{{url('admin/info')}}">首页</a>--}}
</div>
<!--面包屑导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>修改密码</h3>
        @if(count($errors)>0)
            <div class="mark">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form method="post" action="">
        {{csrf_field()}}
        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120"><i class="require">*</i>原密码：</th>
                <td>
                    <input type="password" name="password_o"> </i>请输入原始密码</span>
                    &nbsp;&nbsp;<span id="opass" style="color: red;"></span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>新密码：</th>
                <td>
                    <input type="password" name="password"> </i>新密码6-20位</span>
                    &nbsp;&nbsp;<span id="npass" style="color: red;"></span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>确认密码：</th>
                <td>
                    <input type="password" name="password_confirmation"> </i>再次输入密码</span>
                    &nbsp;&nbsp;<span id="cnpass" style="color: red;"></span>
                </td>
            </tr>
            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>
<script type="text/javascript">
    $().ready(function(){
        $('#opass').css('visibility','hidden');
        $('input[name=password_o]').blur(function(){
            var o_pass=$(this).val();
            if(o_pass==''){
                $('#opass').html('请输入旧密码');
                $('#opass').css('visibility','visible');
            }else{
                $.ajax({
                    type:'POST',
                    url:'checkpass',
                    dataType:'json',
                    async:false,
                    cache: false,
                    data: {opass: o_pass, _token: "{{csrf_token()}}"},
                    success:function(data){
                        status = data.status;
                        if(data.status==2){
                            $('#opass').html(data.message);
                            $('#opass').css('visibility','visible');
                        }
                    }
                });
            }
        });
        $('input[name=password_o]').focus(function(){
            $('#opass').css('visibility','hidden');
        });

        $('input[name=password]').blur(function(){
            var newpass=$('input[name=password]').val();
            if(newpass==''){
                $('#npass').html('新密码不能为空');
                $('#npass').css('visibility','visible');

            }
        });

        $('input[name=password]').focus(function(){
            $('#npass').css('visibility','hidden');
        });

        $('input[name=password_confirmation]').blur(function(){
            var newpass=$('input[name=password_confirmation]').val();
            var cnewpass=$('input[name=password]').val();
            if(cnewpass==''){
                $('#cnpass').html('重复密码不能为空');
                $('#cnpass').css('visibility','visible');

            }
            if(newpass!=cnewpass){
                $('#cnpass').html('两次密码不一致');
                $('#cnpass').css('visibility','visible');
            }
        });

        $('input[name=password_confirmation]').focus(function(){
            $('#cnpass').css('visibility','hidden');
        });

        $('form').submit(function(){
            var newpass=$('input[name=password]').val();
            var c_newpass=$('input[name=password_confirmation]').val();

            var o_pass=$('input[name=password_o]').val();
            if(o_pass==''){
                $('#opass').html('密码不正确');
                $('#opass').css('visibility','visible');
                return false;
            }
            if(status==2){
                $('#opass').html('密码不正确');
                $('#opass').css('visibility','visible');
                return false;
            }
            if(newpass==''){
                $('#npass').html('新密码不能为空');
                $('#npass').css('visibility','visible');
                return false;
            }
            if(c_newpass==''){
                $('#cnpass').html('重复密码不能为空');
                $('#cnpass').css('visibility','visible');
                return false;

            }
            if(newpass!=c_newpass){
                $('#cnpass').html('两次密码不一致');
                $('#cnpass').css('visibility','visible');
                return false;
            }
        });
    });
</script>
@endsection