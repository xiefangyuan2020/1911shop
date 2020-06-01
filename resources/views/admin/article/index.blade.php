<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>文章分类管理</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
	<h2>文章分类
		<span style="float:right"><a class="btn btn-default" href="{{'/article/create'}}">添加</a></span>
	</h2>
	<form action="">
		<input type="text" name="name" value="{{$name}}" placeholder="请输入搜索商品名称关键字">
		<select name="class_id" id="">
			<option value="">--请选择所属分类--</option>
			@foreach($article as $v)
			<option value="{{$v->class_id}}" @if($v->class_id==$class_id) selected="selected" @endif>{{str_repeat('--',$v->level)}}{{$v->article_name}}</option>
			@endforeach
		</select>
		<!-- <input type="text" name="min_price" placeholder="请输入最小商品价格"><input type="text" name="nax_price" placeholder="请输入商品最大价格"> -->
		<input type="submit" value="搜索">
	</form>
</center><hr/>
<table class="table">
	<thead>
		<tr>
	      	<th>文章编号</th>
			<th>文章分类</th>
			<th>文章的重要性</th>
			<th>是否显示</th>
			<th>上传文件</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($article as $v)
			<tr>
				<td>{{$v->article_id}}</td>
				<td>{{str_repeat('--',$v->level)}}{{$v->article_name}}</td>
				<td>{{$v->is_sing==1?'普通':'顶置'}}</td>
				<td>{{$v->is_show==1?'√':'×'}}</td>
				<td>
				@if($v->article_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->article_img}}" width="50">
				@endif
				</td>
				<td>{{date('Y-m-d H:i:s',$v->article_time)}}</td>
				<td>
					<a href="{{url('/article/edit/'.$v->article_id)}}" class="btn btn-primary">编辑</a>|
					<a href="{{url('/article/destroy/'.$v->article_id)}}" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach
			<tr><td colspan=14 align="center">{{$article->appends(['name'=>$name,'class_id'=>$class_id])->links()}}</td></tr>

	</tbody>
</table>
</body>
</html>