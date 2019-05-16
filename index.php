<?php 
header('Content-Type:text/html;charset=utf-8');
require_once 'helpers/helper.php';
require_once 'extend/check.php';

// $appid = 'wx2ca1b4d674248dbd';
// $AppSecret = 'b7cfe3b30a50baa9564900fbf297aedd';
// $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$addid."&secret=".$AppSecret;
// $res = file_get_contents($url);


/**
 * 
 */
define("TOKEN","wallemak");

$WeChatObj = new WeChat();
if(isset($_GET['echostr'])){
	$WeChatObj->valid();
}else{
 	$WeChatObj->responseMsg();
}
class WeChat
{

	public function __construct()
	{
		$check = new check;
		$this->access_token = $check->access_token;
	}

	public function valid()
	{
		$echostr = $_GET['echostr'];
		if($this->checkSignature()){
			echo $echostr;
			exit;
		}
	}
	//验证signature(微信加密签名)
	protected function checkSignature()
	{
		$token =TOKEN;
		$signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		if($tmpStr == $signature){
			return true;
		}else{
			return false;
		}
	}

	public function responseMsg()
	{
		$postdata = isset($GLOBALS['HTTP_RAW_POST_DATA'])?$GLOBALS['HTTP_RAW_POST_DATA']:file_get_contents("php://input");
		if(!empty($postdata)){
			$postObj = simplexml_load_string($postdata, 'SimpleXMLElement', LIBXML_NOCDATA);
			// $this->FromUserName = $postObj->FromUserName;//发送方ID
			// $this->ToUserName = $postObj->ToUserName;//接收方ID
			$this->tidings = trim($postObj->Content);//用户发送的信息;
			$this->sendTime = time();//发送时间;
			$MsgType = $postObj->MsgType;//消息类型;

			if($MsgType == 'event') //微信响应事件;
			{
				// $MsgEvent = $postObj->Event;//获取事件类型
				if($postObj->Event == 'subscribe') 
				{
					//订阅
					$content = '终于等到你...';
					// echo $this->transmitText($postObj,$content);
					echo $this->Welcome($postObj);
				}

				if($postObj->Event == 'unsubscribe') 
				{
					//取消订阅
				}

				if($postObj->Event == 'CLICK') 
				{
					//点击
					switch (true) {
						case ($postObj->EventKey == '联系方式'):
							$content = "电话:13679524949\n微信:495179726";
							echo $this->transmitText($postObj,$content);							
						break;
					}
				}

			}

			if($MsgType == 'voice')
			{
				$MediaId = $postObj->MediaId;
				$url = "http://api.weixin.qq.com/cgi-bin/media/voice/queryrecoresultfortext?access_token=$this->access_token&voice_id=MediaId&lang=zh_CN"
				$result = curl()->result($url);
				$res = json_decode($result,true)['result'];
				echo $this->transmitText($postObj,$res);
			}

		}
	}

	//回复文本消息
    private function transmitText($postObj,$content)
    {
        if (!isset($content) || empty($content)){
            return "";
        }

        $xmlTpl = "<xml>
		  <ToUserName><![CDATA[%s]]></ToUserName>
		  <FromUserName><![CDATA[%s]]></FromUserName>
		  <CreateTime>%s</CreateTime>
		  <MsgType><![CDATA[text]]></MsgType>
		  <Content><![CDATA[%s]]></Content>
		</xml>";
        $result = sprintf($xmlTpl, $postObj->FromUserName, $postObj->ToUserName, time(), $content);

        return $result;
    }

    private function Welcome($postObj)
    {
    	$xml = "<xml>
			<ToUserName><![CDATA[%s]]></ToUserName>
			<FromUserName><![CDATA[%s]]></FromUserName>
			<CreateTime>%s</CreateTime>
			<MsgType><![CDATA[image]]></MsgType>
			<Image>
			<MediaId><![CDATA[0wlf-ct1DSryFJ2eyA0lzPspJ9o166Td58YduHKy-oU]]></MediaId>
			</Image>
		</xml>";
		$result = sprintf($xml, $postObj->FromUserName, $postObj->ToUserName, time() );
		return $result;
    }


}


?>