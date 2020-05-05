-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 05 mai 2020 à 15:36
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
-- Base de données :  `ppe-bts1`
--

-- --------------------------------------------------------

--
-- Structure de la table `installer`
--

CREATE TABLE `installer` (
  `nPoste` varchar(7) DEFAULT NULL,
  `nLog` varchar(5) DEFAULT NULL,
  `numIns` int(5) NOT NULL,
  `dateIns` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `delai` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `installer`
--

INSERT INTO `installer` (`nPoste`, `nLog`, `numIns`, `dateIns`, `delai`) VALUES
('p4', 'log3', 3, '2003-05-15 19:39:51', NULL),
('p6', 'log5', 5, '2003-05-14 22:00:00', NULL),
('p8', 'log6', 6, '2003-05-14 22:00:00', NULL),
('p8', 'log7', 7, '2003-05-14 22:00:00', NULL),
('p11', 'log8', 8, '2003-05-14 22:00:00', NULL),
('p2', 'log1', 44, '2020-05-05 10:17:33', NULL),
('p5', 'log2', 46, '2020-05-05 13:58:41', NULL),
('p12', 'log5', 48, '2020-05-05 14:01:12', NULL),
('p11', 'log2', 49, '2020-05-05 14:12:16', NULL);

--
-- Déclencheurs `installer`
--
DELIMITER $$
CREATE TRIGGER `upd_log` AFTER INSERT ON `installer` FOR EACH ROW BEGIN
            DECLARE countLog INT;
            SET countLog = (SELECT COUNT(*) FROM installer WHERE nLog = NEW.nLog);
            UPDATE logiciel SET nbInstall = 0 + countLog WHERE nLog = NEW.nLog;
       END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_log_delete` AFTER DELETE ON `installer` FOR EACH ROW BEGIN
            DECLARE countLog INT;
            SET countLog = (SELECT COUNT(*) FROM installer WHERE nLog = OLD.nLog);
            UPDATE logiciel SET nbInstall = 0 + countLog WHERE nLog = OLD.nLog;
       END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_poste_delete` AFTER DELETE ON `installer` FOR EACH ROW BEGIN
            DECLARE countLogInPoste INT;
            SET countLogInPoste = (SELECT COUNT(*) FROM installer WHERE nPoste = OLD.nPoste);
            UPDATE poste SET nbLog = 0 + countLogInPoste WHERE nPoste = OLD.nPoste;
       END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_poste_insert` AFTER INSERT ON `installer` FOR EACH ROW BEGIN
            DECLARE countLogInPoste INT;
            SET countLogInPoste = (SELECT COUNT(*) FROM installer WHERE nPoste = NEW.nPoste);
            UPDATE poste SET nbLog = 0 + countLogInPoste WHERE nPoste = NEW.nPoste;
       END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `logiciel`
--

CREATE TABLE `logiciel` (
  `nLog` varchar(5) NOT NULL,
  `nomLog` varchar(20) DEFAULT NULL,
  `dateAch` datetime DEFAULT NULL,
  `version` varchar(7) DEFAULT NULL,
  `typeLog` varchar(9) DEFAULT NULL,
  `prix` decimal(6,2) DEFAULT NULL,
  `nbInstall` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `logiciel`
--

INSERT INTO `logiciel` (`nLog`, `nomLog`, `dateAch`, `version`, `typeLog`, `prix`, `nbInstall`) VALUES
('log1', 'Oracle 6', '1995-05-13 00:00:00', '6.2', 'UNIX', '3000.00', 1),
('log2', 'Oracle 8', '1999-09-15 00:00:00', '8i', 'UNIX', '5600.00', 2),
('log3', 'SQL Server', '1998-04-12 00:00:00', '7', 'PCNT', '2700.00', 1),
('log4', 'Front Page', '1997-06-03 00:00:00', '5', 'PCWS', '500.00', 0),
('log5', 'WinDev', '1997-05-12 00:00:00', '5', 'PCWS', '750.00', 2),
('log6', 'SQL*Net', NULL, '2.0', 'UNIX', '500.00', 1),
('log7', 'I. I. S.', '2002-04-12 00:00:00', '2', 'PCNT', '810.00', 1),
('log8', 'DreamWeaver', '2003-09-21 00:00:00', '2.0', 'UNIX', '1400.00', 1);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `logicielsunix`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `logicielsunix` (
`nLog` varchar(5)
,`nomLog` varchar(20)
,`dateAch` datetime
,`version` varchar(7)
,`typeLog` varchar(9)
,`prix` decimal(6,2)
,`nbInstall` tinyint(2)
);

-- --------------------------------------------------------

--
-- Structure de la table `pcseuls`
--

CREATE TABLE `pcseuls` (
  `nP` varchar(7) NOT NULL,
  `nomP` varchar(20) NOT NULL,
  `seg` varchar(11) DEFAULT NULL,
  `ad` int(3) DEFAULT NULL,
  `typeP` varchar(9) DEFAULT NULL,
  `salle` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pcseuls`
--

INSERT INTO `pcseuls` (`nP`, `nomP`, `seg`, `ad`, `typeP`, `salle`) VALUES
('p1', 'Poste 1', '130.120.80', 1, 'TX', 's01'),
('p10', 'Poste 10', '130.120.81', 3, 'UNIX', 's12'),
('p11', 'Poste 11', '130.120.82', 1, 'PCNT', 's21'),
('p12', 'Poste 12', '130.120.82', 2, 'PCWS', 's21'),
('p13', 'Poste abc', '130.120.80', 113, 'NC', 's01'),
('p14', 'ggfgf', '130.120.80', 113, 'NC', 's01'),
('p2', 'Poste 2', '130.120.80', 2, 'UNIX', 's01'),
('p3', 'Poste 3', '130.120.80', 3, 'TX', 's01'),
('p4', 'Poste 4', '130.120.80', 4, 'PCWS', 's02'),
('p5', 'Poste 5', '130.120.80', 5, 'PCWS', 's02'),
('p6', 'Poste 6', '130.120.80', 6, 'UNIX', 's03'),
('p7', 'Poste 7', '130.120.80', 7, 'TX', 's03'),
('p8', 'Poste 8', '130.120.81', 1, 'UNIX', 's11'),
('p9', 'Poste 9', '130.120.81', 2, 'TX', 's11');

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `nPoste` varchar(7) NOT NULL,
  `nomPoste` varchar(20) NOT NULL,
  `indIP` varchar(11) DEFAULT NULL,
  `ad` int(3) DEFAULT NULL,
  `typePoste` varchar(9) DEFAULT NULL,
  `nSalle` varchar(7) DEFAULT NULL,
  `nbLog` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`nPoste`, `nomPoste`, `indIP`, `ad`, `typePoste`, `nSalle`, `nbLog`) VALUES
