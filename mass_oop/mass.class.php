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
		foreach ($arr['file'] as $key => $value){
			$arr[] = explode(" ", $value);
		}
		return $arr;
	}
	function CreateSQLinc($arg){
	
	}
	function IncDB($sql_inc){
	
	}
	function searchArr($str, $array){
		$key = array_search("$str", $array);
		if ($key)
			return true;
		else
			return false;
	}
	function searchBoxType($arrayOptions, $array){
		if ($key = array_search("$arrayOptions[0]", $array)){
			$res ['type'] = 'Евро';
			$res ['polar'] = 'R+';
		}elseif ($key = array_search("$arrayOptions[1]", $array)){
			$res ['type'] = 'Евро';
			$res ['polar'] = 'L+';
		}elseif ($key = array_search("$arrayOptions[2]", $array)){
			$res ['type'] = 'Азия';
			$res ['polar'] = 'JR+';
		}elseif ($key = array_search("$arrayOptions[3]", $array)){
			$res ['type'] = 'Азия';
			$res ['polar'] = 'JL+';
		}else{
			$res = '';
		}
		return $res;
	}
	function capacityAh ($array){
		foreach ($array as $k => $v){
			if ((int)$v > 0){
				return $k;
			}
		}
	}
	function startCurrent ($array){
		foreach ($array as $k => $v){
			if ((int)$v > 250){
				return $k;
			}
		}
	}
	function lenghts($capacity){
		$capacity = (int)$capacity;
		if ($capacity < 52){
			return $lenght = '205';
		}elseif ($capacity > 50 && $capacity < 70){
			return $lenght = '242';
		}elseif ($capacity > 60 && $capacity < 80){
			return $lenght = '276';
		}elseif ($capacity > 79 && $capacity < 86){
			return $lenght = '315';
		}elseif ($capacity > 85 && $capacity < 106){
			return $lenght = '353';
		}elseif ($capacity > 105 && $capacity < 120){
			return $lenght = '393';
		}else{
			return $lenght = '000';
		}
	}

}//закрывающая скобка класса
?>