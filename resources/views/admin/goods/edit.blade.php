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
      <li ><a href="{{url('/brand')}}">商品品牌</a></li>
      <li><a href="{{url('/cate')}}">商品分类</a></li>
      <li class="active"><a href="{{url('/goods')}}">商品管理</a></li>
      <li><a href="{{url('/admin')}}">管理员管理</a></li>
    </ul>
  </div>
  </div>
</nav>
<center>
  
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
    
    <form class="form-horizontal" role="form" method="post" action="{{'/goods/update/'.$data->goods_id}}" enctype="multipart/form-data">
       @csrf
    <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">商品名称</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="goods_name" id="firstname" value="{{$data->goods_name}}" placeholder="请输入商品名称">
        <b style="color:green">{{$errors->first('goods_name')}}</b>
      </div>
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">商品货号</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="goods_sn" value="{{$data->goods_sn}}" id="lastname">
      </div>
    </div>
     <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">商品价格</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="goods_price" value="{{$data->goods_price}}" id="lastname">
        <b style="color:green">{{$errors->first('goods_price')}}</b>
      </div>
    </div>
     <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">商品库存</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="goods_number" value="{{$data->goods_number}}" id="lastname">
         <b style="color:green">{{$errors->first('goods_number')}}</b>
      </div>
    </div>
    <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">所属分类</label>
    <div class="col-sm-10">
      <select class="form-control" name="cate_id" id="firstname">
        <option value="">-请选择-</option>
        @foreach($cate as $v)
        <option value="{{$v->cate_id}}" {{$data->cate_id==$v->cate_id?'selected':''}}>{{str_repeat('--',$v->level)}}{{$v->cate_name}}</option>
        @endforeach
      </select>
       <b style="color:green">{{$errors->first('cate_id')}}</b>
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">所属品牌</label>
    <div class="col-sm-10">
      <select class="form-control" name="brand_id" id="firstname">
        <option value="">-请选择-</option>
        @foreach($brand as $v)
        <option value="{{$v->brand_id}}" {{$data->brand_id==$v->brand_id?'selected':''}}>{{$v->brand_name}}</option>
        @endforeach
      </select>
       <b style="color:green">{{$errors->first('brand_id')}}</b>
    </div>
  </div>
  	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否上架</label>
		<div class="col-sm-10">
			<input type="radio" name="is_show" value="1" @if($data->is_show==1)checked @endif checked>上架
			<input type="radio" name="is_show" value="2" @if($data->is_show==2)checked @endif >下架
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_new" value="1" @if($data->is_new==1)checked @endif checked>是
			<input type="radio" name="is_new" value="2" @if($data->is_new==2)checked @endif  >否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_best" value="1" @if($data->is_best==1)checked @endif checked>是
			<input type="radio" name="is_best" value="2" @if($data->is_best==2)checked @endif>否
		</div>
	</div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">商品主图</label>
      <div class="col-sm-10">
        <input type="file" class="form-control"  id="lastname" name="goods_img">
        @if($data->goods_img)
              <img src="{{env('UPLOADS_URL')}}{{$data->goods_img}}" width="50">
        @endif
      </div>
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">商品相册</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" name="goods_imgs[]" multiple id="lastname" name="goods_imgs">
        <b style="color:green">{{$errors->first('goods_imgs')}}</b>
      </div>
      @if($v->goods_imgs)
        @php $imgarr = explode('|',$v->goods_imgs);@endphp
        @foreach($imgarr as $vk)
        <img src="{{env('UPLOADS_URL')}}{{$vk}}" width="50">
        @endforeach
      @endif
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">品牌内容</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="goods_content" id="lastname" >{{$data->goods_content}}</textarea>
        
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-warning" >修改</button>
      </div>
    </div>
  </form>
</body>
</html>