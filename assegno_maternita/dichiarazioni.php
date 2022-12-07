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
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Presentare domanda per assegno di maternità</li>
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
                        <div class="col-12 col-lg-8 offset-lg-1">
                            <div class="it-page-section mb-40 mb-lg-60">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <p>Ai sensi degli artt. 46, 47 e 48 del DPR 445/2000, consapevole delle responsabilità penali e delle sanzioni previste in caso di non veridicità del contenuto della presente dichiarazione, di dichiarazione mendace o di formazione di atti falsi di cui agli artt. 75 e 76 del DPR 445/2000, sotto la propria responsabilità</p>
                                            <ul>
                                                <li>di non svolgere attività lavorativa e quindi di non essere beneficiaria di trattamenti previdenziali di maternità a carico dell’Istituto Nazionale per la Previdenza Sociale (INPS) o di altro ente previdenziale per la stessa nascita/adozione;<br>oppure</li>
                                                <li>di essere beneficiaria di trattamento previdenziale o economico di maternità inferiore rispetto a quello previsto dalle norme vigenti per la concessione del beneficio, come da dichiarazione del datore di lavoro allegata;</li>
                                                <li>di non aver presentato, per il medesimo evento, domanda per assegno di maternità a carico dello Stato di cui all’art. 75 del D.Lgs. 151/2021;</li>
                                                <li>di non aver presentato analoga richiesta presso altro Comune per lo stesso figlio/i (in caso di trasferimento di residenza);</li>
                                                <li>di essere in possesso di ISEE minori in corso di validità e congruente allo stato di famiglia (quindi comprensivo del figlio/i per i quali si chiede l’assegno), privo di omissioni e/o difformità;</li>
                                                <li>di essere a conoscenza dell’obbligo di comunicare al Comune ogni evento che determini la variazione del nucleo familiare.</li>
                                            </ul>
                                            <p><b>Cliccando su "Conferma e invia" confermi di aver preso visione dei termini e delle condizioni di servizio sopra elencate.</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 text-left-lg text-center mb-20">
                            <button type="button" class="btn btn-default"><a href="compilazione_dati.php"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</a></button>
                        </div>
                        <div class="col-lg-6 text-right-lg text-center mb-20">
                            <form method="POST" action="#" name="dc_conferma_invia" id="dc_conferma_invia">
                                <input type="hidden" name="pratican" id="pratican" value="<?php echo $_GET['pratican']; ?>" />
                                <button type="button" class="btn btn-primary">Conferma e invia <svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </main>

<?php include '../template/footer_servizi.php'; 