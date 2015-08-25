-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 24 Sty 2011, 17:02
-- Wersja serwera: 5.1.41
-- Wersja PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `mydb`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `catalogs`
--

CREATE TABLE IF NOT EXISTS `catalogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE utf8_bin NOT NULL,
  `path` varchar(100) COLLATE utf8_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_albums_users1` (`users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=144 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `catalogs_id` int(11) NOT NULL,
  `filename` varchar(45) COLLATE utf8_bin NOT NULL,
  `filesize` varchar(45) COLLATE utf8_bin NOT NULL,
  `mimeType` varchar(45) COLLATE utf8_bin NOT NULL,
  `height` varchar(45) COLLATE utf8_bin NOT NULL,
  `width` varchar(45) COLLATE utf8_bin NOT NULL,
  `dateTimeOriginal` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `make` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `model` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `orientation` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `xResolution` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `yResolution` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `exposureTime` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `exposureProgram` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `exposureMode` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `fNumber` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `focalLength` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `isoSpeedRatings` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `lightSource` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `whiteBalance` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `flash` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `digitalZoomRatio` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `gpsLatitudeRef` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `gpsLatitude` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `gpsLongitudeRef` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `gpsLongitude` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `headline` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `caption` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `writer` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `copyrightNotice` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `contact` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `objectName` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `byLineTitle` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `city` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `subLocation` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `province` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `countryCode` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `keywords` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `catalogs_id` (`catalogs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=614 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla  `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_bin NOT NULL,
  `password` varchar(32) COLLATE utf8_bin NOT NULL,
  `email` varchar(45) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(25) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(25) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17 ;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `catalogs`
--
ALTER TABLE `catalogs`
  ADD CONSTRAINT `catalogs_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`catalogs_id`) REFERENCES `catalogs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
