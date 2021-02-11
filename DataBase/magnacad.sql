-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Feb 11, 2021 alle 10:59
-- Versione del server: 10.4.10-MariaDB
-- Versione PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magnacad`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

DROP TABLE IF EXISTS `carrello`;
CREATE TABLE IF NOT EXISTS `carrello` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prodotto` int(11) NOT NULL,
  `quantita` int(50) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prodotto` (`id_prodotto`) USING BTREE,
  KEY `id_user` (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`id`, `id_prodotto`, `quantita`, `id_user`) VALUES
(1, 1, 0, 3),
(2, 8, 0, 3),
(3, 14, 0, 3),
(4, 19, 0, 1),
(5, 20, 0, 1),
(6, 18, 0, 1),
(7, 17, 0, 1),
(8, 9, 0, 2),
(9, 7, 0, 2),
(10, 6, 0, 2),
(11, 15, 0, 4),
(12, 16, 0, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`id`, `nome`) VALUES
(1, 'Bevande Alcoliche'),
(2, 'Bevande Analcoliche'),
(3, 'Biscotti e Brioche'),
(4, 'Caramelle'),
(5, 'Cioccolata'),
(6, 'Cura Personale'),
(7, 'Latticini'),
(8, 'Marmellate e Creme'),
(9, 'Pasta'),
(10, 'Per Neonati e Bambini'),
(11, 'Prodotti per la casa'),
(12, 'Salse'),
(13, 'Snacks'),
(14, 'Sughi e Cibo in Scatola'),
(15, 'Lieviti e altro per preparazioni');

-- --------------------------------------------------------

--
-- Struttura della tabella `dettagli_nutrizionali`
--

DROP TABLE IF EXISTS `dettagli_nutrizionali`;
CREATE TABLE IF NOT EXISTS `dettagli_nutrizionali` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prodotto` int(11) NOT NULL,
  `energia` varchar(50) DEFAULT NULL,
  `grassi` varchar(50) DEFAULT NULL,
  `carboidrati` varchar(50) DEFAULT NULL,
  `proteine` varchar(50) DEFAULT NULL,
  `sale` varchar(50) DEFAULT NULL,
  `anidrite_carbonica` varchar(50) DEFAULT NULL,
  `calcio` varchar(50) DEFAULT NULL,
  `sodio` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_prodotto` (`id_prodotto`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `dettagli_nutrizionali`
--

INSERT INTO `dettagli_nutrizionali` (`id`, `id_prodotto`, `energia`, `grassi`, `carboidrati`, `proteine`, `sale`, `anidrite_carbonica`, `calcio`, `sodio`) VALUES
(1, 1, '10', '2', '0', '5', '1', NULL, NULL, NULL),
(2, 8, '20', '5', '22', '18', '3', NULL, NULL, NULL),
(3, 17, '10', '4', '1', '8', NULL, NULL, NULL, NULL),
(4, 14, '5', '55', NULL, '12', '2', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denominazione` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `groups`
--

INSERT INTO `groups` (`id`, `denominazione`) VALUES
(1, 'Amministratore'),
(2, 'Utente semplice'),
(3, 'Venditore');

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--

