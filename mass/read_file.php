<?php
error_reporting(-1);
header ('Content-type: text/html; charser=utf-8');

$file = file('bosch_s3.txt');

print_r($file);

$a = count($file);
echo "<form action='' method='post'>";
for($i = 0 ; $i < $a ; ++$i){
	
	$i++;
		
		echo "<input type='text' value='$file[$i]' name='h1_name_$i'><br>";
		
		echo "<input type='text' value="; 
		if($i>=10){
			echo '000';
		}else{
			echo '0000';
		}
		
		echo $i." name='model_$i'><br>";
}


?>
<input type="submit" value="go">
</form>