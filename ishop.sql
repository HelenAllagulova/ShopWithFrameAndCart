-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 04 2016 г., 22:45
-- Версия сервера: 10.1.13-MariaDB
-- Версия PHP: 5.5.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `ishop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `categories_key` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `show_method` int(11) NOT NULL,
  `parent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`categories_key`, `name`, `show_method`, `parent`) VALUES
(1, 'Компьютерная техника', 1, 0),
(2, 'Ноутбуки', 1, 1),
(3, 'Планшеты', 2, 1),
(4, 'ПК', 3, 1),
(5, 'Телефоны', 2, 0),
(6, 'стационарные телефоны', 1, 5),
(7, 'кнопочные', 2, 5),
(8, 'сенсорные', 3, 5),
(9, 'камерофоны', 1, 8),
(10, 'Кухонная техника', 3, 0),
(11, 'Холодильники', 1, 10),
(12, 'Варочные панели', 2, 10),
(13, 'Духовые шкафы', 3, 10),
(14, 'Бытовая техника', 4, 0),
(15, 'Пылесосы', 1, 14),
(16, 'Кондиционеры', 2, 14),
(17, 'Телевизоры', 3, 14),
(18, 'Детские товары', 5, 0),
(19, 'Игрушки', 1, 18),
(20, 'Питание', 2, 18),
(21, 'Памперсы', 3, 18);

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_tovar` int(11) NOT NULL,
  `name_customer` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `date` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id_comment`, `id_tovar`, `name_customer`, `comment`, `date`) VALUES
(41, 1, 'Anna', 'commett to db', '14:07:52'),
(42, 3, 'Pasha', 'second comment to dbase', '14:13:36'),
(43, 2, 'Mila', '3rd com to db with funk serialize', '14:16:11'),
(44, 3, 'Den', 'img with func htmlspesialchars', '14:27:55'),
(45, 3, 'Liza', 'comment with out svyazi', '14:34:46'),
(46, 3, 'den', 'blaaa', '14:46:56'),
(47, 2, 'KATE', ' func htmlspesialschars_decode', '15:29:31'),
(48, 4, 'DEN', 'cool tv', '15:31:32'),
(49, 4, 'Mike', 'isset request idtovar', '15:38:27'),
(50, 3, 'Lili', 'mnogo kartinok', '15:58:14'),
(51, 3, 'Lili', 'kartinki', '16:00:59'),
(52, 2, 'Masha', 'kk', '16:03:16'),
(53, 2, 'KKK', 'qqq', '16:04:30'),
(54, 2, 'masha ', 'bla-bla', '16:28:18'),
(55, 2, 'Anya', 'tekst', '16:30:57'),
(56, 2, 'DEN', 'ne rabotayut commenti', '21:54:01'),
(57, 2, 'Liza', 'g', '22:10:32'),
(58, 2, 'Liza 2 ', 'ggg', '22:21:21'),
(59, 4, 'Helen', 'h', '22:22:24'),
(60, 4, 'Miha', 'lll', '22:23:50'),
(61, 3, 'OLGA', 'ura!!! pishet chitaet comment iz bd', '22:28:26');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id_comment` int(11) NOT NULL,
  `img_path` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id_comment`, `img_path`) VALUES
(45, ';&lt;img src=&#039;../../data/images_for_comments/3/45/image0.jpg&#039;&gt;&lt;img src=&#039;../../d'),
(46, ';'),
(47, '&lt;img src=&#039;../../data/images_for_comments/2/47/image0.jpg&#039;&gt;&lt;img src=&#039;../../da'),
(48, '&lt;img src=&#039;../../data/images_for_comments/4/48/image0.jpg&#039;&gt;'),
(49, '&lt;img src=&#039;../../data/images_for_comments/4/49/image0.jpg&#039;&gt;'),
(50, '&lt;img src=&#039;../../data/images_for_comments/3/50/image0.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/3/50/image1.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/3/50/image2.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/3/50/image3.jpg&#039;&gt;'),
(51, '&lt;img src=&#039;../../data/images_for_comments/3/51/image0.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/3/51/image1.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/3/51/image2.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/3/51/image3.jpg&#039;&gt;'),
(52, ''),
(53, ''),
(54, '&lt;img src=&#039;../../data/images_for_comments/2/54/image0.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/2/54/image1.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/2/54/image2.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/2/54/image3.jpg&#039;&gt;'),
(55, ''),
(56, '&lt;img src=&#039;../../data/images_for_comments/2/56/image0.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/2/56/image1.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/2/56/image2.jpg&#039;&gt;&lt;img src=&#039;../../data/images_for_comments/2/56/image3.jpg&#039;&gt;'),
(57, '&lt;img src=&#039;../../data/images_for_comments/2/57/image0.jpg&#039;&gt;'),
(58, '&lt;img src=&#039;../../data/images_for_comments/2/58/image0.jpg&#039;&gt;'),
(59, '&lt;img src=&#039;../../data/images_for_comments/4/59/image0.jpg&#039;&gt;'),
(60, '&lt;img src=&#039;../../data/images_for_comments/4/60/image0.jpg&#039;&gt;'),
(61, '&lt;img src=&#039;../../data/images_for_comments/3/61/image0.jpg&#039;&gt;');

-- --------------------------------------------------------

--
-- Структура таблицы `tovari`
--

