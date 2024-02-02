DROP DATABASE IF EXISTS immoi;

CREATE DATABASE IF NOT EXISTS immoi;

USE immoi;

CREATE TABLE utilisateur(
idUtilisateur int(11) NOT NULL,
username varchar(32) NOT NULL,
password varchar(64) NOT NULL,
nom varchar(40),
prenom varchar(40),
telephone varchar(20),
email varchar(80) NOT NULL,
idAdresse int(11),
estAgent boolean,
agence int(11)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE bien(
idBien int(11) NOT NULL,
nom varchar(32) NOT NULL,
description text,
prixLocation float,
prixVente float,
categorie varchar(20),
nbPieces int,
nbEtages int,
surface int NOT NULL,
numAppart int,
idUtilisateur int(11) NOT NULL,
idAdresse int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE adresse (
idAdresse int(11) NOT NULL,
nomVoie text NOT NULL,
zipcode varchar(10) NOT NULL,
localite varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE photo (
idPhoto int(11) NOT NULL,
nom varchar(128) NOT NULL,
couverture boolean,
idBien int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE agence(
idAgence int(11) NOT NULL,
nom varchar(20) NOT NULL,
idAdresse int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE administrateur(
username varchar(32) NOT NULL,
password varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE transactions(
idTransaction int(11) NOT NULL,
montant float NOT NULL,
dateTransaction date NOT NULL,
acheteur int(11),
vendeur int(11),
agent int(11) NOT NULL,
idBien int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE utilisateur
ADD PRIMARY KEY (`idUtilisateur`),
ADD KEY `FK_ADRESSE` (`idAdresse`),
MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE bien
ADD PRIMARY KEY (`idBien`),
ADD KEY `FK_ADRESSE` (`idAdresse`),
ADD KEY `FK_UTILISATEUR` (`idUtilisateur`),
MODIFY `idBien` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE adresse
ADD PRIMARY KEY (`idAdresse`),
MODIFY `idAdresse` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE photo
ADD PRIMARY KEY (`idPhoto`),
ADD KEY `FK_BIEN` (`idBien`),
MODIFY `idPhoto` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE agence
ADD PRIMARY KEY (`idAgence`),
ADD KEY `FK_ADRESSE` (`idAdresse`),
MODIFY `idAgence` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE transactions
ADD PRIMARY KEY (`idTransaction`),
ADD KEY `FK_AGENT` (`agent`),
ADD KEY `FK_ACHETEUR` (`acheteur`),
ADD KEY `FK_VENDEUR` (`vendeur`),
ADD KEY `FK_BIEN` (`idBien`),
MODIFY `idTransaction` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE administrateur
ADD PRIMARY KEY (`username`);

ALTER TABLE utilisateur
ADD CONSTRAINT `FK_ADRESSE` FOREIGN KEY (`idAdresse`) References `adresse` (`idAdresse`);

ALTER TABLE bien
ADD CONSTRAINT `FK_UTILISATEUR` FOREIGN KEY (`idUtilisateur`) References `utilisateur` (`idUtilisateur`);

ALTER TABLE transactions
ADD CONSTRAINT `FK_AGENT` FOREIGN KEY (`agent`) References `utilisateur` (`idUtilisateur`),
ADD CONSTRAINT `FK_ACHETEUR` FOREIGN KEY (`acheteur`) References `utilisateur` (`idUtilisateur`),
ADD CONSTRAINT `FK_VENDEUR` FOREIGN KEY (`vendeur`) References `utilisateur` (`idUtilisateur`),
ADD CONSTRAINT `FK_BIEN` FOREIGN KEY (`idBien`) References `bien` (`idBien`);

INSERT INTO `utilisateur` (`username`, `password`, `nom`, `prenom`, `telephone`, `email`, `estAgent`, `agence`) VALUES
('brunoracon', '$2y$10$nHDGVHMlbZ0tqoXEvv2DmelVRTB14tutDot7SscoqhSDlhUYKjkry', 'Racon', 'Bruno', NULL, 'bruno.racon@pos.sum', NULL, NULL),
('princechazton', '$2y$10$y9RTlxlEueOK0rqsrQe1be38.zObpBURchZRNqb1rHATCtXzFJ9cy', 'Chazton', 'Prince', NULL, 'chazton.prince@immoi.fr', true, 3),
('mariabonbon', '$2y$10$tUAdmPhIxo9EaAfMOIJQmOlDDAPwnjBU/VVGq8dptL9Z2AhH7KOBC', 'Bonbon', 'Maria', NULL, 'bonbon.maria@immoi.fr', true, 3);

INSERT INTO `adresse` (`nomVoie`, `zipcode`, `localite`) VALUES
('3 rue des Potiers', '59380', 'Bergues'),
('68 boulevard A. Demain', '14000', 'Caen'),
("2 square de l'Héxagone", '59000', 'Lille'),
("123 rue Stique", '25040', 'Badevel');

INSERT INTO `agence` (`nom`,`idAdresse`) VALUES
('des Flandres', 1),
('de Caen', 2),
('de Lille',3);

INSERT INTO `administrateur` (`username`, `password`) VALUES
('admin', 'root');

INSERT INTO `bien` (`nom`, `description`, `prixVente`, `categorie`, `idUtilisateur`, `idAdresse`, `surface`, `nbPieces`) VALUES
('Grande Maison', 'Description', 200000, 'maison', 1, 4, 150, 8);

INSERT INTO `photo` (`nom`, `couverture`, `idBien`) VALUES
('32696_licensed-image', true, 1);

COMMIT;
