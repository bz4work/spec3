<?php
//error_reporting(-1);
header ('Content-type: text/html; charset=windows-1251');
session_start();
require "config.inc.php";
require "mass.class.php";
require "sql.class.php";

$test_obj = new MassInc();
$sql_obj = new SqlInc();
$arr = $test_obj->FileToArr($filename);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	//controller.inc.php - обработка данных из формы, выполнение запроса к базе, вывод результата работы
	include "controller.inc.php";
}

if (isset($_GET['clear']) && !empty($_GET['clear'])){
	//unset($_SESSION['rq']);
	session_unset('rq');
	header ('Location: index-mass-oop.php');
}

for ($i = 0 ; $i < $arr['count']; ++$i){
	$boxType = $test_obj->searchBoxType($arr[$i], $arr[$i][$ah]);
	$ah = $test_obj->capacityAh($arr[$i]);
	$tok = $test_obj->startCurrent($arr[$i]);
	$zero = $test_obj->productCode($code_start);
?>

	<form method='post' action=''>
		<input type='text' name='model_<?=$i?>' value="<?=$zero, $code_start++?>"> код товара (model)<br>
		<input type='text' name='man_<?=$i?>' value='<?=$manufac?>'> Производитель (11 - Bosch, manufactured)<br>
		<input type='text' name='price_<?=$i?>' value='1500'> Цена<br>
		<input type="text" size="100" name="name_<?=$i?>" value="<?=rtrim($arr['file'][$i])?>"> H1 - Название<br>
		<input type='text' name='mtitle_<?=$i?>' value='Аккумулятор автомобильный <?=rtrim($arr['file'][$i])?> - доставка, низкие цены, Киев и Украина' size='100'> meta-title<br>
		<input type='text' name='mdescr_<?=$i?>' value='Аккумулятор для авто <?=rtrim($arr['file'][$i])?>. Доставка по Киеву и Укране. Скидки! Дорого купим Ваш старый АКБ.' size='100'> meta-description<br>
		<textarea cols='52' rows='3' name='text_<?=$i?>'></textarea> Текст-описание<br>
		<input type="text" name="size_<?=$i?>" value="<?=$boxType['lenght']?>x175x<?=$boxType['height']?>"> Размеры<br>
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
	if (isset($_SESSION['rq']) && !empty($_SESSION['rq'])){
		foreach ($_SESSION['rq'] as $k=>$v){
			echo $v;
		}
		echo "<a href=\"index-mass-oop.php?clear=all\">Очистить результат</a>";
	}else{
		echo "массив результатов не существует";
	}
?>