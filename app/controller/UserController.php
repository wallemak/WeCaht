<?php
namespace app\controller;


class UserController
{
	public function search_user()
	{
		$data = isset($GLOBALS['HTTP_RAW_POST_DATA'])?$GLOBALS['HTTP_RAW_POST_DATA']:file_get_contents("php://input");
		var_dump($data);die;
	}
}


