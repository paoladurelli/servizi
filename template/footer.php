        <!--<div class="modal fade search-modal" id="search-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>-->
        <footer class="it-footer">
           <div class="it-footer-main">
             <div class="container">
                 <section>
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="it-brand-wrapper">
                                <div id="it-region-brand" class="region brand">
                                    <div id="it-block-brandingdelsito" class="block block-system block-system-branding-block">
                                        <a href="<?php echo $configData['url_comune'];?>" target="_blank" title="Home" rel="home">
                                           <img src="./media/images/logo.png" alt="Home" class="icon img-fluid">
                                           <div class="it-brand-text">
                                               <h2 class="no_toc"><?php echo $configData['nome_comune']; ?></h2>
                                               <h3 class="no_toc d-none d-md-block">Provincia di <?php echo $configData['provincia_estesa_comune']; ?></h3>
                                           </div>
                                       </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                 <section class="py-4 border-white">
                    <div class="row">
                        <div class="col-md-3 col-lg-9 pb-2">
                            <h5 class="border-bottom-white mb-15 pb-6 title_resized">CONTATTI</h5>
                            <div class="row">
                                <div class="col-md-4 col-lg-4 pb-2" style="">
                                    <div id="it-region-footer-five" class="region footer_five">
                                        <div id="it-block-footer1" class="block block-block-content">
                                            <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                                <p><strong>Comune di <?php echo $configData['nome_comune']; ?></strong><br>
                                                <?php echo $configData['indirizzo_comune']; ?> - <?php echo $configData['cap_comune']; ?> <?php echo $configData['nome_comune']; ?> <?php echo $configData['provincia_comune']; ?><br/>
                                                Codice fiscale / P. IVA: <?php echo $configData['CFPIVA_comune']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 pb-2" style="">
                                    <div id="it-region-footer-six" class="region footer_six">
                                        <div id="it-block-dichiarazionediaccessibilita" class="block block-block-content">
                                            <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                                <p>
                                                    <br>
                                                    <a href="mailto:<?php echo $configData['pec_comune']; ?>"><?php echo $configData['pec_comune']; ?></a><br>
                                                    Tel. <?php echo $configData['tel_comune']; ?><br/>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-lg-4 pb-2" style="">
                                    <div id="it-region-footer-six" class="region footer_six">
                                        <div id="it-block-dichiarazionediaccessibilita" class="block block-block-content">
                                            <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                                <p>
                                                    <br>
                                                    <a href="<?php echo $configData['url_comune']; ?>" target="_blank">Vai al sito del Comune</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-lg-3 pb-2" style="">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="it-footer-small-prints clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-7">
                        <div id="it-region-footer-small-prints" class="region footer_small_prints">
                            <nav role="navigation" aria-labelledby="block-smallprints-menu" id="block-smallprints" class="block block-menu navigation menu--small-prints">
                                <ul data-block="smallprints" class="it-footer-small-prints-list list-inline mb-0 d-flex flex-column flex-md-row">
                                    <li class="list-inline-item">
                                        <a href="/informativa-sulla-privacy" data-drupal-link-system-path="node/598">Informativa sulla Privacy</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="/utilizzo-dei-cookies" data-drupal-link-system-path="node/599">Utilizzo dei cookies</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">
                        <div id="it-region-footer-credits" class="region footer_credits">
                            <div id="it-block-footerloghi" class="block block-block-content">
                                <div class="clearfix text-formatted field field--name-body field--type-text-with-summary field--label-hidden field__item">
                                    <div class="loghi_progetto">
                                        <div class="lista_loghi_progetto">
                                            <span class="loghi_progetto_img logo_progetto_1">
                                                <a aria-label="Collegamento a sito esterno - Sito Proxima - nuova finestra" href="https://www.proximalab.it" target="blank" title="Sito Proximalab">
                                                    <img alt="Logo Proxima" src="./media/images/footer_proxima.png">
                                                </a>
                                            </span> 
                                            <span class="loghi_progetto_img logo_progetto_2">
                                                <a aria-label="Collegamento a sito esterno - Sito Governo Italiano - nuova finestra" href="https://www.governo.it" target="blank" title="Sito Governo Italiano">
                                                    <img alt="Logo Repubblica Italiana" src="./media/images/footer_repubblica.svg">
                                                </a>
                                            </span> 
                                            <span class="loghi_progetto_img logo_progetto_3">
                                                <a aria-label="Collegamento a sito esterno - Sito Unione Europea - nuova finestra" href="https://europa.eu/european-union/index_it" target="blank" title="Sito Unione Europea">
                                                    <img alt="Logo Unione Europea" src="./media/images/europa.png">
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
