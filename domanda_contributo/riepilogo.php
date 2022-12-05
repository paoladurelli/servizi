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
                <div class="col-12 col-lg-10 menu-servizi">
                    <div class="container mb-4 mb-lg-5 mt-lg-4">
                        <div class="row">
                            <div class="col-lg-3">INFORMATIVA SULLA PRIVACY</div>
                            <div class="col-lg-3">COMPILAZIONE DATI</div>
                            <div class="col-lg-3">TERMINI E CONDIZIONI</div>
                            <div class="col-lg-3"><span class="active"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>RIEPILOGO</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="it-page-section mb-40 mb-lg-60">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <div class="text-center">
                                            <h5>Richiesta inviata</h5>
                                            <p>Grazie, abbiamo ricevuto la tua richiesta per la pratica <b><?php echo $_GET['pratican']; ?> domanda di contributo economico.</b></p>
                                            <p>Inviato il: <b><?php echo date("d-m-Y"); ?></b></p>
                                            <p>&nbsp;</p>
                                            <p>Abbiamo inviato il riepilogo all'email: <b><?php echo $_SESSION["Email"]; ?></b></p>
                                            <p class="mt-5"><a class="btn btn-primary" href="#">Scarica la ricevuta in PDF</a></p>
                                            <p>&nbsp;</p>
                                            <h5>Prossimi passi</h5>
                                            <p>Esito richiesta</p>
                                            <p><a href="#">Consulta la richiesta</a> nella tua area riservata.</p>
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

<?php include '../template/footer_servizi.php'; 