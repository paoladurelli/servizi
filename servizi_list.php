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
                <div class="col-12 p-0">
                    <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
                        <ul class="nav nav-tabs nav-tabs-icon-text w-100 flex-nowrap">
                            <li class="nav-item w-100 me-2 p-1">
                                <a class="nav-link text-center pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab" href="bacheca.php">
                                    <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-pa"></use>
                                    </svg>
                                    <span class="d-none d-lg-block">Scrivania</span>
                                </a>
                            </li>
                            <li class="nav-item w-100 me-2 p-1">
                                <a class="nav-link text-center pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab" href="messaggi_list.php">
                                    <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-mail"></use>
                                    </svg>
                                    <span class="d-none d-lg-block">Messaggi</span>
                                </a>
                            </li>
                            <li class="nav-item w-100 me-2 p-1">
                                <a class="nav-link text-center pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab" href="attivita_list.php">
                                    <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-files"></use>
                                    </svg>
                                    <span class="d-none d-lg-block">Attività</span>
                                </a>
                            </li>
                            <li class="nav-item w-100 me-2 p-1">
                                <a class="nav-link text-center pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab active" href="#">
                                    <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-settings"></use>
                                    </svg>
                                    <span class="d-none d-lg-block">Servizi</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="it-page-sections-container page-servizi pb-5">
                <?php include 'servizi_main.php'; ?>
            </div>
        </div>
    </main>

<?php include './template/footer.php'; 