(function ()
{
	var reg = new RegExp("(^|&)openid=([^&]*)(&|$)");
	var search = window.location.search.substr(1).match(reg);
	var openid = search==null?null : unescape(search[2]);
	// var openid = 'okmP75wNvUsU2-uNfLCaT9-LB3gM';

	$.get("http://47.106.227.171/views/form.ajax.php",{openid:openid,type:'GetUserinfo'},function(data,status){

		new Vue({ el:'#headimgurl',data:{data} });
		$('#hid').attr('value',data.openid);
	},'json');
	var url = document.location.href;
	$.ajax({
		url:"http://47.106.227.171:81/wc/wx_sdk?url="+url,
		type:'GET',
		dataType:"jsonp",
		success:function(data)
		{
			console.log(data);
			wx.config({
			    debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
			    appId: 'wx2ca1b4d674248dbd', // 必填，公众号的唯一标识
			    timestamp: data.time , // 必填，生成签名的时间戳
			    nonceStr: data.noncestr, // 必填，生成签名的随机串
			    signature: data.signature,// 必填，签名
			    jsApiList: [
			    	'updateTimelineShareData',//自定义“分享到朋友圈”及“分享到QQ空间”按钮的分享内容
			    	'updateAppMessageShareData'//自定义“分享给朋友”及“分享到QQ”按钮的分享内容
			    ] // 必填，需要使用的JS接口列表
			});


		}
	});

	// $.get("http://192.168.131.1/mak/weixin/views/form.ajax.php",{openid:openid,type:'GetUserinfo'},function(data,status){
	// 	new Vue({ el:'#headimgurl',data:{data} });
	// 	$('#hid').attr('value',data.openid);
	// },'json');

	$('#mysubmit').on({
		click:function()
		{
			var content = $('#content').val();
			$.post("http://47.106.227.171/views/form.ajax.php",{openid:openid,content:content,type:'submit'},function(data,status){
				if(data.errmsg == 'ok'){
					alert('推送成功');
				}
			},'json');
		}
	});

})();