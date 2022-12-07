/* CUSTOM SCRIPTS PER SERVIZI */

/* start script per footer */
$("#footer-menu-lista-button").click(function() {
    setTimeout(function () {
        $(".footer-menu-lista-apri").toggleClass('hide');
        $(".footer-menu-lista-chiudi").toggleClass('show');
        $(".footer_show_more_menulista").toggleClass('show');
    },50);
});
/* end script per footer */

/* START dc_ (domanda contributo) */
$('input[type=radio][name=dc_rb_qualita_di]').change(function() {
    if (this.value === 'D') {
        $('#dc_beneficiario_nome').val($('#dc_richiedente_nome').val());
        $('#dc_beneficiario_nome').prop( "disabled", true );
        $('#dc_beneficiario_cognome').val($('#dc_richiedente_cognome').val());
        $('#dc_beneficiario_cognome').prop( "disabled", true );
        $('#dc_beneficiario_cf').val($('#dc_richiedente_cf').val());
        $('#dc_beneficiario_cf').prop( "disabled", true );
        $('#dc_beneficiario_data_nascita').val($('#dc_richiedente_data_nascita').val());
        $('#dc_beneficiario_data_nascita').prop( "disabled", true );
        $('#dc_beneficiario_luogo_nascita').val($('#dc_richiedente_luogo_nascita').val());
        $('#dc_beneficiario_luogo_nascita').prop( "disabled", true );
        /* Indirizzo */
        $('#dc_beneficiario_via').val($('#dc_richiedente_via').val());
        $('#dc_beneficiario_via').prop( "disabled", true );
        $('#dc_beneficiario_localita').val($('#dc_richiedente_localita').val());
        $('#dc_beneficiario_localita').prop( "disabled", true );
        $('#dc_beneficiario_provincia').val($('#dc_richiedente_provincia').val());
        $('#dc_beneficiario_provincia').prop( "disabled", true );
        /* Contatti */
        $('#dc_beneficiario_email').val($('#dc_richiedente_email').val());
        $('#dc_beneficiario_email').prop( "disabled", true );
        $('#dc_beneficiario_tel').val($('#dc_richiedente_tel').val());
        $('#dc_beneficiario_tel').prop( "disabled", true );
    }
    else{
        $('#dc_beneficiario_nome').val('');
        $('#dc_beneficiario_nome').prop( "disabled", false );
        $('#dc_beneficiario_cognome').val('');
        $('#dc_beneficiario_cognome').prop( "disabled", false );
        $('#dc_beneficiario_cf').val('');
        $('#dc_beneficiario_cf').prop( "disabled", false );
        $('#dc_beneficiario_data-nascita').val('');
        $('#dc_beneficiario_data-nascita').prop( "disabled", false );
        $('#dc_beneficiario_luogo-nascita').val('');
        $('#dc_beneficiario_luogo-nascita').prop( "disabled", false );
        /* Indirizzo */
        $('#dc_beneficiario_via').val('');
        $('#dc_beneficiario_via').prop( "disabled", false );
        $('#dc_beneficiario_localita').val('');
        $('#dc_beneficiario_localita').prop( "disabled", false );
        $('#dc_beneficiario_provincia').val('');
        $('#dc_beneficiario_provincia').prop( "disabled", false );
        /* Contatti */
        $('#dc_beneficiario_email').val('');
        $('#dc_beneficiario_email').prop( "disabled", false );
        $('#dc_beneficiario_tel').val('');
        $('#dc_beneficiario_tel').prop( "disabled", false );
    }
});

