<?php
include "imass.class.php";

class MassInc implements IMassInc{	
	private $_db;
	function __construct(){
		$this->_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}
	function clearData ($data){
		$data = strip_tags($data);
		$data = trim($data);
		//$data = sqlite_escape_string($data);
		$data = $this->_db->escape_string($data);
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
	function IncDB($sql_inc){
		if (!$this->_db->connect_error){//проверить установлено ли соединение с базой
			
			if ($this->_db->query($sql_inc)){
				return true;
			}else{
				return $this->_db->error;
			}
			
		}else{
			return $this->_db->connect_error;
		}
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
			$res ['type'] = '≈вро';
			$res ['polar'] = 'R+';
		}elseif ($key = array_search("$arrayOptions[1]", $array)){
			$res ['type'] = '≈вро';
			$res ['polar'] = 'L+';
		}elseif ($key = array_search("$arrayOptions[2]", $array)){
			$res ['type'] = 'јзи€';
			$res ['polar'] = 'JR+';
		}elseif ($key = array_search("$arrayOptions[3]", $array)){
			$res ['type'] = 'јзи€';
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
	//возвращает запрос который выберает последний id из таблицы product
	function get_prod_id(){
		$select_prod_id = "SELECT product_id FROM product ORDER BY product_id DESC LIMIT 1";
		if (!$this->_db->connect_error){//проверить установлено ли соединение с базой
			if ($res = $this->_db->query($select_prod_id)){
				foreach ($res as $arr){
					foreach ($arr as $last_id){
						return $last_id;
					}
				}
			}else{
				return $this->_db->error;
			}
		}else{
			return $this->_db->connect_error;
		}
	}

}//закрывающа€ скобка класса
?>