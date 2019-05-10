<?php
header("Access-Control-Allow-Origin:*");


switch (true) 
{
	case $REQUEST['type']=='GetUserinfo':
		GetUserinfo();
	break;
	
	case $REQUEST['type']=='submit':
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
		$sql = "SELECT * FROM user WHERE `openid` = '$openid'";
		$res = $db->query($sql)->fetch(PDO::FETCH_ASSOC);
		echo json_encode($res);
	}catch(PDOException $e)
	{

	}

}

function submit()
{

	
}


