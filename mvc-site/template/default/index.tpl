<html>
	<head>
		<title></title>
	</head>
	<body>
		<h1>this is <font color="red">index.tpl</font></h1>
		<font color="blue">[./template/default/index.tpl]</font>
		<hr color="grey">
		<div id="content">
			<!-- подгружаем модуль+страницу которые переданы через GET -->
			<?php include_once '/'.$_GET['mod'].'/'.$_GET['page'].'.tpl'; ?>
		</div>
	</body>
</html>