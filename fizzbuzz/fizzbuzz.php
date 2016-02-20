<?php
error_reporting (-1);
header ('Content-type: text/html; charset=utf-8;');
$cnt = 22;
$fizz = 3;
$buzz = 5;

$all_num_3 = 0;
$all_num_5 = 0;
$all_num_3_5 = 0;
$other = 0;

for ($i=1; $i<=$cnt; $i++){
	$x = fmod ($i, $fizz);
	$x2 = fmod ($i, $buzz);
	$x3 = $x+$x2;

	if (!$x3){
		$all_num_3_5++;
		echo "$i - fizzbuzz (число делится на 3 & 5)<br>";
	}elseif ($x < 1){
		$all_num_3++;
		echo "$i - fizz (число делится на 3)<br>";
	}elseif($x2 < 1){
		$all_num_5++;
		echo "$i - buzz (число делится на 5)<br>";
	}else{
		$other++;
		echo "$i<br>";
	}
}

echo "<br>Кол-во чисел которые делятся на 3 = $all_num_3<br>Кол-во чисел которые делятся на 5 = $all_num_5<br>Кол-во чисел которые делятся и на 3 и на 5 = $all_num_3_5<br>Остальных чисел = $other";
?>