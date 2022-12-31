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
    $pm_bozza_id = "";
    $cf = "";
    $nome = "";
    $cognome = "";
    $email = "";
    $datanascita = "";
    $luogonascita = "";
    $richiedenteStatoNascita = "";
    $richiedenteVia = "";
    $richiedenteLocalita = "";
    $richiedenteProvincia = "";
    $richiedenteTel = "";
    $richiedenteStatoCivile = "";
    $richiedenteAttoNascita = "";
    $richiedenteAttoNascitaData = "";
    $coniugeNome = "";
    $coniugeCognome = "";
    $coniugeCf = "";
    $coniugeDataNascita = "";
    $coniugeLuogoNascita = "";
    $coniugeStatoNascita = "";
    $coniugeVia = "";
    $coniugeLocalita = "";
    $coniugeProvincia = "";
    $coniugeEmail = "";
    $coniugeTel = "";
    $coniugeStatoCivile = "";
    $coniugeAttoNascita = "";
    $coniugeAttoNascitaData = "";

    
    /* se mi viene passato l'id della bozza, vado a richiamare i dati salvati */
    if(isset($_GET["pm_bozza_id"]) && $_GET["pm_bozza_id"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM pubblicazione_matrimonio WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $_GET["pm_bozza_id"];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $pm_bozza_id = $_GET["pm_bozza_id"];
                $cf = $row["richiedenteCf"];
                $nome = $row["richiedenteNome"];
                $cognome = $row["richiedenteCognome"];
                $email = $row["richiedenteEmail"];
                $datanascita = $row["richiedenteDataNascita"];
                $luogonascita = $row["richiedenteLuogoNascita"];
                $richiedenteStatoNascita = $row["richiedenteStatoNascita"];
                $richiedenteVia = $row["richiedenteVia"];
                $richiedenteLocalita = $row["richiedenteLocalita"];
                $richiedenteProvincia = $row["richiedenteProvincia"];
                $richiedenteTel = $row["richiedenteTel"];
                $richiedenteStatoCivile = $row["richiedenteStatoCivile"];
                $richiedenteAttoNascita = $row["richiedenteAttoNascita"];
                $richiedenteAttoNascitaData = $row["richiedenteAttoNascitaData"];
                $coniugeNome = $row["coniugeNome"];
                $coniugeCognome = $row["coniugeCognome"];
                $coniugeCf = $row["coniugeCf"];
                $coniugeDataNascita = $row["coniugeDataNascita"];
                $coniugeLuogoNascita = $row["coniugeLuogoNascita"];
                $coniugeStatoNascita = $row["coniugeStatoNascita"];
                $coniugeVia = $row["coniugeVia"];
                $coniugeLocalita = $row["coniugeLocalita"];
                $coniugeProvincia = $row["coniugeProvincia"];
                $coniugeEmail = $row["coniugeEmail"];
                $coniugeTel = $row["coniugeTel"];
                $coniugeStatoCivile = $row["coniugeStatoCivile"];
                $coniugeAttoNascita = $row["coniugeAttoNascita"];
                $coniugeAttoNascitaData = $row["coniugeAttoNascitaData"];
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
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Richiedere una pubblicazione di matrimonio</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge">Richiedere una pubblicazione di matrimonio</h1>
                        <p class="subtitle-small">Servizio per la richiesta di autorizzazione previa celebrazione dei matrimoni civili.</p>
                        <p style="display: inline;">Hai bisogno di assistenza?</p>
                        <form action="<?php echo $configData['url_comune']; ?>/richiesta-assistenza" method="post" id="frmRichiestaAssistenza" style="display: inline;">
                            <input type="hidden" name="id_assistenza" value="">
                            <input type="hidden" name="categoria" value="Stato civile">
                            <input type="hidden" name="servizio" value="Matrimonio">
                            <input type="hidden" name="descrizione" value="">
                            <a href="javascript:void()" onclick="document.getElementById('frmRichiestaAssistenza').submit();" class="btn btn-primary" style="margin-left: 10px;margin-top: -5px;">Contattaci</a>
                        </form>
                    </div>
                </div>
                <?php echo ViewMenuPratiche(2); ?>
            </div>
            <form action="#" id="pm_frm_dati" method="post" enctype="multipart/form-data">
                <input type="hidden" id="pm_bozza_id" name="pm_bozza_id" value="<?php echo $pm_bozza_id; ?>"/>
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
                                                                        <a class="nav-link" href="#pm_richiedente">
                                                                            <span class="title-medium">Richiedente</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#pm_coniuge">
                                                                            <span class="title-medium">Coniuge</span>
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
                                    <div id="pm_frm_dati_pnl_return"></div>
                                </div>
                            </div>
                            <div class="it-page-section mb-50 mb-lg-90" id="pm_richiedente">
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
                                                <div class="col-lg-12"><p id="pm_richiedente_nome_txt">Nome *<br/><input type="text" id="pm_richiedente_nome" name="pm_richiedente_nome" value="<?php echo $nome; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedente_cognome_txt">Cognome *<br/><input type="text" id="pm_richiedente_cognome" name="pm_richiedente_cognome" value="<?php echo $cognome; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedente_cf_txt">Codice Fiscale *<br/><input type="text" id="pm_richiedente_cf" name="pm_richiedente_cf" value="<?php echo $cf; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedenteStatoCivile_txt">Stato Civile *<br/><input type="text" id="pm_richiedenteStatoCivile" name="pm_richiedenteStatoCivile" value="<?php echo $richiedenteStatoCivile; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedente_data_nascita_txt">Data di Nascita *<br/><input type="date" id="pm_richiedente_data_nascita" name="pm_richiedente_data_nascita" value="<?php echo $datanascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedente_luogo_nascita_txt">Luogo di Nascita *<br/><input type="text" id="pm_richiedente_luogo_nascita" name="pm_richiedente_luogo_nascita" value="<?php echo $luogonascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedente_StatoNascita_txt">Stato di Nascita *<br/><input type="text" id="pm_richiedenteStatoNascita" name="pm_richiedenteStatoNascita" value="<?php echo $richiedenteStatoNascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedenteAttoNascita_txt">Atto di Nascita N. *<br/><input type="text" id="pm_richiedenteAttoNascita" name="pm_richiedenteAttoNascita" value="<?php echo $richiedenteAttoNascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedenteAttoNascitaData_txt">Atto di Nascita Anno *<br/><input type="text" id="pm_richiedenteAttoNascitaData" name="pm_richiedenteAttoNascitaData" value="<?php echo $richiedenteAttoNascitaData; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedente_via_txt">Via e Numero civico *<br/><input type="text" id="pm_richiedente_via" name="pm_richiedente_via" value="<?php echo $richiedenteVia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedente_localita_txt">Località *<br/><input type="text" id="pm_richiedente_localita" name="pm_richiedente_localita" value="<?php echo $richiedenteLocalita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedente_provincia_txt">Provincia *<br/><input type="text" id="pm_richiedente_provincia" name="pm_richiedente_provincia" value="<?php echo $richiedenteProvincia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedente_email_txt">E-mail *<br/><input type="email" id="pm_richiedente_email" name="pm_richiedente_email" value="<?php echo $email; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_richiedente_tel_txt">Telefono *<br/><input type="tel" id="pm_richiedente_tel" name="pm_richiedente_tel" value="<?php echo $richiedenteTel; ?>" /></p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="it-page-section mb-50 mb-lg-90" id="pm_coniuge">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Coniuge</h2>
                                            </div>
                                        </div>
                                        <div class="card-body" id="pm_pnl_coniuge">
                                                                                        <div class="row">
                                                <div class="col-lg-12"><h5 class="color-primary"><b>Anagrafica</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeNome_txt">Nome *<br/><input type="text" id="pm_coniugeNome" name="pm_coniugeNome" value="<?php echo $coniugeNome; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeCognome_txt">Cognome *<br/><input type="text" id="pm_coniugeCognome" name="pm_coniugeCognome" value="<?php echo $coniugeCognome; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeCf_txt">Codice Fiscale *<br/><input type="text" id="pm_coniugeCf" name="pm_coniugeCf" value="<?php echo $coniugeCf; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeStatoCivile_txt">Stato Civile *<br/><input type="text" id="pm_coniugeStatoCivile" name="pm_coniugeStatoCivile" value="<?php echo $coniugeStatoCivile; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeDataNascita_txt">Data di Nascita *<br/><input type="date" id="pm_coniugeDataNascita" name="pm_coniugeDataNascita" value="<?php echo $coniugeDataNascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeLuogoNascita_txt">Luogo di Nascita *<br/><input type="text" id="pm_coniugeLuogoNascita" name="pm_coniugeLuogoNascita" value="<?php echo $coniugeLuogoNascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeStatoNascita_txt">Stato di Nascita *<br/><input type="text" id="pm_coniugeStatoNascita" name="pm_coniugeStatoNascita" value="<?php echo $coniugeStatoNascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeAttoNascita_txt">Atto di Nascita N. *<br/><input type="text" id="pm_coniugeAttoNascita" name="pm_coniugeAttoNascita" value="<?php echo $coniugeAttoNascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeAttoNascitaData_txt">Atto di Nascita Anno *<br/><input type="text" id="pm_coniugeAttoNascitaData" name="pm_coniugeAttoNascitaData" value="<?php echo $coniugeAttoNascitaData; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeVia_txt">Via e Numero civico *<br/><input type="text" id="pm_coniugeVia" name="pm_coniugeVia" value="<?php echo $coniugeVia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeLocalita_txt">Località *<br/><input type="text" id="pm_coniugeLocalita" name="pm_coniugeLocalita" value="<?php echo $coniugeLocalita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeProvincia_txt">Provincia *<br/><input type="text" id="pm_coniugeProvincia" name="pm_coniugeProvincia" value="<?php echo $coniugeProvincia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeEmail_txt">E-mail *<br/><input type="email" id="pm_coniugeEmail" name="pm_coniugeEmail" value="<?php echo $coniugeEmail; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="pm_coniugeTel_txt">Telefono *<br/><input type="tel" id="pm_coniugeTel" name="pm_coniugeTel" value="<?php echo $coniugeTel; ?>" /></p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                            <div class="row">
                                <div class="col-12" id="divButtons">
                                    <button type="button" id="pm_btn_concludi_richiesta" name="pm_btn_concludi_richiesta" class="btn btn-primary">Avanti <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
                                    <button type="button" id="pm_btn_salva_richiesta" name="pm_btn_salva_richiesta" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#SalvaRichiestaModal">Salva richiesta</button>
                                    <button type="button" id="pm_btn_back" class="btn btn-default"><svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</button>
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
                    <button class="btn btn-default btn-sm" id="pm_salva_richiesta_btn_close" type="button" data-bs-dismiss="modal">Chiudi</button>
                    <button class="btn btn-primary btn-sm" id="pm_salva_richiesta_btn_save" type="submit">Salva come bozza</button>
                </div>
            </div>
        </div>
    </div>
    
    
<?php include '../template/footer_servizi.php'; 