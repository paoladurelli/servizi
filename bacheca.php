<?php 
    /* file di inclusione */
    $configData = require './env/config_servizi.php';
    include './fun/utility.php';

    /* pagina iniziale */
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
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                            <li class="nav-item w-100 me-2 p-1" role="tab">
                                <a class="nav-link justify-content-start pr-10 pb-2 ps-1 pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab active" href="#">
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
                            <li class="nav-item w-100 me-2 p-1" role="tab">
                                <a class="nav-link justify-content-start pr-10 pb-2 ps-1 pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab" href="attivita_list.php">
                                    <svg class="icon me-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-files"></use>
                                    </svg>
                                    Attività
                                </a>
                            </li>
                            <li class="nav-item w-100 me-2 p-1" role="tab">
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
                                                                    <a class="nav-link" href="#latest-posts">
                                                                        <span class="title-medium">Ultimi messaggi</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#latest-activities">
                                                                        <span class="title-medium">Ultime attività</span>
                                                                    </a>
                                                                </li>
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

                    <div class="col-12 col-lg-8 offset-lg-1">
                        <div class="it-page-section mb-40 mb-lg-60" id="latest-posts">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Ultimi messaggi</h2>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <?php include 'messaggi_bacheca.php'; ?>
                                        <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0">
                                            <a href="messaggi_list.php">
                                                Vedi altri messaggi
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-50 mb-lg-90" id="latest-activities">
                            <div class="cmp-card">
                                <div class="card">
                                    <div class="card-header border-0 p-0 mb-lg-30 m-0">
                                        <div class="d-flex">
                                            <h2 class="title-xxlarge mb-3">Ultime attività</h2>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <?php include 'attivita_bacheca.php'; ?>
                                        <button type="button" class="btn btn-xs btn-me btn-label t-primary px-0">
                                            <a href="attivita_list.php">
                                                <span class="">Vedi altre attività</span>
                                            </a>
                                        </button>
                                        </a>
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