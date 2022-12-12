-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 12, 2022 alle 09:54
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 8.1.2

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

-- --------------------------------------------------------

--
-- Struttura della tabella `agente`
--

CREATE TABLE `agente` (
  `codice_fiscale` char(16) NOT NULL,
  `nome` char(20) NOT NULL,
  `cognome` char(20) NOT NULL,
  `data_nascita` date NOT NULL,
  `telefono` char(10) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `paga_oraria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `agente`
--

INSERT INTO `agente` (`codice_fiscale`, `nome`, `cognome`, `data_nascita`, `telefono`, `email`, `paga_oraria`) VALUES
('BRBCMG99P67C5GFF', 'Federico', 'Lupino', '1999-08-09', '6547893233', 'fede.lupo@yahoo.com', 9),
('BRBLSE00P67C5GFF', 'Francesca', 'Barberini', '1986-09-09', '3234567834', 'fra@yahoo.oy', 12),
('BSTLCU80E01C573V', 'Luca', 'Biasetti', '1980-04-01', '3334568976', 'luca.biasetti4@gmail.it', 5),
('MRMVCN11E01H528N', 'Vincenzo', 'Marmo', '1911-05-01', '3407564830', 'vincenzom@virgilio.it', 18),
('RSSMRA65P21R889T', 'Mario', 'Rossi', '1990-01-30', '3932020211', 'mario.rossi@gmail.com', 12),
('RSSNPA65R69R085T', 'Ramona', 'Nappini', '2012-11-01', '3456669054', 'ramona.nappini01@yahoo.it', 12);

-- --------------------------------------------------------

--
-- Struttura della tabella `attestato_proprieta`
--

CREATE TABLE `attestato_proprieta` (
  `CF_proprietario` char(16) NOT NULL,
  `cod_veicolo` int(3) NOT NULL,
  `scaduto` int(1) NOT NULL,
  `data_produzione` date NOT NULL,
  `id_attestato` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('BSTDMR84H01C046C', 8, 0, '2022-12-08', 8),
('LRNRSS00A01H703R', 23, 1, '2009-01-01', 9),
('BRBLSE0987ty3re4', 24, 1, '2021-09-05', 10),
('LSEBBR05A01H703J', 27, 1, '2010-03-02', 11),
('LCABBR00A01H294F', 31, 1, '2017-01-01', 12),
('LSEBBR05A01H703J', 24, 0, '2022-12-06', 13);

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `codice_fiscale` char(16) NOT NULL,
  `nome` char(20) NOT NULL,
  `cognome` char(20) NOT NULL,
  `data_nascita` date NOT NULL,
  `telefono` char(10) NOT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`codice_fiscale`, `nome`, `cognome`, `data_nascita`, `telefono`, `email`) VALUES
('BRBLSE0987ty3re4', 'Matteo', 'Tassinari', '2006-09-09', '3356874578', 'lorenzo.rossi45@gmail.com'),
('BSTDMR84H01C046C', 'Edmir', 'Bastita', '1984-06-01', '3845253032', ''),
('CRIRCH0571200678', 'Cristina', 'Ronchi', '1971-09-05', '3342022775', 'cri12@yahoo.it'),
('DGRSFN06D01C685N', 'Serafino', 'De Grandis', '2006-04-01', '3693423920', 'serafino@gmail.com'),
('LCABBR00A01H294F', 'Alice', 'Barberini', '1967-09-10', '3344579854', 'alicebarberini20@gmail.com'),
('LRNRSS00A01H703R', 'Lorenzo', 'Rossi', '1990-10-11', '3887865478', 'lorenzo.rossi10@gmail.com'),
('LRSBBR79A01H294E', 'Loris', 'Barberini', '1967-01-01', '3358364111', 'alieli2025@yahoo.it'),
('LSEBBR05A01H703J', 'Elisa', 'Barberini', '2000-09-25', '3332874596', 'elisa.barberini3@studio.unibo.'),
('NNALDE95L41F717A', 'Elide', 'Anania', '1995-07-01', '3910493028', 'elide.an@libero.it'),
('SPDRMN55E01C640B', 'Reimon', 'Spedale', '1996-09-01', '3432434234', 'reimonspedale@gmail.com'),
('VLLLZG73P41D628B', 'Letizia Giuseppina', 'Villari', '1973-09-01', '3522342342', '');

-- --------------------------------------------------------

--
-- Struttura della tabella `comprende_meccanico`
--

CREATE TABLE `comprende_meccanico` (
  `codice_fiscale` char(16) NOT NULL,
  `id_riparazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `comprende_pezzo`
--

CREATE TABLE `comprende_pezzo` (
  `id_pezzo` int(11) NOT NULL,
  `quantita` int(3) NOT NULL,
  `id_riparazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `meccanico`
--

CREATE TABLE `meccanico` (
  `codice_fiscale` char(16) NOT NULL,
  `nome` char(20) NOT NULL,
  `cognome` char(20) NOT NULL,
  `data_nascita` date NOT NULL,
  `telefono` char(10) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `paga_oraria` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `meccanico`
--

INSERT INTO `meccanico` (`codice_fiscale`, `nome`, `cognome`, `data_nascita`, `telefono`, `email`, `paga_oraria`) VALUES
('BRVLSD596POIREC5', 'Recoaro', 'Virante', '2000-12-06', '3456987890', 'recoaro.virante@yahoo.it', 20),
('GVVLRA65P21R889T', 'gianluca', 'vacchi', '1990-10-12', '3332854587', NULL, 13),
('RSSMRA65P21R889T', 'mario', 'rossi', '1965-10-21', '3428990332', 'rossi.mario@gmail.com', 15);

-- --------------------------------------------------------

--
-- Struttura della tabella `pezzo_ricambio`
--

CREATE TABLE `pezzo_ricambio` (
  `nome` char(20) NOT NULL,
  `cod_veicolo` int(3) NOT NULL,
  `descrizione` char(40) DEFAULT NULL,
  `costo_unitario` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `pezzo_ricambio`
--

INSERT INTO `pezzo_ricambio` (`nome`, `cod_veicolo`, `descrizione`, `costo_unitario`) VALUES
('Sandalo', 23, '', 20),
('Sportello', 23, 'Lo sportello dell\'auto', 300);

-- --------------------------------------------------------

--
-- Struttura della tabella `riparazione`
--

CREATE TABLE `riparazione` (
  `CF_cliente` char(16) NOT NULL,
  `CF_meccanico` char(16) NOT NULL,
  `cod_veicolo` int(3) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `costo_totale` int(5) NOT NULL,
  `id_riparazione` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `transazione`
--

CREATE TABLE `transazione` (
  `id_transazione` int(11) NOT NULL,
  `CF_cliente` char(16) NOT NULL,
  `CF_agente` char(16) NOT NULL,
  `cod_veicolo` int(3) NOT NULL,
  `prezzo` int(6) NOT NULL,
  `tipologia` char(8) NOT NULL,
  `data_transazione` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `transazione`
--

INSERT INTO `transazione` (`id_transazione`, `CF_cliente`, `CF_agente`, `cod_veicolo`, `prezzo`, `tipologia`, `data_transazione`) VALUES
(1, 'BRBLSE0987ty3re4', 'BRBCMG99P67C5GFF', 23, 12000, 'vendita', '2022-12-05'),
(2, 'LSEBBR05A01H703J', 'BRBLSE00P67C5GFF', 24, 20000, 'vendita', '2022-12-06'),
(3, 'LCABBR00A01H294F', 'BRBCMG99P67C5GFF', 31, 10000, 'acquisto', '2022-12-05');

-- --------------------------------------------------------

--
-- Struttura della tabella `veicolo`
--

CREATE TABLE `veicolo` (
  `cod_veicolo` int(11) NOT NULL,
  `casa_produttrice` char(15) NOT NULL,
  `modello` char(20) NOT NULL,
  `data_produzione` int(4) NOT NULL,
  `cilindrata` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `veicolo`
--

INSERT INTO `veicolo` (`cod_veicolo`, `casa_produttrice`, `modello`, `data_produzione`, `cilindrata`) VALUES
(1, 'Fiat', '500', 2007, '1000'),
(2, 'Fiat', 'Stilo', 2001, '1596'),
(3, 'Audi', 'A4', 1994, '1984'),
(4, 'Volkswagen', 'Golf', 2012, '1498'),
(5, 'Citroen', 'C3', 2002, '1199'),
(6, 'Toyota', 'Yaris', 2006, '1618'),
(23, 'KIA', 'Sportage', 2002, '1250'),
(24, 'Jeep', 'renegade', 2018, '3000'),
(27, 'Audi', 'A6', 2009, '4000');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `agente`
--
ALTER TABLE `agente`
  ADD PRIMARY KEY (`codice_fiscale`);

--
-- Indici per le tabelle `attestato_proprieta`
--
ALTER TABLE `attestato_proprieta`
  ADD PRIMARY KEY (`id_attestato`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codice_fiscale`);

--
-- Indici per le tabelle `meccanico`
--
ALTER TABLE `meccanico`
  ADD PRIMARY KEY (`codice_fiscale`);

--
-- Indici per le tabelle `pezzo_ricambio`
--
ALTER TABLE `pezzo_ricambio`
  ADD PRIMARY KEY (`nome`,`cod_veicolo`);

--
-- Indici per le tabelle `riparazione`
--
ALTER TABLE `riparazione`
  ADD PRIMARY KEY (`id_riparazione`);

--
-- Indici per le tabelle `transazione`
--
ALTER TABLE `transazione`
  ADD PRIMARY KEY (`id_transazione`);

--
-- Indici per le tabelle `veicolo`
--
ALTER TABLE `veicolo`
  ADD PRIMARY KEY (`cod_veicolo`),
  ADD UNIQUE KEY `casa_produttrice` (`casa_produttrice`,`modello`,`data_produzione`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `attestato_proprieta`
--
ALTER TABLE `attestato_proprieta`
  MODIFY `id_attestato` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `riparazione`
--
ALTER TABLE `riparazione`
  MODIFY `id_riparazione` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `transazione`
--
ALTER TABLE `transazione`
  MODIFY `id_transazione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `veicolo`
--
ALTER TABLE `veicolo`
  MODIFY `cod_veicolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
