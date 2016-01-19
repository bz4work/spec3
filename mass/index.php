<?php
error_reporting(-1);
header ('Content-type: text/html; charser=utf-8');

require "lib.inc.php";
require "config.inc.php";

$link = mysqli_connect(DB_HOST, DB_LOGIN, DB_PASS, DB_NAME);

if (!$link){
	die('Ошибка: '.mysqli_connect_errno() . '-'. mysqli_connect_error());
}
//echo 'Соединение установлено... ' . mysqli_get_host_info($link) . "<br><br>";

$_POST['link'] = $link;
$_POST['cnt'] = 0;


?>

<br>
<br>
<form action="" method="post">
	
	<?php
	$file = file("bosch_s3.txt");
	$cnt = count($file);
	$m = 1;
	
	for($i = 0 ; $i < $cnt ; ++$i){
	
	if ($m <= 10){
		$zero = "0000";
	}else{
		$zero = "000";
	}
	/*
	echo "<input type='text' name='model_$i' value=". $zero , $m++ ."> model - код товара<br>";
	echo "<input type='text' name='man_$i' value='11'> manufactured - 11 Bosch<br>";
	echo "<input type='text' name='price_$i' value='1500'> price<br>";
	echo "<input type='text' name='h1_name_$i' value='Аккумулятор $file[$i]' size='50'> name-h1<br>";
	echo "<textarea cols='52' rows='3' name='text_$i'></textarea> text-descr<br>";
	echo "<input type='text' name='mtitle_$i' value='Аккумулятор автомобильный $file[$i] - доставка, низкие цены, Киев и Украина' size='50'> meta-title<br>";
	echo "<input type='text' name='mdescr_$i' value='' size='50'> meta-descr<br>";
	//echo "<hr>";
	*/
	?>
	
	<input type='text' name='model_<?=$i?>' value="<?php echo $zero, $m++; ?>"> model - код товара<br>
	<input type='text' name='man_<?=$i?>' value='11'> manufactured - 11 Bosch<br>
	<input type='text' name='price_<?=$i?>' value='1500'> price<br>
	<input type='text' name='h1_name_<?=$i?>' value='Аккумулятор <?=$file[$i]?>' size='50'> name-h1<br>
	<textarea cols='52' rows='3' name='text_<?=$i?>'></textarea> text-descr<br>
	<input type='text' name='mtitle_<?=$i?>' value='Аккумулятор автомобильный <?=$file[$i]?> - доставка, низкие цены, Киев и Украина' size='50'> meta-title<br>
	<input type='text' name='mdescr_<?=$i?>' value='' size='50'> meta-descr<br>
	<?php 
	}
	?>
	<hr>
	<input type="submit" name="submit" value="GO">
<form><br>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

	for ($i = 0; $i < $cnt ; ++$i){

		$res_product = sql_prod($_POST["model_$i"], $_POST["man_$i"], $_POST["price_$i"]);
		$res_inc_product = mysqli_query($link, $res_product);
		
		$res_descr = sql_prod_desc($_POST["h1_name_$i"],$_POST["text_$i"],$_POST["mtitle_$i"],$_POST["mdescr_$i"]);
		$res_inc_descr = mysqli_query($link, $res_descr);
		
		if ($res_inc_product){
			echo '1й запрос успешно!<br>';
			if ($res_inc_descr){
				echo '2й успешно!<br>';
			}else{
				echo '2й НЕ успешно! Ошибка: '.$link->error .'<br>';
			}
		}else{
			echo '1й НЕ успешно! Ошибка: '.$link->error .'<br>';
		}
	}


}

?>
