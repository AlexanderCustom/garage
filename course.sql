-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 31 2017 г., 15:37
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `course`
--

-- --------------------------------------------------------

--
-- Структура таблицы `PROJECT`
--

CREATE TABLE `PROJECT` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `PROJECT`
--

INSERT INTO `PROJECT` (`id`, `name`) VALUES
(1, 'FirstProjectOnRubyGarage');

-- --------------------------------------------------------

--
-- Структура таблицы `TASKS`
--

CREATE TABLE `TASKS` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `project_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `TASKS`
--

INSERT INTO `TASKS` (`id`, `name`, `status`, `project_id`) VALUES
(1, 'Add action rename projects and taks', 'performed', 1),
(2, 'Add date of complet', 'performed', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `PROJECT`
--
ALTER TABLE `PROJECT`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `TASKS`
--
ALTER TABLE `TASKS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_project` (`project_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `PROJECT`
--
ALTER TABLE `PROJECT`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `TASKS`
--
ALTER TABLE `TASKS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `TASKS`
--
ALTER TABLE `TASKS`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
