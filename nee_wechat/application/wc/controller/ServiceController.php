<?php

namespace app\wc\controller;

use think\Controller;
use app\BaseController;
// use think\Request;
use think\facade\Request;
use think\DB;


/**
* @param access_token       调用接口凭证
* @param kf_account         完整客服账号，格式为：账号前缀@公众号微信号
* @param kf_nick            客服昵称
* @param kf_id              客服工号
* @param nickname           客服昵称，最长6个汉字或12个英文字符
* @param password           客服账号登录密码，格式为密码明文的32位加密MD5值。该密码仅用于在公众平台官网的多客服功能中使用，若不使用多客服功能，则不必设置密码
* @param media              该参数仅在设置客服头像时出现，必须form-data中媒体文件标识，有filename、filelength、content-type等信息
 * 
 */


class ServiceController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_service()
    {
        $url = "https://api.weixin.qq.com/customservice/kfaccount/add?access_token=$this->access_token";
        $data = [
            "kf_account" => "nee_cs@gh_c7a0564b9fc1",
            "nickname" => "test",
            "password" => "5f4dcc3b5aa765d61d8327deb882cf99",
        ];
        $data = json_encode($data,JSON_UNESCAPED_UNICODE);
        $res = curl()->result($url,$data);
        // $url = "https://api.weixin.qq.com/cgi-bin/customservice/getonlinekflist?access_token=$this->access_token";
        // $res = file_get_contents($url);
        return $res;
    }
}
