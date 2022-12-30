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
    $status_id = "";
    $cf = "";
    $UfficioDestinatarioId = "";
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
    $uploadAltroSoggetto = "";
    $uploadNotaioRogante = "";
    $uploadAltriTitoloDescrizione = "";
    $uploadCartaIdentitaFronte = "";
    $uploadCartaIdentitaRetro = "";
    $uploadAttoNotarile = "";

    
    /* con l'id vado a richiamare i dati salvati */
    if(isset($_GET["aa_pratica_id"]) && $_GET["aa_pratica_id"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM accesso_atti WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $_GET["aa_pratica_id"];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $status_id = $row["status_id"];
                $UfficioDestinatarioId = $row["UfficioDestinatarioId"];
                $cf = $row["richiedenteCf"];
                $nome = $row["richiedenteNome"];
                $cognome = $row["richiedenteCognome"];
                $email = $row["richiedenteEmail"];
                $datanascita = date("d/m/Y", strtotime($row["richiedenteDataNascita"]));
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
                $uploadAffittuario = $row["uploadAffittuario"] != "" ? "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadAffittuario"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>" : "";
                $uploadAltroSoggetto = $row["uploadAltroSoggetto"] != "" ? "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadAltroSoggetto"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>" : "";
                $uploadNotaioRogante = $row["uploadNotaioRogante"] != "" ? "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadNotaioRogante"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>" : "";
                $uploadAltriTitoloDescrizione = $row["uploadAltriTitoloDescrizione"] != "" ? "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadAltriTitoloDescrizione"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>" : "";
                $uploadCartaIdentitaFronte = $row["uploadCartaIdentitaFronte"] != "" ? "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaFronte"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>" : "";
                $uploadCartaIdentitaRetro = $row["uploadCartaIdentitaRetro"] != "" ? "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaRetro"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>" : "";
                $uploadAttoNotarile = $row["uploadAttoNotarile"] != "" ? "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadAttoNotarile"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>" : "";
            }
        }
        $connessione->close();
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
            </div>
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
                                                            <svg class="icon icon-xs right">
                                                                <use href="../lib/svg/sprites.svg#it-expand"></use>
                                                            </svg>
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

                    <div class="col-12 col-lg-9 body-riepilogo">
                        <div class="row">
                            <div class="col-12 p-0  menu-servizi">
                                <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
                                    <div class="row">
                                        <div class="col-12"><span class="active"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>Stato pratica: <b><?php echo NameStatusById($status_id); ?></b></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="it-page-section mb-50 mb-lg-90" id="aa_ufficio">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Ufficio</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p id="aa_UfficioDestinatarioId_txt">Ufficio destinatario *<br/>
                                                    <select id="aa_UfficioDestinatarioId" name="aa_UfficioDestinatarioId">
                                                        <?php echo LoadSelectUfficioDestinatario($ufficioDestinatarioId); ?>
                                                    </select>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="it-page-section mb-50 mb-lg-90" id="aa_richiedente">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div>
                                            <h2 class="title-xxlarge mb-3">Richiedente</h2>
                                            <p><b>Informazioni su di te</b></p>
                                        </div>
                                    </div>
                                    <div class="card-body" style="margin-bottom:40px;">
                                        <h5><b><?php echo $_SESSION['Nome'] . ' ' . $_SESSION['Cognome']; ?></b></h5>
                                        <p class="subtitle-small">Codice Fiscale:<br/><b><?php echo $_SESSION['CF']; ?></b></p>

                                        <div class="accordion-item">
                                            <div class="row">
                                                <div class="col-lg-12"><h5 class="color-primary"><b>Anagrafica</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>Nome <b><?php echo $nome; ?></b></p></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><p>Cognome <b><?php echo $cognome; ?></b></p></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><p>Codice Fiscale <b><?php echo $cf; ?></b></p></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>Data di Nascita <b><?php echo $datanascita; ?></b></p></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><p>Luogo di Nascita <b><?php echo $luogonascita; ?></b></p></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>Località <b><?php echo $richiedenteLocalita; ?></b></p></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><p>Provincia <b><?php echo $richiedenteProvincia; ?></b></p></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>Via e Numero civico <b><?php echo $richiedenteVia; ?></b></p></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>E-mail <b><?php echo $email; ?></b></p></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>Telefono <b><?php echo $richiedenteTel; ?></b></p></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div class="row">
                                            <div class="col-lg-12"><p id="aa_pgRuolo_txt"><b>In qualità di:</b></p></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php if($richiedenteTitolo == "DI"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Diretto interessato</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($richiedenteTitolo == "PI"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Proprietario dell'immobile oggetto del procedimento</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($richiedenteTitolo == "AI"){ ?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-check">
                                                    <label class="form-check-label">Affittuario dell'immobile oggetto del procedimento, pertanto si allegherà documentazione comprovante il titolo dichiarato</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if($richiedenteTitolo == "RI"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Professionista incaricato</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if($richiedenteTitolo == "Tribunale"){ ?>
                                                <div class="row">
                                                    <div class="col-lg-11 offset-lg-1">
                                                        <div class="form-check">
                                                            <label class="form-check-label">dal tribunale altro organo giudiziario</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if($richiedenteTitolo == "Proprietario"){ ?>
                                                <div class="row">
                                                    <div class="col-lg-11 offset-lg-1">
                                                        <div class="form-check">
                                                            <label class="form-check-label">dal proprietario dell'immobile <b><?php echo $richiedenteProfessionistaIncaricatoDaNome . " " . $richiedenteProfessionistaIncaricatoDaCognome . " (" . $richiedenteProfessionistaIncaricatoDaCf . ")"; ?></b></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if($richiedenteTitolo == "Altro"){ ?>
                                                <div class="row">
                                                    <div class="col-lg-11 offset-lg-1">
                                                        <div class="form-check">
                                                            <label class="form-check-label">da altro soggetto: <b><?php echo $richiedenteProfessionistaIncaricatoDaAltroSoggetto; ?>"</b></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                        <?php if($richiedenteTitolo == "NR"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Notaio rogante, pertanto si allegherà documentazione comprovante il titolo dichiarato</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($richiedenteTitolo == "AI"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label" for="aa_richiedenteTitoloD">Altro titolo, pertanto si allegherà documentazione comprovante il titolo dichiarato<br/><b><?php echo $richiedenteProfessionistaIncaricatoDaDescrizioneTitolo; ?></b></label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
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
                                    <div class="card-header border-0 p-0 m-0">
                                        <div class="row">
                                            <div class="col-lg-12"><p id="aa_pgRuolo_txt"><b>di esercitare il diritto di accesso agli atti attraverso la richiesta di:</b></p></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php if($richiestaTipo == "PresaVisione"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Presa Visione</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($richiestaTipo == "CopiaInformatizzata"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Copia informatizzata</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($richiestaTipo == "CopiaCartaSemplice"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Copia Carta Semplice</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($richiestaTipo == "CopiaConformeOriginale"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Copia conforme all'originale</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($richiestaTipo == "Altro"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Altro</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($richiestaAtti <> ""){ ?>
                                            <div class="row">
                                                <div class="col-lg-12 mt-5"><p><b>dei seguenti atti o documenti amministrativi:</b><br><?php echo $richiestaAtti; ?></div>
                                            </div>
                                        <?php } ?>
                                        <?php if($richiestaAttiTipoDocumento <> ""){ ?>
                                            <div class="row">
                                                <div class="col-lg-12 mt-5"><p id="aa_richiestaAtti_txt"><b>eventuali estremi identificativi degli atti o documenti:</b></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            Tipo Documento: <b><?php echo $richiestaAttiTipoDocumento; ?></b>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            Protocollo: <b><?php echo $richiestaAttiProtocollo; ?></b>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            Data: <b><?php echo $richiestaAttiData; ?></b>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($collocazioneTerritorialeCodiceCatastale <> ""){ ?>
                                            <div class="row">
                                                <div class="col-lg-12 mt-5"><p id="aa_richiestaAtti_txt"><b>eventuale collocazione territoriale:</b></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    Codice catastale: <b><?php echo $collocazioneTerritorialeCodiceCatastale; ?></b>
                                                </div>
                                                <div class="col-lg-4">
                                                    Sezione: <b><?php echo $collocazioneTerritorialeSezione; ?></b>
                                                </div>
                                                <div class="col-lg-4">
                                                    Foglio: <b><?php echo $collocazioneTerritorialeFoglio; ?></b>
                                                </div>
                                                <div class="col-lg-4">
                                                    Particella: <b><?php echo $collocazioneTerritorialeParticella; ?></b>
                                                </div>
                                                <div class="col-lg-4">
                                                    Subalterno: <b><?php echo $collocazioneTerritorialeSubalterno; ?></b>
                                                </div>
                                                <div class="col-lg-4">
                                                    Categoria: <b><?php echo $collocazioneTerritorialeCategoria; ?></b>
                                                </div>
                                                <div class="col-lg-4">
                                                    Indirizzo: <b><?php echo $collocazioneTerritorialeIndirizzo; ?></b>
                                                </div>
                                                <div class="col-lg-4">
                                                    Localita: <b><?php echo $collocazioneTerritorialeLocalita; ?></b>
                                                </div>
                                                <div class="col-lg-4">
                                                    Provincia: <b><?php echo $collocazioneTerritorialeProvincia; ?></b>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="row">
                                            <div class="col-lg-12 mt-5"><p id="aa_motivo_txt"><b>di avere un interesse personale e concreto ovvero pubblico o diffuso all'accesso per la tutela di situazioni giuridicamente rilevanti per il seguente motivo:</b></div>
                                        </div>
                                        <?php if($motivo == "AttoNotarile"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Atto Notarile</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($motivo == "Controversia"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Controversia</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($motivo == "DocumentazionePersonale"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Documentazione Personale</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($motivo == "Mutuo"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Mutuo</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($motivo == "PresentazioneProgettoEdilizio"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Presentazione Progetto Edilizio</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($motivo == "PresuntaLesioneDiInteressi"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Presunta Lesione Di Interessi</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($motivo == "VerificaConformitaEdilizia"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Verifica Conformità Edilizia</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($motivo == "AltraMotivazione"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">Altra Motivazione:<br><?php echo $motivoAltro; ?></label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="row">
                                            <div class="col-lg-12 mt-5"><p id="aa_modoRitiro_txt"><b>Modo ritiro:</b></div>
                                        </div>
                                        <?php if($modoRitiro == "Ufficio"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">ritiro presso l'ufficio competente</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($modoRitiro == "Email"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">ricezione all'indirizzo e-mail sopra indicato</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($modoRitiro == "IndirizzoInserito"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label">ricezione a mezzo posta all'indirizzo sopra indicato</label>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($modoRitiro == "AltroIndirizzo"){ ?>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p>ricezione a mezzo posta al seguente indirizzo:</p>
                                                </div>
                                                <div class="col-lg-3">
                                                    Indirizzo<br>
                                                    <b><?php echo $modoRitiroPostaIndirizzo; ?></b>
                                                </div>
                                                <div class="col-lg-3">
                                                    Località<br>
                                                    <b><?php echo $modoRitiroPostaLocalita; ?></b>
                                                </div>
                                                <div class="col-lg-3">
                                                    Provincia<br>
                                                    <b><?php echo $modoRitiroPostaProvincia; ?></b>
                                                </div>
                                                <div class="col-lg-3">
                                                    Cap<br>
                                                    <b><?php echo $modoRitiroPostaCap; ?></b>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <?php if($annotazioni <> ""){ ?>
                                            <div class="row">
                                                <div class="col-lg-12 mt-5"><p id="aa_annotazioni_txt">Eventuali annotazioni:<br>
                                                        <b><?php echo $annotazioni; ?></b>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-50 mb-lg-90" id="aa_allegati">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Allegati</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php if($uploadCartaIdentitaFronte != ""){ ?>
                                        <div class="row">
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h6 id="aa_uploadDocumentazione_txt">Carta d'Identita Fronte</h6>
                                                    </div>                                                    
                                                    <div class="col-lg-4 text-right">
                                                        <ul class="upload-file-list" id="aa_uploadCartaIdentitaFronte_file">
                                                            <?php echo $uploadCartaIdentitaFronte; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if($uploadCartaIdentitaRetro != ""){ ?>
                                        <div class="row">
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h6 id="aa_uploadPotereFirma_txt">Carta d'Identita Retro</h6>
                                                    </div>
                                                    <div class="col-lg-4 text-right">
                                                        <ul class="upload-file-list" id="aa_uploadCartaIdentitaRetro_file">
                                                            <?php echo $uploadCartaIdentitaRetro; ?>
                                                        </ul>                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if($uploadAffittuario != ""){ ?>
                                        <div class="row">
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h6 id="aa_uploadDocumentazione_txt">Documentazione comprovante il titolo dichiarato: Affittuario</h6>                                                        
                                                    </div>                                                    
                                                    <div class="col-lg-4 text-right">
                                                        <ul class="upload-file-list" id="aa_uploadAffittuario_file">
                                                            <?php echo $uploadAffittuario; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if($uploadAltroSoggetto != ""){ ?>
                                        <div class="row">
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h6 id="aa_uploadPotereFirma_txt">Documentazione comprovante il titolo dichiarato: professionista incaricato da altro soggetto</h6>
                                                    </div>
                                                    <div class="col-lg-4 text-right">
                                                        <ul class="upload-file-list" id="aa_uploadAltroSoggetto_file">
                                                            <?php echo $uploadAltroSoggetto; ?>
                                                        </ul>                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if($uploadNotaioRogante != ""){ ?>
                                        <div class="row">
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h6 id="aa_uploadDocumentazione_txt">Documentazione comprovante il titolo dichiarato: Notaio Rogante</h6>
                                                    </div>                                                    
                                                    <div class="col-lg-4 text-right">
                                                        <ul class="upload-file-list" id="aa_uploadNotaioRogante_file">
                                                            <?php echo $uploadNotaioRogante; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if($uploadAltriTitoloDescrizione != ""){ ?>
                                        <div class="row">
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h6 id="aa_uploadPotereFirma_txt">Documentazione comprovante il titolo dichiarato: Altro Titolo</h6>
                                                    </div>
                                                    <div class="col-lg-4 text-right">
                                                        <ul class="upload-file-list" id="aa_uploadAltriTitoloDescrizione_file">
                                                            <?php echo $uploadAltriTitoloDescrizione; ?>
                                                        </ul>                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <?php if($uploadAttoNotarile != ""){ ?>
                                        <div class="row">
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <h6 id="aa_uploadDocumentazione_txt">Atto notarile con il quale è stata conferita la procura</h6>
                                                    </div>                                                    
                                                    <div class="col-lg-4 text-right">
                                                        <ul class="upload-file-list" id="aa_uploadAttoNotarile_file">
                                                            <?php echo $uploadAttoNotarile; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 text-right mb-20">
                                <a href="..\attivita_list.php" class="btn btn-secondary"><svg class="icon me-1 mr-lg-10" aria-hidden="true" fill="#fff"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include '../template/footer_servizi.php'; 