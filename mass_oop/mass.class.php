<?php
include "imass.class.php";

class MassInc implements IMassInc{
	const DB_HOST = 'localhost';
	const DB_USER = 'root';
	const DB_PASS = '';
	const DB_NAME = '';
	
	private $_db;
	function __construct(){
		$this->_db = new mysqli(self::DB_HOST, self::DB_USER, self::DB_PASS, self::DB_NAME);
	}
	function clearData ($data){
		$data = strip_tags($data);
		$data = trim($data);
		$data = sqlite_escape_string($data);
		return $data;
	}
	function __destruct(){
		unset($this->_db);
	}
	
	function FileToArr($file_name){
		$file = file("$file_name");
		$arr['count'] = count($file);
		$arr['file'] = $file;
		foreach ($arr['file'] as $k=>$v){
			$arr[] = explode(" ", $v);
		}
		return $arr;
	}
	function CreateSQLinc($arg){
	
	}
	function IncDB($sql_inc){
	
	}
}//закрывающая скобка класса
?>