<?php
class User extends AUser{
	static $cntUser = 0;
	static $objNum = 0;
	
	public $name;
	public $login;
	public $password;
	
	
	//константа класса
	const INFO_TITLE = '<h3>Данные пользователя</h3>';
	
	function __construct($n,$l,$p){
			$this->name = $n;
			$this->login = $l;
			$this->password = $p;
			++self::$cntUser;
			++self::$objNum;
		}
	//встроенный метод клонирования
	function __clone(){
		$this->name = 'guest';
		$this->login = 'guest';
		$this->password = 'qwerty';
		++self::$cntUser;
		self::$objNum = self::$cntUser;
	}
	
	//перегрузка метода из абстрактного класса AUser
	function showInfo(){
		echo "Имя пользователя: ". $this->name ."<br>"; 
		echo "Логин: ". $this->login ."<br>"; 
		echo "Пароль: ". $this->password ."<br>"; 
	}
	
	//метод
	function showTitle(){
		echo self::INFO_TITLE.'<br>';
	}
	
	function __toString(){
		return "<br>Это объект № ". self::$objNum .": $this->name";
	}
}
?>