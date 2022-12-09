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
                            <div class="col-12 p-0  menu-servizi">
                                <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
                                    <div class="row">
                                        <div class="col-12"><span class="active"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>Stato pratica: <b><?php echo NameStatusById($status_id); ?></b></span></div>
                                    </div>
                                </div>
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

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOther" aria-expanded="false" aria-controls="collapseOther">Altri dati</button>
                                            </h2>
                                            <div id="collapseOther" class="accordion-collapse collapse" aria-labelledby="headingOther" data-bs-parent="#accordionOther">
                                                <div class="accordion-body">
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
                                            <div class="col-lg-12"><p>Nome<br/><?php echo $minoreNome; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Cognome<br/><?php echo $minoreCognome; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Data di Nascita<br/><?php echo $minoreDataNascita; ?></p></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12"><p>Luogo di Nascita<br/><?php echo $minoreLuogoNascita; ?></p></div>
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
                                                <?php 
                                                    switch($tipoRichiesta) {
                                                        case "AM": echo "Assegno di maternità"; break;
                                                        case "QD": echo "Quota differenziale dell’assegno di maternità"; break;
                                                    }
                                                ?>
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
                                                <p>Dichiaro
                                                <?php 
                                                    switch($DichiarazioneCittadinanza) {
                                                        case "I": echo " di essere cittadina italiana o di uno stato appartenente all’Unione Europea"; break;
                                                        case "E": echo " di essere cittadina extracomunitaria in possesso di titolo di soggiorno in corso di validità"; break;
                                                    }
                                                ?>
                                                </p>
                                                <div id="am_DichiarazioneSoggiorno" name="am_DichiarazioneSoggiorno">
                                                    <p>Numero titolo di soggiorno<br/><?php echo $DichiarazioneSoggiornoNumero; ?></p>
                                                    <p>Rilasciato dalla Questura di<br/><?php echo $DichiarazioneSoggiornoQuestura; ?></p>
                                                    <p>Data Rilascio<br/><?php echo $DichiarazioneSoggiornoData; ?></p>
                                                    <p>oppure</p>
                                                    <p>Data Richiesta rinnovo<br/><?php echo $DichiarazioneSoggiornoDataRinnovo; ?></p>
                                                    <p>In quanto appartenente ad una delle seguenti tipologie:
                                                    <ul>
                                                        <li>permesso di soggiorno CE per soggiornanti di lungo periodo;</li>
                                                        <li>altro tipo di permesso valido che consente l’esercizio dell’attività lavorativa;</li>
                                                    </ul>
                                                </div>
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
                                                <ul class="upload-file-list" id="am_uploadCartaIdentitaFronte_file">
                                                    <?php echo $uploadCartaIdentitaFronte; ?>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6 text-center mb-50">
                                                <h6>Documento di identità (retro)</h6>
                                                <ul class="upload-file-list" id="am_uploadCartaIdentitaRetro_file">
                                                    <?php echo $uploadCartaIdentitaRetro; ?>
                                                </ul>
                                            </div>
                                            <div class="col-lg-6 text-center">
                                                <h6>Copia titolo di soggiorno<br/>oppure</br>ricevuta della richiesta di rilascio del permesso di soggiorno</h6>
                                                <ul class="upload-file-list" id="am_uploadTitoloSoggiorno_file">
                                                    <?php echo $uploadTitoloSoggiorno; ?>
                                                </ul>                                                    
                                            </div>
                                            <div class="col-lg-6 text-center">
                                                <h6>Copia della dichiarazione del datore di lavoro relativa all’importo percepito per la maternità</h6>
                                                <p><small>(nel caso di richiesta della quota differenziale dell’assegno di maternità)</small></p>
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
                                <a href="..\attivita_list.php" class="btn btn-default"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include '../template/footer_servizi.php'; 