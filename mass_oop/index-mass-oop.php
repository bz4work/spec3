<?php
//error_reporting(-1);
header ('Content-type: text/html; charset=windows-1251');
require "config.inc.php";
require "mass.class.php";
require "sql.class.php";

$test_obj = new MassInc();
$sql_obj = new SqlInc();
$arr = $test_obj->FileToArr($filename);

for ($i = 0 ; $i < $arr['count']; ++$i){
	$height = $test_obj->searchInArr('(низкобазовый)', $arr[$i]);
	$boxType = $test_obj->searchBoxType($arr[$i]);
	$ah = $test_obj->capacityAh($arr[$i]);
	$tok = $test_obj->startCurrent($arr[$i]);
	$lenght = $test_obj->lenghts($arr[$i][$ah]);
	$zero = $test_obj->productCode($code_start);
?>
	<form method='post' action='index-mass-oop.php'>
		<input type='text' name='model_<?=$i?>' value="<?=$zero, $code_start++?>"> код товара (model)<br>
		<input type='text' name='man_<?=$i?>' value='<?=$manufac?>'> Производитель (11 - Bosch, manufactured)<br>
		<input type='text' name='price_<?=$i?>' value='1500'> Цена<br>
		<input type="text" size="100" name="name_<?=$i?>" value="<?=rtrim($arr['file'][$i])?>"> H1 - Название<br>
		<input type='text' name='mtitle_<?=$i?>' value='Аккумулятор автомобильный <?=rtrim($arr['file'][$i])?> - доставка, низкие цены, Киев и Украина' size='100'> meta-title<br>
		<input type='text' name='mdescr_<?=$i?>' value='Аккумулятор для авто <?=rtrim($arr['file'][$i])?>. Доставка по Киеву и Укране. Скидки! Дорого купим Ваш старый АКБ.' size='100'> meta-description<br>
		<textarea cols='52' rows='3' name='text_<?=$i?>'></textarea> Текст-описание<br>
		<input type="text" name="size_<?=$i?>" value="<?=$lenght?>x175x<?=$height?>"> Размеры<br>
		<input type="text" name="box_type_<?=$i?>" value="<?=$boxType['type']?>"> Тип корпуса<br>
		<input type="text" name="polar_<?=$i?>" value="<?=$boxType['polar']?>"> Полярность<br>
		<input type="text" name="tok_<?=$i?>" value="<?=$arr[$i][$tok]?>"> Пусковой<br>
		<input type="text" name="ah_<?=$i?>" value="<?=$arr[$i][$ah]?>"> Емкость<br>

	<hr color="red">
<?php
	}//скобка основного цикла FOR
?>
		<input type="submit" name="submit" value="GO">
	</form>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		//controller.inc.php - обработка данных из формы, выполнение запроса к базе, вывод результата работы
		require "controller.inc.php";
	}
?>