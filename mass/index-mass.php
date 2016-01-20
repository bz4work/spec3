<?php
error_reporting(-1);
header ('Content-type: text/html; charset=windows-1251');

require "/config.inc.php";

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASS, DB_NAME);
if (!$link){
	die('Ошибка: '.mysqli_connect_errno() . '-'. mysqli_connect_error());
}
//echo 'Соединение установлено... ' . mysqli_get_host_info($link) . "<br><br>";
$_POST['link'] = $link;
$_POST['cnt'] = 0;
$file = file("bosch-all.txt");
$cnt = count($file);
foreach ($file as $v){
	$arr[] = explode(" ", $v);
}
$m = 1;//код товара, если 1 - начать нумерацию с 00001
?>
<br>
<br>
<form action="" method="post">
<?php	
for($i = 0 ; $i < $cnt ; ++$i){
$polar = 'NO';
$niz ='000';
$dlina = '000';
$korpus_type = '';

if ($m < 10 || $i < 9){
	$zero = "0000";
}elseif($m < 100 || $i < 100){
	$zero = "000";
}else{
	$zero = "000";
}

if ($key = array_search('R+', $arr[$i])){
	$polar = 'R+';
	$korpus_type = 'Евро';
}elseif ($key = array_search('L+', $arr[$i])){
	$polar = 'L+';
	$korpus_type = 'Евро';
}elseif ($key = array_search('JR+', $arr[$i])){
	$polar = 'JR+';
	$korpus_type = 'Азия';
}elseif ($key = array_search('JL+', $arr[$i])){
	$polar = 'JL+';
	$korpus_type = 'Азия';
}


if ($key = array_search('(низкобазовый)', $arr[$i])){
	$niz = '175';
}else{
	$niz = '190';
}

if ($arr[$i][2] < 52){
	$dlina = '205';
}elseif ($arr[$i][2] > 50 && $arr[$i][2] < 70){
	$dlina = '242';
}elseif ($arr[$i][2] > 60 && $arr[$i][2] < 90){
	$dlina = '276';
}elseif ($arr[$i][2] > 70){
	$dlina = '353';
}
?>
	<input type='text' name='model_<?=$i?>' value="<?php echo $zero, $m++; ?>"> код товара (model)<br>
	<input type='text' name='man_<?=$i?>' value='11'> Производитель (11 - Bosch, manufactured)<br>
	<input type='text' name='price_<?=$i?>' value='1500'> Цена<br>
	<input type='text' name='h1_name_<?=$i?>' value='<?=$file[$i]?>' size='50'> Имя (H1)<br>
	<textarea cols='52' rows='3' name='text_<?=$i?>'></textarea> Текст-описание<br>
	<input type='text' name='mtitle_<?=$i?>' value='Аккумулятор автомобильный <?=$file[$i]?>- доставка, низкие цены, Киев и Украина' size='50'> meta-title<br>
	<input type='text' name='mdescr_<?=$i?>' value='Аккумулятор для авто <?=$file[$i]?>. Доставка по Киеву и Укране. Скидки! Дорого купим Ваш старый АКБ.' size='50'> meta-description<br>
	<input type='text' name='ah_<?=$i?>' value="<?=$arr[$i][2]?>"> Эмкость<br>
	<input type='text' name='polar_<?=$i?>' value="<?=$polar?>"> Полярность<br>
	<input type='text' name='korpus_<?=$i?>' value="<?=$korpus_type?>"> Тип корпуса<br>
	<input type='text' name='sizes_<?=$i?>' value="<?=$dlina?>х175х<?=$niz?>"> Размеры<br>
	<input type='text' name='tok_<?=$i?>' value="<?=$arr[$i][4]?>"> Пусковой<br>
	<br>
	<hr color="red">

<?php 
$korpus_type = '';//обнуление переменной
}//скобка основного цикла for
?>
	<hr>
	<input type="submit" name="submit" value="GO">
<form><br>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST"){
include "lib.inc.php";
	for ($i = 0; $i < $cnt ; ++$i){
		$res_product = sql_prod($_POST["model_$i"], $_POST["man_$i"], $_POST["price_$i"]);
		$res_descr = sql_prod_desc($_POST["h1_name_$i"],$_POST["text_$i"],$_POST["mtitle_$i"],$_POST["mdescr_$i"]);
		$res_cat = sql_prod_cat();
		$res_lay = sql_prod_layout();
		$res_store = sql_prod_store();
		$res_attr = sql_prod_attr($_POST["ah_$i"],$_POST["polar_$i"],$_POST["korpus_$i"],$_POST["sizes_$i"], $_POST["tok_$i"]);
		
		if ($res_product){
			echo "Cтрока №".$i." insert to PRODUCT -> OK!<br>";
				if ($res_descr){
					echo "insert to PRODUCT_DESCRIPTION -> OK!<br>";
						if ($res_cat){
							echo "insert to PRODUCT_TO_CATEGORY -> OK!<br>";
								if($res_lay){
									echo "insert to PRODUCT_TO_LAYOUT -> OK!<br>";
										if ($res_store){
											echo "insert to PRODUCT_TO_STORE -> OK!<br>";
												if ($res_attr){
													echo "insert to PRODUCT_ATTRIBUTE -> OK!<br>";
												}else{
													echo $err = $res_attr;
												}
										}else{
											echo $err = $res_store;
										}
								}else{
									echo $err = $res_lay;
								}
						}else{
							echo $err = $res_car;
						}
				}else{
					echo $err = $res_descr;
				}
		}else{
			echo $err = $res_product;
		}
	}
}//скобка if ($_SERVER['REQUEST_METHOD'] == "POST")

?>
