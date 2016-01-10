<?php
include "IGbookDB.class.php";

/*задание 1
ЗАДАНИЕ 1
- Создайте класс GbookDB наследующий интерфейс IGbookDB
- Создайте константу класса DB_NAME и присвойте ей значение gbook.db - имя базы данных
- Создайте закрытое свойство $_db для хранения объекта соединения с базой данных
- Создайте конструктор, в котором выполняется подключение к базе данных
- Создайте деструктор, в котором выполняется закрытие соединения с базой данных
- Создайте временный объект gbook, экземпляр класса GbookDB
- Для проверки работоспособности кода запустите данный файл в браузере и убедитесь, что файл gbook.db создан
- Удалите файл gbook.db
*/
class GbookDB implements IGbookDB{
	const DB_NAME = 'gbook.db';
	private $_db;
	function timeZone(){
		date_default_timezone_set('Europe/Kiev');
	}
	function getAll(){
		$sql = "SELECT id, name, email, msg, datetime, ip
				FROM msgs
				ORDER BY id DESC";
		try{
			$res = $this->_db->arrayQuery($sql, SQLITE_ASSOC);
				if (!$res){
					throw new SQLiteException(sqlite_error_string($this->_db->lastError()));
				}
			return $res;
		}catch(SQLiteException $e){
			return false;	
		}
	}
	function deletePost($id){
		$sql = "DELETE FROM msgs
				WHERE id = $id";
		$result = $this->_db->query($sql);
	}
	function __construct(){
		/*ЗАДАНИЕ 2
- Измените конструктор так, чтобы в нём выполнялась проверка, существует ли база данных на следующих условиях: 
  Если базы данных не существует, создайте ее и выполните SQL-операторы для добавления таблицы (файл gbook.sql). 
  В противном случае, выполняйте подключение к существующей базе данных
- Для проверки работоспособности кода запустите данный файл в браузере и убедитесь, что файл gbook.db создан  
*/
		if (!file_exists(self::DB_NAME)){
			$this->_db = new SQLiteDatabase(self::DB_NAME);
			$sql = "CREATE TABLE msgs(
					id INTEGER PRIMARY KEY,
					name TEXT,
					email TEXT,
					msg TEXT,
					datetime INTEGER,
					ip TEXT)";
			$this->_db->query($sql);
		}else{
			$this->_db = new SQLiteDatabase(self::DB_NAME);
		}
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
	function toString(){
		echo "o!";
	}
	function savePost($name, $email, $msg){
		$dt_tm = time();
		$user_ip = $_SERVER['REMOTE_ADDR'];
		$sql = "INSERT INTO msgs (name,email,msg,datetime,ip)
				VALUES ('$name','$email','$msg',$dt_tm,'$user_ip')";
		try{
			$res = $this->_db->query($sql);
				if (!$res){
					throw new SQLiteException(sqlite_error_string($this->_db->lastError()));
				}
			return true;
		}catch(SQLiteException $e){
			return false;
		}
	}

}//закрывающая скобка класса

/*
ЗАДАНИЕ 6 (Если останется время)
- Опишите в конструкторе, а также в методах getAll, savePost и deletePost блок try-catch
- Создайте исключения на ошибки при выполнении SQL-запросов	
*/
?>