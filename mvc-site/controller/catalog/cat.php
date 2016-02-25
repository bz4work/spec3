<?php
//получаем данные, фильтруем проверяем
//отдаем на обработку
//получаем возвращенные данные
if (isset($_POST['go'], $_POST['menu'][0])){
	//если выбрано что-то из выпадающего меню
	//передаем номер этого "что-то" в запрос
	//и по номеру категории выводим нужный товар из нужной категории
	//$obj = new Goods();//создаем екземпляр класса
	//$goods = $obj->getGoods($_POST['category_number']);//вызываем метод и передаем туда номер категории
	$objGoods = new Goods();
	if ($_POST['menu'][0] == 10){
		$goodsArr = $objGoods->getGoods($cat = 10);
		$select = 10;
	}elseif ($_POST['menu'][0] == 5){
		$goodsArr = $objGoods->getGoods($cat = 5);
		$select = 5;
	}
}else{
	//если ничего не выбрано из меню - выводим все товары из всех категорий
	$objGoods = new Goods();
	$goodsArr = $objGoods->getGoods($cat = 0);
	$select = '';
}

?>