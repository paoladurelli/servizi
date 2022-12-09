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
        /* tolgo potere di firma come obbligatorio */
        $("#dc_uploadPotereFirma_txt").html("Documento che attesta potere di firma");
    }
    else{
        $('#dc_beneficiario_nome').val('');
        $('#dc_beneficiario_nome').prop( "disabled", false );
        $('#dc_beneficiario_cognome').val('');
        $('#dc_beneficiario_cognome').prop( "disabled", false );
        $('#dc_beneficiario_cf').val('');
        $('#dc_beneficiario_cf').prop( "disabled", false );
        $('#dc_beneficiario_data_nascita').val('');
        $('#dc_beneficiario_data_nascita').prop( "disabled", false );
        $('#dc_beneficiario_luogo_nascita').val('');
        $('#dc_beneficiario_luogo_nascita').prop( "disabled", false );
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
        /* metto potere di firma come obbligatorio */
        $("#dc_uploadPotereFirma_txt").append("*");
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
    
    /* cancella metodi di pagamento */
    $('.delete_class').click(function(){
        event.preventDefault();
        var formData = {
            del_id : $(this).attr('id')
        };       
        $.ajax({
            type: "POST",
            url: "../delete_pagamento.php",
            data: formData,
            dataType: "json",
            encode: true
        }).done(function (data) {
            if (data.success) {
                $('#dc_pnl_metodi_pagamento').html(data.newDiv);                    
            }
        })
        .fail(function (data) {
            console.log(data);
        });
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
        /* tolgo tutti i required */
            $("#dc_richiedente_nome").removeClass("required");
            $("#dc_richiedente_nome_txt").removeClass("required");
            $("#dc_richiedente_cognome").removeClass("required");
            $("#dc_richiedente_cognome_txt").removeClass("required");
            $("#dc_richiedente_cf").removeClass("required");
            $("#dc_richiedente_cf_txt").removeClass("required");
            $("#dc_richiedente_data_nascita").removeClass("required");
            $("#dc_richiedente_data_nascita_txt").removeClass("required");
            $("#dc_richiedente_luogo_nascita").removeClass("required");
            $("#dc_richiedente_luogo_nascita_txt").removeClass("required");
            $("#dc_richiedente_via").removeClass("required");
            $("#dc_richiedente_via_txt").removeClass("required");
            $("#dc_richiedente_localita").removeClass("required");
            $("#dc_richiedente_localita_txt").removeClass("required");
            $("#dc_richiedente_provincia").removeClass("required");
            $("#dc_richiedente_provincia_txt").removeClass("required");
            $("#dc_richiedente_email").removeClass("required");
            $("#dc_richiedente_email_txt").removeClass("required");
            $("#dc_richiedente_tel").removeClass("required");
            $("#dc_richiedente_tel_txt").removeClass("required");
            $("#dc_rb_qualita_di").removeClass("required");
            $("#dc_rb_qualita_di_txt").removeClass("required");
            $("#dc_beneficiario_nome").removeClass("required");
            $("#dc_beneficiario_nome_txt").removeClass("required");
            $("#dc_beneficiario_cognome").removeClass("required");
            $("#dc_beneficiario_cognome_txt").removeClass("required");
            $("#dc_beneficiario_cf").removeClass("required");
            $("#dc_beneficiario_cf_txt").removeClass("required");
            $("#dc_beneficiario_data_nascita").removeClass("required");
            $("#dc_beneficiario_data_nascita_txt").removeClass("required");
            $("#dc_beneficiario_luogo_nascita").removeClass("required");
            $("#dc_beneficiario_luogo_nascita_txt").removeClass("required");
            $("#dc_beneficiario_via").removeClass("required");
            $("#dc_beneficiario_via_txt").removeClass("required");
            $("#dc_beneficiario_localita").removeClass("required");
            $("#dc_beneficiario_localita_txt").removeClass("required");
            $("#dc_beneficiario_provincia").removeClass("required");
            $("#dc_beneficiario_provincia_txt").removeClass("required");
            $("#dc_beneficiario_email").removeClass("required");
            $("#dc_beneficiario_email_txt").removeClass("required");
            $("#dc_beneficiario_tel").removeClass("required");
            $("#dc_beneficiario_tel_txt").removeClass("required");
            $("#dc_importo_contributo").removeClass("required");
            $("#dc_importo_contributo_txt").removeClass("required");
            $("#dc_finalita_contributo").removeClass("required");
            $("#dc_finalita_contributo_txt").removeClass("required");
            $("#ckb_pagamento").removeClass("required");
            $("#ckb_pagamento_txt").removeClass("required");
            $("#dc_uploadPotereFirma").removeClass("required");
            $("#dc_uploadPotereFirma_txt").removeClass("required");
            $("#dc_uploadDocumentazione").removeClass("required");
            $("#dc_uploadDocumentazione_txt").removeClass("required");

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
                console.log(data.errors);
                $("#dc_frm_dati_pnl_return").empty();
                $("#dc_frm_dati_pnl_return").append(
                    "<div style='color: var(--bs-orange);'>ATTENZIONE</div>"
                );
                $("#dc_frm_dati_pnl_return").append("<div>Ci sono alcune informazioni mancanti o errate</div>");
                $("#dc_frm_dati_pnl_return").append("<ul>");

                /* script per segnalare i dati mancanti */
                if (data.errors.dc_richiedente_nome) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_nome);
                    $("#dc_richiedente_nome").addClass("required");
                    $("#dc_richiedente_nome_txt").addClass("required");
                }
                if (data.errors.dc_richiedente_cognome) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_cognome);
                    $("#dc_richiedente_cognome").addClass("required");
                    $("#dc_richiedente_cognome_txt").addClass("required");
                }
                if (data.errors.dc_richiedente_cf) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_cf);
                    $("#dc_richiedente_cf").addClass("required");
                    $("#dc_richiedente_cf_txt").addClass("required");
                }
                if (data.errors.dc_richiedente_data_nascita) {
                    $("#dc_frm_dati_pnl_return").append(data.dc_richiedente_data_nascita);
                    $("#dc_richiedente_data_nascita").addClass("required");
                    $("#dc_richiedente_data_nascita_txt").addClass("required");
                }
                if (data.errors.dc_richiedente_luogo_nascita) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_luogo_nascita);
                    $("#dc_richiedente_luogo_nascita").addClass("required");
                    $("#dc_richiedente_luogo_nascita_txt").addClass("required");
                }
                if (data.errors.dc_richiedente_via) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_via);
                    $("#dc_richiedente_via").addClass("required");
                    $("#dc_richiedente_via_txt").addClass("required");
                }
                if (data.errors.dc_richiedente_localita) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_localita);
                    $("#dc_richiedente_localita").addClass("required");
                    $("#dc_richiedente_localita_txt").addClass("required");
                }
                if (data.errors.dc_richiedente_provincia) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_provincia);
                    $("#dc_richiedente_provincia").addClass("required");
                    $("#dc_richiedente_provincia_txt").addClass("required");
                }
                if (data.errors.dc_richiedente_email) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_email);
                    $("#dc_richiedente_email").addClass("required");
                    $("#dc_richiedente_email_txt").addClass("required");
                }
                if (data.errors.dc_richiedente_tel) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_richiedente_tel);
                    $("#dc_richiedente_tel").addClass("required");
                    $("#dc_richiedente_tel_txt").addClass("required");
                }
                if (data.errors.dc_rb_qualita_di) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_rb_qualita_di);
                    $("#dc_rb_qualita_di_txt").addClass("required");
                }
                if (data.errors.dc_beneficiario_nome) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_nome);
                    $("#dc_beneficiario_nome").addClass("required");
                    $("#dc_beneficiario_nome_txt").addClass("required");
                }
                if (data.errors.dc_beneficiario_cognome) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_cognome);
                    $("#dc_beneficiario_cognome").addClass("required");
                    $("#dc_beneficiario_cognome_txt").addClass("required");
                }
                if (data.errors.dc_beneficiario_cf) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_cf);
                    $("#dc_beneficiario_cf").addClass("required");
                    $("#dc_beneficiario_cf_txt").addClass("required");
                }
                if (data.errors.dc_beneficiario_data_nascita) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_data_nascita);
                    $("#dc_beneficiario_data_nascita").addClass("required");
                    $("#dc_beneficiario_data_nascita_txt").addClass("required");
                }
                if (data.errors.dc_beneficiario_luogo_nascita) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_luogo_nascita);
                    $("#dc_beneficiario_luogo_nascita").addClass("required");
                    $("#dc_beneficiario_luogo_nascita_txt").addClass("required");
                }
                if (data.errors.dc_beneficiario_via) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_via);
                    $("#dc_beneficiario_via").addClass("required");
                    $("#dc_beneficiario_via_txt").addClass("required");
                }
                if (data.errors.dc_beneficiario_localita) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_localita);
                    $("#dc_beneficiario_localita").addClass("required");
                    $("#dc_beneficiario_localita_txt").addClass("required");
                }
                if (data.errors.dc_beneficiario_provincia) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_provincia);
                    $("#dc_beneficiario_provincia").addClass("required");
                    $("#dc_beneficiario_provincia_txt").addClass("required");
                }
                if (data.errors.dc_beneficiario_email) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_email);
                    $("#dc_beneficiario_email").addClass("required");
                    $("#dc_beneficiario_email_txt").addClass("required");
                }
                if (data.errors.dc_beneficiario_tel) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_beneficiario_tel);
                    $("#dc_beneficiario_tel").addClass("required");
                    $("#dc_beneficiario_tel_txt").addClass("required");
                }
                if (data.errors.dc_importo_contributo) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_importo_contributo);
                    $("#dc_importo_contributo").addClass("required");
                    $("#dc_importo_contributo_txt").addClass("required");
                }
                if (data.errors.dc_finalita_contributo) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_finalita_contributo);
                    $("#dc_finalita_contributo").addClass("required");
                    $("#dc_finalita_contributo_txt").addClass("required");
                }
                if (data.errors.ckb_pagamento) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.ckb_pagamento);
                    $("#ckb_pagamento").addClass("required");
                    $("#ckb_pagamento_txt").addClass("required");
                }
                if (data.errors.dc_uploadPotereFirma) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_uploadPotereFirma);
                    $("#dc_uploadPotereFirma").addClass("required");
                    $("#dc_uploadPotereFirma_txt").addClass("required");
                }
                if (data.errors.dc_uploadDocumentazione) {
                    $("#dc_frm_dati_pnl_return").append(data.errors.dc_uploadDocumentazione);
                    $("#dc_uploadDocumentazione").addClass("required");
                    $("#dc_uploadDocumentazione_txt").addClass("required");
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

    /* cancella metodi di pagamento */
    $('.delete_class').click(function(){
        event.preventDefault();
        var formData = {
            del_id : $(this).attr('id')
        };       
        $.ajax({
            type: "POST",
            url: "../delete_pagamento.php",
            data: formData,
            dataType: "json",
            encode: true
        }).done(function (data) {
            if (data.success) {
                $('#am_pnl_metodi_pagamento').html(data.newDiv);
            }
        })
        .fail(function (data) {
            console.log(data);
        });
    });
    
    /* visualizza o nascondi am_DichiarazioneSoggiorno */
    $("#am_DichiarazioneSoggiorno").hide();
    $("#am_DataAffidamento").hide();

    $("input[name$='am_DichiarazioneCittadinanza']").change(function() {
        var test = $(this).val();
        console.log(test);
        if(test == "E"){
            $("#am_DichiarazioneSoggiorno").show(300);
        }else{
            $("#am_DichiarazioneSoggiorno").hide(200);
        }
    });
    
    $("input[name$='am_DichiarazioneAffidamento']").click(function() {
        if($(this).is(":checked")) {
            $("#am_DataAffidamento").show(300);
        } else {
            $("#am_DataAffidamento").hide(200);
        }
    });

    /* script inerenti gli upload dei documenti */
    $('#am_uploadCartaIdentitaFronte').change(function(e) {
        $('#am_uploadCartaIdentitaFronte_file').empty();
        console.log("passo");
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
        i=0;while(_size>900){_size/=1024;i++;}
        var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
        let fileSize = exactSize;
        $('#am_uploadCartaIdentitaFronte_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
    });
    $('#am_uploadCartaIdentitaRetro').change(function(e) {
        $('#am_uploadCartaIdentitaRetro_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
        i=0;while(_size>900){_size/=1024;i++;}
        var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
        let fileSize = exactSize;
        $('#am_uploadCartaIdentitaRetro_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
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
                $("#am_frm_dati_pnl_return").append(
                    "<div style='color: var(--bs-orange);'>ATTENZIONE</div>"
                );
                $("#am_frm_dati_pnl_return").append("<div>Ci sono alcune informazioni mancanti o errate</div>");
                $("#am_frm_dati_pnl_return").append("<ul>");

                /* script per segnalare i dati mancanti */
                if (data.errors.dc_richiedente_nome) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_nome);
                    $("#am_richiedente_nome").addClass("required");
                    $("#am_richiedente_nome_txt").addClass("required");
                }
                                
                if (data.errors.am_richiedente_cognome) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_cognome);
                    $("#am_richiedente_cognome").addClass("required");
                    $("#am_richiedente_cognome_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_cf) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_cf);
                    $("#am_richiedente_cf").addClass("required");
                    $("#am_richiedente_cf_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_data_nascita) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_data_nascita);
                    $("#am_richiedente_data_nascita").addClass("required");
                    $("#am_richiedente_data_nascita_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_luogo_nascita) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_luogo_nascita);
                    $("#am_richiedente_luogo_nascita").addClass("required");
                    $("#am_richiedente_luogo_nascita_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_via) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_via);
                    $("#am_richiedente_via").addClass("required");
                    $("#am_richiedente_via_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_localita) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_localita);
                    $("#am_richiedente_localita").addClass("required");
                    $("#am_richiedente_localita_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_provincia) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_provincia);
                    $("#am_richiedente_provincia").addClass("required");
                    $("#am_richiedente_provincia_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_email) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_email);
                    $("#am_richiedente_email").addClass("required");
                    $("#am_richiedente_email_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_tel) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_richiedente_tel);
                    $("#am_richiedente_tel").addClass("required");
                    $("#am_richiedente_tel_txt").addClass("required");
                }
                
                if (data.errors.am_minoreNome) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_minoreNome);
                    $("#am_minoreNome").addClass("required");
                    $("#am_minoreNome_txt").addClass("required");
                }
                
                if (data.errors.am_minoreCognome) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_minoreCognome);
                    $("#am_minoreCognome").addClass("required");
                    $("#am_minoreCognome_txt").addClass("required");
                }
                
                if (data.errors.am_minoreDataNascita) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_minoreDataNascita);
                    $("#am_minoreDataNascita").addClass("required");
                    $("#am_minoreDataNascita_txt").addClass("required");
                }
                
                if (data.errors.am_minoreLuogoNascita) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_minoreLuogoNascita);
                    $("#am_minoreLuogoNascita").addClass("required");
                    $("#am_minoreLuogoNascita_txt").addClass("required");
                }
                
                if (data.errors.am_tipoRichiesta) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_tipoRichiesta);
                    $("#am_tipoRichiesta").addClass("required");
                    $("#am_tipoRichiesta_txt").addClass("required");
                }
                
                if (data.errors.am_DichiarazioneCittadinanza) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneCittadinanza);
                    $("#am_DichiarazioneCittadinanza").addClass("required");
                    $("#am_DichiarazioneCittadinanza_txt").addClass("required");
                }
                
                if (data.errors.am_DichiarazioneSoggiornoNumero) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneSoggiornoNumero);
                    $("#am_DichiarazioneSoggiornoNumero").addClass("required");
                    $("#am_DichiarazioneSoggiornoNumero_txt").addClass("required");
                }
                
                if (data.errors.am_DichiarazioneSoggiornoQuestura) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneSoggiornoQuestura);
                    $("#am_DichiarazioneSoggiornoQuestura").addClass("required");
                    $("#am_DichiarazioneSoggiornoQuestura_txt").addClass("required");
                }
                
                if (data.errors.am_DichiarazioneSoggiornoData) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneSoggiornoData);
                    $("#am_DichiarazioneSoggiornoData").addClass("required");
                    $("#am_DichiarazioneSoggiornoData_txt").addClass("required");
                }
                
                if (data.errors.am_DichiarazioneSoggiornoDataRinnovo) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneSoggiornoDataRinnovo);
                    $("#am_DichiarazioneSoggiornoDataRinnovo").addClass("required");
                    $("#am_DichiarazioneSoggiornoDataRinnovo_txt").addClass("required");
                }
                
                if (data.errors.am_DichiarazioneAffidamento) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneAffidamento);
                    $("#am_DichiarazioneAffidamento").addClass("required");
                    $("#am_DichiarazioneAffidamento_txt").addClass("required");
                }
                
                if (data.errors.am_DichiarazioneAffidamentoData) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_DichiarazioneAffidamentoData);
                    $("#am_DichiarazioneAffidamentoData").addClass("required");
                    $("#am_DichiarazioneAffidamentoData_txt").addClass("required");
                }
                
                if (data.errors.ckb_pagamento) {
                    $("#am_frm_dati_pnl_return").append(data.errors.ckb_pagamento);
                    $("#ckb_pagamento").addClass("required");
                    $("#ckb_pagamento_txt").addClass("required");
                }
                
                if (data.errors.am_uploadCartaIdentitaFronte) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_uploadCartaIdentitaFronte);
                    $("#am_uploadCartaIdentitaFronte").addClass("required");
                    $("#am_uploadCartaIdentitaFronte_txt").addClass("required");
                }
                
                if (data.errors.am_uploadCartaIdentitaRetro) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_uploadCartaIdentitaRetro);
                    $("#am_uploadCartaIdentitaRetro").addClass("required");
                    $("#am_uploadCartaIdentitaRetro_txt").addClass("required");
                }
                
                if (data.errors.am_uploadTitoloSoggiorno) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_uploadTitoloSoggiorno);
                    $("#am_uploadTitoloSoggiorno").addClass("required");
                    $("#am_uploadTitoloSoggiorno_txt").addClass("required");
                }
                
                if (data.errors.am_uploadDichiarazioneDatoreLavoro) {
                    $("#am_frm_dati_pnl_return").append(data.errors.am_uploadDichiarazioneDatoreLavoro);
                    $("#am_uploadDichiarazioneDatoreLavoro").addClass("required");
                    $("#am_uploadDichiarazioneDatoreLavoro_txt").addClass("required");
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


