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
                        <h1 class="title-xxxlarge"><?php echo $_SESSION['Nome'] . ' ' . $_SESSION['Cognome']; ?></h1>
                        <p class="subtitle-small">CF: <?php echo $_SESSION['CF']; ?></p>
                    </div>
                </div>
                <div class="col-12 col-lg-10 menu-servizi">
                    <div class="container mb-4 mb-lg-5 mt-lg-4">
                        <div class="row">
                            <div class="col-lg-3">INFORMATIVA SULLA PRIVACY</div>
                            <div class="col-lg-3">COMPILAZIONE DATI</div>
                            <div class="col-lg-3"><span class="active">TERMINI E CONDIZIONI</span></div>
                            <div class="col-lg-3">RIEPILOGO</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <form action="dichiarazioni.php" id="frm_dati" method="post">
                    <div class="row">
                        <div class="col-12 col-lg-8 offset-lg-1">
                            <div class="it-page-section mb-40 mb-lg-60">
                                <div class="cmp-card">
                                    <div class="card">
                                        <div class="card-body p-0">
                                            <p>Ai sensi degli artt. 46, 47 e 48 del DPR 445/2000, consapevole delle responsabilità penali e delle sanzioni previste in caso di non veridicità del contenuto della presente dichiarazione, di dichiarazione mendace o di formazione di atti falsi di cui agli artt. 75 e 76 del DPR 445/2000, sotto la propria responsabilità</p>
                                            <ul>
                                                <li>di essere in possesso di ISEE in corso di validità e congruente allo stato di famiglia privo di omissioni e/o difformità;</li>
                                                <li>l’insussistenza di rapporti di parentela, entro il quarto grado, o di altri vincoli anche di lavoro o professionali, in corso o riferibili ai due anni precedenti, con gli Amministratori e i Dirigenti del Comune di Villa di Serio.</li>
                                                <li>di essere a conoscenza che a seguito della presente istanza sarà istruita la pratica e potrà essere richiesta eventuale integrazione di documenti e colloqui con assistente sociale</li>
                                            </ul>
                                            <p><b>Cliccando su "Conferma e invia" confermi di aver preso visione dei termini e delle condizioni di servizio sopra elencate.</b></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-default"><a href="compilazione_dati.php"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-left"></use></svg> Indietro</a></button>
                        </div>
                        <div class="col-lg-6" style="text-align: right;">
                            <button type="submit" class="btn btn-primary">Conferma e invia <svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
                        </div>
                    </div>
            </div>
        </div>
    </main>

<?php include '../template/footer_servizi.php'; 