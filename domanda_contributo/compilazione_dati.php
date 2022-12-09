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
    $dc_bozza_id = "";
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

    
    /* se mi viene passato l'id della bozza, vado a richiamare i dati salvati */
    if(isset($_GET["dc_bozza_id"]) && $_GET["dc_bozza_id"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM domanda_contributo WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $_GET["dc_bozza_id"];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $dc_bozza_id = $_GET["dc_bozza_id"];
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
                <div class="col-12 p-0  menu-servizi">
                    <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
                        <div class="row">
                            <div class="col-lg-3 text-center">INFORMATIVA SULLA PRIVACY</div>
                            <div class="col-lg-3 text-center"><span class="active"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>COMPILAZIONE DATI</span></div>
                            <div class="col-lg-3 text-center">TERMINI E CONDIZIONI</div>
                            <div class="col-lg-3 text-center">RIEPILOGO</div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="#" id="dc_frm_dati" method="post" enctype="multipart/form-data">
                <input type="hidden" id="dc_bozza_id" name="dc_bozza_id" value="<?php echo $dc_bozza_id; ?>"/>
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
                                <div class="col-lg-12">
                                    <div id="dc_frm_dati_pnl_return"></div>
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
                                            <div class="row">
                                                <div class="col-lg-12"><h5 class="color-primary"><b>Anagrafica</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_richiedente_nome_txt">Nome *<br/><input type="text" id="dc_richiedente_nome" name="dc_richiedente_nome" value="<?php echo $nome; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_richiedente_cognome_txt">Cognome *<br/><input type="text" id="dc_richiedente_cognome" name="dc_richiedente_cognome" value="<?php echo $cognome; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_richiedente_cf_txt">Codice Fiscale *<br/><input type="text" id="dc_richiedente_cf" name="dc_richiedente_cf" value="<?php echo $cf; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_richiedente_data_nascita_txt">Data di Nascita *<br/><input type="date" id="dc_richiedente_data_nascita" name="dc_richiedente_data_nascita" value="<?php echo $datanascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_richiedente_luogo_nascita_txt">Luogo di Nascita *<br/><input type="text" id="dc_richiedente_luogo_nascita" name="dc_richiedente_luogo_nascita" value="<?php echo $luogonascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_richiedente_via_txt">Via e Numero civico *<br/><input type="text" id="dc_richiedente_via" name="dc_richiedente_via" value="<?php echo $richiedenteVia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_richiedente_localita_txt">Località *<br/><input type="text" id="dc_richiedente_localita" name="dc_richiedente_localita" value="<?php echo $richiedenteLocalita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_richiedente_provincia_txt">Provincia *<br/><input type="text" id="dc_richiedente_provincia" name="dc_richiedente_provincia" value="<?php echo $richiedenteProvincia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_richiedente_email_txt">E-mail *<br/><input type="email" id="dc_richiedente_email" name="dc_richiedente_email" value="<?php echo $email; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_richiedente_tel_txt">Telefono *<br/><input type="tel" id="dc_richiedente_tel" name="dc_richiedente_tel" value="<?php echo $richiedenteTel; ?>" /></p></div>
                                            </div>
                                        </div>
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div>
                                                <p id="dc_rb_qualita_di_txt"><b>In qualità di *</b></p>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="card_rb">
                                                <li><label><input type="radio" id="dc_rb_qualita_di" name="dc_rb_qualita_di" value="D" <?php if($inQualitaDi == "D"){ echo 'checked'; } ?>>diretto interessato</label></li>
                                                <li><label><input type="radio" id="dc_rb_qualita_di" name="dc_rb_qualita_di" value="T" <?php if($inQualitaDi == "T"){ echo 'checked'; } ?>>tutore</label></li>
                                                <li><label><input type="radio" id="dc_rb_qualita_di" name="dc_rb_qualita_di" value="A" <?php if($inQualitaDi == "A"){ echo 'checked'; } ?>>amministratore di sostegno</label></li>
                                                <li><label><input type="radio" id="dc_rb_qualita_di" name="dc_rb_qualita_di" value="P" <?php if($inQualitaDi == "P"){ echo 'checked'; } ?>>procuratore</label></li>
                                                <li><label><input type="radio" id="dc_rb_qualita_di" name="dc_rb_qualita_di" value="E" <?php if($inQualitaDi == "E"){ echo 'checked'; } ?>>persona delegata</label></li>
                                            </ul>
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
                                                <div class="col-lg-12"><p id="dc_beneficiario_nome_txt">Nome *<br/><input type="text" id="dc_beneficiario_nome" name="dc_beneficiario_nome" value="<?php echo $beneficiarioNome; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_beneficiario_cognome_txt">Cognome *<br/><input type="text" id="dc_beneficiario_cognome" name="dc_beneficiario_cognome" value="<?php echo $beneficiarioCognome; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_beneficiario_cf_txt">Codice Fiscale *<br/><input type="text" id="dc_beneficiario_cf" name="dc_beneficiario_cf" value="<?php echo $beneficiarioCf; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_beneficiario_data_nascita_txt">Data di Nascita *<br/><input type="date" id="dc_beneficiario_data_nascita" name="dc_beneficiario_data_nascita" value="<?php echo $beneficiarioDataNascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_beneficiario_luogo_nascita_txt">Luogo di Nascita *<br/><input type="text" id="dc_beneficiario_luogo_nascita" name="dc_beneficiario_luogo_nascita" value="<?php echo $beneficiarioLuogoNascita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_beneficiario_via_txt">Via e Numero civico *<br/><input type="text" id="dc_beneficiario_via" name="dc_beneficiario_via" value="<?php echo $beneficiarioVia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_beneficiario_localita_txt">Località *<br/><input type="text" id="dc_beneficiario_localita" name="dc_beneficiario_localita" value="<?php echo $beneficiarioLocalita; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_beneficiario_provincia_txt">Provincia *<br/><input type="text" id="dc_beneficiario_provincia" name="dc_beneficiario_provincia" value="<?php echo $beneficiarioProvincia; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_beneficiario_email_txt">E-mail *<br/><input type="email" id="dc_beneficiario_email" name="dc_beneficiario_email" value="<?php echo $beneficiarioEmail; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_beneficiario_tel_txt">Telefono *<br/><input type="tel" id="dc_beneficiario_tel" name="dc_beneficiario_tel" value="<?php echo $beneficiarioTel; ?>" /></p></div>
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
                                                <div class="col-lg-12"><p id="dc_importo_contributo_txt">Contributo di &euro; *<br/><input type="text" id="dc_importo_contributo" name="dc_importo_contributo" value="<?php echo $importoContributo; ?>" /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p id="dc_finalita_contributo_txt">Finalizzato a *<br/><textarea id="dc_finalita_contributo" name="dc_finalita_contributo" rows="4"><?php echo $finalitaContributo; ?></textarea></p></div>
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
                                                <h2 class="title-xxlarge mb-3" id="ckb_pagamento_txt">Metodi di pagamento *</h2>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div id="dc_pnl_metodi_pagamento">
                                            <?php
                                                $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                                                $sql = "SELECT * FROM metodi_pagamento WHERE cf = '". $_SESSION['CF']."'";
                                                $result = $connessione->query($sql);

                                                if ($result->num_rows > 0) {
                                                // output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                        echo '<div class="row mb-3">';
                                                            echo '<div class="col-11"><p><label>';
                                                                echo '<input type="radio" id="ckb_pagamento" name="ckb_pagamento" value="'.$row['id'].'" ';
                                                                if($row["predefinito"]=='1'){ echo 'checked'; }
                                                                if($row["predefinito"]==$tipoPagamento_id){ echo 'checked'; }
                                                                echo ' />&nbsp;' . NomeMetodoPagamentoById($row["tipo_pagamento"]) . ' ' . $row["numero_pagamento"];
                                                            echo '</label></p></div>';
                                                            echo '<div class="col-1">';
                                                                echo '<a href="#" class="delete_class" id="'.$row['id'].'" alt="cancella metodo di pagamento" title="cancella metodo di pagamento"><svg class="bg-light icon align-bottom"><use href="../lib/svg/sprites.svg#it-close-circle"></use></svg></a>';
                                                            echo '</div>';
                                                        echo '</div>';
                                                    }
                                                }
                                                $connessione->close();
                                            ?>
                                            </div>
                                            <div id="dc_pnl_new_mdp"></div>

                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <button type="button" class="btn btn-primary width-66" data-bs-toggle="modal" data-bs-target="#AddPagamentoModal"><svg class="icon"><use href="../lib/svg/sprites.svg#it-plus"></use></svg>Aggiungi</button>
                                                </div>
                                            </div>
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
                                                    <h6 id="dc_uploadPotereFirma_txt">Documento che attesta potere di firma</h6>
                                                    <input type="file" name="dc_uploadPotereFirma" id="dc_uploadPotereFirma" class="upload" />
                                                    <label for="dc_uploadPotereFirma">
                                                        <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                        <span>Upload</span>
                                                    </label>
                                                    <ul class="upload-file-list" id="dc_uploadPotereFirma_file">
                                                        <?php echo $uploadPotereFirma; ?>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 text-center">
                                                    <h6 id="dc_uploadDocumentazione_txt">Documentazione utile al riconoscimento del contributo *</h6>
                                                    <p><small>(esempi: contrato affitto, bollette, spese sanitarie, debiti…)</small></p>
                                                    <input type="file" name="dc_uploadDocumentazione[]" id="dc_uploadDocumentazione" class="upload" multiple="multiple" />
                                                    <label for="dc_uploadDocumentazione">
                                                        <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                        <span>Upload</span>
                                                    </label>
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
                                    <button type="button" id="dc_btn_back" class="btn btn-default"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</button>
                                </div>
                                <div class="col-lg-4 text-center mb-20">
                                    <button type="button" id="dc_btn_salva_richiesta" name="dc_btn_salva_richiesta" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#SalvaRichiestaModal">Salva richiesta</button>
                                </div>
                                <div class="col-lg-4 text-right-lg text-center mb-20">
                                    <button type="button" id="dc_btn_concludi_richiesta" name="dc_btn_concludi_richiesta" class="btn btn-primary">Avanti <svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="AddPagamentoModal" aria-labelledby="AddPagamentoModalTitle">
        <div class="modal-dialog" role="document">
            <form method="POST" action="#" name="dc_frm_add_metodo_pagamento" id="dc_frm_add_metodo_pagamento">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title h5 no_toc" id="AddPagamentoModalTitle">Aggiungi metodo di pagamento</h2>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="dc_pnl_return"></div>
                            </div>
                        </div>
                        <div id="dc_pnl_data">
                            <div class="row">
                                <div class="col-lg-12 mt-3 mb-3"><h6>Scegli il metodo di pagamento e inserisci i dati richiesti.</h6></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <select id="dc_sel_tipo_pagamento" name="dc_sel_tipo_pagamento">
                                        <?php echo ViewAllTipiPagamento(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12"><input type="text" id="dc_txt_numero_pagamento" value="" /></p></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-5"><label><input type="checkbox" id="dc_ck_pagamento_predefinito" value="" />&nbsp;E' il pagamento predefinito</label></p></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-sm" id="dc_btn_save" type="submit">Salva</button>
                        <button class="btn btn-primary btn-sm" id="dc_btn_close" type="button" data-bs-dismiss="modal">Chiudi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

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
                    <button class="btn btn-default btn-sm" id="dc_salva_richiesta_btn_close" type="button" data-bs-dismiss="modal">Chiudi</button>
                    <button class="btn btn-primary btn-sm" id="dc_salva_richiesta_btn_save" type="submit">Salva come bozza</button>
                </div>
            </div>
        </div>
    </div>
    
    
<?php include '../template/footer_servizi.php'; 