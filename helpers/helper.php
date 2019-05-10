<?php
// use extend\Test;
require __DIR__.'\..\extend\Test.php';
require __DIR__.'\..\extend\database.php';



if(!function_exists('test'))
{
	function test()
	{
		return new extend\Test;
	}
}


if(!function_exists('db'))
{
	function db()
	{
		return new database;
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