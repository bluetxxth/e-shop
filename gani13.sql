-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2013 at 09:01 AM
-- Server version: 5.5.31-0+wheezy1
-- PHP Version: 5.4.4-14+deb7u5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `MedlemDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `Deltar`
--

CREATE TABLE IF NOT EXISTS `Deltar` (
  `Medlem` int(11) NOT NULL,
  `Sektion` char(1) NOT NULL,
  PRIMARY KEY (`Medlem`,`Sektion`),
  KEY `Sektion` (`Sektion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Deltar`
--

INSERT INTO `Deltar` (`Medlem`, `Sektion`) VALUES
(1, 'A'),
(3, 'A'),
(1, 'B'),
(1, 'C'),
(2, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `Medlem`
--

CREATE TABLE IF NOT EXISTS `Medlem` (
  `Mnr` int(11) NOT NULL,
  `Namn` varchar(6) DEFAULT NULL,
  `Telefon` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Mnr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Medlem`
--

INSERT INTO `Medlem` (`Mnr`, `Namn`, `Telefon`) VALUES
(1, 'Olle', '260088'),
(2, 'Stina', '282677'),
(3, 'Saddam', '260088'),
(4, 'Lotta', '174590');

-- --------------------------------------------------------

--
-- Table structure for table `Sektion`
--

