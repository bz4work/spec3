<?php
//error_reporting(-1);
header ('Content-type: text/html; charset=windows-1251');
require "config.inc.php";
require "mass.class.php";
require "sql.class.php";

$oil = new MainOil();
$sql_obj = new SqlInc();
$arr = $oil->FileToArr($filename);

for ($i = 0 ; $i < $arr['count']; ++$i){
	/*
	$height = $oil->searchInArr('(������������)', $arr[$i]);
	$boxType = $oil->searchBoxType($arr[$i]);
	$ah = $oil->capacityAh($arr[$i]);
	$tok = $oil->startCurrent($arr[$i]);
	$lenght = $oil->lenghts($arr[$i][$ah]);
	*/
	
	$zero = $oil->productCode($code_start);
	
	//$price = $oil->price($arr[$i]);
	
?>
	<form method='post' action='index-mass-oop.php'>
		<input type='text' name='model_<?=$i?>' value="<?=$zero, $code_start++?>"> ��� ������ (model)<br>
		<input type='text' name='man_<?=$i?>' value='<?=$manufac?>'> ������������� (11 - Bosch, manufactured)<br>
		<input type='text' name='price_<?=$i?>' value='<?=$price?>'> ����<br>
		<input type="text" name="name_<?=$i?>" value="<?=rtrim($arr['file'][$i])?>"> H1 - ��������<br>
		<input type='text' name='mtitle_<?=$i?>' value='����������� ������������� <?=rtrim($arr['file'][$i])?> - ��������, ������ ����, ���� � �������' size='50'> meta-title<br>
		<input type='text' name='mdescr_<?=$i?>' value='����������� ��� ���� <?=rtrim($arr['file'][$i])?>. �������� �� ����� � ������. ������! ������ ����� ��� ������ ���.' size='50'> meta-description<br>
		<textarea cols='52' rows='3' name='text_<?=$i?>'></textarea> �����-��������<br>
		<input type="text" name="size_<?=$i?>" value="<?=$lenght?>x175x<?=$height?>"> �������<br>
		<input type="text" name="box_type_<?=$i?>" value="<?=$boxType['type']?>"> ��� �������<br>
		<input type="text" name="polar_<?=$i?>" value="<?=$boxType['polar']?>"> ����������<br>
		<input type="text" name="tok_<?=$i?>" value="<?=$arr[$i][$tok]?>"> ��������<br>
		<input type="text" name="ah_<?=$i?>" value="<?=$arr[$i][$ah]?>"> �������<br>

	<hr color="red">
<?php
	}//������ ��������� ����� FOR
?>
		<input type="submit" name="submit" value="GO">
	</form>
<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		//controller.inc.php - ��������� ������ �� �����, ���������� ������� � ����, ����� ���������� ������
		require "controller.inc.php";
	}
?>