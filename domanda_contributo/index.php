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
                <div class="col-12 menu-servizi">
                    <div class="container mb-4 mb-lg-5 mt-lg-4">
                        <div class="row">
                            <div class="col-lg-3 text-center">
                                <span class="active"><svg class="icon me-1 mr-lg-10" aria-hidden="true">
                                        <use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use>
                                    </svg>INFORMATIVA SULLA PRIVACY</span>
                                </a>
                            </div>
                            <div class="col-lg-3 text-center">
                                <!--<span class="nav-link justify-content-start pr-10 pb-2 ps-1 pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab">
                                    svg class="icon me-1 mr-lg-10" aria-hidden="true">
                                        <use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use>
                                    </svg-->
                                    COMPILAZIONE DATI
                                    <!--<!-- </span> -->
                            </div>
                            <div class="col-lg-3 text-center">TERMINI E CONDIZIONI</div>
                            <div class="col-lg-3 text-center">RIEPILOGO</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8 offset-lg-1">
                        <div class="it-page-section mb-40 mb-lg-60" id="latest-posts">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <p>Il comune di <?php echo $configData['nome_comune']; ?> gestisce i dati personali forniti e liberamente comunicati sulla base dell'articolo 13 del Regolamento (UE) 2016/679 General data protection regulation (Gdpr) e degli articoli 13 e successive modifiche e integrazione del decreto legislativo (di seguito d.lgs) 267/2000 (Testo unico enti locali).</p>
                                        <p>Per i dettagli sul trattamento dei dati personali consulta l'<a href="<?php echo $configData['url_comune']; ?>/privacy">informativa sulla privacy</a></p>
                                        <form name="frm_privacy" action="compilazione_dati.php" method="post">
                                            <input type="hidden" id="dc_bozza_id" name="dc_bozza_id" value="<?php if(isset($_GET["dc_bozza_id"])){ echo $_GET["dc_bozza_id"]; } ?>" />
                                            <p><label><input type="checkbox" name="ckb_privacy" required /> <b>Ho letto e compreso l'informativa sulla privacy</b></label></p>
                                            <p><button type="submit" class="btn btn-primary">Avanti <svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button></p>
                                        </form>
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