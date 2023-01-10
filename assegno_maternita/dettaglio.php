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
    $NumeroPratica = "";
    $NumeroProtocollo = "";
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
    $data_compilazione = "";

    
    /* con l'id vado a richiamare i dati salvati */
    if(isset($_GET["am_pratica_id"]) && $_GET["am_pratica_id"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM assegno_maternita WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $_GET["am_pratica_id"];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $status_id = $row["status_id"];
                $NumeroPratica = $row["NumeroPratica"];
                $NumeroProtocollo = $row["NumeroProtocollo"];
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
                
                $minoreNome = $row["minoreNome"];
                $minoreCognome = $row["minoreCognome"];
                $minoreDataNascita = date("d/m/Y", strtotime($row["minoreDataNascita"]));
                $minoreLuogoNascita = $row["minoreLuogoNascita"];

                $tipoRichiesta = $row["tipoRichiesta"];

                $DichiarazioneCittadinanza = $row["DichiarazioneCittadinanza"];
                $DichiarazioneSoggiornoNumero = $row["DichiarazioneSoggiornoNumero"];
                $DichiarazioneSoggiornoQuestura = $row["DichiarazioneSoggiornoQuestura"];
                $DichiarazioneSoggiornoData = date("d/m/Y", strtotime($row["DichiarazioneSoggiornoData"]));
                $DichiarazioneSoggiornoDataRinnovo = date("d/m/Y", strtotime($row["DichiarazioneSoggiornoDataRinnovo"]));
                $DichiarazioneAffidamento = $row["DichiarazioneAffidamento"];
                $DichiarazioneAffidamentoData = date("d/m/Y", strtotime($row["DichiarazioneAffidamentoData"]));

                $tipoPagamento_id = $row["tipoPagamento_id"];

                $uploadCartaIdentitaFronte = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaFronte"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                $uploadCartaIdentitaRetro = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadCartaIdentitaRetro"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                $uploadTitoloSoggiorno = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadTitoloSoggiorno"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
                $uploadDichiarazioneDatoreLavoro = "<li class='upload-file success'><svg class='icon icon-sm' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-file'></use></svg><p><span class='visually-hidden'>File caricato:</span>". $row["uploadDichiarazioneDatoreLavoro"] ."</p><button disabled><svg class='icon' aria-hidden='true'><use href='../lib/svg/sprites.svg#it-check'></use></svg></button></li>";
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
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Presentare domanda per assegno di maternità</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge">Presentare domanda per assegno di maternità</h1>
                        <p class="subtitle-small">Servizio per la fruizione di contributo economico concesso alle madri non occupate o non aventi diritto al trattamento di maternità, per nascite, adozioni e affidamenti preadottivi.</p>
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
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#am_prossimi_passi">
                                                                        <span class="title-medium">Prossimi passi</span>
                                                                    </a>
                                                                </li>
                                                                <?php if(!CheckRatingByCfService($_SESSION['CF'],'9')){ ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#am_valuta_servizio">
                                                                            <span class="title-medium">Valuta il servizio</span>
                                                                        </a>
                                                                    </li>
                                                                <?php }else{ 
                                                                    if(CheckMyRatingService($_GET["am_pratica_id"])){?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#am_valuta_servizio">
                                                                            <span class="title-medium">Valutazione del servizio</span>
                                                                        </a>
                                                                    </li>                                                                    
                                                                <?php }
                                                                } ?>
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
                                <div class="cmp-nav-tab mb-4 mt-20">
                                    <div class="row">
                                        <div class="col-12 col-xl-4">
                                            <span class="active"><svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>Stato pratica: <b><?php echo NameStatusById($status_id); ?></b></span>
                                        </div>
                                        <div class="col-12 col-xl-4">
                                            <span class="active"><svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>Numero pratica: <b><?php echo $NumeroPratica; ?></b></span>
                                        </div>
                                        <div class="col-12 col-xl-4">
                                            <?php if($configDB['ProtocollazioneAttiva']){ ?>
                                                <span class="active"><svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>Numero protocollo: <b><?php echo $NumeroProtocollo; ?></b></span>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-30" id="am_richiedente">
                            <div class="cmp-card">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-30" id="am_minore">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Minore</h2>
                                        </div>
                                    </div>
                                    <div class="card-body" id="am_pnl_beneficiario">
                                        <div class="row">
                                            <div class="col-lg-12"><h5 class="color-primary"><b>Anagrafica</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>Nome <b><?php echo $minoreNome; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Cognome <b><?php echo $minoreCognome; ?></b></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>Data di Nascita <b><?php echo $minoreDataNascita; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Luogo di Nascita <b><?php echo $minoreLuogoNascita; ?></b></p></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-30" id="am_richiesta">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Richiesta</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12"><p class="m-0">
                                                <?php 
                                                    switch($tipoRichiesta) {
                                                        case "AM": echo "Assegno di maternità"; break;
                                                        case "QD": echo "Quota differenziale dell’assegno di maternità"; break;
                                                    }
                                                ?>
                                            </p></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-30" id="am_dichiarazioni">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Dichiarazioni</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="m-0">Dichiaro
                                                <?php 
                                                    switch($DichiarazioneCittadinanza) {
                                                        case "I": echo " di essere cittadina italiana o di uno stato appartenente all’Unione Europea"; break;
                                                        case "E": echo " di essere cittadina extracomunitaria in possesso di titolo di soggiorno in corso di validità"; break;
                                                    }
                                                ?>
                                                </p>
                                                <?php if($DichiarazioneCittadinanza == "E"){ ?>
                                                    <div>
                                                        <p>Numero titolo di soggiorno<br/><?php echo $DichiarazioneSoggiornoNumero; ?></p>
                                                        <p>Rilasciato dalla Questura di<br/><?php echo $DichiarazioneSoggiornoQuestura; ?></p>
                                                        <?php if($DichiarazioneSoggiornoData <> ''){ ?>
                                                            <p>Data Rilascio<br/><?php echo $DichiarazioneSoggiornoData; ?></p>
                                                        <?php }else{ ?>
                                                            <p>Data Richiesta rinnovo<br/><?php echo $DichiarazioneSoggiornoDataRinnovo; ?></p>
                                                        <?php } ?>
                                                        <p>In quanto appartenente ad una delle seguenti tipologie:
                                                        <ul>
                                                            <li>permesso di soggiorno CE per soggiornanti di lungo periodo;</li>
                                                            <li>altro tipo di permesso valido che consente l’esercizio dell’attività lavorativa;</li>
                                                        </ul>
                                                    </div>
                                                <?php } ?>
                                                <?php if($DichiarazioneAffidamento == 1){
                                                    echo '<p>che il figlio per il quale viene richiesto l’assegno di maternità è in affidamento</p>'; 
                                                    echo '<p>Data Inizio affidamento (in caso di adozione o affidamento preadottivo): '. $DichiarazioneAffidamentoData . '</p>';
                                                } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="it-page-section mb-30" id="am_pagamento">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge">Metodi di pagamento</h2>
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

                        <div class="it-page-section mb-30" id="am_allegati">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge">Allegati</h2>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-md-8 mb-3">
                                                        <h6>Documento di identità (fronte)</h6>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="upload-file-list" id="am_uploadCartaIdentitaFronte_file">
                                                            <?php echo $uploadCartaIdentitaFronte; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 after-section">
                                                <div class="row">
                                                    <div class="col-md-8 mb-3">
                                                        <h6>Documento di identità (retro)</h6>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <ul class="upload-file-list" id="am_uploadCartaIdentitaRetro_file">
                                                            <?php echo $uploadCartaIdentitaRetro; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if($uploadTitoloSoggiorno != ''){ ?>
                                                <div class="col-12 after-section">
                                                    <div class="row">
                                                        <div class="col-md-8 mb-3">
                                                            <h6>Copia titolo di soggiorno oppure</br>ricevuta della richiesta di rilascio del permesso di soggiorno</h6>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <ul class="upload-file-list" id="am_uploadTitoloSoggiorno_file">
                                                                <?php echo $uploadTitoloSoggiorno; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <?php if($uploadDichiarazioneDatoreLavoro != ''){ ?>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-8 mb-3">
                                                            <h6>Copia della dichiarazione del datore di lavoro relativa all’importo percepito per la maternità</h6>
                                                            <p><small>(nel caso di richiesta della quota differenziale dell’assegno di maternità)</small></p>
                                                        </div>
                                                        <div class="col-4">
                                                            <ul class="upload-file-list" id="am_uploadDichiarazioneDatoreLavoro_file">
                                                                <?php echo $uploadDichiarazioneDatoreLavoro; ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="it-page-section mb-30" id="am_prossimi_passi">
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
                                                                <span class="date-step-giorno"><?php echo date('d', strtotime($data_compilazione. ' + 30 days')); ?></span><br>
                                                                <span class="date-step-mese"><?php echo date('M/Y', strtotime($data_compilazione. ' + 30 days')); ?></span>
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
                        if(!CheckRatingByCfService($_SESSION['CF'],'9')){
                            echo CallRatingLayout('am_',$_GET["am_pratica_id"],9);
                        }else{
                            echo ViewMyRatingStar('am_',$_GET["am_pratica_id"]);
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