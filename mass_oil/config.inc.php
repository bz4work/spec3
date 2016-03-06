<?php
define ('DB_HOST', 'localhost');
define ('DB_USER', 'root');
define ('DB_PASS', 'rootroot');
define ('DB_NAME', 'opc203');
//в какой ячейке цена? поставить цифру (счиатать от 0...)
$where_price = 2;

$filename = "./_goods/aral-test.txt";

$code_start = 113;
//Bosch - 11
//Varta - 12
//Westa - 13
//Berga - 16
//Rocket - 15
//Berga - 16
$manufac = 16;

//Категория для товаров
//Westa - 69
//Varta - 64
//Berga - 67
define ('CAT_ID_2', 67);
?>