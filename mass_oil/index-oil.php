<?php
error_reporting(-1);
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
	
	$price = $obj->clearData($arr[$i][$where_price]);
	$litres = $obj->container_capacity($arr[$i][3]);
	$vis = $obj->oil_viscosity($arr[$i][3]);
	$type_selected = $obj->type_oil($arr[$i][3][$vis]);
	
	$h1 = ucfirst($arr[$i][0]);
	//echo "<pre>";
	//print_r($type_selected);
	//echo "</pre>";
?>

	<form method='post' action=''>
		<input type='text' name='model_<?=$i?>' value="<?=$zero, $code_start++?>"> ��� ������ (model)<br>
		<input type='text' name='man_<?=$i?>' value='<?=$manufac?>'> ������������� (11 - Bosch, manufactured)<br>
		<input type='text' name='price_<?=$i?>' value="<?=$price?>"> ����<br>
		<input type="text" size="100" name="name_<?=$i?>" value="<?=$h1?>"> H1 - ��������<br>
		<input type='text' name='mtitle_<?=$i?>' value='�������� ����� <?=rtrim($arr[$i][0])?> - ��������, ������ ����, ���� � �������' size='100'> meta-title<br>
		<input type='text' name='mdescr_<?=$i?>' value='������������� �������� ���� <?=rtrim($arr[$i][0])?>. �������� �� ����� � ������. ������!' size='100'> meta-description<br>
		<textarea cols='52' rows='3' name='text_<?=$i?>'></textarea> �����-��������<br>
		<input type="text" name="litres_<?=$i?>" value="<?=$arr[$i][3][$litres]?>"> ����� ����<br>
		<input type="text" name="viscosity_<?=$i?>" value="<?=$arr[$i][3][$vis]?>"> ��������<br><br>
		<div>��� (���������, ���������, ����):</div>
			<select size="4" name="type_oil">
				<option value="semi_synt" <?=@$type_selected['semi']?>>�������������</option>
				<option value="full_synt" <?=@$type_selected['full']?>>���������</option>
				<option value="mineral" <?=@$type_selected['mineral']?>>�����������</option>
			</select></br><br>
		<div>���������� (��������, �����. � �.�.): </div>
			<select size="4" name="for_what_oil">
				<option value="engine" selected>��������</option>
				<option value="gearbox">���������������</option>
				<option value="clean_oil">����������</option>
			</select></br><br>
		<div>��� ������� (����, ���, �������������):</div>
			<select size="5" name="what_engine_type_oil">
				<option value="uni" selected>�������������</option>
				<option value="gasoline">������</option>
				<option value="diesel">������</option>
				<option value="gas">���</option>
			</select></br><br>
		<div>��������� ���������� (��������, ��������, ����, ������):</div>
			<select size="4" name="category_cars">
				<option value="auto" selected>�������� ����</option>
				<option value="heavy">�������� ����</option>
				<option value="moto">����/2�</option>
			</select></br>

	<hr color="blue">
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