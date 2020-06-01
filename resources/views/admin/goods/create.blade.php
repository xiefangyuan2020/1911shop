<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>微商城后台 --商品品牌</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
  <h2>商品管理
    <span style="float:right"><a class="btn btn-default" href="{{'/goods/'}}">列表</a></span>
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
    
    <form class="form-horizontal" role="form" method="post" action="{{url('/goods/store')}}" enctype="multipart/form-data">
       @csrf
    <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">商品名称</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="goods_name" id="firstname" placeholder="请输入商品名称">
         <span style="color:green">{{$errors->first('goods_name')}}</span>
      </div>
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">商品货号</label>
      <div class="col-sm-10">
        <input type="text"  class="form-control" name="goods_sn" id="lastname">
        <span style="color:green">{{$errors->first('goods_sn')}}</span>
      </div>
    </div>
     <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">商品价格</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="goods_price" id="lastname">
        <span style="color:green">{{$errors->first('goods_price')}}</span>
      </div>
    </div>
     <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">商品库存</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="goods_number" id="lastname">
         <span style="color:green">{{$errors->first('goods_number')}}</span>
      </div>
    </div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">所属分类</label>
		<div class="col-sm-10">
			<select class="form-control" name="cate_id" id="firstname">
				<option value="">-请选择-</option>
        @foreach($cate as $v)
        <option value="{{$v->cate_id}}">{{str_repeat('--',$v->level)}}{{$v->cate_name}}</option>
        @endforeach
			</select>
       <span style="color:green">{{$errors->first('cate_id')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">所属品牌</label>
		<div class="col-sm-10">
			<select class="form-control" name="brand_id" id="firstname">
				<option value="">-请选择-</option>
        @foreach($brand as $v)
        <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
        @endforeach
			</select>
       <span style="color:green">{{$errors->first('brand_id')}}</span>
		</div>
	</div>
  	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否上架</label>
		<div class="col-sm-10">
			<input type="radio" name="is_show" value="1" checked>上架
			<input type="radio" name="is_show" value="2">下架
		</div>
	</div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">首页幻灯片首位</label>
    <div class="col-sm-10">
      <input type="radio" name="is_slice" value="1" >是
      <input type="radio" name="is_slice" value="2" checked>否
    </div>
  </div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_new" value="1" checked>是
			<input type="radio" name="is_new" value="2">否
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio" name="is_best" value="1" checked>是
			<input type="radio" name="is_best" value="2">否
		</div>
	</div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">商品主图</label>
      <div class="col-sm-10">
        <input type="file" class="form-control"  id="lastname" name="goods_img">
      </div>
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">商品相册</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" name="goods_imgs[]" multiple="multiple" id="lastname" name="brand_img">
      </div>
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">品牌内容</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="goods_content" id="lastname" >
        
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="button" class="btn btn-warning" >提交</button>
      </div>
    </div>
  </form>

  <script>
  //商品名称失去焦点事件
    $('input[name="goods_name"]').blur(function(){
      $(this).next().empty();
      var goods_name = $(this).val();
      //alert(goods_name);
      var reg = /^[\u4e00-\u9fa5\w]{2,50}$/;
      //验证规则
      //alert(reg.test(goods_name));
      if(!reg.test(goods_name)){
        $(this).next().text('商品名称可以包含中文、数字、字母、下划线且唯一，长度范围为2-50位');
        return;
      }
      //验证唯一性
      $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      $.post('/goods/checkName',{goods_name:goods_name},function(res){
        // alert(res);
        if(res>0){
          $('input[name="goods_name"]').next().text('商品名称已存在');
        }
      })
    })

    //商品货号失去焦点
    $('input[name="goods_sn"]').blur(function(){
      $(this).next().empty();
      var goods_sn = $(this).val();
      //alert(goods_sn);
      if(!goods_sn){
        $(this).next().text('商品货号不能为空');
        return;
      }
    })

    //商品价格失去焦点
    $('input[name="goods_price"]').blur(function(){
      $(this).next().empty();
      var goods_price = $(this).val();
      //alert(goods_price);
      if(!goods_price){
        $(this).next().text('商品货号不能为空');
        return;
      }
    })

    //商品库存失去焦点
    $('input[name="goods_number"]').blur(function(){
      $(this).next().empty();
      var goods_number = $(this).val();
      //alert(goods_number);
      if(!goods_number){
        $(this).next().text('商品货号不能为空');
        return;
      }
    })

    //给button按钮加点击事件
    $('button').click(function(){
      var goods_name = $('input[name="goods_name"]').val();
      var reg = /^[\u4e00-\u9fa5\w]{2,50}$/;
      //验证规则
      //alert(reg.test(goods_name));
      if(!reg.test(goods_name)){
        $('input[name="goods_name"]').next().text('商品名称可以包含中文、数字、字母、下划线且唯一，长度范围为2-50位');
        return;
      }
       //验证唯一性
       var flag = true;
      $.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
      // $.post('/goods/checkName',{goods_name:goods_name},function(res){
      //   // alert(res);
      //   if(res>0){
      //     $('input[name="goods_name"]').next().text('商品名称已存在');
      //     return;
      //   }
      // });

      $.ajax({
        url:'/goods/checkName',
        type:"POST",
        data:{goods_name:goods_name},
        async:false,
        success:function(msg){
          if(msg>0){
            $('input[name="goods_name"]').next().text('商品名称已存在');
            flag = false;
          }
        }
      })
      //alert(false);

      if(!flag) return;

      var goods_sn = $('input[name="goods_sn"]').val();
      //alert(goods_sn);
      if(!goods_sn){
        $('input[name="goods_sn"]').next().text('商品货号不能为空');
        return;
      }

      var goods_price = $('input[name="goods_price"]').val();
      //alert(goods_price);
      if(!goods_price){
        $('input[name="goods_price"]').next().text('商品价格不能为空');
        return;
      }

      var goods_number = $('input[name="goods_number"]').val();
      //alert(goods_number);
      if(!goods_number){
        $('input[name="goods_number"]').next().text('商品库存不能为空');
        return;
      }

      $('form').submit();

    })

  </script>

</body>
</html>