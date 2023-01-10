<?php 
    /* file di inclusione */
    $configData = require '../env/config_servizi.php';
    $configDB = require '../env/config.php';
    include '../fun/utility.php';

    /* pagina iniziale */
    session_start();

    include 'template/head.php';
    include 'template/header.php';
    
    /* settare le variabili */
    $status_id = "";
    $NumeroPratica = "";
    $NumeroProtocollo = "";
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
    $data_compilazione = "";
    
    /* con l'id vado a richiamare i dati salvati */
    if(isset($_GET["pratica_id"]) && $_GET["pratica_id"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM pubblicazione_matrimonio WHERE id = " . $_GET["pratica_id"];
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
                $coniugeDataNascita = date("d/m/Y", strtotime($row["coniugeDataNascita"]));
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
                                <li class="breadcrumb-item"><a href="bacheca.php">Home</a></li>
                                <li class="breadcrumb-item"><span class="separator">/</span>Pannello Operatore</li>
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Richiedere una pubblicazione di matrimonio</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge">Richiedere una pubblicazione di matrimonio</h1>
                        <p class="subtitle-small">Servizio per la richiesta di autorizzazione previa celebrazione dei matrimoni civili.</p>
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
                                                                    <a class="nav-link" href="#pm_richiedente">
                                                                        <span class="title-medium">Richiedente</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#pm_coniuge">
                                                                        <span class="title-medium">Coniuge</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#pm_prossimi_passi">
                                                                        <span class="title-medium">Prossimi passi</span>
                                                                    </a>
                                                                </li>
                                                                <?php if(!CheckRatingByCfService($_SESSION['CF'],'5')){ ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#pm_valuta_servizio">
                                                                            <span class="title-medium">Valuta il servizio</span>
                                                                        </a>
                                                                    </li>
                                                                <?php }else{ 
                                                                    if(CheckMyRatingService($_GET["pratica_id"])){?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#pm_valuta_servizio">
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
                        <div class="it-page-section mb-30" id="pm_richiedente">
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
                                                    <div class="row">
                                                        <div class="col-12"><p>Stato Civile <b><?php echo $richiedenteStatoCivile; ?></b></p></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row">
                                                        <div class="col-12"><p>Data di Nascita <b><?php echo $datanascita; ?></b></p></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><p>Luogo di Nascita <b><?php echo $luogonascita; ?></b></p></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><p>Stato di Nascita <b><?php echo $richiedenteStatoNascita; ?></b></p></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12"><p>Atto di Nascita N. <b><?php echo $richiedenteAttoNascita; ?></b> del <b><?php echo $richiedenteAttoNascitaData; ?></b></p></div>
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

                        <div class="it-page-section mb-30" id="pm_coniuge">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Coniuge</h2>
                                        </div>
                                    </div>
                                    <div class="card-body" id="pm_pnl_beneficiario">
                                        <div class="row">
                                            <div class="col-lg-12"><h5 class="color-primary"><b>Anagrafica</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>Nome <b><?php echo $coniugeNome; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Cognome <b><?php echo $coniugeCognome; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Codice Fiscale <b><?php echo $coniugeCf; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Stato Civile <b><?php echo $coniugeStatoCivile; ?></b></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>Data di Nascita <b><?php echo $coniugeDataNascita; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Luogo di Nascita <b><?php echo $coniugeLuogoNascita; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Stato di Nascita <b><?php echo $coniugeStatoNascita; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Atto di Nascita N. <b><?php echo $coniugeAttoNascita; ?></b> del <b><?php echo $coniugeAttoNascitaData; ?></b></p></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Indirizzo</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>Località <b><?php echo $coniugeLocalita; ?></b></p></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12"><p>Provincia <b><?php echo $coniugeProvincia; ?></b></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>Via e Numero civico <b><?php echo $coniugeVia; ?></b></p></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12 mt-3"><h5 class="color-primary"><b>Contatti</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>E-mail <b><?php echo $coniugeEmail; ?></b></p></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="row">
                                                    <div class="col-12"><p>Telefono <b><?php echo $coniugeTel; ?></b></p></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-30" id="pm_prossimi_passi">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 m-0">
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
                                                                <span class="date-step-giorno"><?php echo date('d', strtotime($data_compilazione. ' + 60 days')); ?></span><br>
                                                                <span class="date-step-mese"><?php echo date('M/Y', strtotime($data_compilazione. ' + 60 days')); ?></span>
                                                                <span class="pallino"></span>
                                                            </div>
                                                            <div class="testo-step">
                                                                <div class="scheda-gestione">
                                                                    <p>Data probabile dell'affissione delle pubblicazioni</p>
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
                        if(!CheckRatingByCfService($_SESSION['CF'],'5')){
                            echo CallRatingLayout('pm_',$_GET["pratica_id"],5);
                        }else{
                            echo ViewMyRatingStar('pm_',$_GET["pratica_id"]);
                        }
                        ?>    
                        <div class="row">
                            <div class="col-12 text-right mb-20">
                                <a href="#" onclick="history.back();" class="btn btn-secondary mr-lg-40"><svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true" fill="#fff"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include 'template/footer.php'; 