-- phpMyAdmin SQL Dump
-- version 4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2013 at 01:29 PM
-- Server version: 5.5.33-0+wheezy1
-- PHP Version: 5.4.4-14+deb7u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

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
  `synopsys` varchar(5000) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `credit` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `Movie`
--

INSERT INTO `Movie` (`id`, `title`, `director`, `LENGTH`, `YEAR`, `plot`, `image`, `subtext`, `speech`, `quality`, `genre`, `format`, `synopsys`, `price`, `credit`) VALUES
(1, 'Pulp fiction', NULL, NULL, 1994, NULL, 'img/movie/pulp-fiction.jpg', NULL, NULL, 'good', 'comedy, drama, thriller', NULL, 'Jules Winnfield and Vincent Vega are two hitmen who are out to retrieve a suitcase stolen from their employer, mob boss Marsellus Wallace. Wallace has also asked Vincent to take his wife Mia out a few days later when Wallace himself will be out of town. Butch Coolidge is an aging boxer who is paid by Wallace to lose his next fight. The lives of these seemingly unrelated people are woven together comprising of a series of funny, bizarre and uncalled-for incidents. ', 50, 500),
(2, 'American Pie', NULL, NULL, 1999, NULL, 'img/movie/american-pie.jpg', NULL, NULL, 'okay', 'comedy,romance,college', NULL, 'Jim, Oz, Finch and Kevin are four friends who make a pact that before they graduate they will all lose their virginity. The hard job now is how to reach that goal by prom night. Whilst Oz begins singing to grab attention and Kevin tries to persuade his girlfriend, Finch tries any easy route of spreading rumors and Jim fails miserably. Whether it is being caught on top of a pie or on the Internet, Jim always end up with his trusty sex advice from his father. Will they achieve their goal of getting laid by prom night? or will they learn something much different. ', 20, 500),
(3, 'Pokémon The Movie 2000', NULL, NULL, 1999, NULL, 'img/movie/pokemon.jpg', NULL, NULL, 'okay', 'animation,adventure,family', NULL, 'Ash Ketchum must put his skill to the test when he attempts to save the world from destruction. The Greedy Pokemon collector Lawrence III throws the universe into chaos after disrupting the balance of nature by capturing one of the Pokemon birds that rule the elements of fire, lightning and ice. Will Ash have what it takes to save the world? ', 30, 500),
(4, 'Kopps', NULL, NULL, 2003, NULL, 'img/movie/kopps.jpg', NULL, NULL, 'good', 'comedy,family,svenskt,action', NULL, 'Police officer Benny is obsessed with American police cliches and livens up his own boring everyday life with dreams of duels with bad guys. But poor Benny and his colleagues doesn''t have much to do in the small town of Högboträsk. Most of their days are spent drinking coffee, eating sausage waffles and chasing down stray cows. Peace and quiet is the dream of every politician, but for the Swedish authorities, the lack of crooks is reason to close the local police station. When the cops investigate a suspected act of vandalism, they realise that they themselves may be able to raise the crime statistics high enough to stay in business.', 20, 500),
(5, 'From Dusk Till Dawn', NULL, NULL, 1996, NULL, 'img/movie/from-dusk-till-dawn.jpg', NULL, NULL, 'okay', 'crime,action,horror', NULL, 'After a bank heist in Abilene with several casualties, the bank robber Seth Gecko and his psychopath and rapist brother Richard Gecko continue their crime spree in a convenience store in the middle of the desert while heading to Mexico with a hostage. They decide to stop for a while in a low-budget motel. Meanwhile the former minister Jacob Fuller is traveling on vacation with his son Scott and his daughter Kate in a RV. Jacob lost his faith after the death of his beloved wife in a car accident and quit his position of pastor of his community and stops for the night in the same motel Seth and Richard are lodged. When Seth sees the recreational vehicle, he abducts Jacob and his family to help his brother and him to cross the Mexico border, promising to release them on the next morning. They head to the truck drivers and bikers bar Titty Twister where Seth will meet with his partner Carlos in the dawn. When they are watching the dancer Santanico Pandemonium, Seth and Richard fight with ... ', 30, 500),
(6, 'Goodfellas', NULL, NULL, 1990, NULL, 'img/movie/goodfellas.jpg', NULL, NULL, 'great', 'crime, drama', NULL, 'Henry Hill is a small time gangster, who takes part in a robbery with Jimmy Conway and Tommy De Vito, two other gangsters who have set their sights a bit higher. His two partners kill off everyone else involved in the robbery, and slowly start to climb up through the hierarchy of the Mob. Henry, however, is badly affected by his partners success, but will he stoop low enough to bring about the downfall of Jimmy and Tommy? ', 100, 500),
(7, 'Alien', NULL, NULL, 1979, NULL, 'img/movie/alien.jpg', NULL, NULL, 'very good', 'crime,action,horror', NULL, 'The crew of the deep space towing vessel Nostromo are awaken from hypersleep to investigate a strange signal from a nearby planet. While investigating the signal, they discover it was intended as a warning, and not an SOS. ', 115, 500),
(8, 'Das-boot', NULL, NULL, 1981, NULL, 'img/movie/das-boot.jpg', NULL, NULL, 'great', 'action, adventure, drama', NULL, 'It is 1942 and the German submarine fleet is heavily engaged in the so called "Battle of the Atlantic" to harass and destroy British shipping. With better escorts of the Destroyer Class, however, German U-Boats have begun to take heavy losses. "Das Boot" is the story of one such U-Boat crew, with the film examining how these submariners maintained their professionalism as soldiers, attempted to accomplish impossible missions, while all the time attempting to understand and obey the ideology of the government under which they served. ', 110, 500),
(9, 'Dracula', NULL, NULL, 1992, NULL, 'img/movie/dracula.jpg', NULL, NULL, 'very good', 'drama,fantasy,horror', NULL, 'This version of Dracula is closely based on Bram Stoker''s classic novel of the same name. A young lawyer (Jonathan Harker) is assigned to a gloomy village in the mists of eastern Europe. He is captured and imprisoned by the undead vampire Dracula, who travels to London, inspired by a photograph of Harker''s betrothed, Mina Murray. In Britain, Dracula begins a reign of seduction and terror, draining the life from Mina''s closest friend, Lucy Westenra. Lucy''s friends gather together to try to drive Dracula away. ', 130, 500),
(10, 'Europa Report ', NULL, NULL, 2013, NULL, 'img/movie/europa-report.jpg', NULL, NULL, 'very good', 'horror,sci-fi, thriller', NULL, 'The astronauts William Xu, Rosa Dasque, Dr. Daniel Luxembourg, Dr. Katya Petrovna, Andrei Blok and James Corrigan travel to the moon of Jupiter known as Europa in the spacecraft Europe One. Their assignment is to investigate the existence of life in Europa, based on the discovery of water in the moon. When they experience communication breakdown, Andrei and Corrigan need to go outside the spacecraft to repair it. However, Corrigan accidentally contaminates his suit with hydrazine and he is left behind in space. When they land, they miss their target and they decide to drill the ice to research. Then Katya collects samples proving the existence of one alien organism from Europa but she has a tragic accident. The survivors decide to return to Earth with their discovery but there is a problem with the engines and they get stranded in Europa. Will they be able to fix the engines and return to Earth with their findings? ', 80, 500),
(11, 'Full Metal Jacket', NULL, NULL, 1987, NULL, 'img/movie/full-metal-jacket.jpg', NULL, NULL, 'great', 'drama,war', NULL, 'A two-segment look at the effect of the military mindset and war itself on Vietnam era Marines. The first half follows a group of recruits in boot camp under the command of the punishing Gunnery Sergeant Hartman. The second half shows one of those recruits, Joker, covering the war as a correspondent for Stars and Stripes, focusing on the Tet offensive. ', 150, 500),
(12, 'Immortal Beloved', NULL, NULL, 1994, NULL, 'img/movie/immortal-beloved.jpg', NULL, NULL, 'good', 'biography,drama,music', NULL, 'The life and death of the legendary Ludwig van Beethoven. Beside all the work he is known for, the composer once wrote a famous love letter to a nameless beloved and the movie tries to find out who this beloved was. Not easy as Beethoven has had many women in his life. ', 90, 500),
(13, 'Motorcycle Diaries', NULL, NULL, 2004, NULL, 'img/movie/motorcycle-diaries.jpg', NULL, NULL, 'very good', 'biography, drama', NULL, 'In 1952, twenty-three year old medical student Ernesto Guevara de la Serna - Fuser to his friends and later better known as ''Ernesto Che Guevara'' - one semester away from graduation, decides to postpone his last semester to accompany his twenty-nine year old biochemist friend ''Alberto Granado'' - Mial to his friends - on his four month, 8,000 km long dream motorcycle trip throughout South America starting from their home in Buenos Aires. Their quest is to see things they''ve only read about in books about the continent on which they live, and to finish that quest on Alberto''s thirtieth birthday on the other side of the continent in the Guajira Peninsula in Venezuela. Not all on this trip goes according to their rough plan due to a broken down motorbike, a continual lack of money (they often stretching the truth to gain the favor of a variety of strangers to help them), arguments between the two in their frequent isolation solely with each other, their raging libidos which sometimes get ', 70, 500),
(14, 'Pale Rider', NULL, NULL, 1985, NULL, 'img/movie/pale-rider.jpg', NULL, NULL, 'very-good', 'western', NULL, 'A gold mining camp in the California foothills is besieged by a neighboring landowner intent on stealing their claims. A preacher rides into camp and uses all of his powers of persuasion to convince the landowner to give up his attacks on the miners. ', 80, 500),
(15, 'Pandorum', NULL, NULL, 2009, NULL, 'img/movie/pandorum.jpg', NULL, NULL, 'good', 'horror, sci-fi', NULL, 'Two crew members are stranded on a spacecraft and quickly - and horrifically - realize they are not alone. Two astronauts awaken in a hyper-sleep chamber aboard a seemingly abandoned spacecraft. It''s pitch black, they are disoriented, and the only sound is a low rumble and creak from the belly of the ship. They can''t remember anything: Who are they? What is their mission? With Lt. Payton staying behind to guide him via radio transmitter, Cpl. Bower ventures deep into the ship and begins to uncover a terrifying reality. Slowly the spacecraft''s shocking, deadly secrets are revealed...and the astronauts find their own survival is more important than they could ever have imagined.', 60, 500),
(16, 'Prometheus', NULL, NULL, 2012, NULL, 'img/movie/prometeus.jpg', NULL, NULL, 'very-good', 'adventure, mystery, sci-fi', NULL, 'This film is set in 2093 and takes place in the same universe as the ''Alien'' movies. A group of explorers, including some archaeologists, are on an "undisclosed" mission. They arrive at a planet millions of miles away from Earth. The team spot what they believe to be signs of civilization. They go to investigate and find more than just signs, they find conclusive evidence. But some of them have an ulterior motive for being there, including the Weyland Corporation. They believe that this is where the human race actually came from. Things soon turn from excitement to survival once inside their discovery. ', 120, 500),
(17, 'Seraphim Falls', NULL, NULL, 2006, NULL, 'img/movie/seraphim-falls.jpg', NULL, NULL, 'very-good', 'western', NULL, 'In the 1860s, five men have been tracking a sixth across Nevada for more than two weeks. They shoot and wound him, but he gets away. They pursue, led by the dour Carver, who will pay them each $1 a day once he''s captured. The hunted is Gideon, resourceful, skilled with a knife. Gideon''s flight and Carver''s hunt require horses, water, and bullets. The course takes them past lone settlers, a wagon train, a rail crew, settlements, and an Indian philosopher. What is the reason for the hunt; what connects Gideon and Carver? What happened at Seraphim Falls?', 95, 500),
(18, 'Stalingrad', NULL, NULL, 1993, NULL, 'img/movie/stalingrad.jpg', NULL, NULL, 'very-good', 'history, drama, war', NULL, 'A depiction of the brutal battle of Stalingrad, the Third Reich''s ''high water mark'', as seen through the eyes of German officer Hans von Witzland and his battalion. ', 85, 500),
(19, 'The Thing', NULL, NULL, 1982, NULL, 'img/movie/the-thing.jpg', NULL, NULL, 'very-good', 'horror, mystery, sci-fi', NULL, 'An American scientific expedition to the frozen wastes of the Antarctic is interrupted by a group of seemingly mad Norwegians pursuing and shooting a dog. The helicopter pursuing the dog explodes, eventually leaving no explanation for the chase. During the night, the dog mutates and attacks other dogs in the cage and members of the team that investigate. The team soon realizes that an alien life-form with the ability to take over other bodies is on the loose and they don''t know who may already have been taken over. ', 140, 500),
(20, 'The Thing', NULL, NULL, 2011, NULL, 'img/movie/the-thing-2011.jpg', NULL, NULL, 'very-good', 'horror, mystery, sci-fi', NULL, 'Paleontologist Kate Lloyd is invited by Dr. Sandor Halvorson to join his team who have found something extraordinary. Deep below the Arctic ice, they have found an alien spacecraft that has been there for perhaps 100,000 years. Not far from where the craft landed, they find the remains of the occupant. It''s cut out of the ice and taken back to their camp but as the ice melts, the creature reanimates and not only begins to attack them but manages to infect them, with team members devolving into the alien creature.', 125, 500),
(21, '', NULL, NULL, 1900, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
