-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 27 mars 2023 à 15:56
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet_idaw`
--

-- --------------------------------------------------------

--
-- Structure de la table `aliment`
--

DROP TABLE IF EXISTS `aliment`;
CREATE TABLE IF NOT EXISTS `aliment` (
  `ID_ALIMENT` int NOT NULL AUTO_INCREMENT,
  `NOM` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ID_TYPE_ALIMENT` int NOT NULL,
  PRIMARY KEY (`ID_ALIMENT`),
  KEY `ID_TYPE_ALIMENT` (`ID_TYPE_ALIMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `besoins_nrj`
--

DROP TABLE IF EXISTS `besoins_nrj`;
CREATE TABLE IF NOT EXISTS `besoins_nrj` (
  `ID_CATEGORIE` int NOT NULL AUTO_INCREMENT,
  `LOGIN` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `LIBELLE_CATEGORIE` int NOT NULL,
  PRIMARY KEY (`ID_CATEGORIE`),
  KEY `besoins_nrj_ibfk_1` (`LOGIN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `composer`
--

DROP TABLE IF EXISTS `composer`;
CREATE TABLE IF NOT EXISTS `composer` (
  `ID_ALIMENT_COMPOSE` int NOT NULL,
  `ID_ALIMENT_COMPOSANT` int NOT NULL,
  `RATIO` float NOT NULL,
  PRIMARY KEY (`ID_ALIMENT_COMPOSE`,`ID_ALIMENT_COMPOSANT`),
  KEY `ID_ALIMENT_COMPOSANT` (`ID_ALIMENT_COMPOSANT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE IF NOT EXISTS `contenir` (
  `ID_ALIMENT` int NOT NULL,
  `ID_MICRONUTRIMENT` int NOT NULL,
  `RATIO` float NOT NULL,
  PRIMARY KEY (`ID_ALIMENT`,`ID_MICRONUTRIMENT`),
  KEY `contenir_ibfk_2` (`ID_MICRONUTRIMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `intensite_sport`
--

DROP TABLE IF EXISTS `intensite_sport`;
CREATE TABLE IF NOT EXISTS `intensite_sport` (
  `ID_SPORT` int NOT NULL AUTO_INCREMENT,
  `LIBELLE` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID_SPORT`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `intensite_sport`
--

INSERT INTO `intensite_sport` (`ID_SPORT`, `LIBELLE`) VALUES
(1, 'Faible'),
(2, 'Modérée'),
(3, 'Elevée');

-- --------------------------------------------------------

--
-- Structure de la table `manger`
--

DROP TABLE IF EXISTS `manger`;
CREATE TABLE IF NOT EXISTS `manger` (
  `LOGIN` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `ID_ALIMENT` int NOT NULL,
  `QUANTITE` float NOT NULL,
  `DATE` date NOT NULL,
  PRIMARY KEY (`LOGIN`,`ID_ALIMENT`),
  KEY `ID_ALIMENT` (`ID_ALIMENT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `micronutriments`
--

DROP TABLE IF EXISTS `micronutriments`;
CREATE TABLE IF NOT EXISTS `micronutriments` (
  `ID_MICRONUTRIMENT` int NOT NULL AUTO_INCREMENT,
  `LIBELLE` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID_MICRONUTRIMENT`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `micronutriments`
--

INSERT INTO `micronutriments` (`ID_MICRONUTRIMENT`, `LIBELLE`) VALUES
(1, 'Glucides'),
(2, 'Lipides'),
(3, 'Protéines'),
(4, 'Fibres'),
(5, 'Sel'),
(6, 'Vitamines');

-- --------------------------------------------------------

--
-- Structure de la table `sexe`
--

DROP TABLE IF EXISTS `sexe`;
CREATE TABLE IF NOT EXISTS `sexe` (
  `ID_SEXE` int NOT NULL AUTO_INCREMENT,
  `LIBELLE` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID_SEXE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `sexe`
--

INSERT INTO `sexe` (`ID_SEXE`, `LIBELLE`) VALUES
(1, 'Féminin'),
(2, 'Masculin'),
(3, 'Ne souhaite pas répondre');

-- --------------------------------------------------------

--
-- Structure de la table `tranche_age`
--

DROP TABLE IF EXISTS `tranche_age`;
CREATE TABLE IF NOT EXISTS `tranche_age` (
  `ID_TRANCHE_AGE` int NOT NULL AUTO_INCREMENT,
  `AGE_MIN` int NOT NULL,
  `AGE_MAX` int NOT NULL,
  PRIMARY KEY (`ID_TRANCHE_AGE`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `tranche_age`
--

INSERT INTO `tranche_age` (`ID_TRANCHE_AGE`, `AGE_MIN`, `AGE_MAX`) VALUES
(1, 18, 25),
(2, 26, 40),
(3, 41, 60),
(4, 61, 80);

-- --------------------------------------------------------

--
-- Structure de la table `type_aliment`
--

DROP TABLE IF EXISTS `type_aliment`;
CREATE TABLE IF NOT EXISTS `type_aliment` (
  `ID_TYPE_ALIMENT` int NOT NULL AUTO_INCREMENT,
  `LIBELLE` text COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ID_TYPE_ALIMENT`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_aliment`
--

INSERT INTO `type_aliment` (`ID_TYPE_ALIMENT`, `LIBELLE`) VALUES
(1, 'Plat composé'),
(2, 'Viande, Oeuf, Poisson, Fruit de Mer\r\n'),
(4, 'Fruit, Légume, Légumineuse\r\n'),
(7, 'Produit laitier'),
(8, 'Produit Céréalier\r\n'),
(9, 'Produit sucré'),
(10, 'Boisson');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `LOGIN` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `NOM` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `PRENOM` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `MAIL` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  `TAILLE` float NOT NULL,
  `POIDS` float NOT NULL,
  `ID_TRANCHE_AGE` int NOT NULL,
  `ID_SEXE` int NOT NULL,
  `ID_SPORT` int NOT NULL,
  PRIMARY KEY (`LOGIN`),
  KEY `utilisateur_ibfk_1` (`ID_SEXE`),
  KEY `utilisateur_ibfk_2` (`ID_SPORT`),
  KEY `utilisateur_ibfk_3` (`ID_TRANCHE_AGE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aliment`
--
ALTER TABLE `aliment`
  ADD CONSTRAINT `aliment_ibfk_1` FOREIGN KEY (`ID_TYPE_ALIMENT`) REFERENCES `type_aliment` (`ID_TYPE_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `besoins_nrj`
--
ALTER TABLE `besoins_nrj`
  ADD CONSTRAINT `besoins_nrj_ibfk_1` FOREIGN KEY (`LOGIN`) REFERENCES `utilisateur` (`LOGIN`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `composer`
--
ALTER TABLE `composer`
  ADD CONSTRAINT `composer_ibfk_1` FOREIGN KEY (`ID_ALIMENT_COMPOSANT`) REFERENCES `aliment` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `composer_ibfk_2` FOREIGN KEY (`ID_ALIMENT_COMPOSE`) REFERENCES `aliment` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `contenir_ibfk_1` FOREIGN KEY (`ID_ALIMENT`) REFERENCES `aliment` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `contenir_ibfk_2` FOREIGN KEY (`ID_MICRONUTRIMENT`) REFERENCES `micronutriments` (`ID_MICRONUTRIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `manger`
--
ALTER TABLE `manger`
  ADD CONSTRAINT `manger_ibfk_1` FOREIGN KEY (`ID_ALIMENT`) REFERENCES `aliment` (`ID_ALIMENT`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `manger_ibfk_2` FOREIGN KEY (`LOGIN`) REFERENCES `utilisateur` (`LOGIN`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`ID_SEXE`) REFERENCES `sexe` (`ID_SEXE`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`ID_SPORT`) REFERENCES `intensite_sport` (`ID_SPORT`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `utilisateur_ibfk_3` FOREIGN KEY (`ID_TRANCHE_AGE`) REFERENCES `tranche_age` (`ID_TRANCHE_AGE`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
