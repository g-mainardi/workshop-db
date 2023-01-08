-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Gen 08, 2023 alle 22:18
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
('BRBCMG99P67C5GFF', 'Federico', 'Lupino', '1999-08-09', '6547893233', 'fede.lupo@yahoo.com', 9),
('BRBLSE00P67C5GFF', 'Francesca', 'Barberini', '1986-09-09', '3234567834', 'fra_barberini@yahoo.oy', 12),
('BSTLCU80E01C573V', 'Luca', 'Biasetti', '1980-04-01', '3334568976', 'luca.biasetti4@gmail.it', 5),
('MRMVCN11E01H528N', 'Vincenzo', 'Marmo', '1911-05-01', '3407564830', 'vincenzomarmo@virgilio.it', 18),
('RSSMRA65P21R889T', 'Mario', 'Rossi', '1990-01-30', '3932020211', 'mario.rossi@gmail.com', 12),
('RSSNPA65R69R085T', 'Ramona', 'Nappini', '2012-11-01', '3456669054', 'ramona.nappini01@yahoo.it', 12);

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
('BRBLSE00P65C573S', 'BU345TY', 1, '2020-09-16'),
('BRBLSE00P65C573S', 'DU189FJ', 1, '2023-01-07'),
('BRBLSE00P65C573S', 'KK201AI', 0, '2023-01-07'),
('BSTDMR84H01C046C', 'EB840TD', 0, '2023-01-08'),
('CRIRCH0571200678', 'IT500VG', 1, '2022-10-12'),
('DGRSFN06D01C685N', 'SG685NR', 0, '2023-01-08'),
('LRNRSS00A01H703R', 'BK316LO', 0, '2020-05-08'),
('LRNRSS00A01H703R', 'LO675BR', 0, '2023-01-08'),
('NNALDE95L41F717A', 'HY102JK', 0, '2022-10-04');

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
('BRBLSE00P65C573S', 'Elisa', 'Barberini', '2000-09-25', '3332874598', 'elisa.barberini3@studio.unibo.it'),
('BRBLSE0987ty3re4', 'Matteo', 'Tassinari', '2006-09-09', '3356874578', 'matteo.tassinari45@gmail.com'),
('BSTDMR84H01C046C', 'Edmir', 'Bastita', '1984-06-01', '3845253032', ''),
('CRIRCH0571200678', 'Cristina', 'Ronchi', '1971-09-05', '3342022775', 'ronchicri05@yahoo.it'),
('DGRSFN06D01C685N', 'Serafino', 'De Grandis', '2006-04-01', '3693423920', 'serafino_de_grandis@gmail.com'),
('LCABBR00A01H294F', 'Alice', 'Barberini', '1967-09-10', '3344579854', 'alicebarberini09@gmail.com'),
('LRNRSS00A01H703R', 'Lorenzo', 'Rossi', '1990-10-11', '3887865478', 'lorenzo.rossi10@gmail.com'),
('LRSBBR79A01H294E', 'Loris', 'Barberini', '1967-01-01', '3358364111', 'alieli2025@yahoo.it'),
('NNALDE95L41F717A', 'Elide', 'Anania', '1995-07-01', '3910493028', 'elide.anania07@libero.it'),
('SPDRMN55E01C640B', 'Reimon', 'Spedale', '1996-09-01', '3432434234', 'reimonspedale@gmail.com'),
('VLLLZG73P41D628B', 'Letizia Giuseppina', 'Villari', '1973-09-01', '3522342342', '');

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
('BRVLSD596POIREC5', 0),
('BRVLSD596POIREC5', 0),
('RSSMRA65P21R889T', 0),
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
('GVVLRA65P21R889T', 20);

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
(11, 18);

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
('GVVLRA65P21R889T', 'gianluca', 'vacchi', '1990-10-12', '3332854587', NULL, 13),
('RSSMRA65P21R889T', 'mario', 'rossi', '1965-10-21', '3428990332', 'rossi.mario@gmail.com', 15);

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
(12, 'pneumatici', 'IT500VG', 'pneumatici invernali', 200);

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
('BRBLSE00P65C573S', 'DU189FJ', '2020-01-13', '2020-01-16', 125, 10),
('BSTDMR84H01C046C', 'EB840TD', '2022-11-15', '2022-11-22', 300, 11),
('DGRSFN06D01C685N', 'SG685NR', '2022-09-26', '2022-10-19', 400, 12),
('BRBLSE00P65C573S', 'KK201AI', '2022-10-17', '2022-10-21', 700, 13),
('NNALDE95L41F717A', 'HY102JK', '2023-01-10', '2023-01-11', 50, 14),
('NNALDE95L41F717A', 'HY102JK', '2023-01-02', '2023-01-23', 530, 15),
('BRBLSE00P65C573S', 'KK201AI', '2022-01-18', '2022-10-05', 1000, 16),
('BRBLSE00P65C573S', 'KK201AI', '2022-08-15', '2022-08-22', 240, 17),
('LRNRSS00A01H703R', 'BK316LO', '2022-12-12', '2022-12-19', 270, 18),
('LRNRSS00A01H703R', 'LO675BR', '2022-11-21', '2022-11-28', 390, 19),
('LRNRSS00A01H703R', 'BK316LO', '2022-10-17', '2022-10-27', 230, 20);

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
('BRBLSE00P65C573S', 'BRBCMG99P67C5GFF', 'BU345TY', 60500, 'acquisto', '2023-01-07', '00:00:00'),
('BRBLSE00P65C573S', 'BRBCMG99P67C5GFF', 'DU189FJ', 30000, 'vendita', '2023-01-07', '11:38:45'),
('BRBLSE00P65C573S', 'BRBCMG99P67C5GFF', 'DU189FJ', 15900, 'acquisto', '2023-01-08', '09:55:28'),
('BSTDMR84H01C046C', 'BRBLSE00P67C5GFF', 'EB840TD', 16700, 'vendita', '2023-01-08', '09:55:02'),
('CRIRCH0571200678', 'RSSMRA65P21R889T', 'IT500VG', 40500, 'acquisto', '2023-01-07', '12:13:37'),
('DGRSFN06D01C685N', 'RSSMRA65P21R889T', 'SG685NR', 24500, 'vendita', '2023-01-08', '09:54:27'),
('LRNRSS00A01H703R', 'BRBCMG99P67C5GFF', 'LO675BR', 55000, 'vendita', '2023-01-08', '07:06:04');

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
('KIA', 'Xceed', 2016, '1300', 125000, 'BK316LO'),
('Audi', 'Q8', 2018, '2200', 80000, 'BU345TY'),
('Dacha', 'Duster', 2018, '2000', 0, 'DU189FJ'),
('Honda', 'Jazz', 2018, '1300', 0, 'EB840TD'),
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
  MODIFY `id_pezzo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT per la tabella `riparazione`
--
ALTER TABLE `riparazione`
  MODIFY `id_riparazione` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT per la tabella `veicolo_nuovo`
--
ALTER TABLE `veicolo_nuovo`
  MODIFY `cod_veicolo_nuovo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
