<?php
class Goods{	
	private $_db;
	function __construct(){
		$this->_db = new mysqli('localhost', 'root', 'rootroot', 'mvc-site');
	}
	
	function getGoods($cat = 0){
		if ($cat > 0){
			$sql = "SELECT * FROM goods WHERE category = $cat;";
		}else{
			$sql = "SELECT * FROM goods;";
		}
		
		if ($result = $this->_db->query($sql)) {
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$res[] = $row;	
			}
			return $res;
		}
	}
	
	function auth($log, $pass){
		$sql = "SELECT id, login, pass FROM users WHERE login = $log LIMIT 1;";
		if ($result = $this->_db->query($sql)) {
			//если есть результат выполняем проверку пароля
			$data = mysqli_fetch_assoc($result);
				return $data;
		}else{
			//пользователь не найден в БД
			//возвращаем false
			return false;
		}
		
	}
}

function wtf ($array){
	
	$pr = print_r($array);
	$res = "<pre>".$pr."</pre>";
	return $res;
}




?>