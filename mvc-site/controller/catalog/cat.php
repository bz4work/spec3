<?php
$objGoods = new Goods();
$selected = array();
if (isset($_POST['menu'][0]) && $_POST['menu'][0] === 'notebook'){
	$goodsArr = $objGoods->getGoods($cat = 5);
	$selected['notebook'] = 'selected';
}elseif (isset($_POST['menu'][0]) && $_POST['menu'][0] === 'smartphone'){
	$goodsArr = $objGoods->getGoods($cat = 10);
	$selected['smartphone'] = 'selected';
}else{
	//если ничего не выбрано из меню - выводим все товары из всех категорий
	$objGoods = new Goods();
	$goodsArr = $objGoods->getGoods($cat = 0);
	$selected['all'] = 'selected';
}

?>