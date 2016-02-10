<?php
error_reporting(-1);
header ('Content-type: text/html; charset=windows-1251');
require "mass.class.php";

$filename = '1.txt';
$test_obj = new MassInc();
$arr = $test_obj->FileToArr($filename);


echo '<pre>';
print_r ($arr);
echo '</pre>';



for ($i = 0 ; $i < $arr['count']; ++$i){
	//Почему то array_search не может найти во вложенном массиве $arr[$i] значение (низкобазовый). Разобраться.
	if ($key = array_search('(низкобазовый)', $arr[$i])){
		$height = '175';
	}else{
		$height = '190';
	}
	
	?>
	<form>
		<input type="text" name="sizes" value="000x175x<?=$height?>">
	</form>
<?php 
}


?>