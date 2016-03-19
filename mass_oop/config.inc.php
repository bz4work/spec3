<?php
define ('DB_HOST', '');
define ('DB_USER', '');
define ('DB_PASS', '');
define ('DB_NAME', '');

$filename = "./goods/amega-truck.txt";

$code_start = 235;
//Bosch - 11
//Varta - 12
//Westa - 13
//Berga - 16
//Rocket - 15
//Berga - 16
//Mutlu - 17
//A-mega - 14
$manufac = 14;

//Основная категория товара
//Аккумуляторы для легковых - 59
//Аккумуляторы для грузовых - 60
//Аккумуляторы для мото - 61
//Другие товары - 62
define ('CAT_ID', 60);


//Категория для товаров
//Westa - 69
//Varta - 64
//Berga - 67
//Mutlu - 65
//A-mega - 70
//A-mega грузовые - 77
define ('CAT_ID_2', 77);
?>