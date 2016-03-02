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
		//преобразование файла в массив
		$file = file("$file_name");
		$arr['count'] = count($file);
		$arr['file'] = $file;
		foreach ($arr['file'] as $key => $value){
			$arr[] = explode(" ", $value);
		}
		return $arr;
	}
	function IncDB($sql_inc){
		//выполнение запроса в Ѕƒ
		if (!$this->_db->connect_error){//проверить установлено ли соединение с базой
			
			if ($this->_db->query($sql_inc)){
				return true;
			}else{
				return $this->_db->error;
			}
			
		}else{
			return $this->_db->connect_error();
		}
	}
	private function searchInArr($array){
		//поиск строки "(низкобазовый)" в массиве
		//если найдено - высота 175мм, если нет - 190мм
		$str = "(низкобазовый)";
		$key = array_search("$str", $array);
		if ($key){
			return $height = '175';
		}else{
			return $height = '190';
		}
	}
	function searchBoxType($array, $ah){
		$options = array(
					0 => 'R+',
					1 => 'L+',
					2 => 'JR+',
					3 => 'JL+');
		//определение типа корпуса и пол€рности
		if ($key = array_search("$options[0]", $array)){
			$res ['type'] = '≈вро';
			$res ['polar'] = 'R+';
			$res ['lenght'] = $this->lenghts($ah);
			$res ['height'] = $this->searchInArr($array);
		}elseif ($key = array_search("$options[1]", $array)){
			$res ['type'] = '≈вро';
			$res ['polar'] = 'L+';
			$res ['lenght'] = $this->lenghts($ah);
			$res ['height'] = $this->searchInArr($array);
		}elseif ($key = array_search("$options[2]", $array)){
			$res ['type'] = 'јзи€';
			$res ['polar'] = 'JR+';
			$res ['lenght'] = $this->lenght_asia_type($ah);
			$res ['height'] = '220';
		}elseif ($key = array_search("$options[3]", $array)){
			$res ['type'] = 'јзи€';
			$res ['polar'] = 'JL+';
			$res ['lenght'] = $this->lenght_asia_type($ah);
			$res ['height'] = '220';
		}else{
			$res = '';
		}
		return $res;
	}
	function capacityAh ($array){
		//емкость
		foreach ($array as $k => $v){
			if ((int)$v > 0){
				return $k;
			}
		}
	}
	function startCurrent ($array){
		//пусковой ток
		foreach ($array as $k => $v){
			if ((int)$v > 250){
				return $k;
			}
		}
	}
	function lenghts($capacity){
		//определение длинны на основе емкости
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
	private function lenght_asia_type($capacity){
		//определение длинны на основе емкости
		$capacity = (int)$capacity;
		if ($capacity < 36){
			return $lenght = '187';
		}elseif ($capacity > 44 && $capacity < 51){
			return $lenght = '238';
		}elseif ($capacity > 54 && $capacity < 66){
			return $lenght = '230';
		}elseif ($capacity > 66 && $capacity < 86){
			return $lenght = '265';
		}elseif ($capacity > 89 && $capacity < 106){
			return $lenght = '305';
		}else{
			return $lenght = '000';
		}
	}
	function get_prod_id(){
		//возвращает запрос который выберает последний id из таблицы product
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
	function productCode($code_start){
		if ($code_start <= 9){
			return $zero = "0000";
		}elseif($code_start <= 99){
			return $zero = "000";
		}elseif($code_start > 99 && $code_start <= 999){
			return $zero = "00";
		}elseif ($code_start > 999 && $code_start < 10000){
			return $zero = "0";
		}elseif ($code_start >= 10000){
			return $zero = "";
		}else{
			return $zero = "?";
		}
	}
}//закрывающа€ скобка класса
?>