$(document).ready(function () {
   
    /* script inerenti alla modale per l'aggiunta di un pagamento */
    $("#dc_frm_add_metodo_pagamento").submit(function (event) {
        $("#dc_pnl_return").removeClass();
        $("#dc_pnl_return").empty();

        if($("#dc_ck_pagamento_predefinito").is(':checked') ) { 
            $ck_pagamento_predefinito = 1;
        }else{
            $ck_pagamento_predefinito = 0;
        }
        
        var formData = {
            sel_tipo_pagamento: $("#dc_sel_tipo_pagamento").val(),
            txt_numero_pagamento: $("#dc_txt_numero_pagamento").val(),
            ck_pagamento_predefinito: $ck_pagamento_predefinito
        };
        $.ajax({
            type: "POST",
            url: "save_metodo_pagamento.php",
            data: formData,
            dataType: "json",
            encode: true
        }).done(function (data) {
            if (!data.success) {
                $("#dc_pnl_return").addClass("alert alert-warning");
                if (data.errors.sel_tipo_pagamento) {
                    $("#dc_pnl_return").append(
                        '<div>' + data.errors.sel_tipo_pagamento + "</div>"
                    );
                }

                if (data.errors.txt_numero_pagamento) {
                    $("#dc_pnl_return").append(
                        '<div>' + data.errors.txt_numero_pagamento + "</div>"
                    );
                }

            } else {
                $("#dc_pnl_data").hide();
                $("#dc_pnl_return").addClass("alert alert-success");
                $("#dc_pnl_return").append(data.message);
                $("#dc_pnl_new_mdp").html(data.new_row);
                $("#dc_btn_save").hide();
                $("#dc_btn_close").show();
            }
        })
        .fail(function (data) {
            console.log(data);
        });

        event.preventDefault();
    });
    
    $('#dc_btn_close').click(function(){
        $("#dc_pnl_data").show();
        $("#dc_pnl_return").removeClass("alert alert-success");
        $("#dc_pnl_return").empty();
        $("#dc_btn_save").show();
    });
    
    /* script inerenti gli upload dei documenti */
    $('#dc_uploadPotereFirma').change(function(e) {
        $('#dc_uploadPotereFirma_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
        i=0;while(_size>900){_size/=1024;i++;}
        var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
        let fileSize = exactSize;
        $('#dc_uploadPotereFirma_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
    });

    $('#dc_uploadDocumentazione').change(function(e) {
        $('#dc_uploadDocumentazione_file').empty();
        
        var totalfiles = document.getElementById('dc_uploadDocumentazione').files.length;
        for (var index = 0; index < totalfiles; index++) {
            let fileName = e.target.files[index].name;
            var _size = e.target.files[index].size;
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;
            $('#dc_uploadDocumentazione_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
        }
    });    

    /* script inerenti le tre action del form principale */
    $('#dc_btn_back').click(function(){
        window.location.href = 'index.php';
    });
    
    $('#dc_salva_richiesta_btn_save').click(function(){
        $('#SalvaRichiestaModal').modal('toggle');
        
        var form = $('#dc_frm_dati');
        var disabled = form.find(':input:disabled').removeAttr('disabled');
        formData = new FormData();
        formParams = form.serializeArray();

        $.each(form.find('input[type="file"]'), function(i, tag) {
            $.each($(tag)[0].files, function(i, file) {
                formData.append(tag.name, file);
            });
        });

        $.each(formParams, function(i, val) {
            formData.append(val.name, val.value);
        });
        disabled.attr('disabled','disabled');

        $.ajax({
            type: $('#dc_frm_dati').attr("method"),
            url: "save_bozza.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                /*console.log(data);*/
                window.location.href = '../attivita_list.php';
            },
            error: function (desc)
            {
                console.log(desc.responseText);
            }
        });
        
        event.preventDefault();
    });
    
    
    $('#dc_btn_concludi_richiesta').click(function(){
        var form = $('#dc_frm_dati');
        var disabled = form.find(':input:disabled').removeAttr('disabled');
        formData = new FormData();
        formParams = form.serializeArray();

        $.each(form.find('input[type="file"]'), function(i, tag) {
            $.each($(tag)[0].files, function(i, file) {
                formData.append(tag.name, file);
            });
        });

        $.each(formParams, function(i, val) {
            formData.append(val.name, val.value);
        });
        disabled.attr('disabled','disabled');
        
        /* validazione e salvataggio come tmp */
        $.ajax({
            url: "save_dati.php",
            type: $('#dc_frm_dati').attr("method"),
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false
        }).done(function (data) {
            if (!data.success) {
                $("#dc_frm_dati_pnl_return").empty();
                /* script per segnalare i dati mancanti */
/*
                for(var index = 0; index < data.errors.length; index++) {
                    var src = data[index];
                }
                $("#dc_frm_dati_pnl_return").append(src);
*/

                $("#dc_frm_dati_pnl_return").append(
                    "<div style='color: var(--bs-orange);'>ATTENZIONE</div>"
                );
                $("#dc_frm_dati_pnl_return").append("<div>Ci sono alcune informazioni mancanti o errate</div><ul>");
                if (data.errors.dc_richiedente_cognome) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_cognome);
                }
                if (data.errors.dc_richiedente_cf) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_cf);
                }
                if (data.errors.dc_richiedente_data_nascita) {
                    $("#dc_frm_dati_pnl_return").append(data.dc_richiedente_data_nascita);
                }
                if (data.errors.dc_richiedente_luogo_nascita) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_luogo_nascita);
                }
                if (data.errors.dc_richiedente_via) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_via);
                }
                if (data.errors.dc_richiedente_localita) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_localita);
                }
                if (data.errors.dc_richiedente_provincia) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_provincia);
                }
                if (data.errors.dc_richiedente_email) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_email);
                }
                if (data.errors.dc_richiedente_tel) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_tel);
                }
                if (data.errors.dc_rb_qualita_di) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_rb_qualita_di);
                }
                if (data.errors.dc_beneficiario_nome) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_nome);
                }
                if (data.errors.dc_beneficiario_cognome) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_cognome);
                }
                if (data.errors.dc_beneficiario_cf) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_cf);
                }
                if (data.errors.dc_beneficiario_data_nascita) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_data_nascita);
                }
                if (data.errors.dc_beneficiario_luogo_nascita) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_luogo_nascita);
                }
                if (data.errors.dc_beneficiario_via) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_via);
                }
                if (data.errors.dc_beneficiario_localita) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_localita);
                }
                if (data.errors.dc_beneficiario_provincia) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_provincia);
                }
                if (data.errors.dc_beneficiario_email) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_email);
                }
                if (data.errors.dc_beneficiario_tel) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_tel);
                }
                if (data.errors.dc_importo_contributo) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_importo_contributo);
                }
                if (data.errors.dc_finalita_contributo) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_finalita_contributo);
                }
                if (data.errors.ckb_pagamento) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.ckb_pagamento);
                }
                if (data.errors.dc_uploadPotereFirma) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_uploadPotereFirma);
                }
                $("#dc_frm_dati_pnl_return").append("</ul>");

            
                $("#dc_frm_dati_pnl_return").addClass("alert alert-warning");
                
                $('html, body').animate({
                    scrollTop: $("#dc_frm_dati_pnl_return").offset().top
                }, 2000);
                
            } else {
                window.location.href = 'dichiarazioni.php?pratican=' + data.message;
            }
        })
        .fail(function (data) {
            console.log(data);
        }); 

        event.preventDefault();
    });
    
    
    $('#dc_conferma_invia').click(function(){
        
        $('#ElaborazioneRichiestaModal').modal('show');
        
        var form = $('#dc_conferma_invia');
        formData = new FormData();
        formParams = form.serializeArray();

        $.each(formParams, function(i, val) {
            formData.append(val.name, val.value);
        });
        
        /* prendo la pratica e inserisco il numero che genero e lo inserisco anche nella riga con status bozza */
        $.ajax({
            url: "save_pratica.php",
            type: $('#dc_conferma_invia').attr("method"),
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false
        }).done(function (data) {
            if (data.success) {
                window.location.href = 'riepilogo.php?pratican=' + data.pratica + '&praticai=' + data.id;
            }else{
                console.log(data.error);
            }
        })
        .fail(function (data) {
            console.log(data);
        }); 

        event.preventDefault();
    });

    /* END dc_ */
    
    /* START am_ (assegno maternita) */

    /* script inerenti alla modale per l'aggiunta di un pagamento */
    $("#am_frm_add_metodo_pagamento").submit(function (event) {
        $("#am_pnl_return").removeClass();
        $("#am_pnl_return").empty();

        if($("#am_ck_pagamento_predefinito").is(':checked') ) { 
            $ck_pagamento_predefinito = 1;
        }else{
            $ck_pagamento_predefinito = 0;
        }
        
        var formData = {
            sel_tipo_pagamento: $("#am_sel_tipo_pagamento").val(),
            txt_numero_pagamento: $("#am_txt_numero_pagamento").val(),
            ck_pagamento_predefinito: $ck_pagamento_predefinito
        };
        $.ajax({
            type: "POST",
            url: "save_metodo_pagamento.php",
            data: formData,
            dataType: "json",
            encode: true
        }).done(function (data) {
            if (!data.success) {
                $("#am_pnl_return").addClass("alert alert-warning");
                if (data.errors.sel_tipo_pagamento) {
                    $("#am_pnl_return").append(
                        '<div>' + data.errors.sel_tipo_pagamento + "</div>"
                    );
                }

                if (data.errors.txt_numero_pagamento) {
                    $("#am_pnl_return").append(
                        '<div>' + data.errors.txt_numero_pagamento + "</div>"
                    );
                }

            } else {
                $("#am_pnl_data").hide();
                $("#am_pnl_return").addClass("alert alert-success");
                $("#am_pnl_return").append(data.message);
                $("#am_pnl_new_mdp").html(data.new_row);
                $("#am_btn_save").hide();
                $("#am_btn_close").show();
            }
        })
        .fail(function (data) {
            console.log(data);
        });

        event.preventDefault();
    });
    
    $('#am_btn_close').click(function(){
        $("#am_pnl_data").show();
        $("#am_pnl_return").removeClass("alert alert-success");
        $("#am_pnl_return").empty();
        $("#am_btn_save").show();
    });
    
    /* script inerenti gli upload dei documenti */
    $('#am_uploadCartadentitaFronte').change(function(e) {
        $('#am_uploadCartadentitaFronte_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
        i=0;while(_size>900){_size/=1024;i++;}
        var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
        let fileSize = exactSize;
        $('#am_uploadCartadentitaFronte').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
    });
    $('#am_uploadCartadentitaRetro').change(function(e) {
        $('#am_uploadCartadentitaRetro_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
        i=0;while(_size>900){_size/=1024;i++;}
        var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
        let fileSize = exactSize;
        $('#am_uploadCartadentitaRetro').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
    });
    $('#am_uploadTitoloSoggiorno').change(function(e) {
        $('#am_uploadTitoloSoggiorno_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
        i=0;while(_size>900){_size/=1024;i++;}
        var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
        let fileSize = exactSize;
        $('#am_uploadTitoloSoggiorno').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
    });
    $('#am_uploadDichiarazioneDatoreLavoro').change(function(e) {
        $('am_uploadDichiarazioneDatoreLavoro_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
        i=0;while(_size>900){_size/=1024;i++;}
        var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
        let fileSize = exactSize;
        $('#am_uploadDichiarazioneDatoreLavoro').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
    });

    /* script inerenti le tre action del form principale */
    $('#am_btn_back').click(function(){
        window.location.href = 'index.php';
    });
    
    $('#am_salva_richiesta_btn_save').click(function(){
        $('#SalvaRichiestaModal').modal('toggle');
        
        var form = $('#am_frm_dati');
        var disabled = form.find(':input:disabled').removeAttr('disabled');
        formData = new FormData();
        formParams = form.serializeArray();

        $.each(form.find('input[type="file"]'), function(i, tag) {
            $.each($(tag)[0].files, function(i, file) {
                formData.append(tag.name, file);
            });
        });

        $.each(formParams, function(i, val) {
            formData.append(val.name, val.value);
        });
        disabled.attr('disabled','disabled');

        $.ajax({
            type: $('#am_frm_dati').attr("method"),
            url: "save_bozza.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                /*console.log(data);*/
                window.location.href = '../attivita_list.php';
            },
            error: function (desc)
            {
                console.log(desc.responseText);
            }
        });
        
        event.preventDefault();
    });
    
    
    $('#am_btn_concludi_richiesta').click(function(){
        var form = $('#am_frm_dati');
        var disabled = form.find(':input:disabled').removeAttr('disabled');
        formData = new FormData();
        formParams = form.serializeArray();

        $.each(form.find('input[type="file"]'), function(i, tag) {
            $.each($(tag)[0].files, function(i, file) {
                formData.append(tag.name, file);
            });
        });

        $.each(formParams, function(i, val) {
            formData.append(val.name, val.value);
        });
        disabled.attr('disabled','disabled');
        
        /* validazione e salvataggio come tmp */
        $.ajax({
            url: "save_dati.php",
            type: $('#am_frm_dati').attr("method"),
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false
        }).done(function (data) {
            if (!data.success) {
                $("#am_frm_dati_pnl_return").empty();
                /* script per segnalare i dati mancanti */
                $("#am_frm_dati_pnl_return").append(
                    "<div style='color: var(--bs-orange);'>ATTENZIONE</div>"
                );
                $("#am_frm_dati_pnl_return").append("<div>Ci sono alcune informazioni mancanti o errate</div><ul>");
                
                if (data.errors.am_richiedente_nome) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_nome);
                }
                
                if (data.errors.am_richiedente_cognome) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_cognome);
                }
                
                if (data.errors.am_richiedente_cf) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_cf);
                }
                
                if (data.errors.am_richiedente_data_nascita) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_data_nascita);
                }
                
                if (data.errors.am_richiedente_luogo_nascita) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_luogo_nascita);
                }
                
                if (data.errors.am_richiedente_via) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_via);
                }
                
                if (data.errors.am_richiedente_localita) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_localita);
                }
                
                if (data.errors.am_richiedente_nome) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_nome);
                }
                
                if (data.errors.am_richiedente_provincia) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_provincia);
                }
                
                if (data.errors.am_richiedente_email) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_email);
                }
                
                if (data.errors.am_richiedente_tel) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_tel);
                }
                
                if (data.errors.am_minoreNome) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_minoreNome);
                }
                
                if (data.errors.am_minoreCognome) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_minoreCognome);
                }
                
                if (data.errors.am_minoreDataNascita) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_minoreDataNascita);
                }
                
                if (data.errors.am_minoreLuogoNascita) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_minoreLuogoNascita);
                }
                
                if (data.errors.am_tipoRichiesta) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_tipoRichiesta);
                }
                
                if (data.errors.am_DichiarazioneCittadinanza) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneCittadinanza);
                }
                
                if (data.errors.am_DichiarazioneSoggiornoNumero) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneSoggiornoNumero);
                }
                
                if (data.errors.am_DichiarazioneSoggiornoQuestura) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneSoggiornoQuestura);
                }
                
                if (data.errors.am_DichiarazioneSoggiornoData) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneSoggiornoData);
                }
                
                if (data.errors.am_DichiarazioneSoggiornoDataRinnovo) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneSoggiornoDataRinnovo);
                }
                
                if (data.errors.am_DichiarazioneAffidamento) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneAffidamento);
                }
                
                if (data.errors.am_DichiarazioneAffidamentoData) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneAffidamentoData);
                }
                
                if (data.errors.ckb_pagamento) {
                    $("#am_frm_dati_pnl_return").append(data.errors.ckb_pagamento);
                }
                
                if (data.errors.am_uploadCartadentitaFronte) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_uploadCartadentitaFronte);
                }
                
                if (data.errors.am_uploadCartadentitaRetro) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_uploadCartadentitaRetro);
                }
                
                if (data.errors.am_uploadTitoloSoggiorno) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_uploadTitoloSoggiorno);
                }
                
                if (data.errors.am_uploadDichiarazioneDatoreLavoro) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_uploadDichiarazioneDatoreLavoro);
                }
                
                $("#am_frm_dati_pnl_return").append("</ul>");
            
                $("#am_frm_dati_pnl_return").addClass("alert alert-warning");
                
                $('html, body').animate({
                    scrollTop: $("#am_frm_dati_pnl_return").offset().top
                }, 2000);
                
            } else {
                window.location.href = 'dichiarazioni.php?pratican=' + data.message;
            }
        })
        .fail(function (data) {
            console.log(data);
        }); 

        event.preventDefault();
    });
    
    
    $('#am_conferma_invia').click(function(){
        
        $('#ElaborazioneRichiestaModal').modal('show');
        
        var form = $('#am_conferma_invia');
        formData = new FormData();
        formParams = form.serializeArray();

        $.each(formParams, function(i, val) {
            formData.append(val.name, val.value);
        });
        
        /* prendo la pratica e inserisco il numero che genero e lo inserisco anche nella riga con status bozza */
        $.ajax({
            url: "save_pratica.php",
            type: $('#am_conferma_invia').attr("method"),
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false
        }).done(function (data) {
            if (data.success) {
                window.location.href = 'riepilogo.php?pratican=' + data.pratica + '&praticai=' + data.id;
            }else{
                console.log(data.error);
            }
        })
        .fail(function (data) {
            console.log(data);
        }); 

        event.preventDefault();
    });
    /* END am_ */

    
});


