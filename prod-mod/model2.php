<?php
$arr_sql = array();
$arr_res = array();
/************************************************/
$file = file('file_dlya_sravneniya.txt');

$arr = array();

foreach ($file as $strings){
	$strings = explode('*', $strings);
	$arr[] = $strings;	
}

$cnt_file = count($arr);

echo '<pre>';
print_r($arr);
echo '</pre>';
/***********************************************/
include "arr2.php";

$cnt = count($big);
echo $cnt;
for ($i = 0; $i < $cnt; $i++){
	$res = mb_strtoupper($big[$i]['name']);
	$big[$i]['name'] = $res;
}
/**********************************************/
/*
echo '<pre>';
print_r($big);
echo '</pre>';
*/
for ($i = 0; $i < $cnt_file; $i++){
	
	$a = trim($arr[$i][1]);
	
	for ($z = 0; $z < $cnt; $z++){
		
		//echo "ищем это: $a<br>";
		//echo "ищем здесь: {$big[$z]['name']}<br>";
		if ($res = array_search("$a", $big[$z])){
				$sql = "UPDATE `product` SET `model`= '{$arr[$z][0]}' WHERE `product_id` = {$big[$z]['product_id']};";
				//echo $sql.'<br><hr>';
				$arr_sql[] = $sql;
				$arr_res[] = $res;

		}else{
			//echo "no<br><hr color='red'>";
		}
	}

}

echo '<pre>';
print_r($arr_sql);
echo '</pre>';

echo '<pre>';
print_r($arr_res);
echo '</pre>';

?>