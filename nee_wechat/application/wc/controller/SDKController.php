<?php

namespace app\wc\controller;

use think\Controller;
use app\BaseController;
// use think\Request;
use think\facade\Request;
use think\DB;
class SDKController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $time = time();
        $noncestr = uniqid('nee');
        $json = [
            'jsapi_ticket'=>$this->ticket,
            'noncestr'=>$noncestr,
            'timestamp'=>$time,
            'url'=>Request::param('url'),
            // 'url'=>"https://www.baidu.com",
        ];
        // ksort($json);
        // $string = sprintf("jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s", $json['jsapi_ticket'], $json['noncestr'], $json['timestamp'], $json['url']);
        $json = $this->ASCII($json);
        $signature = sha1($json);
        $data = [
            'time' => $time,
            'noncestr' => $noncestr,
            'signature' => $signature,
            'url' => Request::param('url')
        ];
        return jsonp($data);
    }

    public function  ASCII($params = array())
    {
        if(!empty($params)){
           $p =  ksort($params);
           if($p){
               $str = '';
               foreach ($params as $k=>$val){
                   $str .= $k .'=' . $val . '&';
               }
               $strs = rtrim($str, '&');
               return $strs;
           }
        }
        return '参数错误';
    }
}
