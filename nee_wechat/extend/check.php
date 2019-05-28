<?php

class check
{

	public function __construct()
	{
		$this->access_token = $this->check_token();
	}

	public function check_token()
	{
		$access_token = redis()->get('access_token');
		if(!$access_token)
		{
			$appid = 'wx2ca1b4d674248dbd';
			$AppSecret = 'b7cfe3b30a50baa9564900fbf297aedd';
			$res = json_decode(file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$AppSecret"),true);
			$access_token = $res['access_token'];
			redis()->set('access_token',$access_token,5400);
		}
		return $access_token;
	}
	

}

