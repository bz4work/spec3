<?php
error_reporting(-1);
header('Content-type: text/html; charset=utf-8');
/* ЗАДАНИЕ 1
- Создайте константу для хранения имени XML-файла
- Проверьте, была ли отправлена HTML-форма?
	Если она была отправлена: отфильтруйте полученные данные
- Получите данные об IP-адресе пользователя	
- Получите данные о текущих дате и времени
*/
define ("USERS_LOG","users.xml");

date_default_timezone_set('Europe/Kiev');
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$ip = $_SERVER['REMOTE_ADDR'];
	$dt = time();
	$name = trim(strip_tags($_POST['name']));
	$email = trim(strip_tags($_POST['email']));
	$msg = trim(strip_tags($_POST['msg']));
	
	$obj = new DOMDocument('1.0','utf-8');//создаем екземпляр класса
	
	//форматировать документ --> погуглить что это такое
	$obj->formatOutput = true;
	//что-то про пробелы --> погуглить что это такое
	$obj->preserveWhiteSpace = false;
	
	if (file_exists(USERS_LOG)){//если файл есть
		$obj->load(USERS_LOG);//загрузили файл
		$root = $obj->documentElement;//получили корневой елемент
	}else{//если файла нету
		$root = $obj->createElement('users');//создаем главный елемент, в который все вкладываем
		$obj->appendChild($root);//создаем файл и привязавыем главный елемент к файлу
	}
	
	$n = $obj->createElement('name',$name);//создаем елемент <name>имя которое пришло</name> и сразу вкладываем текст
	$e = $obj->createElement('email',$email);
	$m = $obj->createElement('message',$msg);
	$i = $obj->createElement('ip',$ip);
	$d = $obj->createElement('datetime',$dt);
	
	$user = $obj->createElement('user');//создаем елемент <user> для каждого набора данных
	$root->appendChild($user);//привязываем <user> к корневому елементу
	
	$user->appendChild($n);//привязываем елемент <name>имя которое пришло</name> к елменту user, который вложен в users
	$user->appendChild($e);
	$user->appendChild($m);
	$user->appendChild($i);
	$user->appendChild($d);
	
	$obj->save(USERS_LOG);//сохраняем всё из памяти в файл *.xml
	header ('Location: gbook.php');//перезапрашиваем страницу чтобы убить данные из буфера
	
	exit;//заканчиваем работу скрипта принудительно, на всякий случай =)
}

/*ЗАДАНИЕ 2
- Создайте объект DOMDocument
- Проверьте, существует ли xml-документ с данными
	Если существует, загрузите его в созданный объект
	и получите корневой элемент
	Если не существует, создайте корневой элемент "users"
	и привяжите его к объекту
*/

/*ЗАДАНИЕ 3
- Cоздайте новый XML-элемент "user" для очередной записи
- Cоздайте XML-элементы для всех данных Гостевой книги:
	name, email, msg, IP, datetime
- Cоздайте текстовые узлы для всех указанных элементов
- Привяжите текстовые узлы к соответствующим XML-элементам
- Привяжите XML-элементы с данными заказа к XML-элементу "user"
- Привяжите XML-элемент "user" к корневому элементу "users"
- Сохраните файл
- Перезапросите страницу для избавления от посланных данных
*/	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<title>Гостевая книга</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
</head>
<body>

<h1>Гостевая книга</h1>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

Ваше имя:<br />
<input type="text" name="name" /><br />
Ваш E-mail:<br />
<input type="text" name="email" /><br />
Сообщение:<br />
<textarea name="msg" cols="50" rows="5"></textarea><br />
<br />
<input type="submit" value="Добавить!" />

</form>

<table border='1'>
<tr>
<th>Имя</th>
<th>Почта</th>
<th>Сообщение</th>
<th>From @</th>
<th>Дата</th>
<tr>
<?php
/*ЗАДАНИЕ 4
- Создайте объект SimpleXML и загрузите в него XML-документ
- Выведите в браузер все сообщения, а также информацию
  об авторе каждого сообщения в произвольной форме
  в обратном порядке
*/
# =================================== #
#	ВЫВОД ФАЙЛА XML ЧЕРЕЗ SimpleXML   #
# =================================== #
$simplexml = simplexml_load_file(USERS_LOG);
//echo '<pre>';
//var_dump($simplexml);
//echo '</pre>';

foreach ($simplexml->user as $item){
	echo '<tr>';
		echo '<td>'. $item->name .'</td>';
		echo '<td>'. $item->email .'</td>';
		echo '<td>'. $item->message .'</td>';
		echo '<td>'. $item->ip .'</td>';
		$temp = ($item->datetime)*1;
		
		$time = date('d-m-Y H:i:s',$temp);
		echo '<td>'. $time .'</td>';
	echo '</tr>';
}

# =================================== #
#	ВЫВОД ФАЙЛА XML ЧЕРЕЗ SimpleXML   #
# =================================== #


# =================================== #
#     ВЫВОД ФАЙЛА XML ЧЕРЕЗ SAX       #
# =================================== #
/*

function start($sax, $tag, $att){
	//вставляем <tr> во всех случаях когда у нас USER
	if ($tag == "USER"){
		echo "<tr>";
	}
	//вставляем <td> во всех случаях когда у нас не USERS или не USER
	if ($tag != "USERS" and $tag != "USER"){
		echo "<td>";
	}
}
function theEnd($sax, $tag){
	//вставляем </td> во всех случаях когда у нас не USERS или не USER
	if ($tag != "USERS" and $tag != "USER"){
		echo "</td>";
	}
	//вставляем </tr> во всех случаях когда у нас USER
	if ($tag == "USER"){
		echo "</tr>";
	}
}
function text($sax, $text){
	echo $text;//каждый раз когда попадаем на текстовый узел - выводим его
}

$saxer = xml_parser_create("UTF-8"); // создаем парсер

xml_set_element_handler($saxer, "start", "theEnd");//инициализация функций работы с открывающими и закрывающими тегами
xml_set_character_data_handler($saxer, "text");//инициализация функции работы с текстовыми узлами

xml_parse($saxer, file_get_contents(USERS_LOG));//запуск парсера на чтение строки, строку получаем читая из файла

*/
# =================================== #
#     ВЫВОД ФАЙЛА XML ЧЕРЕЗ SAX       #
# =================================== #
?>
</table>
</body>
</html>