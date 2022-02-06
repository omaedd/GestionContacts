-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 26, 2021 at 07:30 PM
-- Server version: 5.7.24
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf32 NOT NULL,
  `prenom` varchar(100) CHARACTER SET utf32 NOT NULL,
  `telephone1` varchar(20) NOT NULL,
  `telephone2` varchar(20) DEFAULT NULL,
  `photo` varchar(250) DEFAULT NULL,
  `email_Pers` varchar(100) NOT NULL,
  `email_Pro` varchar(100) DEFAULT NULL,
  `genre` varchar(25) DEFAULT NULL,
  `adresse` varchar(250) CHARACTER SET utf8 NOT NULL,
  `Etablissement` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `nom`, `prenom`, `telephone1`, `telephone2`, `photo`, `email_Pers`, `email_Pro`, `genre`, `adresse`, `Etablissement`) VALUES
(1, 'Eddarraji', 'Omaima', '0610203040', '0640302010', 'avatar5.png', 'omaima@gmail.com', 'omaima@ensah.ma', 'Feminin', 'Imozuren Hoceima Morocco', 'ENSAH'),
(2, 'Charroud', 'Omaima', '0610002000', '0510002000', 'avatar4.png', 'omaima@yahoo.fr', 'omaima@uac.ma', 'Feminin', 'Driouech Nador Morocco', 'ENSAH'),
(3, 'Eddarraji', 'Kamal', '0600009999', '0590001000', 'avatar3.png', 'kamal@gmail.com', 'kamal@um6p.ma', 'Masculin', 'Targuist Hoceima Morocco', 'UM6P'),
(4, 'Williams', 'Anna', '0334546479', '0334455667', 'avatar2.png', 'anna@hotmail.fr', 'anna@ibm.us', 'Feminin', 'San Francisco USA', 'IBM');

-- --------------------------------------------------------

--
-- Table structure for table `groupes`
--

DROP TABLE IF EXISTS `groupes`;
CREATE TABLE IF NOT EXISTS `groupes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `idIcone` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idIcone` (`idIcone`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `groupes`
--

INSERT INTO `groupes` (`id`, `libelle`, `idIcone`) VALUES
(1, 'Amis', 2),
(2, 'Amis proches', 9),
(3, 'Famille', 1),
(4, 'Work', 3);

-- --------------------------------------------------------

--
-- Table structure for table `groups_contacts`
--

DROP TABLE IF EXISTS `groups_contacts`;
CREATE TABLE IF NOT EXISTS `groups_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idContact` int(11) NOT NULL,
  `idGroupe` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idContact` (`idContact`),
  KEY `idGroupe` (`idGroupe`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `groups_contacts`
--

INSERT INTO `groups_contacts` (`id`, `idContact`, `idGroupe`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 1, 1),
(4, 3, 3),
(5, 4, 4),
(6, 4, 2),
(7, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `icones`
--

DROP TABLE IF EXISTS `icones`;
CREATE TABLE IF NOT EXISTS `icones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  `codeHTML` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `icones`
--

INSERT INTO `icones` (`id`, `libelle`, `codeHTML`) VALUES
(1, 'Famille', '<i class=\'fas fa-home ml-2\'></i>'),
(2, 'Amis', '<i class=\'fas fa-user-friends ml-2\'></i>'),
(3, 'Travail', '<i class=\'fas fa-briefcase ml-2\'></i>'),
(4, 'Collègues', '<i class=\'fas fa-graduation-cap ml-2\'></i>'),
(7, 'Clients', '<i class=\'fas fa-handshake ml-2\'></i>'),
(5, 'Professeurs', '<i class=\'fas fa-street-view ml-2\'></i>'),
(6, 'Autres', '<i class=\'fas fa-box-open ml-2\'></i>'),
(8, 'Fournisseurs', '<i class=\'fas fa-truck ml-2\'></i>'),
(9, 'Amis proches', '<i class=\'fas fa-heart ml-2\'></i>'),
(10, 'Urgence', '<i class=\'fas fa-first-aid ml-2\'></i>'),
(11, 'Administrateurs', '<i class=\'fas fa-lock ml-2\'></i>'),
(12, 'Privé', '<i class=\'fas fa-key ml-2\'></i>');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_login` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf16;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `username`, `password`, `last_login`) VALUES
(1, 'Administrateur', '', 'admin', '5317a8e8b685dc19e02f46a91ce3daa6', '26 June 2021 06:51 PM');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
