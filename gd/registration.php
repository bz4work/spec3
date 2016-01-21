<?php
session_start();
//echo $_SESSION['randStr'].'<br>';
	/*
	ЗАДАНИЕ 1
	- Запустите сессию
	- Создайте переменную result со значением "пустая строка"("")
	- Проверьте, была ли отправлена форма
	- Проверьте, существует ли сессионная переменная randStr
		- Если переменная randStr существует и её значение равно значению введённому пользователем,
			присвойте переменной result значение "Правильно"
		- Если переменная randStr существует и её значение не равно значению введённому пользователем,
			присвойте переменной result значение "НЕ правильно"
		- Если переменная randStr не существует,
			присвойте переменной result значение "ВКЛЮЧИ ГРАФИКУ!"		
	*/
	
$res = '';
if ($_SERVER['REQUEST_METHOD'] == "POST"){
	if (isset($_POST['str'])){
		if (isset($_SESSION['randStr']) && $_SESSION['randStr'] == $_POST['str']){
			$res = 'Совпало!';
			//header ('Location: registration.php');
		}else{
			$res = 'НЕ совпало!';
		}
	}else{
		$res = 'Введите цифры!';
	}
}else{
	$res = '';
}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Регистрация</title>
</head>
<body>
<h1>Регистрация</h1>
<form action="" method="post">
	<div>
		<img src="noise-picture.php">
	</div>
	<div>
		<label>Введите строку</label>
		<input type="text" name="str" size="6">
	</div>
	<input type="submit" value="OK">
</form>
<?php 
	/*ЗАДАНИЕ 2
	- Выведите значение переменной result
	*/
	echo $res;
?>
</body>
</html>
