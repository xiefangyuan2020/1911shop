 <!--  继承布局 -->
   @extends('index.layouts.shop')

   @section('title', '登录页面')

   @section('content')
  
<header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <b style="color:red">{{session('msg')}}</b>
     <form action="{{url('regdo')}}" method="post" class="reg-login">
      @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('login')}}">登陆</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="username" placeholder="输入手机号码或者邮箱号" /></div>
       <div class="lrList2"><input type="text" name="code" id="code" placeholder="输入短信验证码" /> <button type="button">获取验证码</button></div>
       <div class="lrList"><input type="password" name="pwd" placeholder="设置新密码（6-18位数字或字母）" /></div>
       <div class="lrList"><input type="password" name="repwd" placeholder="再次输入密码" /></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
      </form><!--reg-login/-->

      <script>
        $('button').click(function(){
          var username = $('input[name="username"]').val();
          var telreg = /^1[3|4|5|6|7|8|9]\d{9}$/;
           var email = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
          // alert(email.test(username));
          if(telreg.test(username)){
            //手机号发送验证码
            $.get('/sendSms',{username:username},function(res){
              //alert(res);
              //if(res.code=='00001'){
                alert(res.msg); return;
              //}
            },'json')
          }else if(email.test(username)){
            //邮箱发送验证码
             $.get('/sendEmail',{username:username},function(res){
              //alert(res);
              //if(res.code=='00001'){
                alert(res.msg);
              //}
            },'json')
          }else{
            alert('请输入正确的手机号或邮箱');
          }
        })

        $("#code").blur(function(){
          var code = $("#code").val;
          alert($code);
        })

      </script>
       @include('index.common.footer')
      @endsection