-- phpMyAdmin SQL Dump
-- version OVH
-- http://www.phpmyadmin.net
--
-- Client: mysql51-101.perso
-- Généré le : Jeu 20 Février 2014 à 13:17
-- Version du serveur: 5.1.66
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `technewsdating`
--

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `com` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `nom`, `com`) VALUES
(1, 'MISYS', 'IMAFA'),
(3, 'FARO Consulting', 'IMAFA'),
(11, 'WALL STREET SYSTEMS', 'IMAFA'),
(18, 'ATOS Solutions financieres', 'IMAFA'),
(19, 'Credit Agricole Open (KZ Consulting)', 'IMAFA'),
(22, 'Full Performance', 'ELEC'),
(24, 'THALES Underwater System', 'ELEC'),
(25, 'THALES Alenia Space', 'ELEC'),
(28, 'ST Microelectronics', 'ELEC'),
(29, 'MARGO Conseil', 'IMAFA'),
(35, 'CELAD', 'ELEC'),
(36, 'MUREX', 'IMAFA'),
(37, 'Credit Foncier Monaco', 'IMAFA');

-- --------------------------------------------------------

--
-- Structure de la table `heure`
--

CREATE TABLE IF NOT EXISTS `heure` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `entreprise` smallint(5) unsigned NOT NULL,
  `14h00` tinyint(1) DEFAULT NULL,
  `14h20` tinyint(1) DEFAULT NULL,
  `14h40` tinyint(1) DEFAULT NULL,
  `15h00` tinyint(1) DEFAULT NULL,
  `15h20` tinyint(1) DEFAULT NULL,
  `15h40` tinyint(1) DEFAULT NULL,
  `16h00` tinyint(1) DEFAULT NULL,
  `16h20` tinyint(1) DEFAULT NULL,
  `16h40` tinyint(1) DEFAULT NULL,
  `17h00` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ebtreprise_id` (`entreprise`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Contenu de la table `heure`
--

INSERT INTO `heure` (`id`, `entreprise`, `14h00`, `14h20`, `14h40`, `15h00`, `15h20`, `15h40`, `16h00`, `16h20`, `16h40`, `17h00`) VALUES
(1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(3, 3, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(11, 11, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(18, 18, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(19, 19, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(22, 22, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(24, 24, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(25, 25, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(28, 28, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(30, 29, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(36, 35, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(37, 36, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1),
(38, 37, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(40) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(40) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(40) CHARACTER SET utf8 NOT NULL,
  `promotion` varchar(40) CHARACTER SET utf8 NOT NULL,
  `parcours` varchar(10) CHARACTER SET utf8 NOT NULL,
  `motcles1` varchar(40) CHARACTER SET utf8 NOT NULL,
  `motcles2` varchar(40) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=184 ;

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `promotion` varchar(40) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `texte` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


--
-- Structure de la table `rdv`
--

CREATE TABLE IF NOT EXISTS `rdv` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `entreprise` smallint(5) unsigned NOT NULL,
  `membre` smallint(5) unsigned NOT NULL,
  `heure` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=248 ;



--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `heure`
--
ALTER TABLE `heure`
  ADD CONSTRAINT `fk_ebtreprise_id` FOREIGN KEY (`entreprise`) REFERENCES `entreprise` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
