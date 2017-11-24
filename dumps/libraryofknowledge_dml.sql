-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Nov 2017 um 18:18
-- Server-Version: 10.1.13-MariaDB
-- PHP-Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `libraryofknowledge`
--

--
-- Daten für Tabelle `country`
--

INSERT INTO `country` (`country_id`, `country`, `countryShort`) VALUES
(1, 'Schweiz', 'CH');

--
-- Daten für Tabelle `permissions`
--

INSERT INTO `permissions` (`permission_id`, `permission`) VALUES
(1, 'Administrator');

--
-- Daten für Tabelle `posts`
--

INSERT INTO `posts` (`post_id`, `title`, `subTitle`, `content`, `titleImage`, `user_fk`, `postType_fk`, `tstmp`) VALUES
(1, 'Vagrant installation and usage', 'In this article we will explain, what exactly is vagrant, how you install it and how you can use it', 'Vagrant is a tool for building and managing virtual machine environments in a single workflow. With an easy-to-use workflow and focus on automation, Vagrant lowers development environment setup time, increases production parity, and makes the "works on my machine" excuse a relic of the past. If you are already familiar with the basics of Vagrant, the documentation provides a better reference build for all available features and internals.', 'http://tech.osteel.me/images/2015/01/25/vagrant.png', 1, 1, '2017-11-11 17:16:12');

--
-- Daten für Tabelle `posttype`
--

INSERT INTO `posttype` (`postType_id`, `postTypeName`) VALUES
(1, 'Documentation'),
(2, 'Questions');

--
-- Daten für Tabelle `tags`
--

INSERT INTO `tags` (`tags_id`, `tagName`) VALUES
(5, 'PHP'),
(6, 'Web Development');

--
-- Daten für Tabelle `tag_has_posts`
--

INSERT INTO `tag_has_posts` (`tag_has_posts_id`, `tags_fk`, `posts_fk`) VALUES
(1, 5, 1),
(2, 6, 1);

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `firstname`, `surname`, `username`, `password`, `permission_fk`, `country_fk`, `tstmp`) VALUES
(1, 'Dominik', 'OKerwin', 'dokerwin', '1234', 1, 1, '2017-11-11 16:10:06');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