CREATE TABLE `tovari` (
  `categories_key` int(11) NOT NULL,
  `tovari_key` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Price` int(11) NOT NULL,
  `Avaliability` tinyint(1) NOT NULL,
  `show_method` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tovari`
--

INSERT INTO `tovari` (`categories_key`, `tovari_key`, `Name`, `Price`, `Avaliability`, `show_method`) VALUES
(2, 1, 'Lenovo ', 700, 1, 5),
(2, 2, 'ASUS ', 1000, 1, 2),
(2, 3, 'HP', 900, 1, 3),
(2, 4, 'Tablet', 400, 1, 4),
(3, 5, 'Ipad_Mini', 500, 1, 5),
(3, 6, 'Sumsung', 300, 1, 1),
(3, 7, 'Amazon_Fire', 60, 0, 3),
(4, 8, 'Apple', 1500, 1, 1),
(4, 9, 'Brain', 1000, 1, 2),
(4, 10, 'Intel', 700, 1, 3),
(6, 11, 'Home Phone', 30, 1, 1),
(6, 13, 'Station', 10, 1, 2),
(7, 14, 'Nokia', 20, 1, 1),
(7, 16, 'Sony K75', 40, 1, 2),
(7, 17, 'Moto', 30, 1, 3),
(8, 18, 'Lenovo ', 80, 1, 1),
(8, 20, 'Samsung Note', 400, 1, 2),
(8, 21, 'Meizu ', 200, 1, 3),
(8, 22, 'Huawai ', 150, 1, 4),
(8, 23, 'IPhone ', 900, 1, 5),
(9, 24, 'LG M500', 900, 1, 1),
(9, 26, 'Sony Leika L2', 920, 1, 2),
(9, 27, 'Nokia Lumia', 300, 1, 3),
(9, 28, 'LG r200', 800, 1, 4),
(9, 29, 'Samsung Kam3000', 1900, 1, 5),
(11, 30, 'Bosh H33', 400, 1, 1),
(11, 31, 'DELFA DTF-140', 180, 1, 2),
(11, 32, 'INDESIT LI7W', 280, 1, 3),
(11, 33, 'SHARP SJSC680VBE', 1080, 1, 4),
(11, 34, 'GORENJE RK5BW (HZS3369F)', 410, 1, 5),
(12, 35, 'GORENJE G2IX', 160, 1, 1),
(12, 36, 'BEKO HIMG 64225 SX', 260, 1, 2),
(12, 37, 'PYRAMIDA PFG 646 BLACK', 103, 1, 3),
(12, 38, ' LIBERTY P415', 220, 1, 4),
(12, 39, 'HANSA BHGI63112025', 200, 1, 5),
(13, 40, 'GORENJE BO 635 E11XK ', 240, 1, 1),
(13, 41, 'PYRAMIDA F 60 TMR', 210, 1, 2),
(13, 42, 'ZANUSSI ZOB 21601 XK', 320, 1, 3),
(13, 43, 'ELECTROLUX EOA95651AV', 540, 1, 4),
(13, 44, 'BEKO OIM 24500 BR', 360, 1, 5),
(15, 45, 'SAMSUNG VC20F30WNEL/EV', 130, 1, 1),
(15, 46, 'ZELMER VC 7920.0 ST', 210, 1, 2),
(15, 47, 'PHILIPS FC8652/01', 103, 1, 3),
(15, 48, 'THOMAS Perfect Air Animal Pure', 220, 1, 4),
(15, 49, 'ZANUSSI ZANSC00', 70, 1, 5),
(16, 50, 'DELFA ACW 07 C', 150, 1, 1),
(16, 51, 'SAMSUNG AR09HSFN', 650, 1, 2),
(16, 52, 'KAISER KA 3120 Turbo', 250, 1, 3),
(16, 53, ' LG A09AW1', 350, 1, 4),
(16, 54, 'SATURN CS-12', 250, 1, 5),
(17, 55, 'SAMSUNG UE40J5500-AUXUA', 490, 0, 0),
(17, 56, 'LG 32LF580U', 290, 0, 0),
(17, 57, 'BRAVIS LED-40D1070', 260, 0, 0),
(17, 58, 'PHILIPS 55PUН4900/88', 560, 0, 0),
(17, 59, 'SONY KDL-40R553C', 400, 0, 0),
(19, 60, 'Машинка', 20, 1, 0),
(19, 61, 'Черепаха', 22, 1, 0),
(19, 62, 'Паровозик', 10, 1, 0),
(19, 63, 'Микимаус', 30, 1, 0),
(20, 65, 'Агуша', 1, 1, 0),
(20, 66, 'Нянь', 2, 1, 0),
(20, 67, 'Деткам', 1, 1, 0),
(20, 68, 'Палм', 1, 0, 0),
(21, 69, 'Pampers', 16, 0, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_key`),
  ADD KEY `name` (`name`),
  ADD KEY `show_method` (`show_method`),
  ADD KEY `parent` (`parent`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_tovar` (`id_tovar`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD KEY `id_comment` (`id_comment`);

--
-- Индексы таблицы `tovari`
--
ALTER TABLE `tovari`
  ADD PRIMARY KEY (`tovari_key`),
  ADD KEY `categories_key` (`categories_key`),
  ADD KEY `Name` (`Name`),
  ADD KEY `show_method` (`show_method`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблицы `tovari`
--
ALTER TABLE `tovari`
  MODIFY `tovari_key` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
