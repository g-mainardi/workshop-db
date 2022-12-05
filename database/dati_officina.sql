-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 05, 2022 alle 23:35
-- Versione del server: 10.4.19-MariaDB
-- Versione PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `officina`
--

--
-- Dump dei dati per la tabella `agente`
--

INSERT INTO `agente` (`codice_fiscale`, `nome`, `cognome`, `data_nascita`, `telefono`, `email`, `paga_oraria`) VALUES
('MRMVCN11E01H528N', 'Vincenzo', 'Marmo', '1911-05-01', '3407564830', 'vincenzom@virgilio.it', 18),
('RSSMRA65P21R889T', 'Mario', 'Rossi', '1990-01-30', '3932020211', 'mario.rossi@gmail.com', 12);

--
-- Dump dei dati per la tabella `attestato_proprieta`
--

INSERT INTO `attestato_proprieta` (`CF_proprietario`, `cod_veicolo`, `scaduto`, `data_produzione`, `id_attestato`) VALUES
('NNALDE95L41F717A', 1, 2022, '0000-00-00', 1),
('NNALDE95L41F717A', 2, 0, '2022-12-15', 2),
('DGRSFN06D01C685N', 3, 0, '2022-12-14', 3),
('SPDRMN55E01C640B', 4, 0, '2022-11-29', 4),
('BSTDMR84H01C046C', 5, 0, '2022-12-21', 5),
('VLLLZG73P41D628B', 6, 0, '2022-12-07', 6),
('BSTDMR84H01C046C', 7, 0, '2022-12-21', 7),
('BSTDMR84H01C046C', 8, 0, '2022-12-08', 8);

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`codice_fiscale`, `nome`, `cognome`, `data_nascita`, `telefono`, `email`) VALUES
('BSTDMR84H01C046C', 'Edmir', 'Bastita', '1984-06-01', '3845253032', ''),
('DGRSFN06D01C685N', 'Serafino', 'De Grandis', '2006-04-01', '3693423920', 'serafino@gmail.com'),
('NNALDE95L41F717A', 'Elide', 'Anania', '1995-07-01', '3910493028', 'elide.an@libero.it'),
('SPDRMN55E01C640B', 'Reimon', 'Spedale', '1996-09-01', '3432434234', 'reimonspedale@gmail.com'),
('VLLLZG73P41D628B', 'Letizia Giuseppina', 'Villari', '1973-09-01', '3522342342', '');

--
-- Dump dei dati per la tabella `veicolo`
--

INSERT INTO `veicolo` (`cod_veicolo`, `casa_produttrice`, `modello`, `data_produzione`, `cilindrata`) VALUES
(1, 'Fiat', '500', '2007-01-01', '1000'),
(2, 'Fiat', 'Stilo', '2001-01-01', '1596'),
(3, 'Audi', 'A4', '1994-01-01', '1984'),
(4, 'Volkswagen', 'Golf', '2012-01-01', '1498'),
(5, 'Citroen', 'C3', '2002-01-01', '1199'),
(6, 'Toyota', 'Yaris', '2006-01-01', '1618');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
