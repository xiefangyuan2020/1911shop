<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>文章管理功能</title>
  <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center>
  <h2>文章分类
    <span style="float:right"><a class="btn btn-default" href="{{'/article/'}}">列表</a></span>
  </h2>
</center><hr/>
    
    <form class="form-horizontal" role="form" method="post" action="{{url('/article/update/'.$data->article_id)}}" enctype="multipart/form-data">
       @csrf
    <div class="form-group">
      <label for="firstname" class="col-sm-2 control-label">文章标题</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="{{$data->article_name}}" name="article_name" id="firstname" placeholder="请输入文章标题">
         <b style="color:green">{{$errors->first('article_name')}}</b>
      </div>
    </div>
     <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">文章分类</label>
    <div class="col-sm-10">
      <select class="form-control" name="class_id" id="firstname">
        <option value="0">--请选择--</option>
        @foreach($article as $v)
        <option value="{{$v->article_id}}" {{$data->article_id==$v->article_id?'selected':''}}>
          {{str_repeat('|——',$v->level)}}{{$v->article_name}}</option>
        @endforeach
      </select>
       <b style="color:pink">{{$errors->first('class_id')}}</b>
    </div>
  </div>
  <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">文章重要性</label>
    <div class="col-sm-10">
      <input type="radio" name="is_sing" value="1" @if($data->is_sing==1)checked @endif checked>普通
      <input type="radio" name="is_sing" value="2" @if($data->is_sing==2)checked @endif>顶置
      <b style="color:pink">{{$errors->first('is_sing')}}</b>
    </div>
    </div>
    <div class="form-group">
    <label for="firstname" class="col-sm-2 control-label">是否显示</label>
    <div class="col-sm-10">
      <input type="radio" name="is_show" value="1" @if($data->is_sing==1)checked @endif checked>显示
      <input type="radio" name="is_show" value="2" @if($data->is_sing==2)checked @endif>不显示
      <b style="color:green">{{$errors->first('is_show')}}</b>
    </div>
  </div>
   <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">上传文件</label>
      <div class="col-sm-10">
        <input type="file" class="form-control"  id="lastname" name="article_img">
        @if($data->article_img)
          <img src="{{env('UPLOADS_URL')}}{{$data->article_img}}" width="50">
        @endif
      </div>
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">文章作者</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="{{$data->article_man}}" name="article_man" id="lastname">
        <b style="color:green">{{$errors->first('article_man')}}</b>
      </div>
    </div>
     <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">作者email</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="article_email" value="{{$data->article_email}}" id="lastname">
        <b style="color:green">{{$errors->first('article_email')}}</b>
      </div>
    </div>
    <div class="form-group">
      <label for="lastname" class="col-sm-2 control-label">关键字</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="article_word" value="{{$data->article_word}}" id="lastname">
        <b style="color:green">{{$errors->first('article_word')}}</b>
      </div>
    </div>
   <div class="form-group">
    <label for="lastname" class="col-sm-2 control-label">网页描述</label>
    <div class="col-sm-10">
      <textarea type="text" name="article_content" class="form-control" id="lastname">{{$data->article_content}}</textarea>
    </div>
  </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-warning" >确定</button>
      </div>
    </div>
  </form>
</body>
</html>