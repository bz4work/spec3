<?php


function __autoload($class_name){
	include "oop/$class_name.class.php";
	//echo "Includes files: $class_name.class.php<br>";
}

class Other {
	//перегрузка конструктора из класса User
	function __construct($a, $b, $c){
		User::__construct($a, $b, $c);
	}
	
	function showInfo(){
		User::showInfo();
	}	
}

echo User::INFO_TITLE;
$user1 = new User ('Vasya','vasil','qwerty123');
$user1->showInfo();
checkObject($user1);
echo $user1;

echo User::INFO_TITLE;
$user2 = clone $user1;
$user2->showInfo();
checkObject($user2);
echo $user2;

echo User::INFO_TITLE;
$user3 = clone $user1;
$user3->showInfo();
checkObject($user3);
echo $user3;

echo User::INFO_TITLE;
$user4 = clone $user1;
$user4->showInfo();
checkObject($user4);
echo $user4;

echo User::INFO_TITLE;
$suser1 = new SuperUser('Super user','root','pass123','root');
$suser1->showInfo();
checkObject($suser1);
echo $suser1;

echo User::INFO_TITLE;
$suser2 = new SuperUser('Super user 2','root','pass123','root');
$suser2->showInfo();
checkObject($suser2);
echo $suser2;

echo User::INFO_TITLE;
$suser3 = new SuperUser('Super_user3','root','pass123','root');
$suser3->showInfo();
checkObject($suser3);
echo $suser3;

echo User::INFO_TITLE;
$suser4 = new SuperUser('Super_user4','root','pass123','root');
$suser4->showInfo();
checkObject($suser4);
echo $suser4;

echo User::INFO_TITLE;
$user5 = new User ('Vasya5','vasil5','qwerty123');
$user5->showInfo();
checkObject($user5);
echo $user5;


echo User::INFO_TITLE;
$user6 = new User ('Vasya6','vasil6','qwerty123');
$user6->showInfo();
checkObject($user6);
echo $user6;

echo User::INFO_TITLE;
$suser5 = new SuperUser('Super_user5','root','pass123','root');
$suser5->showInfo();
checkObject($suser5);
echo $suser5;

echo User::INFO_TITLE;
$suser6 = new SuperUser('Super_user6','root','pass123','root');
$suser6->showInfo();
checkObject($suser6);
echo $suser6;

print('<br>Всего User: '. User::$cntUser);
print('<br>Всего SuperUser: '. SuperUser::$cntSUser);

/////// проверка прнадлежности к классу ///////////
function checkObject($object){
	if ($object instanceOf User){
		if ($object instanceOf SuperUser){
			echo "$object->name - админ<br>";
		}else{
			echo "$object->name - обычный пользователь";
		}
	}else{
		echo "$object->name - неизвестно кто =)";
	}
}


	/*
	ЗАДАНИЕ 15
	- Создайте свойство objNum, которое будет хранить порядковый номер объекта.
	  Подумайте, где лучше его создать?
	- Внесите изменения в классе User (а может и в SuperUser?), которые будут присваивать свойству objNum,
	  порядковый номер объекта.
	  Подумайте, где и как лучше это сделать?
	- В классе User (а может и в SuperUser?) опишите метод __toString()
	- Данный метод должен возвращать строку в формате "Объект #objNum: name".
	  Например: "Объект #3: Василий Пупкин"
	- Попробуйте преобразовать один из созданных Вами объектов в строку
	*/
?>