-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Nov 29, 2022 alle 16:30
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
-- Struttura della tabella `attivita`
--

CREATE TABLE `attivita` (
  `id` int(11) NOT NULL,
  `cf` varchar(16) COLLATE utf8_bin NOT NULL,
  `servizio_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `data_attivita` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `attivita`
--

INSERT INTO `attivita` (`id`, `cf`, `servizio_id`, `status_id`, `data_attivita`) VALUES
(1, 'GCFLGA52M15F244X', 2, 1, '2022-11-09');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

CREATE TABLE `messaggi` (
  `id` int(11) NOT NULL,
  `CF_to` varchar(16) COLLATE utf8_bin NOT NULL,
  `servizio_id` int(11) NOT NULL,
  `testo` text COLLATE utf8_bin NOT NULL,
  `data_msg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `messaggi`
--

INSERT INTO `messaggi` (`id`, `CF_to`, `servizio_id`, `testo`, `data_msg`) VALUES
(1, 'GCFLGA52M15F244X', 1, 'Buongiorno,\r\npotreste indicarmi la via per favore? \r\nGrazie', '2022-11-01'),
(2, 'DRLPLA80S48L400S', 13, 'La tua richiesta é stata ricevuta.', '2022-11-18');

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
(1, 'GCFLGA52M15F244X', 1, 'IT88990456465000000154646', b'0'),
(2, 'GCFLGA52M15F244X', 2, '7878787878787878878', b'1');

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
  `Attivo` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dump dei dati per la tabella `servizi`
--

INSERT INTO `servizi` (`id`, `NomeServizio`, `NomeUfficio`, `NomeArea`, `NomeMacroArea`, `DescrizioneServizio`, `LinkServizio`, `Attivo`) VALUES
(1, 'Richiedere permesso di Parcheggio per residenti', 'Urbanistica ed edilizia', 'Parcheggi', 'Permessi e Autorizzazioni', 'Servizio relativo al rilascio di un\'autorizzazione per posteggiare nelle aree di Parcheggio pubblico a pagamento.', 'parcheggio_residenti', 0),
(2, 'Richiedere permesso di accesso ad area ZTL', 'Polizia municipale', 'Traffico', 'Permessi e Autorizzazioni', 'Servizio di richiesta di Autorizzazioni in deroga a divieti di circolazione.', 'ztl', 0),
(3, 'Richiedere permesso per Parcheggio invalidi', 'Polizia municipale', 'Autorizzazioni', 'Permessi e Autorizzazioni', 'Servizio di autorizzazione a fruire dei Parcheggi per gli invalidi tramite rilascio di contrassegno in favore dei soggetti diversamente abili, in materia di circolazione stradale.', 'parcheggio_invalidi', 0),
(4, 'Richiedere permesso per passo carrabile', 'Polizia municipale', 'Autorizzazioni', 'Permessi e Autorizzazioni', 'Servizio di richiesta di autorizzazione a imporre il divieto di Parcheggio presso l\'ingresso della propria abitazione.', 'passo_carrabile', 0),
(5, 'Richiedere una pubblicazione di matrimonio', 'Demografici elettorali e statistici', 'Stato civile', 'Permessi e Autorizzazioni', 'Servizio per la richiesta di autorizzazione previa celebrazione dei matrimoni civili.', 'pubblicazione_matrimonio', 0),
(6, 'Richiedere l\'accesso agli atti', 'Certificati e documenti', 'Accesso agli documenti accesso civico', 'Permessi e Autorizzazioni', 'Servizio per esercitare il proprio diritto a richiedere, prendere visione ed, eventualmente, ottenere copia dei documenti amministrativi.', 'accesso_atti', 0),
(7, 'Richiedere permesso di occupazione suolo pubblico', 'Commercio e attività produttive', 'Mercati', 'Permessi e Autorizzazioni', 'Servizio per richiedere la concessione a fruire degli spazi comunali.', 'occupazione_suolo', 0),
(8, 'Richiedere agevolazioni scolastiche', 'Servizi socio-assistenziali e sanitari', 'Sociale – assistenza scolastica', 'Vantaggi economici', 'Servizio per la fruizione di agevolazioni in ambito scolastico.', 'agevolazioni_scolastiche', 0),
(9, 'Presentare domanda per assegno di maternità', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Servizio per la fruizione di contributo economico concesso alle madri non occupate o non aventi diritto al trattamento di maternità, per nascite, adozioni e affidamenti preadottivi.', 'assegno_maternita', 0),
(10, 'Presentare domanda per bonus economici', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Sovvenzioni erogate per consentire il risparmio sulla spesa per specifici servizi e/o beni, riservato ai cittadini che abbiano i requisiti stabiliti per accedere alla fruizione del vantaggio.', 'bonus_economici', 0),
(11, 'Presentare domanda per un contributo', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Servizio per la richiesta di sostegno nell\'affrontare le spese relative  all\'assistenza per un familiare non autosufficiente.', 'domanda_contributo', 1),
(12, 'Presentare domanda di agevolazione tributaria', 'Servizi socio-assistenziali e sanitari', 'Sociale – agevolazioni tributarie', 'Vantaggi economici', 'Procedimento diretto al riconoscimento delle detrazioni d\'imposta spettanti al cittadino, per la fruizione di agevolazioni e/o esenzioni tributarie o tariffarie.', 'agevolazione_tributaria', 0),
(13, 'Richiedere assegnazione alloggio', 'Servizi socio-assistenziali e sanitari', 'Sociale - edilizia', 'Domande con graduatoria', 'Servizio per richiedere l\'assegnazione di alloggi.', 'assegnazione_alloggio', 0),
(14, 'Richiedere iscrizione alla scuola dell’infanzia', 'Istruzione, formazione e sport', 'Asili nido', 'Domande con graduatoria', 'Servizio per fruire di strutture per l\'infanzia gestite a livello comunale.', 'iscrizione_scuola_infanzia', 0),
(15, 'Richiedere iscrizione all\'asilo nido', 'Istruzione, formazione e sport', 'Asili nido', 'Domande con graduatoria', 'Servizio per richiedere l’ammissione alla frequenza dell’asilo nido comunale, per i bambini di età compresa da 0 a 3 anni.', 'iscrizione_nido', 0),
(16, 'Presentare domanda di partecipazione a un concorso pubblico', 'Gare e appalti', 'Gare e appalti', 'Domande con graduatoria', 'Servizio per l\'iscrizione a concorsi per trovare impiego presso la Pubblica Amministrazione.', 'partecipazione_concorso', 0),
(17, 'Richiedere iscrizione al trasporto scolastico', 'Istruzione, formazione e sport', 'Servizi scolastici', 'Servizi a pagamento', 'Servizio per la fruizione del trasporto scolastico.', 'iscrizione_trasporto_scolastico', 0),
(18, 'Richiedere iscrizione alla mensa scolastica', 'Istruzione, formazione e sport', 'Servizi scolastici', 'Servizi a pagamento', 'Servizio per la fruizione delle mense scolastiche.', 'iscrizione_mensa_scolastica', 0),
(19, 'Richiedere la sepoltura di un defunto', 'Certificati e documenti', 'Demografici - Cimiteri', 'Servizi a pagamento', 'Servizio per la fruizione dei campi comuni cimiteriali per i propri defunti congiunti.', 'sepoltura', 0),
(20, 'Pagare tributi IMU', 'Tributi e pagamenti', 'Tributi maggiori', 'Pagamenti dovuti', 'Servizio di pagamento relativo all\'adempimento delle obbligazioni tributarie relative alle rendite catastali.', 'pagamento_imu', 0),
(21, 'Pagare canone CIMP', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per la diffusione o l\'esposizione di messaggi pubblicitari nel territorio comunale.', 'pagamento_cimp', 0),
(22, 'Pagare canone COSAP', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per l\'occupazione permanente o temporanea del suolo pubblico.', 'pagamento_cosap', 0),
(23, 'Pagare canone idrico', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per la fornitura di acqua potabile.', 'pagamento_canone_idrico', 0),
(24, 'Pagare contravvenzioni', 'Polizia municipale', 'Multe e verbali', 'Pagamenti dovuti', 'Servizio di pagamento di sanzioni dovute a violazioni di regolamenti e normative specifiche.', 'pagamento_contravvenzioni', 0),
(25, 'Pagare il canone per le lampade votive', 'Certificati e documenti', 'Demografici - Cimiteri', 'Pagamenti dovuti', 'Servizio per il pagamento delle spese cimiteriali.', 'pagamento_lampade_votive', 0);

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
-- Indici per le tabelle `attivita`
--
ALTER TABLE `attivita`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `messaggi`
--
ALTER TABLE `messaggi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CF_to` (`CF_to`,`servizio_id`);

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
-- AUTO_INCREMENT per la tabella `attivita`
--
ALTER TABLE `attivita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `metodi_pagamento`
--
ALTER TABLE `metodi_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
