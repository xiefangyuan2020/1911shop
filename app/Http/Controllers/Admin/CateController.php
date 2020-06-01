<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Cate;

class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$cate = DB::table('cate')->get();
        //dd($cate);

        //ROM操作
        $cate = Cate::all();

        $cate = CreateTree($cate);
        return view('admin.cate.index',['cate'=>$cate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //读取父级分类
        $cate = DB::table('cate')->get();
        //dump($cate);
        //dd($cate);
        $cate = CreateTree($cate);
        //dd($cate);
        return view('admin.cate.create',['cate'=>$cate]);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cate_name' => 'bail|required|unique:cate',
            'cate_desc' => 'required',
        ],[
            'cate_name.required'=>'分类名称必填',
            'cate_name.unique'=>'分类名称已存在',
            'cate_desc.required'=>'分类内容必填',
        ]);
        $post = $request->except('_token');
        //dd($post);
        //$res = DB::table('cate')->insert($post);

        //ROM操作 添加的方法
        //$res = cate::insert($post);

        $res = cate::create($post);

        //dd($res);
        if($res){
            return redirect('/cate');
        }
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
        //查询无限极分类
        $cate = DB::table('cate')->get();
        //调用无限极分类
        $cate = $this->CreateTree($cate);
        //根基id获取一条记录
        //$data = DB::table('cate')->where('cate_id',$id)->first();

        //ROM操作 
        $data = Cate::find($id);

        //dd($data);
        return view('admin.cate.edit',['data'=>$data,'cate'=>$cate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'cate_name' => 'bail|required|unique:cate',
            'cate_desc' => 'required',
        ],[
            'cate_name.required'=>'分类名称必填',
            'cate_name.unique'=>'分类名称已存在',
            'cate_desc.required'=>'分类内容必填',
        ]);
        $post = $request->except('_token');
        // dump($post);
        // dd($id);
        //$res = DB::table('cate')->where('cate_id',$id)->update($post);

        //ORM操作  编辑第二种方法
        $res = Cate::where('cate_id',$id)->update($post);

        if($res!==false){
            return redirect('/cate');
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
        $res = DB::table('cate')->where('cate_id',$id)->delete();
        //dd($res);
        if($res){
            return redirect('/cate');
        }
    }
}
