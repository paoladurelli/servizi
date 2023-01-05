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
                <?php echo ViewMenuMain(1); ?>
            </div>
            <div class="it-page-sections-container">
                <div class="row">
                    <div class="col-12 col-xl-3 d-lg-block mb-4 d-none">
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

                    <div class="col-12 col-xl-9">
                        <div class="row after-section">
                            <div id="carouselExampleControls" class="carousel slide d-lg-none" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <div class="carousel-item col-lg-3 col-12 text-center active">
                                    <?php 
                                        echo ProgressBarInviate($_SESSION['CF']);
                                    ?>
                                    </div>
                                    <div class="carousel-item col-lg-3 col-12 text-center">
                                    <?php 
                                        echo ProgressBarInLavorazione($_SESSION['CF']);
                                    ?>
                                    </div>
                                    <div class="carousel-item col-lg-3 col-12 text-center">
                                    <?php 
                                        echo ProgressBarAccettate($_SESSION['CF']);
                                    ?>
                                    </div>
                                    <div class="carousel-item col-lg-3 col-12 text-center">
                                    <?php 
                                        echo ProgressBarRifiutate($_SESSION['CF']);
                                    ?>
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            
                            <div class="col-lg-3 col-6 text-center d-none d-lg-block">
                            <?php 
                                echo ProgressBarInviate($_SESSION['CF']);
                            ?>
                            </div>
                            <div class="col-lg-3 col-6 text-center d-none d-lg-block">
                            <?php 
                                echo ProgressBarInLavorazione($_SESSION['CF']);
                            ?>
                            </div>
                            <div class="col-lg-3 col-6 text-center d-none d-lg-block">
                            <?php 
                                echo ProgressBarAccettate($_SESSION['CF']);
                            ?>
                            </div>
                            <div class="col-lg-3 col-6 text-center d-none d-lg-block">
                            <?php 
                                echo ProgressBarRifiutate($_SESSION['CF']);
                            ?>
                            </div>
                        </div>
                        
                        <div class="it-page-section after-section" id="latest-posts">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="title-xxlarge mb-3">Ultimi messaggi</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <?php include 'messaggi_bacheca.php'; ?>
                                </div>
                            </div>
                        </div>

                        <div class="it-page-section mb-50 mb-lg-90" id="latest-activities">
                            <div class="row">
                                <div class="col-12">
                                    <h2 class="title-xxlarge mb-3">Ultime attività</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <?php include 'attivita_bacheca.php'; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include './template/footer.php'; 