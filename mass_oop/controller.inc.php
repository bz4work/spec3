<?php
for ($i = 0 ; $i < $arr['count']; ++$i){
			/****** Фильтруем входные данные ******/
			$model = $test_obj->clearData($_POST["model_$i"]);
			$man = $test_obj->clearData($_POST["man_$i"]);
			$price = $test_obj->clearData($_POST["price_$i"]);
			$ah = $test_obj->clearData($_POST["ah_$i"]);
			$polar = $test_obj->clearData($_POST["polar_$i"]);
			$korpus = $test_obj->clearData($_POST["box_type_$i"]);
			$size = $test_obj->clearData($_POST["size_$i"]);
			$tok = $test_obj->clearData($_POST["tok_$i"]);
			/****** Фильтруем входные данные ******/
			
			
			/*************** Добавление данных в таблицу product - start ******************/
			/*************** Описание принимаемых значений методом ************************
			** метод product принимает значения:
			** 1e-код товара, 2е-производитель, 3е-цена
			** не обьязательные параметры:
			** 4е-сортировка (default:99), 5е-количество(default:1000), 
			** 6е-статус наличия (default:7 - В наличии), 7е-включить (1) или выключить (0) для вывода (default:0-не показывать на сайте)
			/*************** Описание принимаемых значений методом ************************/
		
			$sql_product = $sql_obj->product($model, $man, $price);
			/*
			if($sql_product){
				echo "<i>".$sql_product."</i><br><br>";
			}else{
				echo "запрос не сформирован оО<br>";
			}
			*/
			if ($test_obj->IncDB($sql_product)){
				echo "Товар <b>".$_POST["name_$i"]."</b>. Добавлено в таблицу <b>product</b>  OK.<br><br>";
			}else{
				echo $test_obj->IncDB($sql_product);
			}
			/*************** Добавление данных в таблицу product - end ******************/
	
			$prod_id = $test_obj->get_prod_id();
			//echo "$prod_id"."<<- <br>";
			
			/*************** Добавление данных в таблицу product_attribute - start ******************/
			$sql_prod_attr = $sql_obj->product_attr($ah, $polar, $korpus, $size, $tok, $prod_id);
			/*
			if($sql_prod_attr){
				echo "<i>".$sql_prod_attr."</i><br><br>";
			}else{
				echo "запрос не сформирован оО<br>";
			}
			*/
			if ($test_obj->IncDB($sql_prod_attr)){
				echo "Товар <b>".$_POST["name_$i"]."</b>. Добавлено в таблицу <b>product_attribute</b>.  OK<br><br>";
			}else{
				echo $test_obj->IncDB($sql_prod_attr);
			}
			/*************** Добавление данных в таблицу product_attribute - end ******************/
			
			
			
			/*************** Добавление данных в таблицу product_to_category - start ******************/			
			$sql_prod_to_cat = $sql_obj->product_to_category($prod_id);
			/*
			if($sql_prod_to_cat){
				echo "<i>".$sql_prod_to_cat."</i><br><br>";
			}else{
				echo "запрос не сформирован оО<br>";
			}
			*/
			if ($test_obj->IncDB($sql_prod_to_cat)){
				echo "Товар <b>".$_POST["name_$i"]."</b>. Добавлено в таблицу <b>product_to_category</b>  OK.<br><br>";
			}else{
				echo $test_obj->IncDB($sql_prod_to_cat);
			}
			/*************** Добавление данных в таблицу product_attribute - end ******************/
			
			
			
			/*************** Добавление данных в таблицу product_to_layout - start ******************/			
			$sql_prod_to_lay = $sql_obj->product_to_layout($prod_id);
			/*
			if($sql_prod_to_cat){
				echo "<i>".$sql_prod_to_cat."</i><br><br>";
			}else{
				echo "запрос не сформирован оО<br>";
			}
			*/
			if ($test_obj->IncDB($sql_prod_to_lay)){
				echo "Товар <b>".$_POST["name_$i"]."</b>. Добавлено в таблицу <b>product_to_layout</b>  OK.<br><br>";
			}else{
				echo $test_obj->IncDB($sql_prod_to_lay);
			}
			/*************** Добавление данных в таблицу product_to_layout - end ******************/
			
			
			
			/*************** Добавление данных в таблицу product_to_store - start ******************/			
			$sql_prod_to_store = $sql_obj->product_to_store($prod_id);
			/*
			if($sql_prod_to_cat){
				echo "<i>".$sql_prod_to_cat."</i><br><br>";
			}else{
				echo "запрос не сформирован оО<br>";
			}
			*/
			if ($test_obj->IncDB($sql_prod_to_store)){
				echo "Товар <b>".$_POST["name_$i"]."</b>. Добавлено в таблицу <b>product_to_store</b>  OK.<br><br>";
			}else{
				echo $test_obj->IncDB($sql_prod_to_store);
			}
			/*************** Добавление данных в таблицу product_to_store - end ******************/
			
			
			/*************** Добавление данных в таблицу product_description - start ******************/	
			
			$sql_prod_desc = $sql_obj->sql_prod_desc($prod_id, $name, $descr, $m_title, $m_descr);
			/*
			if($sql_prod_to_cat){
				echo "<i>".$sql_prod_to_cat."</i><br><br>";
			}else{
				echo "запрос не сформирован оО<br>";
			}
			*/
			if ($test_obj->IncDB($sql_prod_desc)){
				echo "Товар <b>".$_POST["name_$i"]."</b>. Добавлено в таблицу <b>product_description</b>  OK.<br><br>";
			}else{
				echo $test_obj->IncDB($sql_prod_desc);
			}
			/*************** Добавление данных в таблицу product_description - end ******************/
			
			echo "<hr color = 'green'>";
}//скобка основного цикла FOR
?>