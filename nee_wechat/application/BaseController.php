<?php

namespace app;

use think\Controller;
use think\Request;
use check;


class BaseController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $check = new check;
        $this->access_token = $check->access_token;
    }
}
