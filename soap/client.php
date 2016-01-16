<?php
	// Создать SOAP-клиента
	$client = new SoapClient("http://localhost/spec3/soap/stock.wsdl");
	
	// Послать SOAP-запрос c получением результат
	$result = $client->getStock("2");	
	echo $result;
?>