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
    $am_bozza_id = "";
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

    $minoreNome = "";
    $minoreCognome = "";
    $minoreDataNascita = "";
    $minoreLuogoNascita = "";

    $tipoRichiesta = "";

    $DichiarazioneCittadinanza = "";
    $DichiarazioneSoggiornoNumero = "";
    $DichiarazioneSoggiornoQuestura = "";
    $DichiarazioneSoggiornoData = "";
    $DichiarazioneSoggiornoDataRinnovo = "";
    $DichiarazioneAffidamento = "";
    $DichiarazioneAffidamentoData = "";

    $tipoPagamento_id = "";

    $uploadCartaIdentitaFronte = "";
    $uploadCartaIdentitaRetro = "";
    $uploadTitoloSoggiorno = "";
    $uploadDichiarazioneDatoreLavoro = "";

    
    /* se mi viene passato l'id della bozza, vado a richiamare i dati salvati */
    if(isset($_POST["am_bozza_id"]) && $_POST["am_bozza_id"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM assegno_maternita WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $_POST["am_bozza_id"];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $am_bozza_id = $_POST["am_bozza_id"];
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
                
                $minoreNome = $row["minoreNome"];
                $minoreCognome = $row["minoreCognome"];
                $minoreDataNascita = $row["minoreDataNascita"];
                $minoreLuogoNascita = $row["minoreLuogoNascita"];

                $tipoRichiesta = $row["tipoRichiesta"];

                $DichiarazioneCittadinanza = $row["DichiarazioneCittadinanza"];
                $DichiarazioneSoggiornoNumero = $row["DichiarazioneSoggiornoNumero"];
                $DichiarazioneSoggiornoQuestura = $row["DichiarazioneSoggiornoQuestura"];
                $DichiarazioneSoggiornoData = $row["DichiarazioneSoggiornoData"];
                $DichiarazioneSoggiornoDataRinnovo = $row["DichiarazioneSoggiornoDataRinnovo"];
                $DichiarazioneAffidamento = $row["DichiarazioneAffidamento"];
                $DichiarazioneAffidamentoData = $row["DichiarazioneAffidamentoData"];

                $tipoPagamento_id = $row["tipoPagamento_id"];

                $uploadCartaIdentitaFronte = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaFronte"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                $uploadCartaIdentitaRetro = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaRetro"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                $uploadTitoloSoggiorno = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadTitoloSoggiorno"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                $uploadDichiarazioneDatoreLavoro = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadDichiarazioneDatoreLavoro"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
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
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Presentare domanda per assegno di maternità</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge">Presentare domanda per assegno di maternità</h1>
                        <p class="subtitle-small">Servizio per la fruizione di contributo economico concesso alle madri non occupate o non aventi diritto al trattamento di maternità, per nascite, adozioni e affidamenti preadottivi.</p>
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
            <form action="#" id="am_frm_dati" method="post" enctype="multipart/form-data">
                <input type="hidden" id="am_bozza_id" name="am_bozza_id" value="<?php echo $am_bozza_id; ?>"/>
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
                                                                        <a class="nav-link" href="#am_richiedente">
                                                                            <span class="title-medium">Richiedente</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#am_minore">
                                                                            <span class="title-medium">Minore</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#am_richiesta">
                                                                            <span class="title-medium">Richiesta</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#am_dichiarazioni">
                                                                            <span class="title-medium">Dichiarazioni</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#am_pagamento">
                                                                            <span class="title-medium">Metodi di pagamento</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#am_allegati">
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
                                    <div id="am_frm_dati_pnl_return"></div>
                                </div>
                            </div>
                            <div class="it-page-section mb-50 mb-lg-90" id="am_richiedente">
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
                                                <div class="col-lg-12"><p>Nome<br/><input type="text" id="am_richiedente_nome" name="am_richiedente_nome" value="<?php echo $nome; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Cognome<br/><input type="text" id="am_richiedente_cognome" name="am_richiedente_cognome" value="<?php echo $cognome; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Codice Fiscale<br/><input type="text" id="am_richiedente_cf" name="am_richiedente_cf" value="<?php echo $cf; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Data di Nascita<br/><input type="text" id="am_richiedente_data_nascita" name="am_richiedente_data_nascita" value="<?php echo $datanascita; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Luogo di Nascita<br/><input type="text" id="am_richiedente_luogo_nascita" name="am_richiedente_luogo_nascita" value="<?php echo $luogonascita; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Via e Numero civico<br/><input type="text" id="am_richiedente_via" name="am_richiedente_via" value="<?php echo $richiedenteVia; ?>" required /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Località<br/><input type="text" id="am_richiedente_localita" name="am_richiedente_localita" value="<?php echo $richiedenteLocalita; ?>" required /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Provincia<br/><input type="text" id="am_richiedente_provincia" name="am_richiedente_provincia" value="<?php echo $richiedenteProvincia; ?>" required /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12 mt-50"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>E-mail<br/><input type="text" id="am_richiedente_email" name="am_richiedente_email" value="<?php echo $email; ?>" disabled /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Telefono<br/><input type="text" id="am_richiedente_tel" name="am_richiedente_tel" value="<?php echo $richiedenteTel; ?>" required /></p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="it-page-section mb-50 mb-lg-90" id="am_minore">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Minore</h2>
                                            </div>
                                        </div>
                                        <div class="card-body" id="am_pnl_beneficiario">
                                            <div class="row">
                                                <div class="col-lg-12"><h5 class="color-primary"><b>Anagrafica</b></h5></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Nome<br/><input type="text" id="am_minoreNome" name="am_minoreNome" value="<?php echo $minoreNome; ?>" required /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Cognome<br/><input type="text" id="am_minoreCognome" name="am_minoreCognome" value="<?php echo $minoreCognome; ?>" required /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Data di Nascita<br/><input type="text" id="am_minoreDataNascita" name="am_minoreDataNascita" value="<?php echo $minoreDataNascita; ?>" required /></p></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12"><p>Luogo di Nascita<br/><input type="text" id="am_minoreLuogoNascita" name="am_minoreLuogoNascita" value="<?php echo $minoreLuogoNascita; ?>" required /></p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="it-page-section mb-50 mb-lg-90" id="am_richiesta">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Richiesta</h2>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul class="card_rb">
                                                        <li><label><input type="radio" id="am_tipoRichiesta" name="am_tipoRichiesta" value="AM" <?php if($tipoRichiesta == "AM"){ echo 'checked'; } ?>>assegno di maternità</label></li>
                                                        <li><label><input type="radio" id="am_tipoRichiesta" name="am_tipoRichiesta" value="QD" <?php if($tipoRichiesta == "QD"){ echo 'checked'; } ?>>quota differenziale dell’assegno di maternità</label></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="it-page-section mb-50 mb-lg-90" id="am_dichiarazioni">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Dichiarazioni</h2>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <p>Dichiaro di:</p>
                                                    <ul class="card_rb">
                                                        <li><label><input type="radio" id="am_DichiarazioneCittadinanza" name="am_DichiarazioneCittadinanza" value="I" <?php if($DichiarazioneCittadinanza == "I"){ echo 'checked'; } ?>>di essere cittadina italiana o di uno stato appartenente all’Unione Europea;</label></li>
                                                        <li><label><input type="radio" id="am_DichiarazioneCittadinanza" name="am_DichiarazioneCittadinanza" value="E" <?php if($DichiarazioneCittadinanza == "E"){ echo 'checked'; } ?>>di essere cittadina extracomunitaria in possesso di titolo di soggiorno in corso di validità;</label></li>
                                                    </ul>
                                                    <div id="am_DichiarazioneSoggiorno" name="am_DichiarazioneSoggiorno">
                                                        <p>Numero titolo di soggiorno<br/><input type="text" id="am_DichiarazioneSoggiornoNumero" name="am_DichiarazioneSoggiornoNumero" value="<?php echo $DichiarazioneSoggiornoNumero; ?>" required /></p>
                                                        <p>Rilasciato dalla Questura di<br/><input type="text" id="am_DichiarazioneSoggiornoQuestura" name="am_DichiarazioneSoggiornoQuestura" value="<?php echo $DichiarazioneSoggiornoQuestura; ?>" required /></p>
                                                        <p>Data Rilascio<br/><input type="text" id="am_DichiarazioneSoggiornoData" name="am_DichiarazioneSoggiornoData" value="<?php echo $DichiarazioneSoggiornoData; ?>" required /></p>
                                                        <p>oppure</p>
                                                        <p>Data Richiesta rinnovo<br/><input type="text" id="am_DichiarazioneSoggiornoDataRinnovo" name="am_DichiarazioneSoggiornoDataRinnovo" value="<?php echo $DichiarazioneSoggiornoDataRinnovo; ?>" required /></p>
                                                        <p>In quanto appartenente ad una delle seguenti tipologie:
                                                        <ul>
                                                            <li>permesso di soggiorno CE per soggiornanti di lungo periodo;</li>
                                                            <li>altro tipo di permesso valido che consente l’esercizio dell’attività lavorativa;</li>
                                                        </ul>
                                                    </div>
                                                    <p><label><input type="checkbox" id="am_DichiarazioneAffidamento" name="am_DichiarazioneAffidamento" value="I" <?php if($DichiarazioneAffidamento == 1){ echo 'checked'; } ?>> che il figlio per il quale viene richiesto l’assegno di maternità è in affidamento</label> 
                                                    <p>Data Inizio affidamento (in caso di adozione o affidamento preadottivo)<br/><input type="text" id="am_DichiarazioneAffidamentoData" name="am_DichiarazioneAffidamentoData" value="<?php echo $DichiarazioneAffidamentoData; ?>" required /></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="it-page-section mb-50 mb-lg-90" id="am_pagamento">
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
                                                            echo '<div class="col-12"><p><label>';
                                                                echo '<input type="radio" id="ckb_pagamento" name="ckb_pagamento" value="'.$row['id'].'" ';
                                                                if($row["predefinito"]=='1'){ echo 'checked'; }
                                                                if($row["predefinito"]==$tipoPagamento_id){ echo 'checked'; }
                                                                echo ' />&nbsp;' . NomeMetodoPagamentoById($row["tipo_pagamento"]) . ' ' . $row["numero_pagamento"];
                                                            echo '</label></p></div>';
                                                        echo '</div>';
                                                    }
                                                }
                                                $connessione->close();
                                            ?>
                                            <div id="am_pnl_new_mdp"></div>

                                            <div class="row">
                                                <div class="col-12 text-center">
                                                    <button type="button" class="btn btn-primary width-66" data-bs-toggle="modal" data-bs-target="#AddPagamentoModal"><svg class="icon"><use href="../lib/svg/sprites.svg#it-plus"></use></svg>Aggiungi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="it-page-section mb-50 mb-lg-90" id="am_allegati">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Allegati</h2>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 text-center mb-50">
                                                    <h6>Documento di identità (fronte)</h6>
                                                    <input type="file" name="am_uploadCartaIdentitaFronte" id="am_uploadCartaIdentitaFronte" class="upload" />
                                                    <label for="am_uploadCartaIdentitaFronte">
                                                        <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                        <span>Upload</span>
                                                    </label>
                                                    <ul class="upload-file-list" id="am_uploadCartaIdentitaFronte_file">
                                                        <?php echo $uploadCartaIdentitaFronte; ?>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6 text-center mb-50">
                                                    <h6>Documento di identità (retro)</h6>
                                                    <input type="file" name="am_uploadCartaIdentitaRetro" id="am_uploadCartaIdentitaRetro" class="upload" />
                                                    <label for="am_uploadCartaIdentitaRetro">
                                                        <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                        <span>Upload</span>
                                                    </label>
                                                    <ul class="upload-file-list" id="am_uploadCartaIdentitaRetro_file">
                                                        <?php echo $uploadCartaIdentitaRetro; ?>
                                                    </ul>
                                                </div>
                                                
                                                <div class="col-lg-6 text-center">
                                                    <h6>Copia titolo di soggiorno<br/>oppure</br>ricevuta della richiesta di rilascio del permesso di soggiorno</h6>
                                                    <input type="file" name="am_uploadTitoloSoggiorno" id="am_uploadTitoloSoggiorno" class="upload" />
                                                    <label for="am_uploadTitoloSoggiorno">
                                                        <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                        <span>Upload</span>
                                                    </label>
                                                    <ul class="upload-file-list" id="am_uploadTitoloSoggiorno_file">
                                                        <?php echo $uploadTitoloSoggiorno; ?>
                                                    </ul>                                                    
                                                </div>
                                                <div class="col-lg-6 text-center">
                                                    <h6>Copia della dichiarazione del datore di lavoro relativa all’importo percepito per la maternità</h6>
                                                    <p><small>(nel caso di richiesta della quota differenziale dell’assegno di maternità)</small></p>
                                                    <input type="file" name="am_uploadDichiarazioneDatoreLavoro" id="am_uploadDichiarazioneDatoreLavoro" class="upload" />
                                                    <label for="am_uploadDichiarazioneDatoreLavoro">
                                                        <svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-upload"></use></svg>
                                                        <span>Upload</span>
                                                    </label>
                                                    <ul class="upload-file-list" id="am_uploadDichiarazioneDatoreLavoro_file">
                                                        <?php echo $uploadDichiarazioneDatoreLavoro; ?>
                                                    </ul>                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-4 text-left-lg text-center mb-20">
                                    <button type="button" id="am_btn_back" class="btn btn-default"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</button>
                                </div>
                                <div class="col-lg-4 text-center mb-20">
                                    <button type="button" id="am_btn_salva_richiesta" name="am_btn_salva_richiesta" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#SalvaRichiestaModal">Salva richiesta</button>
                                </div>
                                <div class="col-lg-4 text-right-lg text-center mb-20">
                                    <button type="button" id="am_btn_concludi_richiesta" name="am_btn_concludi_richiesta" class="btn btn-primary">Avanti <svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
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
            <form method="POST" action="#" name="am_frm_add_metodo_pagamento" id="am_frm_add_metodo_pagamento">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title h5 no_toc" id="AddPagamentoModalTitle">Aggiungi metodo di pagamento</h2>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="am_pnl_return"></div>
                            </div>
                        </div>
                        <div id="am_pnl_data">
                            <div class="row">
                                <div class="col-lg-12 mt-3 mb-3"><h6>Scegli il metodo di pagamento e inserisci i dati richiesti.</h6></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <select id="am_sel_tipo_pagamento">
                                        <?php echo ViewAllTipiPagamento(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12"><input type="text" id="am_txt_numero_pagamento" value="" maxlength="25" /></p></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-5"><label><input type="checkbox" id="am_ck_pagamento_predefinito" value="" />&nbsp;E' il pagamento predefinito</label></p></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary btn-sm" id="am_btn_save" type="submit">Salva</button>
                        <button class="btn btn-primary btn-sm" id="am_btn_close" type="button" data-bs-dismiss="modal">Chiudi</button>
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
                    <button class="btn btn-default btn-sm" id="am_salva_richiesta_btn_close" type="button" data-bs-dismiss="modal">Chiudi</button>
                    <button class="btn btn-primary btn-sm" id="am_salva_richiesta_btn_save" type="submit">Salva come bozza</button>
                </div>
            </div>
        </div>
    </div>
    
    
<?php include '../template/footer_servizi.php'; 