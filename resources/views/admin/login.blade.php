<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>微商城后台登录</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  <h2 align="center">微商城后台登录</h2><hr>
  <b>{{session('msg')}}</b>
    <form class="form-horizontal" role="form" method="post" action="{{url('/loginDO')}}" enctype="multipart/form-data">
       @csrf
    <div class="form-group">
      <label for="firstname" class="col-sm-4 control-label">用户名</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" name="admin_name"  id="firstname" placeholder="请输入用户名">
      </div>
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-4 control-label">密码</label>
      <div class="col-sm-5">
        <input type="password" class="form-control" name="admin_pwd" id="lastname" placeholder="请输入密码">
      </div>
    </div>
    <div class="form-group">
    <div class="col-sm-offset-4 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="isremember">七天免登陆
        </label>
      </div>
    </div>
  </div>
    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-4">
        <button type="submit" class="btn btn-warning" >登录</button>
      </div>
    </div>
  </form>
</body>
</html>