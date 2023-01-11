<!-- MODALI START -->
    <!-- rifiuta pratica - conferma -->
    <div class="modal fade" tabindex="-1" role="dialog" id="RifiutaPraticaModal" aria-labelledby="RifiutaPraticaModalTitle">
        <div class="modal-dialog" role="document">
            <form method="POST" action="#" name="frm_rifiuta_pratica" id="frm_rifiuta_pratica">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title h5 no_toc" id="RifiutaPraticaModalTitle">Rifiuta Pratica</h2>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" name="ConfermaRifiutoServizioId" id="ConfermaRifiutoServizioId" value="'.$servizio.'" />
                                <input type="hidden" name="ConfermaRifiutoPraticaId" id="ConfermaRifiutoPraticaId" value="'.$praticai.'" />
                                <p><b>ATTENZIONE!</b> Stai per rifiutare la pratica nr. <b><span id="PraticaRifiutata"></span></b>.</p>
                                <p>Se vuoi, puoi inserire qui di seguito la motivazione.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <textarea class="form-control" id="ConfermaRifiutoMotivazione" name="ConfermaRifiutoMotivazione" rows="3" placeholder="Scrivi qui la motivazione del rifiuto"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default btn-sm" id="conferma_rifiuto_btn_close" type="button" data-bs-dismiss="modal">Chiudi</button>
                        <button class="btn btn-primary btn-sm" id="conferma_rifiuto_btn_conferma" type="submit">Rifiuta Pratica</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- genera bozza - risultato -->
    <div class="modal fade" tabindex="-1" role="dialog" id="CreaBozzaModal" aria-labelledby="CreaBozzaModalTitle">
        <div class="modal-dialog" role="document">
            <form method="POST" action="#" name="frm_crea_bozza" id="frm_crea_bozza">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title h5 no_toc" id="CreaBozzaModalTitle">Crea Nuova bozza</h2>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <p>La generazione della nuova bozza della pratica nr. <b><span id="PraticaRifiutata"></span></b> è andata a buon fine.</p>
                                <p>L'utente ha ricevuto una mail di avviso per compilarla.</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default btn-sm" id="crea_bozza_btn_close" type="button" data-bs-dismiss="modal">Chiudi</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- MODALI END -->
