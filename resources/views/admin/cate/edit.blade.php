<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>微商城后台 --商品分类</title>
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
			<li class="active"><a href="{{url('/cate')}}">商品分类</a></li>
			<li><a href="{{url('/goods')}}">商品管理</a></li>
			<li><a href="{{url('/admin')}}">管理员管理</a></li>
		</ul>
	</div>
	</div>
</nav>
	<center>
		<form action="{{url('/cate/update/'.$data->cate_id)}}" method="post">
			@csrf
			<table>
				<tr>
					<td>分类名称</td>
					<td>
						<input type="text" name="cate_name" value="{{$data->cate_name}}">
						<b style="color:green">{{$errors->first('cate_name')}}</b>
					</td>
				</tr>
				<tr>
					<td>父级分类</td>
					<td>
						<select name="parent_id" id="">
							<option value="0">--请选择--</option>
							@foreach($cate as $k=>$v)
							<option value="{{$v->cate_id}}"{{$data->parent_id==$v->cate_id?'selected':''}}>{{str_repeat('--',$v->level)}}{{$v->cate_name}}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td>是否上架</td>
					<td>
						<input type="radio" name="is_show" value="1" @if($data->is_show==1)checked @endif>是
						<input type="radio" name="is_show" value="2" @if($data->is_show==2)checked @endif>否
					</td>
				</tr>
				<tr>
					<td>是否在导航栏显示</td>
					<td>
						<input type="radio" name="is_nav_show" value="1" @if($data->is_nav_show==1)checked @endif>是
						<input type="radio" name="is_nav_show" value="2" @if($data->is_nav_show==2)checked @endif>否
					</td>
				</tr>
				<tr>
					<td>分类描述</td>
					<td>
						<textarea name="cate_desc" id="" cols="20" rows="5">{{$data->cate_desc}}</textarea>
						<b style="color:green">{{$errors->first('cate_desc')}}</b>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<input type="submit" value="提交">
					</td>
				</tr>
			</table>
		</form>
	</center>
</body>
</html>