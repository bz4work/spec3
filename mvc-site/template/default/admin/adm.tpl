
		<h1>this is <font color="red">adm.tpl</font></h1>
		<font color="blue">[./template/default/admin/adm.tpl]</font>
		<hr color="grey">
		<?php include './controller/admin/adm.php';?>
			<form action="" method="post">
				Log <input type="text" name="log"><br>
				Pass <input type="text" name="pass"><br>
				<input type="submit" name="submit">
			</form>
			
<?php 
echo @$r;
echo '<pre>';
print_r($result);
echo '</pre>';
 ?>