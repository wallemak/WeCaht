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
            'noncestr'=>$noncestr,
            'jsapi_ticket'=>$this->ticket,
            'timestamp'=>$time,
            'url'=>Request::param('url'),
        ];
        asort($json);
        // $json = json_encode($json,JSON_UNESCAPED_UNICODE);
        $json = http_build_query($json);
        $signature = sha1($json);
        $data = [
            'time' => $time,
            'noncestr' => $noncestr,
            'signature' => $signature,
            'url' => Request::param('url')
        ];
        return jsonp($data);
    }
}
