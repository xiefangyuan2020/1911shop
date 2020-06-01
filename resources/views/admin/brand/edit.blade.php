<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <center>
    <form method="post" action="{{url('/brand/update/'.$data->brand_id)}}"  enctype="multipart/form-data">
      @csrf
      <table>
        <h3>品牌修改</h3>
        <tr>
          <td>品牌名称</td>
          <td>
            <input type="text" name="brand_name" value="{{$data->brand_name}}"  placeholder="请输入名称">
          </td>
        </tr>
        <tr>
          <td>品牌网址</td>
          <td>
            <input type="text" name="brand_url" value="{{$data->brand_url}}"  placeholder="请输入网址">
          </td>
        </tr>
        <tr>
          <td>品牌LOGO</td>
          <td>
            <input type="file" name="brand_img">
            @if($data->brand_img)
              <img src="{{env('UPLOADS_URL')}}{{$data->brand_img}}" width="50">
            @endif
          </td>
        </tr>
        <tr>
          <td>品牌内容</td>
          <td>
            <textarea name="brand_centent" id="" cols="20" rows="5">{{$data->brand_centent}}</textarea>
          </td>
        </tr>
        <tr>
          <td></td>
          <td>
            <input type="submit" value="编辑">
            <button type="button" class="btn btn-info"><a href="{{url('/brand')}}" >列表</a></button>
          </td>
        </tr>
      </table>
    </form>
  </center>
</body>
</html>