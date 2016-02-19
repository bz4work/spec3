<?php
error_reporting (-1);
$conn = new mysqli('localhost', 'root', 'rootroot', 'test');
include "arr.php";

if ($conn->connect_error) {
    die('Ошибка подключения (' . $conn->connect_errno . ') '.$conn->connect_error);
}

echo '<pre>';
print_r($big);
echo '</pre><hr>';

$cnt = count($big);

for ($i = 0; $i < $cnt; $i++){
	$res = mb_strtoupper($big[$i]['name']);
	$big[$i]['name'] = $res;
}

echo '<pre>';
print_r($big);
echo '</pre><hr>';

$file = file('file_dlya_sravneniya.txt');
$cnt_file = count($file);

echo '<pre>';
print_r($file);
echo '</pre><hr>';

for ($i = 0; $i < $cnt_file; $i++){
	$str = explode("*",$file[$i]);
	echo '<hr>';
	print_r($a);
	echo '<hr>';
	$iskomoe = $str[1];
	echo 'Искомое значение: '.$iskomoe;
	$res = array_search($iskomoe, $big[$i]);
	if ($res){
		echo '<br>Совпадение в ячейке: '.$res.'<br>';
		//echo "Код товара который нужно заменить: "$big[$i][$res]."<br>";
	}
}
?>