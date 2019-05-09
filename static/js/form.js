(function ()
{
	var reg = new RegExp("(^|&)openid=([^&]*)(&|$)");
	var search = window.location.search.substr(1).match(reg);
	var openid = search==null?null : unescape(search[2]);

	$.get("http://47.106.227.171/routes/route.php",{id:123},function(data){
		console.log(data);
	},'jsonp');
})();