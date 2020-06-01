   <!--  继承布局 -->
   @extends('index.layouts.shop')

   @section('title', $goodsInfoId->goods_name)

   @section('content')

     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
      <div id="sliderA" class="slider">
        @foreach($goodsInfoId->goods_imgs as $vv)
      <img src="{{env('UPLOADS_URL')}}{{$vv}}" />
        @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">￥{{$goodsInfoId->goods_price}}</strong></th>
       <td>
        <input type="text" id="buy_number" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$goodsInfoId->goods_name}}</strong> 访问量:{{$visit}}
        <p class="hui">{{$goodsInfoId->goods_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      {{$goodsInfoId->goods_content}}
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a id="addcar" goods_id="{{$goodsInfoId->goods_id}}" href="javascript:void(0)">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <script>
      $("#addcar").click(function(){
        var goods_id = $(this).attr('goods_id');
        //alert(goods_id);
        var buy_number = $('.spinnerExample').val();
        //alert(buy_number);

        $.get('/addcar',{goods_id:goods_id,buy_number:buy_number},function(res){
          if(res.code=='00001'){
            if(confirm('您当前未登录，是否跳转去登陆')){
              location.href = "/login?refer="+location.href;
            }
          }

          if(res.code=='00002' || res.code=='00003'){
            alert(res.msg);
          } 

          if(res.code=='00000'){
            alert(res.msg);
            location.href = "/cart";
          } 

        },'json');

      })
    </script>
       @include('index.common.footer')
       @endsection