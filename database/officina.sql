-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 09, 2023 alle 12:05
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
CREATE DATABASE IF NOT EXISTS `officina` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `officina`;

-- --------------------------------------------------------

--
-- Struttura della tabella `agente`
--

CREATE TABLE `agente` (
  `CF_agente` char(16) NOT NULL,
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

INSERT INTO `agente` (`CF_agente`, `nome`, `cognome`, `data_nascita`, `telefono`, `email`, `paga_oraria`) VALUES
('BRBFNC86P09A747B', 'Francesca', 'Barberini', '1986-09-09', '3234567834', 'fra_barberini@yahoo.oy', 12),
('BSTLCU80E01C573V', 'Luca', 'Biasetti', '1980-04-01', '3334568976', 'luca.biasetti4@gmail.it', 10),
('LPNFRC99M09A953A', 'Federico', 'Lupino', '1999-08-09', '6547893232', 'fede.lupo@yahoo.com', 10),
('MRMVCN11E01H528N', 'Vincenzo', 'Marmo', '1911-05-01', '3407564830', 'vincenzomarmo@virgilio.it', 18),
('NPPRMN12S41F839W', 'Ramona', 'Nappini', '2012-11-01', '3456669054', 'ramona.nappini01@yahoo.it', 12),
('VLVCRL77E01F064C', 'Carlo', 'Valverde', '1977-05-01', '3932020211', 'carlov@gmail.com', 12);

-- --------------------------------------------------------

--
-- Struttura della tabella `attestato_proprieta`
--

CREATE TABLE `attestato_proprieta` (
  `CF_proprietario` char(16) NOT NULL,
  `targa` varchar(7) NOT NULL,
  `scaduto` int(1) NOT NULL,
  `data_attestato` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `attestato_proprieta`
--

INSERT INTO `attestato_proprieta` (`CF_proprietario`, `targa`, `scaduto`, `data_attestato`) VALUES
('BBRLCA00A01H294F', 'DY722MB', 0, '2023-01-09'),
('BBRLRS79A01H294E', 'GA831ZS', 0, '2023-01-09'),
('BRBLSE00P65C573S', 'BU345TY', 1, '2020-09-16'),
('BRBLSE00P65C573S', 'KK201AI', 0, '2023-01-07'),
('BSTDMR84H01C046C', 'EB840TD', 0, '2023-01-08'),
('DGRSFN06D01C685N', 'SG685NR', 0, '2023-01-08'),
('MNRGGC00S07G479F', 'DB086PO', 0, '2019-02-09'),
('MNRGGC00S07G479F', 'DB361RB', 0, '2023-01-09'),
('NNALDE95L41F717A', 'EP532TS', 1, '2023-01-09'),
('NNALDE95L41F717A', 'HY102JK', 0, '2022-10-04'),
('RCHCRI0571200678', 'FG086XX', 0, '2023-01-09'),
('RCHCRI0571200678', 'IT500VG', 1, '2022-10-12'),
('RSSLNR00A01H703R', 'BK316LO', 0, '2020-05-08'),
('RSSLNR00A01H703R', 'LO675BR', 0, '2023-01-08'),
('SPDRMN55E01C640B', 'CG381KY', 0, '2023-01-09'),
('TSSMTT06P09C573T', 'DU189FJ', 0, '2023-01-09');

-- --------------------------------------------------------

--
-- Struttura della tabella `cliente`
--

CREATE TABLE `cliente` (
  `CF_cliente` char(16) NOT NULL,
  `nome` char(20) NOT NULL,
  `cognome` char(20) NOT NULL,
  `data_nascita` date NOT NULL,
  `telefono` char(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `cliente`
--

INSERT INTO `cliente` (`CF_cliente`, `nome`, `cognome`, `data_nascita`, `telefono`, `email`) VALUES
('BBRLCA00A01H294F', 'Alice', 'Barberini', '1967-09-10', '3344579854', 'alicebarberini09@gmail.com'),
('BBRLRS79A01H294E', 'Loris', 'Barberini', '1967-01-01', '3358364111', 'alieli2025@yahoo.it'),
('BRBLSE00P65C573S', 'Elisa', 'Barberini', '2000-09-25', '3332874598', 'elisa.barberini3@studio.unibo.it'),
('BSTDMR84H01C046C', 'Edmir', 'Bastita', '1984-06-01', '3845253032', ''),
('DGRSFN06D01C685N', 'Serafino', 'De Grandis', '2006-04-01', '3693423920', 'serafino_de_grandis@gmail.com'),
('MNRGGC00S07G479F', 'Giosuè Giocondo', 'Mainardi', '2000-11-07', '3496789134', 'gmainardi07@gmail.com'),
('NNALDE95L41F717A', 'Elide', 'Anania', '1995-07-01', '3910493028', 'elide.anania07@libero.it'),
('RCHCRI0571200678', 'Cristina', 'Ronchi', '1971-09-05', '3342022775', 'ronchicri05@yahoo.it'),
('RSSLNR00A01H703R', 'Lorenzo', 'Rossi', '1990-10-11', '3887865478', 'lorenzo.rossi10@gmail.com'),
('SPDRMN55E01C640B', 'Reimon', 'Spedale', '1996-09-01', '3432434234', 'reimonspedale@gmail.com'),
('TSSMTT06P09C573T', 'Matteo', 'Tassinari', '2006-09-09', '3356874578', 'matteo.tassinari45@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `comprende_meccanico`
--

CREATE TABLE `comprende_meccanico` (
  `CF_meccanico` char(16) NOT NULL,
  `id_riparazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `comprende_meccanico`
--

INSERT INTO `comprende_meccanico` (`CF_meccanico`, `id_riparazione`) VALUES
('BRVLSD596POIREC5', 10),
('RSSMRA65P21R889T', 10),
('BRVLSD596POIREC5', 11),
('RSSMRA65P21R889T', 11),
('GVVLRA65P21R889T', 12),
('RSSMRA65P21R889T', 13),
('RSSMRA65P21R889T', 14),
('RSSMRA65P21R889T', 15),
('GVVLRA65P21R889T', 16),
('BRVLSD596POIREC5', 17),
('RSSMRA65P21R889T', 18),
('BRVLSD596POIREC5', 19),
('GVVLRA65P21R889T', 20),
('GVVLRA65P21R889T', 21),
('BRVLSD596POIREC5', 9),
('RSSMRA65P21R889T', 9),
('BRVLSD596POIREC5', 22),
('GVVLRA65P21R889T', 22),
('RSSMRA65P21R889T', 22),
('GVVLRA65P21R889T', 23),
('SCRMRT26T01A592J', 23),
('CCCMSM72H01C075D', 24),
('GMLPLA61S41I486S', 24),
('RSSMRA65P21R889T', 24),
('SCRMRT26T01A592J', 24),
('SNCFNC83C01I735V', 24),
('BRVLSD596POIREC5', 25),
('SCRMRT26T01A592J', 25),
('SRCRNZ01D01H222U', 25),
('GMLPLA61S41I486S', 26),
('GMLPLA61S41I486S', 27),
('SCRMRT26T01A592J', 27),
('SRCRNZ01D01H222U', 28),
('GMLPLA61S41I486S', 29),
('GVVLRA65P21R889T', 29);

-- --------------------------------------------------------

--
-- Struttura della tabella `comprende_pezzo`
--

CREATE TABLE `comprende_pezzo` (
  `id_pezzo` int(11) NOT NULL,
  `id_riparazione` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `comprende_pezzo`
--

INSERT INTO `comprende_pezzo` (`id_pezzo`, `id_riparazione`) VALUES
(9, 15),
(11, 18),
(13, 23),
(14, 23),
(14, 25),
(15, 26);

-- --------------------------------------------------------

--
-- Struttura della tabella `meccanico`
--

CREATE TABLE `meccanico` (
  `CF_meccanico` char(16) NOT NULL,
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

INSERT INTO `meccanico` (`CF_meccanico`, `nome`, `cognome`, `data_nascita`, `telefono`, `email`, `paga_oraria`) VALUES
('BRVLSD596POIREC5', 'Recoaro', 'Virante', '2000-12-06', '3456987890', 'recoaro.virante@yahoo.it', 16),
('CCCMSM72H01C075D', 'Massimo Umberto', 'Ciccone', '1972-06-01', '3324249423', 'max.cicc@gmail.com', 20),
('GMLPLA61S41I486S', 'Paola', 'Gemelli', '1961-11-01', '3090087957', '', 16),
('GVVLRA65P21R889T', 'Gianluca', 'Vacchi', '1990-10-12', '3332854587', NULL, 13),
('RSSMRA65P21R889T', 'Mario', 'Rossi', '1965-10-21', '3428990332', 'rossi.mario@gmail.com', 15),
('SCRMRT26T01A592J', 'Umberto', 'Scarcia', '1926-12-01', '3778090493', '', 13),
('SNCFNC83C01I735V', 'Francesco', 'Sinacori', '1983-03-01', '3557575757', 'francesco83sin@gmail.com', 15),
('SRCRNZ01D01H222U', 'Renzo', 'Sorce', '2001-04-01', '3424249645', 'renzo.s@yahooo.com', 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `pezzo_ricambio`
--

CREATE TABLE `pezzo_ricambio` (
  `id_pezzo` int(3) NOT NULL,
  `nome` char(20) NOT NULL,
  `targa` varchar(7) NOT NULL,
  `descrizione` char(40) DEFAULT NULL,
  `costo_unitario` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `pezzo_ricambio`
--

INSERT INTO `pezzo_ricambio` (`id_pezzo`, `nome`, `targa`, `descrizione`, `costo_unitario`) VALUES
(8, 'Tappo benzina', 'IT500VG', 'Tappo che evita la fuoriuscita di benzin', 26),
(9, 'cambio manuale', 'HY102JK', '', 38),
(10, 'tappetini', 'HY102JK', '', 12),
(11, 'fanali', 'BK316LO', 'fanali di ricambio con luce a led', 170),
(12, 'pneumatici', 'IT500VG', 'pneumatici invernali', 200),
(13, 'Ruote', 'DB361RB', '', 80),
(14, 'Pasticca freni', 'DB361RB', '', 150),
(15, 'volante', 'FG086XX', '', 230),
(16, 'pedale gas', 'EP532TS', '', 34),
(17, 'radio', 'HY102JK', '', 28),
(18, 'specchietto', 'DU189FJ', '', 67);

-- --------------------------------------------------------

--
-- Struttura della tabella `riparazione`
--

CREATE TABLE `riparazione` (
  `CF_cliente` char(16) NOT NULL,
  `targa` varchar(7) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `costo_totale` int(5) NOT NULL,
  `id_riparazione` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `riparazione`
--

INSERT INTO `riparazione` (`CF_cliente`, `targa`, `data_inizio`, `data_fine`, `costo_totale`, `id_riparazione`) VALUES
('BRBLSE00P65C573S', 'DU189FJ', '2022-09-19', '2022-12-24', 645, 9),
('BRBLSE00P65C573S', 'DU189FJ', '2022-01-13', '2020-01-16', 125, 10),
('BSTDMR84H01C046C', 'EB840TD', '2022-11-15', '2022-11-22', 300, 11),
('DGRSFN06D01C685N', 'SG685NR', '2022-09-26', '2022-10-19', 400, 12),
('BRBLSE00P65C573S', 'KK201AI', '2022-10-17', '2022-10-21', 700, 13),
('NNALDE95L41F717A', 'HY102JK', '2022-01-10', '2023-01-11', 50, 14),
('NNALDE95L41F717A', 'HY102JK', '2022-01-02', '2023-01-23', 530, 15),
('BRBLSE00P65C573S', 'KK201AI', '2022-01-18', '2022-10-05', 1000, 16),
('BRBLSE00P65C573S', 'KK201AI', '2022-08-15', '2022-08-22', 240, 17),
('RSSLNR00A01H703R', 'BK316LO', '2022-12-12', '2022-12-19', 270, 18),
('RSSLNR00A01H703R', 'LO675BR', '2022-11-21', '2022-11-28', 390, 19),
('RSSLNR00A01H703R', 'BK316LO', '2022-10-17', '2022-10-27', 230, 20),
('BRBLSE00P65C573S', 'KK201AI', '2022-12-27', '2023-01-13', 4, 21),
('BRBLSE00P65C573S', 'KK201AI', '2022-12-09', '2023-01-18', 22, 22),
('MNRGGC00S07G479F', 'DB361RB', '2022-01-03', '2023-01-10', 345, 23),
('RSSLNR00A01H703R', 'LO675BR', '2022-10-31', '2022-12-29', 1600, 24),
('MNRGGC00S07G479F', 'DB361RB', '2022-12-06', '2022-12-29', 81, 25),
('RCHCRI0571200678', 'FG086XX', '2022-11-08', '2022-11-11', 40, 26),
('MNRGGC00S07G479F', 'DB086PO', '2022-12-01', '2022-12-08', 50, 27),
('MNRGGC00S07G479F', 'DB086PO', '2022-11-01', '2022-11-09', 30, 28),
('RCHCRI0571200678', 'FG086XX', '2022-07-05', '2022-08-05', 90, 29);

-- --------------------------------------------------------

--
-- Struttura della tabella `transazione`
--

CREATE TABLE `transazione` (
  `CF_cliente` char(16) NOT NULL,
  `CF_agente` char(16) NOT NULL,
  `targa` varchar(7) NOT NULL,
  `prezzo` int(6) NOT NULL,
  `tipologia` char(8) NOT NULL,
  `data_transazione` date NOT NULL,
  `ora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `transazione`
--

INSERT INTO `transazione` (`CF_cliente`, `CF_agente`, `targa`, `prezzo`, `tipologia`, `data_transazione`, `ora`) VALUES
('BRBLSE00P65C573S', 'MRMVCN11E01H528N', 'BU345TY', 60500, 'acquisto', '2023-01-07', '00:00:00'),
('BRBLSE00P65C573S', 'MRMVCN11E01H528N', 'DU189FJ', 30000, 'vendita', '2023-01-07', '11:38:45'),
('BRBLSE00P65C573S', 'MRMVCN11E01H528N', 'DU189FJ', 15900, 'acquisto', '2023-01-08', '09:55:28'),
('BSTDMR84H01C046C', 'MRMVCN11E01H528N', 'EB840TD', 16700, 'vendita', '2023-01-08', '09:55:02'),
('DGRSFN06D01C685N', 'VLVCRL77E01F064C', 'SG685NR', 24500, 'vendita', '2023-01-08', '09:54:27'),
('RCHCRI0571200678', 'VLVCRL77E01F064C', 'IT500VG', 40500, 'acquisto', '2023-01-07', '12:13:37'),
('RSSLNR00A01H703R', 'BRBFNC86P09A747B', 'LO675BR', 55000, 'vendita', '2023-01-08', '07:06:04');

-- --------------------------------------------------------

--
-- Struttura della tabella `veicolo_nuovo`
--

CREATE TABLE `veicolo_nuovo` (
  `cod_veicolo_nuovo` int(11) NOT NULL,
  `casa_produttrice` char(15) NOT NULL,
  `modello` char(20) NOT NULL,
  `anno_produzione` year(4) NOT NULL,
  `cilindrata` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `veicolo_nuovo`
--

INSERT INTO `veicolo_nuovo` (`cod_veicolo_nuovo`, `casa_produttrice`, `modello`, `anno_produzione`, `cilindrata`) VALUES
(1, 'Fiat', '500', 2022, '1100'),
(6, 'Toyota', 'Yaris', 2020, '1818'),
(21, 'KIA', 'Kangoo', 2021, '1800'),
(23, 'Honda', 'Captur', 2019, '1400'),
(24, 'KIA', 'Sportage', 2020, '1600'),
(25, 'Renault', 'Clio', 2021, '1500'),
(26, 'Volkswagen', 'Polo', 2022, '1800');

-- --------------------------------------------------------

--
-- Struttura della tabella `veicolo_usato`
--

CREATE TABLE `veicolo_usato` (
  `casa_produttrice` char(15) NOT NULL,
  `modello` char(20) NOT NULL,
  `anno_produzione` year(4) NOT NULL,
  `cilindrata` char(10) NOT NULL,
  `km_percorsi` int(6) DEFAULT NULL,
  `targa` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `veicolo_usato`
--

INSERT INTO `veicolo_usato` (`casa_produttrice`, `modello`, `anno_produzione`, `cilindrata`, `km_percorsi`, `targa`) VALUES
('KIA', 'Xceed', 2016, '1300', 124000, 'BK316LO'),
('Audi', 'Q8', 2018, '2200', 80000, 'BU345TY'),
('Citroen', 'C3', 2002, '1199', 130800, 'CG381KY'),
('Fiat', 'Ducato', 1998, '1800', 120000, 'DB086PO'),
('Fiat', 'Stilo', 2001, '1596', 150000, 'DB361RB'),
('Dacha', 'Duster', 2018, '2000', 3, 'DU189FJ'),
('Toyota', 'Yaris', 2006, '1618', 250300, 'DY722MB'),
('Honda', 'Jazz', 2018, '1300', 0, 'EB840TD'),
('Audi', 'A4', 1994, '1984', 300900, 'EP532TS'),
('Fiat', '500', 2007, '1000', 87600, 'FG086XX'),
('Honda', 'Captur', 2019, '1400', 32100, 'GA831ZS'),
('Yunday', 'Hi10', 2016, '1450', 30700, 'HY102JK'),
('Volkswagen', 'T-Roc', 2022, '1800', 50000, 'IT500VG'),
('KIA', 'Kangoo', 2020, '1600', 0, 'KK201AI'),
('KIA', 'Sportage', 2020, '1600', 0, 'LO675BR'),
('Volkswagen', 'Golf8', 2019, '1500', 0, 'SG685NR');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `agente`
--
ALTER TABLE `agente`
  ADD PRIMARY KEY (`CF_agente`);

--
-- Indici per le tabelle `attestato_proprieta`
--
ALTER TABLE `attestato_proprieta`
  ADD PRIMARY KEY (`CF_proprietario`,`targa`);

--
-- Indici per le tabelle `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CF_cliente`);

--
-- Indici per le tabelle `meccanico`
--
ALTER TABLE `meccanico`
  ADD PRIMARY KEY (`CF_meccanico`);

--
-- Indici per le tabelle `pezzo_ricambio`
--
ALTER TABLE `pezzo_ricambio`
  ADD PRIMARY KEY (`id_pezzo`),
  ADD UNIQUE KEY `nome` (`nome`,`targa`);

--
-- Indici per le tabelle `riparazione`
--
ALTER TABLE `riparazione`
  ADD PRIMARY KEY (`id_riparazione`),
  ADD UNIQUE KEY `CF_cliente` (`CF_cliente`,`targa`,`data_inizio`,`data_fine`);

--
-- Indici per le tabelle `transazione`
--
ALTER TABLE `transazione`
  ADD PRIMARY KEY (`CF_cliente`,`targa`,`data_transazione`,`ora`);

--
-- Indici per le tabelle `veicolo_nuovo`
--
ALTER TABLE `veicolo_nuovo`
  ADD PRIMARY KEY (`cod_veicolo_nuovo`);

--
-- Indici per le tabelle `veicolo_usato`
--
ALTER TABLE `veicolo_usato`
  ADD PRIMARY KEY (`targa`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `pezzo_ricambio`
--
ALTER TABLE `pezzo_ricambio`
  MODIFY `id_pezzo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT per la tabella `riparazione`
--
ALTER TABLE `riparazione`
  MODIFY `id_riparazione` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT per la tabella `veicolo_nuovo`
--
ALTER TABLE `veicolo_nuovo`
  MODIFY `cod_veicolo_nuovo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
