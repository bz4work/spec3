<?php
    function getStock($num){
		$stock = array(
					"1"=>100,
					"2"=>200,
					"3"=>300,
					"4"=>400,
					"5"=>500);
		if (array_key_exists($num, $stock)){
			return $stock[$num];
		}else{
			return 0;
		}
	}
	
	//отключил в файле php.ini
	//ini_set("soap.wsdl_cache_enabled", "0");//отключаем кэширование .wsdl файлов на время разработки
	
	$server = new SoapServer("http://localhost/spec3/soap/stock.wsdl");//создаем сервис (службу) и в конструктор передаем файл .wsdl с описанием сервиса
	$server->addFunction("getStock");//добавляем функцию для нашего сервиса (службы)
	$server->handle();//запускаем службу
	
	
	
	
	
	
	// 1. Описать функцию/метод Web-сервиса 
	
	// 2. Отключить кэширование WSDL-документа
	
	// 3. Создать SOAP-сервер
	
	// 4. Добавить функцию/класс к серверу

	// 5. Запустить сервера
	
?>