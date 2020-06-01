<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreBrandPost;
use App\Brand;

use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request()->page??1;
        //echo $page;

        $brand_name = request()->brand_name;
       
        $brand = Cache::get('brand_'.$page.'_'.$brand_name);
        if(!$brand){
            //echo "DB==";

            $where = [];
            if($brand_name){
                $where[] = ['brand_name','like',"%$brand_name%"];
            }

            $pageSize = config('app.pageSize');
            //dd($pageSize);
            //$brand = DB::table('brand')->orderBy('brand_id','desc')->paginate($pageSize);
            //dd($brand);

            //ORM操作
            //$brand = Brand::orderBy('brand_id','desc')->paginate($pageSize);
            //ORM操作  封装方法
            $brand = Brand::getBrandIndex($pageSize,$where);
            //dd(request()->ajax());

            Cache::put('brand_'.$page.'_'.$brand_name,$brand,60);
        }

        //ajax分页
        if(request()->ajax()){
            return view('admin.brand.ajaxindex',['brand'=>$brand,'brand_name'=>$brand_name]);
        }

        return view('admin.brand.index',['brand'=>$brand,'brand_name'=>$brand_name]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面(展示form表)
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //第二种表单验证类
    public function store(StoreBrandPost $request)
    //第一种表单验证
    // public function store(Request $request)
    {
    //     $validatedData = $request->validate([
    //     'brand_name' => 'bail|required|unique:brand',
    //     'brand_url' => 'required',
    //     'brand_centent' => 'required',
    //],[
        // 'brand_name.required'=>'品牌名称必填',
        // 'brand_name.unique'=>'品牌名称已存在',
        // 'brand_url.required'=>'品牌网址必填',
        // 'brand_centent.required'=>'品牌内容不能为空',
    //]);

        $post = $request->except('_token');
        //dump($post);
        //dd($post);
        //文件上传              字段名字
        if ($request->hasFile('brand_img')) {
            //$img = $this->upload('brand_img');
            //入库
            $post['brand_img'] = upload('brand_img');
        }
        //dd($post);
        //$res = DB::table('brand')->insert($post);

        //ORM操作  第一种方法
        // $brand = new Brand();
        // $brand->brand_name = $post['brand_name'];
        // $brand->brand_url = $post['brand_url'];
        // $brand->brand_img = $post['brand_img'];
        // $brand->brand_centent = $post['brand_centent'];
        // $res = $brand->save();

        //ORM操作  第二种方法
        $res = Brand::insert($post);

        //ORM操作  第三种方法
        //$res = Brand::create($post);

        //dd($res);
        if($res){
            return redirect('/brand');
        }
    }

    

    /**
     * Display the specified resource.
     *后台预览详情页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *修改页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //echo $id;
        //根据id获取一条记录(资源)
        //$data = DB::table('brand')->where('brand_id',$id)->first();

        //ORM操作  第一种方法
        $data = Brand::find($id);

        //dd($data);
        return view('admin.brand.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改页面
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = $request->except('_token');
        // dump($post);
        // dd($id);

         //文件上传              字段名字
        if ($request->hasFile('brand_img')) {
            //$img = $this->upload('brand_img');
            //入库
            $post['brand_img'] = upload('brand_img');
        }

        //$res = DB::table('brand')->where('brand_id',$id)->update($post);

        //ORM操作  编辑第一种方法
        // $brand = Brand::find($id);
        // $brand->brand_name = $post['brand_name'];
        // $brand->brand_url = $post['brand_url'];
        // if(isset($post['brand_img'])){
        //     $brand->brand_img = $post['brand_img'];
        // }
        // $brand->brand_centent = $post['brand_centent'];
        // $res = $brand->save();

        //ORM操作  编辑第二种方法
        $res = Brand::where('brand_id',$id)->update($post);

        //dump($res);
        if($res!==false){
            return redirect('/brand');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$res = DB::table('brand')->where('brand_id',$id)->delete();

         //ORM操作  删除第一种方法
        // $res = Brand::destroy($id);

        // //dd($res);
        // if($res){
        //     return redirect('/brand');
        // }

        //echo $id;
        $res = Brand::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'删除成功!']);die;
        }

    }
}
