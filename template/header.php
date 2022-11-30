        <header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" style="">
            <div class="it-header-slim-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="it-header-slim-wrapper-content">
                                <a class="d-lg-block navbar-brand" target="_blank" href="#" aria-label="Vai al portale {Nome della Regione} - link esterno - apertura nuova scheda" title="Vai al portale {Nome della Regione}"><?php echo $configData['nome_regione']; ?></a>
                                <div class="it-header-slim-right-zone" role="navigation">
                                <!--<div class="nav-item dropdown">
                                    <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-controls="languages" aria-haspopup="true">
                                        <span class="visually-hidden">Lingua attiva:</span>
                                        <span>ITA</span>
                                        <svg class="icon">
                                            <use href="../lib/svg/sprites.svg#it-expand"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="link-list-wrapper">
                                                    <ul class="link-list">
                                                        <li><a class="dropdown-item list-item" href="#"><span>ITA <span class="visually-hidden">selezionata</span></span></a></li>
                                                        <li><a class="dropdown-item list-item" href="#"><span>ENG</span></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="it-user-wrapper nav-item dropdown">
                                    <a aria-expanded="false" class="btn btn-primary btn-icon btn-full" data-bs-toggle="dropdown" href="#" data-focus-mouse="false">
                                        <span class="rounded-icon">
                                            <?php echo substr($_SESSION['Nome'],0,1) . substr($_SESSION['Cognome'],0,1); ?>
                                        </span>
                                        <span class="d-none d-lg-block"><?php echo $_SESSION['Nome'] . ' ' . $_SESSION['Cognome']; ?></span>
                                        <svg class="icon icon-white d-none d-lg-block">
                                            <use xlink:href="./lib/svg/sprites.svg#it-expand"></use>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="link-list-wrapper">
                                                    <ul class="link-list">
                                                        <li>
                                                            <a class="dropdown-item list-item" href="servizi_list.php"><span>Servizi</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item list-item" href="attivita_list.php"><span>Pratiche</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item list-item" href="messaggi_list.php"><span>Notifiche</span></a>
                                                        </li>
                                                        <li>
                                                            <span class="divider"></span>
                                                        </li>
                                                        <li>
                                                            <a class="list-item left-icon" href="/logout.php">
                                                                <svg class="icon icon-primary icon-sm left">
                                                                    <use xlink:href="lib/svg/sprites.svg#it-external-link">
                                                                    </use>
                                                                </svg>
                                                                <span class="fw-bold">Esci</span>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="it-nav-wrapper">
            <div class="it-header-center-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="it-header-center-content-wrapper">
                                <div class="it-brand-wrapper">
                                    <a href="bacheca.php" title="Home" rel="home">
                                        <img src="./media/images/logo.png" alt="Home" class="icon img-fluid">
                                        <div class="it-brand-text">
                                            <h2 class="no_toc">Comune di <?php echo $configData['nome_comune']; ?> - <em>Servizi online</em></h2>
                                            <p class="mb-0">Provincia di <?php echo $configData['provincia_estesa_comune']; ?></p>
                                        </div>
                                    </a>
                                </div>
                                <div class="it-right-zone">
                                    <!--div class="it-search-wrapper">
                                        <span class="d-none d-md-block">Cerca</span>
                                        <button class="search-link rounded-icon" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="Cerca nel sito">
                                            <svg class="icon">
                                                <use href="./lib/svg/sprites.svg#it-search"></use>
                                            </svg>
                                        </button>
                                    </div-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="it-header-navbar-wrapper" id="header-nav-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <!--start nav-->
                            <nav class="navbar navbar-expand-lg has-megamenu" aria-label="Navigazione principale">
                                <button class="custom-navbar-toggler" type="button" aria-controls="nav4" aria-expanded="false" aria-label="Mostra/Nascondi la navigazione" data-bs-target="#nav4" data-bs-toggle="navbarcollapsible">
                                    <svg class="icon">
                                        <use href="./lib/svg/sprites.svg#it-burger"></use>
                                    </svg>
                                </button>
                                <div class="navbar-collapsable" id="nav4">
                                    <div class="overlay" style="display: none;"></div>
                                    <div class="close-div">
                                        <button class="btn close-menu" type="button">
                                            <span class="visually-hidden">Nascondi la navigazione</span>
                                            <svg class="icon">
                                                <use href="./lib/svg/sprites.svg#it-close-big"></use>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="menu-wrapper">
                                        <a href="#" aria-label="home Nome del Comune" class="logo-hamburger">
                                            <svg class="icon" aria-hidden="true">
                                                <use href="./lib/svg/sprites.svg#it-pa"></use>
                                            </svg>
                                            <div class="it-brand-text">
                                                <div class="it-brand-title"><?php echo $configData['nome_comune']; ?></div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>