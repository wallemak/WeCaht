<?php
date_default_timezone_set('PRC'); 
require_once  '../extend/check.php';

class msgtemplate
{
	public function __construct()
	{
		$check = new check;
		$this->access_token = $check->access_token;
	}


	//设置模板:
	public function set_tem($id1,$id2)
	{
		$url = "https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=$this->access_token";
		// $json = '{"industry_id1":"2","industry_id2":"1"}';
		$json = [
			"industry_id1"=>$id1,
			"industry_id2"=>$id2
		];
		$json = json_encode($json);
		
		$result = $this->https_request($url,$json);
		return $result;
	}


	//获取设置的行业信息
	public function get_industry()
	{
		$result = file_get_contents("https://api.weixin.qq.com/cgi-bin/template/get_industry?access_token=$this->access_token");
		return $result;

	}

	public function get_temId()
	{
		$url = "https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=$this->access_token";
		$result = $this->https_request($url);
		return $result;
	}

	public function https_request($url,$data = null){
	    $curl = curl_init();
	    curl_setopt($curl,CURLOPT_TIMEOUT,60);
	    curl_setopt($curl, CURLOPT_URL, $url);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
	    if (!empty($data)){
	        curl_setopt($curl, CURLOPT_POST, 1);
	        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	    }
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	    $output = curl_exec($curl);
	    curl_close($curl);
	    return $output;

	}

	public function pub_msg($openid,$content)
	{
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

	public function GetTemList()
	{
		$result = file_get_contents("https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token=$this->access_token");
		return $result;
	}
}