-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 30 nov. 2018 à 16:06
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

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

DELIMITER $$
--
-- Fonctions
--
DROP FUNCTION IF EXISTS `nbTrajetConducteur`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `nbTrajetConducteur` (`id_utilisateur` INT) RETURNS INT(11) BEGIN
DECLARE nbr int;
SET nbr=0;
SELECT COUNT(*) INTO nbr FROM  trajetinstance WHERE (id_utilisateur=conducteur_id);
RETURN nbr;
END$$

DELIMITER ;

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
-- Déchargement des données de la table `participants`
--

INSERT INTO `participants` (`passager_id`, `trajet_id`, `conducteur_id`) VALUES
(5, 14, 6),
(6, 11, 5),
(7, 13, 5);

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
-- Déchargement des données de la table `trajetinstance`
--

INSERT INTO `trajetinstance` (`id`, `dates`, `sens`, `type`, `place_dispo`, `commentaire`, `heure`, `place_restante`, `conducteur_id`) VALUES
(11, '2018-12-25', 2, 1, 3, NULL, '08:00:00', 0, 5),
(12, '2018-12-01', 1, 1, 6, NULL, '18:00:00', 6, 6),
(13, '2019-03-26', 2, 1, 5, NULL, '15:34:00', 0, 5),
(14, '2017-06-21', 2, 2, 2, NULL, '21:58:00', 2, 6),
(15, '2019-02-07', 2, 1, 3, NULL, '13:44:00', 3, 7);

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `pseudo`, `passe`, `admin`, `connecte`, `blacklist`) VALUES
(5, 'Delhaye', 'Maximilien', 'mdelhaye', '140f6969d5213fd0ece03148e62e461e', 0, 0, 0),
(6, 'Chretien', 'Maxence', 'mchretien', '140f6969d5213fd0ece03148e62e461e', 0, 0, 0),
(7, 'Bodart', 'Alexandre', 'abodart', '140f6969d5213fd0ece03148e62e461e', 0, 0, 0);

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
