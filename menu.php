<?php

$appid = "wx2ca1b4d674248dbd";
$appsecret = "b7cfe3b30a50baa9564900fbf297aedd";
$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$appsecret";

$output = https_request($url);
$jsoninfo = json_decode($output, true);

$access_token = $jsoninfo["access_token"];


$jsonmenu = '{
      "button":[
      {
        "name":"功能演示",
        "sub_button":[
        {
           "type":"view",
           "name":"模板推送",
           "url":"http://47.106.227.171/auth.php"
        }]
    },
    {
      "name":"项目展示",
      "sub_button":[
        {
          "type":"click",
          "name":"现在什么都还没有",
          "key":"现在什么都还没有" 
        }
      ]
    },
    {
      "name":"关于我",
      "sub_button":[
      {
        "type":"click",
        "name":"联系方式",
        "key":"联系方式"
      }]
    }]
 }';


$url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$access_token;
$result = https_request($url, $jsonmenu);
var_dump($result);

function https_request($url,$data = null){
    $curl = curl_init();
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

?>