-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 21, 2022 alle 15:55
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

-- --------------------------------------------------------

--
-- Struttura della tabella `anagrafica`
--

CREATE TABLE `anagrafica` (
  `CodiceFiscale` varchar(16) COLLATE utf8_bin NOT NULL COMMENT 'Codice Fiscale - Chiave Primaria',
  `Nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `Cognome` varchar(255) COLLATE utf8_bin NOT NULL,
  `Email` varchar(255) COLLATE utf8_bin NOT NULL,
  `DataNascita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `anagrafica`
--

INSERT INTO `anagrafica` (`CodiceFiscale`, `Nome`, `Cognome`, `Email`, `DataNascita`) VALUES
('DPLPLA80S48L400S', 'Giovanna', 'Rossi', 'prova@prova.it', '1979-03-21'),
('DRLPLA80S48L400S', 'Paola', 'Durelli', 'paola.durelli@proximalab.it', '1980-11-08'),
('GCFLGA52M15F244X', 'Luigia', 'Giucofferi', 'prova1@prova.it', '1952-03-15');

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
  `Attivo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `servizi`
--

INSERT INTO `servizi` (`id`, `NomeServizio`, `NomeUfficio`, `NomeArea`, `NomeMacroArea`, `DescrizioneServizio`, `Attivo`) VALUES
(1, 'Richiedere permesso di Parcheggio per residenti', 'Urbanistica ed edilizia', 'Parcheggi', 'Permessi e Autorizzazioni', 'Servizio relativo al rilascio di un\'autorizzazione per posteggiare nelle aree di Parcheggio pubblico a pagamento.', 1),
(2, 'Richiedere permesso di accesso ad area ZTL', 'Polizia municipale', 'Traffico', 'Permessi e Autorizzazioni', 'Servizio di richiesta di Autorizzazioni in deroga a divieti di circolazione.', 1),
(3, 'Richiedere permesso per Parcheggio invalidi', 'Polizia municipale', 'Autorizzazioni', 'Permessi e Autorizzazioni', 'Servizio di autorizzazione a fruire dei Parcheggi per gli invalidi tramite rilascio di contrassegno in favore dei soggetti diversamente abili, in materia di circolazione stradale.', 1),
(4, 'Richiedere permesso per passo carrabile', 'Polizia municipale', 'Autorizzazioni', 'Permessi e Autorizzazioni', 'Servizio di richiesta di autorizzazione a imporre il divieto di Parcheggio presso l\'ingresso della propria abitazione.', 1),
(5, 'Richiedere una pubblicazione di matrimonio', 'Demografici elettorali e statistici', 'Stato civile', 'Permessi e Autorizzazioni', 'Servizio per la richiesta di autorizzazione previa celebrazione dei matrimoni civili.', 1),
(6, 'Richiedere l\'accesso agli atti', 'Certificati e documenti', 'Accesso agli documenti accesso civico', 'Permessi e Autorizzazioni', 'Servizio per esercitare il proprio diritto a richiedere, prendere visione ed, eventualmente, ottenere copia dei documenti amministrativi.', 1),
(7, 'Richiedere permesso di occupazione suolo pubblico', 'Commercio e attività produttive', 'Mercati', 'Permessi e Autorizzazioni', 'Servizio per richiedere la concessione a fruire degli spazi comunali.', 1),
(8, 'Richiedere agevolazioni scolastiche', 'Servizi socio-assistenziali e sanitari', 'Sociale – assistenza scolastica', 'Vantaggi economici', 'Servizio per la fruizione di agevolazioni in ambito scolastico.', 1),
(9, 'Presentare domanda per assegno di maternità', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Servizio per la fruizione di contributo economico concesso alle madri non occupate o non aventi diritto al trattamento di maternità, per nascite, adozioni e affidamenti preadottivi.', 1),
(10, 'Presentare domanda per bonus economici', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Sovvenzioni erogate per consentire il risparmio sulla spesa per specifici servizi e/o beni, riservato ai cittadini che abbiano i requisiti stabiliti per accedere alla fruizione del vantaggio.', 1),
(11, 'Presentare domanda per un contributo', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Servizio per la richiesta di sostegno nell\'affrontare le spese relative  all\'assistenza per un familiare non autosufficiente.', 1),
(12, 'Presentare domanda di agevolazione tributaria', 'Servizi socio-assistenziali e sanitari', 'Sociale – agevolazioni tributarie', 'Vantaggi economici', 'Procedimento diretto al riconoscimento delle detrazioni d\'imposta spettanti al cittadino, per la fruizione di agevolazioni e/o esenzioni tributarie o tariffarie.', 1),
(13, 'Richiedere assegnazione alloggio', 'Servizi socio-assistenziali e sanitari', 'Sociale - edilizia', 'Domande con graduatoria', 'Servizio per richiedere l\'assegnazione di alloggi.', 1),
(14, 'Richiedere iscrizione alla scuola dell’infanzia', 'Istruzione, formazione e sport', 'Asili nido', 'Domande con graduatoria', 'Servizio per fruire di strutture per l\'infanzia gestite a livello comunale.', 1),
(15, 'Richiedere iscrizione all\'asilo nido', 'Istruzione, formazione e sport', 'Asili nido', 'Domande con graduatoria', 'Servizio per richiedere l’ammissione alla frequenza dell’asilo nido comunale, per i bambini di età compresa da 0 a 3 anni.', 1),
(16, 'Presentare domanda di partecipazione a un concorso pubblico', 'Gare e appalti', 'Gare e appalti', 'Domande con graduatoria', 'Servizio per l\'iscrizione a concorsi per trovare impiego presso la Pubblica Amministrazione.', 1),
(17, 'Richiedere iscrizione al trasporto scolastico', 'Istruzione, formazione e sport', 'Servizi scolastici', 'Servizi a pagamento', 'Servizio per la fruizione del trasporto scolastico.', 1),
(18, 'Richiedere iscrizione alla mensa scolastica', 'Istruzione, formazione e sport', 'Servizi scolastici', 'Servizi a pagamento', 'Servizio per la fruizione delle mense scolastiche.', 1),
(19, 'Richiedere la sepoltura di un defunto', 'Certificati e documenti', 'Demografici - Cimiteri', 'Servizi a pagamento', 'Servizio per la fruizione dei campi comuni cimiteriali per i propri defunti congiunti.', 1),
(20, 'Pagare tributi IMU', 'Tributi e pagamenti', 'Tributi maggiori', 'Pagamenti dovuti', 'Servizio di pagamento relativo all\'adempimento delle obbligazioni tributarie relative alle rendite catastali.', 1),
(21, 'Pagare canone CIMP', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per la diffusione o l\'esposizione di messaggi pubblicitari nel territorio comunale.', 1),
(22, 'Pagare canone COSAP', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per l\'occupazione permanente o temporanea del suolo pubblico.', 1),
(23, 'Pagare canone idrico', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per la fornitura di acqua potabile.', 1),
(24, 'Pagare contravvenzioni', 'Polizia municipale', 'Multe e verbali', 'Pagamenti dovuti', 'Servizio di pagamento di sanzioni dovute a violazioni di regolamenti e normative specifiche.', 1),
(25, 'Pagare il canone per le lampade votive', 'Certificati e documenti', 'Demografici - Cimiteri', 'Pagamenti dovuti', 'Servizio per il pagamento delle spese cimiteriali.', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `anagrafica`
--
ALTER TABLE `anagrafica`
  ADD PRIMARY KEY (`CodiceFiscale`);

--
-- Indici per le tabelle `servizi`
--
ALTER TABLE `servizi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `servizi`
--
ALTER TABLE `servizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
