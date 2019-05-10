<?php

$appid = 'wx2ca1b4d674248dbd';
$AppSecret = 'b7cfe3b30a50baa9564900fbf297aedd';

$res = json_decode(file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$AppSecret"),true);
$access_token = $res['access_token'];

$url = "https://api.weixin.qq.com/cgi-bin/template/api_set_industry?access_token=$access_token";
$data = [
	'industry_id1'=>1,
	'industry_id2'=>2
];

$json = '{"industry_id1":"2","industry_id2":"1"}';

// echo $json;
// 
$post_data = http_build_query($data);
// $url = $url.'&'.$post_data;
$ch = curl_init();
curl_setopt($ch,CURLOPT_TIMEOUT,60);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
// curl_setopt($ch, CURLOPT_HTTPHEADER, $data);
curl_setopt($ch,CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS,$json);
$res = curl_exec($ch);
var_dump($res);


