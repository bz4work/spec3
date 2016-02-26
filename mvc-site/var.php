<?php
//допустимые модули
$allowed_modules = array('contact','errors', 'catalog', 'admin');

if(!isset($_GET['mod'])){
	$_GET['mod'] = 'static';
}elseif (!in_array($_GET['mod'], $allowed_modules)){
	header("Location: /spec3/mvc-site/index.php?mod=errors&page=404");
	exit();
}

//допустимые страницы
//Если переданной страницы не существует - отдаем по-умолчанию main.tpl
$allowed_pages = array('contact', '404', 'main', 'cat', 'adm');

if (!isset($_GET['page'])){
	$_GET['page'] = 'main';
}elseif (!in_array($_GET['page'], $allowed_pages)){
	header("Location: /spec3/mvc-site/index.php?mod=errors&page=404");
	exit();
}



?>