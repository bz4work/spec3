<?php
/* Массив с моделями выгруженный из БД сайта */
include "/arrays_MySQL/egr.php";

//количество моделей из БД
$cnt = count($petex);

//Все символы в ячейке делаем  ЗАГЛАВНЫМИ буквами и сохраняем в ту же ячейку
for ($i = 0; $i < $cnt; $i++){
	//$res = mb_strtoupper($petex[$i]['name']);
	//$petex[$i]['name'] = $res;
	
	//разбиваем строку с моделью на массив по пробелу 
	$petex[$i]['name'] = explode(' ', $petex[$i]['name']);
}

//Вывод на экран массива с элементами из БД

echo '<pre> Запись из БД<br>';
print_r($petex[100]);
echo '</pre>';


/**********************************************/
/************************************************/
/* Конвертируем файл в массив */

$file = file('./txt_from_excel/egr-kapot.txt');
$cnt_file = count($file);

//пустой массив для сохраненния в него моделей
$model = array();

foreach ($file as $strings){
	$strings = explode('*', $strings);
	$model[] = $strings;
}

//получаем количество моделей в массиве
$cnt_file = count($model);

//разбиваем строку с моделью на массив по пробелу 
for ($i = 0; $i < $cnt_file; $i++){	
	$model[$i][1] = explode(' ', $model[$i][1]);
}

//вывод всего огромного массива с моделями на экран

echo '<pre> Запись из файла<br>';
print_r($model[27]);
echo '</pre>';

/***********************************************/
function search ($iskomoe, $mass){
		$arr = array_intersect($iskomoe, $mass);
		$res = count($arr);
		//if ($res >= 4)
		if ($res >= 4)
			return true;
		else
			return false;
	}

for ($i = 0; $i < $cnt_file; $i++){
	//выбираем первый вложенный массив из основного массива 
	$mass1 = $model[$i][1]; 
		
		//сравниваем выбранный массив со ВСЕМИ вложенными массивами из БД сайта
		for ($z = 0; $z < $cnt; $z++){

			$mass2 = $petex[$z]['name'];
			$res = search($mass1, $mass2);
			if ($res){
				$iskomoe = $model[$i][1][0]." ".$model[$i][1][1]." ".$model[$i][1][2]." ".$model[$i][1][3]." ".$model[$i][1][4]." ".$model[$i][1][5]." ".$model[$i][1][6]." ".$model[$i][1][7]." ".$model[$i][1][8];
				$mass = $petex[$z]['name'][0]." ".$petex[$z]['name'][1]." ".$petex[$z]['name'][2]." ".$petex[$z]['name'][3]." ".$petex[$z]['name'][4]." ".@$petex[$z]['name'][5]." ".@$petex[$z]['name'][6]." ".@$petex[$z]['name'][7]." ".@$petex[$z]['name'][8]." ".@$petex[$z]['name'][9];
				
				$arr_res['sql'][] = "UPDATE `product` SET `model`= '{$model[$i][0]}' WHERE `product_id` = {$petex[$z]['product_id']};";
				$arr_res['info'][] = "/*<font color='red'>[".$iskomoe."][".$model[$i][0]."]</font> совпало с [".$petex[$z]['product_id']."][".$mass."]*/";
				//$arr_test[] = "UPDATE `product` SET `model`= '{$model[$i][0]}' WHERE `product_id` = {$petex[$z]['product_id']};"."<br>"."/*[".$iskomoe."][".$model[$i][0]."] совпало с [".$petex[$z]['product_id']."][".$mass."]*/<br>";
				$arr_test[] = "UPDATE `product` SET `model`= '{$model[$i][0]}' WHERE `product_id` = {$petex[$z]['product_id']};<br>/*[".$iskomoe."][".$model[$i][0]."] совпало с [".$petex[$z]['product_id']."][".$mass."]*/<br>";
 			}
		}
	
}

foreach ($arr_test as $v){
	echo $v."<br>";
}




?>
