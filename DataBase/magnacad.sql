-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Dic 21, 2020 alle 10:26
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
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_prodotto` (`id_prodotto`),
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Struttura della tabella `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `denominazione` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Struttura della tabella `immagine`
--

DROP TABLE IF EXISTS `immagine`;
CREATE TABLE IF NOT EXISTS `immagine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_prodotto` int(11) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_prodotto` (`id_prodotto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Struttura della tabella `info_pagamento`
--

DROP TABLE IF EXISTS `info_pagamento`;
CREATE TABLE IF NOT EXISTS `info_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ordine` int(11) NOT NULL,
  `modalita` varchar(100) NOT NULL,
  `numero_carta` int(16) DEFAULT NULL,
  `scadenza` varchar(5) DEFAULT NULL,
  `cvv` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_ordine` (`id_ordine`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

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
  UNIQUE KEY `id_prodotto` (`id_prodotto`,`id_stabilimento`),
  KEY `id_stabilimento` (`id_stabilimento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Struttura della tabella `opzione_pagamento`
--

DROP TABLE IF EXISTS `opzione_pagamento`;
CREATE TABLE IF NOT EXISTS `opzione_pagamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero_carta` int(16) NOT NULL,
  `scadenza` varchar(5) NOT NULL,
  `cvv` int(3) NOT NULL,
  `nome_proprietario` text NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

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
  UNIQUE KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Struttura della tabella `ordine`
--

DROP TABLE IF EXISTS `ordine`;
CREATE TABLE IF NOT EXISTS `ordine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `totale` int(50) NOT NULL,
  `stato` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_carrello` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user` (`id_user`,`id_carrello`),
  KEY `id_carrello` (`id_carrello`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto`
--

DROP TABLE IF EXISTS `prodotto`;
CREATE TABLE IF NOT EXISTS `prodotto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prezzo` double NOT NULL,
  `sconto` int(11) DEFAULT NULL,
  `categoria` int(11) NOT NULL,
  `descrizione` varchar(1000) NOT NULL,
  `id_produttore` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categoria` (`categoria`,`id_produttore`),
  KEY `id_produttore` (`id_produttore`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotto_in_ordine`
--

DROP TABLE IF EXISTS `prodotto_in_ordine`;
CREATE TABLE IF NOT EXISTS `prodotto_in_ordine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantita` int(11) NOT NULL,
  `id_ordine` int(11) NOT NULL,
  `id_lotto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_ordine` (`id_ordine`,`id_lotto`),
  KEY `id_lotto` (`id_lotto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

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
  UNIQUE KEY `id_user` (`id_user`,`id_prodotto`),
  KEY `id_prodotto` (`id_prodotto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

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
  UNIQUE KEY `groups_id` (`groups_id`),
  UNIQUE KEY `services_username` (`services_username`)
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
  UNIQUE KEY `id_produttore` (`id_produttore`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf16;

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
  ADD CONSTRAINT `ordine_ibfk_1` FOREIGN KEY (`id_carrello`) REFERENCES `carrello` (`id`),
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
  ADD CONSTRAINT `prodotto_in_ordine_ibfk_2` FOREIGN KEY (`id_lotto`) REFERENCES `lotto` (`id`);

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
