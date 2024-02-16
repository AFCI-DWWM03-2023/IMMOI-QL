-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le : ven. 16 fév. 2024 à 10:48
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immoi`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`username`, `password`) VALUES
('admin', 'root');

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `idAdresse` int NOT NULL AUTO_INCREMENT,
  `nomVoie` text NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `localite` varchar(60) NOT NULL,
  PRIMARY KEY (`idAdresse`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`idAdresse`, `nomVoie`, `zipcode`, `localite`) VALUES
(1, '3 rue des Potiers', '59380', 'Bergues'),
(2, '68 boulevard A. Demain', '14000', 'Caen'),
(3, '2 square de l\'Héxagone', '59000', 'Lille'),
(6, '123 avenue Tile', '42600', 'Montbrison'),
(7, '123 boulevard Ticulation', '16430', 'Champniers'),
(17, '123', '12345', 'blablaville'),
(18, '123 rue machin', '50000', 'Saint-Lô'),
(30, '123 rue Stique', '28000', 'Chartres');

-- --------------------------------------------------------

--
-- Structure de la table `agence`
--

DROP TABLE IF EXISTS `agence`;
CREATE TABLE IF NOT EXISTS `agence` (
  `idAgence` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `idAdresse` int NOT NULL,
  PRIMARY KEY (`idAgence`),
  KEY `FK_ADRESSE` (`idAdresse`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `agence`
--

INSERT INTO `agence` (`idAgence`, `nom`, `idAdresse`) VALUES
(1, 'des Flandres', 1),
(2, 'de Caen', 2),
(3, 'de Lille', 3);

-- --------------------------------------------------------

--
-- Structure de la table `bien`
--

DROP TABLE IF EXISTS `bien`;
CREATE TABLE IF NOT EXISTS `bien` (
  `idBien` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(60) NOT NULL,
  `description` text,
  `prixLocation` float DEFAULT NULL,
  `prixVente` float DEFAULT NULL,
  `categorie` varchar(20) DEFAULT NULL,
  `nbPieces` int NOT NULL,
  `nbEtages` int DEFAULT NULL,
  `surface` int NOT NULL,
  `numAppart` int DEFAULT NULL,
  `idUtilisateur` int NOT NULL,
  `idAdresse` int NOT NULL,
  PRIMARY KEY (`idBien`),
  KEY `FK_ADRESSE` (`idAdresse`),
  KEY `FK_UTILISATEUR` (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bien`
--

INSERT INTO `bien` (`idBien`, `nom`, `description`, `prixLocation`, `prixVente`, `categorie`, `nbPieces`, `nbEtages`, `surface`, `numAppart`, `idUtilisateur`, `idAdresse`) VALUES
(1, 'Grande Maison', 'Description', NULL, 250000, 'maison', 8, 0, 150, 0, 1, 30),
(2, 'Appartement Centre-ville', 'Description', 850, NULL, 'appart', 3, 1, 40, 1, 1, 6),
(3, 'Maison Moderne', 'Description', NULL, 123457000, 'maison', 6, 1, 200, 0, 7, 7),
(13, 'test', 'desc', NULL, 123, 'maison', 1, 2, 3, 0, 7, 17),
(14, 'appart', 'appart avec cuisine', NULL, 13200, 'appart', 2, 0, 21, 8, 8, 18);

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `idPhoto` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(128) NOT NULL,
  `couverture` tinyint(1) DEFAULT NULL,
  `idBien` int NOT NULL,
  PRIMARY KEY (`idPhoto`),
  KEY `FK_BIEN` (`idBien`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`idPhoto`, `nom`, `couverture`, `idBien`) VALUES
