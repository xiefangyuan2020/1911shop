<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Article;

use App\Http\Requests\StoreArticlePost;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ROM操作
        $article = Article::all();
        $article = $this->ArticleTree($article);

        //搜索
        $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['article_name','like',"%$name%"];
        }


        //根据商品分类搜索
        $class_id = request()->class_id;
        if($class_id){
            $where[] = ['class_id','=',$class_id];
        }
        $pageSize = config('app.pageSize');
        $article = Article::select('article.*','article_name')
                            ->OrderBy('article_id','desc')
                            ->paginate($pageSize);

        return view('admin.article.index',['article'=>$article,'name'=>$name,'class_id'=>$class_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //读取文章分类
        $article = article::all();
        //dd($article);
        $article = $this->ArticleTree($article);
        return view('admin.article.create',['article'=>$article]);
    }

    //无限极分类
    public function ArticleTree($article,$class_id=0,$level=0){
        if(!$article) return;

        static $newArray = [];
        foreach ($article as $k => $v) {
            if ($v->class_id==$class_id) {
                $v->level = $level;
                $newArray[] = $v;
                $this->ArticleTree($article,$v->article_id,$level+1);
            }
        }
        return $newArray;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticlePost $request)
    {
        $post = $request->except('_token');
        $post['article_time'] = time();

        //处理上传文件
        if($request->hasFile('article_img')){
            //$img = $this->upload('article_img');
            //入库
            $post['article_img'] = $this->upload('article_img');
        }

        $res = article::insert($post);
        //dd($res);
        if($res){
            return redirect('/article');
        }
    }

    //上传文件的方法
    public function upload($filename){
        //echo $filename;
        //dd(request()->file($filename)->isValid());
        if(request()->file($filename)->isValid()){
            $file = request()->$filename;
            //dd($file);
            $path = request()->$filename->store('uploads');
            return $path;
        }
        return "文件上传有误";
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
        $article = Article::get();
        $article = $this->ArticleTree($article);

        $data = Article::find($id);
        //dd($data);
        return view("admin.article.edit",['data'=>$data,'article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticlePost $request, $id)
    {
        $post = $request ->except('_token');
        $post['article_time'] = time();
        //文件上传(判断文件在请求中是否存在：)
        if ($request->hasFile('article_img')) {
            $post['article_img'] = $this ->upload('article_img');
        }
        $res = Article::where('article_id',$id) ->update($post);
        if($res!==false){
            return redirect('/article');
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
        $res = Article::destroy($id);
        if($res){
            return redirect("/article");
        }
    }
}
