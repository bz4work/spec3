<h1>this is <font color="blue">[./template/default/catalog/</font><font color="red">cat.tpl]</font></h1>
	<hr color="grey">
	<div id="content">
		<!-- подгружаем контроллер который возвращает товары -->
		 <?php include './controller/catalog/cat.php'; ?>
		
		<form action="" method="post">
		   <p><select size="7" multiple name="menu[]">
			<option disabled>Выберите категорию</option>
			<option value="all" <?=@$selected['all']?>>Все товары(0)</option>
			<option value="notebook" <?=@$selected['notebook']?>>Ноуты (5)</option>
			<option value="smartphone" <?=@$selected['smartphone']?>>Смарты (10)</option>
		   </select></p>
		   <p><input type="submit" name="submit" value="GO"></p>
		</form>

		<table border="1" width="50%">
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
