-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Client :  technewsdating.mysql.db
-- Généré le :  Lun 16 Février 2015 à 09:58
-- Version du serveur :  5.1.73-2+squeeze+build1+1-log
-- Version de PHP :  5.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `polytechdating`
--

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE IF NOT EXISTS `entreprise` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `com` varchar(10) NOT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `website` varchar(150) DEFAULT NULL,
  `formatLogo` varchar(10) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `nomImage` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;


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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Contenu de la table `heure`
--
/*
INSERT INTO `heure` (`id`, `entreprise`, `14h00`, `14h20`, `14h40`, `15h00`, `15h20`, `15h40`, `16h00`, `16h20`, `16h40`, `17h00`) VALUES
(1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 3, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1),
(11, 11, 0, 1, 1, 0, 0, 0, 0, 1, 0, 0),
(18, 18, 1, 1, 0, 1, 0, 0, 0, 0, 0, 1),
(19, 19, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1),
(22, 22, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1),
(24, 24, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1),
(25, 25, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1),
(28, 28, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(30, 29, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(36, 35, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(37, 36, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(38, 37, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(39, 39, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0);
*/
-- --------------------------------------------------------

--
-- Structure de la table `infosite`
--

CREATE TABLE IF NOT EXISTS `infosite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `infosite`
--

INSERT INTO `infosite` (`id`, `nom`, `contenu`) VALUES
(3, 'descriptionLongue', '<p>Le Dating Polytech est réalisé sous la forme bien connue d''un Job Dating qui permet aux recruteurs et candidats d''échanger et initier une première prise de contact, ils peuvent se recontacter pour un second entretien plus approfondi par la suite.</p><p>Le planning du Dating Polytech est organisé à l''avance. Chaque candidat est préalablement inscrit sur un créneau horaire précis avec une ou plusieurs entreprises. La durée totale de l''entretien est de 20 minutes.</p><br/><h2>Trouver un stage ou un futur emploi</h2><p>L''échange professionnel sera de <strong>15 minutes</strong>, temps durant lequel le candidat pourra se présenter, présenter son projet professionnel (métier, type d''entreprise, secteur géographique...) puis donnera son CV à l''entreprise pour échanger sur les atouts de sa candidature. <strong>Les 5 minutes suivantes seront consacrées aux conseils prodigués par le ou les recruteurs à l''élève.</strong></p><br/><h2>Elèves participants</h2><p>150 élèves ingénieurs de 5ème année et Master 2 dans le domaine de l''informatique, l''électronique, IMAFA (Informatique et Mathématiques Appliquées à la Finance et l''Assurance).</p><br/><h2>Entreprises participantes</h2><p>Retrouvez toutes les entreprises présentent lors de l''évènement dans l''onglet <a href=''./entreprises.php''>Entreprises</a>.</p><p><a class=''btn btn-primary btn-lg'' role=''button'' href=''./inscription.php''>Je m''inscris »</a></p> '),
(4, 'descriptionEntreprise', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.'),
(5, 'descriptionEleve', 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.'),
(2, 'edition', '2014'),
(1, 'priseRDVActive', ''),
(0, 'nbrdv', '2'),
(9, 'inscriptionsOuvertes', ''),
(8, 'mailContact', 'polytech.dating@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL,
  `promotion` varchar(40) NOT NULL,
  `parcours` varchar(10) NOT NULL,
  `motcles1` varchar(40) NOT NULL,
  `motcles2` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `mail`, `pass`, `promotion`, `parcours`, `motcles1`, `motcles2`) VALUES
(1, 'root', 'root', 'root@root.root', '63a9f0ea7bb98050796b649e85481845', 'SI5', 'IAM', 'root', 'root');

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `texte` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `rdv`
--

CREATE TABLE IF NOT EXISTS `rdv` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `entreprise` smallint(5) unsigned NOT NULL,
  `membre` smallint(5) unsigned NOT NULL,
  `heure` varchar(40) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=252 ;

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
