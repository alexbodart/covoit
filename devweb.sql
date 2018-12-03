-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 03 déc. 2018 à 14:24
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `devweb`
--

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `listes`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `listes`;
CREATE TABLE IF NOT EXISTS `listes` (
`id` int(5)
,`commentaire` varchar(300)
,`dates` date
,`heure` time
,`place_dispo` tinyint(2)
,`place_restante` tinyint(2)
,`sens` tinyint(1)
,`type` tinyint(1)
,`prenom` varchar(50)
,`nom` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la table `participants`
--

DROP TABLE IF EXISTS `participants`;
CREATE TABLE IF NOT EXISTS `participants` (
  `passager_id` int(5) NOT NULL,
  `trajet_id` int(5) NOT NULL,
  `conducteur_id` int(11) NOT NULL,
  KEY `FOREIGN` (`passager_id`) KEY_BLOCK_SIZE=20,
  KEY `FOREIGN2` (`trajet_id`) KEY_BLOCK_SIZE=20,
  KEY `participants_ibfk_3` (`conducteur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déclencheurs `participants`
--
DROP TRIGGER IF EXISTS `participants_BEFORE_INSERT`;
DELIMITER $$
CREATE TRIGGER `participants_BEFORE_INSERT` BEFORE INSERT ON `participants` FOR EACH ROW BEGIN
	IF NEW.passager_id = NEW.conducteur_id
		THEN
			SET NEW.passager_id = 0;
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `trajetinstance`
--

DROP TABLE IF EXISTS `trajetinstance`;
CREATE TABLE IF NOT EXISTS `trajetinstance` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `dates` date NOT NULL,
  `sens` tinyint(1) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `place_dispo` tinyint(2) NOT NULL DEFAULT '50',
  `commentaire` varchar(300) DEFAULT NULL,
  `heure` time NOT NULL,
  `place_restante` tinyint(2) NOT NULL,
  `conducteur_id` int(5) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FOREIGN` (`conducteur_id`) KEY_BLOCK_SIZE=20
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déclencheurs `trajetinstance`
--
DROP TRIGGER IF EXISTS `trajetinstance_BEFORE_INSERT`;
DELIMITER $$
CREATE TRIGGER `trajetinstance_BEFORE_INSERT` BEFORE INSERT ON `trajetinstance` FOR EACH ROW BEGIN
	SET NEW.place_restante = NEW.place_dispo;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `pseudo` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT 'pseudo',
  `passe` varchar(200) CHARACTER SET latin1 NOT NULL COMMENT 'mot de passe',
  `admin` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indique si l''utilisateur est un administrateur',
  `connecte` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'indique si l''utilisateur est connecte',
  `blacklist` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la vue `listes`
--
DROP TABLE IF EXISTS `listes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listes`  AS  select `trajetinstance`.`id` AS `id`,`trajetinstance`.`commentaire` AS `commentaire`,`trajetinstance`.`dates` AS `dates`,`trajetinstance`.`heure` AS `heure`,`trajetinstance`.`place_dispo` AS `place_dispo`,`trajetinstance`.`place_restante` AS `place_restante`,`trajetinstance`.`sens` AS `sens`,`trajetinstance`.`type` AS `type`,`users`.`prenom` AS `prenom`,`users`.`nom` AS `nom` from (`trajetinstance` join `users` on((`trajetinstance`.`conducteur_id` = `users`.`id`))) ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`passager_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `participants_ibfk_2` FOREIGN KEY (`trajet_id`) REFERENCES `trajetinstance` (`id`),
  ADD CONSTRAINT `participants_ibfk_3` FOREIGN KEY (`conducteur_id`) REFERENCES `trajetinstance` (`conducteur_id`);

--
-- Contraintes pour la table `trajetinstance`
--
ALTER TABLE `trajetinstance`
  ADD CONSTRAINT `trajetinstance_ibfk_1` FOREIGN KEY (`conducteur_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
