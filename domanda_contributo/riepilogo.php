<?php 
    /* file di inclusione */
    $configData = require '../env/config_servizi.php';
    include '../fun/utility.php';

    /* pagina iniziale */
    session_start();

    include '../template/head_servizi.php';
    include '../template/header_servizi.php';
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
                        <h1 class="title-xxxlarge"><?php echo $_SESSION['Nome'] . ' ' . $_SESSION['Cognome']; ?></h1>
                        <p class="subtitle-small">CF: <?php echo $_SESSION['CF']; ?></p>
                    </div>
                </div>
                <div class="col-12 p-0 menu-servizi">
                    <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
                        <div class="row">
                            <div class="col-lg-3 text-center">INFORMATIVA SULLA PRIVACY</div>
                            <div class="col-lg-3 text-center">COMPILAZIONE DATI</div>
                            <div class="col-lg-3 text-center">TERMINI E CONDIZIONI</div>
                            <div class="col-lg-3 text-center"><span class="active"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>RIEPILOGO</span></div>
                        </div>
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
                                                                    <a class="nav-link" href="#dc_stato_richiesta">
                                                                        <span class="title-medium">Stato richiesta</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#dc_scarica_ricevuta">
                                                                        <span class="title-medium">Scarica Ricevuta</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#dc_prossimi_passi">
                                                                        <span class="title-medium">Prossimi passi</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#dc_area_riservata">
                                                                        <span class="title-medium">Area Riservata</span>
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
                        <div class="it-page-section mb-50 mb-lg-90" id="dc_stato_richiesta">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div>
                                            <h2 class="title-xxlarge mb-3">Stato richiesta</h2>
                                        </div>
                                    </div>
                                    <div class="card-body" style="margin-bottom:40px;">
                                        <div class="row">
                                            <div class="col-lg-12"><h5 class="color-primary"><b>Richiesta inviata correttamente</b></h5></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p>Abbiamo ricevuto la tua richiesta per la pratica:<br/><b><?php echo $_GET['pratican']; ?> domanda di contributo economico.</b></p>
                                                <p>Inviata il: <b><?php echo date("d-m-Y"); ?></b></p>
                                                <p>Troverai il riepilogo nella tua e-mail: <b><?php echo $_SESSION["Email"]; ?></b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="it-page-section mb-50 mb-lg-90" id="dc_scarica_ricevuta">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div>
                                            <h2 class="title-xxlarge mb-3">Scarica la ricevuta</h2>
                                        </div>
                                    </div>
                                    <div class="card-body" style="margin-bottom:40px;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <form action="../lib/tcpdf/TCPDF-master/examples/dc_pdf_pratica.php" method="POST" id="dc_frm_download_pdf" name="dc_frm_download_pdf">
                                                    <input type="hidden" name="dc_download_pdf_id" id="dc_download_pdf_id" value="<?php echo $_GET['praticai']; ?>" />
                                                    <input type="hidden" name="dc_download_pdf_pratica" id="dc_download_pdf_pratica" value="<?php echo $_GET['pratican']; ?>" />
                                                    <p class="mt-5 text-center"><button type="submit" class="btn btn-primary" id="dc_download_pdf" name="dc_download_pdf" href="#">Scarica la ricevuta in PDF</button></p>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>          
                        </div>
                        <div class="it-page-section mb-50 mb-lg-90" id="dc_prossimi_passi">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div>
                                            <h2 class="title-xxlarge mb-3">Prossimi passi</h2>
                                        </div>
                                    </div>
                                    <div class="card-body" style="margin-bottom:40px;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="row stepper mb0">
                                                    <div class="offset-md-1 col-md-11">
                                                        <div class="step">
                                                            <div class="date-step">
                                                                <span class="date-step-giorno"><?php echo date("d"); ?></span><br>
                                                                <span class="date-step-mese"><?php echo date("M/Y"); ?></span>
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
                                                                <span class="date-step-giorno"><?php echo date('d', strtotime($Date. ' + 10 days')); ?></span><br>
                                                                <span class="date-step-mese"><?php echo date('M/Y', strtotime($Date. ' + 10 days')); ?></span>
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
                        <div class="it-page-section mb-50 mb-lg-90" id="dc_area_riservata">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div>
                                            <h2 class="title-xxlarge mb-3">Area riservata</h2>
                                        </div>
                                    </div>
                                    <div class="card-body" style="margin-bottom:40px;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p><a href="dettaglio.php?dc_pratica_id=<?php echo $_GET['praticai']; ?>">Consulta la richiesta</a> nella tua area riservata.</p>
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
    </main>

    <div class="modal fade" tabindex="-1" role="dialog" id="ElaborazioneRichiestaModal" aria-labelledby="ElaborazioneRichiestaTitle">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5 no_toc" id="ElaborazioneRichiestaTitle">Salvataggio della richiesta in corso</h2>
                </div>
                <div class="modal-body">
                    <p>Stiamo elaborando la tua richiesta.</p>
                </div>
            </div>
        </div>
    </div>

<?php include '../template/footer_servizi.php'; 