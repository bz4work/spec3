<?php
session_start();
$str_cap = "a b c d e f g 1 2 3 4 5 6 7 8 9";
$arr_sym = explode(' ',$str_cap);//массив с символами
$nChars = 5;//количество символов на картинке
$_SESSION['randStr'] = '';


for ($i = 0; $i < $nChars; ++$i){
	$rand_sym = rand(0,15);//выбранный случайный символ из массива символо $arr_sym
	$rand_str .= $arr_sym[$rand_sym];
	$ang = rand(-5,20);
	
	
}

$_SESSION['randStr'] = $rand_str;
$res_str = $_SESSION['randStr'];

$img = imagecreatefromjpeg("images/noise.jpg");
imageAntiAlias($img, true);//зглаживание
$red = imageColorAllocate($img,255,0,0);
imageTtfText($img,20,10,80,30,$black,"arial.ttf",$res_str);

header ('Content-type: image/jpg');
imageJPEG($img);

	/*
	ЗАДАНИЕ 1
	- Запустите сессию
	- Создайте переменную nChars(количество выводимых на картинке символов)
		и присвойте ей произвольное значение(рекомендуемое: 5)
	- Сгенерируйте случайную строку длиной nChars символов
	- Создайте сессионную переменную randStr и присвойте ей сгенерированную строку
	*/
	
	/*
	ЗАДАНИЕ 2
	- Создайте изображение на основе файла "images/noise.jpg"
	- Создайте цвет для рисования
	- Включите сглаживание
	- Задайте начальные координаты x и y для отрисовки строки(рекомендуемые: 20 и 30)
	- Используя цикл for отрисуйте строку посимвольно
	- Для каждого символа используйте случайные значение размера и угла наклона
	- Отдайте полученный результат как jpeg-изображение с 10% сжатием
	*/	
?>

