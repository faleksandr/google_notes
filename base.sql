-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 14 2017 г., 01:11
-- Версия сервера: 5.5.53
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`) VALUES
(1, 'Task', 0),
(2, 'Sport', 0),
(3, 'News', 0),
(4, 'Technologies', 0),
(5, 'Important', 1),
(6, 'Other', 1),
(7, 'Work', 5),
(8, 'Friends', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `categories_notes`
--

CREATE TABLE `categories_notes` (
  `id` int(11) NOT NULL,
  `notes_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories_notes`
--

INSERT INTO `categories_notes` (`id`, `notes_id`, `category_id`) VALUES
(1, 4, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `events`
--

INSERT INTO `events` (`id`, `user`, `user_id`, `text`, `date`) VALUES
(1, 'alex', 0, 'добро пожаловать в систему', 1484343488),
(2, 'goodman', 0, 'добро пожаловать в систему', 1484344357),
(3, 'goodman', 0, 'установлена новая ссылка для google calendar', 1484344368);

-- --------------------------------------------------------

--
-- Структура таблицы `mailing_list`
--

CREATE TABLE `mailing_list` (
  `id` int(11) NOT NULL,
  `theme` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `html` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mailing_list`
--

INSERT INTO `mailing_list` (`id`, `theme`, `text`, `html`, `date`) VALUES
(1, 'Новые акции и бонусы', 'Посетите наш сайт для получения информации.', '<div style=\"font-size:16px;font-family:Arial, Helvetica;\">Посетите наш сайт для получения информации.</div>', 1484344042);

-- --------------------------------------------------------

--
-- Структура таблицы `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `tags` text,
  `date` int(11) DEFAULT '0',
  `visibility` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `notes`
--

INSERT INTO `notes` (`id`, `author`, `author_id`, `name`, `text`, `img`, `tags`, `date`, `visibility`) VALUES
(1, 'alex', 1, 'Новая заметка о спорте', 'Спорт - это полезно!', 'http://images.com/img.png', 'sport', 1484320635, 0),
(2, 'alex', 1, 'Нужно покормить кота', 'Корм на полочке', 'http://images.com/cat.png', 'cat ', 1484321289, 0),
(3, 'alex', 1, 'Создать новый модуль', 'Главное почитать документацию', 'http://images.com/module.png', 'php', 1484335440, 1),
(4, 'goodman', 2, 'Планирую сходить в кафе', 'Нужно будет кого-нибудь позвать, чтобы поднять настроение', 'http://images.com/smile.png', 'friends rest', 1484344637, 100);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admins'),
(2, 'moderators'),
(3, 'users'),
(4, 'vips');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` tinyint(1) DEFAULT '3',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `calendar_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enable_mail` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `role`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `calendar_id`, `enable_mail`) VALUES
(1, 'alex', 1, 'vFkMNnC1oiPd0CHXAwGyOd4csnbudkdK', '$2y$13$fbuZToANXOR3W3lRTHZnJueq4TjfiEkedRcdfORfxrwqdj9MjSm8G', NULL, 'alexfyodrv@gmail.com', 10, 1484343488, 1484343488, NULL, NULL),
(2, 'goodman', 3, 't09gcaiwVyEPEdrLEngL6DojcxlAmq0l', '$2y$13$TwvE0YLjv/8k6Uk9.fRv3eeZtYtGY4OyjCTdeK.Q3bd2BTemLN04O', NULL, 'goodman@mail.com', 10, 1484344357, 1484344357, 'https://calendar.google.com/calendar/embed?src=80cr13idvbhc2hfv2b2e2hfi7s%40group.calendar.google.com&ctz=Europe/Kiev', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories_notes`
--
ALTER TABLE `categories_notes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `mailing_list`
--
ALTER TABLE `mailing_list`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `categories_notes`
--
ALTER TABLE `categories_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
