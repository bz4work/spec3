<?php
	/*
	ЗАДАНИЕ 1111
	- Создайте объект и загрузите в него документ
	*/
	$testXML = simplexml_load_file ("catalog.xml");
	
	
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
	foreach ($testXML as $book=>$item){
		echo '<tr>';
			echo '<td>';
			echo $item->author;
			echo '</td>';
			
			echo '<td>';
			echo $item->title;
			echo '</td>';
			
			echo '<td>';
			echo $item->price;
			echo '</td>';
			
			echo '<td>';
			echo $item->pubyear;
			echo '</td>';
		echo '</tr>';
	}
?>
	</table>
</body>
</html>