<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Goods;
use App\Cate;
use App\Http\Requests\StoreGoodsPost;
use DB;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //session应用
        //存储
        // $request->session()->put('name','admin');
        // session(['class'=>'1911']);

        // //获取
        // echo $request->session()->get('name');
        // echo session('class');

        // //删除
        // $request->session()->forget('name');
        // session(['class'=>null]);

        // dump($request->session()->get('name'));
        // dump($request->session()->get('class'));

        // //判断 session里有没有此键
        // dump($request->session()->has('name'));
        // dump($request->session()->exists('class'));

        // die;

        //商品分类
        $cate = Cate::all();
        $cate = CreateTree($cate);

        //搜索
        $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['goods_name','like',"%$name%"];
        }

        //根据商品分类搜索
        $cate_id = request()->cate_id;
        if($cate_id){
            $where[] = ['goods.cate_id','=',$cate_id];
        }

        //根据价格搜索 
        //  $min_price = request()->min_price;
        // if($min_price){
        //     $where[] = ['goods.min_price','>',$min_price];
        // }
        //  $max_price = request()->max_price;
        // if($max_price){
        //     $where[] = ['goods.max_price','=',$max_price];
        // }

        $pageSize = config('app.pageSize');
        DB::connection()->enableQueryLog();
        $goods = Goods::select('goods.*','cate_name','brand_name')
                        ->leftjoin('cate','goods.cate_id','=','cate.cate_id')
                        ->leftjoin('brand','goods.brand_id','=','brand.brand_id')
                        ->where($where)
                        ->OrderBy('goods_id','desc')
                        ->paginate($pageSize);
        //dd($goods);

        //$logs = DB::getQueryLog();
        //dump($logs);
                        
         // return view('admin.goods.index',['goods'=>$goods,'name'=>$name,'cate'=>$cate,'cate_id'=>$cate_id]);
        return view('admin.goods.index',compact('goods','name','cate','cate_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = Cate::all();
        $cate = CreateTree($cate);
        $brand = Brand::select('brand_id','brand_name')->get();
        //dd($brand);
        return view('admin.goods.create',['cate'=>$cate,'brand'=>$brand]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoodsPost $request)
    {


        //  $validatedData = $request->validate([
        //     'goods_name' => 'bail|required|unique:goods',
        //     'goods_price' => 'required',
        //     //'goods_nubmer' => 'required',
        // ],[
        //     'goods_name.required'=>'商品名称必填',
        //     'goods_name.unique'=>'商品名称已存在',
        //     'goods_price.required'=>'商品价格必填',
        //     //'goods_nubmer.required'=>'商品库存必填',
        // ]);

        $post = $request->except('_token');
        //dd($post);
        //文件上传
        if($request->hasFile('goods_img')){
            $img = $this->upload('goods_img');
            //dd($img);
            $post['goods_img'] = upload('goods_img');
        }
        //dd($post);

        //多文件上传
        if(isset($post['goods_imgs'])){
            $post['goods_imgs'] = Moreupload('goods_imgs');
            $post['goods_imgs'] = implode('|',$post['goods_imgs']);
        }

        $res = Goods::insert($post);
        if($res){
            return redirect('/goods');
        }
    }


    //文件上传
    public function upload($filename){
        // echo $filename;
        // dd(request()->file($filename)->isValid());
        if(request()->file($filename)->isValid()){
            $file = request()->$filename;
            //dd($file);
            $path = request()->$filename->store('uploads');
            return $path;
        }

        exit('文件上传有误');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Goods::find($id);
        $cate = Cate::all();
        $cate = CreateTree($cate);
        $brand = Brand::select('brand_id','brand_name')->get();

        return view('admin.goods.edit',['data'=>$data,'cate'=>$cate,'brand'=>$brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGoodsPost $request, $id)
    {
        
        //  $validatedData = $request->validate([
        //     'goods_name' => 'bail|required|unique:goods',
        //     'goods_price' => 'required',
        //     //'goods_nubmer' => 'required',
        // ],[
        //     'goods_name.required'=>'商品名称必填',
        //     'goods_name.unique'=>'商品名称已存在',
        //     'goods_price.required'=>'商品价格必填',
        //     //'goods_nubmer.required'=>'商品库存必填',
        // ]);

         $post = $request->except('_token');
        //dd($post);
          //文件上传
        if($request->hasFile('goods_img')){
            $img = upload('goods_img');
            //dd($img);
            $post['goods_img'] = upload('goods_img');
        }
        //dd($post);

        //多文件上传
        if(isset($post['goods_imgs'])){
            $post['goods_imgs'] = Moreupload('goods_imgs');
            $post['goods_imgs'] = implode('|',$post['goods_imgs']);
        }

        $res = Goods::where('goods_id',$id)->update($post);
        if($res!==false){
            return redirect('/goods');
        }
    }

    



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $res = Goods::destroy($id);
        // if($res){
        //     return redirect('/goods');
        // }

        //ajax删除
        //echo $id;
        $res = Goods::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'删除成功!']);die;
        }
    }

    public function checkName(){
        $goods_name = request()->goods_name;
        // echo $goods_name;
        $count = Goods::where('goods_name',$goods_name)->count();
        echo $count;
    }

}
