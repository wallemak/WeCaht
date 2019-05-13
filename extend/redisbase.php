<?php
class redisbase 
{
	public $pass = '123456';


	public function __construct()
	{
		# code...
		$this->db = new redis();
		$this->db->connect('127.0.0.1', 6379);
		$this->db->auth($this->pass);
	}

	public function set($key,$value,$time=86400)
	{
		$res = $this->db->setex($key,$time,$value);
		if($res){
			return true;
		}else{
			return false;
		}
	}

	public function get($key)
	{

		$res = $this->db->get($key);
		return $res;
	}
}

