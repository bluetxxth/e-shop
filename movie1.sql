-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 18, 2013 at 09:05 AM
-- Server version: 5.5.31-0+wheezy1
-- PHP Version: 5.4.4-14+deb7u5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
