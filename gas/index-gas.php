<?php
error_reporting(-1);
header ('Content-type: text/html; charset=utf-8');
require "config.inc.php";
require "gas.class.php";
require "sql.class.php";

$obj = new GasInc();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$total_lit = ($_POST['total_sum']/$_POST['price_gas']);
	
	if (isset($_POST['total_litres']) && $_POST['total_litres'] != 0){
		$tm = time();
		$odo = $_POST['odo'];
		$t_s = $_POST['total_sum'];
		$t_l = $_POST['total_litres'];
		$p_g = $_POST['price_gas'];
		$id_z = $_POST['id_zapravki'];
		
		$sql = "INSERT INTO `zapravki` (`datetime`,`odometr`, `total_sum`, `total_liters`, `price_gas`, `id_zapravki`) 
								VALUES ('$tm',
										'$odo',
										'$t_s',
										'$t_l',
										'$p_g',
										'$id_z')";
		if ($obj->IncDBNew($sql)){
				//return true;
				echo "$sql<br>";
				echo "Добавлено<br>";
		}else{
			return $this->_db->error;
		}
		
		$rashod = 12.5;
		$zapas = ($t_l/($rashod/100));
		
		if($_POST['over'] == 'no'){
			$zap = $obj->get_last_zapas();
			
			$sql3 = "UPDATE `zapas` SET total_mk = total_mk+$zapas";
			if ($obj->IncDBNew($sql2)){
				echo "$sql2<br>";
				echo "Добавлено<br>";
			}else{
				return $this->_db->error;
			}
			
		}
		
		$last_id = $obj->get_last_id();
		
		$sql2 = "INSERT INTO `zapas` (`id_zapisi`,`total_mk`) 
								VALUES ('$last_id',
										'$zapas')";
		if ($obj->IncDBNew($sql2)){
			echo "$sql2<br>";
			echo "Добавлено<br>";
		}else{
			return $this->_db->error;
		}
		
		
		
	}
}

echo '<hr><pre>';
print_r($_POST);
echo '</pre><hr><br><br>';
?>
<form action="index-gas.php" method="post">
	<input type="text" name="date" value="<?=date('d.m.y', time());?>"> date<br>
	<input type="text" name="time" value="<?=date('H:i', time());?>"> time<br><br>
	<input type="radio" name="over" value="no"> NO
	<input type="radio" name="over" value="yes"> YES<br>
	
	<input type="text" name="odo" value="123456" placeholder="175 558"> odometr<br><br>
	
	<input type="text" name="total_sum" value="<?=@$_POST['total_sum']?>"> summa<br>
	<input type="text" name="price_gas" value="<?=@$_POST['price_gas']?>"> price gas<br>
	<input type="text" name="total_litres" value="<?=@round($total_lit,2)?>"> total liters<br><br>
	<input type="text" name="id_zapravki" value="<?=@$_POST['id_zapravki']?>" placeholder="номер заправки"> id gas station<br><br>
	<input type="submit" name="submit" value="GO">
	
</form>
<?php
	$zap = $obj->get_last_zapas();
?>
<p>Запас хода: <?=$zap?></p>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		
		//controller.inc.php - обработка данных из формы, выполнение запроса к базе, вывод результата работы
		//require "controller.inc.php";
		
		
	}
?>