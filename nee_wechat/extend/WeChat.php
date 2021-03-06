<?php

class WeChat
{
	const TOKEN = 'wallemak';
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
				echo $this->transmitText($postObj,$postObj->Recognition);
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

