<?php
header("Access-Control-Allow-Origin:*");

$request = $_REQUEST;
echo json_encode($request);
