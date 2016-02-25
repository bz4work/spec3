<?php
class Goods{	
	private $_db;
	function __construct(){
		$this->_db = new mysqli('localhost', 'root', 'rootroot', 'mvc-site');
	}
	
	function getGoods($cat = 0){
		$sql = "SELECT * FROM goods;";
		if ($cat > 0){
			$sql = "SELECT * FROM goods WHERE category = $cat;";
		}
		
		if ($result = $this->_db->query($sql)) {
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
				$res[] = $row;	
			}
			return $res;
		}
	}
}

function wtf ($array){
	
	$pr = print_r($array);
	$res = "<pre>".$pr."</pre>";
	return $res;
}




?>