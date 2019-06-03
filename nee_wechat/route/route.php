<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------


Route::group('/',function(){
	Route::get('/','home/Home/index');
});
Route::group('wc',function(){
	//消息模板
	Route::get('set_tem','wc/MsgtemplateController/set_tem');
	Route::get('get_tem','wc/MsgtemplateController/get_industry');
	Route::get('get_id','wc/MsgtemplateController/get_temId');
	Route::post('pub','wc/MsgtemplateController/pub_msg');

	Route::get('add_service','wc/ServiceController/add_service');
	//标签
	Route::post('set_label','wc/LabelController/SetLabel');
	Route::post('del_label','wc/LabelController/DelLabel');
	Route::post('edit_label','wc/LabelController/EditLabel');
	Route::post('set_userlabel','wc/LabelController/SetUserlabel');
	Route::get('label_list','wc/LabelController/GetLabel');
	Route::get('fans_list','wc/LabelController/GetFans');
	Route::get('user_list','wc/LabelController/GetUserlist');
	//SDK
	Route::get('wx_sdk','wc/SDKController/index');



});