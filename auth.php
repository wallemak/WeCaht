<?php 
$appid = 'wx2ca1b4d674248dbd';
// $AppSecret = 'b7cfe3b30a50baa9564900fbf297aedd';
$redirect_uri = urlencode ( 'http://47.106.227.171/weixin/getUserInfo.php' );
$url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=$appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
header("Location:".$url);





?>