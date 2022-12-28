CREATE TABLE `accesso_atti` (
  `id` int(11) NOT NULL,
  `NumeroPratica` varchar(10) COLLATE utf8_bin NOT NULL,
  `UfficioDestinatarioId` int(11) NOT NULL,
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
  `pgRuolo` text COLLATE utf8_bin DEFAULT NULL,
  `pgDenominazione` text COLLATE utf8_bin DEFAULT NULL,
  `pgTipologia` text COLLATE utf8_bin NOT NULL,
  `pgSedeLegaleIndirizzo` text COLLATE utf8_bin DEFAULT NULL,
  `pgSedeLegaleLocalita` text COLLATE utf8_bin DEFAULT NULL,
  `pgSedeLegaleProvincia` text COLLATE utf8_bin DEFAULT NULL,
  `pgSedeLegaleCap` text COLLATE utf8_bin DEFAULT NULL,
  `pgCf` text COLLATE utf8_bin DEFAULT NULL,
  `pgPiva` text COLLATE utf8_bin DEFAULT NULL,
  `pgTelefono` text COLLATE utf8_bin DEFAULT NULL,
  `pgEmail` text COLLATE utf8_bin DEFAULT NULL,
  `pgPec` text COLLATE utf8_bin DEFAULT NULL,
  `richiedenteTitolo` text COLLATE utf8_bin DEFAULT NULL,
  `richiedenteProfessionistaIncaricatoDa` text COLLATE utf8_bin NOT NULL,
  `richiedenteProfessionistaIncaricatoDaNome` text COLLATE utf8_bin DEFAULT NULL,
  `richiedenteProfessionistaIncaricatoDaCognome` text COLLATE utf8_bin DEFAULT NULL,
  `richiedenteProfessionistaIncaricatoDaCf` text COLLATE utf8_bin DEFAULT NULL,
  `richiedenteProfessionistaIncaricatoDaAltroSoggetto` text COLLATE utf8_bin NOT NULL,
  `richiedenteProfessionistaIncaricatoDaDescrizioneTitolo` text COLLATE utf8_bin DEFAULT NULL,
  `richiestaTipo` text COLLATE utf8_bin DEFAULT NULL,
  `richiestaAtti` text COLLATE utf8_bin DEFAULT NULL,
  `richiestaAttiTipoDocumento` text COLLATE utf8_bin DEFAULT NULL,
  `richiestaAttiProtocollo` text COLLATE utf8_bin DEFAULT NULL,
  `richiestaAttiData` date DEFAULT NULL,
  `collocazioneTerritorialeCodiceCatastale` text COLLATE utf8_bin DEFAULT NULL,
  `collocazioneTerritorialeSezione` text COLLATE utf8_bin DEFAULT NULL,
  `collocazioneTerritorialeFoglio` text COLLATE utf8_bin DEFAULT NULL,
  `collocazioneTerritorialeParticella` text COLLATE utf8_bin DEFAULT NULL,
  `collocazioneTerritorialeSubalterno` text COLLATE utf8_bin DEFAULT NULL,
  `collocazioneTerritorialeCategoria` text COLLATE utf8_bin DEFAULT NULL,
  `collocazioneTerritorialeIndirizzo` text COLLATE utf8_bin DEFAULT NULL,
  `collocazioneTerritorialeLocalita` text COLLATE utf8_bin DEFAULT NULL,
  `collocazioneTerritorialeProvincia` text COLLATE utf8_bin DEFAULT NULL,
  `motivo` text COLLATE utf8_bin DEFAULT NULL,
  `motivoAltro` text COLLATE utf8_bin NOT NULL,
  `modoRitiro` text COLLATE utf8_bin DEFAULT NULL,
  `modoRitiroPostaIndirizzo` text COLLATE utf8_bin DEFAULT NULL,
  `modoRitiroPostaLocalita` text COLLATE utf8_bin DEFAULT NULL,
  `modoRitiroPostaProvincia` text COLLATE utf8_bin DEFAULT NULL,
  `modoRitiroPostaCap` text COLLATE utf8_bin DEFAULT NULL,
  `annotazioni` text COLLATE utf8_bin DEFAULT NULL,
  `uploadTitoloDichiarato` text COLLATE utf8_bin DEFAULT NULL,
  `uploadAffittuario` text COLLATE utf8_bin DEFAULT NULL,
  `uploadAltroSoggetto` text COLLATE utf8_bin DEFAULT NULL,
  `uploadNotaioRogante` text COLLATE utf8_bin DEFAULT NULL,
  `uploadAltriTitoloDescrizione` text COLLATE utf8_bin DEFAULT NULL,
  `uploadCartaIdentitaFronte` text COLLATE utf8_bin DEFAULT NULL,
  `uploadCartaIdentitaRetro` text COLLATE utf8_bin DEFAULT NULL,
  `uploadAttoNotarile` text COLLATE utf8_bin DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `data_compilazione` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `anagrafica` (
  `CodiceFiscale` varchar(16) COLLATE utf8_bin NOT NULL COMMENT 'Codice Fiscale - Chiave Primaria',
  `Nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `Cognome` varchar(255) COLLATE utf8_bin NOT NULL,
  `Email` varchar(255) COLLATE utf8_bin NOT NULL,
  `DataNascita` date NOT NULL,
  `LuogoNascita` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


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
  `DichiarazioneAffidamento` int(1) DEFAULT 0,
  `DichiarazioneAffidamentoData` date DEFAULT NULL,
  `tipoPagamento_id` int(11) DEFAULT NULL,
  `uploadCartaIdentitaFronte` text COLLATE utf8_bin DEFAULT NULL,
  `uploadCartaIdentitaRetro` text COLLATE utf8_bin DEFAULT NULL,
  `uploadTitoloSoggiorno` text COLLATE utf8_bin DEFAULT NULL,
  `uploadDichiarazioneDatoreLavoro` text COLLATE utf8_bin DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `data_compilazione` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `attivita` (
  `id` int(11) NOT NULL,
  `cf` varchar(16) COLLATE utf8_bin NOT NULL,
  `servizio_id` int(11) NOT NULL,
  `pratica_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `data_attivita` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `bonus_economici` (
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
  `uploadIsee` text COLLATE utf8_bin NOT NULL,
  `uploadDocumentazione` text COLLATE utf8_bin NOT NULL,
  `status_id` int(11) NOT NULL,
  `data_compilazione` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

CREATE TABLE `concorsi` (
  `id` int(11) NOT NULL,
  `titolo` text COLLATE utf8_bin DEFAULT NULL,
  `testo` text COLLATE utf8_bin DEFAULT NULL,
  `scadenza` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `concorsi` (`id`, `titolo`, `testo`, `scadenza`) VALUES
(1, 'ISTRUTTORE AMMINISTRATIVO A TEMPO PIENO E INDETERMINATO CATEGORIA C - POSIZIONE ECONOMICA C1 da assegnare al Settore III', 'Concorso pubblico per esami per la copertura di n. 1 posto a tempo pieno\ne indeterminato, profilo professionale di ISTRUTTORE AMMINISTRATIVO A TEMPO PIENO E INDETERMINATO CATEGORIA C - POSIZIONE ECONOMICA C1 da assegnare al Settore III – Servizi alla Persona, con riserva a favore delle FF.AA. ai sensi degli artt. n. 1014, comma 1, lettera a) e n. 678, comma 9, d.lgs. n. 66/2010', '2023-01-06');


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


CREATE TABLE `messaggi` (
  `id` int(11) NOT NULL,
  `CF_to` varchar(16) COLLATE utf8_bin NOT NULL,
  `servizio_id` int(11) NOT NULL,
  `testo` text COLLATE utf8_bin NOT NULL,
  `data_msg` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `metodi_pagamento` (
  `id` int(11) NOT NULL,
  `cf` varchar(16) COLLATE utf8_bin NOT NULL,
  `tipo_pagamento` int(11) NOT NULL,
  `numero_pagamento` varchar(255) COLLATE utf8_bin NOT NULL,
  `predefinito` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `partecipazione_concorso` (
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
  `ConcorsoId` int(11) NOT NULL,
  `cittadinoItaliano` int(1) NOT NULL DEFAULT 0,
  `cittadinoEuropeo` int(1) NOT NULL DEFAULT 0,
  `statoEuropeo` text COLLATE utf8_bin DEFAULT NULL,
  `conoscenzaLingua` int(1) NOT NULL DEFAULT 0,
  `idoneitaFisica` int(1) NOT NULL DEFAULT 0,
  `dirittiCiviliPolitici` int(1) NOT NULL DEFAULT 0,
  `destituzionePA` int(1) NOT NULL DEFAULT 0,
  `fedinaPulita` int(1) NOT NULL DEFAULT 0,
  `condanne` text COLLATE utf8_bin DEFAULT NULL,
  `obbligoLeva` int(1) NOT NULL DEFAULT 0,
  `titoloStudio` text COLLATE utf8_bin NOT NULL,
  `titoloStudioScuola` text COLLATE utf8_bin NOT NULL,
  `titoloStudioData` date NOT NULL,
  `titoloStudioVoto` text COLLATE utf8_bin NOT NULL,
  `conoscenzaInformatica` int(1) NOT NULL DEFAULT 0,
  `conoscenzaLinguaEstera` text COLLATE utf8_bin NOT NULL,
  `titoliPreferenza` text COLLATE utf8_bin DEFAULT NULL,
  `necessitaHandicap` text COLLATE utf8_bin DEFAULT NULL,
  `dirittoRiserva` int(1) NOT NULL DEFAULT 0,
  `accettazioneCondizioniBando` int(1) NOT NULL DEFAULT 0,
  `accettazioneDisposizioniComune` int(1) NOT NULL DEFAULT 0,
  `accettazioneComunicazioneVariazioniDomicilio` int(1) NOT NULL DEFAULT 0,
  `uploadCV` text COLLATE utf8_bin NOT NULL,
  `uploadCartaIdentitaFronte` text COLLATE utf8_bin NOT NULL,
  `uploadCartaIdentitaRetro` text COLLATE utf8_bin NOT NULL,
  `uploadTitoliPreferenza` text COLLATE utf8_bin NOT NULL,
  `status_id` int(11) NOT NULL,
  `data_compilazione` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `pubblicazione_matrimonio` (
  `id` int(11) NOT NULL,
  `NumeroPratica` varchar(10) COLLATE utf8_bin NOT NULL,
  `richiedenteCf` varchar(16) COLLATE utf8_bin NOT NULL,
  `richiedenteNome` text COLLATE utf8_bin NOT NULL,
  `richiedenteCognome` text COLLATE utf8_bin NOT NULL,
  `richiedenteDataNascita` date NOT NULL,
  `richiedenteLuogoNascita` text COLLATE utf8_bin NOT NULL,
  `richiedenteStatoNascita` text COLLATE utf8_bin NOT NULL,
  `richiedenteStatoCivile` text COLLATE utf8_bin NOT NULL,
  `richiedenteAttoNascita` text COLLATE utf8_bin NOT NULL,
  `richiedenteAttoNascitaData` text COLLATE utf8_bin NOT NULL,
  `richiedenteVia` text COLLATE utf8_bin NOT NULL,
  `richiedenteLocalita` text COLLATE utf8_bin NOT NULL,
  `richiedenteProvincia` text COLLATE utf8_bin NOT NULL,
  `richiedenteEmail` text COLLATE utf8_bin NOT NULL,
  `richiedenteTel` text COLLATE utf8_bin NOT NULL,
  `coniugeNome` text COLLATE utf8_bin NOT NULL,
  `coniugeCognome` text COLLATE utf8_bin NOT NULL,
  `coniugeCf` varchar(16) COLLATE utf8_bin NOT NULL,
  `coniugeDataNascita` date NOT NULL,
  `coniugeLuogoNascita` text COLLATE utf8_bin NOT NULL,
  `coniugeStatoNascita` text COLLATE utf8_bin NOT NULL,
  `coniugeStatoCivile` text COLLATE utf8_bin NOT NULL,
  `coniugeAttoNascita` text COLLATE utf8_bin NOT NULL,
  `coniugeAttoNascitaData` text COLLATE utf8_bin NOT NULL,
  `coniugeVia` text COLLATE utf8_bin NOT NULL,
  `coniugeLocalita` text COLLATE utf8_bin NOT NULL,
  `coniugeProvincia` text COLLATE utf8_bin NOT NULL,
  `coniugeEmail` text COLLATE utf8_bin NOT NULL,
  `coniugeTel` text COLLATE utf8_bin NOT NULL,
  `status_id` int(11) NOT NULL,
  `data_compilazione` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


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


INSERT INTO `servizi` (`id`, `NomeServizio`, `NomeUfficio`, `NomeArea`, `NomeMacroArea`, `DescrizioneServizio`, `LinkServizio`, `PrefissoServizio`, `Attivo`) VALUES
(1, 'Richiedere permesso di Parcheggio per residenti', 'Urbanistica ed edilizia', 'Parcheggi', 'Permessi e Autorizzazioni', 'Servizio relativo al rilascio di un\'autorizzazione per posteggiare nelle aree di Parcheggio pubblico a pagamento.', 'parcheggio_residenti', '', 0),
(2, 'Richiedere permesso di accesso ad area ZTL', 'Polizia municipale', 'Traffico', 'Permessi e Autorizzazioni', 'Servizio di richiesta di Autorizzazioni in deroga a divieti di circolazione.', 'ztl', '', 0),
(3, 'Richiedere permesso per Parcheggio invalidi', 'Polizia municipale', 'Autorizzazioni', 'Permessi e Autorizzazioni', 'Servizio di autorizzazione a fruire dei Parcheggi per gli invalidi tramite rilascio di contrassegno in favore dei soggetti diversamente abili, in materia di circolazione stradale.', 'parcheggio_invalidi', '', 0),
(4, 'Richiedere permesso per passo carrabile', 'Polizia municipale', 'Autorizzazioni', 'Permessi e Autorizzazioni', 'Servizio di richiesta di autorizzazione a imporre il divieto di Parcheggio presso l\'ingresso della propria abitazione.', 'passo_carrabile', '', 0),
(5, 'Richiedere una pubblicazione di matrimonio', 'Demografici elettorali e statistici', 'Stato civile', 'Permessi e Autorizzazioni', 'Servizio per la richiesta di autorizzazione previa celebrazione dei matrimoni civili.', 'pubblicazione_matrimonio', 'pm_', 1),
(6, 'Richiedere l\'accesso agli atti', 'Certificati e documenti', 'Accesso agli documenti accesso civico', 'Permessi e Autorizzazioni', 'Servizio per esercitare il proprio diritto a richiedere, prendere visione ed, eventualmente, ottenere copia dei documenti amministrativi.', 'accesso_atti', 'aa_', 1),
(7, 'Richiedere permesso di occupazione suolo pubblico', 'Commercio e attività produttive', 'Mercati', 'Permessi e Autorizzazioni', 'Servizio per richiedere la concessione a fruire degli spazi comunali.', 'occupazione_suolo', '', 0),
(8, 'Richiedere agevolazioni scolastiche', 'Servizi socio-assistenziali e sanitari', 'Sociale – assistenza scolastica', 'Vantaggi economici', 'Servizio per la fruizione di agevolazioni in ambito scolastico.', 'agevolazioni_scolastiche', '', 0),
(9, 'Presentare domanda per assegno di maternità', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Servizio per la fruizione di contributo economico concesso alle madri non occupate o non aventi diritto al trattamento di maternità, per nascite, adozioni e affidamenti preadottivi.', 'assegno_maternita', 'am_', 1),
(10, 'Presentare domanda per bonus economici', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Sovvenzioni erogate per consentire il risparmio sulla spesa per specifici servizi e/o beni, riservato ai cittadini che abbiano i requisiti stabiliti per accedere alla fruizione del vantaggio.', 'bonus_economici', 'be_', 1),
(11, 'Presentare domanda per un contributo', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Servizio per la richiesta di sostegno nell\'affrontare le spese relative  all\'assistenza per un familiare non autosufficiente.', 'domanda_contributo', 'dc_', 1),
(12, 'Presentare domanda di agevolazione tributaria', 'Servizi socio-assistenziali e sanitari', 'Sociale – agevolazioni tributarie', 'Vantaggi economici', 'Procedimento diretto al riconoscimento delle detrazioni d\'imposta spettanti al cittadino, per la fruizione di agevolazioni e/o esenzioni tributarie o tariffarie.', 'agevolazione_tributaria', '', 0),
(13, 'Richiedere assegnazione alloggio', 'Servizi socio-assistenziali e sanitari', 'Sociale - edilizia', 'Domande con graduatoria', 'Servizio per richiedere l\'assegnazione di alloggi.', 'assegnazione_alloggio', '', 0),
(14, 'Richiedere iscrizione alla scuola dell’infanzia', 'Istruzione, formazione e sport', 'Asili nido', 'Domande con graduatoria', 'Servizio per fruire di strutture per l\'infanzia gestite a livello comunale.', 'iscrizione_scuola_infanzia', '', 0),
(15, 'Richiedere iscrizione all\'asilo nido', 'Istruzione, formazione e sport', 'Asili nido', 'Domande con graduatoria', 'Servizio per richiedere l’ammissione alla frequenza dell’asilo nido comunale, per i bambini di età compresa da 0 a 3 anni.', 'iscrizione_nido', '', 0),
(16, 'Presentare domanda di partecipazione a un concorso pubblico', 'Gare e appalti', 'Gare e appalti', 'Domande con graduatoria', 'Servizio per l\'iscrizione a concorsi per trovare impiego presso la Pubblica Amministrazione.', 'partecipazione_concorso', 'pc_', 1),
(17, 'Richiedere iscrizione al trasporto scolastico', 'Istruzione, formazione e sport', 'Servizi scolastici', 'Servizi a pagamento', 'Servizio per la fruizione del trasporto scolastico.', 'iscrizione_trasporto_scolastico', '', 0),
(18, 'Richiedere iscrizione alla mensa scolastica', 'Istruzione, formazione e sport', 'Servizi scolastici', 'Servizi a pagamento', 'Servizio per la fruizione delle mense scolastiche.', 'iscrizione_mensa_scolastica', '', 0),
(19, 'Richiedere la sepoltura di un defunto', 'Certificati e documenti', 'Demografici - Cimiteri', 'Servizi a pagamento', 'Servizio per la fruizione dei campi comuni cimiteriali per i propri defunti congiunti.', 'sepoltura', '', 0),
(20, 'Pagare tributi IMU', 'Tributi e pagamenti', 'Tributi maggiori', 'Pagamenti dovuti', 'Servizio di pagamento relativo all\'adempimento delle obbligazioni tributarie relative alle rendite catastali.', 'pagamento_imu', '', 0),
(21, 'Pagare canone CIMP', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per la diffusione o l\'esposizione di messaggi pubblicitari nel territorio comunale.', 'pagamento_cimp', '', 0),
(22, 'Pagare canone COSAP', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per l\'occupazione permanente o temporanea del suolo pubblico.', 'pagamento_cosap', '', 0),
(23, 'Pagare canone idrico', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per la fornitura di acqua potabile.', 'pagamento_canone_idrico', '', 0),
(24, 'Pagare contravvenzioni', 'Polizia municipale', 'Multe e verbali', 'Pagamenti dovuti', 'Servizio di pagamento di sanzioni dovute a violazioni di regolamenti e normative specifiche.', 'pagamento_contravvenzioni', '', 0),
(25, 'Pagare il canone per le lampade votive', 'Certificati e documenti', 'Demografici - Cimiteri', 'Pagamenti dovuti', 'Servizio per il pagamento delle spese cimiteriali.', 'pagamento_lampade_votive', '', 0);


CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) COLLATE utf8_bin NOT NULL,
  `sort` int(11) NOT NULL,
  `color` varchar(6) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `status` (`id`, `nome`, `sort`, `color`) VALUES
(1, 'Bozza', 10, 'CDCDCD'),
(2, 'Inviata', 20, '0000FF'),
(3, 'In lavorazione', 30, 'FF0000'),
(4, 'Chiusa', 40, '00FF00'),
(5, 'Rifiutata', 50, 'FF0000');


CREATE TABLE `tipo_pagamento` (
  `id` int(11) NOT NULL,
  `Nome` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `tipo_pagamento` (`id`, `Nome`) VALUES
(1, 'Bonifico bancario su c/c al seguente IBAN'),
(2, 'Banca/Posta/Carta prepagata n.');


CREATE TABLE `uffici` (
  `Id` int(11) NOT NULL,
  `Nome` text CHARACTER SET utf8 NOT NULL,
  `Sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `uffici` (`Id`, `Nome`, `Sort`) VALUES
(1, 'Servizi Scolastici', 10),
(2, 'Vice Segretario Comunale', 20),
(3, 'Tributi', 30),
(4, 'Lavori Pubblici', 40),
(5, 'Edilizia Privata', 50),
(6, 'Servizi Sociali', 60),
(7, 'Polizia Locale', 70),
(8, 'Segreteria', 80),
(9, 'Protocollo', 90),
(10, 'Messo Comunale', 100);

ALTER TABLE `accesso_atti`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `anagrafica`
  ADD PRIMARY KEY (`CodiceFiscale`);

ALTER TABLE `assegno_maternita`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `attivita`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `bonus_economici`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `concorsi`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `domanda_contributo`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `messaggi`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `metodi_pagamento`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `partecipazione_concorso`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pubblicazione_matrimonio`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `servizi`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `tipo_pagamento`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `uffici`
  ADD PRIMARY KEY (`Id`);

ALTER TABLE `accesso_atti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `assegno_maternita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `attivita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `bonus_economici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `concorsi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `domanda_contributo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `messaggi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `metodi_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `partecipazione_concorso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `pubblicazione_matrimonio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `servizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `tipo_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `uffici`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
