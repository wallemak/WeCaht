<?php

namespace app\wc\controller;

use think\Controller;
use app\BaseController;
// use think\Request;
use think\facade\Request;
use think\DB;

/**
 * 标签管理
 * @param name 标签名称
 * @param id 标签id
 * 
 */


class LabelController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

//设置标签
    public function SetLabel()
    {
        $name = Request::only(['name'])['name'];
        $data = [
            "tag"=>[
                "name"=>$name
            ]
        ];
        $data = json_encode($data,JSON_UNESCAPED_UNICODE);
        $url = "https://api.weixin.qq.com/cgi-bin/tags/create?access_token=$this->access_token";
        $res = curl()->result($url,$data);
        return $res;
    }

//获取所有标签
    public function GetLabel()
    {
        $res = file_get_contents("https://api.weixin.qq.com/cgi-bin/tags/get?access_token=$this->access_token");
        return $res;
    }

//删除标签
    public function DelLabel()
    {
        $id = Request::only(['id'])['id'];
        $data = [
            "tag"=>[
                "id"=>$id
            ],
        ];
        $data = json_encode($data,JSON_UNESCAPED_UNICODE);
        $url = "https://api.weixin.qq.com/cgi-bin/tags/delete?access_token=$this->access_token";
        $res = curl()->result($url,$data);
        return $res;
    }

//修改标签
    public function EditLabel()
    {
        $request = Request::only(['id','name']);
        $data = [
            "tag"=>[
                "id"=>$request['id'],
                "name"=>$request['name']
            ],
        ];
        $data = json_encode($data,JSON_UNESCAPED_UNICODE);
        $url = "https://api.weixin.qq.com/cgi-bin/tags/update?access_token=$this->access_token";
        $res = curl()->result($url,$data);
        return $res;
    }

//获取标签粉丝列表,openid 为从哪个用户开始拉取
    public function GetFans()
    {
        $request = Request::only(['id','openid'=>'']);
        $data = [
            "tagid"=>$request['id'],
            "next_openid"=>$request['openid']
        ];
        $data = json_encode($data,JSON_UNESCAPED_UNICODE);
        $url = "https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=$this->access_token";
        $res = curl()->result($url,$data);
        return $res;
    }

//为用户打标签
    public function SetUserlabel()
    {
        $request = Request::only(['list','id']);
        $data = [
            "openid_list"=>$request['list'],
            "tagid"=>$request['id']
        ];
        $data = json_encode($data,JSON_UNESCAPED_UNICODE);
        $url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=$this->access_token";
        $res = curl()->result($url,$data);
        return $res;
    }

//获取用户列表
    public function GetUserlist()
    {
        $openid = Request::param('openid');
        $data = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token=$this->access_token&next_openid=$openid");
        $data = json_decode($data,true);
        $open_arr = $data['data']['openid'];
        $res = Db::name('user')->field('nickname,openid,headimgurl,sex')->where(['openid'=>$open_arr])->select();
        return jsonp($res);
    }


}
