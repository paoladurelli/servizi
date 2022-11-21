        <div class="modal fade search-modal" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content perfect-scrollbar">
                    <div class="modal-body">
                        <form>
                            <div class="container">
                                <div class="row variable-gutters">
                                    <div class="col">
                                        <div class="modal-title">
                                            <button class="search-link d-md-none" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="Chiudi e torna alla pagina precedente">
                                                <svg class="icon icon-md">
                                                    <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-arrow-left"></use>
                                                </svg>
                                            </button>
                                            <h2>Cerca</h2>
                                            <button class="search-link d-none d-md-block" type="button" data-bs-toggle="modal" data-bs-target="#search-modal" aria-label="Chiudi e torna alla pagina precedente">
                                                <svg class="icon icon-md">
                                                    <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-close-big"></use>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="form-group autocomplete-wrapper">
                                            <label for="autocomplete-two" class="visually-hidden">Cerca nel sito</label>
                                            <input type="search" class="autocomplete ps-5" placeholder="Cerca nel sito" id="autocomplete-two" name="autocomplete-two" data-bs-autocomplete="[]">
                                            <span class="autocomplete-icon" aria-hidden="true">
                                                <svg class="icon">
                                                    <use href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-search"></use>
                                                </svg>
                                            </span>
                                            <button type="button" class="btn btn-primary">
                                                <span class="">Cerca</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row variable-gutters">
                                    <div class="col-lg-5">
                                        <div class="searches-list-wrapper">
                                            <div class="other-link-title">FORSE STAVI CERCANDO</div>
                                            <ul class="searches-list" role="list">
                                                <li role="listitem">
                                                    <a href="#">Rilascio Carta Identità Elettronica (CIE)</a>
                                                </li>
                                                <li role="listitem">
                                                    <a href="#">Cambio di residenza</a>
                                                </li>
                                                <li role="listitem">
                                                    <a href="#">Tributi online</a>
                                                </li>
                                                <li role="listitem">
                                                    <a href="#">Prenotazione appuntamenti</a>
                                                </li>
                                                <li role="listitem">
                                                    <a href="#">Rilascio tessera elettorale</a>
                                                </li>
                                                <li role="listitem">
                                                    <a href="#">Voucher connettività</a>
                                                </li>
                                            </ul><!-- /searches-list -->
                                        </div><!-- /searches-list-wrapper -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <footer class="it-footer" id="footer">
            <div class="it-footer-main">
                <div class="container">
                    <div class="row">
                        <div class="col-12 footer-items-wrapper logo-wrapper">
                            <img class="ue-logo" src="./assets/images/logo-eu-inverted.svg" alt="logo Unione Europea">
                            <div class="it-brand-wrapper">
                                <a href="#">
                                    <svg class="icon" aria-hidden="true">
                                        <use xlink:href="./lib/svg/sprites.svg#it-pa"></use>
                                    </svg>
                                    <div class="it-brand-text">
                                        <h2 class="no_toc"><?php echo $configData['nome_comune']; ?></h2>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 footer-items-wrapper">
                            <h3 class="footer-heading-title">Amministrazione</h3>
                            <ul class="footer-list">
                                <li>
                                    <a href="#">Organi di governo</a>
                                </li>
                                <li>
                                    <a href="#">Aree amministrative</a>
                                </li>
                                <li>
                                    <a href="#">Uffici</a>
                                </li>
                                <li>
                                    <a href="#">Enti e fondazioni</a>
                                </li>
                                <li>
                                    <a href="#">Politici</a>
                                </li>
                                <li>
                                    <a href="#">Personale amministrativo</a>
                                </li>
                                <li>
                                    <a href="#">Documenti e dati</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6 footer-items-wrapper">
                            <h3 class="footer-heading-title">Categorie di servizio</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="footer-list">
                                        <li>
                                            <a href="#">Anagrafe e stato civile</a>
                                        </li>
                                        <li>
                                            <a href="#">Cultura e tempo libero</a>
                                        </li>
                                        <li>
                                            <a href="#">Vita lavorativa</a>
                                        </li>
                                        <li>
                                            <a href="#">Imprese e commercio</a>
                                        </li>
                                        <li>
                                            <a href="#">Appalti pubblici</a>
                                        </li>
                                        <li>
                                            <a href="#">Catasto e urbanistica</a>
                                        </li>
                                        <li>
                                            <a href="#">Turismo</a>
                                        </li>
                                        <li>
                                            <a href="#">Mobilità e trasporti</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="footer-list">
                                        <li>
                                            <a href="#">Educazione e formazione</a>
                                        </li>
                                        <li>
                                            <a href="#">Giustizia e sicurezza pubblica</a>
                                        </li>
                                        <li>
                                            <a href="#">Tributi, finanze e contravvenzioni</a>
                                        </li>
                                        <li>
                                            <a href="#">Ambiente</a>
                                        </li>
                                        <li>
                                            <a href="#">Salute, benessere e assistenza</a>
                                        </li>
                                        <li>
                                            <a href="#">Autorizzazioni</a>
                                        </li>
                                        <li>
                                            <a href="#">Agricoltura e pesca</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 footer-items-wrapper">
                            <h3 class="footer-heading-title">Novità</h3>
                            <ul class="footer-list">
                                <li>
                                    <a href="#">Notizie</a>
                                </li>
                                <li>
                                    <a href="#">Comunicati</a>
                                </li>
                                <li>
                                    <a href="#">Avvisi</a>
                                </li>
                            </ul>
                            <h3 class="footer-heading-title">Vivere <?php echo $configData['nome_comune']; ?></h3>
                            <ul class="footer-list">
                                <li>
                                    <a href="#">Luoghi</a>
                                </li>
                                <li>
                                    <a href="#">Eventi</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9 mt-md-4 footer-items-wrapper">
                            <h3 class="footer-heading-title">Contatti</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="footer-info">Comune di <?php echo $configData['nome_comune']; ?><br>
                                        <?php echo $configData['indirizzo_comune']; ?> - <?php echo $configData['cap_comune']; ?> <?php echo $configData['nome_comune']; ?> <?php echo $configData['provincia_comune']; ?><br/>
                                        Codice fiscale / P. IVA: <?php echo $configData['CFPIVA_comune']; ?><br><br>
                                        <a href="#">Ufficio Relazioni con il Pubblico</a><br>
                                        Numero verde: 800 016 123<br>
                                        SMS e WhatsApp: +39 320 1234567<br>
                                        <a href="mailto:<?php echo $configData['pec_comune']; ?>">Posta Elettronica Certificata</a><br>
                                        Centralino unico: <?php echo $configData['tel_comune']; ?>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <ul class="footer-list">
                                        <li>
                                            <a href="#" data-element="faq">Leggi le FAQ</a>
                                        </li>
                                        <li>
                                            <a href="#">Prenotazione appuntamento</a>
                                        </li>
                                        <li>
                                            <a href="#" data-element="report-inefficiency">Segnalazione disservizio</a>
                                        </li>
                                        <li>
                                            <a href="#">Richiesta d'assistenza</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-4">
                                    <ul class="footer-list">
                                        <li>
                                            <a href="#">Amministrazione trasparente</a>
                                        </li>
                                        <li>
                                            <a href="#" data-element="privacy-policy-link">Informativa privacy</a>
                                        </li>
                                        <li>
                                            <a href="#">Note legali</a>
                                        </li>
                                        <li>
                                            <a href="#" data-element="accessibility-link">Dichiarazione di accessibilità</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mt-md-4 footer-items-wrapper">
                            <h3 class="footer-heading-title">Seguici su</h3>
                            <ul class="list-inline text-start social">
                                <li class="list-inline-item">
                                    <a class="p-1 text-white" href="#" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-twitter"></use>
                                        </svg>
                                        <span class="visually-hidden">Twitter</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="p-1 text-white" href="#" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-facebook"></use>
                                        </svg>
                                        <span class="visually-hidden">Facebook</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="p-1 text-white" href="#" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-youtube"></use>
                                        </svg>
                                        <span class="visually-hidden">YouTube</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="p-1 text-white" href="#" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-telegram"></use>
                                        </svg>
                                        <span class="visually-hidden">Telegram</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="p-1 text-white" href="#" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-whatsapp"></use>
                                        </svg>
                                        <span class="visually-hidden">Whatsapp</span>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="p-1 text-white" href="#" target="_blank">
                                        <svg class="icon icon-sm icon-white align-top">
                                            <use xlink:href="../assets/bootstrap-italia/dist/svg/sprites.svg#it-rss"></use>
                                        </svg>
                                        <span class="visually-hidden">RSS</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 footer-items-wrapper">
                            <div class="footer-bottom">
                                <a href="#">Media policy</a>
                                <a href="#">Mappa del sito</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer> 
        <script>window.__PUBLIC_PATH__ = "./lib/fonts"</script>
        <script src="./lib/js/bootstrap-italia.bundle.min.js"></script>
        <script src="./inc/script/scripts.js"></script>
    </body>
</html>
