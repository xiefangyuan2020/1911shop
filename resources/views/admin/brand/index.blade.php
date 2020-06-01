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
				<li class="active"><a href="{{url('/brand')}}">商品品牌</a></li>
				<li><a href="{{url('/cate')}}">商品分类</a></li>
				<li><a href="{{url('/goods')}}">商品管理</a></li>
				<li><a href="{{url('/admin')}}">管理员管理</a></li>
			</ul>
		</div>
		</div>
	</nav>
<center>
	<h2>商品品牌
		<span style="float:right"><a class="btn btn-default" href="{{'/brand/create'}}">添加</a></span>
	</h2>
</center><hr/>
<form action="">
	<input type="text" name="brand_name" value="{{$brand_name}}" placeholder="请输入品关键字">
	<button>搜索</button>
</form>
<table class="table">
	<thead>
		<tr>
	      	<th>品牌id</th>
			<th>品牌名称</th>
			<th>品牌网址</th>
			<th>品牌LOGO</th>
			<th>品牌介绍</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($brand as $k=>$v)
	    <tr @if($k%2==0) class="success" @else class="danger" @endif>
	      <td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
			<td>{{$v->brand_url}}</td>
			<td>
				@if($v->brand_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->brand_img}}" width="50">
				@endif
			</td>
			<td>{{$v->brand_centent}}</td>
			<td>
				<a href="{{url('/brand/edit/'.$v->cate_id)}}" class="btn btn-primary">编辑</a>|
				<!-- <a href="{{url('/brand/destroy/'.$v->brand_id)}}" class="btn btn-danger">删除</a> -->
				<a href="javascript:void(0)" id="{{$v->brand_id}}" class="btn btn-danger">删除</a>
			</td>
	  </tr>
	  @endforeach
		
		<tr><td colspan=5 align="center">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td></tr>
	</tbody>
</table>
<script>
	//无刷新分页
	$(document).on('click','.page-item a',function(){
	//$('.page-item a').click(function(){
		var url = $(this).attr('href');
		//alert(url);

		$.get(url,function(res){
			$('tbody').html(res);
		});

		return false;
	})

	//ajax删除
	$('.btn-danger').click(function(res){
		//alert(123);
		var id = $(this).attr('id');
		//alert(id);
		if(confirm('您确定要删除吗?')){
			$.get('/brand/destroy/'+id,function(res){
			//alert(res);
				if(res.code=='00000'){
					location.href="/brand";
				}
			},'json');
		}
		
	})

</script>
</body>
</html>