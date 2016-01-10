<?php
$domObj = new DOMDocument();
$domObj->load("catalog.xml");
$root = $domObj->documentElement;

$child = $root->childNodes;



	/*
	ЗАДАНИЕ 1
	- Создайте объект DOM
	- Загрузите XML-документ в объект
	- Получите корневой элемент
	*/
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


foreach ($child as $book){
	if ($book->nodeType == 1){
		echo "<tr>";
			foreach ($book->childNodes as $item){
				if ($item->nodeType == 1){
					echo "<td>";
					echo $item->textContent;
					echo "</td>";
				}
			}
		echo "</tr>";
	}
}


?>
	</table>
</body>
</html>





