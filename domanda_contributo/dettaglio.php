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
    $tmpUploadDocumentazione1 = "";
    $tmpUploadDocumentaziones = "";
    $uploadDocumentazione = "";

    
    /* con l'id vado a richiamare i dati salvati */
    if(isset($_GET["dc_pratica_id"]) && $_GET["dc_pratica_id"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM domanda_contributo WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $_GET["dc_pratica_id"];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $status_id = $row["status_id"];
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

                $inQualitaDi = $row["inQualitaDi"];

                $beneficiarioNome = $row["beneficiarioNome"];
                $beneficiarioCognome = $row["beneficiarioCognome"];
                $beneficiarioCf = $row["beneficiarioCf"];
                $beneficiarioDataNascita = $row["beneficiarioDataNascita"];
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
                
                $tmpUploadDocumentazione1 = substr($row["uploadDocumentazione"],0,-1);
                $tmpUploadDocumentaziones = explode(';', $tmpUploadDocumentazione1);
                $uploadDocumentazione = "";
                foreach($tmpUploadDocumentaziones as $tmpUploadDocumentazione) {
                    $uploadDocumentazione .= "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $tmpUploadDocumentazione ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                }
            }
        }
        $connessione->close();
     }
?>
    <main>
        <div class="container" id="main-container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="cmp-breadcrumbs" role="navigation">
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb p-0" data-element="breadcrumb">
                                <li class="breadcrumb-item"><a href="../bacheca.php">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page"><span class="separator">/</span><a href="../servizi_list.php">Servizi</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Presentare domanda per un contributo</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge">Presentare domanda per un contributo</h1>
                        <p class="subtitle-small">Servizio per la richiesta di sostegno nell'affrontare le spese relative all'assistenza per un familiare non autosufficiente</p>
                        <p>Hai bisogno di assistenza? <a href="mailto:<?php echo $configData['pec_comune']; ?>">Contattaci</a></p>
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
                                                                    <a class="nav-link" href="#dc_richiedente">
                                                                        <span class="title-medium">Richiedente</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#dc_beneficiario">
                                                                        <span class="title-medium">Beneficiario</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#dc_richiesta">
                                                                        <span class="title-medium">Richiesta</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#dc_pagamento">
                                                                        <span class="title-medium">Metodi di pagamento</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#dc_allegati">
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

                    <div class="col-12 col-lg-8 offset-lg-1 body-compilazione-dati">
                        <div class="row">
                            <div class="col-12 p-0  menu-servizi">
                                <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
                                    <div class="row">
                                        <div class="col-12"><span class="active"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>Stato pratica: <b><?php echo NameStatusById($status_id); ?></b></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="it-page-section mb-50 mb-lg-90" id="dc_richiedente">
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
                                                <div class="col-lg-12"><p>Nome<br/><?php echo $nome; ?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Cognome<br/><?php echo $cognome; ?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Codice Fiscale<br/><?php echo $cf; ?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Data di Nascita<br/><?php echo $datanascita; ?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Luogo di Nascita<br/><?php echo $luogonascita; ?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Via e Numero civico<br/><?php echo $richiedenteVia; ?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Località<br/><?php echo $richiedenteLocalita; ?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Provincia<br/><?php echo $richiedenteProvincia; ?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>E-mail<br/><?php echo $email; ?></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Telefono<br/><?php echo $richiedenteTel; ?></p></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div>
                                            <p><b>In qualità di</b></p>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php 
                                            switch($inQualitaDi) {
                                                case "D": echo "diretto interessato"; break;
                                                case "T": echo "tutore"; break;
                                                case "A": echo "amministratore di sostegno"; break;
                                                case "P": echo "procuratore"; break;
                                                case "E": echo "persona delegata"; break;
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-50 mb-lg-90" id="dc_beneficiario">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Beneficiario</h2>
                                        </div>
                                    </div>
                                    <div class="card-body" id="dc_pnl_beneficiario">
                                        <div class="row">
                                            <div class="col-lg-12"><h5 class="color-primary"><b>Anagrafica</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Nome<br/><?php echo $beneficiarioNome; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Cognome<br/><?php echo $beneficiarioCognome; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Codice Fiscale<br/><?php echo $beneficiarioCf; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Data di Nascita<br/><?php echo $beneficiarioDataNascita; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Luogo di Nascita<br/><?php echo $beneficiarioLuogoNascita; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Via e Numero civico<br/><?php echo $beneficiarioVia; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Località<br/><?php echo $beneficiarioLocalita; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Provincia<br/><?php echo $beneficiarioProvincia; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>E-mail<br/><?php echo $beneficiarioEmail; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Telefono<br/><?php echo $beneficiarioTel; ?></p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-50 mb-lg-90" id="dc_richiesta">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Richiesta</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12"><p>Contributo di &euro;<br/><?php echo $importoContributo; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Finalizzato a<br/><?php echo $finalitaContributo; ?></p></div>
                                        </div>                                            
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-50 mb-lg-90" id="dc_pagamento">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
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
                                                    echo '<div class="row mb-3">';
                                                        echo '<div class="col-12"><p>';
                                                            if($row["predefinito"]=='1'){ echo NomeMetodoPagamentoById($row["tipo_pagamento"]) . ' ' . $row["numero_pagamento"]; };
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

                        <div class="it-page-section mb-50 mb-lg-90" id="dc_allegati">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Allegati</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6 text-center">
                                                <h6>Documento che attesta potere di firma</h6>
                                                <ul class="upload-file-list" id="dc_uploadPotereFirma_file">
                                                    <?php echo $uploadPotereFirma; ?>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6 text-center">
                                                <h6>Documentazione utile al riconoscimento del contributo</h6>
                                                <p><small>(esempi: contrato affitto, bollette, spese sanitarie, debiti…)</small></p>
                                                <ul class="upload-file-list" id="dc_uploadDocumentazione_file">
                                                    <?php echo $uploadDocumentazione; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4 text-left-lg text-center mb-20">
                                <a href="..\attivita_list.php" class="btn btn-default"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include '../template/footer_servizi.php'; 