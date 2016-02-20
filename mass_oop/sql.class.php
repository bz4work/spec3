<?php
class SqlInc{
	function product($model, $man, $price, $sort_order = 99, $quan = 1000, $stock = 7, $status = 1){
		//$sort_order = 99;//сортировка
		//$quan = 1000;//количество на складе
		//$stock = 7; //есть в наличии
		//$status = 0;//1 - включено на сайте, 0 - выключено
		$sql_prod = "INSERT INTO `product` (`model`, 
											`sku`, 
											`upc`, 
											`ean`, 
											`jan`, 
											`isbn`, 
											`mpn`, 
											`location`, 
											`quantity`, 
											`stock_status_id`, 
											`image`, 
											`manufacturer_id`, 
											`shipping`, 
											`price`, 
											`points`, 
											`tax_class_id`, 
											`date_available`, 
											`weight`, 
											`weight_class_id`, 
											`length`, 
											`width`, 
											`height`, 
											`length_class_id`, 
											`subtract`, 
											`minimum`, 
											`sort_order`, 
											`status`, 
											`viewed`, 
											`date_added`, 
											`date_modified`) 
									VALUES ('$model', '', '', '', '', '', '', '', $quan, $stock, '', $man, 1, '$price', 0, 0, '2016-01-01', 1, 1, 0.00000000, 0.00000000, 0.00000000, 1, 1, 1, $sort_order, $status, 0, '2016-01-01 00:00:00', '2016-01-01 00:00:00')"; 
		return $sql_prod;
	}	
	function product_attr($ah, $polar, $korpus, $sizes, $tok, $prod_id, $lang = 2){
		//$attr_id = 0;//id атрибута
		//$lang = 2;//язык, русский - 2
		$sql_prod_attr = "INSERT INTO `product_attribute` (`product_id`, `attribute_id`, `language_id`, `text`) 
								VALUES ($prod_id, 12, $lang, '$ah'),
										($prod_id, 13, $lang, '$polar'),
										($prod_id, 14, $lang, '$korpus'),
										($prod_id, 15, $lang, '$sizes'),
										($prod_id, 16, $lang, '$tok');";
		return $sql_prod_attr;
	}
	function product_to_category($prod_id, $cat_id = 59, $cat_id2 = 64){
		//основная категория        $cat_id = 59;   //авто аккумуляторы
		//подкатегория по бренду    $cat_id2 = 59;  //авто аккумуляторы "название_бренда"
		$sql_prod_cat = "INSERT INTO `product_to_category` (`product_id`, `category_id`) 
						VALUES ($prod_id, $cat_id), ($prod_id, $cat_id2);";
		return $sql_prod_cat;
	}
	function product_to_layout($prod_id, $store = 0, $lay = 0){
		//$store = 0;//магазин по-умолчанию
		//$lay = 0;//по-умолчанию 0
		$sql_prod_lay = "INSERT INTO `product_to_layout` (`product_id`, `store_id`, `layout_id`) 
								VALUES ($prod_id, $store, $lay);";
		return $sql_prod_lay;
	}
	function product_to_store($prod_id, $store = 0){
		//$store = 0;//магазин по-умолчанию
		$sql_prod_store = "INSERT INTO `product_to_store` (`product_id`, `store_id`) 
						VALUES ($prod_id, $store);";
		return $sql_prod_store;
	}
	function sql_prod_desc($prod_id, $name, $descr, $m_title, $m_descr, $lang = 2){
		//$lang = 2;//язык: 1-english; 2-русский;
		$sql_prod_desc = "INSERT INTO `product_description` (`product_id`, 
															 `language_id`, 
															 `name`, 
															 `description`, 
															 `tag`, 
															 `meta_title`, 
															 `meta_description`, 
															 `meta_keyword`) 
													   VALUE ($prod_id, $lang, '$name', '$descr', '', '$m_title', '$m_descr', '');";	
		return $sql_prod_desc;
	}
}//скобка класса
?>