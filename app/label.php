<?php
header("Content-Type: text/html;charset=utf-8");
require_once  '../extend/check.php';
require_once  '../helpers/helper.php';
/**
 * 标签管理
 */
class label 
{
	
	function __construct()
	{
		$check = new check;
		$this->access_token = $check->access_token;
	}

//设置标签
	public function SetLabel($name)
	{
		$data = [
			"tag"=>[
				"name"=>$name
			],
		];
		$data = json_encode($data,JSON_UNESCAPED_UNICODE);

		$url = "https://api.weixin.qq.com/cgi-bin/tags/create?access_token=$this->access_token";
		$res = curl()->result($url,$data);
		return $res;
	}

//获取标签列表
	public function GetLabel()
	{
		$res = file_get_contents("https://api.weixin.qq.com/cgi-bin/tags/get?access_token=$this->access_token");
		return $res;
	}
//删除标签
	public function DelLabel($id)
	{
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
	public function EditLabel($id,$name)
	{
		$data = [
			"tag"=>[
				"id"=>$id,
				"name"=>$name
			],
		];
		$data = json_encode($data,JSON_UNESCAPED_UNICODE);
		$url = "https://api.weixin.qq.com/cgi-bin/tags/update?access_token=$this->access_token";
		$res = curl()->result($url,$data);
		return $res;
	}

//获取标签粉丝列表,openid 为从哪个用户开始拉取
	public function GetFans($id,$openid='')
	{
		$data = [
			"tagid"=>$id,
			"next_openid"=>$openid
		];
		$data = json_encode($data,JSON_UNESCAPED_UNICODE);
		$url = "https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token=$this->access_token";
		$res = curl()->result($url,$data);
		return $res;
	}

//为用户打标签
	public function SetUserlabel($list,$id)
	{
		$data = [
			"openid_list"=>$list,
			"tagid"=>$id
		];
		$data = json_encode($data,JSON_UNESCAPED_UNICODE);
		$url = "https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token=$this->access_token";
		$res = curl()->result($url,$data);
		return $res;
	}

//获取用户列表
	public function GetUserlist($openid='')
	{
		$res = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token=$this->access_token&next_openid=$openid");
		return $res;
	}
}

$label = new label;
$list = ['okmP75wNvUsU2-uNfLCaT9-LB3gM'];
$arr = $label->SetUserlabel($list,102);
echo $arr;
$json = [
	"button"=>[
		[
			"name"=>"功能演示",
			"sub_button"=>[
				[
					"type"=>"view",
					"name"=>"模板推送",
					"url"=>"http://47.106.227.171/auth.php"
				]
			]
		],
		[
			"name"=>"项目展示",
			"sub_button"=>[
				[
					"type"=>"click",
					"name"=>"现在什么都还没有",
					"key"=>"现在什么都还没有" 
				]
			]
		],
		[
			"name"=>"个性化菜单",
			"sub_button"=>[
				[
					"type"=>"click",
					"name"=>"联系方式",
					"key"=>"联系方式"
				]

			]
		]
	],
	"matchrule"=>[
		"tag_id"=>102
	]
];
$access_token = new check;
$access_token = $access_token->access_token;

// $json = json_encode($json,JSON_UNESCAPED_UNICODE);
// $url = "https://api.weixin.qq.com/cgi-bin/menu/addconditional?access_token=$access_token";
// $res = curl()->result($url,$json);
/*

/*()
删除个性化菜单:
$data = [
	"menuid"=>"525274375",
];
$data = json_encode($data,JSON_UNESCAPED_UNICODE);
$url = "https://api.weixin.qq.com/cgi-bin/menu/delconditional?access_token=$access_token";
$res = curl()->result($url,$data);
**/

// 
// 
// echo $res;


