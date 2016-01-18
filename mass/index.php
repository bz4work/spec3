<?php
error_reporting(-1);
header ('Content-type: text/html; charser=utf-8');
####

$link = mysqli_connect('localhost', 'root', 'rootroot', 'opencart203');

if (!$link){
	die('Ошибка: '.mysqli_connect_errno() . '-'. mysqli_connect_error());
}
//echo 'Соединение установлено... ' . mysqli_get_host_info($link) . "<br><br>";

$_POST['link'] = $link;

function sql_prod ($model, $man, $price){

$model = $_POST['model'];
$man = (int)$_POST['man'];
$price = $_POST['price'];

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
							VALUES
							('$model', '', '', '', '', '', '', '', 939, 7, 'catalog/demo/htc_touch_hd_1.jpg', $man, 1, '$price', 200, 9, '2009-02-03', 146.40000000, 2, 0.00000000, 0.00000000, 0.00000000, 1, 1, 1, 0, 1, 0, '2009-02-03 16:06:50', '2011-09-30 01:05:39')"; 
	return $sql_prod;
}

function sql_prod_attr(){							
$sql_prod_attr = "INSERT INTO `product_attribute` (`product_id`, `attribute_id`, `language_id`, `text`) 
						VALUES (47, 4, 1, '16GB'),(47, 2, 1, '4');";
}


function sql_prod_desc($name, $descr, $m_title, $m_descr){
$mod = $_POST['model'];

########  SELECT   ########
$select_model = "SELECT product_id FROM product WHERE model=$mod;";
$res_inc = mysqli_query($_POST['link'], $select_model);
$prod_id_res = mysqli_fetch_assoc($res_inc);
########  SELECT   ########

$name = $_POST['h1_name'];
$descr = $_POST['text'];
$m_title = $_POST['mtitle'];
$m_descr = $_POST['mdescr'];
$product_id = $prod_id_res['product_id'];

$sql_prod_desc = "INSERT INTO `product_description` (`product_id`, 
													 `language_id`, 
													 `name`, 
													 `description`, 
													 `tag`, 
													 `meta_title`, 
													 `meta_description`, 
													 `meta_keyword`) 
												VALUES
	($product_id, 1, '$name', '$descr', '', '$m_title', '$m_descr', '');";
	
	return $sql_prod_desc;
}

if (isset($_POST['model'])){
	
	$res_product = sql_prod($_POST['model'],$_POST['man'],$_POST['price']);
	$res_descr = sql_prod_desc($_POST['h1_name'],$_POST['text'],$_POST['mtitle'],$_POST['mdescr']);
	
	$res_inc_product = mysqli_query($link, $res_product);
	$res_inc_descr = mysqli_query($link, $res_descr);
	
	if ($res_inc_product){
		echo '1й запрос успешно!<br>';
		if ($res_inc_descr){
			echo '2й успешно!<br>';
			
		}else{
			echo '2й НЕ успешно! Ошибка: '.$link->error;
		}
	}else{
		echo '1й НЕ успешно! Ошибка: '.$link->error;
	}
	
}


//mysqli_close($link);
?>
<br>
<br>
<form action="" method="post">
	
	<input type="text" name="model" value="00001"> model - код товара<br>
	<input type="text" name="man" value="7"> manufactured<br>
	<input type="text" name="price" value="1500"> price<br>
	<!-- ----- --><hr>
	<input type="text" name="h1_name" value="Аккумулятор "> name-h1<br>
	<textarea name="text" cols="20" rows="7"></textarea> text-descr<br>
	<input type="text" name="mtitle" value=""> meta-title<br>
	<input type="text" name="mdescr" value=""> meta-descr<br>
	<hr>

	<input type="submit" name="submit" value="GO">
<form>