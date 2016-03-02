<?php
//error_reporting(-1);
header ('Content-type: text/html; charset=windows-1251');
session_start();
require "config.inc.php";
require "mass.class.php";
require "sql.class.php";

$test_obj = new MassInc();
$sql_obj = new SqlInc();
$arr = $test_obj->FileToArr($filename);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	//controller.inc.php - ��������� ������ �� �����, ���������� ������� � ����, ����� ���������� ������
	include "controller.inc.php";
}

if (isset($_GET['clear']) && !empty($_GET['clear'])){
	//unset($_SESSION['rq']);
	session_unset('rq');
	header ('Location: index-mass-oop.php');
}

for ($i = 0 ; $i < $arr['count']; ++$i){
	$boxType = $test_obj->searchBoxType($arr[$i], $arr[$i][$ah]);
	$ah = $test_obj->capacityAh($arr[$i]);
	$tok = $test_obj->startCurrent($arr[$i]);
	$zero = $test_obj->productCode($code_start);
?>

	<form method='post' action=''>
		<input type='text' name='model_<?=$i?>' value="<?=$zero, $code_start++?>"> ��� ������ (model)<br>
		<input type='text' name='man_<?=$i?>' value='<?=$manufac?>'> ������������� (11 - Bosch, manufactured)<br>
		<input type='text' name='price_<?=$i?>' value='1500'> ����<br>
		<input type="text" size="100" name="name_<?=$i?>" value="<?=rtrim($arr['file'][$i])?>"> H1 - ��������<br>
		<input type='text' name='mtitle_<?=$i?>' value='����������� ������������� <?=rtrim($arr['file'][$i])?> - ��������, ������ ����, ���� � �������' size='100'> meta-title<br>
		<input type='text' name='mdescr_<?=$i?>' value='����������� ��� ���� <?=rtrim($arr['file'][$i])?>. �������� �� ����� � ������. ������! ������ ����� ��� ������ ���.' size='100'> meta-description<br>
		<textarea cols='52' rows='3' name='text_<?=$i?>'></textarea> �����-��������<br>
		<input type="text" name="size_<?=$i?>" value="<?=$boxType['lenght']?>x175x<?=$boxType['height']?>"> �������<br>
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
	if (isset($_SESSION['rq']) && !empty($_SESSION['rq'])){
		foreach ($_SESSION['rq'] as $k=>$v){
			echo $v;
		}
		echo "<a href=\"index-mass-oop.php?clear=all\">�������� ���������</a>";
	}else{
		echo "������ ����������� �� ����������";
	}
?>