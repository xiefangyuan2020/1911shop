   <!--  继承布局 -->
   @extends('index.layouts.shop')

   @section('title', '首页')

   @section('content')

   <div class="head-top">
      <img src="/static/index/images/head.jpg" />
      <dl>
       <dt><a href="user.html"><img src="/static/index/images/touxiang.jpg" /></a></dt>
       <dd>
        <h1 class="username">三级分销终身荣誉会员</h1>
        <ul>
         <li><a href="prolist.html"><strong>34</strong><p>全部商品</p></a></li>
         <li><a href="javascript:;"><span class="glyphicon glyphicon-star-empty"></span><p>收藏本店</p></a></li>
         <li style="background:none;"><a href="javascript:;"><span class="glyphicon glyphicon-picture"></span><p>二维码</p></a></li>
         <div class="clearfix"></div>
        </ul>
       </dd>
       <div class="clearfix"></div>
      </dl>
     </div><!--head-top/-->
     <form action="#" method="get" class="search">
      <input type="text" class="seaText fl" />
      <input type="submit" value="搜索" class="seaSub fr" />
     </form><!--search/-->
     <ul class="reg-login-click">
      @if(session('user'))
        <li><span>欢迎{{session('user')->mobile}}登录</span></li>
        <li><a href="{{url('/logout')}}" class="rlbg">退出</a></li>
      @else
      <li><a href="{{url('/login')}}">登录</a></li>
      <li><a href="{{url('/reg')}}" class="rlbg">注册</a></li>
      @endif
      <div class="clearfix"></div>
     </ul><!--reg-login-click/-->
     <div id="sliderA" class="slider">
      @if($slice)
      @foreach($slice as $v)
      <img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" />
      @endforeach
      @endif
     </div><!--sliderA/-->
     <ul class="pronav">
       @if($cate)
      @foreach($cate as $v)
      <li><a href="{{url('cate'.$v->cate_id)}}">{{$v->cate_name}}</a></li>
       @endforeach
      @endif
      <div class="clearfix"></div>
     </ul><!--pronav/-->
     <div class="index-pro1">
       @if($best)
      @foreach($best as $v)
      <div class="index-pro1-list">
       <dl>
        <dt><a href="{{url('/proinfo/'.$v->goods_id)}}"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></a></dt>
        <dd class="ip-text"><a href="{{url('/proinfo/'.$v->goods_id)}}">{{$v->goods_name}}</a>
        <dd class="ip-price"><strong>¥{{$v->goods_price}}</strong>
       </dl>
      </div>
       @endforeach
      @endif
      <div class="clearfix"></div>
     </div><!--index-pro1/-->
     <div class="prolist">
         @foreach($new as $n)
      <dl>
       <dt><a href="{{url('/proinfo/'.$n->goods_id)}}"><img src="{{env('UPLOADS_URL')}}{{$n->goods_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('/proinfo/'.$n->goods_id)}}">{{$n->goods_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$n->goods_price}}</strong> </div>
        <div class="prolist-yishou"><span>5.0折</span></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
      @endforeach
     </div><!--prolist/-->
     <div class="joins"><a href="fenxiao.html"><img src="/static/index/images/jrwm.jpg" /></a></div>
     <div class="copyright">Copyright &copy; <span class="blue">这是就是三级分销底部信息</span></div>

    @include('index.common.footer')
     @endsection