<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\admin;
use App\Http\Requests\StoreAdminPost;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageSize = config('app.pageSize');
        $admin = Admin::orderBy('admin_id','desc')->paginate($pageSize);
        //dd($admin);
        return view('admin.admin.index',['admin'=>$admin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.admin.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminPost $request)
    {
        $post = $request->except('_token','admin_pwds');
        $post['admin_pwd'] = encrypt($post['admin_pwd']);
        $post['admin_time'] = time();
        // dump($post);
        // dd($post);
        //文件上传              字段名字
        if ($request->hasFile('admin_img')) {
            //$img = $this->upload('admin_img');
            //入库
            $post['admin_img'] = upload('admin_img');
        }
        //dd($post);
    
        $res = Admin::insert($post);

        if($res){
            return redirect('/admin');
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
        //echo $id;
        $data = Admin::find($id);
        return view('admin.admin.edit',['data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdminPost $request, $id)
    {
        $post = $request->except('_token','admin_pwds');
        //dd($post);
        $post["admin_pwd"]=encrypt($post["admin_pwd"]);
        $post["admin_time"]=time();
        if ($request->hasFile('admin_img')) {
            //$img = $this->upload('admin_img');
            //入库
            $post['admin_img'] = upload('admin_img');
        }

        $res=Admin::where("admin_id",$id)->update($post);
        if($res!==false){
            return redirect("/admin");
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
        //echo $id;
        $res = Admin::destroy($id);
        if($res){
            return redirect("/admin");
        }
    }


    public function checkName(){
        $admin_name = request()->admin_name;
        // echo $admin_name;
        $count = Goods::where('admin_name',$admin_name)->count();
        echo $count;
    }

}


