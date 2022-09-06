-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 06 2022 г., 10:40
-- Версия сервера: 10.4.24-MariaDB
-- Версия PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `resto`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `name`, `value`) VALUES
(1, 'login', 'admin'),
(2, 'password', '$2y$10$SJgWjEVsmn1oNID7QV29Su2FPYH1jX059b7XwPFbJlz135l1dEtgS');

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(16) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` varchar(16) NOT NULL DEFAULT 'regular'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `title`, `description`, `price`, `image`, `type`) VALUES
(2, 'Пицца с беконом', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi, accusantium.', '12.99', 'storage/menu-1.jpg', 'regular'),
(4, 'Гамбургер', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum placeat facilis, consequuntur, voluptate quidem atque neque sed.', '10.99', 'storage/menu-2.jpg', 'regular'),
(12, 'Мороженое', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit.', '3.99', 'storage/menu-4.jpg', 'regular'),
(23, 'Сладкие блины', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facere quia vel nemo ullam adipisci.', '4.99', 'storage/menu-3.jpg', 'regular'),
(24, 'Ягодный торт', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas laoreet varius ligula quis lacinia.', '7.99', 'storage/menu-5.jpg', 'regular'),
(25, 'Кексы', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fermentum lorem id elit maximus, eget.', '4.99', 'storage/menu-6.jpg', 'regular'),
(26, 'Коктейли', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit amet lorem nec tellus lobortis.', '5.99', 'storage/menu-7.jpg', 'regular'),
(27, 'Мюсли с ягодами', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec finibus vestibulum enim, id laoreet nisi.', '3.99', 'storage/menu-8.jpg', 'regular'),
(28, 'Апельсиновый фреш', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed commodo velit ante.', '1.99', 'storage/menu-9.jpg', 'regular'),
(29, 'Спагетти', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vitae viverra neque, a pretium dui.', '6.99', 'storage/home-img-1.png', 'special'),
(30, 'Запечённая курица', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam aliquam fermentum justo, sed ornare augue pulvinar eget.', '8.99', 'storage/home-img-2.png', 'special'),
(31, 'Итальянская пицца', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent quis malesuada turpis. Nam quis elit.', '13.99', 'storage/home-img-3.png', 'special');

-- --------------------------------------------------------

--
-- Структура таблицы `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `options`
--

INSERT INTO `options` (`id`, `name`, `value`) VALUES
(1, 'site_name', 'resto'),
(2, 'phone', '+123-456-7890'),
(3, 'email', 'example@gmail.com'),
(4, 'facebook_link', 'https://www.facebook.com/'),
(5, 'instagram_link', 'https://www.instagram.com/'),
(6, 'vk_link', 'https://vk.com/'),
(7, 'about_title', 'Самая лучшая еда в городе'),
(8, 'about_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer sollicitudin mi in nisl scelerisque imperdiet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque vel diam sed turpis condimentum imperdiet nec quis massa. Aenean a eros porttitor, feugiat nulla at, iaculis turpis. Nulla eu rutrum duis.'),
(9, 'about_image', 'storage/about-img.png');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `sum` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `adress`, `text`, `sum`) VALUES
(7, 'Николай', '+123-456-7890', 'ул. Пушкина, д. 89', 'Апельсиновый фреш - 1, Пицца с беконом - 2, Гамбургер - 1', 38.96),
(8, 'Мария', '+234-567-8901', 'ул. Лермонтова, д. 12', 'Запечённая курица - 1, Коктейли - 1, Мюсли с ягодами - 1', 18.97),
(9, 'Дмитрий', '+345-678-9012', 'пр. Мира, д. 118', 'Кексы - 1, Сладкие блины - 2', 14.97),
(10, 'Александр', '+456-789-0123', 'ул. Лесная, д. 5', 'Мороженое - 4, Кексы - 3, Ягодный торт - 7', 86.86);

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `text` text NOT NULL,
  `stars` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `text`, `stars`, `image`) VALUES
(2, 'Мария Дмитриева', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit fugiat consequuntur repellendus aperiam deserunt nihil, corporis fugit voluptatibus voluptate totam neque illo placeat eius quis laborum aspernatur quibusdam. Ipsum, magni.', 4, 'storage/pic-2.png'),
(3, 'Михаил Лазарев', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac enim tincidunt, auctor urna nec, dignissim dolor. Etiam ac rhoncus nisi. Phasellus efficitur neque id nulla malesuada euismod. Nunc laoreet ligula a eros commodo egestas.', 5, 'storage/pic-3.png'),
(4, 'Алиса Иванова', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ut nibh leo. Vivamus sit amet facilisis justo. Nulla iaculis, mi sed luctus semper, mi ligula mollis metus, sit amet fringilla nulla sem vel nibh. Praesent.', 5, 'storage/pic-4.png'),
(8, 'Дмитрий Ульянов', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vitae sapien bibendum, commodo justo ac, molestie ex. Vivamus facilisis facilisis augue, et porta massa. Duis imperdiet vitae odio tristique laoreet.', 3, 'storage/pic-1.png');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
