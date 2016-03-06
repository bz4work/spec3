<?php
error_reporting(-1);
header ('Content-type: text/html; charset=windows-1251');
session_start();
require "config.inc.php";
require "mass.class.php";
require "sql.class.php";

$obj = new MassInc();
$arr = $obj->FileToArr($filename);

echo "<pre>";
print_r($arr);
echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	//controller.inc.php - обработка данных из формы, выполнение запроса к базе, вывод результата работы
	include "controller.inc.php";
}

if (isset($_GET['clear']) && !empty($_GET['clear'])){
	session_unset('rq');
	header ('Location: index-mass-oop.php');
}

for ($i = 0 ; $i < $arr['count']; ++$i){
	
	$price = $obj->clearData($arr[$i][$where_price]);
	$litres = $obj->container_capacity($arr[$i][3]);
	$vis = $obj->oil_viscosity($arr[$i][3]);
	$type_selected = $obj->type_oil($arr[$i][3][$vis]);
	
	$h1 = ucfirst($arr[$i][0]);
	//echo "<pre>";
	//print_r($type_selected);
	//echo "</pre>";
?>

	<form method='post' action=''>
		<input type='text' name='model_<?=$i?>' value="<?=$zero, $code_start++?>"> код товара (model)<br>
		<input type='text' name='man_<?=$i?>' value='<?=$manufac?>'> Производитель (11 - Bosch, manufactured)<br>
		<input type='text' name='price_<?=$i?>' value="<?=$price?>"> Цена<br>
		<input type="text" size="100" name="name_<?=$i?>" value="<?=$h1?>"> H1 - Название<br>
		<input type='text' name='mtitle_<?=$i?>' value='Моторное масло <?=rtrim($arr[$i][0])?> - доставка, низкие цены, Киев и Украина' size='100'> meta-title<br>
		<input type='text' name='mdescr_<?=$i?>' value='Автомобильное моторное мало <?=rtrim($arr[$i][0])?>. Доставка по Киеву и Укране. Скидки!' size='100'> meta-description<br>
		<textarea cols='52' rows='3' name='text_<?=$i?>'></textarea> Текст-описание<br>
		<input type="text" name="litres_<?=$i?>" value="<?=$arr[$i][3][$litres]?>"> Объем тары<br>
		<input type="text" name="viscosity_<?=$i?>" value="<?=$arr[$i][3][$vis]?>"> Вязкость<br><br>
		<div>Тип (минералка, синтетика, полу):</div>
			<select size="4" name="type_oil">
				<option value="semi_synt" <?=@$type_selected['semi']?>>Полусинтетика</option>
				<option value="full_synt" <?=@$type_selected['full']?>>Синтетика</option>
				<option value="mineral" <?=@$type_selected['mineral']?>>Минеральное</option>
			</select></br><br>
		<div>Назначение (моторное, транс. и т.д.): </div>
			<select size="4" name="for_what_oil">
				<option value="engine" selected>Моторное</option>
				<option value="gearbox">Трансмиссионное</option>
				<option value="clean_oil">Промывоное</option>
			</select></br><br>
		<div>Тип топлива (бенз, диз, универсальное):</div>
			<select size="5" name="what_engine_type_oil">
				<option value="uni" selected>Универсальное</option>
				<option value="gasoline">Бензин</option>
				<option value="diesel">Дизель</option>
				<option value="gas">Газ</option>
			</select></br><br>
		<div>Категория транспорта (легковое, грузовое, мото, другие):</div>
			<select size="4" name="category_cars">
				<option value="auto" selected>Легковые авто</option>
				<option value="heavy">Грузовые авто</option>
				<option value="moto">Мото/2Т</option>
			</select></br>

	<hr color="blue">
<?php
	}//скобка основного цикла FOR
?>
		<input type="submit" name="submit" value="Добавить в БД!">
	</form>
<?php
	if (isset($_SESSION['result_query']) && !empty($_SESSION['result_query'])){
		foreach ($_SESSION['result_query'] as $k=>$v){
			echo $v;
		}
		echo "<a href=\"index-oil.php?clear=all\">Очистить результат</a>";
	}else{
		echo "Массив результатов не существует.";
	}
?>