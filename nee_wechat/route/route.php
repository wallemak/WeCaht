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
	Route::get('set_tem','wc/MsgtemplateController/set_tem');
	Route::get('get_tem','wc/MsgtemplateController/get_industry');
	Route::get('get_id','wc/MsgtemplateController/get_temId');
	Route::post('pub','wc/MsgtemplateController/pub_msg');
});