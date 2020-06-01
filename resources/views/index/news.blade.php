<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>新闻管理</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
  <h2>新闻管理
  </h2>
</center><hr/>
<form action="">
  <input type="text" name="title" value="{{$title}}" placeholder="请输入关键字">
  <input type="submit" value="搜素">
</form>
<table class="table">
  <thead>
    <tr>
      <th>id</th>
      <th>标题</th>
      <th>作者</th>
      <th>操作</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($news as $k=>$v)
      <tr @if($k%2==0) class="success" @else class="danger" @endif>
        <td>{{$v->n_id}}</td>
      <td>{{$v->title}}</td>
      <td>{{$v->autoun}}</td>
      <td>
        <a href="" class="btn btn-primary">编辑</a>|
        <a href="" class="btn btn-danger">删除</a>
      </td>
    </tr>
    @endforeach
    
    <tr><td colspan=7 align="center">{{$news->appends(['title'=>$title])->links()}}</td></tr>
  </tbody>
</table>
</body>
</html>