DROP TABLE IF EXISTS `immagine`;
CREATE TABLE IF NOT EXISTS `immagine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prodotto` int(11) NOT NULL,
  `url` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prodotto` (`id_prodotto`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `immagine`
--

INSERT INTO `immagine` (`id`, `id_prodotto`, `url`) VALUES
(1, 1, 'https://images-na.ssl-images-amazon.com/images/I/71mT1UlvBXL._AC_SX679_.jpg'),
(2, 8, 'https://images-na.ssl-images-amazon.com/images/I/718EbgLF7XL._AC_SX466_.jpg'),
(3, 17, 'https://images-na.ssl-images-amazon.com/images/I/71173%2BblQWL._AC_SL1500_.jpg'),
(4, 18, 'https://images-na.ssl-images-amazon.com/images/I/81hrkNl3M3L._AC_SX522_.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `info_pagamento`
--

DROP TABLE IF EXISTS `info_pagamento`;
CREATE TABLE IF NOT EXISTS `info_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordine` int(11) NOT NULL,
  `modalita` varchar(100) NOT NULL,
  `numero_carta` varchar(16) DEFAULT NULL,
  `nome_proprietario` varchar(1000) DEFAULT NULL,
  `scadenza` varchar(5) DEFAULT NULL,
  `cvv` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_ordine` (`id_ordine`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `info_pagamento`
--

INSERT INTO `info_pagamento` (`id`, `id_ordine`, `modalita`, `numero_carta`, `nome_proprietario`, `scadenza`, `cvv`) VALUES
(1, 1, 'alla consegna', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `info_spedizione`
--

DROP TABLE IF EXISTS `info_spedizione`;
CREATE TABLE IF NOT EXISTS `info_spedizione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordine` int(11) NOT NULL,
  `città` varchar(100) NOT NULL,
  `via` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `cap` int(11) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `paese` varchar(100) NOT NULL,
  `altre_particolarita` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_ordine` (`id_ordine`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `info_spedizione`
--

INSERT INTO `info_spedizione` (`id`, `id_ordine`, `città`, `via`, `numero`, `cap`, `provincia`, `paese`, `altre_particolarita`) VALUES
(1, 1, 'Roma', 'Colosseo', 10, 100, 'Roma', 'Italia', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `lotto`
--

DROP TABLE IF EXISTS `lotto`;
CREATE TABLE IF NOT EXISTS `lotto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` varchar(100) NOT NULL,
  `quantita_disponibile` int(11) NOT NULL,
  `scadenza` date NOT NULL,
  `id_prodotto` int(11) NOT NULL,
  `id_stabilimento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_stabilimento` (`id_stabilimento`),
  KEY `id_prodotto` (`id_prodotto`,`id_stabilimento`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `lotto`
--

INSERT INTO `lotto` (`id`, `numero`, `quantita_disponibile`, `scadenza`, `id_prodotto`, `id_stabilimento`) VALUES
(1, '1021502150520', 2, '2021-03-31', 1, 1),
(2, '606588401', 10, '2021-03-31', 6, 1),
(3, '01010058552', 6, '2021-03-31', 7, 1),
(4, '56205482020', 4, '2021-03-31', 8, 2),
(5, '0152841650165', 3, '2021-03-31', 9, 5),
(6, '63256949', 6, '2021-03-31', 14, 6),
(7, '6952697', 8, '2021-03-31', 15, 6),
(8, '26321568', 3, '2021-03-31', 16, 6),
(9, '6255848', 7, '2021-03-31', 17, 6),
(10, '256288', 10, '2021-03-31', 18, 7),
(11, '5520558', 6, '2021-03-31', 19, 7),
(12, '8746595', 3, '2021-03-31', 20, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `opzione_pagamento`
--

DROP TABLE IF EXISTS `opzione_pagamento`;
CREATE TABLE IF NOT EXISTS `opzione_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipologia` varchar(50) NOT NULL,
  `numero_carta` varchar(16) DEFAULT NULL,
  `scadenza` varchar(5) DEFAULT NULL,
  `cvv` int(3) DEFAULT NULL,
  `nome_proprietario` text DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `opzione_pagamento`
--

INSERT INTO `opzione_pagamento` (`id`, `tipologia`, `numero_carta`, `scadenza`, `cvv`, `nome_proprietario`, `id_user`) VALUES
(1, 'carta', '548942200378512', '05/25', 123, 'Giacomo Gigi', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `opzione_spedizione`
--

DROP TABLE IF EXISTS `opzione_spedizione`;
CREATE TABLE IF NOT EXISTS `opzione_spedizione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `citta` text NOT NULL,
  `via` text NOT NULL,
  `numero` int(11) NOT NULL,
  `cap` int(11) NOT NULL,
  `provincia` text NOT NULL,
  `paese` text NOT NULL,
  `altre_particolarita` varchar(1000) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `opzione_spedizione`
--

INSERT INTO `opzione_spedizione` (`id`, `citta`, `via`, `numero`, `cap`, `provincia`, `paese`, `altre_particolarita`, `id_user`) VALUES
(1, 'Roma', 'Colosseo', 10, 100, 'Roma', 'Italia', NULL, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

DROP TABLE IF EXISTS `ordine`;
CREATE TABLE IF NOT EXISTS `ordine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `totale` varchar(50) NOT NULL,
  `stato` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `ordine`
--

INSERT INTO `ordine` (`id`, `totale`, `stato`, `data`, `id_user`) VALUES
(1, '10', 'In corso', '2021-01-12', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

DROP TABLE IF EXISTS `prodotto`;
CREATE TABLE IF NOT EXISTS `prodotto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `prezzo` double NOT NULL,
  `sconto` int(11) DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `descrizione` varchar(1000) NOT NULL,
  `id_produttore` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produttore` (`id_produttore`),
  KEY `categoria` (`categoria`,`id_produttore`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `prodotto`
--

INSERT INTO `prodotto` (`id`, `nome`, `prezzo`, `sconto`, `categoria`, `descrizione`, `id_produttore`) VALUES
(1, 'Baiocchi', 2.5, NULL, 3, 'Fragranti biscotti di pastafrolla racchiudono una morbida farcitura di nocciole e cacao. Classica confezione dei biscotti Mulino Bianco o monoporzioni da portare sempre con te. Solo Nocciole italiane. Fragrante Pasta Frolla. Disponibili monoporzioni. Perfetti a colazione.', 1),
(6, 'Plumcake con cioccolato', 3, NULL, 3, 'Plumcake classico con gocce di cioccolato. Mordidezza e semplicità. Senza olio di palma, senza additivi conservanti e senza grassi idrogenati. Senza Olio di Palma. No Additivi Conservanti. Senza Ingredienti OGM. Senza Additivi Coloranti. Senza Grassi Idrogenati.', 1),
(7, 'Plumcake classico', 3, NULL, 3, 'Plumcake classico.Mordidezza e semplicità. Senza olio di palma, senza additivi conservanti e senza grassi idrogenati. Senza Olio di Palma. No Additivi Conservanti. Senza Ingredienti OGM. Senza Additivi Coloranti. Senza Grassi Idrogenati.', 1),
(8, 'Fusilli', 1, NULL, 9, 'numero 34. ', 2),
(9, 'Pennettine', 1, NULL, 9, 'numero 42.', 2),
(14, 'Nutella', 4, NULL, 8, 'Crema di nocciole e cacao', 3),
(15, 'Pocket Coffee', 2.5, NULL, 5, 'Delizioso cioccolatino ripieno al caffè.', 3),
(16, 'Tronky', 1.5, NULL, 13, 'Snack con cacao e cuore di nocciola intera', 3),
(17, 'Kinder Cereali', 1, NULL, 13, 'Barretta con cacao a latte e cereali', 3),
(18, 'Lievito per dolci', 3.5, NULL, 15, 'Bustine da 16g di lievito vanigliato per la preparazione di dolci.', 4),
(19, 'Lievito di birra secco', 4, NULL, 15, 'Lievito di birra secco (16g), ideale per la preparazione di salati', 4),
(20, 'Lievito istantaneo', 3.5, NULL, 15, 'Lievito istantaneo (16g) ideale per qualsiasi preparazione senza tempo di lievitazione', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto_in_ordine`
--

DROP TABLE IF EXISTS `prodotto_in_ordine`;
CREATE TABLE IF NOT EXISTS `prodotto_in_ordine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordine` int(11) NOT NULL,
  `id_prodotto` int(11) NOT NULL,
  `quantita` int(11) NOT NULL,
  `id_lotto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_lotto` (`id_lotto`),
  KEY `id_ordine` (`id_ordine`,`id_lotto`) USING BTREE,
  KEY `id` (`id_prodotto`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `prodotto_in_ordine`
--

INSERT INTO `prodotto_in_ordine` (`id`, `id_ordine`, `id_prodotto`, `quantita`, `id_lotto`) VALUES
(1, 1, 1, 1, 1),
(3, 1, 8, 1, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `produttore`
--

DROP TABLE IF EXISTS `produttore`;
CREATE TABLE IF NOT EXISTS `produttore` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ragione_sociale` varchar(100) NOT NULL,
  `partita_iva` varchar(11) NOT NULL,
  `prefisso` varchar(3) DEFAULT NULL,
  `numero_verde` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sito` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `produttore`
--

INSERT INTO `produttore` (`id`, `ragione_sociale`, `partita_iva`, `prefisso`, `numero_verde`, `email`, `sito`) VALUES
(1, 'Mulino Bianco', '01654010345', NULL, 800862323, 'mulinobianco@info.it', 'mulinobianco.it'),
(2, 'De Cecco', '00628450694', NULL, 800861106, 'servizioclienti@dececco.it', 'dececco.com'),
(3, 'Ferrero spa', '03629090048', NULL, 800909690, 'ferrero@info.it', 'ferrero.com'),
(4, 'Paneangeli', '00638480988', NULL, 800211292, 'paneangeli@info.it', 'paneangeli.it');

-- --------------------------------------------------------

--
-- Struttura della tabella `recensione`
--

DROP TABLE IF EXISTS `recensione`;
CREATE TABLE IF NOT EXISTS `recensione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_prodotto` int(11) NOT NULL,
  `titolo` text NOT NULL,
  `voto` int(1) NOT NULL,
  `testo` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_prodotto` (`id_prodotto`),
  KEY `id_user` (`id_user`,`id_prodotto`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `recensione`
--

INSERT INTO `recensione` (`id`, `id_user`, `id_prodotto`, `titolo`, `voto`, `testo`) VALUES
(1, 3, 1, 'Ottimi', 5, 'Mi piacciono molto, hanno un sapore fantastico'),
(2, 1, 18, 'Eccezionale', 5, 'Lievito davvero fantastico, il migliore che ci sia. Ottimo per preparare qualsiasi dolce.'),
(3, 2, 6, 'Buonissimi', 5, 'Migliori in commercio, sapore davvero unico.'),
(4, 4, 16, 'Buoni', 5, 'Buoni durante una pausa lavorativa durante la giornata, dolcezza giusta.');

-- --------------------------------------------------------

--
-- Struttura della tabella `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `username` varchar(50) NOT NULL,
  `permisions` text NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Struttura della tabella `services_has_groups`
--

DROP TABLE IF EXISTS `services_has_groups`;
CREATE TABLE IF NOT EXISTS `services_has_groups` (
  `services_username` varchar(50) NOT NULL,
  `groups_id` int(11) NOT NULL,
  UNIQUE KEY `services_username` (`services_username`),
  KEY `groups_id` (`groups_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Struttura della tabella `stabilimento`
--

DROP TABLE IF EXISTS `stabilimento`;
CREATE TABLE IF NOT EXISTS `stabilimento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produttore` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `città` varchar(100) NOT NULL,
  `via` varchar(100) NOT NULL,
  `numero` int(11) NOT NULL,
  `cap` int(11) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `paese` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produttore` (`id_produttore`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `stabilimento`
--

INSERT INTO `stabilimento` (`id`, `id_produttore`, `nome`, `città`, `via`, `numero`, `cap`, `provincia`, `paese`) VALUES
(1, 1, 'mulino bianco', 'Ascoli Piceno', 'ascoli', 10, 63100, 'Ascoli Piceno', 'Italia'),
(2, 2, 'sede e stabilimento Fara San Martino', 'Fara San Martino', 'F. de cecco', 0, 66015, 'chieti', 'italia'),
(5, 2, 'Stabilimento Ortona', 'Ortona', 'contrada Caldari Stazione', 69, 66026, 'Chieti', 'italia'),
(6, 3, 'Stabilimento Alba Ferrero', 'Alba', 'piazzale Pietro Ferrero', 1, 12051, 'Cuneo', 'italia'),
(7, 4, 'Stabilimento Paneangeli', 'Desenzano del Garda', 'via angeli', 4, 25015, 'Brescia', 'italia');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` text NOT NULL,
  `cognome` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `data_nascita` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `nome`, `cognome`, `email`, `password`, `data_nascita`) VALUES
(1, 'Chiara', 'Michelucci', 'chiara@magnacad.it', 'chiara', '1990-10-19'),
(2, 'Dragos', 'Stratulat', 'dragos@magnacad.it', 'dragos', '1990-01-05'),
(3, 'Alessandro', 'Carestia', 'alessandro@magnacad.it', 'alessandro', '1990-05-05'),
(4, 'Giacomo', 'Gigi', 'giacomo@gigi.com', 'giacomo', '1980-06-01');

-- --------------------------------------------------------

--
-- Struttura della tabella `users_has_groups`
--

DROP TABLE IF EXISTS `users_has_groups`;
CREATE TABLE IF NOT EXISTS `users_has_groups` (
  `users_id` int(11) NOT NULL,
  `groups_id` int(11) NOT NULL,
  UNIQUE KEY `users_id` (`users_id`,`groups_id`),
  KEY `groups_id` (`groups_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

--
-- Dump dei dati per la tabella `users_has_groups`
--

INSERT INTO `users_has_groups` (`users_id`, `groups_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 2);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `carrello_ibfk_3` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `dettagli_nutrizionali`
--
ALTER TABLE `dettagli_nutrizionali`
  ADD CONSTRAINT `dettagli_nutrizionali_ibfk_1` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `immagine`
--
ALTER TABLE `immagine`
  ADD CONSTRAINT `immagine_ibfk_1` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `info_pagamento`
--
ALTER TABLE `info_pagamento`
  ADD CONSTRAINT `info_pagamento_ibfk_1` FOREIGN KEY (`id_ordine`) REFERENCES `ordine` (`id`);

--
-- Limiti per la tabella `info_spedizione`
--
ALTER TABLE `info_spedizione`
  ADD CONSTRAINT `info_spedizione_ibfk_1` FOREIGN KEY (`id_ordine`) REFERENCES `ordine` (`id`);

--
-- Limiti per la tabella `lotto`
--
ALTER TABLE `lotto`
  ADD CONSTRAINT `lotto_ibfk_2` FOREIGN KEY (`id_stabilimento`) REFERENCES `stabilimento` (`id`),
  ADD CONSTRAINT `lotto_ibfk_3` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `opzione_pagamento`
--
ALTER TABLE `opzione_pagamento`
  ADD CONSTRAINT `opzione_pagamento_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Limiti per la tabella `opzione_spedizione`
--
ALTER TABLE `opzione_spedizione`
  ADD CONSTRAINT `opzione_spedizione_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Limiti per la tabella `ordine`
--
ALTER TABLE `ordine`
  ADD CONSTRAINT `ordine_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Limiti per la tabella `prodotto`
--
ALTER TABLE `prodotto`
  ADD CONSTRAINT `prodotto_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `prodotto_ibfk_2` FOREIGN KEY (`id_produttore`) REFERENCES `produttore` (`id`);

--
-- Limiti per la tabella `prodotto_in_ordine`
--
ALTER TABLE `prodotto_in_ordine`
  ADD CONSTRAINT `prodotto_in_ordine_ibfk_1` FOREIGN KEY (`id_ordine`) REFERENCES `ordine` (`id`),
  ADD CONSTRAINT `prodotto_in_ordine_ibfk_2` FOREIGN KEY (`id_lotto`) REFERENCES `lotto` (`id`),
  ADD CONSTRAINT `prodotto_in_ordine_ibfk_3` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `recensione`
--
ALTER TABLE `recensione`
  ADD CONSTRAINT `recensione_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `recensione_ibfk_3` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotto` (`id`);

--
-- Limiti per la tabella `services_has_groups`
--
ALTER TABLE `services_has_groups`
  ADD CONSTRAINT `services_has_groups_ibfk_1` FOREIGN KEY (`groups_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `services_has_groups_ibfk_2` FOREIGN KEY (`services_username`) REFERENCES `services` (`username`);

--
-- Limiti per la tabella `stabilimento`
--
ALTER TABLE `stabilimento`
  ADD CONSTRAINT `stabilimento_ibfk_1` FOREIGN KEY (`id_produttore`) REFERENCES `produttore` (`id`);

--
-- Limiti per la tabella `users_has_groups`
--
ALTER TABLE `users_has_groups`
  ADD CONSTRAINT `users_has_groups_ibfk_1` FOREIGN KEY (`groups_id`) REFERENCES `groups` (`id`),
  ADD CONSTRAINT `users_has_groups_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
