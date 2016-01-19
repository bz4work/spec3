<?php
function sql_prod ($model, $man, $price){
//$model = $_POST['model'];
//$man = (int)$_POST['man'];
//$price = $_POST['price'];
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
							VALUES ('$model', '', '', '', '', '', '', '', 939, 7, '', $man, 1, '$price', 0, 0, '2009-02-03', 1, 1, 0.00000000, 0.00000000, 0.00000000, 1, 1, 1, 1, 1, 0, '2009-02-03 16:06:50', '2011-09-30 01:05:39')"; 
return $sql_prod;
}

function sql_prod_attr(){							
$sql_prod_attr = "INSERT INTO `product_attribute` (`product_id`, `attribute_id`, `language_id`, `text`) 
						VALUES (47, 4, 1, '16GB'),(47, 2, 1, '4');";
}

function sql_prod_desc($name, $descr, $m_title, $m_descr){
########  SELECT product_id  ##########################################################
$select_model = "SELECT product_id FROM product ORDER BY product_id DESC LIMIT 1";    #
$res_inc = mysqli_query($_POST['link'], $select_model);                               #
$prod_id_res = mysqli_fetch_assoc($res_inc);                                          #
$product_id = $prod_id_res['product_id'];                                             #
########  SELECT product_id  ##########################################################

//$name = $_POST['h1_name'];
//$descr = $_POST['text'];
//$m_title = $_POST['mtitle'];
//$m_descr = $_POST['mdescr'];

$sql_prod_desc = "INSERT INTO `product_description` (`product_id`, 
													 `language_id`, 
													 `name`, 
													 `description`, 
													 `tag`, 
													 `meta_title`, 
													 `meta_description`, 
													 `meta_keyword`) 
											   VALUE ($product_id, 1, '$name', '$descr', '', '$m_title', '$m_descr', '');";	
return $sql_prod_desc;
}
?>