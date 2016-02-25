<h1>this is <font color="blue">[./template/default/catalog/</font><font color="red">cat.tpl]</font></h1>
	<hr color="grey">
	<div id="content">
		<!-- подгружаем контроллер который возвращает товары -->
		 <?php include './controller/catalog/cat.php'; ?>
		
		<form action="" method="post">
			<input type="submit" name="go" value="GO!">
		</form>
		<form action="" method="post">
		   <p><select size="7" name="menu[]">
			<option disabled>Выберите героя</option>
			<option value="10" <?php if ($select = 10) echo 'selected';?>>Категория 10</option>
			<option value="5" <?php if ($select = 5) echo 'selected';?>>Категория 5</option>
			<option value="Шапокляк">Шапокляк</option>
			<option value="Крыса Лариса">Крыса Лариса</option>
		   </select></p>
		   <p><input type="submit" name="go" value="GO"></p>
		</form>
		<?php 
		echo '<pre>';
		print_r($_POST);
		echo '</pre>';
		?>
		<table border="1">
		<tr>
			<th>Название</th>
			<th>Фото</th>
			<th>Описание</th>
			<th>Цена</th>
		</tr>
		<?php 
		foreach ($goodsArr as $key=>$val){
			echo "
			<tr>
				<td>{$val['name']}</td>
				<td><img src=\"{$val['image']}\"></td>
				<td>{$val['opisanie']}</td>
				<td>{$val['price']}</td>
			</tr>";
		}
		?>
		</table>	
	</div>
