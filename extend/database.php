<?php
class database
{
	public $dbms = 'mysql';
	public $host = '47.106.227.171';
	public $dbName = 'weixin';
	public $user = 'root';
	public $pass = '1231230';

	public function __construct()
	{
		$this->dsn="$this->dbms:host=$this->host;dbname=$this->dbName";
		$this->pdo_connect();
	}

	public function pdo_connect()
	{
		try{
			$this->db = new PDO($this->dsn,$this->user,$this->pass);
		} catch(PDOException $e){

		}
	}



	public function search($sql)
	{
		$data = $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
		$json = json_encode('{}');
		$json->data = $data;
		$json->count = count($data);
		return $json;
	}
}