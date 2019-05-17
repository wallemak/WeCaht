<?php
require_once 'extend/check.php';
require_once 'helpers/helper.php';

// $db = new database;


$token = new check;
$access_token = $token->access_token;
$data = [
	
];
$url = "https://api.weixin.qq.com/customservice/kfaccount/add?access_token=$access_token";

$res = curl()->result($utl);
echo $res;