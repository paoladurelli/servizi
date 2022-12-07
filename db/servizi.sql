-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 07, 2022 alle 18:02
-- Versione del server: 10.4.25-MariaDB
-- Versione PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servizi`
--

DELIMITER $$
--
-- Procedure
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `View_attivita` (IN `CF_to` INT(16))  READS SQL DATA SELECT attivita.id as attivita_id, attivita.data_attivita, attivita.pratica_id as pratica_id, attivita.servizio_id as ServizioId, attivita.status_id as StatusId, servizi.NomeServizio as NomeServizio, status.nome as NomeStatus FROM attivita
LEFT JOIN servizi ON attivita.servizio_id = servizi.id
LEFT JOIN status ON attivita.status_id = status.id
WHERE attivita.cf = CF_to
ORDER BY attivita.data_attivita DESC, attivita.id DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `View_attivita_limit` (IN `CF` VARCHAR(16) CHARSET utf8, IN `nr_limit` INT)  READS SQL DATA SELECT attivita.id as attivita_id, attivita.data_attivita, attivita.pratica_id as pratica_id, attivita.servizio_id as ServizioId, attivita.status_id as StatusId, servizi.NomeServizio as NomeServizio, status.nome as NomeStatus FROM attivita
LEFT JOIN servizi ON attivita.servizio_id = servizi.id
LEFT JOIN status ON attivita.status_id = status.id
WHERE attivita.cf = CF
ORDER BY attivita.data_attivita DESC, attivita.id DESC
LIMIT nr_limit$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `View_messaggi` (IN `CF_to` VARCHAR(16) CHARSET utf8)  READS SQL DATA SQL SECURITY INVOKER SELECT messaggi.id as messaggi_id, messaggi.testo, messaggi.data_msg, servizi.NomeServizio as NomeServizio FROM messaggi
LEFT JOIN servizi ON messaggi.servizio_id = servizi.id 
WHERE messaggi.CF_to = CF_to
ORDER BY messaggi.data_msg DESC, messaggi.id DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `View_messaggi_limit` (IN `CF_to` VARCHAR(16), IN `nr_limit` INT)  READS SQL DATA SELECT messaggi.id as messaggi_id, messaggi.testo, messaggi.data_msg, servizi.NomeServizio as NomeServizio FROM messaggi
LEFT JOIN servizi ON messaggi.servizio_id = servizi.id 
WHERE messaggi.CF_to = CF_to
ORDER BY messaggi.data_msg DESC, messaggi.id
LIMIT nr_limit$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `anagrafica`
--

CREATE TABLE `anagrafica` (
  `CodiceFiscale` varchar(16) COLLATE utf8_bin NOT NULL COMMENT 'Codice Fiscale - Chiave Primaria',
  `Nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `Cognome` varchar(255) COLLATE utf8_bin NOT NULL,
  `Email` varchar(255) COLLATE utf8_bin NOT NULL,
  `DataNascita` date NOT NULL,
  `LuogoNascita` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `anagrafica`
--

INSERT INTO `anagrafica` (`CodiceFiscale`, `Nome`, `Cognome`, `Email`, `DataNascita`, `LuogoNascita`) VALUES
('DPLPLA80S48L400S', 'Giovanna', 'Rossi', 'prova@prova.it', '1979-03-21', 'Treviglio (BG)'),
('DRLPLA80S48L400S', 'Paola', 'Durelli', 'paola.durelli@proximalab.it', '1980-11-08', 'Treviglio (BG)'),
('GCFLGA52M15F244X', 'Luigia', 'Giucofferi', 'prova1@prova.it', '1952-03-15', 'Carvico (BG)');

-- --------------------------------------------------------

--
-- Struttura della tabella `assegno_maternita`
--

