<?php
error_reporting(-1);
header('Content-type: text/html; charset=utf-8');
	/*ЗАДАНИЕ 1
	- Опишите функцию-обработчик начальных тегов
	- Опишите функцию-обработчик закрывающих тегов
	- Опишите функцию-обработчик текстового содержимого
	- Создайте парсер
	- Зарегистрируйте функцию-обработчики начальных и конечных тегов
	- Зарегистрируйте функцию-обработчик текстового содержимого
	*/
function start($sax, $tag, $att){
	
	if ($tag != "CATALOG" and $tag != "BOOK")
		echo "<td>";
	if ($tag == "BOOK")
		echo "<tr>";
	
	/** мой вариант, не такой изящный ****
	switch ($tag){
		case "BOOK": echo "<tr>";break;
		case "AUTHOR": echo "<td>";break;
		case "TITLE": echo "<td>";break;
		case "PUBYEAR": echo "<td>";break;
		case "PRICE": echo "<td>";break;
	}
	**************************************/
}
function theEnd($sax, $tag){
	if ($tag != "CATALOG" and $tag != "BOOK")
		echo "</td>";
	if ($tag == "BOOK")
		echo "</tr>";
	
	/** мой вариант, не такой изящный ****
	switch ($tag){
		case "BOOK": echo "</tr>";break;
		case "AUTHOR": echo "</td>";break;
		case "TITLE": echo "</td>";break;
		case "PUBYEAR": echo "</td>";break;
		case "PRICE": echo "</td>";break;
	}
	**************************************/
}
function text($sax, $text){
	echo $text;
}

$saxer = xml_parser_create("UTF-8");

xml_set_element_handler($saxer, "start", "theEnd");
xml_set_character_data_handler($saxer, "text");
?>
<html>
	<head>
		<title>Каталог</title>
	</head>
	<body>
	<h1>Каталог книг</h1>
	<table border="1" width="100%">
		<tr>
			<th>Автор</th>
			<th>Название</th>
			<th>Год издания</th>
			<th>Цена, руб</th>
		</tr>
	<?php
		/*ЗАДАНИЕ 2
		- Запустите парсер
		*/
		xml_parse($saxer, file_get_contents("catalog.xml"));
	?>
	</table>
	</body>
</html>