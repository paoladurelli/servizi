<!-- MODALI START -->
    <!-- main -->
    <div class="modal fade" tabindex="-1" role="dialog" id="confirmDialogMsg" aria-labelledby="confirmDialogTitle">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5 no_toc" id="confirmDialogTitle">Elimina messaggio</h2>
                </div>
                <div class="modal-body">
                    <p>Cliccando su "Elimina" il messaggio verrà cancellato definitivamente.</p>
                    <h6>Vuoi eliminare il messaggio?</h6>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="confirmMsgId" id="confirmMsgId" />
                    <input type="hidden" name="confirmLink" id="confirmLink" />
                    <button class="btn btn-default btn-sm" type="button" data-bs-dismiss="modal">Chiudi</button>
                    <button class="btn btn-primary btn-sm deleteMsg" type="submit">Elimina</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="confirmDialogThisMsg" aria-labelledby="confirmDialogTitle">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5 no_toc" id="confirmDialogTitle">Elimina messaggi</h2>
                </div>
                <div class="modal-body">
                    <p>Cliccando su "Elimina", <b>TUTTI i messaggi di questo servizio</b> verranno cancellati definitivamente.</p>
                    <h6>Vuoi eliminare i messaggi?</h6>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="confirmServizioId" id="confirmServizioId" />
                    <input type="hidden" name="confirmLink" id="confirmLink" />
                    <button class="btn btn-default btn-sm" type="button" data-bs-dismiss="modal">Chiudi</button>
                    <button class="btn btn-primary btn-sm deleteThisMsg" type="submit">Elimina</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="confirmDialogAllMsg" aria-labelledby="confirmDialogTitle">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5 no_toc" id="confirmDialogTitle">Elimina messaggi</h2>
                </div>
                <div class="modal-body">
                    <p>Cliccando su "Elimina", <b>TUTTI i messaggi</b> verranno cancellati definitivamente.</p>
                    <h6>Vuoi eliminare i messaggi?</h6>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="confirmLink" id="confirmLink" />
                    <button class="btn btn-default btn-sm" type="button" data-bs-dismiss="modal">Chiudi</button>
                    <button class="btn btn-primary btn-sm deleteAllMsg" type="submit">Elimina</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="confirmDialog" aria-labelledby="confirmDialogTitle">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5 no_toc" id="confirmDialogTitle">Elimina attività</h2>
                </div>
                <div class="modal-body">
                    <p>Cliccando su "Elimina" la tua bozza verrà cancellata definitivamente.</p>
                    <h6>Vuoi eliminare la bozza?</h6>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="confirmServizioId" id="confirmServizioId" />
                    <input type="hidden" name="confirmPraticaId" id="confirmPraticaId" />
                    <input type="hidden" name="confirmStatusId" id="confirmStatusId" />
                    <input type="hidden" name="confirmLink" id="confirmLink" />
                    <button class="btn btn-default btn-sm" type="button" data-bs-dismiss="modal">Chiudi</button>
                    <button class="btn btn-primary btn-sm deleteAttivita" type="submit">Elimina</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalRating">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <?php echo CallRatingLayout(); ?>
                </div>
            </div>
        </div>
    </div>
<!-- MODALI END -->
