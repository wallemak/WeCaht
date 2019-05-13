<?php
// use extend\Test;
require_once '../extend/database.php';
require_once '../extend/redisbase.php';




if(!function_exists('db'))
{
	function db()
	{
		return new database;
	}
}


if(!function_exists('redis'))
{
	function redis()
	{
		return new redisbase;
	}
}


// $calssArr = [
// 	'test'=>__DIR__.'\..\extend\Test.php',
// ];
// function load($class)
// {
// 	foreach($calssArr as $key=>$value){
// 		class_alias($calssArr[$value],$key);
// 	}
	
// 	// require  __DIR__."\\..\\{$class}.php";
// }
// spl_autoload_register('load',true,true);

// $test = new extend\Test;