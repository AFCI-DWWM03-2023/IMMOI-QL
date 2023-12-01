DROP DATABASE IF EXISTS immoi;

CREATE DATABASE IF NOT EXISTS immoi;

USE immoi;

CREATE TABLE utilisateur(
idUtilisateur int(11) NOT NULL,
username varchar(32) NOT NULL,
password varchar(32) NOT NULL,
nom varchar(40),
prenom varchar(40),
telephone varchar(20),
email varchar(80) NOT NULL,
idAdresse int(11)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE agent(
idAgent int(11) NOT NULL,
username varchar(32) NOT NULL,
password varchar(32) NOT NULL,
nom varchar(40) NOT NULL,
prenom varchar(40) NOT NULL,
idAgence int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE bien(
idBien int(11) NOT NULL,
nom varchar(60) NOT NULL,
description text,
prixLocation float,
prixVente float,
categorie varchar(20),
nbPieces int,
nbEtages int,
surface int,
numAppart int,
idUtilisateur int(11) NOT NULL,
idAdresse int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE adresse (
idAdresse int(11) NOT NULL,
nomVoie text NOT NULL,
zipcode varchar(10) NOT NULL,
localite varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE photo (
idPhoto int(11) NOT NULL,
idBien int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE agence(
idAgence int(11) NOT NULL,
nom varchar(20) NOT NULL,
idAdresse int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE administrateur(
username varchar(32) NOT NULL,
password varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE transactions(
idTransaction int(11) NOT NULL,
idAgent int(11) NOT NULL,
idBien int(11) NOT NULL,
dateTransaction date NOT NULL,
montant float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE utilisateur
ADD PRIMARY KEY (`idUtilisateur`),
ADD KEY `FK_ADRESSE` (`idAdresse`),
MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE agent
ADD PRIMARY KEY (`idAgent`),
ADD KEY `FK_AGENCE` (`idAgence`),
MODIFY `idAgent` int(11) NOT NULL AUTO_INCREMENT;

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
ADD KEY `FK_AGENT` (`idAgent`),
ADD KEY `FK_BIEN` (`idBien`),
MODIFY `idTransaction` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE utilisateur
ADD CONSTRAINT `FK_ADRESSE` FOREIGN KEY (`idAdresse`) References `adresse` (`idAdresse`);

ALTER TABLE agent
ADD CONSTRAINT `FK_AGENCE` FOREIGN KEY (`idAgence`) References `agence` (`idAgence`);

ALTER TABLE bien
ADD CONSTRAINT `FK_UTILISATEUR` FOREIGN KEY (`idUtilisateur`) References `utilisateur` (`idUtilisateur`);

ALTER TABLE transactions
ADD CONSTRAINT `FK_AGENT` FOREIGN KEY (`idAgent`) References `agent` (`idAgent`),
ADD CONSTRAINT `FK_BIEN` FOREIGN KEY (`idBien`) References `bien` (`idBien`);

INSERT INTO `utilisateur` (`username`, `password`, `nom`, `prenom`, `telephone`, `email`) VALUES
('brunoracon', 'tr@shPand4', 'Bruno', 'Racon', NULL, 'bruno.racon@pos.sum'),
('TheGiantRat', 'makesupalltherules', 'Samuel', 'Rat', NULL, 'iloverats59@wanadoo.fr'),
('cacus', 'pikAn', NULL, NULL, NULL, 'cacus@ggmail.com');

INSERT INTO `adresse` (`nomVoie`, `zipcode`, `localite`) VALUES
('3 rue des Potiers', '59380', 'Bergues'),
('68 boulevard A. Demain', '14000', 'Caen'),
('23 avenue de la décheterie', 'V68200', 'Raton-sur-Mer'),
("2 square de l'Héxagone", '59000', 'Lille'),
('8 rue E. Tonnet', '59650', "Villeneuve-d'Ascq");

INSERT INTO `agence` (`nom`,`idAdresse`) VALUES
('des Flandres', 1),
('de Caen', 2),
('de Lille',4);

INSERT INTO `agent` (`username`,`password`,`nom`,`prenom`,`idAgence`) VALUES
('princechazton', '7535Dazaetféé30', 'Chazton', 'Prince', 3),
('mariabonbon', '5325Sdadefèé96', 'Bonbon', 'Maria', 2);

INSERT INTO `bien` (`nom`, `description`, `prixLocation`, `prixVente`, `categorie`, `nbPieces`, `nbEtages`, `surface`, `numAppart`, `idUtilisateur`, `idAdresse`) VALUES
('Appartement 1 chambre avec balcon', 'Kitchenette incluse. Vue sur la décheterie. Raccordé par fibre Orange', 600, NULL, 'Appartement', 2, 1, 21, 16, 1, 3),
('Maison centre-ville', NULL, NULL, 141000, 'Maison', 6, 3, 58, NULL, 3, 5);

INSERT INTO transactions (`idAgent`, `idBien`, `dateTransaction`, `montant`) VALUES
(1, 2, '2008-03-15', 141000);

INSERT INTO photo (`idBien`) VALUES
(1),
(1),
(1),
(2),
(2),
(2),
(2);


COMMIT;
