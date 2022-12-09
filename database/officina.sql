-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 09, 2022 alle 14:31
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
('LRNRSS00A01H703R', 23, 1, '2009-01-01', 8),
('BRBLSE0987ty3re4', 24, 1, '2021-09-05', 9),
('LSEBBR05A01H703J', 27, 1, '2010-03-02', 10),
('LCABBR00A01H294F', 31, 1, '2017-01-01', 12),
('BRBLSE0987ty3re4', 32, 1, '2022-12-13', 13),
('BRBLSE0987ty3re4', 23, 1, '2022-12-05', 16),
('LSEBBR05A01H703J', 24, 0, '2022-12-06', 17);

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
('LCABBR00A01H294F', 'Alice', 'Barberini', '1967-09-10', '3344579854', 'alicebarberini20@gmail.com'),
('LRNRSS00A01H703R', 'Lorenzo', 'Rossi', '1990-10-11', '3887865478', 'lorenzo.rossi10@gmail.com'),
('LRSBBR79A01H294E', 'Loris', 'Barberini', '1967-01-01', '3358364111', 'alieli2025@yahoo.it'),
('LSEBBR05A01H703J', 'Elisa', 'Barberini', '2000-09-25', '3332874596', 'elisa.barberini3@studio.unibo.'),
('RSSMRA65P21R889T', 'mario', 'rossi', '1970-09-12', '3342878998', 'gggg@yahoo.it');

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
  `cod_veicolo` int(3) NOT NULL,
  `descrizione` char(40) DEFAULT NULL,
  `costo_unitario` int(5) NOT NULL,
  `nome` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `pezzo_ricambio`
--

INSERT INTO `pezzo_ricambio` (`cod_veicolo`, `descrizione`, `costo_unitario`, `nome`) VALUES
(23, '', 20, 'Sandalo'),
(23, 'Lo sportello dell\'auto', 300, 'Sportello');

-- --------------------------------------------------------

--
-- Struttura della tabella `riparazione`
--

CREATE TABLE `riparazione` (
  `nome` char(20) NOT NULL,
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

INSERT INTO `transazione` (`CF_cliente`, `CF_agente`, `cod_veicolo`, `prezzo`, `tipologia`, `data_transazione`) VALUES
('BRBLSE0987ty3re4', 'BRBCMG99P67C5GFF', 23, 12000, 'vendita', '2022-12-05'),
('LSEBBR05A01H703J', 'BRBLSE00P67C5GFF', 24, 20000, 'vendita', '2022-12-06'),
('LCABBR00A01H294F', 'BRBCMG99P67C5GFF', 31, 10000, 'acquisto', '2022-12-05');

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
(23, 'KIA', 'Sportage', 2002, '1250'),
(24, 'Jeep', 'renegade', 2018, '3000'),
(27, 'Audi', 'A6', 2009, '4000'),
(31, 'Renault', 'twingo', 2016, '2500'),
(32, 'renault', 'megane', 2007, '1450');

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
  ADD PRIMARY KEY (`cod_veicolo`,`nome`);

--
-- Indici per le tabelle `riparazione`
--
ALTER TABLE `riparazione`
  ADD PRIMARY KEY (`id_riparazione`);

--
-- Indici per le tabelle `transazione`
--
ALTER TABLE `transazione`
  ADD PRIMARY KEY (`cod_veicolo`);

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
  MODIFY `id_attestato` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `riparazione`
--
ALTER TABLE `riparazione`
  MODIFY `id_riparazione` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `transazione`
--
ALTER TABLE `transazione`
  MODIFY `cod_veicolo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT per la tabella `veicolo`
--
ALTER TABLE `veicolo`
  MODIFY `cod_veicolo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
