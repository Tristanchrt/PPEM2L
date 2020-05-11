-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  lun. 11 mai 2020 à 08:00
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
-- Structure de la table `horraire`
--

CREATE TABLE `horraire` (
  `id` int(11) NOT NULL,
  `oneHorraire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `horraire`
--

INSERT INTO `horraire` (`id`, `oneHorraire`) VALUES
(0, '8h - 9h'),
(1, '9h - 10h'),
(2, '10h - 11h'),
(3, '11h - 12h'),
(4, '12h - 13h'),
(5, '13h - 14h'),
(6, '14h - 15h'),
(7, '15h - 16h'),
(8, '16h - 17h'),
(9, '17h - 18h');

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
('p6', 'log5', 5, '2003-05-14 22:00:00', NULL),
('p8', 'log6', 6, '2003-05-14 22:00:00', NULL),
('p8', 'log7', 7, '2003-05-14 22:00:00', NULL),
('p7', 'log7', 60, '2020-05-05 20:10:15', NULL),
('p7', 'log1', 61, '2020-05-05 20:10:15', NULL),
('p7', 'log2', 62, '2020-05-05 20:10:15', NULL),
('p1', 'log2', 63, '2020-05-05 20:12:22', NULL),
('p1', 'log1', 64, '2020-05-05 20:12:22', NULL),
('p1', 'log5', 65, '2020-05-05 20:12:22', NULL),
('p1', 'log6', 66, '2020-05-05 20:12:22', NULL),
('p1', 'log7', 67, '2020-05-05 20:12:22', NULL),
('p5', 'log2', 68, '2020-05-06 08:08:15', NULL),
('p5', 'log4', 69, '2020-05-06 08:08:15', NULL),
('p4', 'log3', 70, '2020-05-06 08:19:39', NULL),
('p4', 'log1', 71, '2020-05-06 08:19:39', NULL),
('p4', 'log2', 72, '2020-05-06 08:19:39', NULL),
('p2', 'log7', 89, '2020-05-07 12:22:34', NULL),
('p2', 'log3', 90, '2020-05-07 12:22:34', NULL),
('p11', 'log2', 91, '2020-05-07 12:52:15', NULL),
('p11', 'log6', 92, '2020-05-07 12:52:15', NULL),
('p11', 'log8', 93, '2020-05-07 12:52:15', NULL),
('p11', 'log1', 94, '2020-05-07 12:52:15', NULL),
('p14', 'log2', 95, '2020-05-09 09:11:03', NULL),
('p14', 'log5', 96, '2020-05-09 09:11:03', NULL),
('p12', 'log4', 99, '2020-05-09 10:19:52', NULL),
('p12', 'log1', 100, '2020-05-09 10:19:52', NULL),
('p12', 'log5', 101, '2020-05-09 10:19:52', NULL),
('p12', 'log7', 102, '2020-05-09 10:19:52', NULL),
('p10', 'log2', 103, '2020-05-11 07:41:49', NULL),
('p10', 'log4', 104, '2020-05-11 07:41:49', NULL),
('p10', 'log3', 105, '2020-05-11 07:41:49', NULL),
('p10', 'log6', 106, '2020-05-11 07:41:49', NULL);

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
('log1', 'Oracle 6', '1995-05-13 00:00:00', '6.2', 'UNIX', '3000.00', 5),
('log2', 'Oracle 8', '1999-09-15 00:00:00', '8i', 'UNIX', '5600.00', 7),
('log3', 'SQL Server', '1998-04-12 00:00:00', '7', 'PCNT', '2700.00', 3),
('log4', 'Front Page', '1997-06-03 00:00:00', '5', 'PCWS', '500.00', 3),
('log5', 'WinDev', '1997-05-12 00:00:00', '5', 'PCWS', '750.00', 4),
('log6', 'SQL*Net', '2020-02-05 00:00:00', '2.0', 'UNIX', '500.00', 4),
('log7', 'I. I. S.', '2002-04-12 00:00:00', '2', 'PCNT', '810.00', 5),
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
-- Structure de la table `mrbs_users`
--

CREATE TABLE `mrbs_users` (
  `id` int(11) NOT NULL,
  `level` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(30) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `email` varchar(75) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mrbs_users`
--

INSERT INTO `mrbs_users` (`id`, `level`, `name`, `password`, `email`) VALUES
(1, 2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin.mrbs@lorraine-sport.net'),
(2, 0, 'cheminl', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'chemin.lorette@lorraine-sport.net'),
(3, 0, 'fortetp', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'fortet.patrick@lorraine-sport.net'),
(4, 0, 'dreauv', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'dreau.valerie@lorraine-sport.net'),
(5, 2, 'antoineq', '21232f297a57a5a743894a0e4a801fc3', 'antoine.quentin@lorraine-sport.net'),
(6, 2, 'aubinv', '21232f297a57a5a743894a0e4a801fc3', 'aubin.veronique@lorraine-sport.net'),
(7, 2, 'ackermanns', '21232f297a57a5a743894a0e4a801fc3', 'ackermann.solange@lorraine-sport.net'),
(8, 1, 'guesdonm', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'guesdon.martin@lorraine-sport.net'),
(9, 1, 'grenierf', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'grenier.francoise@lorraine-sport.net'),
(10, 1, 'giboired', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'giboire.david@lorraine-sport.net'),
(11, 1, 'guillemetm', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'guillemet.martin@lorraine-sport.net'),
(12, 1, 'guilletm', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'guillet.maud@lorraine-sport.net'),
(13, 1, 'gilbertj', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'gilbert.jordan@lorraine-sport.net'),
(14, 1, 'grelichef', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'greliche.franck@lorraine-sport.net'),
(15, 1, 'garniert', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'garnier.theo@lorraine-sport.net'),
(16, 1, 'gaigar', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'gaiga.renan@lorraine-sport.net'),
(17, 1, 'glavork', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'glavor.kevin@lorraine-sport.net'),
(18, 0, 'lunavote', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'lunavot.eric@lorraine-sport.net'),
(19, 0, 'borsellinoj', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'borsellino.jean-marc@lorraine-sport.net'),
(20, 0, 'daumyn', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'daumy.nicolas@lorraine-sport.net'),
(21, 0, 'chambonp', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'chambon.patrick@lorraine-sport.net'),
(22, 0, 'lecadetc', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'lecadet.cecile@lorraine-sport.net'),
(23, 0, 'vannierl', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'vannier.louis@lorraine-sport.net'),
(24, 0, 'minets', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'minet.sabrina@lorraine-sport.net'),
(25, 0, 'bourgeoiss', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'bourgeois.simon@lorraine-sport.net'),
(26, 0, 'charleta', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'charlet.aurelie@lorraine-sport.net'),
(27, 0, 'pirotl', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'pirot.lea@lorraine-sport.net'),
(28, 0, 'michauxa', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'michaux.alexandre@lorraine-sport.net'),
(29, 0, 'cullerierj', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'cullerier.jerome@lorraine-sport.net'),
(30, 0, 'monnetm', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'monnet.michel@lorraine-sport.net'),
(31, 0, 'bergerv', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'berger.vanessa@lorraine-sport.net'),
(32, 0, 'duquennel', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'duquenne.luc@lorraine-sport.net'),
(33, 0, 'vassalm', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'vassal.marc@lorraine-sport.net'),
(34, 0, 'samsonm', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'samson.maryline@lorraine-sport.net'),
(35, 0, 'vassale', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'vassal.elizabeth@lorraine-sport.net'),
(36, 0, 'dubuism', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'dubuis.marie@lorraine-sport.net'),
(37, 0, 'briseuxs', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'briseux.serge@lorraine-sport.net'),
(38, 0, 'zambonie', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'zamboni.estelle@lorraine-sport.net'),
(39, 0, 'vernonc', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'vernon.christian@lorraine-sport.net'),
(40, 0, 'micherouxe', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'micheroux.emmanuel@lorraine-sport.net'),
(41, 0, 'philippej', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'philippe.jocelyne@lorraine-sport.net'),
(42, 0, 'brisseaup', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'brisseau.pierre-jean@lorraine-sport.net'),
(43, 0, 'meneure', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'meneur.emmanuel@lorraine-sport.net'),
(44, 0, 'martelh', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'martel.herve@lorraine-sport.net'),
(45, 0, 'fernandesf', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'fernandes.fabrice@lorraine-sport.net'),
(46, 0, 'loubata', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'loubat.agnes@lorraine-sport.net'),
(47, 0, 'mogest', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'moges.thierry@lorraine-sport.net'),
(48, 0, 'bulicm', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'bulic.marc@lorraine-sport.net'),
(49, 0, 'coulombelt', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'coulombel.thomas@lorraine-sport.net'),
(50, 0, 'noirotm', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'noirot.maxime@lorraine-sport.net'),
(51, 0, 'martinageo', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'martinage.ophelie@lorraine-sport.net'),
(52, 0, 'corvaisierk', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'corvaisier.kevin@lorraine-sport.net'),
(53, 0, 'danetc', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'danet.christophe@lorraine-sport.net'),
(54, 0, 'antoineq', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'antoine.quentin@lorraine-sport.net'),
(55, 0, 'ouing', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'ouin.georges@lorraine-sport.net'),
(56, 0, 'mabilaisl', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'mabilais.liliane@lorraine-sport.net'),
(57, 0, 'charbonnelt', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'charbonnel.tanguy@lorraine-sport.net'),
(58, 0, 'droaly', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'droal.yves@lorraine-sport.net'),
(59, 0, 'rocherf', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'rocher.fabienne@lorraine-sport.net'),
(60, 0, 'triballata', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'triballat.amelie@lorraine-sport.net'),
(61, 0, 'martih', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'marti.herve@lorraine-sport.net'),
(62, 0, 'vollej', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'volle.jocelyn@lorraine-sport.net'),
(63, 0, 'hubertx', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'hubert.xavier@lorraine-sport.net'),
(64, 0, 'lieutierv', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'lieutier.vianney@lorraine-sport.net'),
(65, 0, 'cabalf', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'cabal.frederick@lorraine-sport.net'),
(66, 0, 'kriegerc', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'krieger.christian@lorraine-sport.net'),
(67, 0, 'fischerh', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'fischer.helene@lorraine-sport.net'),
(68, 0, 'descatb', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'descat.bastien@lorraine-sport.net'),
(69, 0, 'humbertf', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'humbert.felix@lorraine-sport.net'),
(70, 0, 'landrieux', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'landrieu.xavier@lorraine-sport.net'),
(71, 0, 'delpeyroua', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'delpeyrou.andre@lorraine-sport.net'),
(72, 0, 'rodierd', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'rodier.denis@lorraine-sport.net'),
(73, 0, 'boyers', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'boyer.suzanne@lorraine-sport.net'),
(74, 0, 'chassonn', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'chasson.nicole@lorraine-sport.net'),
(75, 0, 'cuenotb', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'cuenot.bruno@lorraine-sport.net'),
(76, 0, 'pitonu', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'piton.ursule@lorraine-sport.net'),
(77, 0, 'gariny', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'garin.yvette@lorraine-sport.net'),
(78, 0, 'salioum', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'saliou.marcel@lorraine-sport.net'),
(79, 0, 'rigalg', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'rigal.guenole@lorraine-sport.net'),
(80, 0, 'pelhatel', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'pelhate.loic@lorraine-sport.net'),
(81, 0, 'skweresp', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'skweres.paul@lorraine-sport.net'),
(82, 0, 'haviso', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'havis.odette@lorraine-sport.net'),
(83, 0, 'rigalj', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'rigal.jonathan@lorraine-sport.net'),
(84, 0, 'cochetr', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'cochet.remi@lorraine-sport.net'),
(85, 0, 'blinm', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'blin.morgane@lorraine-sport.net'),
(86, 0, 'mazurierv', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'mazurier.vincent@lorraine-sport.net'),
(87, 0, 'robichets', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'robichet.sylvain@lorraine-sport.net'),
(88, 0, 'brouillatf', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'brouillat.francois@lorraine-sport.net'),
(89, 0, 'legerg', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'leger.geraldine@lorraine-sport.net'),
(90, 0, 'despresv', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'despres.viviane@lorraine-sport.net'),
(91, 0, 'bretonj', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'breton.jean@lorraine-sport.net'),
(92, 0, 'duboisl', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'dubois.laurence@lorraine-sport.net'),
(93, 0, 'mousquetj', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'mousquet.jean@lorraine-sport.net'),
(94, 0, 'robuttep', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'robutte.philippe@lorraine-sport.net'),
(95, 0, 'lecailleo', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'lecaille.oriane@lorraine-sport.net'),
(96, 0, 'veriteb', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'verite.brendan@lorraine-sport.net'),
(97, 0, 'dauthieub', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'dauthieu.bryan@lorraine-sport.net'),
(98, 0, 'blancj', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'blanc.jean-marc@lorraine-sport.net'),
(99, 0, 'dongelingeri', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'dongelinger.irene@lorraine-sport.net'),
(100, 0, 'hochetg', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'hochet.guy@lorraine-sport.net'),
(101, 0, 'lecorree', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'lecorre.emile@lorraine-sport.net'),
(102, 0, 'sacheta', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'sachet.armelle@lorraine-sport.net'),
(103, 0, 'bavelardp', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'bavelard.paul@lorraine-sport.net'),
(104, 0, 'panagetr', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'panaget.remi@lorraine-sport.net'),
(105, 0, 'aubinv', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'aubin.veronique@lorraine-sport.net'),
(106, 0, 'ackermanns', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'ackermann.solange@lorraine-sport.net'),
(107, 0, 'hainryd', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'hainry.david@lorraine-sport.net'),
(108, 0, 'trouchetc', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'trouchet.carinne@lorraine-sport.net'),
(109, 0, 'bertelles', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'bertelle.sophie@lorraine-sport.net'),
(110, 0, 'pannetierc', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'pannetier.celine@lorraine-sport.net'),
(111, 0, 'poulainm', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'poulain.marie-ange@lorraine-sport.net'),
(112, 0, 'stervinour', 'b89f7a5ff3e3a225d572dac38b2a67f7', 'stervinou.romain@lorraine-sport.net'),
(113, 2, 'test', 'seCBdk.BxFGa6', 'test@bts.sio'),
(114, 0, 'titi123', 'se/l04rCNic9A', 'titi');

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
-- Structure de la table `planningreserved`
--

CREATE TABLE `planningreserved` (
  `id` int(11) NOT NULL,
  `dateSelected` datetime NOT NULL,
  `heureid` int(11) NOT NULL,
  `userReserved` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `idSalle` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `planningreserved`
--

INSERT INTO `planningreserved` (`id`, `dateSelected`, `heureid`, `userReserved`, `title`, `idSalle`) VALUES
(3, '2020-05-04 00:00:00', 7, 19, 'ghhghghgh', 's01'),
(4, '2020-05-07 00:00:00', 9, 1, 'qqqqqqqqq', 's21'),
(5, '2020-05-11 00:00:00', 4, 26, 'jhjhhjhjjh', 's02'),
(59, '2020-05-06 00:00:00', 9, 113, 'nbnbnbnbnbnb', 's01'),
(61, '2020-05-07 00:00:00', 8, 113, 'Pomme bleu', 's01'),
(64, '2020-05-15 00:00:00', 2, 113, 'gddfgfgddx', 's02'),
(65, '2020-05-05 00:00:00', 3, 113, 'fdfdfdfdfd', 's02'),
(97, '2020-05-12 00:00:00', 6, 113, 'eeeeeeeee', 's02'),
(100, '2020-05-13 00:00:00', 1, 113, 'sdfdfdfd', 's01'),
(101, '2020-05-12 00:00:00', 5, 113, 'dffdfdfd', 's01'),
(102, '2020-05-05 00:00:00', 0, 113, 'hjjhjhjhhj', 's01'),
(103, '2020-05-06 00:00:00', 3, 113, 'jhjhjhjhjhjh', 's01');

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
('p1', 'Poste 1', '130.120.80', 1, 'TX', 's01', 5),
('p10', 'fdfdd', '130.120.80', NULL, 'PCNT', 's02', 4),
('p11', 'Poste 11', '130.120.82', 1, 'PCNT', 's21', 4),
('p12', 'Poste 12', '130.120.82', 2, 'PCWS', 's21', 4),
('p14', 'ouiEtononon', '130.120.80', 1, 'UNIX', 's02', 2),
('p2', 'Poste 2', '130.120.80', 2, 'UNIX', 's01', 2),
('p3', 'Poste 3', '130.120.80', 3, 'TX', 's01', 0),
('p4', 'Poste 4', '130.120.80', 4, 'PCWS', 's02', 3),
('p5', 'Poste 5', '130.120.80', 5, 'PCWS', 's02', 2),
('p6', 'Poste 6', '130.120.80', 6, 'UNIX', 's03', 1),
('p7', 'Poste 7', '130.120.80', 7, 'TX', 's03', 3),
('p8', 'Poste 8', '130.120.81', 1, 'UNIX', 's11', 2);

--
-- Déclencheurs `poste`
--
DELIMITER $$
CREATE TRIGGER `upd_segmentNbPoste_delete` AFTER DELETE ON `poste` FOR EACH ROW BEGIN
            DECLARE countNbPoste INT;
            SET countNbPoste = (SELECT COUNT(*) FROM poste WHERE indIP = OLD.indIP);
            UPDATE segment SET nbPoste = 0 + countNbPoste WHERE indIP = OLD.indIP;
       END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_segmentNbPoste_insert` AFTER INSERT ON `poste` FOR EACH ROW BEGIN
            DECLARE countNbPoste INT;
            SET countNbPoste = (SELECT COUNT(*) FROM poste WHERE indIP = NEW.indIP);
            UPDATE segment SET nbPoste = 0 + countNbPoste WHERE indIP = NEW.indIP;
       END
$$
DELIMITER ;

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
('s21', 'Salle 21', 2, '130.120.82');

--
-- Déclencheurs `salle`
--
DELIMITER $$
CREATE TRIGGER `upd_segmentSalle_delete` AFTER DELETE ON `salle` FOR EACH ROW BEGIN
            DECLARE countSalleIndIP INT;
            SET countSalleIndIP = (SELECT COUNT(*) FROM salle WHERE indIP = OLD.indIP);
            UPDATE segment SET nbSalle = 0 + countSalleIndIP WHERE indIP = OLD.indIP;
       END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `upd_segmentSalle_insert` AFTER INSERT ON `salle` FOR EACH ROW BEGIN
            DECLARE countSalleIndIP INT;
            SET countSalleIndIP = (SELECT COUNT(*) FROM salle WHERE indIP = NEW.indIP);
            UPDATE segment SET nbSalle = 0 + countSalleIndIP WHERE indIP = NEW.indIP;
       END
$$
DELIMITER ;

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
('130.120.80', 'Brin RDC', 0, 3, 8),
('130.120.81', 'Brin 1er  ?tage ', 1, 2, 1),
('130.120.82', 'Brin 2eme  ?tage ', 2, 1, 2);

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
-- Index pour la table `horraire`
--
ALTER TABLE `horraire`
  ADD PRIMARY KEY (`id`);

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
-- Index pour la table `mrbs_users`
--
ALTER TABLE `mrbs_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `planningreserved`
--
ALTER TABLE `planningreserved`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_heureid` (`heureid`),
  ADD KEY `fk_userReserved` (`userReserved`),
  ADD KEY `fk_idSalle` (`idSalle`);

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
-- AUTO_INCREMENT pour la table `horraire`
--
ALTER TABLE `horraire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `installer`
--
ALTER TABLE `installer`
  MODIFY `numIns` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT pour la table `mrbs_users`
--
ALTER TABLE `mrbs_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT pour la table `planningreserved`
--
ALTER TABLE `planningreserved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `installer`
--
ALTER TABLE `installer`
  ADD CONSTRAINT `FK_nPoste` FOREIGN KEY (`nPoste`) REFERENCES `poste` (`nPoste`);

--
-- Contraintes pour la table `planningreserved`
--
ALTER TABLE `planningreserved`
  ADD CONSTRAINT `fk_heureid` FOREIGN KEY (`heureid`) REFERENCES `horraire` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_idSalle` FOREIGN KEY (`idSalle`) REFERENCES `salle` (`nSalle`),
  ADD CONSTRAINT `fk_userReserved` FOREIGN KEY (`userReserved`) REFERENCES `mrbs_users` (`id`) ON UPDATE CASCADE;

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
