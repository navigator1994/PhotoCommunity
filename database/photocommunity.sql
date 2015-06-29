-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Час створення: Чрв 29 2015 р., 13:46
-- Версія сервера: 5.6.15-log
-- Версія PHP: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База даних: `photocommunity`
--

-- --------------------------------------------------------

--
-- Структура таблиці `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `photo_id` int(15) NOT NULL,
  `id` int(15) NOT NULL,
  `text` text NOT NULL,
  `comment_id` int(15) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Дамп даних таблиці `comments`
--

INSERT INTO `comments` (`photo_id`, `id`, `text`, `comment_id`) VALUES
(192, 62, 'nice photo', 31);

-- --------------------------------------------------------

--
-- Структура таблиці `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(15) NOT NULL,
  `link` varchar(255) NOT NULL DEFAULT 'link',
  `like` int(15) NOT NULL,
  `dislike` int(15) NOT NULL,
  `like_id` int(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=195 ;

--
-- Дамп даних таблиці `images`
--

INSERT INTO `images` (`id`, `user_id`, `link`, `like`, `dislike`, `like_id`) VALUES
(189, 62, ' http://photocommunity./Public/UserFiles/Images/62/Chrysanthemum.jpg', 0, 1, 62),
(190, 62, ' http://photocommunity./Public/UserFiles/Images/62/Hydrangeas.jpg', 1, 0, 62),
(191, 62, ' http://photocommunity./Public/UserFiles/Images/62/Jellyfish.jpg', 1, 0, 62),
(192, 62, ' http://photocommunity./Public/UserFiles/Images/62/Penguins.jpg', 1, 0, 62);

-- --------------------------------------------------------

--
-- Структура таблиці `like`
--

CREATE TABLE IF NOT EXISTS `like` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(15) NOT NULL,
  `photo_id` int(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Дамп даних таблиці `like`
--

INSERT INTO `like` (`id`, `user_id`, `photo_id`) VALUES
(47, 62, 189),
(46, 62, 190),
(45, 62, 191),
(44, 62, 192);

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `login` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(15) NOT NULL,
  `surname` varchar(15) NOT NULL,
  `avatar` varchar(128) NOT NULL DEFAULT '/Public/UserFiles/Avatars/simple.jpg',
  `date` date NOT NULL,
  `access` int(1) NOT NULL,
  `email` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=63 ;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `avatar`, `date`, `access`, `email`) VALUES
(62, 'navigator', '2177e0aae75efa8a2f21590d701f7594', 'Anton', 'Smiyuha', 'http://photocommunity/Public/UserFiles/Avatars/Koala.jpg', '1994-12-31', 1, 'navigator@ex.ua');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
