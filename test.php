<?php
require_once 'helpers/helper.php';
require_once 'extend/database.php';
require_once 'extend/redisbase.php';

// $db = new database;

$redis = new redisbase;

echo $redis->get('name');