<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>后台登录-X-admin2.0</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    
    @include('admin.public.style');
    @include('admin.public.script');

</head>
<body class="login-bg">
    
    <div class="login layui-anim layui-anim-up">
        <div class="message">liner的后台管理系统</div>
        <div id="darkbannerwrap"></div>
        
        @if (is_object($errors) && count($errors)>0)
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $item)
                  <li>{{$item}}</li>
              @endforeach
            </ul>
          </div>
        @elseif(is_string($errors)) 
          <div class="alert alert-danger">
            <ul>
                  <li>{{$errors}}</li>
            </ul>
          </div>
        @endif
        <form method="post" class="layui-form" action="{{url('admin/dologin')}}">
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" style="border-radius: 7px">
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input" style="border-radius: 7px">
            <hr class="hr15">
            <input name="vericode" style="border-radius: 7px;width: 150px;float: left;" lay-verify="required" placeholder="验证码"  type="text" class="layui-input">
            <img src="{{captcha_src()}}" alt="" style="float: right;height:50px;" onclick="this.src='{{captcha_src()}}?'+Math.random()">
            <hr class="hr15">
            {{ csrf_field() }}
            <input value="登录" lay-submit lay-filter="login" style="width:100%;border-radius: 8px;" type="submit">
            <hr class="hr20" >
        </form>
    </div>

    <script>
        $(function  () {
            layui.use('form', function(){
              var form = layui.form;
              // layer.msg('玩命卖萌中', function(){
              //   //关闭后的操作
              //   });
              //监听提交
              // form.on('submit(login)', function(data){
              //   // alert(888)
              //   layer.msg(JSON.stringify(data.field),function(){
              //       location.href='{{url('admin/index')}}'
              //   });
              //   return false;
              // });
            });
        })

        
    </script>

    
    <!-- 底部结束 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0]; 
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>