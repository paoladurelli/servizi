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
    $nome = "";
    $cognome = "";
    $email = "";
    $datanascita = "";
    $luogonascita = "";
    $richiedenteVia = "";
    $richiedenteLocalita = "";
    $richiedenteProvincia = "";
    $richiedenteTel = "";
    $inQualitaDi = "";
    $beneficiarioNome = "";
    $beneficiarioCognome = "";
    $beneficiarioCf = "";
    $beneficiarioDataNascita = "";
    $beneficiarioLuogoNascita = "";
    $beneficiarioVia = "";
    $beneficiarioLocalita = "";
    $beneficiarioProvincia = "";
    $beneficiarioEmail = "";
    $beneficiarioTel = "";
    $importoContributo = "";
    $finalitaContributo = "";
    $tipoPagamento_id = "";
    $uploadPotereFirma = "";
    $uploadIsee = "";
    $tmpUploadDocumentazione1 = "";
    $tmpUploadDocumentaziones = "";
    $uploadDocumentazione = "";
    $data_compilazione = "";

    
    /* con l'id vado a richiamare i dati salvati */
    if(isset($_GET["be_pratica_id"]) && $_GET["be_pratica_id"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM bonus_economici WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $_GET["be_pratica_id"];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $status_id = $row["status_id"];
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

                $inQualitaDi = $row["inQualitaDi"];

                $beneficiarioNome = $row["beneficiarioNome"];
                $beneficiarioCognome = $row["beneficiarioCognome"];
                $beneficiarioCf = $row["beneficiarioCf"];
                $beneficiarioDataNascita = date("d/m/Y", strtotime($row["beneficiarioDataNascita"]));
                $beneficiarioLuogoNascita = $row["beneficiarioLuogoNascita"];
                $beneficiarioVia = $row["beneficiarioVia"];
                $beneficiarioLocalita = $row["beneficiarioLocalita"];
                $beneficiarioProvincia = $row["beneficiarioProvincia"];
                $beneficiarioEmail = $row["beneficiarioEmail"];
                $beneficiarioTel = $row["beneficiarioTel"];

                $importoContributo = $row["importoContributo"];
                $finalitaContributo = $row["finalitaContributo"];

                $tipoPagamento_id = $row["tipoPagamento_id"];

                $uploadPotereFirma = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadPotereFirma"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                
                $uploadIsee = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadIsee"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                
                $tmpUploadDocumentazione1 = substr($row["uploadDocumentazione"],0,-1);
                $tmpUploadDocumentaziones = explode(';', $tmpUploadDocumentazione1);
                $uploadDocumentazione = "";
                foreach($tmpUploadDocumentaziones as $tmpUploadDocumentazione) {
                    $uploadDocumentazione .= "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $tmpUploadDocumentazione ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                }
                $data_compilazione = $row["data_compilazione"];
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
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Presentare domanda per bonus economici</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge">Presentare domanda per bonus economici</h1>
                        <p class="subtitle-small">Sovvenzioni erogate per consentire il risparmio sulla spesa per specifici servizi e/o beni, riservato ai cittadini che abbiano i requisiti stabiliti per accedere alla fruizione del vantaggio.</p>
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
                                                        </button>
                                                    </span>
                                                    <div class="progress">
                                                        <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                                        <div class="accordion-body">
                                                            <ul class="link-list" data-element="page-index">
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#be_richiedente">
                                                                        <span class="title-medium">Richiedente</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#be_beneficiario">
                                                                        <span class="title-medium">Beneficiario</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#be_richiesta">
                                                                        <span class="title-medium">Richiesta</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#be_pagamento">
                                                                        <span class="title-medium">Metodi di pagamento</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#be_allegati">
                                                                        <span class="title-medium">Allegati</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#be_prossimi_passi">
                                                                        <span class="title-medium">Prossimi passi</span>
                                                                    </a>
                                                                </li>
                                                                <?php if(!CheckRatingByCfService($_SESSION['CF'],'10')){ ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#be_valuta_servizio">
                                                                            <span class="title-medium">Valuta il servizio</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

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
                            <div class="col-12 menu-servizi">
                                <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
                                    <div class="row">
                                        <div class="col-12"><span class="active"><svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>Stato pratica: <b><?php echo NameStatusById($status_id); ?></b></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="it-page-section" id="be_richiedente">
                            <div class="cmp-card mb-30">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                        <div>
                                            <h2 class="title-xxlarge mb-3">Richiedente</h2>
                                            <p><b>Informazioni su di te</b></p>
                                        </div>
                                    </div>
                                    <div class="card-body">
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
                                                <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
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
                                                <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Contatti</b></h5></div>
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
                                            <div class="row">
                                                <div class="col-lg-12 mt-3">
                                                    <p class="m-0"><b>In qualità di</b> 
                                                    <?php 
                                                        switch($inQualitaDi) {
                                                            case "D": echo "diretto interessato"; break;
                                                            case "T": echo "tutore"; break;
                                                            case "A": echo "amministratore di sostegno"; break;
                                                            case "P": echo "procuratore"; break;
                                                            case "E": echo "persona delegata"; break;
                                                        }
                                                    ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section" id="be_beneficiario">
                            <div class="cmp-card mb-30">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Beneficiario</h2>
                                        </div>
                                    </div>
                                    <div class="card-body" id="be_pnl_beneficiario">
                                        <div class="row">
                                            <div class="col-lg-12"><h5 class="color-primary"><b>Anagrafica</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"<p>Nome <b><?php echo $beneficiarioNome; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Cognome <b><?php echo $beneficiarioCognome; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Codice Fiscale <b><?php echo $beneficiarioCf; ?></b></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>Data di Nascita <b><?php echo $beneficiarioDataNascita; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-12"><p>Luogo di Nascita <b><?php echo $beneficiarioLuogoNascita; ?></b></p></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>Località <b><?php echo $beneficiarioLocalita; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Provincia <b><?php echo $beneficiarioProvincia; ?></b></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>Via e Numero civico <b><?php echo $beneficiarioVia; ?></b></p></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>E-mail <b><?php echo $beneficiarioEmail; ?></b></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>Telefono <b><?php echo $beneficiarioTel; ?></b></p></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section" id="be_richiesta">
                            <div class="cmp-card mb-30">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Richiesta</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12"><p>Contributo di &euro; <b><?php echo $importoContributo; ?></b></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12"><p class="m-0">Finalizzato a <b><?php echo $finalitaContributo; ?></b></p></div>
                                        </div>                                            
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section" id="be_pagamento">
                            <div class="cmp-card mb-30">
                                <div class="card">
                                    <div class="card-header border-0 p-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Metodi di pagamento</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                            $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                                            $sql = "SELECT * FROM metodi_pagamento WHERE cf = '". $_SESSION['CF']."'";
                                            $result = $connessione->query($sql);

                                            if ($result->num_rows > 0) {
                                            // output data of each row
                                                while($row = $result->fetch_assoc()) {
                                                    echo '<div class="row">';
                                                        echo '<div class="col-12"><p class="m-0">';
                                                            if($row["id"]==$tipoPagamento_id){ echo NomeMetodoPagamentoById($row["tipo_pagamento"]) . ' ' . $row["numero_pagamento"]; }
                                                        echo '</p></div>';
                                                    echo '</div>';
                                                }
                                            }
                                            $connessione->close();
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section" id="be_allegati">
                            <div class="cmp-card mb-30">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Allegati</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php if($uploadPotereFirma!='' && $inQualitaDi != "D"){ ?>
                                                <div class="col-12 after-section">
                                                    <div class="row">
                                                        <div class="col-md-8 mb-3">
                                                            <h6>Documento che attesta potere di firma</h6>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="upload-file-list" id="be_uploadPotereFirma_file">
                                                                <?php echo $uploadPotereFirma; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-md-8 mb-3">
                                                        <h6>ISEE</h6>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="upload-file-list" id="be_uploadIsee_file">
                                                            <?php echo $uploadIsee; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-md-8 mb-3">
                                                        <h6>Documentazione utile al riconoscimento del contributo</h6>
                                                        <p><small>(esempi: contratto affitto, bollette, spese sanitarie, debiti…)</small></p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="upload-file-list" id="be_uploadDocumentazione_file">
                                                            <?php echo $uploadDocumentazione; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-30" id="be_prossimi_passi">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div>
                                            <h2 class="title-xxlarge mb-3">Prossimi passi</h2>
                                        </div>
                                    </div>
                                    <div class="card-body mb-0">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row stepper">
                                                    <div class="offset-md-1 col-md-11 col-12">
                                                        <div class="step">
                                                            <div class="date-step">
                                                                <span class="date-step-giorno"><?php echo date("d", strtotime($data_compilazione)); ?></span><br>
                                                                <span class="date-step-mese"><?php echo date("M/Y", strtotime($data_compilazione)); ?></span>
                                                                <span class="pallino"></span>
                                                            </div>
                                                            <div class="testo-step">
                                                                <div class="scheda-gestione">
                                                                    <p>Data invio richiesta</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $Date = date('Y-m-d'); ?>

                                                        <div class="step">
                                                            <div class="date-step">
                                                                <span class="date-step-giorno"><?php echo date('d', strtotime($data_compilazione. ' + 10 days')); ?></span><br>
                                                                <span class="date-step-mese"><?php echo date('M/Y', strtotime($data_compilazione. ' + 10 days')); ?></span>
                                                                <span class="pallino"></span>
                                                            </div>
                                                            <div class="testo-step">
                                                                <div class="scheda-gestione">
                                                                    <p>Data esito richiesta</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php 
                        if(!CheckRatingByCfService($_SESSION['CF'],'10')){ 
                            echo CallRatingLayout('be_',$_GET["be_pratica_id"],10);
                        }
                        ?>                        
                        <div class="row">
                            <div class="col-12 text-right mb-20">
                                <a href="..\attivita_list.php" class="btn btn-secondary mr-lg-40"><svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true" fill="#fff"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include '../template/footer_servizi.php'; 