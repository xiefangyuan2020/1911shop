<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>微商城后台-商品品牌</title>
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
				<li><h3 style="color:pink">欢迎{{session('admin')->admin_name}}登录</h3></li>
				<li><h4><a style="color:red" href="{{url('/logout')}}">退出</a></h4></li>
			</ul>
		</div>
		</div>
	</nav>
<center>
	<h2>商品品牌
		<span style="float:right"><a class="btn btn-default" href="{{'/goods/create'}}">添加</a></span>
	</h2>
	<form action="">
		<input type="text" name="name" value="{{$name}}" placeholder="请输入搜索商品名称关键字">
		<select name="cate_id" id="">
			<option value="">--请选择所属分类--</option>
			@foreach($cate as $v)
			<option value="{{$v->cate_id}}" @if($v->cate_id==$cate_id) selected="selected" @endif>{{str_repeat('--',$v->level)}}{{$v->cate_name}}</option>
			@endforeach
		</select>
		<!-- <input type="text" name="min_price" placeholder="请输入最小商品价格"><input type="text" name="nax_price" placeholder="请输入商品最大价格"> -->
		<input type="submit" value="搜索">
	</form>
</center><hr/>
<table class="table">
	<thead>
		<tr>
	      	<th>商品id</th>
			<th>商品名称</th>
			<th>商品货号</th>
			<th>商品价格</th>
			<th>商品数量</th>
			<th>所属分类</th>
			<th>所属品牌</th>
			<th>是否显示</th>
			<th>是否新品</th>
			<th>是否精品</th>
			<th>商品主图</th>
			<th>商品相册</th>
			<th>商品描述</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($goods as $k=>$v)
	    <tr @if($k%2==0) class="success" @else class="danger" @endif>
	      	<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_sn}}</td>
			<td>{{$v->goods_price}}</td>
			<td>{{$v->goods_number}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->is_show==1?'√':'×'}}</td>
			<td>{{$v->is_new==1?'√':'×'}}</td>
			<td>{{$v->is_best==1?'√':'×'}}</td>
			<td>
				@if($v->goods_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="50">
				@endif
			</td>
			<td>
				@if($v->goods_imgs)
				@php $imgarr = explode('|',$v->goods_imgs);@endphp
				@foreach($imgarr as $vk)
				<img src="{{env('UPLOADS_URL')}}{{$vk}}" width="50">
				@endforeach
				@endif
			</td>
			<td>{{$v->goods_content}}</td>
			<td>
				<a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-primary">编辑</a>|
				<!-- <a href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a> -->
				<!-- ajax删除 -->
				<a href="javascript:void(0)" id="{{$v->goods_id}}" class="btn btn-danger">删除</a>
			</td>
	  </tr>
	  @endforeach
		<tr><td colspan=14 align="center">{{$goods->appends(['name'=>$name,'cate_id'=>$cate_id])->links()}}</td></tr>
	</tbody>
</table>
<script>
	// //无刷新分页
	// $(document).on('click','.page-item a',function(){
	// //$('.page-item a').click(function(){
	// 	var url = $(this).attr('href');
	// 	//alert(url);

	// 	$.get(url,function(res){
	// 		$('tbody').html(res);
	// 	});

	// 	return false;
	// })

	$('.btn-danger').click(function(res){
		// alert(123);
		var id = $(this).attr('id');
		// alert(id);
		if(confirm('您确定要删除吗?')){
			$.get('/goods/destroy/'+id,function(res){
				// alert(res);
				if(res.code=='00000'){
					location.href="/goods";
				}
			},'json');	
		}
		
	})

</script>
</body>
</html>