(25, '41521_modele-de-maison-traditionnelle-etage-cypres-ancien.jpg', 1, 1),
(36, '41797_appart.png', 1, 2),
(44, '49562_maisons-modernes-modeles-plans-amenagement.jpg', 1, 3),
(46, '19755_maison-isolee-terrain.jpg', 1, 13);

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `idTransaction` int NOT NULL AUTO_INCREMENT,
  `montant` float NOT NULL,
  `dateTransaction` date NOT NULL,
  `acheteur` int DEFAULT NULL,
  `vendeur` int DEFAULT NULL,
  `agent` int NOT NULL,
  `idBien` int NOT NULL,
  PRIMARY KEY (`idTransaction`),
  KEY `FK_AGENT` (`agent`),
  KEY `FK_ACHETEUR` (`acheteur`),
  KEY `FK_VENDEUR` (`vendeur`),
  KEY `FK_BIEN` (`idBien`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nom` varchar(40) DEFAULT NULL,
  `prenom` varchar(40) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `email` varchar(80) NOT NULL,
  `idAdresse` int DEFAULT NULL,
  `estAgent` tinyint(1) DEFAULT NULL,
  `agence` int DEFAULT NULL,
  PRIMARY KEY (`idUtilisateur`),
  KEY `FK_ADRESSE` (`idAdresse`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `username`, `password`, `nom`, `prenom`, `telephone`, `email`, `idAdresse`, `estAgent`, `agence`) VALUES
(1, 'brunoracon', '$2y$10$nHDGVHMlbZ0tqoXEvv2DmelVRTB14tutDot7SscoqhSDlhUYKjkry', 'racon', 'bruno', '', 'bruno.racon@pos.sum', NULL, NULL, NULL),
(2, 'princechazton', '$2y$10$y9RTlxlEueOK0rqsrQe1be38.zObpBURchZRNqb1rHATCtXzFJ9cy', 'Chazton', 'Prince', NULL, 'chazton.prince@immoi.fr', NULL, 1, 3),
(3, 'mariabonbon', '$2y$10$tUAdmPhIxo9EaAfMOIJQmOlDDAPwnjBU/VVGq8dptL9Z2AhH7KOBC', 'Bonbon', 'Maria', NULL, 'bonbon.maria@immoi.fr', NULL, 1, 3),
(4, 'agenttest', '$2y$10$AIZk.qTnZwrbb4YbbjnxGeV/lfFLI2fW8GrIbvjIz8HxODjrxU/Ni', NULL, NULL, NULL, 'agent.test@immoi.fr', NULL, 1, 2),
(5, 'blabla', '$2y$10$1yWGXmL1lwl5GaM8T07wh.SeEV0GmqiTqdMaVJL93lJnIvKxROIW2', NULL, NULL, NULL, 'blabla@gmail.fr', NULL, NULL, NULL),
(6, 'HommeRiche', '$2y$10$GvhzAITR8ETT34hIw7M7MOK7CtZfGmqvWXoAodiIbNu/RWd4OYgFW', 'Rockefeller', 'Richie', '', 'money.money@money.dollar', NULL, NULL, NULL),
(7, 'APeters', '$2y$10$xnt3dinHorfVSiOtYcOm1OZqHvUMPVv1k7gPaEPoo/FGLJhBntY76', NULL, NULL, NULL, 'peters.albert@gmail.com', NULL, NULL, NULL),
(8, 'dadada589', '$2y$10$iRuDdwA6EIEwLNHgNfs51eVqlJegN08ps8gpv3/A3S4nSnk/KWVJy', NULL, NULL, NULL, 'dadada589@mail.fr', NULL, NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bien`
--
ALTER TABLE `bien`
  ADD CONSTRAINT `FK_UTILISATEUR` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `FK_ACHETEUR` FOREIGN KEY (`acheteur`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `FK_AGENT` FOREIGN KEY (`agent`) REFERENCES `utilisateur` (`idUtilisateur`),
  ADD CONSTRAINT `FK_BIEN` FOREIGN KEY (`idBien`) REFERENCES `bien` (`idBien`),
  ADD CONSTRAINT `FK_VENDEUR` FOREIGN KEY (`vendeur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_ADRESSE` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`idAdresse`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
