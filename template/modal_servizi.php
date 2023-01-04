<!-- MODALI START -->
    <!-- servizi -->
    <div class="modal fade" tabindex="-1" role="dialog" id="AddPagamentoModal" aria-labelledby="AddPagamentoModalTitle">
        <div class="modal-dialog" role="document">
            <form method="POST" action="#" name="frm_add_metodo_pagamento" id="frm_add_metodo_pagamento">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title h5 no_toc" id="AddPagamentoModalTitle">Aggiungi metodo di pagamento</h2>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="metodi_pagamento_pnl_return"></div>
                            </div>
                        </div>
                        <div id="metodi_pagamento_pnl_data">
                            <input type="hidden" name="metodi_pagamento_id" id="metodi_pagamento_id" value="" />
                            <div class="row">
                                <div class="col-lg-12 mt-3 mb-3"><h6>Scegli il metodo di pagamento e inserisci i dati richiesti.</h6></div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 form-check">
                                    <select id="metodi_pagamento_sel_tipo_pagamento" class="form-select">
                                        <?php echo ViewAllTipiPagamento(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 form-check"><input type="text" id="metodi_pagamento_txt_numero_pagamento" value="" class="form-text" /></p></div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-5 form-check"><input type="checkbox" id="metodi_pagamento_ck_pagamento_predefinito" value="" class="form-check-input" /><label class="form-label" for="metodi_pagamento_ck_pagamento_predefinito">E' il pagamento predefinito</label></p></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-default btn-sm" id="metodi_pagamento_btn_close" type="button" data-bs-dismiss="modal">Chiudi</button>
                        <button class="btn btn-primary btn-sm" id="metodi_pagamento_btn_save" type="submit">Salva</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<!-- MODALI END -->
