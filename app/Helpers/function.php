<?php 
	//上传文件的方法
    function upload($filename){
        // echo $filename;
        // dd(request()->file($filename)->isValid());
        if (request()->file($filename)->isValid()){
            $file = request()->$filename;
            //dd($file);
            $path = request()->$filename->store('uploads');
            return $path;
        }
        return "文件上传有误";
    }


    //多文件上传
    function Moreupload($filename){
        $files = request()->$filename;

        if(!count($files)){
            return;
        }
        foreach ($files as $k => $v) {
            $path[] = $v->store('uploads');
        }
        return $path;
    }


    //无限极分类
    function CreateTree($cate,$parent_id=0,$level=0){
        if(!$cate) return;

        static $newArray = [];
        foreach ($cate as $k => $v) {
           if($v->parent_id==$parent_id){
                $v->level = $level;
                $newArray[] = $v;

                CreateTree($cate,$v->cate_id,$level+1);
           }    
        }
        return  $newArray;
    }
		

 ?>