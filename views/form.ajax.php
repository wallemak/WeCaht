<?php
header("Access-Control-Allow-Origin:*");
require_once '../app/msgtemplate.php';

switch (true) 
{
	case $_REQUEST['type']=='GetUserinfo':
		GetUserinfo();
	break;
	
	case $_REQUEST['type']=='submit':
		submit();
	break;
}


function GetUserinfo()
{
	$openid = $_REQUEST['openid'];

	$dbms = 'mysql';
	$host = '47.106.227.171';
	$dbName = 'weixin';
	$user = 'root';
	$pass = '1231230';
	$dsn="$dbms:host=$host;dbname=$dbName";
	try
	{
		$db = new PDO($dsn,$user,$pass);
		$sql = "SELECT * FROM weixin_user WHERE `openid` = '$openid'";
		$res = $db->query($sql)->fetch(PDO::FETCH_ASSOC);
		echo json_encode($res);
	}catch(PDOException $e)
	{

	}

}

function submit()
{
	$openid = $_REQUEST['openid'];
	$content = $_REQUEST['content'];
	$tem = new msgtemplate;
	$res = $tem->pub_msg($openid,$content);
	echo $res;
}


