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

$(window).on('load', function(){
    /* circular progress bar */
    $('svg.radial-progress').each(function( index, value ) { 
        // Get percentage of progress
        percent = $(value).data('percentage');
        // Get radius of the svg's circle.complete
        radius = $(this).find($('circle.complete')).attr('r');
        // Get circumference (2πr)
        circumference = 2 * Math.PI * radius;
        // Get stroke-dashoffset value based on the percentage of the circumference
        strokeDashOffset = circumference - ((percent * circumference) / 100);
        // Transition progress for 1.25 seconds
        $(this).find($('circle.complete')).animate({'stroke-dashoffset': strokeDashOffset}, 1250);
    });
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
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#dc_uploadPotereFirma_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#dc_uploadPotereFirma').val('');
             return false;
        }        
    });

    $('#dc_uploadDocumentazione').change(function(e) {
        $('#dc_uploadDocumentazione_file').empty();
        
        var totalfiles = document.getElementById('dc_uploadDocumentazione').files.length;
        for (var index = 0; index < totalfiles; index++) {
            let fileName = e.target.files[index].name;
            var _size = e.target.files[index].size;
            var maxFileSize = 500;
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
            var checkSize = parseFloat(_size / 1024).toFixed(2);
             //Check if the file size is less than maximum file size
            if (checkSize < maxFileSize) {
                var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
                i=0;while(_size>900){_size/=1024;i++;}
                var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
                let fileSize = exactSize;
                
                if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                    alert("Formati accettati : "+fileExtension.join(', '));
                }else{
                    $('#dc_uploadDocumentazione_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                    return true;
                }
            } else {
                 alert('Il file deve pesare al massimo 500 Kb');
                 $('#dc_uploadDocumentazione').val('');
                 return false;
            }                
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

        $.each(formParams, function(i,val) {
            formData.append(val.name, val.value);
        });
        
        console.log(formData);
        
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
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
            $('#am_uploadCartaIdentitaFronte_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
             return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#am_uploadCartaIdentitaFronte').val('');
             return false;
        }
    });
    
    $('#am_uploadCartaIdentitaRetro').change(function(e) {
        $('#am_uploadCartaIdentitaRetro_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;
            
            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#am_uploadCartaIdentitaRetro_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#am_uploadCartaIdentitaRetro').val('');
             return false;
        }
    });
    
    $('#am_uploadTitoloSoggiorno').change(function(e) {
        $('#am_uploadTitoloSoggiorno_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;
            
            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#am_uploadTitoloSoggiorno_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#am_uploadTitoloSoggiorno').val('');
             return false;
        }
    });

    $('#am_uploadDichiarazioneDatoreLavoro').change(function(e) {
        $('am_uploadDichiarazioneDatoreLavoro_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;
            
            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#am_uploadDichiarazioneDatoreLavoro_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#am_uploadDichiarazioneDatoreLavoro').val('');
             return false;
        }
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
    
    /* START pc_ partecipazione_concorso */
    /* script inerenti gli upload dei documenti */
    $('#pc_uploadCartaIdentitaFronte').change(function(e) {
        $('#pc_uploadCartaIdentitaFronte_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#pc_uploadCartaIdentitaFronte_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#pc_uploadCartaIdentitaFronte').val('');
             return false;
        }        
    });

    $('#pc_uploadCartaIdentitaRetro').change(function(e) {
        $('#pc_uploadCartaIdentitaRetro_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#pc_uploadCartaIdentitaRetro_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#pc_uploadCartaIdentitaRetro').val('');
             return false;
        }        
    });

    $('#pc_uploadCV').change(function(e) {
        $('#pc_uploadCV_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#pc_uploadCV_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#pc_uploadCV').val('');
             return false;
        }        
    });

    $('#pc_uploadTitoliPreferenza').change(function(e) {
        $('#pc_uploadTitoliPreferenza_file').empty();
        
        var totalfiles = document.getElementById('pc_uploadTitoliPreferenza').files.length;
        for (var index = 0; index < totalfiles; index++) {
            let fileName = e.target.files[index].name;
            var _size = e.target.files[index].size;
            var maxFileSize = 500;
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
            var checkSize = parseFloat(_size / 1024).toFixed(2);
             //Check if the file size is less than maximum file size
            if (checkSize < maxFileSize) {
                var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
                i=0;while(_size>900){_size/=1024;i++;}
                var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
                let fileSize = exactSize;
                
                if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                    alert("Formati accettati : "+fileExtension.join(', '));
                }else{
                    $('#pc_uploadTitoliPreferenza_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                    return true;
                }
            } else {
                 alert('Il file deve pesare al massimo 500 Kb');
                 $('#pc_uploadTitoliPreferenza').val('');
                 return false;
            }                
        }
    });

    /* script inerenti le tre action del form principale */
    $('#pc_btn_back').click(function(){
        window.location.href = 'index.php';
    });
    
    $('#pc_salva_richiesta_btn_save').click(function(){
        $('#SalvaRichiestaModal').modal('toggle');
        
        var form = $('#pc_frm_dati');
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
            type: $('#pc_frm_dati').attr("method"),
            url: "save_bozza.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                window.location.href = '../attivita_list.php';
            },
            error: function (desc)
            {
                console.log(desc.responseText);
            }
        });
        
        event.preventDefault();
    });
    
    $('#pc_btn_concludi_richiesta').click(function(){
        /* tolgo tutti i required */
            $("#pc_richiedente_nome").removeClass("required");
            $("#pc_richiedente_nome_txt").removeClass("required");
            $("#pc_richiedente_cognome").removeClass("required");
            $("#pc_richiedente_cognome_txt").removeClass("required");
            $("#pc_richiedente_cf").removeClass("required");
            $("#pc_richiedente_cf_txt").removeClass("required");
            $("#pc_richiedente_data_nascita").removeClass("required");
            $("#pc_richiedente_data_nascita_txt").removeClass("required");
            $("#pc_richiedente_luogo_nascita").removeClass("required");
            $("#pc_richiedente_luogo_nascita_txt").removeClass("required");
            $("#pc_richiedente_via").removeClass("required");
            $("#pc_richiedente_via_txt").removeClass("required");
            $("#pc_richiedente_localita").removeClass("required");
            $("#pc_richiedente_localita_txt").removeClass("required");
            $("#pc_richiedente_provincia").removeClass("required");
            $("#pc_richiedente_provincia_txt").removeClass("required");
            $("#pc_richiedente_email").removeClass("required");
            $("#pc_richiedente_email_txt").removeClass("required");
            $("#pc_richiedente_tel").removeClass("required");
            $("#pc_richiedente_tel_txt").removeClass("required");

            $("#pc_uploadCartaIdentitaFronte").removeClass("required");
            $("#pc_uploadCartaIdentitaFronte_txt").removeClass("required");
            $("#pc_uploadCartaIdentitaRetro").removeClass("required");
            $("#pc_uploadCartaIdentitaRetro_txt").removeClass("required");
            $("#pc_uploadCV").removeClass("required");
            $("#pc_uploadCV_txt").removeClass("required");
            $("#pc_uploadTitoliPreferenza").removeClass("required");
            $("#pc_uploadTitoliPreferenza_txt").removeClass("required");

        var form = $('#pc_frm_dati');
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
            type: $('#pc_frm_dati').attr("method"),
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false
        }).done(function (data) {
            if (!data.success) {
                $("#pc_frm_dati_pnl_return").empty();
                $("#pc_frm_dati_pnl_return").append(
                    "<div style='color: var(--bs-orange);'>ATTENZIONE</div>"
                );
                $("#pc_frm_dati_pnl_return").append("<div>Ci sono alcune informazioni mancanti o errate</div>");
                $("#pc_frm_dati_pnl_return").append("<ul>");

                /* script per segnalare i dati mancanti */
                if (data.errors.pc_richiedente_nome) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_richiedente_nome);
                    $("#pc_richiedente_nome").addClass("required");
                    $("#pc_richiedente_nome_txt").addClass("required");
                }
                if (data.errors.pc_richiedente_cognome) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_richiedente_cognome);
                    $("#pc_richiedente_cognome").addClass("required");
                    $("#pc_richiedente_cognome_txt").addClass("required");
                }
                if (data.errors.pc_richiedente_cf) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_richiedente_cf);
                    $("#pc_richiedente_cf").addClass("required");
                    $("#pc_richiedente_cf_txt").addClass("required");
                }
                if (data.errors.pc_richiedente_data_nascita) {
                    $("#pc_frm_dati_pnl_return").append(data.pc_richiedente_data_nascita);
                    $("#pc_richiedente_data_nascita").addClass("required");
                    $("#pc_richiedente_data_nascita_txt").addClass("required");
                }
                if (data.errors.pc_richiedente_luogo_nascita) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_richiedente_luogo_nascita);
                    $("#pc_richiedente_luogo_nascita").addClass("required");
                    $("#pc_richiedente_luogo_nascita_txt").addClass("required");
                }
                if (data.errors.pc_richiedente_via) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_richiedente_via);
                    $("#pc_richiedente_via").addClass("required");
                    $("#pc_richiedente_via_txt").addClass("required");
                }
                if (data.errors.pc_richiedente_localita) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_richiedente_localita);
                    $("#pc_richiedente_localita").addClass("required");
                    $("#pc_richiedente_localita_txt").addClass("required");
                }
                if (data.errors.pc_richiedente_provincia) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_richiedente_provincia);
                    $("#pc_richiedente_provincia").addClass("required");
                    $("#pc_richiedente_provincia_txt").addClass("required");
                }
                if (data.errors.pc_richiedente_email) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_richiedente_email);
                    $("#pc_richiedente_email").addClass("required");
                    $("#pc_richiedente_email_txt").addClass("required");
                }
                if (data.errors.pc_richiedente_tel) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_richiedente_tel);
                    $("#pc_richiedente_tel").addClass("required");
                    $("#pc_richiedente_tel_txt").addClass("required");
                }                
                if (data.errors.pc_cittadino) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_cittadino);
                    $("#pc_cittadino").addClass("required");
                    $("#pc_cittadino_txt").addClass("required");
                }
                if (data.errors.pc_statoEuropeo) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_statoEuropeo);
                    $("#pc_statoEuropeo").addClass("required");
                    $("#pc_statoEuropeo_txt").addClass("required");
                }
                if (data.errors.pc_condanne) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_condanne);
                    $("#pc_condanne").addClass("required");
                    $("#pc_condanne_txt").addClass("required");
                }
                if (data.errors.pc_titoloStudio) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_titoloStudio);
                    $("#pc_titoloStudio").addClass("required");
                    $("#pc_titoloStudio_txt").addClass("required");
                }
                if (data.errors.pc_titoloStudioScuola) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_titoloStudioScuola);
                    $("#pc_titoloStudioScuola").addClass("required");
                    $("#pc_titoloStudio_txt").addClass("required");
                }
                if (data.errors.pc_titoloStudioData) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_titoloStudioData);
                    $("#pc_titoloStudioData").addClass("required");
                    $("#pc_titoloStudio_txt").addClass("required");
                }
                if (data.errors.pc_titoloStudioVoto) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_titoloStudioVoto);
                    $("#pc_titoloStudioVoto").addClass("required");
                    $("#pc_titoloStudio_txt").addClass("required");
                }
                if (data.errors.pc_conoscenzaLinguaEstera) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_conoscenzaLinguaEstera);
                    $("#pc_conoscenzaLinguaEstera").addClass("required");
                    $("#pc_conoscenzaLinguaEstera_txt").addClass("required");
                }
                if (data.errors.pc_titoliPreferenza) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_titoliPreferenza);
                    $("#pc_titoliPreferenza").addClass("required");
                    $("#pc_titoliPreferenza_txt").addClass("required");
                }
                if (data.errors.pc_accettazioneCondizioniBando) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_accettazioneCondizioniBando);
                    $("#pc_accettazioneCondizioniBando").addClass("required");
                    $("#pc_accettazioneCondizioniBando_txt").addClass("required");
                }
                if (data.errors.pc_accettazioneDisposizioniComune) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_accettazioneDisposizioniComune);
                    $("#pc_accettazioneDisposizioniComune").addClass("required");
                    $("#pc_accettazioneDisposizioniComune_txt").addClass("required");
                }
                if (data.errors.pc_accettazioneComunicazioneVariazioniDomicilio) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_accettazioneComunicazioneVariazioniDomicilio);
                    $("#pc_accettazioneComunicazioneVariazioniDomicilio").addClass("required");
                    $("#pc_accettazioneComunicazioneVariazioniDomicilio_txt").addClass("required");
                }
                if (data.errors.pc_uploadCartaIdentitaFronte) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_uploadCartaIdentitaFronte);
                    $("#pc_uploadCartaIdentitaFronte").addClass("required");
                    $("#pc_uploadCartaIdentitaFronte_txt").addClass("required");
                }
                if (data.errors.pc_uploadCartaIdentitaRetro) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_uploadCartaIdentitaRetro);
                    $("#pc_uploadCartaIdentitaRetro").addClass("required");
                    $("#pc_uploadCartaIdentitaRetro_txt").addClass("required");
                }
                if (data.errors.pc_uploadCV) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_uploadCV);
                    $("#pc_uploadCV").addClass("required");
                    $("#pc_uploadCV_txt").addClass("required");
                }
                if (data.errors.pc_uploadTitoliPreferenza) {
                    $("#pc_frm_dati_pnl_return").append(data.errors.pc_uploadTitoliPreferenza);
                    $("#pc_uploadTitoliPreferenza").addClass("required");
                    $("#pc_uploadTitoliPreferenza_txt").addClass("required");
                }

                $("#pc_frm_dati_pnl_return").append("</ul>");

            
                $("#pc_frm_dati_pnl_return").addClass("alert alert-warning");
                
                $('html, body').animate({
                    scrollTop: $("#pc_frm_dati_pnl_return").offset().top
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
    
    $('#pc_conferma_invia').click(function(){
        
        $('#ElaborazioneRichiestaModal').modal('show');
        
        var form = $('#pc_conferma_invia');
        formData = new FormData();
        formParams = form.serializeArray();

        $.each(formParams, function(i,val) {
            formData.append(val.name, val.value);
        });
        
        console.log(formData);
        
        /* prendo la pratica e inserisco il numero che genero e lo inserisco anche nella riga con status bozza */
        $.ajax({
            url: "save_pratica.php",
            type: $('#pc_conferma_invia').attr("method"),
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

    /* END pc_ partecipazione_concorso */
    
    /* START aa_ accesso_atti */
    
    /* visualizza o nascondi aa_opt_richiedenteTitoloRI */
    $("#aa_opt_richiedenteTitoloRI").hide();
    $("#aa_pnl_uploadAffittuario").hide();
    $("#aa_pnl_uploadNotaioRogante").hide();
    $("#aa_pnl_uploadAltroSoggetto").hide();
    $("#aa_pnl_uploadAltriTitoloDescrizione").hide();
    $("#aa_pnl_uploadAttoNotarile").hide();
    $('input[type=radio][name=aa_richiedenteTitolo]').change(function() {
        var richiedenteTitolo = this.value;
        switch (richiedenteTitolo) { 
            case 'AI': 
                $("#aa_opt_richiedenteTitoloRI").hide(200);
                $("#aa_pnl_uploadAffittuario").show(300);
                $("#aa_pnl_uploadAltriTitoloDescrizione").hide();
                break;
            case 'NR': 
                $("#aa_opt_richiedenteTitoloRI").hide(200);
                $("#aa_pnl_uploadAffittuario").hide(200);
                $("#aa_pnl_uploadNotaioRogante").show(300);
                $("#aa_pnl_uploadAltriTitoloDescrizione").hide();
                break;
            case 'AT': 
                $("#aa_opt_richiedenteTitoloRI").hide(200);
                $("#aa_pnl_uploadAffittuario").hide(200);
                $("#aa_pnl_uploadNotaioRogante").hide(200);
                $("#aa_pnl_uploadAltriTitoloDescrizione").show(300);
                break;		
            case 'RI': 
                $("#aa_opt_richiedenteTitoloRI").show(300);
                $("#aa_pnl_uploadAffittuario").hide(200);
                $("#aa_pnl_uploadNotaioRogante").hide(200);
                $("#aa_pnl_uploadAltriTitoloDescrizione").hide(200);
                break;
            default:
                $("#aa_opt_richiedenteTitoloRI").hide(200);
                $("#aa_pnl_uploadAffittuario").hide(200);
                $("#aa_pnl_uploadNotaioRogante").hide(200);
                $("#aa_pnl_uploadAltriTitoloDescrizione").hide(200);
        }
    });
    
    /* script inerenti gli upload dei documenti */
    $('#aa_uploadCartaIdentitaFronte').change(function(e) {
        $('#aa_uploadCartaIdentitaFronte_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#aa_uploadCartaIdentitaFronte_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#aa_uploadCartaIdentitaFronte').val('');
             return false;
        }        
    });
    $('#aa_uploadCartaIdentitaRetro').change(function(e) {
        $('#aa_uploadCartaIdentitaRetro_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#aa_uploadCartaIdentitaRetro_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#aa_uploadCartaIdentitaRetro').val('');
             return false;
        }        
    });
    $('#aa_uploadAffittuario').change(function(e) {
        $('#aa_uploadAffittuario_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#aa_uploadAffittuario_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#aa_uploadAffittuario').val('');
             return false;
        }        
    });    
    $('#aa_uploadAltroSoggetto').change(function(e) {
        $('#aa_uploadAltroSoggetto_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#aa_uploadAltroSoggetto_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#aa_uploadAltroSoggetto').val('');
             return false;
        }        
    });    
    $('#aa_uploadNotaioRogante').change(function(e) {
        $('#aa_uploadNotaioRogante_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#aa_uploadNotaioRogante_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#aa_uploadNotaioRogante').val('');
             return false;
        }        
    });    
    $('#aa_uploadAltriTitoloDescrizione').change(function(e) {
        $('#aa_uploadAltriTitoloDescrizione_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#aa_uploadAltriTitoloDescrizione_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#aa_uploadAltriTitoloDescrizione').val('');
             return false;
        }        
    });    
    $('#aa_uploadAttoNotarile').change(function(e) {
        $('#aa_uploadAttoNotarile_file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var maxFileSize = 500;
        var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'pdf'];
        var checkSize = parseFloat(_size / 1024).toFixed(2);
         //Check if the file size is less than maximum file size
        if (checkSize < maxFileSize) {
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;

            if ($.inArray(fileName.split('.').pop().toLowerCase(), fileExtension) == -1) {
                alert("Formati accettati : "+fileExtension.join(', '));
            }else{
                $('#aa_uploadAttoNotarile_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#aa_uploadAttoNotarile').val('');
             return false;
        }        
    });
    
    /* script inerenti le tre action del form principale */
    $('#aa_btn_back').click(function(){
        window.location.href = 'index.php';
    });
    $('#aa_salva_richiesta_btn_save').click(function(){
        $('#SalvaRichiestaModal').modal('toggle');
        
        var form = $('#aa_frm_dati');
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
            type: $('#aa_frm_dati').attr("method"),
            url: "save_bozza.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                window.location.href = '../attivita_list.php';
            },
            error: function (desc)
            {
                console.log(desc.responseText);
            }
        });
        
        event.preventDefault();
    });
    $('#aa_btn_concludi_richiesta').click(function(){
        var form = $('#aa_frm_dati');
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
            type: $('#aa_frm_dati').attr("method"),
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false
        }).done(function (data) {
            if (!data.success) {
               $("#aa_frm_dati_pnl_return").empty();
                $("#aa_frm_dati_pnl_return").append(
                    "<div style='color: var(--bs-orange);'>ATTENZIONE</div>"
                );
                $("#aa_frm_dati_pnl_return").append("<div>Ci sono alcune informazioni mancanti o errate</div>");
                $("#aa_frm_dati_pnl_return").append("<ul>");

                /* script per segnalare i dati mancanti */
                if (data.errors.dc_richiedente_nome) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.am_richiedente_nome);
                    $("#aa_richiedente_nome").addClass("required");
                    $("#aa_richiedente_nome_txt").addClass("required");
                }
                                
                if (data.errors.am_richiedente_cognome) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.am_richiedente_cognome);
                    $("#aa_richiedente_cognome").addClass("required");
                    $("#aa_richiedente_cognome_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_cf) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.am_richiedente_cf);
                    $("#aa_richiedente_cf").addClass("required");
                    $("#aa_richiedente_cf_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_data_nascita) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.am_richiedente_data_nascita);
                    $("#aa_richiedente_data_nascita").addClass("required");
                    $("#aa_richiedente_data_nascita_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_luogo_nascita) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.am_richiedente_luogo_nascita);
                    $("#aa_richiedente_luogo_nascita").addClass("required");
                    $("#aa_richiedente_luogo_nascita_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_via) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.am_richiedente_via);
                    $("#aa_richiedente_via").addClass("required");
                    $("#aa_richiedente_via_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_localita) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.am_richiedente_localita);
                    $("#aa_richiedente_localita").addClass("required");
                    $("#aa_richiedente_localita_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_provincia) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.am_richiedente_provincia);
                    $("#aa_richiedente_provincia").addClass("required");
                    $("#aa_richiedente_provincia_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_email) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.am_richiedente_email);
                    $("#aa_richiedente_email").addClass("required");
                    $("#aa_richiedente_email_txt").addClass("required");
                }
                
                if (data.errors.am_richiedente_tel) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.am_richiedente_tel);
                    $("#aa_richiedente_tel").addClass("required");
                    $("#aa_richiedente_tel_txt").addClass("required");
                }
                
                if (data.errors.aa_UfficioDestinatarioId) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_UfficioDestinatarioId);
                    $("#aa_UfficioDestinatarioId").addClass("required");
                    $("#aa_UfficioDestinatarioId_txt").addClass("required");
                }
                if (data.errors.aa_pgRuolo) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgRuolo);
                    $("#aa_pgRuolo").addClass("required");
                    $("#aa_pgRuolo_txt").addClass("required");
                }                
                if (data.errors.aa_pgDenominazione) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgDenominazione);
                    $("#aa_pgDenominazione").addClass("required");
                    $("#aa_pgDenominazione_txt").addClass("required");
                }                
                if (data.errors.aa_pgTipologia) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgTipologia);
                    $("#aa_pgTipologia").addClass("required");
                    $("#aa_pgTipologia_txt").addClass("required");
                }                
                if (data.errors.aa_pgSedeLegaleIndirizzo) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgSedeLegaleIndirizzo);
                    $("#aa_pgSedeLegaleIndirizzo").addClass("required");
                    $("#aa_pgSedeLegaleIndirizzo_txt").addClass("required");
                }                
                if (data.errors.aa_pgSedeLegaleLocalita) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgSedeLegaleLocalita);
                    $("#aa_pgSedeLegaleLocalita").addClass("required");
                    $("#aa_pgSedeLegaleLocalita_txt").addClass("required");
                }                
                if (data.errors.aa_pgSedeLegaleProvincia) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgSedeLegaleProvincia);
                    $("#aa_pgSedeLegaleProvincia").addClass("required");
                    $("#aa_pgSedeLegaleProvincia_txt").addClass("required");
                }                
                if (data.errors.aa_pgSedeLegaleCap) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgSedeLegaleCap);
                    $("#aa_pgSedeLegaleCap").addClass("required");
                    $("#aa_pgSedeLegaleCap_txt").addClass("required");
                }                
                if (data.errors.aa_pgCf) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgCf);
                    $("#aa_pgCf").addClass("required");
                    $("#aa_pgCf_txt").addClass("required");
                }                
                if (data.errors.aa_pgPiva) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgPiva);
                    $("#aa_pgPiva").addClass("required");
                    $("#aa_pgPiva_txt").addClass("required");
                }                
                if (data.errors.aa_pgTelefono) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgTelefono);
                    $("#aa_pgTelefono").addClass("required");
                    $("#aa_pgTelefono_txt").addClass("required");
                }                
                if (data.errors.aa_pgEmail) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgEmail);
                    $("#aa_pgEmail").addClass("required");
                    $("#aa_pgEmail_txt").addClass("required");
                }                
                if (data.errors.aa_pgPec) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_pgPec);
                    $("#aa_pgPec").addClass("required");
                    $("#aa_pgPec_txt").addClass("required");
                }
                if (data.errors.aa_richiedenteTitolo) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedenteTitolo);
                    $("#aa_richiedenteTitolo").addClass("required");
                    $("#aa_richiedenteTitolo_txt").addClass("required");
                }
                if (data.errors.aa_uploadAffittuario) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_uploadAffittuario);
                    $("#aa_uploadAffittuario").addClass("required");
                    $("#aa_uploadAffittuario_txt").addClass("required");
                }                
                if (data.errors.aa_uploadNotaioRogante) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_uploadNotaioRogante);
                    $("#aa_uploadNotaioRogante").addClass("required");
                    $("#aa_uploadNotaioRogante_txt").addClass("required");
                }                
                if (data.errors.aa_uploadAltriTitoloDescrizione) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_uploadAltriTitoloDescrizione);
                    $("#aa_uploadAltriTitoloDescrizione").addClass("required");
                    $("#aa_uploadAltriTitoloDescrizione_txt").addClass("required");
                }                
                if (data.errors.aa_richiedenteProfessionistaIncaricatoDa) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedenteProfessionistaIncaricatoDa);
                    $("#aa_richiedenteProfessionistaIncaricatoDa").addClass("required");
                    $("#aa_richiedenteProfessionistaIncaricatoDa_txt").addClass("required");
                }                
                if (data.errors.aa_richiedenteProfessionistaIncaricatoDaNome) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedenteProfessionistaIncaricatoDaNome);
                    $("#aa_richiedenteProfessionistaIncaricatoDaNome").addClass("required");
                    $("#aa_richiedenteProfessionistaIncaricatoDaNome_txt").addClass("required");
                }                
                if (data.errors.aa_richiedenteProfessionistaIncaricatoDaCognome) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedenteProfessionistaIncaricatoDaCognome);
                    $("#aa_richiedenteProfessionistaIncaricatoDaCognome").addClass("required");
                    $("#aa_richiedenteProfessionistaIncaricatoDaCognome_txt").addClass("required");
                }                
                if (data.errors.aa_richiedenteProfessionistaIncaricatoDaCf) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedenteProfessionistaIncaricatoDaCf);
                    $("#aa_richiedenteProfessionistaIncaricatoDaCf").addClass("required");
                    $("#aa_richiedenteProfessionistaIncaricatoDaCf_txt").addClass("required");
                }
                if (data.errors.aa_richiestaTipo) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiestaTipo);
                    $("#aa_richiestaTipo").addClass("required");
                    $("#aa_richiestaTipo_txt").addClass("required");
                }
                if (data.errors.aa_richiestaAtti) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiestaAtti);
                    $("#aa_richiestaAtti").addClass("required");
                    $("#aa_richiestaAtti_txt").addClass("required");
                }
                if (data.errors.aa_motivo) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_motivo);
                    $("#aa_motivo").addClass("required");
                    $("#aa_motivo_txt").addClass("required");
                }
                if (data.errors.aa_motivoAltro) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_motivoAltro);
                    $("#aa_motivoAltro").addClass("required");
                    $("#aa_motivoAltro_txt").addClass("required");
                }                
                if (data.errors.aa_modoRitiro) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_modoRitiro);
                    $("#aa_modoRitiro").addClass("required");
                    $("#aa_modoRitiro_txt").addClass("required");
                }                
                if (data.errors.aa_modoRitiroPostaIndirizzo) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_modoRitiroPostaIndirizzo);
                    $("#aa_modoRitiroPostaIndirizzo").addClass("required");
                    $("#aa_modoRitiroPostaIndirizzo_txt").addClass("required");
                }                
                if (data.errors.aa_modoRitiroPostaLocalita) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_modoRitiroPostaLocalita);
                    $("#aa_modoRitiroPostaLocalita").addClass("required");
                    $("#aa_modoRitiroPostaLocalita_txt").addClass("required");
                }                
                if (data.errors.aa_modoRitiroPostaProvincia) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_modoRitiroPostaProvincia);
                    $("#aa_modoRitiroPostaProvincia").addClass("required");
                    $("#aa_modoRitiroPostaProvincia_txt").addClass("required");
                }                
                if (data.errors.aa_modoRitiroPostaCap) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_modoRitiroPostaCap);
                    $("#aa_modoRitiroPostaCap").addClass("required");
                    $("#aa_modoRitiroPostaCap_txt").addClass("required");
                }                
                if (data.errors.aa_uploadCartaIdentitaFronte) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_uploadCartaIdentitaFronte);
                    $("#aa_uploadCartaIdentitaFronte").addClass("required");
                    $("#aa_uploadCartaIdentitaFronte_txt").addClass("required");
                }                
                if (data.errors.aa_uploadCartaIdentitaRetro) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_uploadCartaIdentitaRetro);
                    $("#aa_uploadCartaIdentitaRetro").addClass("required");
                    $("#aa_uploadCartaIdentitaRetro_txt").addClass("required");
                }                
                $("#aa_frm_dati_pnl_return").append("</ul>");            
                $("#aa_frm_dati_pnl_return").addClass("alert alert-warning");
                
                $('html, body').animate({
                    scrollTop: $("#aa_frm_dati_pnl_return").offset().top
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
    $('#aa_conferma_invia').click(function(){
        
        $('#ElaborazioneRichiestaModal').modal('show');
        
        var form = $('#aa_conferma_invia');
        formData = new FormData();
        formParams = form.serializeArray();

        $.each(formParams, function(i,val) {
            formData.append(val.name, val.value);
        });
        
        console.log(formData);
        
        /* prendo la pratica e inserisco il numero che genero e lo inserisco anche nella riga con status bozza */
        $.ajax({
            url: "save_pratica.php",
            type: $('#aa_conferma_invia').attr("method"),
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
    
    
    /* END aa_ accesso_atti */
});

$(function(){
    $(".deleteLink").click(function(){
       var ServizioId = $(this).data("servizio-id");
       var PraticaId = $(this).data("pratica-id");
       var StatusId = $(this).data("status-id");
       
       $("#confirmServizioId").val(ServizioId);
       $("#confirmPraticaId").val(PraticaId);
       $("#confirmStatusId").val(StatusId);
       
       $('#confirmDialog').modal('toggle');
       
       event.preventDefault();
    });
    

    $(".deleteAttivita").click(function(){
        formData = new FormData();
        formData.append('servizioId', $("#confirmServizioId").val());
        formData.append('praticaId', $("#confirmPraticaId").val());
        formData.append('statusId', $("#confirmStatusId").val());

        $.ajax({
            type: "POST",
            url: "delete_bozza.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                window.location.href = './attivita_list.php';
            },
            error: function (desc)
            {
                console.log(desc.responseText);
            }
        });

        event.preventDefault();
    });
});