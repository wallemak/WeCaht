<?php 
header("content-type:text/html;charset=utf-8");

$appid = 'wx2ca1b4d674248dbd';
$AppSecret = 'b7cfe3b30a50baa9564900fbf297aedd';
// 
if(!isset($_GET['code'])){
	echo 'NO CODE';
	exit();
}
$url = urldecode($_GET['send_url']);
$code = $_GET['code'];
$arr = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$AppSecret&code=$code&grant_type=authorization_code");
$arr = json_decode($arr,true);
$access_token = $arr['access_token'];
$userInfo = json_decode(file_get_contents("https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=OPENID&lang=zh_CN"),true);
$openid = $userInfo['openid'];
print_r($userInfo);
$dbms = 'mysql';
$host = '47.106.227.171';
$dbName = 'weixin';
$user = 'root';
$pass = '1231230';
$dsn="$dbms:host=$host;dbname=$dbName";

$data = [
'openid'=>$userInfo['openid'],
'nickname'=>$userInfo['nickname'],
'sex'=>$userInfo['sex'],
'province'=>$userInfo['province'],
'city'=>$userInfo['city'],
'country'=>$userInfo['country'],
'headimgurl'=>$userInfo['headimgurl']
];

try
{
	$db = new PDO($dsn,$user,$pass);

	$sql = "DELETE FROM weixin_user WHERE `openid` = '$openid'";
	$res = $db->query($sql);

	$sql = "INSERT INTO user";
	$sql.="(`".implode('`,`',array_keys($data))."`)VALUES";  
	$sql.="('".implode("','",$data)."')";
	$db->query($sql);

	$url .= "?openid=$openid";
	// $url = "http://47.106.227.171/views/form.html?openid=$openid";
	// header("Location:".$url);

}catch(PDOException $e)
{
	die ("Error!: " . $e->getMessage() . "<br/>");
}

?>