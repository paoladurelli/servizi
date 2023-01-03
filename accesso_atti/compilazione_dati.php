<?php 
    /* file di inclusione */
    $configData = require '../env/config_servizi.php';
    $configDB = require '../env/config.php';
    include '../fun/utility.php';

    /* pagina iniziale */
    session_start();

    include '../template/head_servizi.php';
    include '../template/header_servizi.php';
    
    /* settare le variabili */
    $aa_bozza_id = "";
    $cf = "";
    $UfficioDestinatarioId = 0;
    $nome = "";
    $cognome = "";
    $email = "";
    $datanascita = "";
    $luogonascita = "";
    $richiedenteVia = "";
    $richiedenteLocalita = "";
    $richiedenteProvincia = "";
    $richiedenteTel = "";
    $pgRuolo = "";
    $pgDenominazione = "";
    $pgTipologia = "";
    $pgSedeLegaleIndirizzo = "";
    $pgSedeLegaleLocalita = "";
    $pgSedeLegaleProvincia = "";
    $pgSedeLegaleCap = "";
    $pgCf = "";
    $pgPiva = "";
    $pgTelefono = "";
    $pgEmail = "";
    $pgPec = "";
    $richiedenteTitolo = "";
    $richiedenteProfessionistaIncaricatoDa = "";
    $richiedenteProfessionistaIncaricatoDaNome = "";
    $richiedenteProfessionistaIncaricatoDaCognome = "";
    $richiedenteProfessionistaIncaricatoDaCf = "";
    $richiedenteProfessionistaIncaricatoDaAltroSoggetto = "";
    $richiedenteProfessionistaIncaricatoDaDescrizioneTitolo = "";
    $richiestaTipo = "";
    $richiestaAtti = "";
    $richiestaAttiTipoDocumento = "";
    $richiestaAttiProtocollo = "";
    $richiestaAttiData = "";
    $collocazioneTerritorialeCodiceCatastale = "";
    $collocazioneTerritorialeSezione = "";
    $collocazioneTerritorialeFoglio = "";
    $collocazioneTerritorialeParticella = "";
    $collocazioneTerritorialeSubalterno = "";
    $collocazioneTerritorialeCategoria = "";
    $collocazioneTerritorialeIndirizzo = "";
    $collocazioneTerritorialeLocalita = "";
    $collocazioneTerritorialeProvincia = "";
    $motivo = "";
    $motivoAltro = "";
    $modoRitiro = "";
    $modoRitiroPostaIndirizzo = "";
    $modoRitiroPostaLocalita = "";
    $modoRitiroPostaProvincia = "";
    $modoRitiroPostaCap = "";
    $annotazioni = "";
    $uploadAffittuario = "";
    $uploadAffittuarioSaved = "";
    $uploadAltroSoggetto = "";
    $uploadAltroSoggettoSaved = "";
    $uploadNotaioRogante = "";
    $uploadNotaioRoganteSaved = "";
    $uploadAltriTitoloDescrizione = "";
    $uploadAltriTitoloDescrizioneSaved = "";
    $uploadCartaIdentitaFronte = "";
    $uploadCartaIdentitaFronteSaved = "";
    $uploadCartaIdentitaRetro = "";
    $uploadCartaIdentitaRetroSaved = "";
    $uploadAttoNotarile = "";
    $uploadAttoNotarileSaved = "";
    
    /* se mi viene passato l'id della bozza, vado a richiamare i dati salvati */
    if(isset($_GET["aa_bozza_id"]) && $_GET["aa_bozza_id"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM accesso_atti WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $_GET["aa_bozza_id"];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $aa_bozza_id = $_GET["aa_bozza_id"];
                $cf = $row["richiedenteCf"];
                $UfficioDestinatarioId = $row["UfficioDestinatarioId"];
                $nome = $row["richiedenteNome"];
                $cognome = $row["richiedenteCognome"];
                $email = $row["richiedenteEmail"];
                $datanascita = $row["richiedenteDataNascita"];
                $luogonascita = $row["richiedenteLuogoNascita"];
                $richiedenteVia = $row["richiedenteVia"];
                $richiedenteLocalita = $row["richiedenteLocalita"];
                $richiedenteProvincia = $row["richiedenteProvincia"];
                $richiedenteTel = $row["richiedenteTel"];
                $pgRuolo = $row["pgRuolo"];
                $pgDenominazione = $row["pgDenominazione"];
                $pgTipologia = $row["pgTipologia"];
                $pgSedeLegaleIndirizzo = $row["pgSedeLegaleIndirizzo"];
                $pgSedeLegaleLocalita = $row["pgSedeLegaleLocalita"];
                $pgSedeLegaleProvincia = $row["pgSedeLegaleProvincia"];
                $pgSedeLegaleCap = $row["pgSedeLegaleCap"];
                $pgCf = $row["pgCf"];
                $pgPiva = $row["pgPiva"];
                $pgTelefono = $row["pgTelefono"];
                $pgEmail = $row["pgEmail"];
                $pgPec = $row["pgPec"];
                $richiedenteTitolo = $row["richiedenteTitolo"];
                $richiedenteProfessionistaIncaricatoDa = $row["richiedenteProfessionistaIncaricatoDa"];
                $richiedenteProfessionistaIncaricatoDaNome = $row["richiedenteProfessionistaIncaricatoDaNome"];
                $richiedenteProfessionistaIncaricatoDaCognome = $row["richiedenteProfessionistaIncaricatoDaCognome"];
                $richiedenteProfessionistaIncaricatoDaCf = $row["richiedenteProfessionistaIncaricatoDaCf"];
                $richiedenteProfessionistaIncaricatoDaAltroSoggetto = $row["richiedenteProfessionistaIncaricatoDaAltroSoggetto"];
                $richiedenteProfessionistaIncaricatoDaDescrizioneTitolo = $row["richiedenteProfessionistaIncaricatoDaDescrizioneTitolo"];
                $richiestaTipo = $row["richiestaTipo"];
                $richiestaAtti = $row["richiestaAtti"];
                $richiestaAttiTipoDocumento = $row["richiestaAttiTipoDocumento"];
                $richiestaAttiProtocollo = $row["richiestaAttiProtocollo"];
                $richiestaAttiData = $row["richiestaAttiData"];
                $collocazioneTerritorialeCodiceCatastale = $row["collocazioneTerritorialeCodiceCatastale"];
                $collocazioneTerritorialeSezione = $row["collocazioneTerritorialeSezione"];
                $collocazioneTerritorialeFoglio = $row["collocazioneTerritorialeFoglio"];
                $collocazioneTerritorialeParticella = $row["collocazioneTerritorialeParticella"];
                $collocazioneTerritorialeSubalterno = $row["collocazioneTerritorialeSubalterno"];
                $collocazioneTerritorialeCategoria = $row["collocazioneTerritorialeCategoria"];
                $collocazioneTerritorialeIndirizzo = $row["collocazioneTerritorialeIndirizzo"];
                $collocazioneTerritorialeLocalita = $row["collocazioneTerritorialeLocalita"];
                $collocazioneTerritorialeProvincia = $row["collocazioneTerritorialeProvincia"];
                $motivo = $row["motivo"];
                $motivoAltro = $row["motivoAltro"];
                $modoRitiro = $row["modoRitiro"];
                $modoRitiroPostaIndirizzo = $row["modoRitiroPostaIndirizzo"];
                $modoRitiroPostaLocalita = $row["modoRitiroPostaLocalita"];
                $modoRitiroPostaProvincia = $row["modoRitiroPostaProvincia"];
                $modoRitiroPostaCap = $row["modoRitiroPostaCap"];
                $annotazioni = $row["annotazioni"];

                if($row["uploadAffittuario"] != ''){
                    $uploadAffittuario = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadAffittuario"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadAffittuarioSaved = $row["uploadAffittuario"];
                }
                if($row["uploadAltroSoggetto"] != ''){
                    $uploadAltroSoggetto = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadAltroSoggetto"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadAltroSoggettoSaved = $row["uploadAltroSoggetto"];
                }
                if($row["uploadNotaioRogante"] != ''){
                    $uploadNotaioRogante = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadNotaioRogante"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadNotaioRoganteSaved = $row["uploadNotaioRogante"];
                }
                if($row["uploadAltriTitoloDescrizione"] != ''){
                    $uploadAltriTitoloDescrizione = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadAltriTitoloDescrizione"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadAltriTitoloDescrizioneSaved = $row["uploadAltriTitoloDescrizione"];
                }
                if($row["uploadCartaIdentitaFronte"] != ''){
                    $uploadCartaIdentitaFronte = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaFronte"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadCartaIdentitaFronteSaved = $row["uploadCartaIdentitaFronte"];
                }
                if($row["uploadCartaIdentitaRetro"] != ''){
                    $uploadCartaIdentitaRetro = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaRetro"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadCartaIdentitaRetroSaved = $row["uploadCartaIdentitaRetro"];
                }
                if($row["uploadAttoNotarile"] != ''){
                    $uploadAttoNotarile = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadAttoNotarile"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadAttoNotarileSaved = $row["uploadAttoNotarile"];
                }
            }
        }
        $connessione->close();
     }else{
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessioneAn = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM anagrafica WHERE CodiceFiscale = '". $_SESSION['CF']."'";
        $resultAn = $connessioneAn->query($sql);

        if ($resultAn->num_rows > 0) {
        // output data of each row
            while($row = $resultAn->fetch_assoc()) {
                $cf = $row["CodiceFiscale"];
                $nome = $row["Nome"];
                $cognome = $row["Cognome"];
                $email = $row["Email"];
                $datanascita = $row["DataNascita"];
                $luogonascita = $row["LuogoNascita"];
                $richiedenteLocalita = $configData['nome_comune'];
                $richiedenteProvincia = $configData['provincia_estesa_comune'];
            }
        }
        $connessioneAn->close();
        /* DATI ESTRAPOLATI DA DB - end */
        /* il resto rimane vuoto */
    }
