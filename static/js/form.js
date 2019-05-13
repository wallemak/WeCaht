(function ()
{
	var reg = new RegExp("(^|&)openid=([^&]*)(&|$)");
	var search = window.location.search.substr(1).match(reg);
	// var openid = search==null?null : unescape(search[2]);
	var openid = 'okmP75wNvUsU2-uNfLCaT9-LB3gM';

	$.get("http://47.106.227.171/views/form.ajax.php",{openid:openid,type:'GetUserinfo'},function(data,status){
		new Vue({ el:'#headimgurl',data:{data} });
		$('#hid').attr('value',data.openid);
	},'json');
	// 
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
						layer.open({
						title:'',
						content: '推送成功',
						btnAlign:'c',
						shade :0.5,
						anim: 5,
						closeBtn :0,
						yes:function(index,layero){
							layer.close(index);
							window.opener=null;
							window.open('','_self');
							window.close();
						}
					    });
					}else{
						layer.open({
						title:data.error,
						content: '天寿啦,出错啦~!',
						btnAlign:'c',
						shade :0.5,
						anim: 5,
						closeBtn :0
					    });
				}
			},'json');
		}
	});

})();