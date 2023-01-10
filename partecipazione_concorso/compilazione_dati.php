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
    $pc_bozza_id = "";
    $cf = "";
    $nome = "";
    $cognome = "";
    $email = "";
    $datanascita = "";
    $luogonascita = "";
    $richiedenteVia = "";
    $richiedenteLocalita = "";
    $richiedenteProvincia = "";
    $richiedenteTel = "";
    
    $ConcorsoId = 1;
    $Concorso = ConcorsoById(1);
    $cittadinoItaliano = "";
    $cittadinoEuropeo = "";
    $statoEuropeo = "";
    $conoscenzaLingua = "";
    $idoneitaFisica = "";
    $dirittiCiviliPolitici = "";
    $destituzionePA = "";
    $fedinaPulita = "";
    $condanne = "";
    $obbligoLeva = "";
    $titoloStudio = "";
    $titoloStudioScuola = "";
    $titoloStudioData = "";
    $titoloStudioVoto = "";
    $conoscenzaInformatica = "";
    $conoscenzaLinguaEstera = "";
    $titoliPreferenza = "";
    $necessitaHandicap = "";
    $dirittoRiserva = "";
    $accettazioneCondizioniBando = "";
    $accettazioneDisposizioniComune = "";
    $accettazioneComunicazioneVariazioniDomicilio = "";
    
    $uploadCartaIdentitaFronte = "";
    $uploadCartaIdentitaFronteSaved = "";
    $uploadCartaIdentitaRetro = "";
    $uploadCartaIdentitaRetroSaved = "";
    $uploadCV = "";
    $uploadCVSaved = "";
    $tmpUploadTitoliPreferenza1 = "";
    $tmpUploadTitoliPreferenzas = "";
    $uploadTitoliPreferenza = "";
    $uploadTitoliPreferenzaSaved = "";
    

    
    /* se mi viene passato l'id della bozza, vado a richiamare i dati salvati */
    if(isset($_GET["pc_bozza_id"]) && $_GET["pc_bozza_id"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM partecipazione_concorso WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $_GET["pc_bozza_id"];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $pc_bozza_id = $_GET["pc_bozza_id"];
                $cf = $row["richiedenteCf"];
                $nome = $row["richiedenteNome"];
                $cognome = $row["richiedenteCognome"];
                $email = $row["richiedenteEmail"];
                $datanascita = $row["richiedenteDataNascita"];
                $luogonascita = $row["richiedenteLuogoNascita"];
                $richiedenteVia = $row["richiedenteVia"];
                $richiedenteLocalita = $row["richiedenteLocalita"];
                $richiedenteProvincia = $row["richiedenteProvincia"];
                $richiedenteTel = $row["richiedenteTel"];

                $ConcorsoId = $row["ConcorsoId"];
                $Concorso = ConcorsoById($row["ConcorsoId"]);
                
                $cittadinoItaliano = $row["cittadinoItaliano"];
                $cittadinoEuropeo = $row["cittadinoEuropeo"];
                $statoEuropeo = $row["statoEuropeo"];
                $conoscenzaLingua = $row["conoscenzaLingua"];
                $idoneitaFisica = $row["idoneitaFisica"];
                $dirittiCiviliPolitici = $row["dirittiCiviliPolitici"];
                $destituzionePA = $row["destituzionePA"];
                $fedinaPulita = $row["fedinaPulita"];
                $condanne = $row["condanne"];
                $obbligoLeva = $row["obbligoLeva"];
                $titoloStudio = $row["titoloStudio"];
                $titoloStudioScuola = $row["titoloStudioScuola"];
                $titoloStudioData = $row["titoloStudioData"];
                $titoloStudioVoto = $row["titoloStudioVoto"];
                $conoscenzaInformatica = $row["conoscenzaInformatica"];
                $conoscenzaLinguaEstera = $row["conoscenzaLinguaEstera"];
                $titoliPreferenza = $row["titoliPreferenza"];
                $necessitaHandicap = $row["necessitaHandicap"];
                $dirittoRiserva = $row["dirittoRiserva"];
                $accettazioneCondizioniBando = $row["accettazioneCondizioniBando"];
                $accettazioneDisposizioniComune = $row["accettazioneDisposizioniComune"];
                $accettazioneComunicazioneVariazioniDomicilio = $row["accettazioneComunicazioneVariazioniDomicilio"];

                if($row["uploadCartaIdentitaFronte"] != ''){
                    $uploadCartaIdentitaFronte = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaFronte"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadCartaIdentitaFronteSaved = $row["uploadCartaIdentitaFronte"];
                }
                if($row["uploadCartaIdentitaRetro"] != ''){
                    $uploadCartaIdentitaRetro = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaRetro"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadCartaIdentitaRetroSaved = $row["uploadCartaIdentitaRetro"];
                }
                if($row["uploadCV"] != ''){
                    $uploadCV = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCV"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    $uploadCVSaved = $row["uploadCV"];
                }
                
                if($row["uploadTitoliPreferenza"] != ''){
                    $tmpUploadTitoliPreferenza1 = substr($row["uploadTitoliPreferenza"],0,-1);
                    $tmpUploadTitoliPreferenzas = explode(';', $tmpUploadTitoliPreferenza1);
                    $uploadTitoliPreferenza = "";
                    foreach($tmpUploadTitoliPreferenzas as $tmpUploadTitoliPreferenza) {
                        $uploadTitoliPreferenza .= "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $tmpUploadTitoliPreferenza ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                    }
                    $uploadTitoliPreferenzaSaved = $row["uploadTitoliPreferenza"];
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
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Presentare domanda di partecipazione a un concorso pubblico</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge">Presentare domanda di partecipazione a un concorso pubblico</h1>
                        <p class="subtitle-small">Servizio per l'iscrizione a concorsi per trovare impiego presso la Pubblica Amministrazione.</p>
                        <p style="display: inline;">Hai bisogno di assistenza?</p>
                        <form action="<?php echo $configData['url_comune']; ?>/richiesta-assistenza" method="post" id="frmRichiestaAssistenza" style="display: inline;">
                            <input type="hidden" name="id_assistenza" value="">
                            <input type="hidden" name="categoria" value="Salute, benessere e assistenza">
                            <input type="hidden" name="servizio" value="Contributi economici a persone in stato di bisogno">
                            <input type="hidden" name="descrizione" value="">
                            <a href="javascript:void()" onclick="document.getElementById('frmRichiestaAssistenza').submit();" class="btn btn-primary" style="margin-left: 10px; margin-top: -5px;">Contattaci</a>
                        </form>
                    </div>
                </div>
                <?php echo ViewMenuPratiche(2); ?>
            </div>
            <form action="#" id="pc_frm_dati" method="post" enctype="multipart/form-data">
                <input type="hidden" id="pc_bozza_id" name="pc_bozza_id" value="<?php echo $pc_bozza_id; ?>"/>
                <div class="it-page-sections-container">
                    <div class="row">
                        <div class="col-12 col-xl-3 d-xl-block mb-4 d-none">
                            <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                                <nav class="navbar it-navscroll-wrapper navbar-expand-lg" data-bs-navscroll>
                                    <div class="navbar-custom" id="navbarNavProgress">
                                        <div class="menu-wrapper">
                                            <div class="link-list-wrapper">
                                                <div class="accordion">
                                                    <div class="accordion-item">
                                                        <span class="accordion-header" id="accordion-title-one">
                                                            <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                                                INDICE DELLA PAGINA
                                                            </button>
                                                        </span>
                                                        <div class="progress">
                                                            <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                        <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                                            <div class="accordion-body">
                                                                <ul class="link-list" data-element="page-index">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#pc_richiedente">
                                                                            <span class="title-medium">Richiedente</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#pc_concorso">
                                                                            <span class="title-medium">Concorso</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#pc_dichiarazioni">
                                                                            <span class="title-medium">Dichiarazioni</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#pc_allegati">
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

                        <div class="col-12 col-xl-9 body-compilazione-dati">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="pc_frm_dati_pnl_return"></div>
                                </div>
                            </div>
                            <div class="it-page-section mb-30" id="pc_richiedente">
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
                                                <div class="col-lg-12"><p id="pc_richiedente_nome_txt">Nome *<br/><input type="text" id="pc_richiedente_nome" name="pc_richiedente_nome" value="<?php echo $nome; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pc_richiedente_cognome_txt">Cognome *<br/><input type="text" id="pc_richiedente_cognome" name="pc_richiedente_cognome" value="<?php echo $cognome; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pc_richiedente_cf_txt">Codice Fiscale *<br/><input type="text" id="pc_richiedente_cf" name="pc_richiedente_cf" value="<?php echo $cf; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pc_richiedente_data_nascita_txt">Data di Nascita *<br/><input type="date" id="pc_richiedente_data_nascita" name="pc_richiedente_data_nascita" value="<?php echo $datanascita; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pc_richiedente_luogo_nascita_txt">Luogo di Nascita *<br/><input type="text" id="pc_richiedente_luogo_nascita" name="pc_richiedente_luogo_nascita" value="<?php echo $luogonascita; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pc_richiedente_via_txt">Via e Numero civico *<br/><input type="text" id="pc_richiedente_via" name="pc_richiedente_via" value="<?php echo $richiedenteVia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pc_richiedente_localita_txt">Località *<br/><input type="text" id="pc_richiedente_localita" name="pc_richiedente_localita" value="<?php echo $richiedenteLocalita; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pc_richiedente_provincia_txt">Provincia *<br/><input type="text" id="pc_richiedente_provincia" name="pc_richiedente_provincia" value="<?php echo $richiedenteProvincia; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pc_richiedente_email_txt">E-mail *<br/><input type="email" id="pc_richiedente_email" name="pc_richiedente_email" value="<?php echo $email; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pc_richiedente_tel_txt">Telefono *<br/><input type="tel" id="pc_richiedente_tel" name="pc_richiedente_tel" value="<?php echo $richiedenteTel; ?>" /></p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="it-page-section mb-30" id="pc_concorso">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div>
                                                <h2 class="title-xxlarge mb-3">Concorso</h2>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <input type="hidden" name="pc_ConcorsoId" id="pc_ConcorsoId" value="<?php echo $ConcorsoId; ?>" />
                                                    <p><?php echo $Concorso; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="it-page-section mb-30" id="pc_dichiarazioni">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Dichiarazioni</h2>
                                            </div>
                                        </div>
                                        <div class="card-body" id="pc_pnl_dichiarazioni">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p id="pc_cittadino_txt">di essere cittadino/a *</p>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pc_cittadino" id="pc_cittadinoItaliano" value="I" <?php  echo $cittadinoItaliano == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_cittadinoItaliano">italiano/a</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pc_cittadino" id="pc_cittadinoEuropeo" value="E" <?php  echo $cittadinoEuropeo == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_cittadinoEuropeo" id="pc_statoEuropeo_txt">
                                                            europeo<br/>
                                                            <input type="text" id="pc_statoEuropeo" name="pc_statoEuropeo" value="<?php echo $statoEuropeo; ?>" placeholder="(indicare di quale paese della Comunità Europea)" />
                                                        </label>
                                                    </div>

                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="pc_conoscenzaLingua" name="pc_conoscenzaLingua" value="1" <?php  echo $conoscenzaLingua == 1 ? "checked" : ""; ?>>
                                                        <label class="form-check-label" for="pc_conoscenzaLingua" id="pc_conoscenzaLingua_txt">di conoscere la lingua italiana</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="pc_idoneitaFisica" id="pc_idoneitaFisica" value="1" <?php  echo $idoneitaFisica == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_idoneitaFisica" id="pc_idoneitaFisica_txt">
                                                            di essere fisicamente idoneo/a all’impiego
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="pc_dirittiCiviliPolitici" id="pc_dirittiCiviliPolitici" value="1" <?php  echo $dirittiCiviliPolitici == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_dirittiCiviliPolitici" id="pc_dirittiCiviliPolitici_txt">
                                                            di godere dei diritti civili e politici
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="pc_destituzionePA" id="pc_destituzionePA" value="1" <?php  echo $destituzionePA == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_destituzionePA" id="pc_destituzionePA_txt">
                                                            di non essere stato destituito, dispensato o comunque licenziato dall’impiego presso una pubblica amministrazione per persistente insufficiente rendimento e di non essere stato dichiarato decaduto o licenziato da altro pubblico impiego per averlo conseguito mediante esibizione di documenti falsi o viziati da invalidità non sanabile (art.127 DPR 10/01/1957 n.3)
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pc_fedina" id="pc_fedinaPulita" value="1" <?php  echo $fedinaPulita == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_fedinaPulita" id="pc_fedinaPulita_txt">
                                                            di non aver riportato condanne penali e di non aver procedimenti penali pendenti a proprio carico che impediscano, ai sensi delle vigenti disposizioni in materia, la costituzione del rapporto d’impiego con la Pubblica Amministrazione
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="pc_fedina" id="pc_fedinaSegnata" value="0" <?php  echo $condanne != "" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_fedinaSegnata" id="pc_condanne_txt">
                                                            di aver riportato le seguenti condanne (anche se sia concessa amnistia, condono indulto o perdono giudiziale) o di avere seguenti procedimenti penali in corso:
                                                            <input type="text" id="pc_condanne" name="pc_condanne" value="<?php echo $condanne; ?>" />
                                                        </label>
                                                    </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="pc_obbligoLeva" id="pc_obbligoLeva" value="1" <?php  echo $obbligoLeva == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_obbligoLeva" id="pc_obbligoLeva_txt">
                                                            di essere in regola nei confronti dell’obbligo di leva per i candidati di sesso maschile nati entro il 31/12/1985 ai sensi dell’art.1, Legge 23/8/2004, n.226
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="pc_titoloStudioHas" id="pc_titoloStudioHas" value="1" <?php  echo $titoloStudio != "" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_titoloStudioHas" id="pc_titoloStudioHas_txt">
                                                            di essere in possesso del seguente titolo di studio<br>
                                                            <input type="text" id="pc_titoloStudio" name="pc_titoloStudio" value="<?php echo $titoloStudio; ?>" /><br>
                                                            conseguito presso<br>
                                                            <input type="text" id="pc_titoloStudioScuola" name="pc_titoloStudioScuola" value="<?php echo $titoloStudioScuola; ?>" /><br>
                                                            in data<br>
                                                            <input type="date" id="pc_titoloStudioData" name="pc_titoloStudioData" value="<?php echo $titoloStudioData; ?>" /><br>
                                                            con votazione finale di<br>
                                                            <input type="text" id="pc_titoloStudioVoto" name="pc_titoloStudioVoto" value="<?php echo $titoloStudioVoto; ?>" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="pc_conoscenzaInformatica" id="pc_conoscenzaInformatica" value="1" <?php  echo $conoscenzaInformatica == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_conoscenzaInformatica" id="pc_conoscenzaInformatica_txt">
                                                            di conoscere l’uso delle apparecchiature, delle applicazioni informatiche più diffuse e di scegliere la seguente lingua straniera (inglese o francese)
                                                            <input type="text" id="pc_conoscenzaLinguaEstera" name="pc_conoscenzaLinguaEstera" value="<?php echo $conoscenzaLinguaEstera; ?>" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="pc_titoliPreferenzaHas" id="pc_titoliPreferenzaHas" value="1" <?php  echo $titoliPreferenza != "" ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_titoliPreferenzaHas" id="pc_titoliPreferenzaHas_txt">
                                                            di essere in possesso dei seguenti titoli di preferenza (a parità di valutazione)
                                                            <input type="text" id="pc_titoliPreferenza" name="pc_titoliPreferenza" value="<?php echo $titoliPreferenza; ?>" />
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="pc_dirittoRiserva" id="pc_dirittoRiserva" value="1" <?php  echo $dirittoRiserva == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_dirittoRiserva" id="pc_dirittoRiserva_txt">
                                                            di aver diritto alla riserva ai sensi dell’art1014 e dell’art. 678, comma 9, del D.Lgs66/2010
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>    
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="pc_accettazioneCondizioniBando" id="pc_accettazioneCondizioniBando" value="1" <?php  echo $accettazioneCondizioniBando == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_accettazioneCondizioniBando" id="pc_accettazioneCondizioniBando_txt">
                                                            di accettare espressamente ed incondizionatamente tutte le prescrizioni e condizioni contenute nel bando di concorso *
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>    
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="pc_accettazioneDisposizioniComune" id="pc_accettazioneDisposizioniComune" value="1" <?php  echo $accettazioneDisposizioniComune == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_accettazioneDisposizioniComune" id="pc_accettazioneDisposizioniComune_txt">
                                                            di accettare, in caso di presa di servizio, tutte le disposizioni che regolano lo stato giuridico ed economici dei dipendenti del Comune di <?php echo $configData['nome_comune']; ?>. *
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>    
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="pc_accettazioneComunicazioneVariazioniDomicilio" id="pc_accettazioneComunicazioneVariazioniDomicilio" value="1" <?php  echo $accettazioneComunicazioneVariazioniDomicilio == 1 ? "checked" : ""; ?> />
                                                        <label class="form-check-label" for="pc_accettazioneComunicazioneVariazioniDomicilio" id="pc_accettazioneComunicazioneVariazioniDomicilio_txt">
                                                            di impegnarsi a comunicare, per iscritto, al Comune di <?php echo $configData['nome_comune']; ?> le eventuali successive variazioni di domicilio e riconosce che il Comune sarà esonerato da ogni responsabilità in caso di irreperibilità del destinatario o disguidi del servizio postale e/o telematico. *
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-check">
                                                        <label class="form-check-label text-justify" id="pc_necessitaHandicap_txt">
                                                            <b>Per i portatori di handicap:</b> indicare le necessità, per l’effettuazione delle prove, in relazione al proprio handicap, di eventuali tempi aggiuntivi e/o ausili specifici ai sensi dell’art. 20, comma 2 della L. 5.02.1992, n. 104 e dell’art. 16 della legge 68/99 10) di aver diritto alla riserva ai sensi dell’art1014 e dell’art. 678, comma 9, del D.Lgs66/2010
                                                            <textarea id="pc_necessitaHandicap" name="pc_necessitaHandicap" rows="4"><?php echo $necessitaHandicap; ?></textarea>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        
                            <div class="it-page-section mb-30" id="pc_allegati">
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
                                                            <h6 id="pc_uploadCartaIdentitaFronte_txt">Documento di identità (fronte) *</h6>
                                                            <p class='text-xsmall'>Dimensione Massima: 500 Kb</p><p class='text-xsmall'>Estensioni accettate: 'jpeg', 'jpg', 'png', 'gif', 'pdf'</p>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 text-right">
                                                            <input type="hidden" name="pc_uploadCartaIdentitaFronteSaved" id="pc_uploadCartaIdentitaFronteSaved" value="<?php echo $uploadCartaIdentitaFronteSaved; ?>" />
                                                            <input type="file" name="pc_uploadCartaIdentitaFronte" id="pc_uploadCartaIdentitaFronte" class="upload" value="<?php echo $uploadCartaIdentitaFronteSaved; ?>" />
                                                            <label for="pc_uploadCartaIdentitaFronte">
                                                                <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                                <span>Upload</span>
                                                            </label>
                                                            <ul class="upload-file-list" id="pc_uploadCartaIdentitaFronte_file">
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
                                                            <h6 id="pc_uploadCartaIdentitaRetro_txt">Documento di identità (retro) *</h6>
                                                            <p class='text-xsmall'>Dimensione Massima: 500 Kb</p><p class='text-xsmall'>Estensioni accettate: 'jpeg', 'jpg', 'png', 'gif', 'pdf'</p>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6 text-right">
                                                            <input type="hidden" name="pc_uploadCartaIdentitaRetroSaved" id="pc_uploadCartaIdentitaRetroSaved" value="<?php echo $uploadCartaIdentitaRetroSaved; ?>" />
                                                            <input type="file" name="pc_uploadCartaIdentitaRetro" id="pc_uploadCartaIdentitaRetro" class="upload" value="<?php echo $uploadCartaIdentitaRetroSaved; ?>" />
                                                            <label for="pc_uploadCartaIdentitaRetro">
                                                                <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                                <span>Upload</span>
                                                            </label>
                                                            <ul class="upload-file-list" id="pc_uploadCartaIdentitaRetro_file">
                                                                <?php echo $uploadCartaIdentitaRetro; ?>
                                                            </ul>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 after-section">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-sm-6 mb-3">
                                                            <h6 id="pc_uploadCV_txt">Curriculum Vitae *</h6>
                                                            <p class='text-xsmall'>Dimensione Massima: 500 Kb</p><p class='text-xsmall'>Estensioni accettate: 'jpeg', 'jpg', 'png', 'gif', 'pdf'</p>
                                                        </div>                                                    
                                                        <div class="col-lg-4 col-sm-6 text-right">
                                                            <input type="hidden" name="pc_uploadCVSaved" id="pc_uploadCVSaved" value="<?php echo $uploadCVSaved; ?>" />
                                                            <input type="file" name="pc_uploadCV" id="pc_uploadCV" class="upload" value="" />
                                                            <label for="pc_uploadCV">
                                                                <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                                <span>Upload</span>
                                                            </label>                                                            
                                                            <ul class="upload-file-list" id="pc_uploadCV_file">
                                                                <?php echo $uploadCV; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-lg-8 col-sm-6 mb-3">
                                                            <h6 id="dc_uploadTitoliPreferenza_txt">Titoli di precedenza o preferenza</h6>
                                                            <p class='text-xsmall'>Dimensione Massima: 500 Kb</p><p class='text-xsmall'>Estensioni accettate: 'jpeg', 'jpg', 'png', 'gif', 'pdf'</p>
                                                        </div>                                                    
                                                        <div class="col-lg-4 col-sm-6 text-right">
                                                            <input type="hidden" name="pc_uploadTitoliPreferenzaSaved" id="pc_uploadTitoliPreferenzaSaved" value="<?php echo $uploadTitoliPreferenzaSaved; ?>" />
                                                            <input type="file" name="pc_uploadTitoliPreferenza[]" id="pc_uploadTitoliPreferenza" class="upload" multiple="multiple" value="" />
                                                            <label for="pc_uploadTitoliPreferenza">
                                                                <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                                <span>Upload</span>
                                                            </label>                                                            
                                                            <ul class="upload-file-list" id="pc_uploadTitoliPreferenza_file">
                                                                <?php echo $uploadTitoliPreferenza; ?>
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
                                <div class="col-12">
                                    <div class="row float-right" id="divButtons">
                                        <button type="button" id="pc_btn_back" class="btn btn-default order-lg-1 mr-10"><svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</button>
                                        <button type="button" id="pc_btn_salva_richiesta" name="pc_btn_salva_richiesta" class="btn btn-secondary order-lg-2" data-bs-toggle="modal" data-bs-target="#SalvaRichiestaModal">Salva richiesta</button>
                                        <button type="button" id="pc_btn_concludi_richiesta" name="pc_btn_concludi_richiesta" class="btn btn-primary order-lg-3">Avanti <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
                                    </div>
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
                    <button class="btn btn-default btn-sm" id="pc_salva_richiesta_btn_close" type="button" data-bs-dismiss="modal">Chiudi</button>
                    <button class="btn btn-primary btn-sm" id="pc_salva_richiesta_btn_save" type="submit">Salva come bozza</button>
                </div>
            </div>
        </div>
    </div>
    
    
<?php include '../template/footer_servizi.php'; 