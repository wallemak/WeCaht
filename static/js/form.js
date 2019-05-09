(function ()
{
	var reg = new RegExp("(^|&)openid=([^&]*)(&|$)");
	var search = window.location.search.substr(1).match(reg);
	var openid = search==null?null : unescape(search[2]);

	$.get("http://47.106.227.171/views/form.ajax.php",{id:123},function(data){
		console.log(data);
	},'json');

})();