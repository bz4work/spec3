<html>
	<head>
		<title></title>
	</head>
	<body>
		this is <font size="3"color="blue">./template/default/</font><font color="red">index.tpl</font>
		
		
		<div>
			<!-- верхнее меню -->
			<a href="index.php">Главная</a>&nbsp;&nbsp;<a href="index.php?mod=catalog&page=cat">Каталог</a>&nbsp;&nbsp;<a href="index.php?mod=contact&page=contact">Контакты</a>&nbsp;&nbsp;<a href="index.php?mod=errors&page=404">404</a>&nbsp;&nbsp;<a href="index.php?mod=admin&page=adm">Админка</a>
		</div>
		<hr color="grey">
		<div id="content">
			<!-- подгружаем модуль+страницу которые переданы через GET -->
			<?php include $_GET['mod'].'/'.$_GET['page'].'.tpl'; ?>
		</div>
	</body>
</html>