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

  
}

