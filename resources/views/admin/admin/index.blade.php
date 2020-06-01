<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>微商城后台-管理员管理</title>
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
				<li><a href="{{url('/brand')}}">商品品牌</a></li>
				<li><a href="{{url('/cate')}}">商品分类</a></li>
				<li><a href="{{url('/goods')}}">商品管理</a></li>
				<li class="active"><a href="{{url('/admin')}}">管理员管理</a></li>
				<li><h3 style="color:pink">欢迎{{session('admin')->admin_name}}登录</h3></li>
				<li><h4><a style="color:red" href="{{url('/logout')}}">退出</a></h4></li>
			</ul>
		</div>
		</div>
	</nav>
<center>
	<h2>管理员管理
		<span style="float:right"><a class="btn btn-default" href="{{'/admin/create'}}">添加</a></span>
	</h2>
</center><hr/>
<table class="table">
	<thead>
		<tr>
	      	<th>管理员id</th>
			<th>管理员名称</th>
			<th>管理员头像</th>
			<th>管理员手机号</th>
			<th>管理员邮箱</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($admin as $k=>$v)
	    <tr @if($k%2==0) class="success" @else class="danger" @endif>
	      <td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
			<td>
				@if($v->admin_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->admin_img}}" width="50">
				@endif
			</td>
			<td>{{$v->admin_tel}}</td>
			<td>{{$v->admin_email}}</td>
			<td>{{date('Y-m-d H:i:s',$v->admin_time)}}</td>
			<td>
				<a href="{{url('/admin/edit/'.$v->admin_id)}}" class="btn btn-primary">编辑</a>|
				<a href="{{url('/admin/destroy/'.$v->admin_id)}}" class="btn btn-danger">删除</a>
			</td>
	  </tr>
	  @endforeach
		
		<tr><td colspan=7 align="center">{{$admin->links()}}</td></tr>
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
</script>
</body>
</html>