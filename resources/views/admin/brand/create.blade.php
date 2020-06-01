<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>微商城后台 --商品品牌</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
  <div class="navbar-header">
    <a class="navbar-brand" href="#">微商城</a>
  </div>
  <div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="{{url('/brand')}}">商品品牌</a></li>
      <li><a href="{{url('/cate')}}">商品分类</a></li>
      <li><a href="{{url('/goods')}}">商品管理</a></li>
      <li><a href="{{url('/admin')}}">管理员管理</a></li>
    </ul>
  </div>
  </div>
</nav>
<center>
  <h2>商品分类
    <span style="float:right"><a class="btn btn-default" href="{{'/brand/'}}">列表</a></span>
  </h2>
</center><hr/>
   <!--  @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
        </ul>
    </div>
    @endif -->
    
    <form class="form-horizontal" role="form" method="post" action="{{url('/brand/store')}}" enctype="multipart/form-data">
       @csrf
    <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">品牌名称</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="brand_name" id="firstname" placeholder="请输入品牌名称">
        <b style="color:green">{{$errors->first('brand_name')}}</b>
      </div>
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">品牌网址</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="brand_url" id="lastname" placeholder="请输入品牌网址">
         <b style="color:pink">{{$errors->first('brand_url')}}</b>
      </div>
    </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
      <div class="col-sm-10">
        <input type="file" class="form-control"  id="lastname" name="brand_img">
      </div>
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">品牌内容</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="brand_centent" id="lastname" >
        <b style="color:purple">{{$errors->first('brand_centent')}}</b>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-warning" >提交</button>
      </div>
    </div>
  </form>
</body>
</html>