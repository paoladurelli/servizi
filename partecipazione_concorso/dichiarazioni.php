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
                            <div class="col-lg-3"><span class="active"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>TERMINI E CONDIZIONI</span></div>
                            <div class="col-lg-3">RIEPILOGO</div>
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
                                        <p>Il/la sottoscritto/a dichiara ai sensi dell’art. 76 del D.P.R. 445 del 28/12/2000, di essere a conoscenza delle responsabilità penali cui può andare incontro in caso di dichiarazioni mendaci.<br>
                                        (Le dichiarazioni sopra riportate sostituiscono a tutti gli effetti le corrispondenti certificazioni ai sensi dell’art.46 D.P.R. 445 del 28.12.2000)</p>
                                        <p>Il/la sottoscritto/a autorizza ai sensi dell’art. 23 del D. Lgs. 196 del 30.06.2003 e del Regolamento(UE) 2016/679, il Comune di <?php echo $configData['nome_comune']; ?> al trattamento dei propri dati sia personali che eventualmente sensibili ai soli fini del presente procedimento concorsuale e dell’eventuale assunzione, qualora assunto in servizio.</p>
                                        <p><b>Cliccando su "Conferma e invia" confermi di aver preso visione dei termini e delle condizioni di servizio sopra elencate.</b></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-right mb-20">
                        <button type="button" class="btn btn-default"><a href="compilazione_dati.php"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</a></button>
                        <form method="POST" action="#" name="pc_conferma_invia" id="pc_conferma_invia" style="display: inline;">
                            <input type="hidden" name="pratican" id="pratican" value="<?php echo $_GET['pratican']; ?>" />
                            <button type="button" class="btn btn-primary">Conferma e invia <svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
                        </form>
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
                <div class="modal-body mb-30">
                    <p>Stiamo elaborando la tua richiesta.</p>
                </div>
            </div>
        </div>
    </div>
<?php include '../template/footer_servizi.php'; 