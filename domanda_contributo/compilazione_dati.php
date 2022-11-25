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
                <div class="col-12 col-lg-10">
                    <div class="cmp-breadcrumbs" role="navigation">
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb p-0" data-element="breadcrumb">
                                <li class="breadcrumb-item"><a href="../bacheca.php">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page"><span class="separator">/</span><a href="../servizi.php">Servizi</a></li>
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
                            <div class="col-lg-3">INFORMATIVA SULLA PRIVACY</div>
                            <div class="col-lg-3"><span class="active">COMPILAZIONE DATI</span></div>
                            <div class="col-lg-3">TERMINI E CONDIZIONI</div>
                            <div class="col-lg-3">RIEPILOGO</div>
                        </div>
                    </div>
                </div>
            </div>
            <form action="dichiarazioni.php" id="frm_dati" method="post">
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
                                                                    <use href="./lib/svg/sprites.svg#it-expand"></use>
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
                                                                        <a class="nav-link" href="#richiedente">
                                                                            <span class="title-medium">Richiedente</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#beneficiario">
                                                                            <span class="title-medium">Beneficiario</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#richiesta">
                                                                            <span class="title-medium">Richiesta</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#pagamento">
                                                                            <span class="title-medium">Metodi di pagamento</span>
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
                            <div class="it-page-section mb-50 mb-lg-90" id="richiedente">
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
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Altri dati</button>
                                                </h2>
                                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-lg-8"><h5><b>Anagrafica</b></h5></div>
                                                            <div class="col-lg-4" style="text-align: right;"><a href="#">Modifica</a></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12"><p>Nome<br/><b><?php echo $_SESSION['Nome']; ?></b></p></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12"><p>Cognome<br/><b><?php echo $_SESSION['Cognome']; ?></b></p></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12"><p>Codice Fiscale<br/><b><?php echo $_SESSION['CF']; ?></b></p></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12"><p>Data di Nascita<br/><b><?php echo $_SESSION['Cognome']; ?></b></p></div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12"><p>Luogo di Nascita<br/><b><?php echo $_SESSION['Cognome']; ?></b></p></div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div>
                                                <p><b>In qualità di</b></p>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="card_rb">
                                                <li><label><input type="radio" name="rb_qualita_di" value="D">diretto interessato*</label></li>
                                                <li><label><input type="radio" name="rb_qualita_di" value="T">tutore*</label></li>
                                                <li><label><input type="radio" name="rb_qualita_di" value="A">amministratore di sostegno*</label></li>
                                                <li><label><input type="radio" name="rb_qualita_di" value="P">procuratore*</label></li>
                                                <li><label><input type="radio" name="rb_qualita_di" value="E">persona delegata*</label></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="it-page-section mb-50 mb-lg-90" id="beneficiario">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Beneficiario</h2>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0">
                                                <a href="attivita_list.php">
                                                    <span class="">Vedi altre attività</span>
                                                </a>
                                            </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="it-page-section mb-50 mb-lg-90" id="richiesta">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Richiesta</h2>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0">
                                                <a href="attivita_list.php">
                                                    <span class="">Vedi altre attività</span>
                                                </a>
                                            </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="it-page-section mb-50 mb-lg-90" id="pagamento">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                            <div class="d-flex">
                                                <h2 class="title-xxlarge mb-3">Metodi di pagamento</h2>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0">
                                                <a href="attivita_list.php">
                                                    <span class="">Vedi altre attività</span>
                                                </a>
                                            </button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <button type="submit" class="btn btn-default"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</button>
                                </div>
                                <div class="col-lg-4" style="text-align: center;">
                                    <button type="submit" class="btn btn-secondary">Salva richiesta</button>
                                </div>
                                <div class="col-lg-4" style="text-align: right;">
                                    <button type="submit" class="btn btn-primary">Avanti <svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

<?php include '../template/footer_servizi.php'; 