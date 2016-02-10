<?php
error_reporting(-1);
header ('Content-type: text/html; charset=utf-8');
require "mass.class.php";
?>
<form method='post' action='index-mass-oop.php'>
	<input type='text' name='file_name' value='<?=@$_POST['file_name']?>'> введите название файла<br>
	<input type='text' name='code_start' value='<?=@$_POST['code_start']?>'> начать нумерацию кода товара с этой цифры <br>
	<input type='text' name='manufac' value='<?=@$_POST['manufac']?>'> id производителя (11 - Bosch, manufactured)<br>
	<input type='submit' name='submit' value='go'>
</form>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$filename = $_POST['file_name'];
$code_start = $_POST['code_start'];
$manufac = $_POST['manufac'];
$test_obj = new MassInc();
$arr = $test_obj->FileToArr($filename);
/*
echo '<pre>';
print_r ($arr);
echo '</pre>';
*/

for ($i = 0 ; $i < $arr['count']; ++$i){
	$options = array(
					0 => 'R+',
					1 => 'L+',
					2 => 'JR+',
					3 => 'JL+');

	$nizbaza = $test_obj->searchArr('(низкобазовый)', $arr[$i]);

	if ($nizbaza){
		$height = '175';
	}else{
		$height = '190';
	}

	$boxType = $test_obj->searchBoxType($options, $arr[$i]);
	$ah = $test_obj->capacityAh($arr[$i]);
	$tok = $test_obj->startCurrent($arr[$i]);
	$lenght = $test_obj->lenghts($arr[$i][$ah]);
	
	
	if ($code_start <= 9){
		$zero = "0000";
	}elseif($code_start <= 99){
		$zero = "000";
	}elseif($code_start >= 100 && $code_start <= 1000){
		$zero = "00";
	}elseif ($code_start > 1000 && $code_start < 10000){
		$zero = "0";
	}elseif ($code_start >= 10000){
		$zero = "";
	}else{
		$zero = "?";
	}
	/*
	//<input type='text' name='model_<?=$i?>' value="<?=$code_zero['zero'].$code_zero['num']++?>"> код товара (model) через Класс<br>
	*/
?>
	<form method='post' action='index-mass-oop.php'>
		<input type='text' name='model_<?=$i?>' value="<?=$zero, $code_start++?>"> код товара (model)<br>
		<input type='text' name='man_<?=$i?>' value='<?=$manufac?>'> Производитель (11 - Bosch, manufactured)<br>
		<input type='text' name='price_<?=$i?>' value='1500'> Цена<br>
		<input type="text" name="name_<?=$i?>" value="<?=rtrim($arr['file'][$i])?>"> H1 - Название<br>
		<input type='text' name='mtitle_<?=$i?>' value='Аккумулятор автомобильный <?=rtrim($arr['file'][$i])?> - доставка, низкие цены, Киев и Украина' size='50'> meta-title<br>
		<input type='text' name='mdescr_<?=$i?>' value='Аккумулятор для авто <?=rtrim($arr['file'][$i])?>. Доставка по Киеву и Укране. Скидки! Дорого купим Ваш старый АКБ.' size='50'> meta-description<br>
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
	//закрываем основой IF
	}else{
		echo 'загрузите файл';
	}

?>