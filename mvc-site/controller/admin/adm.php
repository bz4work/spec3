<?php
if (isset($_POST['log']) && !empty($_POST['log'])){
	$authObj = new Goods();
	$log = $_POST['log'];
	$pass = $_POST['pass'];
	$result = $authObj->auth($log, $pass);
}
		


?>