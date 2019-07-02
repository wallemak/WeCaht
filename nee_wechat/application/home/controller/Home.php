<?php

namespace app\home\controller;

use think\Controller;
use think\Request;
use think\DB;

class Home extends Controller
{

    public function __construct()
    {
        parent::__construct();

    }
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        return 'nee_wechat';
    }

    public function test() 
    {
        // $chars_str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // return substr($chars_str,rand(1,52)+1);
        // $res = DB::query("CALL ins(1000)");
        // $res = DB::name('test')->select();
        // var_dump($res);
        // for($i=0;$i<1000;$i++){
        //     DB::name('test')->insert(['number'=>$i,'name'=>substr(MD5(rand()),1,20)]);
           // static $insert_arr = [];
           // array_push($insert_arr,[$i,substr(MD5(rand()),1,20)]);
            
            // DB::query("CALL ins(1000,substr(MD5(rand()),1,20))");
        // }
        // var_dump($insert_arr);die;
        // $str = "a,b";
        // DB::query("CALL ins($str)");
        // 
        $file = fopen('test.txt','w+');
        $str = $this->ran_str(2000000);

        $i = 1;
        foreach($str as $value){
            if($i%2 ==0){
                fwrite($file,"\"".$value."\",".PHP_EOL);
            }else{
                fwrite($file,"\"".$value."\",");
            }
            $i++;
        }
        // var_dump($arr);
        // $sql = "INSERT INTO test (`name`,`number`) VALUES ";
        // foreach($str as $value){
        //     if($i%2 ==0){
        //         $sql .= ',\''.$value.'\'),';
        //     }else{
        //         $sql .='(\''.$value.'\'';
        //     }
        //     $i++;
        // }
        // $sql = rtrim($sql,',');
        $sql = $this->load_sql('test.txt','test',['name','number']);
        $con = mysqli_connect('127.0.0.1','root','123456','sc');
        mysqli_query($con,$sql);
        mysqli_close($con);
        // echo $sql;die;
        // 
        // 
   }

   public function load_sql($file_name,$table_name,$col_name = array(),$priority = 'local',$rep = 'ignore')
   {
        $sql = 'load data '.$priority.' infile \''.$file_name.'\' '.$rep.' into table '.$table_name;
        $sql.=" fields terminated by ','  enclosed by '\"' lines terminated by '\\r\\n' ";
        if(!empty($col_name)){
            $sql .='(';
            foreach($col_name as $value){
                $sql .= $value.',';
            }
            $sql = rtrim($sql,',');
            $sql.=')';
        }
        return $sql;

   }

   public function ran_str($count)
   {
        for($i=0;$i<$count;$i++){
            yield substr(MD5(rand()),1,20);
        }
   }

   public function tt()
   {
    var_dump(DB::name('test')->where('id',1000)->select());
   }

  
}

