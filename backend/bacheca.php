<?php 
    /* file di inclusione */
    $configData = require '../env/config_servizi.php';
    include 'fun/utility.php';

    /* pagina iniziale */
    session_start();

    include 'template/head.php';
    include 'template/header.php';
?>
    <main>
        <div class="container" id="main-container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="cmp-breadcrumbs" role="navigation">
                        <nav class="breadcrumb-container">
                            <ol class="breadcrumb p-0" data-element="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span class="separator">/</span>Pannello Operatore</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <h1 class="title"><?php echo $_SESSION['Nome'] . ' ' . $_SESSION['Cognome']; ?></h1>
                        <p class="subtitle-small">CF: <?php echo $_SESSION['CF']; ?></p>
                    </div>
                </div>
                <?php echo ViewMenuMain(1); ?>
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
                                                                <?php
                                                                    /* MENU PRATICHE */
                                                                    echo MenuPratiche('I');
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

                    <div class="col-12 col-lg-9">
                        <?php
                            /* recupero i dati per le progress bar */
                            /* TOTALE PRATICHE */
                            $configDB = require '../env/config.php';
                            $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                            $sql = "SELECT COUNT(id) AS CountTotal FROM attivita
                                WHERE status_id > 1";
                            $result = $connessione->query($sql);
   
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $countTotal = $row['CountTotal'];
                                }
                            }
                            $connessione->close();
                            /* INVIATE */
                            $configDB = require '../env/config.php';
                            $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                            $sql = "SELECT COUNT(id) AS CountSent FROM attivita
                                WHERE status_id = 2";
                            $result = $connessione->query($sql);
   
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $countSent = $row['CountSent'];
                                    $percentageSent = ($countSent*100)/$countTotal;
                                }
                            }
                            $connessione->close();
                            /* IN LAVORAZIONE */
                            $configDB = require '../env/config.php';
                            $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                            $sql = "SELECT COUNT(id) AS CountWorking FROM attivita
                                WHERE attivita.status_id = 3";
                            $result = $connessione->query($sql);
   
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $countWorking = $row['CountWorking'];
                                    $percentageWorking = ($countWorking*100)/$countTotal;
                                }
                            }
                            $connessione->close();
                            /* ACCETTATE */
                            $configDB = require '../env/config.php';
                            $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                            $sql = "SELECT COUNT(id) AS CountAccepted FROM attivita
                                WHERE attivita.status_id = 4";
                            $result = $connessione->query($sql);
   
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $countAccepted = $row['CountAccepted'];
                                    $percentageAccepted = ($countAccepted*100)/$countTotal;
                                }
                            }
                            $connessione->close();
                            /* RIFIUTATE */
                            $configDB = require '../env/config.php';
                            $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                            $sql = "SELECT COUNT(id) AS CountRefused FROM attivita
                                WHERE attivita.status_id = 5";
                            $result = $connessione->query($sql);
   
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $countRefused = $row['CountRefused'];
                                    $percentageRefused = ($countRefused*100)/$countTotal;
                                }
                            }
                            $connessione->close();
                        ?>
                        <div class="row after-section">
                            <div class="col-lg-3 text-center">
                                <svg class="radial-progress sent" data-percentage="<?php echo $percentageSent; ?>" viewBox="0 0 80 80">
                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"><?php echo $countSent; ?></text>
                                </svg>
                                <p>Pratiche ricevute</p>
                            </div>
                            <div class="col-lg-3 text-center">
                                <svg class="radial-progress working" data-percentage="<?php echo $percentageWorking; ?>" viewBox="0 0 80 80">
                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"><?php echo $countWorking; ?></text>
                                </svg>
                                <p>Pratiche in lavorazione</p>
                            </div>
                            <div class="col-lg-3 text-center">
                                <svg class="radial-progress accepted" data-percentage="<?php echo $percentageAccepted; ?>" viewBox="0 0 80 80">
                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"><?php echo $countAccepted; ?></text>
                                </svg>
                                <p>Pratiche accettate</p>
                            </div>
                            <div class="col-lg-3 text-center">
                                <svg class="radial-progress refused" data-percentage="<?php echo $percentageRefused; ?>" viewBox="0 0 80 80">
                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"><?php echo $countRefused; ?></text>
                                </svg>
                                <p>Pratiche rifiutate</p>
                            </div>
                        </div>

                        <div class="it-page-section" id="newest-pratiche">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="title-xxlarge mb-3">Ultime pratiche ricevute</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <?php include 'pratiche_bacheca.php'; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 text-right mb-4">
                                    <a href="praticheRicevute_list.php" class="btn btn-primary" style="margin-right: 10px;">Vedi tutte le pratiche ricevute</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include 'template/footer.php'; 