CREATE TABLE IF NOT EXISTS `Sektion` (
  `Skod` char(1) NOT NULL,
  `Namn` varchar(14) DEFAULT NULL,
  `Ledare` int(11) DEFAULT NULL,
  PRIMARY KEY (`Skod`),
  KEY `Ledare` (`Ledare`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Sektion`
--

INSERT INTO `Sektion` (`Skod`, `Namn`, `Ledare`) VALUES
('A', 'Bowling', 4),
('B', 'Kickboxing', 4),
('C', 'Konstsim', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Deltar`
--
ALTER TABLE `Deltar`
  ADD CONSTRAINT `Deltar_ibfk_1` FOREIGN KEY (`Medlem`) REFERENCES `Medlem` (`Mnr`),
  ADD CONSTRAINT `Deltar_ibfk_2` FOREIGN KEY (`Sektion`) REFERENCES `Sektion` (`Skod`);

--
-- Constraints for table `Sektion`
--
ALTER TABLE `Sektion`
  ADD CONSTRAINT `Sektion_ibfk_1` FOREIGN KEY (`Ledare`) REFERENCES `Medlem` (`Mnr`);
--
-- Database: `Movie`
--

-- --------------------------------------------------------

--
-- Table structure for table `Content`
--

CREATE TABLE IF NOT EXISTS `Content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` char(80) DEFAULT NULL,
  `url` char(80) DEFAULT NULL,
  `user` char(20) DEFAULT NULL,
  `TYPE` char(80) DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  `DATA` text,
  `FILTER` char(80) DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `Content`
--

INSERT INTO `Content` (`id`, `slug`, `url`, `user`, `TYPE`, `title`, `DATA`, `FILTER`, `published`, `created`, `updated`, `deleted`) VALUES
(1, 'hem', 'hem', 'admin', 'page', 'Hem', 'Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter nl2br som lägger in <br>-element istället för \n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.', 'bbcode,nl2br', '2013-12-12 11:20:14', '2013-12-12 11:20:14', NULL, NULL),
(2, 'om', 'om', 'admin', 'page', 'Om', 'Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.', 'markdown', '2013-12-12 11:20:14', '2013-12-12 11:20:14', NULL, NULL),
(3, 'blogpost-1', NULL, 'admin', 'post', 'Välkommen till min blogg!', 'Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.', 'link,nl2br', '2013-12-12 11:20:14', '2013-12-12 11:20:14', NULL, NULL),
(4, 'blogpost-2', NULL, 'admin', 'post', 'Nu har sommaren kommit', 'Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.', 'nl2br', '2013-12-12 11:20:14', '2013-12-12 11:20:14', NULL, NULL),
(5, 'blogpost-3', NULL, 'admin', 'post', 'Nu har hösten kommit', 'Detta är en bloggpost som berättar att hösten har kommit, ett budskap som kräver en bloggpost', 'nl2br', '2013-12-12 11:20:14', '2013-12-12 11:20:14', NULL, NULL),
(6, 'blogpost-4', '', 'admin', 'post', 'test 1', 'test 4', 'nl2br', '2013-12-09 12:29:27', '2013-12-12 11:21:27', '2013-12-12 11:21:27', NULL),
(7, 'blogpost-5', NULL, 'admin', 'post', 'test 2', 'test 5', 'nl2br', '2013-11-22 12:29:27', '2010-12-06 06:00:00', NULL, NULL),
(8, '', 'page.php', 'admin', 'post', 'test 3', 'page test', 'bbcode,nl2br', '2013-12-09 12:29:27', '2013-12-12 11:22:21', '2013-12-12 11:22:21', NULL),
(9, 'blogpost-7', NULL, 'admin', 'post', 'test 6', 'test 7', 'nl2br', '2013-11-22 12:29:27', '2013-11-04 12:29:27', NULL, NULL),
(17, 'blogpost-8', NULL, 'admin', 'post', 'test 7', 'test blogpost 8', 'nl2br', '2013-11-22 12:29:27', '2010-12-06 06:00:00', NULL, NULL),
(20, 'blogpost-9', NULL, 'admin', 'post', 'test 8', 'test blogpost 8', 'nl2br', '2013-12-09 12:29:27', '2013-11-22 12:29:27', NULL, NULL),
(21, 'blogpost-10', NULL, 'admin', 'post', ' test 9', 'test blogpost 10', 'nl2br', '2013-12-09 12:29:27', '2013-11-04 12:29:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Movie`
--

CREATE TABLE IF NOT EXISTS `Movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `director` varchar(100) DEFAULT NULL,
  `LENGTH` int(11) DEFAULT NULL,
  `YEAR` int(11) NOT NULL DEFAULT '1900',
  `plot` text,
  `image` varchar(100) DEFAULT NULL,
  `subtext` char(3) DEFAULT NULL,
  `speech` char(3) DEFAULT NULL,
  `quality` char(20) DEFAULT NULL,
  `genre` char(50) DEFAULT NULL,
  `format` char(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `Movie`
--

INSERT INTO `Movie` (`id`, `title`, `director`, `LENGTH`, `YEAR`, `plot`, `image`, `subtext`, `speech`, `quality`, `genre`, `format`) VALUES
(1, 'Pulp fiction', NULL, NULL, 1994, NULL, 'img/movie/pulp-fiction.jpg', NULL, NULL, 'good', 'comedy, drama, thriller', NULL),
(2, 'American Pie', NULL, NULL, 1999, NULL, 'img/movie/american-pie.jpg', NULL, NULL, 'okay', 'comedy,romance,college', NULL),
(3, 'Pokémon The Movie 2000', NULL, NULL, 1999, NULL, 'img/movie/pokemon.jpg', NULL, NULL, 'okay', 'animation,adventure,family', NULL),
(4, 'Kopps', NULL, NULL, 2003, NULL, 'img/movie/kopps.jpg', NULL, NULL, 'good', 'comedy,family,svenskt,action', NULL),
(5, 'From Dusk Till Dawn', NULL, NULL, 1996, NULL, 'img/movie/from-dusk-till-dawn.jpg', NULL, NULL, 'okay', 'crime,action,horror', NULL),
(6, 'Goodfellas', NULL, NULL, 1990, NULL, 'img/movie/goodfellas.jpg', NULL, NULL, 'great', 'crime, drama', NULL),
(7, 'Alien', NULL, NULL, 1979, NULL, 'img/movie/alien.jpg', NULL, NULL, 'very good', 'crime,action,horror', NULL),
(8, 'Das-boot', NULL, NULL, 1981, NULL, 'img/movie/das-boot.jpg', NULL, NULL, 'great', 'action, adventure, drama', NULL),
(9, 'Dracula', NULL, NULL, 1992, NULL, 'img/movie/dracula.jpg', NULL, NULL, 'very good', 'drama,fantasy,horror', NULL),
(10, 'Europa Report ', NULL, NULL, 2013, NULL, 'img/movie/europa-report.jpg', NULL, NULL, 'very good', 'horror,sci-fi, thriller', NULL),
(11, 'Full Metal Jacket', NULL, NULL, 1987, NULL, 'img/movie/full-metal-jacket.jpg', NULL, NULL, 'great', 'drama,war', NULL),
(12, 'Immortal Beloved', NULL, NULL, 1994, NULL, 'img/movie/immortal-beloved.jpg', NULL, NULL, 'good', 'biography,drama,music', NULL),
(13, 'Motorcycle Diaries', NULL, NULL, 2004, NULL, 'img/movie/motorcycle-diaries.jpg', NULL, NULL, 'very good', 'biography, drama', NULL),
(14, 'Pale Rider', NULL, NULL, 1985, NULL, 'img/movie/pale-rider.jpg', NULL, NULL, 'very-good', 'western', NULL),
(15, 'Pandorum', NULL, NULL, 2009, NULL, 'img/movie/pandorum.jpg', NULL, NULL, 'good', 'horror, sci-fi', NULL),
(16, 'Prometeus', NULL, NULL, 2012, NULL, 'img/movie/prometeus.jpg', NULL, NULL, 'very-good', 'adventure, mystery, sci-fi', NULL),
(17, 'Seraphim Falls', NULL, NULL, 2006, NULL, 'img/movie/seraphim-falls.jpg', NULL, NULL, 'very-good', 'western', NULL),
(18, 'Stalingrad', NULL, NULL, 1993, NULL, 'img/movie/stalingrad.jpg', NULL, NULL, 'very-good', 'history, drama, war', NULL),
(19, 'The Thing', NULL, NULL, 1982, NULL, 'img/movie/the-thing.jpg', NULL, NULL, 'very-good', 'horror, mystery, sci-fi', NULL),
(20, 'The Thing', NULL, NULL, 2011, NULL, 'img/movie/the-thing-2011.jpg', NULL, NULL, 'very-good', 'horror, mystery, sci-fi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE IF NOT EXISTS `USER` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acronym` char(12) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `salt` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `acronym` (`acronym`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`id`, `acronym`, `name`, `password`, `salt`) VALUES
(1, 'doe', 'John/Jane Doe', '279fba226ca4c2d0ec0fa66037065523', 1385042948),
(2, 'admin', 'Administrator', '1b8e3492bdab79e574bf9637dc2de218', 1385042948);
--
-- Database: `Test`
--
--
-- Database: `gani13`
--

-- --------------------------------------------------------

--
-- Table structure for table `Content`
--

CREATE TABLE IF NOT EXISTS `Content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` char(80) DEFAULT NULL,
  `url` char(80) DEFAULT NULL,
  `user` char(20) DEFAULT NULL,
  `TYPE` char(80) DEFAULT NULL,
  `title` varchar(80) DEFAULT NULL,
  `DATA` text,
  `FILTER` char(80) DEFAULT NULL,
  `published` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `url` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `Content`
--

INSERT INTO `Content` (`id`, `slug`, `url`, `user`, `TYPE`, `title`, `DATA`, `FILTER`, `published`, `created`, `updated`, `deleted`) VALUES
(1, 'hem', 'hem', 'admin', 'page', 'Hem', 'Detta är min hemsida. Den är skriven i [url=http://en.wikipedia.org/wiki/BBCode]bbcode[/url] vilket innebär att man kan formattera texten till [b]bold[/b] och [i]kursiv stil[/i] samt hantera länkar.\n\nDessutom finns ett filter nl2br som lägger in <br>-element istället för \n, det är smidigt, man kan skriva texten precis som man tänker sig att den skall visas, med radbrytningar.', 'bbcode,nl2br', '2013-12-12 13:49:44', '2013-12-12 13:49:44', NULL, NULL),
(2, 'om', 'om', 'admin', 'page', 'Om', 'Detta är en sida om mig och min webbplats. Den är skriven i [Markdown](http://en.wikipedia.org/wiki/Markdown). Markdown innebär att du får bra kontroll över innehållet i din sida, du kan formattera och sätta rubriker, men du behöver inte bry dig om HTML.\n\nRubrik nivå 2\n-------------\n\nDu skriver enkla styrtecken för att formattera texten som **fetstil** och *kursiv*. Det finns ett speciellt sätt att länka, skapa tabeller och så vidare.\n\n###Rubrik nivå 3\n\nNär man skriver i markdown så blir det läsbart även som textfil och det är lite av tanken med markdown.', 'markdown', '2013-12-12 13:49:44', '2013-12-12 13:49:44', NULL, NULL),
(3, 'blogpost-1', NULL, 'admin', 'post', 'Välkommen till min blogg!', 'Detta är en bloggpost.\n\nNär det finns länkar till andra webbplatser så kommer de länkarna att bli klickbara.\n\nhttp://dbwebb.se är ett exempel på en länk som blir klickbar.', 'link,nl2br', '2013-12-12 13:49:44', '2013-12-12 13:49:44', NULL, NULL),
(4, 'blogpost-2', NULL, 'admin', 'post', 'Nu har sommaren kommit', 'Detta är en bloggpost som berättar att sommaren har kommit, ett budskap som kräver en bloggpost.', 'nl2br', '2013-12-12 13:49:44', '2013-12-12 13:49:44', NULL, NULL),
(5, 'blogpost-3', NULL, 'admin', 'post', 'Nu har hösten kommit', 'Detta är en bloggpost som berättar att hösten har kommit, ett budskap som kräver en bloggpost', 'nl2br', '2013-12-12 13:49:44', '2013-12-12 13:49:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `Movie`
--

CREATE TABLE IF NOT EXISTS `Movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `director` varchar(100) DEFAULT NULL,
  `LENGTH` int(11) DEFAULT NULL,
  `YEAR` int(11) NOT NULL DEFAULT '1900',
  `plot` text,
  `image` varchar(100) DEFAULT NULL,
  `subtext` char(3) DEFAULT NULL,
  `speech` char(3) DEFAULT NULL,
  `quality` char(20) DEFAULT NULL,
  `genre` char(50) DEFAULT NULL,
  `format` char(5) DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `Movie`
--

INSERT INTO `Movie` (`id`, `title`, `director`, `LENGTH`, `YEAR`, `plot`, `image`, `subtext`, `speech`, `quality`, `genre`, `format`, `user`) VALUES
(1, 'Pulp fiction', NULL, NULL, 1994, NULL, 'img/movie/pulp-fiction.jpg', NULL, NULL, 'good', 'comedy, drama, thriller', NULL, NULL),
(2, 'American Pie', NULL, NULL, 1999, NULL, 'img/movie/american-pie.jpg', NULL, NULL, 'okay', 'comedy,romance,college', NULL, NULL),
(3, 'PokÃ©mon The Movie 2000', NULL, NULL, 1999, NULL, 'img/movie/pokemon.jpg', NULL, NULL, 'okay', 'animation,adventure,family', NULL, NULL),
(4, 'Kopps', NULL, NULL, 2003, NULL, 'img/movie/kopps.jpg', NULL, NULL, 'good', 'comedy,family,svenskt,action', NULL, NULL),
(5, 'From Dusk Till Dawn', NULL, NULL, 1996, NULL, 'img/movie/from-dusk-till-dawn.jpg', NULL, NULL, 'okay', 'crime,action,horror', NULL, NULL),
(6, 'Goodfellas', NULL, NULL, 1990, NULL, 'img/movie/goodfellas.jpg', NULL, NULL, 'great', 'crime, drama', NULL, NULL),
(7, 'Alien', NULL, NULL, 1979, NULL, 'img/movie/alien.jpg', NULL, NULL, 'very good', 'crime,action,horror', NULL, NULL),
(8, 'Das-boot', NULL, NULL, 1981, NULL, 'img/movie/das-boot.jpg', NULL, NULL, 'great', 'action, adventure, drama', NULL, NULL),
(9, 'Dracula', NULL, NULL, 1992, NULL, 'img/movie/dracula.jpg', NULL, NULL, 'very good', 'drama,fantasy,horror', NULL, NULL),
(10, 'Europa Report ', NULL, NULL, 2013, NULL, 'img/movie/europa-report.jpg', NULL, NULL, 'very good', 'horror,sci-fi, thriller', NULL, NULL),
(11, 'Full Metal Jacket', NULL, NULL, 1987, NULL, 'img/movie/full-metal-jacket.jpg', NULL, NULL, 'great', 'drama,war', NULL, NULL),
(12, 'Immortal Beloved', NULL, NULL, 1994, NULL, 'img/movie/immortal-beloved.jpg', NULL, NULL, 'good', 'biography,drama,music', NULL, NULL),
(13, 'Motorcycle Diaries', NULL, NULL, 2004, NULL, 'img/movie/motorcycle-diaries.jpg', NULL, NULL, 'very good', 'biography, drama', NULL, NULL),
(14, 'Pale Rider', NULL, NULL, 1985, NULL, 'img/movie/pale-rider.jpg', NULL, NULL, 'very-good', 'western', NULL, NULL),
(15, 'Pandorum', NULL, NULL, 2009, NULL, 'img/movie/pandorum.jpg', NULL, NULL, 'good', 'horror, sci-fi', NULL, NULL),
(16, 'Prometeus', NULL, NULL, 2012, NULL, 'img/movie/prometeus.jpg', NULL, NULL, 'very-good', 'adventure, mystery, sci-fi', NULL, NULL),
(17, 'Seraphim Falls', NULL, NULL, 2006, NULL, 'img/movie/seraphim-falls.jpg', NULL, NULL, 'very-good', 'western', NULL, NULL),
(18, 'Stalingrad', NULL, NULL, 1993, NULL, 'img/movie/stalingrad.jpg', NULL, NULL, 'very-good', 'history, drama, war', NULL, NULL),
(19, 'The Thing', NULL, NULL, 1982, NULL, 'img/movie/the-thing.jpg', NULL, NULL, 'very-good', 'horror, mystery, sci-fi', NULL, NULL),
(20, 'The Thing', NULL, NULL, 2011, NULL, 'img/movie/the-thing-2011.jpg', NULL, NULL, 'very-good', 'horror, mystery, sci-fi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `USER`
--

CREATE TABLE IF NOT EXISTS `USER` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acronym` char(12) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `salt` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `acronym` (`acronym`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `USER`
--

INSERT INTO `USER` (`id`, `acronym`, `name`, `password`, `salt`) VALUES
(1, 'doe', 'John/Jane Doe', '279fba226ca4c2d0ec0fa66037065523', 1385042948),
(2, 'admin', 'Administrator', '1b8e3492bdab79e574bf9637dc2de218', 1385042948);
--
-- Database: `phpmyadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `pma_bookmark`
--

CREATE TABLE IF NOT EXISTS `pma_bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dbase` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `query` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pma_column_info`
--

CREATE TABLE IF NOT EXISTS `pma_column_info` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `column_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `transformation` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `transformation_options` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pma_designer_coords`
--

CREATE TABLE IF NOT EXISTS `pma_designer_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `x` int(11) DEFAULT NULL,
  `y` int(11) DEFAULT NULL,
  `v` tinyint(4) DEFAULT NULL,
  `h` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma_history`
--

CREATE TABLE IF NOT EXISTS `pma_history` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sqlquery` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`,`db`,`table`,`timevalue`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pma_pdf_pages`
--

CREATE TABLE IF NOT EXISTS `pma_pdf_pages` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `page_nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_descr` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`page_nr`),
  KEY `db_name` (`db_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pma_relation`
--

CREATE TABLE IF NOT EXISTS `pma_relation` (
  `master_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `master_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_db` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_table` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `foreign_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  KEY `foreign_field` (`foreign_db`,`foreign_table`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma_table_coords`
--

CREATE TABLE IF NOT EXISTS `pma_table_coords` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT '0',
  `x` float unsigned NOT NULL DEFAULT '0',
  `y` float unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma_table_info`
--

CREATE TABLE IF NOT EXISTS `pma_table_info` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_field` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`db_name`,`table_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma_tracking`
--

CREATE TABLE IF NOT EXISTS `pma_tracking` (
  `db_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `table_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `version` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text COLLATE utf8_bin NOT NULL,
  `schema_sql` text COLLATE utf8_bin,
  `data_sql` longtext COLLATE utf8_bin,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') COLLATE utf8_bin DEFAULT NULL,
  `tracking_active` int(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`db_name`,`table_name`,`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `pma_userconfig`
--

CREATE TABLE IF NOT EXISTS `pma_userconfig` (
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `config_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
