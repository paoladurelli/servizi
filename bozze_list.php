<?php 
    /* file di inclusione */
    $configData = require './env/config_servizi.php';
    $configDB = require './env/config.php';
    include './fun/utility.php';

    /* pagina dove vengono visualizzare tutte le bozze */
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
                <?php echo ViewMenuMain(3); ?>
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
                                                            <ul class="link-list">
                                                                <?php
                                                                    /* PRATICHE */
                                                                    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                                                                    $sql = "SELECT COUNT(id) as CountRows FROM (". CreateTempTable() . ") servizi_tmp WHERE CodiceFiscale = '".$_SESSION['CF']."' AND StatusId > 1";
                                                                    $result = $connessione->query($sql);
                                                                    if ($result->num_rows > 0) {
                                                                        while($row = $result->fetch_assoc()) {
                                                                            echo '<li class="nav-item"><a class="" href="attivita_list.php"><span class="title-medium">Pratiche</span><span class="float-right menu-numbers">'.$row['CountRows'].'</span></a></li>';
                                                                        }
                                                                    }
                                                                    $connessione->close();
                                                                    
                                                                    /* BOZZE */
                                                                    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                                                                    $sql = "SELECT COUNT(id) as CountRows FROM (". CreateTempTable() . ") servizi_tmp  WHERE CodiceFiscale = '".$_SESSION['CF']."' AND StatusId = 1 AND NumeroPratica = ''";
                                                                    $result = $connessione->query($sql);
                                                                    if ($result->num_rows > 0) {
                                                                        while($row = $result->fetch_assoc()) {
                                                                            echo '<li class="nav-item"><a class="active" href="#"><span class="title-medium">Le mie bozze</span><span class="float-right menu-numbers">'.$row['CountRows'].'</span></a></li>';
                                                                        }
                                                                    }
                                                                    /* SERVIZI ATTIVI */
                                                                    echo MenuAttivita($_SESSION['CF']);
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
                        <div class="it-page-section mb-50 mb-lg-90" id="attivita">
                            <div class="row mb-20 mt-3">
                                <?php include 'bozze_main.php'; ?>
                            </div>
                            <?php echo LegendaStatus(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include './template/footer.php'; 