<?php
error_reporting(0);

/* ЗАДАНИЕ 1
- Подключите файл с описанием класса GbookDB
- Создайте объект gbook, экземпляр класса GbookDB
- Создайте переменную $errMsg со строковым значением "" (пустая строка)
*/
include "GbookDB.class.php";
$obj = new GbookDb();
$obj->timeZone();
$errMsg='';

/* ЗАДАНИЕ 3
- Проверьте, была ли отправлена HTML-форма?
- Если ДА, то подключите файл с кодом для обработки HTML-формы
*/
if ($_SERVER['REQUEST_METHOD'] == "POST"){
	include "savepost.inc.php";
}
/*ЗАДАНИЕ 5
- Проверьте, был ли запрос методом GET на удаление записи
- Если ДА, то подключите файл с кодом для удаления записи
*/
if (isset($_GET['delete']) && !empty($_GET['delete'])){
	include "deletepost.inc.php";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<title>Гостевая книга</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<h1>Гостевая книга</h1>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

Ваше имя:<br />
<input type="text" name="name" /><br />
Ваш e-mail:<br />
<input type="text" name="email" /><br />
Сообщение:<br />
<textarea name="msg" cols="50" rows="5"></textarea><br />
<br />
<input type="submit" value="Добавить!" />

</form>
<hr>

<table border="1">
<tr>
<th>Имя пользователя:</th>
<th>Сообщение:</th>
<th>Оставлено:</th>
<th>IP:</th>
<th>Удалить сообщение</th>
</tr>
<?php
/*ЗАДАНИЕ 4
- Подключите файл с кодом для обработки полученных записей Гостевой книги
*/
include "getall.inc.php";
?>
</table>

<?php
/* ЗАДАНИЕ 2
- Проверьте, не является ли переменная $errMsg пустой строкой?
- Если НЕТ, то выведите значение переменной $errMsg
*/
if ($errMsg)
	echo '<p>'.$errMsg.'</p>';
?>

</body>
</html>