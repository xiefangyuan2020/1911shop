<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Cate;
use App\Cart;
use DB;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class ProController extends Controller
{
    public function prolist(){
        $id=request()->id;
        if($id){
            $array=Cate::get();
            $cateId=getCateId($array,$id);
            $goodsInfo=Goods::getGoodsInfoPid($cateId);
            return view("index.prolist",["goodsInfo"=>$goodsInfo]);
        }else{
            $goodsInfo=Goods::getGoodsInfo();
            return view("index.prolist",["goodsInfo"=>$goodsInfo]);
        }   
    }
    public function proinfo($id){
       
        //当前访问量
        //dump(Cache::add('visit'.$id,1));
        //$visit = Cache::add('visit'.$id,1)?1:Cache::increment('visit_'.$id);

        //$goodsInfoId = Cache::get('goodsInfoId_'.$id);

        //redis使用
        $visit = Redis::setnx('visit'.$id,1)?1:Redis::incr('visit_'.$id);

        //全局辅助函数
        $goodsInfoId = cache('goodsInfoId_'.$id);

        //dump($goodsInfoId);
        if(!$goodsInfoId){
            echo "DB==";

            $goodsInfoId=Goods::getGoodsInfoId($id);
            //Cache::put('goodsInfoId_'.$id,$goodsInfoId,60);
            Cache(['goodsInfoId_'.$id=>$goodsInfoId],60);
        }

        
        $goodsInfoId->goods_imgs=explode("|",$goodsInfoId->goods_imgs);
        return view("index.proinfo",["goodsInfoId"=>$goodsInfoId,'visit'=>$visit]);
    }

    //实现加入购物车
    public function addcar(Request $request){
        $goods_id = $request->goods_id;
        $buy_number = $request->buy_number;
        //echo $goods_id.'='.$buy_number;

        //1.判断是否登录 没登录：提示请先登录
        $user = session('user');
        if(!$user){
            echo json_encode(['code'=>'00001','msg'=>'用户未登录']);die;
        }

        //2.判断商品是否上架 下架：提示商品下架
        $goods = Goods::find($goods_id);
        if($goods->is_show!=1){
            echo json_encode(['code'=>'00002','msg'=>'对不起,商品已下架']);die;
        }

        //3.判断库存 购买数量大于库存 提示数量不足
        if($buy_number>$goods->goods_number){
            echo json_encode(['code'=>'00003','msg'=>'商品库存不足']);die;
        }

        //4.判断购物车内是否加入过此商品 由此商品(update)：购买数量相加，加完之后判断库存有没有，
        $where =  ['user_id'=>$user->member_id,'goods_id'=>$goods_id];
        $cart = Cart::where($where)->first();
        //dd($cart);
        //dump($cart);
        if(!$cart){
            //没有:add入库
            $data = [
                'user_id'=>$user->member_id,
                'goods_id'=>$goods_id,
                'goods_name'=>$goods->goods_name,
                'goods_img'=>$goods->goods_img,
                'buy_number'=>$buy_number,
                'goods_price'=>$goods->goods_price,
                'addtime'=>time()
            ];
            $res = Cart::insert($data);
        }else{
            //更新
            $buy_number = $buy_number+$cart->buy_number;
            //echo $buy_number;
            if($buy_number>=$goods->goods_number){
                $buy_number = $goods->goods_number;
            }
            $res = Cart::where($where)->update(['buy_number'=>$buy_number]);
        }
        
        if($res!==false){
            echo json_encode(['code'=>'00000','msg'=>'加入成功']);die;
        }

    }

}
