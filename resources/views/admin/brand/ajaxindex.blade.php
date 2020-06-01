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
				<a href="{{url('/brand/destroy/'.$v->brand_id)}}" class="btn btn-danger">删除</a>
			</td>
	  </tr>
	  @endforeach
		
		<tr><td colspan=5 align="center">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td></tr>