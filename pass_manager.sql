-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Окт 19 2019 г., 01:14
-- Версия сервера: 5.7.27-0ubuntu0.18.04.1
-- Версия PHP: 7.2.23-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pass_manager`
--

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`, `title`, `path`) VALUES
(1, 'folder_1', 'Folder 1', '/'),
(2, 'sub_1', 'Sub 1', 'folder_1'),
(3, 'folder_2', 'Folder 2', '/'),
(5, 'oleg', 'олег', 'folder_2'),
(6, 'ivan', 'иван', 'oleg');

-- --------------------------------------------------------

--
-- Структура таблицы `key`
--

CREATE TABLE `key` (
  `id` int(10) NOT NULL,
  `user` varchar(100) NOT NULL,
  `key` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `key`
--

INSERT INTO `key` (`id`, `user`, `key`) VALUES
(1, 'shepel', '038c3e823c5952aa33ac5f561b9329dc');

-- --------------------------------------------------------

--
-- Структура таблицы `passwd`
--

CREATE TABLE `passwd` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `path` varchar(100) NOT NULL,
  `login` longtext,
  `pass` longtext,
  `link` longtext,
  `note` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `passwd`
--

INSERT INTO `passwd` (`id`, `name`, `title`, `path`, `login`, `pass`, `link`, `note`) VALUES
(1, 'key_1', 'Title 1', '/', '010110111001011011110000110011010100111110100010101001110010101001111101110001101111110001101001100111110001000111011011101100000011111011001000100010100111001011000010110010001010100010100001110010000000010111100000001100011001001000001111110110010110011010011100010011010110101100011110011010111101011011110100100101110000010001101011101011101000101001011011111111101010111101011110000101100011101011100100101000001100011011011001110001100110110', '010110111001011011110000110011010100111110100010101001110010101001111101110001101111110001101001100111110001000111011011101100000011111011001000100010100111001011000010110010001010100010100001110010000000010111100000001100011001001000001111110110010110011010011100010011010110101100011110011010111101011011110100100101110000010001101011101011101000101001011011111111101010111101011110000101100011101011100100101000001100011011011001110001100110110', '010110111001011011110000110011010100111110100010101001110010101001111101110001101111110001101001100111110001000111011011101100000011111011001000100010100111001011000010110010001010100010100001110010000000010111100000001100011001001000001111110110010110011010011100010011010110101100011110011010111101011011110100100101110000010001101011101011101000101001011011111111101010111101011110000101100011101011100100101000001100011011011001110001100110110', '010110111001011011110000110011010100111110100010101001110010101001111101110001101111110001101001100111110001000111011011101100000011111011001000100010100111001011000010110010001010100010100001110010000000010111100000001100011001001000001111110110010110011010011100010011010110101100011110011010111101011011110100100101110000010001101011101011101000101001011011111111101010111101011110000101100011101011100100101000001100011011011001110001100110110'),
(2, 'key_2', 'Title 2', 'folder_1', '010110111001011011110000110011010100111110100010101001110010101001111101110001101111110001101001100111110001000111011011101100000011111011001000100010100111001011000010110010001010100010100001110010000000010111100000001100011001001000001111110110010110011010011100010011010110101100011110011010111101011011110100100101110000010001101011101011101000101001011011111111101010111101011110000101100011101011100100101000001100011011011001110001100110110', '010110111001011011110000110011010100111110100010101001110010101001111101110001101111110001101001100111110001000111011011101100000011111011001000100010100111001011000010110010001010100010100001110010000000010111100000001100011001001000001111110110010110011010011100010011010110101100011110011010111101011011110100100101110000010001101011101011101000101001011011111111101010111101011110000101100011101011100100101000001100011011011001110001100110110', '010110111001011011110000110011010100111110100010101001110010101001111101110001101111110001101001100111110001000111011011101100000011111011001000100010100111001011000010110010001010100010100001110010000000010111100000001100011001001000001111110110010110011010011100010011010110101100011110011010111101011011110100100101110000010001101011101011101000101001011011111111101010111101011110000101100011101011100100101000001100011011011001110001100110110', '010110111001011011110000110011010100111110100010101001110010101001111101110001101111110001101001100111110001000111011011101100000011111011001000100010100111001011000010110010001010100010100001110010000000010111100000001100011001001000001111110110010110011010011100010011010110101100011110011010111101011011110100100101110000010001101011101011101000101001011011111111101010111101011110000101100011101011100100101000001100011011011001110001100110110');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `key`
--
ALTER TABLE `key`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`user`);

--
-- Индексы таблицы `passwd`
--
ALTER TABLE `passwd`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `key`
--
ALTER TABLE `key`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `passwd`
--
ALTER TABLE `passwd`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;