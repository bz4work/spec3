-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.10-log - MySQL Community Server (GPL)
-- ОС Сервера:                   Win64
-- HeidiSQL Версия:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры базы данных mvc-site
CREATE DATABASE IF NOT EXISTS `mvc-site` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `mvc-site`;


-- Дамп структуры для таблица mvc-site.goods
CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `opisanie` text,
  `category` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` text,
  `title` text,
  `h1` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы mvc-site.goods: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `goods` DISABLE KEYS */;
INSERT INTO `goods` (`id`, `name`, `opisanie`, `category`, `price`, `image`, `title`, `h1`) VALUES
	(1, 'Lenovo A820 (black) 8gb', 'Аккумулятор с азиатским корпусом, ёмкостью 35A/h, пусковым током 240А, полярностью R+(плюс справа) и габаритными размерами: длина - 187мм, ширина - 127мм и высота - 220мм. АКБ с повышенной безопасностью, имеет газоотводную систему и встроенный пламегаситель. Для удобства переноса на батарее предусмотрена удобная ручка.', 10, 2500, '/img/smart/a820.jpg', 'Мобильный Телефон Lenovo A820 (black) 8gb', 'Смартфон Lenovo A820 (black) 8gb'),
	(2, 'Lenovo G870 (red) 16gb', 'Аккумулятор с азиатским корпусом, ёмкостью 35A/h, пусковым током 240А, полярностью R+(плюс справа) и габаритными размерами: длина - 187мм, ширина - 127мм и высота - 220мм. АКБ с повышенной безопасностью, имеет газоотводную систему и встроенный пламегаситель. Для удобства переноса на батарее предусмотрена удобная ручка.', 10, 999, '/img/smart/g870.jpg', 'Мобильный Телефон Lenovo G870 (red) 16gb', 'Смартфон Lenovo G870 (red) 16gb'),
	(3, 'Lenovo Vibe X7', 'Аккумулятор с азиатским корпусом, ёмкостью 35A/h, пусковым током 240А, полярностью R+(плюс справа) и габаритными размерами: длина - 187мм, ширина - 127мм и высота - 220мм. АКБ с повышенной безопасностью, имеет газоотводную систему и встроенный пламегаситель. Для удобства переноса на батарее предусмотрена удобная ручка.', 10, 12500, '/img/smart/vibex7.jpg', 'Мобильный Телефон Lenovo Vibe X7', 'Смартфон Lenovo Vibe X7'),
	(4, 'Lenovo Vibe X5', 'Аккумулятор с азиатским корпусом, ёмкостью 35A/h, пусковым током 240А, полярностью R+(плюс справа) и габаритными размерами: длина - 187мм, ширина - 127мм и высота - 220мм. АКБ с повышенной безопасностью, имеет газоотводную систему и встроенный пламегаситель. Для удобства переноса на батарее предусмотрена удобная ручка.', 5, 19999, '/img/smart/vibex7.jpg', 'Мобильный Телефон Lenovo Vibe X7', 'Смартфон Lenovo Vibe X7');
/*!40000 ALTER TABLE `goods` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
