<?php
class redisbase 
{
	public $host = "'127.0.0.1'";
	public $port = 6397;
	public $pass = '123456';


	public function __construct()
	{
		# code...
		$this->db = new redis();
		$this->db->connect('127.0.0.1', 6379); 
		// $this->db->connect($this->host, $this->port); 
		$this->db->auth($this->pass);
	}

	public function set()
	{

	}

	public function get($key)
	{

		$res = $this->db->get($key);
		return $res;
	}
}

