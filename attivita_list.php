<?php 
    /* file di inclusione */
    $configData = require './env/config_servizi.php';
    include './fun/utility.php';

    /* pagina dove vengono visualizzare tutte le attività svolte (per ora solo Pratiche in seguito anche Pagamenti) */
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
                <div class="col-12 p-0">
                    <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
                        <ul class="nav nav-tabs nav-tabs-icon-text w-100 flex-nowrap">
                            <li class="nav-item w-100 me-2 p-1">
                                <a class="nav-link justify-content-start pr-10 pb-2 ps-1 pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab" href="bacheca.php">
                                    <svg class="icon me-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-pa"></use>
                                    </svg>
                                    Scrivania
                                </a>
                            </li>
                            <li class="nav-item w-100 me-2 p-1">
                                <a class="nav-link justify-content-start pr-10 pb-2 ps-1 pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab" href="messaggi_list.php">
                                    <svg class="icon me-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-mail"></use>
                                    </svg>
                                    Messaggi
                                </a>
                            </li>
                            <li class="nav-item w-100 me-2 p-1">
                                <a class="nav-link justify-content-start pr-10 pb-2 ps-1 pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab active" href="#">
                                    <svg class="icon me-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-files"></use>
                                    </svg>
                                    Attività
                                </a>
                            </li>
                            <li class="nav-item w-100 me-2 p-1">
                                <a class="nav-link justify-content-start pr-10 pb-2 ps-1 pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab" href="servizi_list.php">
                                    <svg class="icon me-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-settings"></use>
                                    </svg>
                                    Servizi
                                </a>
                            </li>
                        </ul>
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
                                                                    <a class="nav-link" href="#pratiche">
                                                                        <span class="title-medium">Pratiche</span>
                                                                    </a>
                                                                </li>
                                                                <!--<li class="nav-item">
                                                                    <a class="nav-link" href="#pagamenti">
                                                                        <span class="title-medium">Pagamenti</span>
                                                                    </a>
                                                                </li>-->
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
                    <div class="col-12 col-lg-9 body-attivita">
                        <?php
                            /* recupero i dati per le progress bar */
                            /* INVIATE */
                            $configDB = require './env/config.php';
                            $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                            $sql = "SELECT COUNT(id) AS CountSent FROM attivita
                                WHERE cf = '".$_SESSION['CF']."'
                                AND status_id > 1";
                            $result = $connessione->query($sql);
   
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $countSent = $row['CountSent'];
                                    $percentageSent = ($countSent*100)/$countSent;
                                }
                            }
                            $connessione->close();
                            /* INVIATE */
                            $configDB = require './env/config.php';
                            $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                            $sql = "SELECT COUNT(id) AS CountWorking FROM attivita
                                WHERE attivita.cf = '".$_SESSION['CF']."'
                                AND attivita.status_id = 3";
                            $result = $connessione->query($sql);
   
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $countWorking = $row['CountWorking'];
                                    $percentageWorking = ($countWorking*100)/$countSent;
                                }
                            }
                            $connessione->close();
                            /* ACCETTATE */
                            $configDB = require './env/config.php';
                            $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                            $sql = "SELECT COUNT(id) AS CountAccepted FROM attivita
                                WHERE attivita.cf = '".$_SESSION['CF']."'
                                AND attivita.status_id = 4";
                            $result = $connessione->query($sql);
   
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $countAccepted = $row['CountAccepted'];
                                    $percentageAccepted = ($countAccepted*100)/$countSent;
                                }
                            }
                            $connessione->close();
                            /* RIFIUTATE */
                            $configDB = require './env/config.php';
                            $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                            $sql = "SELECT COUNT(id) AS CountRefused FROM attivita
                                WHERE attivita.cf = '".$_SESSION['CF']."'
                                AND attivita.status_id = 5";
                            $result = $connessione->query($sql);
   
                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    $countRefused = $row['CountRefused'];
                                    $percentageRefused = ($countRefused*100)/$countSent;
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
                                <p>Pratiche inviate</p>
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
                        <!--
                        <div class="row after-section">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4">
                                        Filtra per servizio:
                                    </div>
                                    <div class="col-lg-6">
                                        <select name="ddl_filtra_servizi">
                                            <option value="">Seleziona il servizio</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        Vai
                                    </div>                                    
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-lg-4">
                                        Filtra per stato:
                                    </div>
                                    <div class="col-lg-6">
                                        <select name="ddl_filtra_status">
                                            <option value="">Seleziona lo stato</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        Vai
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        -->
                        <div class="it-page-section mb-50 mb-lg-90" id="pratiche">
                            <div class="row">
                                <?php include 'attivita_main.php'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include './template/footer.php'; 