<?php
header ('Content-type: text/html; charset=windows-1251');
function last_prod_id(){
	
}

function sql_prod ($model, $man, $price){
$sort_order = 99;//сортировка
$quan = 1000;//количество на складе
$stock = 7; //есть в наличии
$status = 0;//1 - включено на сайте, 0 - выключено
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
$res_inc_product = mysqli_query($_POST['link'], $sql_prod);

if ($res_inc_product)
	return true;
else
	return $errMsg = $_POST['link']->error;
}

function sql_prod_attr($ah, $polar, $korpus, $sizes, $tok){
########  SELECT product_id  ##########################################################
$select_prod_id = "SELECT product_id FROM product ORDER BY product_id DESC LIMIT 1";
$res_inc = mysqli_query($_POST['link'], $select_prod_id);
$prod_id_res = mysqli_fetch_assoc($res_inc);
$prod_id = $prod_id_res['product_id'];
########  SELECT product_id  ##########################################################			
$attr_id = 0;//id атрибута
$lang = 2;//язык, русский - 2

$sql_prod_attr = "INSERT INTO `product_attribute` (`product_id`, `attribute_id`, `language_id`, `text`) 
						VALUES ($prod_id, 12, $lang, '$ah'),
								($prod_id, 13, $lang, '$polar'),
								($prod_id, 14, $lang, '$korpus'),
								($prod_id, 15, $lang, '$sizes'),
								($prod_id, 16, $lang, '$tok');";
$res_inc_attr = mysqli_query($_POST['link'], $sql_prod_attr);
if ($res_inc_attr)
	return true;
else
	return $errMsg = $_POST['link']->error;
}

function sql_prod_cat(){
########  SELECT product_id  ##########################################################
$select_model = "SELECT product_id FROM product ORDER BY product_id DESC LIMIT 1";
$res_inc = mysqli_query($_POST['link'], $select_model);
$prod_id_res = mysqli_fetch_assoc($res_inc);
$prod_id = $prod_id_res['product_id'];
########  SELECT product_id  ##########################################################
$cat_id = 59;//авто аккумуляторы
$sql_prod_cat = "INSERT INTO `product_to_category` (`product_id`, `category_id`) 
						VALUES ($prod_id, $cat_id);";
$res_inc_cat = mysqli_query($_POST['link'], $sql_prod_cat);
if ($res_inc_cat)
	return true;
else
	return $errMsg = $_POST['link']->error;
}

function sql_prod_layout(){
########  SELECT product_id  ##########################################################
$select_model = "SELECT product_id FROM product ORDER BY product_id DESC LIMIT 1";
$res_inc = mysqli_query($_POST['link'], $select_model);
$prod_id_res = mysqli_fetch_assoc($res_inc);
$prod_id = $prod_id_res['product_id'];
########  SELECT product_id  ##########################################################
$store = 0;//магазин по-умолчанию
$lay = 0;//по-умолчанию 0
$sql_prod_lay = "INSERT INTO `product_to_layout` (`product_id`, `store_id`, `layout_id`) 
						VALUES ($prod_id, $store, $lay);";
$res_inc_lay = mysqli_query($_POST['link'], $sql_prod_lay);
if ($res_inc_lay)
	return true;
else
	return $errMsg = $_POST['link']->error;
}

function sql_prod_store(){
########  SELECT product_id  ##########################################################
$select_model = "SELECT product_id FROM product ORDER BY product_id DESC LIMIT 1";
$res_inc = mysqli_query($_POST['link'], $select_model);
$prod_id_res = mysqli_fetch_assoc($res_inc);
$prod_id = $prod_id_res['product_id'];
########  SELECT product_id  ##########################################################
$store = 0;//магазин по-умолчанию
$sql_prod_store = "INSERT INTO `product_to_store` (`product_id`, `store_id`) 
						VALUES ($prod_id, $store);";
$res_inc_store = mysqli_query($_POST['link'], $sql_prod_store);
if ($res_inc_store)
	return true;
else
	return $errMsg = $_POST['link']->error;
}

function sql_prod_desc($name, $descr, $m_title, $m_descr){
########  SELECT product_id  ##########################################################
$select_model = "SELECT product_id FROM product ORDER BY product_id DESC LIMIT 1";
$res_inc = mysqli_query($_POST['link'], $select_model);//($_POST['link'], $select_model);
$prod_id_res = mysqli_fetch_assoc($res_inc);
$product_id = $prod_id_res['product_id'];
########  SELECT product_id  ##########################################################
$lang = 1;//язык: 1-english; 2-русский;
$sql_prod_desc = "INSERT INTO `product_description` (`product_id`, 
													 `language_id`, 
													 `name`, 
													 `description`, 
													 `tag`, 
													 `meta_title`, 
													 `meta_description`, 
													 `meta_keyword`) 
											   VALUE ($product_id, $lang, '$name', '$descr', '', '$m_title', '$m_descr', '');";	
$res_inc_descr = mysqli_query($_POST['link'], $sql_prod_desc);
if ($res_inc_descr)
	return true;
else
	return $errMsg = $_POST['link']->error;
}
?>