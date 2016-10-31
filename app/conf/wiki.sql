-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 10, 2016 at 01:32 PM
-- Server version: 5.5.52-0+deb8u1
-- PHP Version: 5.6.24-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wiki`
--

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
`id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `text` text NOT NULL,
  `date` date NOT NULL,
  `author` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `title`, `text`, `date`, `author`) VALUES
(1, 'Main', 'Accueil\r\n-------\r\n\r\nMiniwiki: un wiki tout mimi\r\n---------------------------\r\n\r\nIl est *mini*, il est *wiki* mon **miniwiki**\r\n\r\nMiniwiki, mais il fait le maximum !\r\n-----------------------------------\r\n\r\nJe suis un moteur de wiki crée à l''occasion du projet de programmation web par les étudiants de l''iut Charlemagne.\r\n\r\n----\r\n\r\nLiens\r\n-----\r\n\r\n* Pour apprendre la syntaxe [Markdown] (http://daringfireball.net/projects/markdown)\r\n* Ce lien pointe vers le site de l''[iut](http://iut-charlemagne.univ-lorraine.fr)\r\n\r\n\r\n\r\n', '2012-12-06', 1),
(2, 'Rock', 'Le rock est un genre musical apparu il y a longtemps (mais pas trop non plus) aux états unis\r\n\r\n## Les genres de Rock\r\n\r\nLe rock se décompose en de très nombreuses branches qu''il est impossible d''énumérer.\r\n\r\nMais si on essayait quand même, on pourrait citer\r\n\r\n* le [[Rock]] \r\n* le [[Punk-Rock]]\r\n* le [[Rock Musette]]\r\n* le [[Rock Crevette]]\r\n* les autres types de rock\r\n\r\n#Les fameux groupes de rock\r\n\r\nParmi les groupes de rock, on dénombre\r\n\r\n# Les Rolling Stones\r\n# Stray Cats\r\n# Deep Purple\r\n\r\nA noter que Justin Bibier et Britney Spears ne sont pas les meilleurs représentants de ce genre musical.\r\n\r\n## L''avenir du rock\r\n\r\nOn attend toujours l''inventeur du Rock numérique.\r\n\r\n## citation\r\n\r\n> Le rock c''est comme un parapluie qui laisserait passer l''eau (Mary Poppins)\r\n', '2012-12-06', 1),
(3, 'Punk-Rock', '## Descriptif\r\n\r\nLe punk rock est un mouvement issu du Rock où le batteur a l''autorisation de jouer très fort pour couvrir le son des autres instruments.\r\n\r\n## Lien\r\n\r\n[wikipedia](http://fr.wikipedia.org/wiki/Punk_rock)\r\n\r\n\r\n## Citation\r\n\r\n> J''ai toujours eu du mal avec le punk (Mozart)\r\n', '2012-12-06', 1),
(4, 'Rock Musette', '## Descriptif\r\n\r\nLe rock musette permet de se balancer au son de l''accordéon électrique.\r\n\r\n', '2015-10-12', 2),
(5, 'Rock Crevette', '## Le Rock Crevette\r\n\r\nCe n''est pas pour les marins d''eau douce !!! \r\n\r\n## Citation\r\n\r\n> Le rock crevette c''est de la musique Palourde (Flipper le Dauphin)\r\n', '2012-12-06', 2),
(8, 'Les meilleures blagues droles', '* un programme javelot, tu le lances, il plante.\r\n\r\n* pour l''examen d''HTML, je balise\r\n\r\n* j''ai pris une nouvelle résolution pour noel : 800*600\r\n\r\n* ah, ca y est, c''est tombé en marche.\r\n\r\n----\r\n\r\nDans un réfrigirateur, 10 oeufs sont alignés dans le bac à oeufs.\r\nLe 1er dit au 2ème:" tu ne trouves pas qu''il a une drôle de tête le dernier oeuf?"\r\nLe 2ème répond :"bah oui!, tu as raison !!!"\r\nLe 2ème oeuf se retourne sur le 3ème et lui dit........ ainsi de suite jusquau 9ème oeuf, qui se retourne vers le 10ème oeuf et lui dit : "C''est vraie que pour un oeuf t''as une drôle de tête."\r\nLe 10ème se retourne vers son voisin et lui répond "Imbécile moi je suis in kiwi" ', '2012-12-06', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `login` varchar(128) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `level` int(11) NOT NULL COMMENT '-100:NONE; 100:USER; 500:ADMIN'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `pass`, `level`) VALUES
(1, 'john', '$2y$10$st3OSGl37z4XM5jIRNWD4ORqeiv65LNv6J2cbMKsKXawwFofZ2zGa', 100),
(2, 'tom', '$2y$10$.2dix/dSHVQt32zIaxVYguy.3D2Iki.0as9fX7dgH1splrhfzHPAa', 100),
(3, 'mike', '$2y$10$NqACSfKhW0UZFcGtSy5t.uvs6Hj3EurQ0UpFlxqdR0m6uhDHP8nHa', 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `page`
--
ALTER TABLE `page`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
