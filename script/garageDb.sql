-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.2              
-- * Generator date: Sep 14 2021              
-- * Generation date: Mon Nov 28 09:48:34 2022 
-- * LUN file: C:\Users\elisa\Documents\workshop-db\Elaborato.lun 
-- * Schema: Officina/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database Officina;
use Officina;


-- Tables Section
-- _____________ 

create table AGENTE (
     codice_fiscale char(16) not null primary key,
     nome char(20) not null,
     cognome char(20) not null,
     data_nascita date not null,
     telefono char(10) not null,
     email varchar(30),
     paga_oraria int not null
);

create table ATTESTATO_PROPRIETA (
     CF_proprietario char(16) not null,
     cod_veicolo int(3) not null,
     scaduto int(1) not null,
     data_appropriazione date not null,
     CONSTRAINT ID_attestato primary key (CF_proprietario, cod_veicolo, data_appropriazione) 
);

create table CLIENTE (
     codice_fiscale char(16) not null primary key,
     nome char(20) not null,
     cognome char(20) not null,
     data_nascita date not null,
     telefono char(10) not null,
     email varchar(30)
);

create table MECCANICO (
     codice_fiscale char(16) not null primary key,
     nome char(20) not null,
     cognome char(20) not null,
     data_nascita date not null,
     telefono char(10) not null,
     email varchar(30),
     paga_oraria int(2) not null
);

create table PEZZO_RICAMBIO (
     cod_veicolo int(3) not null,
     descrizione char(40) not null,
     costo int(5) not null
);

create table RIPARAZIONE (
	CF_cliente char(16) not null, 
	CF_meccanico char(16) not null,
	cod_veicolo int(3) not null,
	data_inizio date not null,
	data_fine date not null,
	costo_totale int(5) not null,
	id_riparazione int(3) not null AUTO_INCREMENT primary key
);

create table TRANSAZIONE (
     CF_cliente char(16) not null,
     CF_agente char(16) not null,
     cod_veicolo int(3) not null,
     prezzo int(6) not null,
     tipologia char(8) not null,
     data_transazione date not null,
     CONSTRAINT ID_transazione primary key (CF_cliente, CF_agente, cod_veicolo, data_transazione)
);

create table VEICOLO (
     cod_veicolo int(3) not null,
     casa_produttrice char(15) not null,
     modello char(20) not null,
     data_produzione date not null,
     cilindrata char(10) not null,
     CONSTRAINT ID_veicolo primary key (casa_produttrice, modello, data_produzione)
);


-- Constraints Section
-- ___________________ 


-- Index Section
-- _____________ 