CREATE TABLE `assegno_maternita` (
  `id` int(11) NOT NULL,
  `NumeroPratica` varchar(10) COLLATE utf8_bin NOT NULL,
  `richiedenteCf` varchar(16) COLLATE utf8_bin NOT NULL,
  `richiedenteNome` text COLLATE utf8_bin NOT NULL,
  `richiedenteCognome` text COLLATE utf8_bin NOT NULL,
  `richiedenteDataNascita` date DEFAULT NULL,
  `richiedenteLuogoNascita` text COLLATE utf8_bin DEFAULT NULL,
  `richiedenteVia` text COLLATE utf8_bin DEFAULT NULL,
  `richiedenteLocalita` text COLLATE utf8_bin DEFAULT NULL,
  `richiedenteProvincia` text COLLATE utf8_bin DEFAULT NULL,
  `richiedenteEmail` text COLLATE utf8_bin DEFAULT NULL,
  `richiedenteTel` text COLLATE utf8_bin DEFAULT NULL,
  `minoreNome` text COLLATE utf8_bin DEFAULT NULL,
  `minoreCognome` text COLLATE utf8_bin DEFAULT NULL,
  `minoreDataNascita` date DEFAULT NULL,
  `minoreLuogoNascita` text COLLATE utf8_bin DEFAULT NULL,
  `tipoRichiesta` varchar(2) COLLATE utf8_bin DEFAULT NULL,
  `DichiarazioneCittadinanza` varchar(1) COLLATE utf8_bin DEFAULT NULL,
  `DichiarazioneSoggiornoNumero` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `DichiarazioneSoggiornoQuestura` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `DichiarazioneSoggiornoData` date DEFAULT NULL,
  `DichiarazioneSoggiornoDataRinnovo` date DEFAULT NULL,
  `DichiarazioneAffidamento` int(1) DEFAULT NULL,
  `DichiarazioneAffidamentoData` date DEFAULT NULL,
  `tipoPagamento_id` int(11) DEFAULT NULL,
  `uploadCartaIdentitaFronte` text COLLATE utf8_bin DEFAULT NULL,
  `uploadCartaIdentitaRetro` text COLLATE utf8_bin DEFAULT NULL,
  `uploadTitoloSoggiorno` text COLLATE utf8_bin DEFAULT NULL,
  `uploadDichiarazioneDatoreLavoro` text COLLATE utf8_bin DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `data_compilazione` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struttura della tabella `attivita`
--

CREATE TABLE `attivita` (
  `id` int(11) NOT NULL,
  `cf` varchar(16) COLLATE utf8_bin NOT NULL,
  `servizio_id` int(11) NOT NULL,
  `pratica_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `data_attivita` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `attivita`
--

INSERT INTO `attivita` (`id`, `cf`, `servizio_id`, `pratica_id`, `status_id`, `data_attivita`) VALUES
(16, '', 11, 33, 2, '2022-12-06'),
(17, '', 11, 34, 2, '2022-12-06'),
(18, '', 11, 35, 2, '2022-12-06'),
(19, '', 11, 36, 2, '2022-12-06'),
(20, '', 11, 38, 2, '2022-12-06'),
(21, 'GCFLGA52M15F244X', 11, 40, 2, '2022-12-06'),
(22, 'GCFLGA52M15F244X', 11, 42, 2, '2022-12-06'),
(23, 'GCFLGA52M15F244X', 11, 44, 2, '2022-12-07'),
(24, 'GCFLGA52M15F244X', 11, 46, 2, '2022-12-07'),
(26, 'GCFLGA52M15F244X', 11, 53, 1, '2022-12-07');

-- --------------------------------------------------------

--
-- Struttura della tabella `domanda_contributo`
--

CREATE TABLE `domanda_contributo` (
  `id` int(11) NOT NULL,
  `NumeroPratica` varchar(10) COLLATE utf8_bin NOT NULL,
  `richiedenteCf` varchar(16) COLLATE utf8_bin NOT NULL,
  `richiedenteNome` text COLLATE utf8_bin NOT NULL,
  `richiedenteCognome` text COLLATE utf8_bin NOT NULL,
  `richiedenteDataNascita` date NOT NULL,
  `richiedenteLuogoNascita` text COLLATE utf8_bin NOT NULL,
  `richiedenteVia` text COLLATE utf8_bin NOT NULL,
  `richiedenteLocalita` text COLLATE utf8_bin NOT NULL,
  `richiedenteProvincia` text COLLATE utf8_bin NOT NULL,
  `richiedenteEmail` text COLLATE utf8_bin NOT NULL,
  `richiedenteTel` text COLLATE utf8_bin NOT NULL,
  `inQualitaDi` varchar(1) COLLATE utf8_bin NOT NULL,
  `beneficiarioCf` varchar(16) COLLATE utf8_bin NOT NULL,
  `beneficiarioNome` text COLLATE utf8_bin NOT NULL,
  `beneficiarioCognome` text COLLATE utf8_bin NOT NULL,
  `beneficiarioDataNascita` date NOT NULL,
  `beneficiarioLuogoNascita` text COLLATE utf8_bin NOT NULL,
  `beneficiarioVia` text COLLATE utf8_bin NOT NULL,
  `beneficiarioLocalita` text COLLATE utf8_bin NOT NULL,
  `beneficiarioProvincia` text COLLATE utf8_bin NOT NULL,
  `beneficiarioEmail` text COLLATE utf8_bin NOT NULL,
  `beneficiarioTel` varchar(255) COLLATE utf8_bin NOT NULL,
  `importoContributo` varchar(30) COLLATE utf8_bin NOT NULL,
  `finalitaContributo` text COLLATE utf8_bin NOT NULL,
  `tipoPagamento_id` int(11) NOT NULL,
  `uploadPotereFirma` text COLLATE utf8_bin NOT NULL,
  `uploadDocumentazione` text COLLATE utf8_bin NOT NULL,
  `status_id` int(11) NOT NULL,
  `data_compilazione` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `domanda_contributo`
--

INSERT INTO `domanda_contributo` (`id`, `NumeroPratica`, `richiedenteCf`, `richiedenteNome`, `richiedenteCognome`, `richiedenteDataNascita`, `richiedenteLuogoNascita`, `richiedenteVia`, `richiedenteLocalita`, `richiedenteProvincia`, `richiedenteEmail`, `richiedenteTel`, `inQualitaDi`, `beneficiarioCf`, `beneficiarioNome`, `beneficiarioCognome`, `beneficiarioDataNascita`, `beneficiarioLuogoNascita`, `beneficiarioVia`, `beneficiarioLocalita`, `beneficiarioProvincia`, `beneficiarioEmail`, `beneficiarioTel`, `importoContributo`, `finalitaContributo`, `tipoPagamento_id`, `uploadPotereFirma`, `uploadDocumentazione`, `status_id`, `data_compilazione`) VALUES
(29, 'DC00000001', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 13', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78987', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 13', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78987', '500', 'Affitto dicembre 2022', 38, 'dc_potere_firma_bozza_29.pdf', 'dc_documentazione_bozza_29_0.jpg;dc_documentazione_bozza_29_1.jpg;', 0, '2022-12-06 14:27:32'),
(32, 'DC00000004', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78958', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78958', '500', 'Affitto dicembre 2022', 38, 'dc_potere_firma_bozza_32.pdf', 'dc_documentazione_bozza_32_0.jpg;dc_documentazione_bozza_32_1.jpg;', 0, '2022-12-06 14:47:37'),
(33, 'DC00000001', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78958', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78958', '500', 'Affitto dicembre 2022', 38, 'dc_potere_firma_DC00000001_32.pdf', 'dc_documentazione_DC00000001_32_0.jpg;dc_documentazione_DC00000001_32_1.jpg;', 2, '2022-12-06 14:31:07'),
(34, 'DC00000002', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78958', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78958', '500', 'Affitto dicembre 2022', 38, 'dc_potere_firma_DC00000002_32.pdf', 'dc_documentazione_DC00000002_32_0.jpg;dc_documentazione_DC00000002_32_1.jpg;', 2, '2022-12-06 14:37:03'),
(35, 'DC00000003', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78958', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78958', '500', 'Affitto dicembre 2022', 38, 'dc_potere_firma_DC00000003_32.pdf', 'dc_documentazione_DC00000003_32_0.jpg;dc_documentazione_DC00000003_32_1.jpg;', 2, '2022-12-06 14:42:25'),
(36, 'DC00000004', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78958', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 78958', '500', 'Affitto dicembre 2022', 38, 'dc_potere_firma_DC00000004_32.pdf', 'dc_documentazione_DC00000004_32_0.jpg;dc_documentazione_DC00000004_32_1.jpg;', 2, '2022-12-06 14:47:37'),
(37, 'DC00000005', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 16', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 789584', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 16', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 789584', '450', 'Affitto dicembre 2022', 38, 'dc_potere_firma_bozza_37.pdf', 'dc_documentazione_bozza_37_0.jpg;dc_documentazione_bozza_37_1.jpg;', 0, '2022-12-06 15:43:37'),
(38, 'DC00000005', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 16', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 789584', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 16', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 789584', '450', 'Affitto dicembre 2022', 38, 'dc_potere_firma_DC00000005_37.pdf', 'dc_documentazione_DC00000005_37_0.jpg;dc_documentazione_DC00000005_37_1.jpg;', 2, '2022-12-06 15:43:37'),
(39, 'DC00000006', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035879548', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035879548', '430', 'affitto dic. 22', 38, '', 'dc_documentazione_bozza_39_0.jpg;dc_documentazione_bozza_39_1.jpg;', 0, '2022-12-06 15:48:25'),
(40, 'DC00000006', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035879548', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 17', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035879548', '430', 'affitto dic. 22', 38, '', 'dc_documentazione_DC00000006_39_0.jpg;dc_documentazione_DC00000006_39_1.jpg;', 2, '2022-12-06 15:48:25'),
(41, 'DC00000007', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via Santa Maria, 13', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 58964', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via Santa Maria, 13', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 58964', '460', 'Affitto mese dicembre 22', 38, '', 'dc_documentazione_bozza_41_0.jpg;dc_documentazione_bozza_41_1.jpg;', 0, '2022-12-06 15:56:16'),
(42, 'DC00000007', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via Santa Maria, 13', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 58964', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via Santa Maria, 13', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 58964', '460', 'Affitto mese dicembre 22', 38, '', 'dc_documentazione_DC00000007_41_0.jpg;dc_documentazione_DC00000007_41_1.jpg;', 2, '2022-12-06 15:56:16'),
(43, 'DC00000008', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di test, 34', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '03589789', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di test, 34', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '03589789', '600', 'Affitto novembre/dicembre 2022', 38, 'dc_potere_firma_bozza_43.pdf', 'dc_documentazione_bozza_43_0.jpg;dc_documentazione_bozza_43_1.jpg;', 0, '2022-12-07 06:27:06'),
(44, 'DC00000008', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di test, 34', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '03589789', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di test, 34', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '03589789', '600', 'Affitto novembre/dicembre 2022', 38, 'dc_potere_firma_DC00000008_43.pdf', 'dc_documentazione_DC00000008_43_0.jpg;dc_documentazione_DC00000008_43_1.jpg;', 2, '2022-12-07 06:27:06'),
(45, 'DC00000009', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 16', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 98231', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 16', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 98231', '700', 'affitto e spese dicembre 2022', 38, 'dc_potere_firma_bozza_45.pdf', 'dc_documentazione_bozza_45_0.jpg;dc_documentazione_bozza_45_1.jpg;', 0, '2022-12-07 06:35:57'),
(46, 'DC00000009', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 16', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 98231', 'D', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', 'via di prova, 16', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '035 98231', '700', 'affitto e spese dicembre 2022', 38, 'dc_potere_firma_DC00000009_45.pdf', 'dc_documentazione_DC00000009_45_0.jpg;dc_documentazione_DC00000009_45_1.jpg;', 2, '2022-12-07 06:35:57'),
(53, '', 'GCFLGA52M15F244X', 'Luigia', 'Giucofferi', '1952-03-15', 'Carvico (BG)', '', 'Cologno al Serio', 'Bergamo', 'prova1@prova.it', '', '', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 64, '', '', 0, '2022-12-07 16:08:16');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

CREATE TABLE `messaggi` (
  `id` int(11) NOT NULL,
  `CF_to` varchar(16) COLLATE utf8_bin NOT NULL,
  `servizio_id` int(11) NOT NULL,
  `testo` text COLLATE utf8_bin NOT NULL,
  `data_msg` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `messaggi`
--

INSERT INTO `messaggi` (`id`, `CF_to`, `servizio_id`, `testo`, `data_msg`) VALUES
(15, '', 11, 'La tua domanda di contributo è stata inviata.<br/>Il numero della pratica è: <b>DC00000001</b>', '2022-12-06'),
(16, '', 11, 'La tua domanda di contributo è stata inviata.<br/>Il numero della pratica è: <b>DC00000002</b>', '2022-12-06'),
(17, '', 11, 'La tua domanda di contributo è stata inviata.<br/>Il numero della pratica è: <b>DC00000003</b>', '2022-12-06'),
(18, '', 11, 'La tua domanda di contributo è stata inviata.<br/>Il numero della pratica è: <b>DC00000004</b>', '2022-12-06'),
(19, '', 11, 'La tua domanda di contributo è stata inviata.<br/>Il numero della pratica è: <b>DC00000005</b>', '2022-12-06'),
(20, 'GCFLGA52M15F244X', 11, 'La tua domanda di contributo è stata inviata.<br/>Il numero della pratica è: <b>DC00000006</b>', '2022-12-06'),
(21, 'GCFLGA52M15F244X', 11, 'La tua domanda di contributo è stata inviata.<br/>Il numero della pratica è: <b>DC00000007</b>', '2022-12-06'),
(22, 'GCFLGA52M15F244X', 11, 'La tua domanda di contributo è stata inviata.<br/>Il numero della pratica è: <b>DC00000008</b>', '2022-12-07'),
(23, 'GCFLGA52M15F244X', 11, 'La tua domanda di contributo è stata inviata.<br/>Il numero della pratica è: <b>DC00000009</b>', '2022-12-07'),
(25, 'GCFLGA52M15F244X', 11, 'La tua domanda di contributo è stata salvata come  bozza', '2022-12-07');

-- --------------------------------------------------------

--
-- Struttura della tabella `metodi_pagamento`
--

CREATE TABLE `metodi_pagamento` (
  `id` int(11) NOT NULL,
  `cf` varchar(16) COLLATE utf8_bin NOT NULL,
  `tipo_pagamento` int(11) NOT NULL,
  `numero_pagamento` varchar(25) COLLATE utf8_bin NOT NULL,
  `predefinito` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `metodi_pagamento`
--

INSERT INTO `metodi_pagamento` (`id`, `cf`, `tipo_pagamento`, `numero_pagamento`, `predefinito`) VALUES
(38, 'GCFLGA52M15F244X', 1, 'IT88990456465000000154646', b'0'),
(64, 'GCFLGA52M15F244X', 2, '7878787878787878878', b'1'),
(65, 'GCFLGA52M15F244X', 1, 'klklkl', b'0');

-- --------------------------------------------------------

--
-- Struttura della tabella `servizi`
--

CREATE TABLE `servizi` (
  `id` int(11) NOT NULL,
  `NomeServizio` varchar(255) COLLATE utf8_bin NOT NULL,
  `NomeUfficio` varchar(255) COLLATE utf8_bin NOT NULL,
  `NomeArea` varchar(255) COLLATE utf8_bin NOT NULL,
  `NomeMacroArea` varchar(255) COLLATE utf8_bin NOT NULL,
  `DescrizioneServizio` text COLLATE utf8_bin NOT NULL,
  `LinkServizio` text COLLATE utf8_bin NOT NULL,
  `PrefissoServizio` varchar(4) COLLATE utf8_bin NOT NULL,
  `Attivo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `servizi`
--

INSERT INTO `servizi` (`id`, `NomeServizio`, `NomeUfficio`, `NomeArea`, `NomeMacroArea`, `DescrizioneServizio`, `LinkServizio`, `PrefissoServizio`, `Attivo`) VALUES
(1, 'Richiedere permesso di Parcheggio per residenti', 'Urbanistica ed edilizia', 'Parcheggi', 'Permessi e Autorizzazioni', 'Servizio relativo al rilascio di un\'autorizzazione per posteggiare nelle aree di Parcheggio pubblico a pagamento.', 'parcheggio_residenti', '', 0),
(2, 'Richiedere permesso di accesso ad area ZTL', 'Polizia municipale', 'Traffico', 'Permessi e Autorizzazioni', 'Servizio di richiesta di Autorizzazioni in deroga a divieti di circolazione.', 'ztl', '', 0),
(3, 'Richiedere permesso per Parcheggio invalidi', 'Polizia municipale', 'Autorizzazioni', 'Permessi e Autorizzazioni', 'Servizio di autorizzazione a fruire dei Parcheggi per gli invalidi tramite rilascio di contrassegno in favore dei soggetti diversamente abili, in materia di circolazione stradale.', 'parcheggio_invalidi', '', 0),
(4, 'Richiedere permesso per passo carrabile', 'Polizia municipale', 'Autorizzazioni', 'Permessi e Autorizzazioni', 'Servizio di richiesta di autorizzazione a imporre il divieto di Parcheggio presso l\'ingresso della propria abitazione.', 'passo_carrabile', '', 0),
(5, 'Richiedere una pubblicazione di matrimonio', 'Demografici elettorali e statistici', 'Stato civile', 'Permessi e Autorizzazioni', 'Servizio per la richiesta di autorizzazione previa celebrazione dei matrimoni civili.', 'pubblicazione_matrimonio', '', 0),
(6, 'Richiedere l\'accesso agli atti', 'Certificati e documenti', 'Accesso agli documenti accesso civico', 'Permessi e Autorizzazioni', 'Servizio per esercitare il proprio diritto a richiedere, prendere visione ed, eventualmente, ottenere copia dei documenti amministrativi.', 'accesso_atti', '', 0),
(7, 'Richiedere permesso di occupazione suolo pubblico', 'Commercio e attività produttive', 'Mercati', 'Permessi e Autorizzazioni', 'Servizio per richiedere la concessione a fruire degli spazi comunali.', 'occupazione_suolo', '', 0),
(8, 'Richiedere agevolazioni scolastiche', 'Servizi socio-assistenziali e sanitari', 'Sociale – assistenza scolastica', 'Vantaggi economici', 'Servizio per la fruizione di agevolazioni in ambito scolastico.', 'agevolazioni_scolastiche', '', 0),
(9, 'Presentare domanda per assegno di maternità', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Servizio per la fruizione di contributo economico concesso alle madri non occupate o non aventi diritto al trattamento di maternità, per nascite, adozioni e affidamenti preadottivi.', 'assegno_maternita', 'am_', 1),
(10, 'Presentare domanda per bonus economici', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Sovvenzioni erogate per consentire il risparmio sulla spesa per specifici servizi e/o beni, riservato ai cittadini che abbiano i requisiti stabiliti per accedere alla fruizione del vantaggio.', 'bonus_economici', '', 0),
(11, 'Presentare domanda per un contributo', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Servizio per la richiesta di sostegno nell\'affrontare le spese relative  all\'assistenza per un familiare non autosufficiente.', 'domanda_contributo', 'dc_', 1),
(12, 'Presentare domanda di agevolazione tributaria', 'Servizi socio-assistenziali e sanitari', 'Sociale – agevolazioni tributarie', 'Vantaggi economici', 'Procedimento diretto al riconoscimento delle detrazioni d\'imposta spettanti al cittadino, per la fruizione di agevolazioni e/o esenzioni tributarie o tariffarie.', 'agevolazione_tributaria', '', 0),
(13, 'Richiedere assegnazione alloggio', 'Servizi socio-assistenziali e sanitari', 'Sociale - edilizia', 'Domande con graduatoria', 'Servizio per richiedere l\'assegnazione di alloggi.', 'assegnazione_alloggio', '', 0),
(14, 'Richiedere iscrizione alla scuola dell’infanzia', 'Istruzione, formazione e sport', 'Asili nido', 'Domande con graduatoria', 'Servizio per fruire di strutture per l\'infanzia gestite a livello comunale.', 'iscrizione_scuola_infanzia', '', 0),
(15, 'Richiedere iscrizione all\'asilo nido', 'Istruzione, formazione e sport', 'Asili nido', 'Domande con graduatoria', 'Servizio per richiedere l’ammissione alla frequenza dell’asilo nido comunale, per i bambini di età compresa da 0 a 3 anni.', 'iscrizione_nido', '', 0),
(16, 'Presentare domanda di partecipazione a un concorso pubblico', 'Gare e appalti', 'Gare e appalti', 'Domande con graduatoria', 'Servizio per l\'iscrizione a concorsi per trovare impiego presso la Pubblica Amministrazione.', 'partecipazione_concorso', '', 0),
(17, 'Richiedere iscrizione al trasporto scolastico', 'Istruzione, formazione e sport', 'Servizi scolastici', 'Servizi a pagamento', 'Servizio per la fruizione del trasporto scolastico.', 'iscrizione_trasporto_scolastico', '', 0),
(18, 'Richiedere iscrizione alla mensa scolastica', 'Istruzione, formazione e sport', 'Servizi scolastici', 'Servizi a pagamento', 'Servizio per la fruizione delle mense scolastiche.', 'iscrizione_mensa_scolastica', '', 0),
(19, 'Richiedere la sepoltura di un defunto', 'Certificati e documenti', 'Demografici - Cimiteri', 'Servizi a pagamento', 'Servizio per la fruizione dei campi comuni cimiteriali per i propri defunti congiunti.', 'sepoltura', '', 0),
(20, 'Pagare tributi IMU', 'Tributi e pagamenti', 'Tributi maggiori', 'Pagamenti dovuti', 'Servizio di pagamento relativo all\'adempimento delle obbligazioni tributarie relative alle rendite catastali.', 'pagamento_imu', '', 0),
(21, 'Pagare canone CIMP', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per la diffusione o l\'esposizione di messaggi pubblicitari nel territorio comunale.', 'pagamento_cimp', '', 0),
(22, 'Pagare canone COSAP', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per l\'occupazione permanente o temporanea del suolo pubblico.', 'pagamento_cosap', '', 0),
(23, 'Pagare canone idrico', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per la fornitura di acqua potabile.', 'pagamento_canone_idrico', '', 0),
(24, 'Pagare contravvenzioni', 'Polizia municipale', 'Multe e verbali', 'Pagamenti dovuti', 'Servizio di pagamento di sanzioni dovute a violazioni di regolamenti e normative specifiche.', 'pagamento_contravvenzioni', '', 0),
(25, 'Pagare il canone per le lampade votive', 'Certificati e documenti', 'Demografici - Cimiteri', 'Pagamenti dovuti', 'Servizio per il pagamento delle spese cimiteriali.', 'pagamento_lampade_votive', '', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `sort` int(11) NOT NULL,
  `color` varchar(6) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `status`
--

INSERT INTO `status` (`id`, `nome`, `sort`, `color`) VALUES
(1, 'Bozza', 10, 'CDCDCD'),
(2, 'Inviata', 20, '0000FF'),
(3, 'In lavorazione', 30, 'FF0000'),
(4, 'Chiusa', 40, '00FF00');

-- --------------------------------------------------------

--
-- Struttura della tabella `tipo_pagamento`
--

CREATE TABLE `tipo_pagamento` (
  `id` int(11) NOT NULL,
  `Nome` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `tipo_pagamento`
--

INSERT INTO `tipo_pagamento` (`id`, `Nome`) VALUES
(1, 'Bonifico bancario su c/c al seguente IBAN'),
(2, 'Banca/Posta/Carta prepagata n.');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `anagrafica`
--
ALTER TABLE `anagrafica`
  ADD PRIMARY KEY (`CodiceFiscale`);

--
-- Indici per le tabelle `assegno_maternita`
--
ALTER TABLE `assegno_maternita`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `attivita`
--
ALTER TABLE `attivita`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `domanda_contributo`
--
ALTER TABLE `domanda_contributo`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `messaggi`
--
ALTER TABLE `messaggi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `metodi_pagamento`
--
ALTER TABLE `metodi_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `servizi`
--
ALTER TABLE `servizi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `assegno_maternita`
--
ALTER TABLE `assegno_maternita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `attivita`
--
ALTER TABLE `attivita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT per la tabella `domanda_contributo`
--
ALTER TABLE `domanda_contributo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT per la tabella `metodi_pagamento`
--
ALTER TABLE `metodi_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT per la tabella `servizi`
--
ALTER TABLE `servizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT per la tabella `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `tipo_pagamento`
--
ALTER TABLE `tipo_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
