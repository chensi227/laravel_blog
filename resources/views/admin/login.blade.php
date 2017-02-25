<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{asset('admin/style/css/ch-ui.admin.css')}}">
	<link rel="stylesheet" href="{{asset('admin/style/font/css/font-awesome.min.css')}}">
	<script type="text/javascript" src="{{asset('js/jquery-1.11.2.min.js')}}"></script>
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Blog</h1>
		<h2>欢迎使用博客管理平台</h2>
		<div class="form">
			<p style="color:red" id="message">欢迎你</p>
			<form action="" method="post">
				{{csrf_field()}}
				<input type="hidden" name="msg" value="{{session('msg')}}" />
				<ul>
					<li>
					<input type="text" name="username" class="text"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="password" class="text"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{url('admin/code')}}" alt="" onclick="this.src='{{url('admin/code')}}?'+Math.random()">
					</li>
					<li>
						<input type="submit" value="立即登陆"/>
					</li>
				</ul>
			</form>
			<p><a href="">返回首页</a> &copy; 2016 Powered by <a href="http://blog.laravel.com" target="_blank">http://blog.laravel.com</a></p>
		</div>
	</div>
</body>
<script type="text/javascript">
	$().ready(function(){
		$('#message').css('visibility','hidden');
		var msg = $('input[name=msg]').val();
		if(msg==1){
			$('#message').html('验证码不正确');
			$('#message').css('visibility','visible');
		}
		if(msg==2){
			$('#message').html('用户名或者密码错误');
			$('#message').css('visibility','visible');
		}
		$('form').submit(function(){
			var username = $('input[name=username]').val();
			if(username==''){
				$('#message').html('帐号不能为空');
				$('#message').css('visibility','visible');
				return false;
			}
			var password = $('input[name=password]').val();
			if(password==''){
				$('#message').html('密码不能为空');
				$('#message').css('visibility','visible');
				return false;
			}
			var code = $('input[name=code]').val();
			if(code==''){
				$('#message').html('验证码不能为空');
				$('#message').css('visibility','visible');
				return false;
			}
			if(code.length < 4){
				$('#message').html('验证码不能少于4位');
				$('#message').css('visibility','visible');
				return false;
			}
			var o = 1;
			$.ajax({
				type:'POST',
				url:'check',
				dataType:'json',
				async:false,
				cache: false,
				data: {username: username, password: password, code: code, _token: "{{csrf_token()}}"},
				success:function(data){
					if(data == null) {
						$('#message').html('验证码不能少于4位');
						$('#message').css('visibility','visible');
						return false;
					}
					if(data.status == 1) {
						$('#message').html(data.message);
						$('#message').css('visibility','visible');
						o = 2;
					}
				}
			});

			if(o==2){
				return false;
			}
		});
	});
</script>
</html>
