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

$file = file('');
?>