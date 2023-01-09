<?php 
    /* file di inclusione */
    $configData = require './env/config_servizi.php';
    include './fun/utility.php';

    /* pagina di tutti i servizi */
    session_start();

    include './template/head.php';
    include './template/header.php';

?>
    <main>
        <div class="container" id="main-container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="cmp-breadcrumbs" role="navigation">
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb p-0" data-element="breadcrumb">
                                <li class="breadcrumb-item"><a href="bacheca.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Area personale</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title-xxxlarge"><?php echo $_SESSION['Nome'] . ' ' . $_SESSION['Cognome']; ?></h1>
                        <p class="subtitle-small">CF: <?php echo $_SESSION['CF']; ?></p>
                    </div>
                </div>
                <?php echo ViewMenuMain(); ?>
            </div>
            <div class="it-page-sections-container">
                <div class="row">
                    <div class="col-12 col-xl-3">
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
                                                                <?php
                                                                    /* SERVIZI ATTIVI */
                                                                    echo MenuDettaglioServizi($configData['url_comune'],$configData['mail_comune']);
                                                                ?>
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
                    <div class="col-12 col-xl-9 body-attivita">
                        <div class="row">
                            <div class="col-12">
                                <div class="it-page-section mb-50 mb-lg-90" id="attivita">
                                    <div class="row mb-20">
                                        <?php
                                            $configDB = require './env/config.php';
                                            $connessioneMS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                                            $sqlMS = "SELECT * FROM servizi WHERE LinkServizio = '".$_GET['table']."'";
                                            $resultMS = $connessioneMS->query($sqlMS);
                                            if ($resultMS->num_rows > 0) {
                                                while($rowMS = $resultMS->fetch_assoc()) { ?>
                                                    <div>
                                                        <h2 class="mb-50 mt-30"><?php echo $rowMS['NomeServizio']; ?></h2>
                                                    </div>
                                                    <div id="a_chi_rivolto">
                                                        <div class="title-dettaglio-servizio mb-10">A chi è rivolto</div>
                                                        <div class="mb-30"><?php echo $rowMS['PaginaChiRivolto'];?></div>
                                                    </div>
                                                    <div id="contenuto">
                                                        <div class="title-dettaglio-servizio mb-10">Descrizione</div>
                                                        <div class="mb-30"><?php echo $rowMS['PaginaDescrizione'];?></div>
                                                    </div>
                                                    <div id="come_fare">
                                                        <div class="title-dettaglio-servizio mb-10">Come fare</div>
                                                        <div class="mb-30"><?php echo $rowMS['PaginaComeFare'];?></div>
                                                    </div>
                                                    <div id="cosa_serve">
                                                        <div class="title-dettaglio-servizio mb-10">Cosa serve</div>
                                                        <div class="mb-30"><?php echo $rowMS['PaginaCosaServe'];?></div>
                                                    </div>
                                                    <div id="cosa_siottiene">
                                                        <div class="title-dettaglio-servizio mb-10">Cosa si ottiene</div>
                                                        <div class="mb-30"><?php echo $rowMS['PaginaCosaOttiene'];?></div>
                                                    </div>
                                                    <div id="tempi_scadenze">
                                                        <div class="title-dettaglio-servizio mb-10">Tempi e scadenze</div>
                                                        <div class="mb-30"><?php echo $rowMS['PaginaTempiScadenze'];?></div>
                                                    </div>
                                                    <div id="accedi_al_servizio">
                                                        <div class="title-dettaglio-servizio mb-10">Accedi al servizio</div>
                                                        <div class="mb-30"><?php echo $rowMS['PaginaAccediServizio'];?></div>
                                                    </div>
                                                    <div id="accedi_al_servizio_digitale mb-10">
                                                        <div class="title-dettaglio-servizio mb-10">Accedi al servizio digitale</div>
                                                        <div class="mb-30"><a href="<?php echo $_GET['table'];?>" class="btn btn-primary">Accedi al Servizio</a></div>
                                                    </div>
                                                    <div id="contatti">
                                                        <div class="title-dettaglio-servizio mb-10">Contatti</div>
                                                        <div class="mb-30"><?php echo $rowMS['PaginaContatti'];?></div>
                                                    </div>
                                                <?php }
                                            }
                                            $connessioneMS->close(); ?>
                                    </div>
                                </div>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include './template/footer.php'; 