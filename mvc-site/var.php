<?php
//допустимые модули
$allowed_modules = array('contact','errors', 'catalog');

if(!isset($_GET['mod'])){
	$_GET['mod'] = 'static';
}elseif (!in_array($_GET['mod'], $allowed_modules)){
	header("Location: /spec3/mvc-site/index.php?mod=errors&page=404");
	exit();
}

//Если переданной страницы не существует - отдаем по-умолчанию index.tpl	

if (!isset($_GET['page'])){
	$_GET['page'] = 'main';
}

?>