?>
    <main>
        <div class="container" id="main-container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="cmp-breadcrumbs" role="navigation">
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb p-0" data-element="breadcrumb">
                                <li class="breadcrumb-item"><a href="../bacheca.php">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page"><span class="separator">/</span><a href="../servizi_list.php">Servizi</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Richiedere l'accesso agli atti</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge">Richiedere l'accesso agli atti</h1>
                        <p class="subtitle-small">Servizio per esercitare il proprio diritto a richiedere, prendere visione ed, eventualmente, ottenere copia dei documenti amministrativi.</p>
                        <p style="display: inline;">Hai bisogno di assistenza?</p>
                        <form action="<?php echo $configData['url_comune']; ?>/richiesta-assistenza" method="post" id="frmRichiestaAssistenza" style="display: inline;">
                            <input type="hidden" name="id_assistenza" value="">
                            <input type="hidden" name="categoria" value="Salute, benessere e assistenza">
                            <input type="hidden" name="servizio" value="Contributi economici a persone in stato di bisogno">
                            <input type="hidden" name="descrizione" value="">
                            <a href="javascript:void()" onclick="document.getElementById('frmRichiestaAssistenza').submit();" class="btn btn-primary" style="margin-left: 10px;margin-top: -5px;">Contattaci</a>
                        </form>
                    </div>
                </div>
                <?php echo ViewMenuPratiche(2); ?>
            </div>
            <form action="#" id="aa_frm_dati" method="post" enctype="multipart/form-data">
                <input type="hidden" id="aa_bozza_id" name="aa_bozza_id" value="<?php echo $aa_bozza_id; ?>"/>
                <div class="it-page-sections-container">
                    <div class="row">
                        <div class="col-12 col-lg-3 d-lg-block mb-4 d-none">
                            <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                                <nav class="navbar it-navscroll-wrapper navbar-expand-lg" data-bs-navscroll>
                                    <div class="navbar-custom" id="navbarNavProgress">
                                        <div class="menu-wrapper">
                                            <div class="link-list-wrapper">
                                                <div class="accordion">
                                                    <div class="accordion-item">
                                                        <span class="accordion-header" id="accordion-title-one">
                                                            <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                                                INDICE DI PAGINA
                                                            </button>
                                                        </span>
                                                        <div class="progress">
                                                            <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                                            <div class="accordion-body">
                                                                <ul class="link-list" data-element="page-index">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#aa_ufficio">
                                                                            <span class="title-medium">Ufficio destinatario</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#aa_richiedente">
                                                                            <span class="title-medium">Richiedente</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#aa_richiesta">
                                                                            <span class="title-medium">Richiesta</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#aa_allegati">
                                                                            <span class="title-medium">Allegati</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </nav>
                            </div>
                        </div>

                        <div class="col-12 col-lg-9 body-compilazione-dati">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="aa_frm_dati_pnl_return"></div>
                                </div>
                            </div>
                            
                            <div class="it-page-section  mb-30" id="aa_ufficio">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Ufficio</h2>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p id="aa_UfficioDestinatarioId_txt">Ufficio destinatario *</p>
                                                    <p>
                                                        <select id="aa_UfficioDestinatarioId" name="aa_UfficioDestinatarioId">
                                                            <option value="">Seleziona Ufficio</option>
                                                            <?php echo LoadSelectUfficioDestinatario($UfficioDestinatarioId); ?>
                                                        </select>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="it-page-section mb-30" id="aa_richiedente">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div>
                                                <h2 class="title-xxlarge mb-3">Richiedente</h2>
                                                <p><b>Informazioni su di te</b></p>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h5><b><?php echo $_SESSION['Nome'] . ' ' . $_SESSION['Cognome']; ?></b></h5>
                                            <p class="subtitle-small">Codice Fiscale:<br/><b><?php echo $_SESSION['CF']; ?></b></p>
                                            <div class="row">
                                                <div class="col-lg-12"><h5 class="color-primary"><b>Anagrafica</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiedente_nome_txt">Nome *<br/><input type="text" id="aa_richiedente_nome" name="aa_richiedente_nome" value="<?php echo $nome; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiedente_cognome_txt">Cognome *<br/><input type="text" id="aa_richiedente_cognome" name="aa_richiedente_cognome" value="<?php echo $cognome; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiedente_cf_txt">Codice Fiscale *<br/><input type="text" id="aa_richiedente_cf" name="aa_richiedente_cf" value="<?php echo $cf; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiedente_data_nascita_txt">Data di Nascita *<br/><input type="date" id="aa_richiedente_data_nascita" name="aa_richiedente_data_nascita" value="<?php echo $datanascita; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiedente_luogo_nascita_txt">Luogo di Nascita *<br/><input type="text" id="aa_richiedente_luogo_nascita" name="aa_richiedente_luogo_nascita" value="<?php echo $luogonascita; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiedente_via_txt">Via e Numero civico *<br/><input type="text" id="aa_richiedente_via" name="aa_richiedente_via" value="<?php echo $richiedenteVia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiedente_localita_txt">Località *<br/><input type="text" id="aa_richiedente_localita" name="aa_richiedente_localita" value="<?php echo $richiedenteLocalita; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiedente_provincia_txt">Provincia *<br/><input type="text" id="aa_richiedente_provincia" name="aa_richiedente_provincia" value="<?php echo $richiedenteProvincia; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiedente_email_txt">E-mail *<br/><input type="email" id="aa_richiedente_email" name="aa_richiedente_email" value="<?php echo $email; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiedente_tel_txt">Telefono *<br/><input type="tel" id="aa_richiedente_tel" name="aa_richiedente_tel" value="<?php echo $richiedenteTel; ?>" /></p></div>
                                            </div>
                                        </div>
                                        <div class="card-header border-0 p-0 mb-lg-30 mt-3">
                                            <div class="row">
                                                <div class="col-lg-12"><p><b>Se il richiedente non è una persona fisica, compilare anche il form sottostante</b></p></div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgRuolo_txt">In qualità di<br/><input type="text" id="aa_pgRuolo" name="aa_pgRuolo" value="<?php echo $pgRuolo; ?>" /></p></div>
                                            </div>                                            
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgDenominazione_txt">Denominazione/Ragione sociale<br/><input type="text" id="aa_pgDenominazione" name="aa_pgDenominazione" value="<?php echo $pgDenominazione; ?>" /></p></div>
                                            </div>                                            
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgTipologia_txt">Tipologia<br/><input type="text" id="aa_pgTipologia" name="aa_pgTipologia" value="<?php echo $pgTipologia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Sede legale</b></h5></div>
                                            </div>                                            
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgSedeLegaleIndirizzo_txt">Indirizzo<br/><input type="text" id="aa_pgSedeLegaleIndirizzo" name="aa_pgSedeLegaleIndirizzo" value="<?php echo $pgSedeLegaleIndirizzo; ?>" /></p></div>
                                            </div>                                            
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgSedeLegaleLocalita_txt">Comune<br/><input type="text" id="aa_pgSedeLegaleLocalita" name="aa_pgSedeLegaleLocalita" value="<?php echo $pgSedeLegaleLocalita; ?>" /></p></div>
                                            </div>                                            
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgSedeLegaleProvincia_txt">Provincia<br/><input type="text" id="aa_pgSedeLegaleProvincia" name="aa_pgSedeLegaleProvincia" value="<?php echo $pgSedeLegaleProvincia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgSedeLegaleCap_txt">Cap<br/><input type="text" id="aa_pgSedeLegaleCap" name="aa_pgSedeLegaleCap" value="<?php echo $pgSedeLegaleCap; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgCf_txt">Codice fiscale<br/><input type="text" id="aa_pgCf" name="aa_pgCf" value="<?php echo $pgCf; ?>" /></p></div>
                                            </div>                                            
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgPiva_txt">Partita IVA<br/><input type="text" id="aa_pgPiva" name="aa_pgPiva" value="<?php echo $pgPiva; ?>" /></p></div>
                                            </div>                                            
                                            <div class="row">
                                                <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgTelefono_txt">Telefono<br/><input type="tel" id="aa_pgTelefono" name="aa_pgTelefono" value="<?php echo $pgTelefono; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgEmail_txt">E-mail<br/><input type="email" id="aa_pgEmail" name="aa_pgEmail" value="<?php echo $pgEmail; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_pgPec_txt">Pec<br/><input type="tel" id="aa_pgPec" name="aa_pgPec" value="<?php echo $pgPec; ?>" /></p></div>
                                            </div>
                                        </div>
                                        <div class="card-header border-0 p-0 mt-3">
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiedenteTitolo_txt"><b>In qualità di *</b></p></div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_richiedenteTitolo" id="aa_richiedenteTitoloDI" value="DI" <?php  echo $richiedenteTitolo == "DI" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_richiedenteTitoloDI">Diretto interessato</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_richiedenteTitolo" id="aa_richiedenteTitoloPI" value="PI" <?php  echo $richiedenteTitolo == "PI" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_richiedenteTitoloPI">Proprietario dell'immobile oggetto del procedimento</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_richiedenteTitolo" id="aa_richiedenteTitoloAI" value="AI" <?php  echo $richiedenteTitolo == "AI" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_richiedenteTitoloAI">Affittuario dell'immobile oggetto del procedimento, pertanto si allegherà documentazione comprovante il titolo dichiarato</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_richiedenteTitolo" id="aa_richiedenteTitoloRI" value="RI" <?php  echo $richiedenteTitolo == "RI" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_richiedenteTitoloRI">Professionista incaricato</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="aa_opt_richiedenteTitoloRI">
                                                <div class="row">
                                                    <div class="col-lg-11 offset-lg-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="aa_richiedenteProfessionistaIncaricatoDa" id="aa_richiedenteProfessionistaIncaricatoDaTribunale" value="Tribunale" <?php  echo $richiedenteTitolo == "Tribunale" ? "checked" : ""; ?> />
                                                            <label class="form-check-label" for="aa_richiedenteProfessionistaIncaricatoDaTribunale">dal tribunale altro organo giudiziario</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-11 offset-lg-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="aa_richiedenteProfessionistaIncaricatoDa" id="aa_richiedenteProfessionistaIncaricatoDaProprietario" value="Proprietario" <?php  echo $richiedenteTitolo == "Proprietario" ? "checked" : ""; ?> />
                                                            <label class="form-check-label" for="aa_richiedenteProfessionistaIncaricatoDaProprietario">dal proprietario dell'immobile<br/>
                                                                <input type="text" id="aa_richiedenteProfessionistaIncaricatoDaNome" name="aa_richiedenteProfessionistaIncaricatoDaNome" value="<?php echo $richiedenteProfessionistaIncaricatoDaNome; ?>" placeholder="Nome" /><br/>
                                                                <input type="text" id="aa_richiedenteProfessionistaIncaricatoDaCognome" name="aa_richiedenteProfessionistaIncaricatoDaCognome" value="<?php echo $richiedenteProfessionistaIncaricatoDaCognome; ?>" placeholder="Cognome" /><br/>
                                                                <input type="text" id="aa_richiedenteProfessionistaIncaricatoDaCf" name="aa_richiedenteProfessionistaIncaricatoDaCf" value="<?php echo $richiedenteProfessionistaIncaricatoDaCf; ?>" placeholder="Codice Fiscale" />
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-11 offset-lg-1">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="aa_richiedenteProfessionistaIncaricatoDa" id="aa_richiedenteProfessionistaIncaricatoDaAltro" value="Altro" <?php  echo $richiedenteTitolo == "Altro" ? "checked" : ""; ?> />
                                                            <label class="form-check-label" for="aa_richiedenteProfessionistaIncaricatoDaAltro">da altro soggetto<br/>
                                                                <input type="text" id="aa_richiedenteProfessionistaIncaricatoDaAltroSoggetto" name="aa_richiedenteProfessionistaIncaricatoDaAltroSoggetto" value="<?php echo $richiedenteProfessionistaIncaricatoDaAltroSoggetto; ?>" placeholder="Altro Soggetto" />
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_richiedenteTitolo" id="aa_richiedenteTitoloNR" value="NR" <?php  echo $richiedenteTitolo == "NR" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_richiedenteTitoloNR">Notaio rogante, pertanto si allegherà documentazione comprovante il titolo dichiarato</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_richiedenteTitolo" id="aa_richiedenteTitoloAT" value="AT" <?php  echo $richiedenteTitolo == "AT" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_richiedenteTitoloAT">Altro titolo, pertanto si allegherà documentazione comprovante il titolo dichiarato<br/>
                                                            <input type="text" id="aa_richiedenteProfessionistaIncaricatoDaDescrizioneTitolo" name="aa_richiedenteProfessionistaIncaricatoDaDescrizioneTitolo" value="<?php echo $richiedenteProfessionistaIncaricatoDaDescrizioneTitolo; ?>" placeholder="(Descrizione titolo)" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="it-page-section mb-50 mb-lg-90" id="aa_richiesta">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Richiesta</h2>
                                            </div>
                                        </div>
                                        <div class="card-header border-0 p-0 mb-lg-30 mt-3">
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_richiestaTipo_txt"><b>Di esercitare il diritto di accesso agli atti attraverso la richiesta di *</b></p></div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_richiestaTipo" id="aa_richiestaTipoPresaVisione" value="PresaVisione" <?php  echo $richiestaTipo == "PresaVisione" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_richiestaTipoPresaVisione">Presa Visione</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_richiestaTipo" id="aa_richiestaTipoCopiaInformatizzata" value="CopiaInformatizzata" <?php  echo $richiestaTipo == "CopiaInformatizzata" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_richiestaTipoCopiaInformatizzata">Copia informatizzata</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_richiestaTipo" id="aa_richiestaTipoCopiaCartaSemplice" value="CopiaCartaSemplice" <?php  echo $richiestaTipo == "CopiaCartaSemplice" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_richiestaTipoCopiaCartaSemplice">Copia Carta Semplice</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_richiestaTipo" id="aa_richiestaTipoCopiaConformeOriginale" value="CopiaConformeOriginale" <?php  echo $richiestaTipo == "CopiaConformeOriginale" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_richiestaTipoCopiaConformeOriginale">Copia conforme all'originale</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_richiestaTipo" id="aa_richiestaTipoAltro" value="Altro" <?php  echo $richiestaTipo == "Altro" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_richiestaTipoAltro">Altro</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-5"><p id="aa_richiestaAtti_txt"><b>dei seguenti atti o documenti amministrativi *</b></p>
                                                    <textarea id="aa_richiestaAtti" name="aa_richiestaAtti" rows="4"><?php echo $richiestaAtti; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-5"><p id="aa_richiestaAtti_txt"><b>eventuali estremi identificativi degli atti o documenti:</b></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <input type="text" id="aa_richiestaAttiTipoDocumento" name="aa_richiestaAttiTipoDocumento" value="<?php echo $richiestaAttiTipoDocumento; ?>" placeholder="Tipo Documento" />
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="text" id="aa_richiestaAttiProtocollo" name="aa_richiestaAttiProtocollo" value="<?php echo $richiestaAttiProtocollo; ?>" placeholder="Protocollo" />
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input type="date" id="aa_richiestaAttiData" name="aa_richiestaAttiData" value="<?php echo $richiestaAttiData; ?>" placeholder="Data" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3"><p id="aa_richiestaAtti_txt"><b>eventuale collocazione territoriale:</b></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <p>Codice catastale<br>
                                                                <input type="text" id="aa_collocazioneTerritorialeCodiceCatastale" name="aa_collocazioneTerritorialeCodiceCatastale" value="<?php echo $collocazioneTerritorialeCodiceCatastale; ?>" /></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <p>Sezione<br>
                                                                <input type="text" id="aa_collocazioneTerritorialeSezione" name="aa_collocazioneTerritorialeSezione" value="<?php echo $collocazioneTerritorialeSezione; ?>" /></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <p>Foglio<br>
                                                                <input type="text" id="aa_collocazioneTerritorialeFoglio" name="aa_collocazioneTerritorialeFoglio" value="<?php echo $collocazioneTerritorialeFoglio; ?>" /></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <p>Particella<br>
                                                                <input type="text" id="aa_collocazioneTerritorialeParticella" name="aa_collocazioneTerritorialeParticella" value="<?php echo $collocazioneTerritorialeParticella; ?>" /></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <p>Subalterno<br>
                                                                <input type="text" id="aa_collocazioneTerritorialeSubalterno" name="aa_collocazioneTerritorialeSubalterno" value="<?php echo $collocazioneTerritorialeSubalterno; ?>" /></p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <p>Categoria<br>
                                                                <input type="text" id="aa_collocazioneTerritorialeCategoria" name="aa_collocazioneTerritorialeCategoria" value="<?php echo $collocazioneTerritorialeCategoria; ?>" /></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <p>Indirizzo<br>
                                                        <input type="text" id="aa_collocazioneTerritorialeIndirizzo" name="aa_collocazioneTerritorialeIndirizzo" value="<?php echo $collocazioneTerritorialeIndirizzo; ?>" /></p>
                                                </div>
                                                <div class="col-lg-12">
                                                    <p>Localita<br>
                                                        <input type="text" id="aa_collocazioneTerritorialeLocalita" name="aa_collocazioneTerritorialeLocalita" value="<?php echo $collocazioneTerritorialeLocalita; ?>" /></p>
                                                </div>
                                                <div class="col-lg-12">
                                                    <p>Provincia<br>
                                                        <input type="text" id="aa_collocazioneTerritorialeProvincia" name="aa_collocazioneTerritorialeProvincia" value="<?php echo $collocazioneTerritorialeProvincia; ?>" /></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header border-0 p-0 mb-lg-30 mt-3">
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_motivo_txt"><b>Di avere un interesse personale e concreto ovvero pubblico o diffuso all'accesso per la tutela di situazioni giuridicamente rilevanti per il seguente motivo *</b></div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_motivo" id="aa_motivoAttoNotarile" value="AttoNotarile" <?php  echo $motivo == "AttoNotarile" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_motivoAttoNotarile">Atto Notarile</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_motivo" id="aa_motivoControversia" value="Controversia" <?php  echo $motivo == "Controversia" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_motivoControversia">Controversia</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_motivo" id="aa_motivoDocumentazionePersonale" value="DocumentazionePersonale" <?php  echo $motivo == "DocumentazionePersonale" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_motivoDocumentazionePersonale">Documentazione Personale</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_motivo" id="aa_motivoMutuo" value="Mutuo" <?php  echo $motivo == "Mutuo" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_motivoMutuo">Mutuo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_motivo" id="aa_motivoPresentazioneProgettoEdilizio" value="PresentazioneProgettoEdilizio" <?php  echo $motivo == "PresentazioneProgettoEdilizio" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_motivoPresentazioneProgettoEdilizio">Presentazione Progetto Edilizio</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_motivo" id="aa_motivoPresuntaLesioneDiInteressi" value="PresuntaLesioneDiInteressi" <?php  echo $motivo == "PresuntaLesioneDiInteressi" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_motivoPresuntaLesioneDiInteressi">Presunta Lesione Di Interessi</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_motivo" id="aa_motivoVerificaConformitaEdilizia" value="VerificaConformitaEdilizia" <?php  echo $motivo == "VerificaConformitaEdilizia" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_motivoVerificaConformitaEdilizia">Verifica Conformità Edilizia</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_motivo" id="aa_motivoAltraMotivazione" value="AltraMotivazione" <?php  echo $motivo == "AltraMotivazione" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_motivoAltraMotivazione">Altra Motivazione<br>
                                                            <input type="text" id="aa_motivoAltro" name="aa_motivoAltro" value="<?php echo $motivoAltro; ?>" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header border-0 p-0 mb-lg-30 mt-3">
                                            <div class="row">
                                                <div class="col-lg-12"><p id="aa_modoRitiro_txt"><b>Modo ritiro *</b></div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_modoRitiro" id="aa_modoRitiroUfficio" value="Ufficio" <?php  echo $modoRitiro == "Ufficio" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_modoRitiroUfficio">di poterli ritirare presso l'ufficio competente</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_modoRitiro" id="aa_modoRitiroEmail" value="Email" <?php  echo $modoRitiro == "Email" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_modoRitiroEmail">di riceverli all'indirizzo e-mail sopra indicato</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_modoRitiro" id="aa_modoRitiroIndirizzoInserito" value="IndirizzoInserito" <?php  echo $modoRitiro == "IndirizzoInserito" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_modoRitiroIndirizzoInserito">di riceverli a mezzo posta all'indirizzo sopra indicato</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aa_modoRitiro" id="aa_modoRitiroAltroIndirizzo" value="AltroIndirizzo" <?php  echo $modoRitiro == "AltroIndirizzo" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="aa_modoRitiroAltroIndirizzo"><p>di riceverli a mezzo posta al seguente indirizzo</p>
                                                            <p>Indirizzo<br>
                                                                <input type="text" id="aa_modoRitiroPostaIndirizzo" name="aa_modoRitiroPostaIndirizzo" value="<?php echo $modoRitiroPostaIndirizzo; ?>" /></p>
                                                            <p>Località<br>
                                                                <input type="text" id="aa_modoRitiroPostaLocalita" name="aa_modoRitiroPostaLocalita" value="<?php echo $modoRitiroPostaLocalita; ?>" /></p>
                                                            <p>Provincia<br>
                                                                <input type="text" id="aa_modoRitiroPostaProvincia" name="aa_modoRitiroPostaProvincia" value="<?php echo $modoRitiroPostaProvincia; ?>" /></p>
                                                            <p>Cap<br>
                                                                <input type="text" id="aa_modoRitiroPostaCap" name="aa_modoRitiroPostaCap" value="<?php echo $modoRitiroPostaCap; ?>" /></p>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header border-0 p-0 mb-lg-30 mt-3">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p id="aa_annotazioni_txt"><b>Eventuali annotazioni:</b></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <textarea id="aa_annotazioni" name="aa_annotazioni" rows="4"><?php echo $annotazioni; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="it-page-section mb-30" id="aa_allegati">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Allegati</h2>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 after-section">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-sm-6 mb-3">
                                                            <h6 id="aa_uploadCartaIdentitaFronte_txt">Carta d'Identita Fronte *</h6>
                                                            <p class='text-xsmall'>Dimensione Massima: 500 Kb</p><p class='text-xsmall'>Estensioni accettate: 'jpeg', 'jpg', 'png', 'gif', 'pdf'</p>
                                                        </div>                                                    
                                                        <div class="col-lg-4 col-sm-6 text-right">
                                                            <input type="hidden" name="aa_uploadCartaIdentitaFronteSaved" id="aa_uploadCartaIdentitaFronteSaved" value="<?php echo $uploadCartaIdentitaFronteSaved; ?>" />
                                                            <input type="file" name="aa_uploadCartaIdentitaFronte" id="aa_uploadCartaIdentitaFronte" class="upload" value="" />
                                                            <label for="aa_uploadCartaIdentitaFronte">
                                                                <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                                <span>Upload</span>
                                                            </label>                                                            
                                                            <ul class="upload-file-list" id="aa_uploadCartaIdentitaFronte_file">
                                                                <?php echo $uploadCartaIdentitaFronte; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 after-section">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-sm-6 mb-3">
                                                            <h6 id="aa_uploadCartaIdentitaRetro_txt">Carta d'Identita Retro *</h6>
                                                            <p class='text-xsmall'>Dimensione Massima: 500 Kb</p><p class='text-xsmall'>Estensioni accettate: 'jpeg', 'jpg', 'png', 'gif', 'pdf'</p>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 text-right">
                                                            <input type="hidden" name="aa_uploadCartaIdentitaRetroSaved" id="aa_uploadCartaIdentitaRetroSaved" value="<?php echo $uploadCartaIdentitaRetroSaved; ?>" />
                                                            <input type="file" name="aa_uploadCartaIdentitaRetro" id="aa_uploadCartaIdentitaRetro" class="upload" value="<?php echo $uploadCartaIdentitaRetroSaved; ?>" />
                                                            <label for="aa_uploadCartaIdentitaRetro">
                                                                <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                                <span>Upload</span>
                                                            </label>
                                                            <ul class="upload-file-list" id="aa_uploadCartaIdentitaRetro_file">
                                                                <?php echo $uploadCartaIdentitaRetro; ?>
                                                            </ul>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 after-section" id="aa_pnl_uploadAffittuario">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-sm-6 mb-3">
                                                            <h6 id="aa_uploadAffittuario_txt">Documentazione comprovante il titolo dichiarato: Affittuario *</h6>
                                                            <p class='text-xsmall'>Dimensione Massima: 500 Kb</p><p class='text-xsmall'>Estensioni accettate: 'jpeg', 'jpg', 'png', 'gif', 'pdf'</p>
                                                        </div>                                                    
                                                        <div class="col-lg-4 col-sm-6 text-right">
                                                            <input type="hidden" name="aa_uploadAffittuarioSaved" id="aa_uploadAffittuarioSaved" value="<?php echo $uploadAffittuarioSaved; ?>" />
                                                            <input type="file" name="aa_uploadAffittuario" id="aa_uploadAffittuario" class="upload" value="<?php echo $uploadAffittuarioSaved; ?>" />
                                                            <label for="aa_uploadAffittuario">
                                                                <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                                <span>Upload</span>
                                                            </label>                                                            
                                                            <ul class="upload-file-list" id="aa_uploadAffittuario_file">
                                                                <?php echo $uploadAffittuario; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 after-section" id="aa_pnl_uploadAltroSoggetto">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-sm-6 mb-3">
                                                            <h6 id="aa_uploadAltroSoggetto_txt">Documentazione comprovante il titolo dichiarato: professionista incaricato da altro soggetto *</h6>
                                                            <p class='text-xsmall'>Dimensione Massima: 500 Kb</p><p class='text-xsmall'>Estensioni accettate: 'jpeg', 'jpg', 'png', 'gif', 'pdf'</p>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 text-right">
                                                            <input type="hidden" name="aa_uploadAltroSoggettoSaved" id="aa_uploadAltroSoggettoSaved" value="<?php echo $uploadAltroSoggettoSaved; ?>" />
                                                            <input type="file" name="aa_uploadAltroSoggetto" id="aa_uploadAltroSoggetto" class="upload" value="<?php echo $uploadAltroSoggettoSaved; ?>" />
                                                            <label for="aa_uploadAltroSoggetto">
                                                                <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                                <span>Upload</span>
                                                            </label>
                                                            <ul class="upload-file-list" id="aa_uploadAltroSoggetto_file">
                                                                <?php echo $uploadAltroSoggetto; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 after-section" id="aa_pnl_uploadNotaioRogante">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-sm-6 mb-3">
                                                            <h6 id="aa_uploadNotaioRogante_txt">Documentazione comprovante il titolo dichiarato: Notaio Rogante *</h6>
                                                            <p class='text-xsmall'>Dimensione Massima: 500 Kb</p><p class='text-xsmall'>Estensioni accettate: 'jpeg', 'jpg', 'png', 'gif', 'pdf'</p>
                                                        </div>
                                                        <div class="col-lg-4 text-right">
                                                            <input type="hidden" name="aa_uploadNotaioRoganteSaved" id="aa_uploadNotaioRoganteSaved" value="<?php echo $uploadNotaioRoganteSaved; ?>" />
                                                            <input type="file" name="aa_uploadNotaioRogante" id="aa_uploadNotaioRogante" class="upload" value="" />
                                                            <label for="aa_uploadNotaioRogante">
                                                                <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                                <span>Upload</span>
                                                            </label>                                                            
                                                            <ul class="upload-file-list" id="aa_uploadNotaioRogante_file">
                                                                <?php echo $uploadNotaioRogante; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 after-section" id="aa_pnl_uploadAltriTitoloDescrizione">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-sm-6 mb-3">
                                                            <h6 id="aa_uploadAltriTitoloDescrizione_txt">Documentazione comprovante il titolo dichiarato: Altro Titolo *</h6>
                                                            <p class='text-xsmall'>Dimensione Massima: 500 Kb</p><p class='text-xsmall'>Estensioni accettate: 'jpeg', 'jpg', 'png', 'gif', 'pdf'</p>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 text-right">
                                                            <input type="hidden" name="aa_uploadAltriTitoloDescrizioneSaved" id="aa_uploadAltriTitoloDescrizioneSaved" value="<?php echo $uploadAltriTitoloDescrizioneSaved; ?>" />
                                                            <input type="file" name="aa_uploadAltriTitoloDescrizione" id="aa_uploadAltriTitoloDescrizione" class="upload" value="<?php echo $uploadAltriTitoloDescrizioneSaved; ?>" />
                                                            <label for="aa_uploadAltriTitoloDescrizione">
                                                                <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                                <span>Upload</span>
                                                            </label>
                                                            <ul class="upload-file-list" id="aa_uploadAltriTitoloDescrizione_file">
                                                                <?php echo $uploadAltriTitoloDescrizione; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 after-section" id="aa_pnl_uploadAttoNotarile">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-sm-6 mb-3">
                                                            <h6 id="aa_uploadAttoNotarile_txt">Atto notarile con il quale è stata conferita la procura *</h6>
                                                            <p class='text-xsmall'>Dimensione Massima: 500 Kb</p><p class='text-xsmall'>Estensioni accettate: 'jpeg', 'jpg', 'png', 'gif', 'pdf'</p>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 text-right">
                                                            <input type="hidden" name="aa_uploadAttoNotarileSaved" id="aa_uploadAttoNotarileSaved" value="<?php echo $uploadAttoNotarileSaved; ?>" />
                                                            <input type="file" name="aa_uploadAttoNotarile" id="aa_uploadAttoNotarile" class="upload" value="" />
                                                            <label for="aa_uploadAttoNotarile">
                                                                <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                                <span>Upload</span>
                                                            </label>
                                                            <ul class="upload-file-list" id="aa_uploadAttoNotarile_file">
                                                                <?php echo $uploadAttoNotarile; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12" id="divButtons">
                                    <button type="button" id="aa_btn_concludi_richiesta" name="aa_btn_concludi_richiesta" class="btn btn-primary">Avanti <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
                                    <button type="button" id="aa_btn_salva_richiesta" name="aa_btn_salva_richiesta" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#SalvaRichiestaModal">Salva richiesta</button>
                                    <button type="button" id="aa_btn_back" class="btn btn-default"><svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="SalvaRichiestaModal" aria-labelledby="SalvaRichiestaModalTitle">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5 no_toc" id="SalvaRichiestaModalTitle">Salva la richiesta in corso</h2>
                </div>
                <div class="modal-body">
                    <p>Cliccando su "Salva come bozza" la tua richiesta verrà salvata ma <b>NON</b> verrà inviata.<br/>Potrai comunque trovarla nelle tue attività e concludere la richiesta.</p>
                    <h6>Vuoi salvare l'attuale richiesta come bozza?</h6>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-default btn-sm" id="aa_salva_richiesta_btn_close" type="button" data-bs-dismiss="modal">Chiudi</button>
                    <button class="btn btn-primary btn-sm" id="aa_salva_richiesta_btn_save" type="submit">Salva come bozza</button>
                </div>
            </div>
        </div>
    </div>
    
    
<?php include '../template/footer_servizi.php'; 