('p1', 'Poste 1', '130.120.80', 1, 'TX', 's01', 0),
('p10', 'Poste 100', '130.120.81', 3, 'UNIX', 's12', 0),
('p11', 'Poste 11', '130.120.82', 1, 'PCNT', 's21', 2),
('p12', 'Poste 12', '130.120.82', 2, 'PCWS', 's21', 1),
('p13', 'Poste abcd', '130.120.80', 113, 'NC', 's01', 0),
('p14', 'fdfdfdf', '130.120.80', 1, 'NC', 's02', 0),
('p2', 'Poste 2', '130.120.80', 2, 'UNIX', 's01', 1),
('p3', 'Poste 3', '130.120.80', 3, 'TX', 's01', 0),
('p4', 'Poste 4', '130.120.80', 4, 'PCWS', 's02', 1),
('p5', 'Poste 5', '130.120.80', 5, 'PCWS', 's02', 1),
('p6', 'Poste 6', '130.120.80', 6, 'UNIX', 's03', 1),
('p7', 'Poste 7', '130.120.80', 7, 'TX', 's03', 0),
('p8', 'Poste 8', '130.120.81', 1, 'UNIX', 's11', 2),
('p9', 'Poste 9', '130.120.81', 2, 'TX', 's11', 0);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `poste_0`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `poste_0` (
`nPos0` varchar(7)
,`nomPoste0` varchar(20)
,`nSalle0` varchar(7)
,`typePoste0` varchar(9)
,`indIP` varchar(11)
,`ad0` int(3)
);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `nSalle` varchar(7) NOT NULL,
  `nomSalle` varchar(20) NOT NULL,
  `nbPoste` tinyint(2) DEFAULT NULL,
  `indIP` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `salle`
--

INSERT INTO `salle` (`nSalle`, `nomSalle`, `nbPoste`, `indIP`) VALUES
('s01', 'Salle 1', 3, '130.120.80'),
('s02', 'Salle 2', 2, '130.120.80'),
('s03', 'Salle 3', 2, '130.120.80'),
('s11', 'Salle 11', 2, '130.120.81'),
('s12', 'Salle 12', 1, '130.120.81'),
('s21', 'Salle 21', 2, '130.120.82'),
('s22', 'Salle 22', 0, '130.120.82'),
('s23', 'Salle 23', 0, '130.120.82');

