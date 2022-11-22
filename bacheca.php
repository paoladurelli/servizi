<?php
/* pagina dove l'utente trova tutti i servizi e le sezioni della sua area privata */
session_start();

$modal_messaggi = "";

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
                        <ul class="nav nav-tabs nav-tabs-icon-text w-100 flex-nowrap" id="myTab" role="tablist">
                            <li class="nav-item w-100 me-2 p-1" role="tab">
                                <a class="nav-link justify-content-start pr-10 pb-2 ps-1 pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab active" href="#data-ex-tab1" aria-current="page" aria-controls="tab1" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false">
                                    <svg class="icon me-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-pa"></use>
                                    </svg>
                                    Scrivania
                                </a>
                            </li>
                            <li class="nav-item w-100 me-2 p-1" role="tab">
                                <a class="nav-link justify-content-start pr-10 pb-2 ps-1 pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab" href="#data-ex-tab2" aria-current="page" aria-controls="tab2" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false">
                                    <svg class="icon me-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-mail"></use>
                                    </svg>
                                    Messaggi
                                </a>
                            </li>
                            <li class="nav-item w-100 me-2 p-1" role="tab">
                                <a class="nav-link justify-content-start pr-10 pb-2 ps-1 pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab" href="#data-ex-tab3" aria-current="page" aria-controls="tab3" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false">
                                    <svg class="icon me-1 mr-lg-10" aria-hidden="true">
                                        <use href="./lib/svg/sprites.svg#it-files"></use>
                                    </svg>
                                    Attività
                                </a>
                            </li>
                            <li class="nav-item w-100 me-2 p-1" role="tab">
                                <a class="nav-link justify-content-start pr-10 pb-2 ps-1 pe-lg-none pb-lg-15 ps-lg-3 me-lg-5 text-tab" href="#data-ex-tab4" aria-current="page" aria-controls="tab4" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false">
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
            <!-- Tab panels -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="data-ex-tab1" role="tabpanel">
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
                                                <div id="myTab">
                                                    <a href="#" onclick="ChangeTab1();">
                                                        Vedi altri messaggi
                                                    </a>
                                                </div>
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
                                                    <a  href="#data-ex-tab3" aria-current="page" aria-controls="tab3" aria-selected="false" data-bs-toggle="tab" role="button" data-focus-mouse="false">
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
                    <div class="tab-pane" id="data-ex-tab2" role="tabpanel">
                        <?php include 'messaggi_main.php'; ?>
                    </div>
                    <div class="tab-pane" id="data-ex-tab3" role="tabpanel">
                        <div class="row">
                            <div class="d-none d-sm-none d-lg-block col-lg-3">
                                <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-Three">
                                    <nav class="navbar it-navscroll-wrapper navbar-expand-lg" data-bs-navscroll>
                                        <div class="navbar-custom" id="navbarNavProgress">
                                            <div class="menu-wrapper">
                                                <div class="link-list-wrapper">
                                                    <div class="accordion">
                                                        <div class="accordion-item">
                                                            <span class="accordion-header" id="accordion-title-Three">
                                                                <button class="accordion-button pb-10 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-Three" aria-expanded="true" aria-controls="collapse-Three">
                                                                    INDICE DI PAGINA
                                                                    <svg class="icon icon-xs right">
                                                                        <use href="./lib/svg/sprites.svg#it-expand"></use>
                                                                    </svg>
                                                                </button>
                                                            </span>
                                                            <div class="progress">
                                                                <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                            <div id="collapse-Three" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-Three">
                                                                <div class="accordion-body">
                                                                    <ul class="link-list" data-element="page-index">
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" href="#practices">
                                                                                <span class="title-medium">Pratiche</span>
                                                                            </a>
                                                                        </li>
                                                                        <!--li class="nav-item">
                                                                            <a class="nav-link" href="#payments">
                                                                                <span class="title-medium">Pagamenti</span>
                                                                            </a>
                                                                        </li-->
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

                            <div class="col-12 col-lg-8 offset-lg-1 px-0 px-sm-3">
                                <section class="it-page-section mb-40 mb-lg-60" id="practices">
                                    <div class="cmp-filter">
                                        <div class="filter-section">
                                            <h2 class="cmp-filter__title title-xxlarge">Pratiche</h2>
                                            <div class="filter-wrapper d-flex align-items-center">
                                                <button type="button" class="btn p-0 pe-2">
                                                    <span class="rounded-icon">
                                                        <svg class="icon icon-primary icon-xs me-1" aria-hidden="true">
                                                            <use href="./lib/svg/sprites.svg#it-funnel"></use>
                                                        </svg>
                                                    </span>
                                                    <span class="">Filtra</span>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-dropdown dropdown-toggle" type="button" id="dropdownMenu-pratiche" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="">
                                                        <svg class="icon-expand icon icon-sm icon-primary"><use href="./lib/svg/sprites.svg#it-expand"></use></svg>
                                                        <span class="dropdown__title">Ordina</span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu-pratiche">
                                                        <div class="link-list-wrapper">
                                                            <ul class="link-list">
                                                                <li><a class="dropdown-item list-item" href="#"><span>Azione 1</span></a></li>
                                                                <li><a class="dropdown-item list-item" href="#"><span>Azione 2</span></a></li>
                                                                <li><a class="dropdown-item list-item" href="#"><span>Azione 3</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cmp-input-search">
                                            <div class="form-group autocomplete-wrapper">
                                                <div class="input-group">
                                                    <label for="autocomplete-pratiche" class="visually-hidden">Cerca nel sito</label>
                                                    <input type="search" class="autocomplete form-control" placeholder="Cerca" id="autocomplete-pratiche" name="pratiche" data-bs-autocomplete="[]">
                                                    <span class="autocomplete-icon" aria-hidden="true">
                                                        <svg class="icon icon-sm">
                                                            <use href="./lib/svg/sprites.svg#it-search"></use>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cmp-accordion">
                                        <div class="accordion" id="accordion-1">
                                            <div class="accordion-item">
                                                <div class="accordion-header" id="heading1">
                                                    <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                                        <div class="button-wrapper">
                                                            Iscrizione scuola d’infanzia
                                                            <div class="icon-wrapper">
                                                                <span class="u-main-alert">Da completare</span>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <p class="accordion-date title-xsmall-regular mb-0">15/02/2022</p>
                                                </div>
                                                <div id="collapse1" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample1" role="region" aria-labelledby="heading1">
                                                    <div class="accordion-body">
                                                        <p class="mb-2 fw-normal">Pratica: <span class="label">AN4059281</span></p>
                                                            <a href="#" class="mb-2">
                                                                <span class="t-primary">Scheda servizio</span>
                                                            </a>
                                                            <div class="cmp-tag">
                                                                <a class="chip chip-simple text-decoration-none" href="#" data-element="service-topic">
                                                                    <span class="chip-label">Servizio non digitale</span>
                                                                </a>
                                                            </div>

                                                            <div class="cmp-icon-list">
                                                                <div class="link-list-wrapper">
                                                                    <ul class="link-list">
                                                                        <li class="shadow p-0">
                                                                            <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                                <span class="list-item-title-icon-wrapper">
                                                                                    <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                        <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                    </svg>
                                                                                    <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="shadow p-0">
                                                                            <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Graduatoria">
                                                                                <span class="list-item-title-icon-wrapper">
                                                                                    <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                        <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                    </svg>
                                                                                    <span class="list-item-title title-small-semi-bold">Graduatoria</span>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>

                                                            <button type="button" class="btn btn-primary justify-content-center my-3">
                                                                <span class="">Perfeziona la richiesta</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header" id="heading2">
                                                    <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                                        <div class="button-wrapper">
                                                            Richiesta assegno maternità
                                                            <div class="icon-wrapper">
                                                                <span class="">Conclusa</span>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <p class="accordion-date title-xsmall-regular mb-0">24/06/2021</p>
                                                </div>
                                                <div id="collapse2" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample2" role="region" aria-labelledby="heading2">
                                                    <div class="accordion-body">
                                                        <p class="mb-2 fw-normal">Pratica: <span class="label">AN4059281</span></p>
                                                        <a href="#" class="mb-2">
                                                            <span class="t-primary">Scheda servizio</span>
                                                        </a>
                                                        <div class="cmp-tag">
                                                            <a class="chip chip-simple text-decoration-none" href="#" data-element="service-topic">
                                                                <span class="chip-label">Servizio non digitale</span>
                                                            </a>
                                                        </div>
                                                       <div class="cmp-icon-list">
                                                           <div class="link-list-wrapper">
                                                                <ul class="link-list">
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Graduatoria">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Graduatoria</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header" id="heading3">
                                                    <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                                                        <div class="button-wrapper">
                                                            Iscrizione corso di formazione
                                                            <div class="icon-wrapper">
                                                                <span class="">Conclusa</span>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <p class="accordion-date title-xsmall-regular mb-0">24/06/2021</p>
                                                </div>
                                                <div id="collapse3" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample3" role="region" aria-labelledby="heading3">
                                                    <div class="accordion-body">
                                                        <p class="mb-2 fw-normal">Pratica: <span class="label">AN4059281</span></p>
                                                        <a href="#" class="mb-2">
                                                            <span class="t-primary">Scheda servizio</span>
                                                        </a>
                                                        <div class="cmp-tag">
                                                            <a class="chip chip-simple text-decoration-none" href="#" data-element="service-topic">
                                                                <span class="chip-label">Servizio non digitale</span>
                                                            </a>
                                                        </div>
                                                        <div class="cmp-icon-list">
                                                            <div class="link-list-wrapper">
                                                                <ul class="link-list">
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Graduatoria">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Graduatoria</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header" id="heading4">
                                                    <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                        <div class="button-wrapper">
                                                            Richiesta permesso ZTL
                                                            <div class="icon-wrapper">
                                                                <span class="">Conclusa</span>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <p class="accordion-date title-xsmall-regular mb-0">10/05/2021</p>
                                                </div>
                                                <div id="collapse4" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample4" role="region" aria-labelledby="heading4">
                                                    <div class="accordion-body">
                                                        <p class="mb-2 fw-normal">Pratica: <span class="label">AN4059281</span></p>
                                                            <a href="#" class="mb-2">
                                                                <span class="t-primary">Scheda servizio</span>
                                                            </a>
                                                            <div class="cmp-tag">
                                                                <a class="chip chip-simple text-decoration-none" href="#" data-element="service-topic">
                                                                    <span class="chip-label">Servizio non digitale</span>
                                                                </a>
                                                            </div>

                                                            <div class="cmp-icon-list">
                                                                <div class="link-list-wrapper">
                                                                    <ul class="link-list">
                                                                        <li class="shadow p-0">
                                                                            <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                                <span class="list-item-title-icon-wrapper">
                                                                                    <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                        <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                    </svg>
                                                                                    <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="shadow p-0">
                                                                            <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Graduatoria">
                                                                                <span class="list-item-title-icon-wrapper">
                                                                                    <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                        <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                    </svg>
                                                                                    <span class="list-item-title title-small-semi-bold">Graduatoria</span>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="shadow p-0">
                                                                            <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                                <span class="list-item-title-icon-wrapper">
                                                                                    <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                        <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                    </svg>
                                                                                    <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="accordion-item">
                                                    <div class="accordion-header" id="heading5">
                                                        <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                                                            <div class="button-wrapper">
                                                                Richiesta parcheggio residenti
                                                                <div class="icon-wrapper">
                                                                    <span class="">Conclusa</span>
                                                                </div>
                                                            </div>
                                                        </button>
                                                        <p class="accordion-date title-xsmall-regular mb-0">06/03/2021</p>
                                                    </div>
                                                    <div id="collapse5" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample5" role="region" aria-labelledby="heading5">
                                                        <div class="accordion-body">
                                                            <p class="mb-2 fw-normal">Pratica: <span class="label">AN4059281</span></p>
                                                                <a href="#" class="mb-2">
                                                                    <span class="t-primary">Scheda servizio</span>
                                                                </a>
                                                                <div class="cmp-tag">
                                                                    <a class="chip chip-simple text-decoration-none" href="#" data-element="service-topic">
                                                                        <span class="chip-label">Servizio non digitale</span>
                                                                    </a>
                                                                </div>
                                                                <div class="cmp-icon-list">
                                                                    <div class="link-list-wrapper">
                                                                        <ul class="link-list">
                                                                            <li class="shadow p-0">
                                                                                <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                                    <span class="list-item-title-icon-wrapper">
                                                                                        <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                            <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                        </svg>
                                                                                        <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="shadow p-0">
                                                                                <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Graduatoria">
                                                                                    <span class="list-item-title-icon-wrapper">
                                                                                        <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                            <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                        </svg>
                                                                                        <span class="list-item-title title-small-semi-bold">Graduatoria</span>
                                                                                    </span>
                                                                                </a>
                                                                            </li>
                                                                            <li class="shadow p-0">
                                                                                <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                                    <span class="list-item-title-icon-wrapper">
                                                                                        <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                            <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                        </svg>
                                                                                        <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                                    </span>
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
                                </section>
                                <!--<section class="it-page-section mb-50 mb-lg-90" id="payments">
                                    <div class="cmp-filter">
                                        <div class="filter-section">
                                            <h2 class="cmp-filter__title title-xxlarge">Pagamenti</h2>
                                            <div class="filter-wrapper d-flex align-items-center">
                                                <button type="button" class="btn p-0 pe-2">
                                                <span class="rounded-icon">
                                                    <svg class="icon icon-primary icon-xs me-1" aria-hidden="true">
                                                        <use href="./lib/svg/sprites.svg#it-funnel"></use>
                                                    </svg>
                                                </span>
                                                <span class="">Filtra</span>
                                                </button>
                                                <div class="dropdown">
                                                    <button class="btn btn-dropdown dropdown-toggle" type="button" id="dropdownMenu-pagamenti" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="">
                                                        <svg class="icon-expand icon icon-sm icon-primary">
                                                            <use href="./lib/svg/sprites.svg#it-expand"></use>
                                                        </svg>
                                                        <span class="dropdown__title">Ordina</span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu-pagamenti">
                                                        <div class="link-list-wrapper">
                                                            <ul class="link-list">
                                                                <li><a class="dropdown-item list-item" href="#"><span>Azione 1</span></a></li>
                                                                <li><a class="dropdown-item list-item" href="#"><span>Azione 2</span></a></li>
                                                                <li><a class="dropdown-item list-item" href="#"><span>Azione 3</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cmp-input-search">
                                            <div class="form-group autocomplete-wrapper">
                                                <div class="input-group">
                                                    <label for="autocomplete-pagamenti" class="visually-hidden">Cerca nel sito</label>
                                                    <input type="search" class="autocomplete form-control" placeholder="Cerca" id="autocomplete-pagamenti" name="pagamenti" data-bs-autocomplete="[]">
                                                    <span class="autocomplete-icon" aria-hidden="true">
                                                        <svg class="icon icon-sm">
                                                            <use href="./lib/svg/sprites.svg#it-search"></use>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cmp-accordion">
                                        <div class="accordion" id="accordion-2">
                                            <div class="accordion-item">
                                                <div class="accordion-header" id="heading6">
                                                    <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                                                        <div class="button-wrapper">
                                                            Pagamento servizio mensa
                                                            <div class="icon-wrapper">
                                                                <img class="icon-folder" src="../assets/images/folder-pay.svg" alt="folder Pagato" role="img">
                                                                <span class="">Pagato</span>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <p class="accordion-date title-xsmall-regular mb-0">07/01/2022</p>
                                                </div>
                                                <div id="collapse6" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample6" role="region" aria-labelledby="heading6">
                                                    <div class="accordion-body">
                                                        <p class="mb-2 fw-normal">Pratica: <span class="label">AN4059281</span></p>
                                                        <a href="#" class="mb-2">
                                                            <span class="t-primary">Scheda servizio</span>
                                                        </a>
                                                        <div class="cmp-tag">
                                                            <a class="chip chip-simple text-decoration-none" href="#" data-element="service-topic">
                                                                <span class="chip-label">Servizio non digitale</span>
                                                            </a>
                                                        </div>
                                                        <div class="cmp-icon-list">
                                                            <div class="link-list-wrapper">
                                                                <ul class="link-list">
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Graduatoria">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Graduatoria</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header" id="heading7">
                                                    <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                                        <div class="button-wrapper">
                                                            Pagamento contravvenzioni
                                                            <div class="icon-wrapper">
                                                                <img class="icon-folder" src="../assets/images/folder-pay.svg" alt="folder Pagato" role="img">
                                                                <span class="">Pagato</span>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <p class="accordion-date title-xsmall-regular mb-0">01/10/2021</p>
                                                </div>
                                                <div id="collapse7" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample7" role="region" aria-labelledby="heading7">
                                                    <div class="accordion-body">
                                                        <p class="mb-2 fw-normal">Pratica: <span class="label">AN4059281</span></p>
                                                        <a href="#" class="mb-2">
                                                            <span class="t-primary">Scheda servizio</span>
                                                        </a>
                                                        <div class="cmp-tag">
                                                            <a class="chip chip-simple text-decoration-none" href="#" data-element="service-topic">
                                                                <span class="chip-label">Servizio non digitale</span>
                                                            </a>
                                                        </div>
                                                        <div class="cmp-icon-list">
                                                            <div class="link-list-wrapper">
                                                                <ul class="link-list">
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Graduatoria">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Graduatoria</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header" id="heading8">
                                                    <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
                                                        <div class="button-wrapper">
                                                            Pagamento contravvenzioni
                                                            <div class="icon-wrapper">
                                                                <img class="icon-folder" src="../assets/images/folder-pay.svg" alt="folder Pagato" role="img">
                                                                <span class="">Pagato</span>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <p class="accordion-date title-xsmall-regular mb-0">24/06/2021</p>
                                                </div>
                                                <div id="collapse8" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample8" role="region" aria-labelledby="heading8">
                                                    <div class="accordion-body">
                                                        <p class="mb-2 fw-normal">Pratica: <span class="label">AN4059281</span></p>
                                                        <a href="#" class="mb-2">
                                                            <span class="t-primary">Scheda servizio</span>
                                                        </a>
                                                        <div class="cmp-tag">
                                                            <a class="chip chip-simple text-decoration-none" href="#" data-element="service-topic">
                                                                <span class="chip-label">Servizio non digitale</span>
                                                            </a>
                                                        </div>
                                                        <div class="cmp-icon-list">
                                                            <div class="link-list-wrapper">
                                                                <ul class="link-list">
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Graduatoria">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Graduatoria</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header" id="heading9">
                                                    <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                                                        <div class="button-wrapper">
                                                            Pagamento contravvenzioni
                                                            <div class="icon-wrapper">
                                                                <img class="icon-folder" src="../assets/images/folder-pay.svg" alt="folder Pagato" role="img">
                                                                <span class="">Pagato</span>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <p class="accordion-date title-xsmall-regular mb-0">10/05/2021</p>
                                                </div>
                                                <div id="collapse9" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample9" role="region" aria-labelledby="heading9">
                                                    <div class="accordion-body">
                                                        <p class="mb-2 fw-normal">Pratica: <span class="label">AN4059281</span></p>
                                                        <a href="#" class="mb-2">
                                                            <span class="t-primary">Scheda servizio</span>
                                                        </a>
                                                        <div class="cmp-tag">
                                                            <a class="chip chip-simple text-decoration-none" href="#" data-element="service-topic">
                                                                <span class="chip-label">Servizio non digitale</span>
                                                            </a>
                                                        </div>
                                                        <div class="cmp-icon-list">
                                                            <div class="link-list-wrapper">
                                                                <ul class="link-list">
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Graduatoria">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Graduatoria</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header" id="heading10">
                                                    <button class="accordion-button collapsed title-snall-semi-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                                                        <div class="button-wrapper">
                                                            Pagamento contravvenzioni
                                                            <div class="icon-wrapper">
                                                                <img class="icon-folder" src="../assets/images/folder-pay.svg" alt="folder Pagato" role="img">
                                                                <span class="">Pagato</span>
                                                            </div>
                                                        </div>
                                                    </button>
                                                    <p class="accordion-date title-xsmall-regular mb-0">06/03/2021</p>
                                                </div>
                                                <div id="collapse10" class="accordion-collapse collapse p-0" data-bs-parent="#accordionExample10" role="region" aria-labelledby="heading10">
                                                    <div class="accordion-body">
                                                        <p class="mb-2 fw-normal">Pratica: <span class="label">AN4059281</span></p>
                                                        <a href="#" class="mb-2">
                                                            <span class="t-primary">Scheda servizio</span>
                                                        </a>
                                                        <div class="cmp-tag">
                                                            <a class="chip chip-simple text-decoration-none" href="#" data-element="service-topic">
                                                                <span class="chip-label">Servizio non digitale</span>
                                                            </a>
                                                        </div>
                                                        <div class="cmp-icon-list">
                                                            <div class="link-list-wrapper">
                                                                <ul class="link-list">
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Graduatoria">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Graduatoria</span>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="shadow p-0">
                                                                        <a class="list-item icon-left t-primary title-small-semi-bold" href="#" aria-label="Scarica la Ricevuta richiesta">
                                                                            <span class="list-item-title-icon-wrapper">
                                                                                <svg class="icon icon-sm align-self-start icon-color" aria-hidden="true">
                                                                                    <use href="./lib/svg/sprites.svg#it-clip"></use>
                                                                                </svg>
                                                                                <span class="list-item-title title-small-semi-bold">Ricevuta richiesta</span>
                                                                            </span>
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
                                </section>-->
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="data-ex-tab4" role="tabpanel">
                        <?php include 'servizi_main.php'; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="cmp-modal">
            <?php echo $modal_messaggi; ?>
        </div>
    </main>

<?php include './template/footer.php'; 