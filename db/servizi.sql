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
  `id_orig` int(11) DEFAULT NULL,
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
  `id_orig` int(11) DEFAULT NULL,
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
  `id_orig` int(11) DEFAULT NULL,
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

CREATE TABLE `config_settings` (
  `id` int(11) NOT NULL,
  `descrizione` text COLLATE utf8_bin DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `prefix` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `suffix` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `config_settings` (`id`, `descrizione`, `value`, `prefix`, `suffix`) VALUES
(1, 'Numero Protocollo', '000001', NULL, '23');

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
  `id_orig` int(11) DEFAULT NULL,
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
  `id_orig` int(11) DEFAULT NULL,
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
  `id_orig` int(11) DEFAULT NULL,
  `data_compilazione` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `ServizioId` int(11) NOT NULL,
  `PraticaId` int(11) NOT NULL,
  `userCf` varchar(16) COLLATE utf8_bin NOT NULL,
  `rating` int(11) NOT NULL,
  `negative` int(11) NOT NULL,
  `positive` int(11) NOT NULL,
  `comment` text COLLATE utf8_bin NOT NULL,
  `data_inserimento` timestamp NOT NULL DEFAULT current_timestamp()
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
  `Attivo` tinyint(1) NOT NULL DEFAULT 0,
  `PaginaChiRivolto` text COLLATE utf8_bin DEFAULT NULL,
  `PaginaDescrizione` text COLLATE utf8_bin DEFAULT NULL,
  `PaginaComeFare` text COLLATE utf8_bin DEFAULT NULL,
  `PaginaCosaServe` text COLLATE utf8_bin DEFAULT NULL,
  `PaginaCosaOttiene` text COLLATE utf8_bin DEFAULT NULL,
  `PaginaTempiScadenze` text COLLATE utf8_bin DEFAULT NULL,
  `PaginaAccediServizio` text COLLATE utf8_bin DEFAULT NULL,
  `PaginaContatti` text COLLATE utf8_bin DEFAULT NULL,
  `PaginaCategoriaServizio` text COLLATE utf8_bin DEFAULT NULL,
  `PaginaUrlAssistenza` text COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


INSERT INTO `servizi` (`id`, `NomeServizio`, `NomeUfficio`, `NomeArea`, `NomeMacroArea`, `DescrizioneServizio`, `LinkServizio`, `PrefissoServizio`, `Attivo`, `PaginaChiRivolto`, `PaginaDescrizione`, `PaginaComeFare`, `PaginaCosaServe`, `PaginaCosaOttiene`, `PaginaTempiScadenze`, `PaginaAccediServizio`, `PaginaContatti`, `PaginaCategoriaServizio`, `PaginaUrlAssistenza`) VALUES
(1, 'Richiedere permesso di Parcheggio per residenti', 'Urbanistica ed edilizia', 'Parcheggi', 'Permessi e Autorizzazioni', 'Servizio relativo al rilascio di un\'autorizzazione per posteggiare nelle aree di Parcheggio pubblico a pagamento.', 'parcheggio_residenti', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Richiedere permesso di accesso ad area ZTL', 'Polizia municipale', 'Traffico', 'Permessi e Autorizzazioni', 'Servizio di richiesta di Autorizzazioni in deroga a divieti di circolazione.', 'ztl', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Richiedere permesso per Parcheggio invalidi', 'Polizia municipale', 'Autorizzazioni', 'Permessi e Autorizzazioni', 'Servizio di autorizzazione a fruire dei Parcheggi per gli invalidi tramite rilascio di contrassegno in favore dei soggetti diversamente abili, in materia di circolazione stradale.', 'parcheggio_invalidi', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Richiedere permesso per passo carrabile', 'Polizia municipale', 'Autorizzazioni', 'Permessi e Autorizzazioni', 'Servizio di richiesta di autorizzazione a imporre il divieto di Parcheggio presso l\'ingresso della propria abitazione.', 'passo_carrabile', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Richiedere una pubblicazione di matrimonio', 'Demografici elettorali e statistici', 'Stato civile', 'Permessi e Autorizzazioni', 'Servizio per la richiesta di autorizzazione previa celebrazione dei matrimoni civili.', 'pubblicazione_matrimonio', 'pm_', 1, 'Cittadini italiani, comunitari o stranieri, maggiorenni, di stato libero, senza vincoli di parentela, affinità, adozione, affiliazione secondo i gradi previsti dalle norme del Codice Civile.', 'La pubblicazione accerta l\'insussistenza degli impedimenti alla celebrazione del matrimonio e viene pubblicata online sull’Albo Pretorio comunale per dare \"pubblicità\" dell\'intenzione dei nubendi.', 'È opportuno scegliere, come giorno per le pubblicazioni matrimonio, <b>una data che sia minimo 2 e massimo 6 mesi prima del giorno previsto per la cerimonia</b>, perché le pubblicazioni hanno una validità legale di 180 giorni.', '<ul><li>Dati anagrafici (nome, cognome, codice fiscale, data di nascita, luogo di nascita, stato di nascita, residenza);</li><li>Stato Civile;</li><li>Atto di nascita di entrambi gli sposi;</li><li>Contatto telefonico ed email;</li></ul>\n', 'Si ottiene il verbale di Pubblicazione di Matrimonio richiesto.', '60 giorni (in media) per l\'affissione delle pubblicazioni, decorrenti dalla firma del verbale di richiesta.', '<p class=\"pagina-title\">Stato Civile</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<ul><li>035 4397063</li><li>amministrazione@pec.proximalab.it</li></ul>', '<p class=\"pagina-title\">Stato Civile</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<ul><li>035 4397063</li><li>amministrazione@pec.proximalab.it</li></ul>', 'Anagrafe e stato civile', NULL),
(6, 'Richiedere l\'accesso agli atti', 'Certificati e documenti', 'Accesso agli documenti accesso civico', 'Permessi e Autorizzazioni', 'Servizio per esercitare il proprio diritto a richiedere, prendere visione ed, eventualmente, ottenere copia dei documenti amministrativi.', 'accesso_atti', 'aa_', 1, 'È possibile accedere alla documentazione contenuta nelle pratiche edilizie qualora il richiedente abbia un titolo idoneo (proprietario) o nei casi previsti dalla legge (tutela di un interesse privato)', '', 'È possibile presentare la domanda secondo due differenti modalità:<br>\n<ul><li>Telematica, mediante sportello telematico</li><li>Cartacea, consegnando la domanda e gli allegati all\'Ufficio protocollo</li></ul>', 'Allegati obbligatori:<br>\n<ul><li>pagamento dei diritti di segreteria - mediante bonifico bancario presso la Tesoreria Comunale - specificare la causale “Diritti di ricerca e visura - nominativo richiedente” oppure direttamente allo sportello Area Gestione del Territorio prima del deposito dell\'istanza;</li><li>copia documento d\'identità del richiedente;</li><li>atto di proprietà dell’immobile;</li></ul>\n', 'Visione e rilascio della documentazione relativa alle pratiche e procedimenti di competenza', 'Il richiedente interessato verrà contattato entro trenta giorni decorrenti dalla presentazione dell\'istanza, per fissare un appuntamento presso gli uffici per la visione e l\'individuazione degli atti. In funzione dei documenti richiesti verranno quantificati i costi di riproduzione e si definiranno le modalità di ritiro delle copie richieste.', '<p class=\"pagina-title\">Edilizia Privata</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<ul><li>035 4397063</li><li>amministrazione@pec.proximalab.it</li></ul>', '<p class=\"pagina-title\">Edilizia Privata</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<ul><li>035 4397063</li><li>amministrazione@pec.proximalab.it</li></ul>', 'Catasto e urbanistica', NULL),
(7, 'Richiedere permesso di occupazione suolo pubblico', 'Commercio e attività produttive', 'Mercati', 'Permessi e Autorizzazioni', 'Servizio per richiedere la concessione a fruire degli spazi comunali.', 'occupazione_suolo', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Richiedere agevolazioni scolastiche', 'Servizi socio-assistenziali e sanitari', 'Sociale – assistenza scolastica', 'Vantaggi economici', 'Servizio per la fruizione di agevolazioni in ambito scolastico.', 'agevolazioni_scolastiche', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Presentare domanda per assegno di maternità', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Servizio per la fruizione di contributo economico concesso alle madri non occupate o non aventi diritto al trattamento di maternità, per nascite, adozioni e affidamenti preadottivi.', 'assegno_maternita', 'am_', 1, 'Il diritto all\'assegno, nei casi di parto, adozione o affidamento preadottivo, spetta alle madri, purché in possesso dei seguenti requisiti:<br>\n<ul><li>essere cittadina italiana, comunitaria o in possesso di carta di soggiorno, ovvero permesso di soggiorno illimitato, e risiedere nel territorio nazionale;</li><li>risorse economiche del nucleo familiare non superiori a determinati limiti ISEE stabiliti dalla legge che variano annualmente.</li><li>non percepire alcuna indennità di maternità previdenziale ovvero percepire un’indennità inferiore all\'importo mensile dell\'assegno; In particolare le madri non devono essere già beneficiarie dell’assegno di maternità dello Stato (ai sensi della legge 23 dicembre 1999, n. 488).</li></ul>\n', NULL, 'Per la presentazione della domanda è necessario che la madre si presenti su appuntamento in Comune per la compilazione della domanda.', 'La richiedente deve essere in possesso di documento di soggiorno (se extracomunitaria), ISEE in corso di validità (completo con i dati del neonato) e IBAN del proprio conto corrente.', 'L\'importo dell\'assegno è rivalutato ogni anno per le famiglie di operai e impiegati sulla base della variazione dell\'indice dei prezzi al consumo ISTAT. L\'INPS pubblica ogni anno apposita circolare con gli importi dell’assegno e dei limiti ISEE.', 'La domanda deve essere presentata entro sei mesi dalla nascita del bambino o dall\'effettivo ingresso in famiglia del minore adottato o in affido preadottivo. I tempi di istruttoria dell’INPS sono pari a 30gg dal caricamento della domanda da parte del Comune di residenza.', '<p class=\"pagina-title\">Servizi Sociali</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<ul><li>035 4397063</li><li>amministrazione@pec.proximalab.it</li></ul>', '<p class=\"pagina-title\">Servizi Sociali</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<ul><li>035 4397063</li><li>amministrazione@pec.proximalab.it</li></ul>', 'Salute benessere e assistenza', NULL),
(10, 'Presentare domanda per bonus economici', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Sovvenzioni erogate per consentire il risparmio sulla spesa per specifici servizi e/o beni, riservato ai cittadini che abbiano i requisiti stabiliti per accedere alla fruizione del vantaggio.', 'bonus_economici', 'be_', 1, 'Riservato ai cittadini che abbiano i requisiti stabiliti per accedere alla fruizione del vantaggio.', 'Il servizio Domanda per bonus economici, permette la richiesta di Bonus alla Pubblica Amministrazione.<br>Il Bonus può essere scelto tra quelli attivi durante la fase di completamento della domanda.<br>Si riceverà conferma via email dopo l\'invio della pratica.', '<ul><li>Accedere al servizio digitale</li><li>Compilare i campi richiesti</li><li>Caricare la documentazione</li><li>In seguito del completamento della domanda, si riceverà una email di conferma.</li></ul>\n', '<ul><li>Isee;</li><li>Documentazione utile al riconoscimento del Bonus;</li><li>Eventuale documentazione potere di firma se la richiesta non è eseguita dal diretto interessato;</li></ul>\n', 'L\'erogazione del bonus economico selezionato in fase di presentazione della domanda.', 'La scadenza è univoca per ogni Bonus. La data di scadenza è indicata nella compilazione della domanda.', '<p class=\"pagina-title\">Servizi Sociali</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<ul><li>035 4397063</li><li>amministrazione@pec.proximalab.it</li></ul>', '<p class=\"pagina-title\">Servizi Sociali</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<p>035 4397063</p><p>amministrazione@pec.proximalab.it</p><p>Responsabile: Rossi dot. Mario</p>\n', 'Tributi e finanze', NULL),
(11, 'Presentare domanda per un contributo', 'Servizi socio-assistenziali e sanitari', 'Sociale – sostegno economico', 'Vantaggi economici', 'Servizio per la richiesta di sostegno nell\'affrontare le spese relative  all\'assistenza per un familiare non autosufficiente.', 'domanda_contributo', 'dc_', 1, 'Persone e i nuclei familiari residenti o temporaneamente domiciliati o itineranti secondo la normativa vigente.<br>Stranieri, i profughi, gli apolidi temporaneamente domiciliati, purché abbiano regolarizzato o che abbiano presentato domanda per regolarizzare la propria posizione rispetto alle norme che disciplinano il soggiorno e la permanenza di persone prive di cittadinanza italiana.', '<p>Il beneficio economico è finalizzato ad un sostegno alle difficoltà del cittadino per un periodo temporaneo e non continuativo.</p>\n<p>Sono ammessi i seguenti interventi:<br>\na)    contributo economico ordinario: erogato limitatamente al tempo in cui permane lo stato di bisogno e finalizzato a garantire il minimo soddisfacimento dei bisogni primari, ricercando contestualmente, ove possibile, altre forme di intervento atte a rimuovere la situazione di disagio. In linea generale il contributo non potrà essere erogato per quegli interventi per i quali lo Stato, la Regione o altri Enti corrispondano altre forme di agevolazione;<br>\nb)    contributo economico straordinario: erogato per situazioni eccezionali e straordinarie, atto a risolvere problematiche contingenti.<br>\nc)    corresponsione di titoli: riconosciuto in forma di buoni spesa, di assegnazione di materiali e di strumenti, di concessione in uso temporaneo gratuito o oneroso di materiali o beni da utilizzarsi in base agli accordi presi con il servizio sociale;<br>\nd)    esenzioni da tariffe o tributi gestiti dall’Amministrazione Comunale: consistente nella riduzione di costi, rette o oneri per usufruire di servizi.<br>\ne)    prestito: consistente in una anticipazione economica recuperabile in base ad uno specifico e formale impegno del beneficiario, erogato a coloro che sono in attesa di trattamenti pensionistici o assistenziali o coloro che debbano sostenere spese onerose e improrogabili debitamente documentate.</p>', 'La domanda va presentata al Comune – Ufficio Servizi Sociali tramite apposto MODULO\nIn caso di soggetti impossibilitati o incapaci a presentare la domanda, l’Assistente Sociale del Comune può provvedere d’ufficio alla presentazione della domanda per l’erogazione del contributo, anche su segnalazione di enti, privati e organizzazioni del volontariato', 'Compilare la domanda, tramite apposito modulo, corredata dalla dichiarazione sostitutiva resa ai sensi del Regolamento per l’applicazione dei criteri unificati di valutazione della situazione economica (ISEE).<br>\nEventuale altra documentazione necessaria all\'istruzione della pratica, se indicata dal servizio sociale.', 'L’Assistente Sociale del Comune effettua le necessarie verifiche al fine di raggiungere un buon grado di conoscenza della situazione del richiedente, ivi compreso il contatto con altri enti o associazioni impegnate nel sociale sul territorio. \nAl termine di esse l’Assistente Sociale:<br>\n<ul><li>elabora un progetto di intervento che comprenda ogni strategia, ivi compresa la determinazione dell’entità del contributo economico, atta a rimuovere le condizioni che hanno determinato lo stato di bisogno;</li><li>consegna al Responsabile del Settore Servizi alla Persona la proposta di intervento;</li><li>effettua interventi di monitoraggio della situazione.</li></ul>\nErogazione del contributo<br>Il Responsabile del Settore Servizi alla Persona, avuta la proposta di intervento dall’Assistente Sociale, determina con atto formale la modalità e l’entità del contributo.', 'La domanda può essere presentata in qualsiasi momento dell’anno. ', '<p class=\"pagina-title\">Servizi Sociali</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<p>035 4397063</p>', '<p class=\"pagina-title\">Servizi Sociali</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<p>035 4397063</p><p>amministrazione@pec.proximalab.it</p><p>Responsabile: Rossi dot. Mario</p>', 'Salute benessere e assistenza', NULL),
(12, 'Presentare domanda di agevolazione tributaria', 'Servizi socio-assistenziali e sanitari', 'Sociale – agevolazioni tributarie', 'Vantaggi economici', 'Procedimento diretto al riconoscimento delle detrazioni d\'imposta spettanti al cittadino, per la fruizione di agevolazioni e/o esenzioni tributarie o tariffarie.', 'agevolazione_tributaria', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Richiedere assegnazione alloggio', 'Servizi socio-assistenziali e sanitari', 'Sociale - edilizia', 'Domande con graduatoria', 'Servizio per richiedere l\'assegnazione di alloggi.', 'assegnazione_alloggio', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Richiedere iscrizione alla scuola dell’infanzia', 'Istruzione, formazione e sport', 'Asili nido', 'Domande con graduatoria', 'Servizio per fruire di strutture per l\'infanzia gestite a livello comunale.', 'iscrizione_scuola_infanzia', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Richiedere iscrizione all\'asilo nido', 'Istruzione, formazione e sport', 'Asili nido', 'Domande con graduatoria', 'Servizio per richiedere l’ammissione alla frequenza dell’asilo nido comunale, per i bambini di età compresa da 0 a 3 anni.', 'iscrizione_nido', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Presentare domanda di partecipazione a un concorso pubblico', 'Gare e appalti', 'Gare e appalti', 'Domande con graduatoria', 'Servizio per l\'iscrizione a concorsi per trovare impiego presso la Pubblica Amministrazione.', 'partecipazione_concorso', 'pc_', 1, 'A tutti i cittadini italiani o europei che conoscano la lingua italiana.', 'Il servizio Domanda di partecipazione a un concorso pubblico, permette l\'iscrizione a concorsi per trovare impiego presso la Pubblica Amministrazione.<br>Il concorso può essere scelto tra quelli attivi durante la fase di completamento della domanda.<br>Si riceverà conferma via email dopo l\'invio della pratica.', '<ul><li>Accedere al servizio digitale</li><li>Compilare i campi richiesti</li><li>Caricare la documentazione</li><li>A seguito di completamento della domanda, si riceverà una conferma email.</li></ul>\n', '<ul><li>Copia carta identità</li><li>Curriculum Vitae</li><li>Eventuali titoli di precedenza o preferenza</li></ul>\n', 'L\'iscrizione al concorso selezione in fase di presentazione della domanda.', 'La scadenza è univoca per ogni Concorso. La data di scadenza è indicata nella compilazione della domanda.', '<p class=\"pagina-title\">Segreteria</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<p>035 4397063</p>', '<p class=\"pagina-title\">Segreteria</p><p>Comune di Proxima, Via Santa Maria, 13 - 24030 Carvico BG, Italia</p>\n<p>035 4397063</p>', 'Vita lavorativa', NULL),
(17, 'Richiedere iscrizione al trasporto scolastico', 'Istruzione, formazione e sport', 'Servizi scolastici', 'Servizi a pagamento', 'Servizio per la fruizione del trasporto scolastico.', 'iscrizione_trasporto_scolastico', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Richiedere iscrizione alla mensa scolastica', 'Istruzione, formazione e sport', 'Servizi scolastici', 'Servizi a pagamento', 'Servizio per la fruizione delle mense scolastiche.', 'iscrizione_mensa_scolastica', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Richiedere la sepoltura di un defunto', 'Certificati e documenti', 'Demografici - Cimiteri', 'Servizi a pagamento', 'Servizio per la fruizione dei campi comuni cimiteriali per i propri defunti congiunti.', 'sepoltura', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Pagare tributi IMU', 'Tributi e pagamenti', 'Tributi maggiori', 'Pagamenti dovuti', 'Servizio di pagamento relativo all\'adempimento delle obbligazioni tributarie relative alle rendite catastali.', 'pagamento_imu', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Pagare canone CIMP', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per la diffusione o l\'esposizione di messaggi pubblicitari nel territorio comunale.', 'pagamento_cimp', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Pagare canone COSAP', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per l\'occupazione permanente o temporanea del suolo pubblico.', 'pagamento_cosap', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Pagare canone idrico', 'Tributi e pagamenti', 'Canoni', 'Pagamenti dovuti', 'Servizio di pagamento del canone per la fornitura di acqua potabile.', 'pagamento_canone_idrico', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Pagare contravvenzioni', 'Polizia municipale', 'Multe e verbali', 'Pagamenti dovuti', 'Servizio di pagamento di sanzioni dovute a violazioni di regolamenti e normative specifiche.', 'pagamento_contravvenzioni', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Pagare il canone per le lampade votive', 'Certificati e documenti', 'Demografici - Cimiteri', 'Pagamenti dovuti', 'Servizio per il pagamento delle spese cimiteriali.', 'pagamento_lampade_votive', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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

ALTER TABLE `config_settings`
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

ALTER TABLE `rating`
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

ALTER TABLE `config_settings`
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

ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `servizi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `tipo_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `uffici`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