-- --------------------------------------------------------

--
-- Structure de la table `segment`
--

CREATE TABLE `segment` (
  `indIP` varchar(11) NOT NULL,
  `nomSegment` varchar(20) NOT NULL,
  `etage` tinyint(1) DEFAULT NULL,
  `nbSalle` tinyint(2) DEFAULT NULL,
  `nbPoste` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `segment`
--

INSERT INTO `segment` (`indIP`, `nomSegment`, `etage`, `nbSalle`, `nbPoste`) VALUES
('130.120.80', 'Brin RDC', 0, NULL, NULL),
('130.120.81', 'Brin 1er  ?tage ', 1, NULL, NULL),
('130.120.82', 'Brin 2eme  ?tage ', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `soft`
--

CREATE TABLE `soft` (
  `nomSoft` varchar(20) DEFAULT NULL,
  `version` varchar(7) DEFAULT NULL,
  `prix` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `soft`
--

INSERT INTO `soft` (`nomSoft`, `version`, `prix`) VALUES
('Oracle 6', '6.2', '3000.00'),
('Oracle 8', '8i', '5600.00'),
('SQL Server', '7', '2700.00'),
('Front Page', '5', '500.00'),
('WinDev', '5', '750.00'),
('SQL*Net', '2.0', '500.00'),
('I. I. S.', '2', '810.00'),
('DreamWeaver', '2.0', '1400.00');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `typeLP` varchar(9) NOT NULL,
  `nomType` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`typeLP`, `nomType`) VALUES
('NC', 'Network Computer'),
('PCNT', 'PC Windows  NT'),
('PCWS', 'PC Windows'),
('TX', 'Terminal X-Window'),
('UNIX', 'Syst?me Unix');

-- --------------------------------------------------------

--
-- Structure de la vue `logicielsunix`
--
DROP TABLE IF EXISTS `logicielsunix`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `logicielsunix`  AS  select `logiciel`.`nLog` AS `nLog`,`logiciel`.`nomLog` AS `nomLog`,`logiciel`.`dateAch` AS `dateAch`,`logiciel`.`version` AS `version`,`logiciel`.`typeLog` AS `typeLog`,`logiciel`.`prix` AS `prix`,`logiciel`.`nbInstall` AS `nbInstall` from `logiciel` where (`logiciel`.`typeLog` = 'UNIX') ;

-- --------------------------------------------------------

--
-- Structure de la vue `poste_0`
--
DROP TABLE IF EXISTS `poste_0`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `poste_0`  AS  select `p`.`nPoste` AS `nPos0`,`p`.`nomPoste` AS `nomPoste0`,`p`.`nSalle` AS `nSalle0`,`p`.`typePoste` AS `typePoste0`,`p`.`indIP` AS `indIP`,`p`.`ad` AS `ad0` from (`poste` `p` join `segment` `s`) where ((`p`.`indIP` = `s`.`indIP`) and (`s`.`etage` = 0)) ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `installer`
--
ALTER TABLE `installer`
  ADD PRIMARY KEY (`numIns`),
  ADD KEY `FK_nPoste` (`nPoste`);

--
-- Index pour la table `logiciel`
--
ALTER TABLE `logiciel`
  ADD PRIMARY KEY (`nLog`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`nPoste`),
  ADD KEY `FK_indIP` (`indIP`),
  ADD KEY `FK_nSalle` (`nSalle`),
  ADD KEY `FK_typePoste` (`typePoste`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`nSalle`);

--
-- Index pour la table `segment`
--
ALTER TABLE `segment`
  ADD PRIMARY KEY (`indIP`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`typeLP`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `installer`
--
ALTER TABLE `installer`
  MODIFY `numIns` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `installer`
--
ALTER TABLE `installer`
  ADD CONSTRAINT `FK_nPoste` FOREIGN KEY (`nPoste`) REFERENCES `poste` (`nPoste`);

--
-- Contraintes pour la table `poste`
--
ALTER TABLE `poste`
  ADD CONSTRAINT `FK_indIP` FOREIGN KEY (`indIP`) REFERENCES `segment` (`indIP`),
  ADD CONSTRAINT `FK_nSalle` FOREIGN KEY (`nSalle`) REFERENCES `salle` (`nSalle`),
  ADD CONSTRAINT `FK_typePoste` FOREIGN KEY (`typePoste`) REFERENCES `types` (`typeLP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
