<?php
class SuperUser extends User implements ISuperUser{
	static $cntSUser = 0;
	
	//новое свойство
	public $role;
	
	//перегрузка конструктора из класса User
	function __construct($n,$l,$p,$r){
		++self::$cntSUser;
		parent::__construct($n,$l,$p);
		$this->role = $r;
		parent::$cntUser--;
		
		
	}
	
	//перегрузка метода showInfo из класса User
	function showInfo(){
		parent::showInfo();
		echo "Роль: ". $this->role ."<br>"; 
	}
	
	//перегрузка ISuperUser::getInfo, возвращает массив со свойствами
	function getInfo(){
		$arr = array();
		foreach ($this as $k=>$v){
			$arr[$k] = $v;
		}
		return $arr;
	}
}
?>