<?php
//error_reporting(-1);
header ('Content-type: text/html; charset=windows-1251');
session_start();
require "config.inc.php";
require "mass.class.php";
require "sql.class.php";

$obj = new MassInc();
$arr = $obj->FileToArr($filename);

echo "<pre>";
print_r($arr);
echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	//controller.inc.php - ��������� ������ �� �����, ���������� ������� � ����, ����� ���������� ������
	include "controller.inc.php";
}

if (isset($_GET['clear']) && !empty($_GET['clear'])){
	session_unset('rq');
	header ('Location: index-mass-oop.php');
}

for ($i = 0 ; $i < $arr['count']; ++$i){
	$price = $obj->clearData($arr[$i][2]);
?>

	<form method='post' action=''>
		<input type='text' name='model_<?=$i?>' value="<?=$zero, $code_start++?>"> ��� ������ (model)<br>
		<input type='text' name='man_<?=$i?>' value='<?=$manufac?>'> ������������� (11 - Bosch, manufactured)<br>
		<input type='text' name='price_<?=$i?>' value="<?=$price?>"> ����<br>
		<input type="text" size="100" name="name_<?=$i?>" value="<?=rtrim($arr[$i][0])?>"> H1 - ��������<br>
		<input type='text' name='mtitle_<?=$i?>' value='�������� ����� <?=rtrim($arr[$i][0])?> - ��������, ������ ����, ���� � �������' size='100'> meta-title<br>
		<input type='text' name='mdescr_<?=$i?>' value='������������� �������� ���� <?=rtrim($arr[$i][0])?>. �������� �� ����� � ������. ������!' size='100'> meta-description<br>
		<textarea cols='52' rows='3' name='text_<?=$i?>'></textarea> �����-��������<br>
		<input type="text" name="size_<?=$i?>" value=""> ���������� (��������, �����. � �.�.)<br>
		<input type="text" name="box_type_<?=$i?>" value=""> ����� ����<br>
		<input type="text" name="polar_<?=$i?>" value=""> ��������<br>
		<input type="text" name="tok_<?=$i?>" value=""> ��� (���������, ���������, ����)<br>
		<input type="text" name="ah_<?=$i?>" value=""> ��� ������� (����, ���, �������������)<br>
		<input type="text" name="ah_<?=$i?>" value=""> ��������� ���������� (��������, ��������, ����, ������)<br>

	<hr color="grey">
<?php
	}//������ ��������� ����� FOR
?>
		<input type="submit" name="submit" value="�������� � ��!">
	</form>
<?php
	if (isset($_SESSION['result_query']) && !empty($_SESSION['result_query'])){
		foreach ($_SESSION['result_query'] as $k=>$v){
			echo $v;
		}
		echo "<a href=\"index-oil.php?clear=all\">�������� ���������</a>";
	}else{
		echo "������ ����������� �� ����������.";
	}
?>