-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 16 2025 г., 20:20
-- Версия сервера: 10.6.23-MariaDB
-- Версия PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `coffepoint`
--

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE `goods` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `price` int(11) NOT NULL,
  `img_path` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `title`, `description`, `price`, `img_path`) VALUES
(1, 'Капучино', 'Эспрессо с нежной молочной пенкой — классика кофейного меню.', 299, 'assets/images/капучино.jpg'),
(2, 'Латте', 'Мягкий эспрессо с большим количеством молока и тонким слоем пенки.', 329, 'assets/images/латте.png'),
(3, 'Американо', 'Крепкий эспрессо, разбавленный горячей водой — для ценителей чистого вкуса кофе.', 249, 'assets/images/американо.jpg'),
(4, 'Эспрессо', 'Насыщенный, крепкий и ароматный — основа всех кофейных напитков.', 219, 'assets/images/эспрессо.png'),
(5, 'Мокко', 'Эспрессо с шоколадом, молоком и взбитыми сливками — сладкое наслаждение.', 359, 'assets/images/мокко.png'),
(6, 'Флэт Уайт', 'Двойной эспрессо с микропенкой — насыщенный вкус и бархатистая текстура.', 349, 'assets/images/флэт.webp'),
(7, 'Раф', 'Эспрессо с ванильным сиропом и сливками, взбитыми до воздушной текстуры.', 379, 'assets/images/раф.jpg'),
(8, 'Кофе по-венски', 'Эспрессо с взбитыми сливками и шоколадной стружкой — элегантная классика.', 369, 'assets/images/венское.webp'),
(9, 'Карамельный Макиато', 'Эспрессо с молоком, ванильным сиропом и карамельным топпингом.', 389, 'assets/images/макиато.jpg'),
(10, 'Холодный Латте', 'Освежающий латте со льдом — идеален в жаркий день.', 339, 'assets/images/айслатте.png'),
(11, 'Аффогато', 'Эспрессо, «утопленный» в шарик ванильного мороженого — десерт и кофе в одном.', 399, 'assets/images/аффогато.png'),
(12, 'Кофе с корицей', 'Тёплый эспрессо с молоком и щепоткой корицы — уютный аромат дома.', 289, 'assets/images/корица.png'),
(13, 'Овсяный Латте', 'Эспрессо с овсяным молоком — веганский выбор с нежным ореховым привкусом.', 359, 'assets/images/овсянка.png'),
(14, 'Двойной Эспрессо', 'Два шота крепкого кофе для настоящих ценителей бодрости.', 269, 'assets/images/двойной.png'),
(15, 'Какао', 'Густой, тёплый и ароматный какао из натурального порошка с молоком.', 279, 'assets/images/какао.png');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL COMMENT 'ID юзера',
  `gid` int(11) NOT NULL COMMENT 'ID товара',
  `status` enum('В обработке','Готовится','Готов к выдаче','Завершен') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `age` int(2) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `status` enum('Новый клиент','Частый клиент','Постоянный клиент','VIP') NOT NULL,
  `img_path` varchar(250) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `firstname`, `surname`, `email`, `age`, `phone`, `status`, `img_path`, `created_at`) VALUES
(1, 'test', '123', 'Дмитрий', 'Шаповалов', 'dima@mail.ru', 21, '89044442211', 'Новый клиент', NULL, '2025-10-16');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD KEY `uid` (`uid`),
  ADD KEY `gid` (`gid`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `goods`
--
ALTER TABLE `goods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`gid`) REFERENCES `goods` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
