<?php

namespace app\wc\controller;

use think\Controller;
use app\BaseController;
// use think\Request;
use think\facade\Request;

class MsgtemplateController extends BaseController
{
   public function __construct()
   {
        parent::__construct();
   }

   public function set_tem()
   {

   }

   //获取设置的行业信息
   public function get_industry()
   {
        $result = file_get_contents("https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=$this->access_token");
        return $result;
   }

   //获取行业模板id
   public function get_temId()
   {
        $url = "https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=$this->access_token";
        $result = curl()->result($url);

        return $result;

   }

   public function GetTemList()
    {
        $result = file_get_contents("https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=$this->access_token");
        return $result;
    }


    public function pub_msg()
    {
      $data = Request::only(['openid','content'],'post');
      $openid = $data['openid'];
      $content = $data['content'];
      $time = date('Y-m-d H:m:i',time());
      $json = [
          "touser"=>$openid,
          "template_id"=>"LjaOq8zl-L-qy2uQqwRocVLXwjClCkPQcn-c28If82c",
          "url"=>"http://www.baidu.com",
          "data"=>[
              "first"=>[
                  "value"=>"推送成功",
              ],
              "content"=>[
                  "value"=>$content,
              ],
              "time"=>[
                  "value"=>$time,
              ]
          ],
      ];
      $json = json_encode($json);
      $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=$this->access_token";
      $result = $this->https_request($url,$json);
      return $result;
    }




}
