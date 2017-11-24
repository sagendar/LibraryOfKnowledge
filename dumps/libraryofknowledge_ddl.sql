-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Nov 2017 um 18:16
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
CREATE DATABASE IF NOT EXISTS `libraryofknowledge` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `libraryofknowledge`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `countryShort` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `permission` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `subTitle` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `titleImage` varchar(255) NOT NULL,
  `user_fk` int(11) NOT NULL,
  `postType_fk` int(11) NOT NULL,
  `tstmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posttype`
--

DROP TABLE IF EXISTS `posttype`;
CREATE TABLE `posttype` (
  `postType_id` int(11) NOT NULL,
  `postTypeName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `tags_id` int(11) NOT NULL,
  `tagName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tag_has_posts`
--

DROP TABLE IF EXISTS `tag_has_posts`;
CREATE TABLE `tag_has_posts` (
  `tag_has_posts_id` int(11) NOT NULL,
  `tags_fk` int(11) NOT NULL,
  `posts_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission_fk` int(11) NOT NULL DEFAULT '2',
  `country_fk` int(11) NOT NULL,
  `tstmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indizes für die Tabelle `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_fk` (`user_fk`),
  ADD KEY `postType_fk` (`postType_fk`);

--
-- Indizes für die Tabelle `posttype`
--
ALTER TABLE `posttype`
  ADD PRIMARY KEY (`postType_id`),
  ADD UNIQUE KEY `postTypeName` (`postTypeName`);

--
-- Indizes für die Tabelle `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tags_id`),
  ADD UNIQUE KEY `tagName` (`tagName`);

--
-- Indizes für die Tabelle `tag_has_posts`
--
ALTER TABLE `tag_has_posts`
  ADD PRIMARY KEY (`tag_has_posts_id`),
  ADD KEY `tags_id` (`tags_fk`),
  ADD KEY `posts_id` (`posts_fk`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `permission_fk` (`permission_fk`),
  ADD KEY `country_fk` (`country_fk`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `posttype`
--
ALTER TABLE `posttype`
  MODIFY `postType_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `tags`
--
ALTER TABLE `tags`
  MODIFY `tags_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT für Tabelle `tag_has_posts`
--
ALTER TABLE `tag_has_posts`
  MODIFY `tag_has_posts_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `tag_has_posts`
--
ALTER TABLE `tag_has_posts`
  ADD CONSTRAINT `toPosts` FOREIGN KEY (`posts_fk`) REFERENCES `posts` (`post_id`),
  ADD CONSTRAINT `toTags` FOREIGN KEY (`tags_fk`) REFERENCES `tags` (`tags_id`);

--
-- Constraints der Tabelle `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`permission_fk`) REFERENCES `permissions` (`permission_id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`country_fk`) REFERENCES `country` (`country_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
