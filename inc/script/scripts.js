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
        $("#dc_PotereFirma").hide();
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
        $("#dc_PotereFirma").show();
    }
});
$('input[type=radio][name=be_rb_qualita_di]').change(function() {
    if (this.value === 'D') {
        $('#be_beneficiario_nome').val($('#be_richiedente_nome').val());
        $('#be_beneficiario_nome').prop( "disabled", true );
        $('#be_beneficiario_cognome').val($('#be_richiedente_cognome').val());
        $('#be_beneficiario_cognome').prop( "disabled", true );
        $('#be_beneficiario_cf').val($('#be_richiedente_cf').val());
        $('#be_beneficiario_cf').prop( "disabled", true );
        $('#be_beneficiario_data_nascita').val($('#be_richiedente_data_nascita').val());
        $('#be_beneficiario_data_nascita').prop( "disabled", true );
        $('#be_beneficiario_luogo_nascita').val($('#be_richiedente_luogo_nascita').val());
        $('#be_beneficiario_luogo_nascita').prop( "disabled", true );
        /* Indirizzo */
        $('#be_beneficiario_via').val($('#be_richiedente_via').val());
        $('#be_beneficiario_via').prop( "disabled", true );
        $('#be_beneficiario_localita').val($('#be_richiedente_localita').val());
        $('#be_beneficiario_localita').prop( "disabled", true );
        $('#be_beneficiario_provincia').val($('#be_richiedente_provincia').val());
        $('#be_beneficiario_provincia').prop( "disabled", true );
        /* Contatti */
        $('#be_beneficiario_email').val($('#be_richiedente_email').val());
        $('#be_beneficiario_email').prop( "disabled", true );
        $('#be_beneficiario_tel').val($('#be_richiedente_tel').val());
        $('#be_beneficiario_tel').prop( "disabled", true );
        /* tolgo potere di firma come obbligatorio */
        $("#be_uploadPotereFirma_txt").html("Documento che attesta potere di firma");
        $("#be_PotereFirma").hide();
    }
    else{
        $('#be_beneficiario_nome').val('');
        $('#be_beneficiario_nome').prop( "disabled", false );
        $('#be_beneficiario_cognome').val('');
        $('#be_beneficiario_cognome').prop( "disabled", false );
        $('#be_beneficiario_cf').val('');
        $('#be_beneficiario_cf').prop( "disabled", false );
        $('#be_beneficiario_data_nascita').val('');
        $('#be_beneficiario_data_nascita').prop( "disabled", false );
        $('#be_beneficiario_luogo_nascita').val('');
        $('#be_beneficiario_luogo_nascita').prop( "disabled", false );
        /* Indirizzo */
        $('#be_beneficiario_via').val('');
        $('#be_beneficiario_via').prop( "disabled", false );
        $('#be_beneficiario_localita').val('');
        $('#be_beneficiario_localita').prop( "disabled", false );
        $('#be_beneficiario_provincia').val('');
        $('#be_beneficiario_provincia').prop( "disabled", false );
        /* Contatti */
        $('#be_beneficiario_email').val('');
        $('#be_beneficiario_email').prop( "disabled", false );
        $('#be_beneficiario_tel').val('');
        $('#be_beneficiario_tel').prop( "disabled", false );
        /* metto potere di firma come obbligatorio */
        $("#be_uploadPotereFirma_txt").append("*");
        $("#be_PotereFirma").show();
    }
});
$(document).ready(function () {
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
    
    /* gestione metodi di pagamento - START */
    $("#frm_add_metodo_pagamento").submit(function (event) {
        $("#metodi_pagamento_pnl_return").removeClass("alert alert-warning");
        $("#metodi_pagamento_pnl_return").empty();
        
        if($("#metodi_pagamento_ck_pagamento_predefinito").is(':checked') ) { 
            $ck_pagamento_predefinito = 1;
        }else{
            $ck_pagamento_predefinito = 0;
        }
        
        var formData = {
            upd_id : $("#metodi_pagamento_id").val(),
            sel_tipo_pagamento: $("#metodi_pagamento_sel_tipo_pagamento").val(),
            txt_numero_pagamento: $("#metodi_pagamento_txt_numero_pagamento").val(),
            ck_pagamento_predefinito: $ck_pagamento_predefinito
        };

        $.ajax({
            type: "POST",
            url: "../metodi_pagamento_save.php",
            data: formData,
            dataType: "json",
            encode: true
        }).done(function (data) {
            if (!data.success) {
                $("#metodi_pagamento_pnl_return").addClass("alert alert-warning");
                if (data.errors.sel_tipo_pagamento) {
                    $("#metodi_pagamento_pnl_return").append('<div>' + data.errors.sel_tipo_pagamento + '</div>');
                }
                if (data.errors.txt_numero_pagamento) {
                    $("#metodi_pagamento_pnl_return").append('<div>' + data.errors.txt_numero_pagamento + '</div>');
                }
            } else {
                $("#metodi_pagamento_pnl_data").hide();
                $("#metodi_pagamento_pnl_return").addClass("alert alert-success");
                $("#metodi_pagamento_pnl_return").append(data.message);
                $("#pnl_metodi_pagamento").load(" #pnl_metodi_pagamento");
                $("#metodi_pagamento_btn_save").hide();
                $("#metodi_pagamento_btn_close").show();
            }
        })
        .fail(function (data) {
            console.log(data);
        });

        event.preventDefault();
    });
    $('#metodi_pagamento_btn_close').click(function(){
        $("#metodi_pagamento_pnl_data").show();
        $("#metodi_pagamento_pnl_return").removeClass("alert alert-success");
        $("#metodi_pagamento_pnl_return").removeClass("alert alert-warning");
        $("#metodi_pagamento_pnl_return").empty();
        $("#metodi_pagamento_sel_tipo_pagamento").prop('selectedIndex',0);
        $("#metodi_pagamento_id").val('');
        $("#metodi_pagamento_txt_numero_pagamento").val('');
        $('#metodi_pagamento_ck_pagamento_predefinito').prop('checked', false);
        $("#metodi_pagamento_btn_save").show();
    });
    $('#pnl_metodi_pagamento').on('click', '.metodi_pagamento_delete', function () {
        var formData = {
            del_id : $(this).attr('id')
        };
        
        $.ajax({
            type: "POST",
            url: "../metodi_pagamento_delete.php",
            data: formData,
            dataType: "json",
            encode: true
        }).done(function (data) {
            if (data.success) {
                $("#pnl_metodi_pagamento").load(" #pnl_metodi_pagamento");
            }
        })
        .fail(function (data) {
            console.log(data);
        });
        event.preventDefault();
    });
    $('#pnl_metodi_pagamento').on('click', '.metodi_pagamento_update', function () {
        id = $(this).attr('id');
        var formData = {upd_id : id};        
        $.ajax({
            type: "POST",
            url: "../metodi_pagamento_load.php",
            data: formData,
            dataType: "json",
            encode: true
        }).done(function (data) {
            if (data.success) {
                $("#metodi_pagamento_id").val(id);
                $("#metodi_pagamento_sel_tipo_pagamento").val(data.sel_tipo_pagamento);
                $("#metodi_pagamento_txt_numero_pagamento").val(data.txt_numero_pagamento);
                if(data.ck_pagamento_predefinito == '1'){
                    $('#metodi_pagamento_ck_pagamento_predefinito').prop('checked', true);
                }else{
                    $('#metodi_pagamento_ck_pagamento_predefinito').prop('checked', false);
                }
                $('#AddPagamentoModal').modal('toggle');
            }
        })
        .fail(function (data) {
            console.log(data);
        });
        event.preventDefault();
    });
    /* gestione metodi di pagamento - END */
    
    /* START dc_ (domanda_contributo) */
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
    /* visualizza o nascondi upload certificato del datore di lavoro */
    $("input[name$='am_tipoRichiesta']").change(function() {
        if($(this).val() == 'QD') {
            $('#am_DichiarazioneDatoreLavoro').show(300);
        } else {
            $('#am_DichiarazioneDatoreLavoro').hide(200);
        }
    });

   /* visualizza o nascondi am_DichiarazioneSoggiorno e am_DataAffidamento */
    $("#am_DichiarazioneSoggiorno").hide();
    $("#am_DataAffidamento").hide();

    $("input[name$='am_DichiarazioneCittadinanza']").change(function() {
        if($(this).val() == 'E') {
            $("#am_DichiarazioneSoggiorno").show(300);
            $('#am_TitoloSoggiorno').show(300);
        } else {
            $("#am_DichiarazioneSoggiorno").hide(200);
            $('#am_TitoloSoggiorno').hide(200);
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
                if (data.errors.aa_richiedente_nome) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedente_nome);
                    $("#aa_richiedente_nome").addClass("required");
                    $("#aa_richiedente_nome_txt").addClass("required");
                }
                                
                if (data.errors.aa_richiedente_cognome) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedente_cognome);
                    $("#aa_richiedente_cognome").addClass("required");
                    $("#aa_richiedente_cognome_txt").addClass("required");
                }
                
                if (data.errors.aa_richiedente_cf) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedente_cf);
                    $("#aa_richiedente_cf").addClass("required");
                    $("#aa_richiedente_cf_txt").addClass("required");
                }
                
                if (data.errors.aa_richiedente_data_nascita) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedente_data_nascita);
                    $("#aa_richiedente_data_nascita").addClass("required");
                    $("#aa_richiedente_data_nascita_txt").addClass("required");
                }
                
                if (data.errors.aa_richiedente_luogo_nascita) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedente_luogo_nascita);
                    $("#aa_richiedente_luogo_nascita").addClass("required");
                    $("#aa_richiedente_luogo_nascita_txt").addClass("required");
                }
                
                if (data.errors.aa_richiedente_via) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedente_via);
                    $("#aa_richiedente_via").addClass("required");
                    $("#aa_richiedente_via_txt").addClass("required");
                }
                
                if (data.errors.aa_richiedente_localita) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedente_localita);
                    $("#aa_richiedente_localita").addClass("required");
                    $("#aa_richiedente_localita_txt").addClass("required");
                }
                
                if (data.errors.aa_richiedente_provincia) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedente_provincia);
                    $("#aa_richiedente_provincia").addClass("required");
                    $("#aa_richiedente_provincia_txt").addClass("required");
                }
                
                if (data.errors.aa_richiedente_email) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedente_email);
                    $("#aa_richiedente_email").addClass("required");
                    $("#aa_richiedente_email_txt").addClass("required");
                }
                
                if (data.errors.aa_richiedente_tel) {
                    $("#aa_frm_dati_pnl_return").append(data.errors.aa_richiedente_tel);
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
    
    /* START pm_ pubblicazione_matrimonio */   
    /* script inerenti le tre action del form principale */
    $('#pm_btn_back').click(function(){
        window.location.href = 'index.php';
    });
    $('#pm_salva_richiesta_btn_save').click(function(){
        $('#SalvaRichiestaModal').modal('toggle');
        
        var form = $('#pm_frm_dati');
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
            type: $('#pm_frm_dati').attr("method"),
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
    $('#pm_btn_concludi_richiesta').click(function(){
        var form = $('#pm_frm_dati');
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
            type: $('#pm_frm_dati').attr("method"),
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false
        }).done(function (data) {
            if (!data.success) {
               $("#pm_frm_dati_pnl_return").empty();
                $("#pm_frm_dati_pnl_return").append(
                    "<div style='color: var(--bs-orange);'>ATTENZIONE</div>"
                );
                $("#pm_frm_dati_pnl_return").append("<div>Ci sono alcune informazioni mancanti o errate</div>");
                $("#pm_frm_dati_pnl_return").append("<ul>");

                /* script per segnalare i dati mancanti */
                if (data.errors.pm_richiedente_nome) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedente_nome);
                    $("#pm_richiedente_nome").addClass("required");
                    $("#pm_richiedente_nome_txt").addClass("required");
                }
                                
                if (data.errors.pm_richiedente_cognome) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedente_cognome);
                    $("#pm_richiedente_cognome").addClass("required");
                    $("#pm_richiedente_cognome_txt").addClass("required");
                }
                
                if (data.errors.pm_richiedente_cf) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedente_cf);
                    $("#pm_richiedente_cf").addClass("required");
                    $("#pm_richiedente_cf_txt").addClass("required");
                }
                
                if (data.errors.pm_richiedente_data_nascita) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedente_data_nascita);
                    $("#pm_richiedente_data_nascita").addClass("required");
                    $("#pm_richiedente_data_nascita_txt").addClass("required");
                }
                
                if (data.errors.pm_richiedente_luogo_nascita) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedente_luogo_nascita);
                    $("#pm_richiedente_luogo_nascita").addClass("required");
                    $("#pm_richiedente_luogo_nascita_txt").addClass("required");
                }
                
                if (data.errors.pm_richiedente_via) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedente_via);
                    $("#pm_richiedente_via").addClass("required");
                    $("#pm_richiedente_via_txt").addClass("required");
                }
                
                if (data.errors.pm_richiedente_localita) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedente_localita);
                    $("#pm_richiedente_localita").addClass("required");
                    $("#pm_richiedente_localita_txt").addClass("required");
                }
                
                if (data.errors.pm_richiedente_provincia) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedente_provincia);
                    $("#pm_richiedente_provincia").addClass("required");
                    $("#pm_richiedente_provincia_txt").addClass("required");
                }
                
                if (data.errors.pm_richiedente_email) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedente_email);
                    $("#pm_richiedente_email").addClass("required");
                    $("#pm_richiedente_email_txt").addClass("required");
                }
                
                if (data.errors.pm_richiedente_tel) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedente_tel);
                    $("#pm_richiedente_tel").addClass("required");
                    $("#pm_richiedente_tel_txt").addClass("required");
                }
                if (data.errors.pm_richiedenteStatoNascita) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedenteStatoNascita);
                    $("#pm_richiedenteStatoNascita").addClass("required");
                    $("#pm_richiedenteStatoNascita_txt").addClass("required");
                }
                if (data.errors.pm_richiedenteStatoCivile) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedenteStatoCivile);
                    $("#pm_richiedenteStatoCivile").addClass("required");
                    $("#pm_richiedenteStatoCivile_txt").addClass("required");
                }
                if (data.errors.pm_richiedenteAttoNascita) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedenteAttoNascita);
                    $("#pm_richiedenteAttoNascita").addClass("required");
                    $("#pm_richiedenteAttoNascita_txt").addClass("required");
                }
                if (data.errors.pm_richiedenteAttoNascitaData) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_richiedenteAttoNascitaData);
                    $("#pm_richiedenteAttoNascitaData").addClass("required");
                    $("#pm_richiedenteAttoNascitaData_txt").addClass("required");
                }
                if (data.errors.pm_coniugeNome) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeNome);
                    $("#pm_coniugeNome").addClass("required");
                    $("#pm_coniugeNome_txt").addClass("required");
                }
                if (data.errors.pm_coniugeCognome) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeCognome);
                    $("#pm_coniugeCognome").addClass("required");
                    $("#pm_coniugeCognome_txt").addClass("required");
                }
                if (data.errors.pm_coniugeCf) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeCf);
                    $("#pm_coniugeCf").addClass("required");
                    $("#pm_coniugeCf_txt").addClass("required");
                }
                if (data.errors.pm_coniugeDataNascita) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeDataNascita);
                    $("#pm_coniugeDataNascita").addClass("required");
                    $("#pm_coniugeDataNascita_txt").addClass("required");
                }
                if (data.errors.pm_coniugeLuogoNascita) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeLuogoNascita);
                    $("#pm_coniugeLuogoNascita").addClass("required");
                    $("#pm_coniugeLuogoNascita_txt").addClass("required");
                }
                if (data.errors.pm_coniugeStatoNascita) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeStatoNascita);
                    $("#pm_coniugeStatoNascita").addClass("required");
                    $("#pm_coniugeStatoNascita_txt").addClass("required");
                }
                if (data.errors.pm_coniugeVia) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeVia);
                    $("#pm_coniugeVia").addClass("required");
                    $("#pm_coniugeVia_txt").addClass("required");
                }
                if (data.errors.pm_coniugeLocalita) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeLocalita);
                    $("#pm_coniugeLocalita").addClass("required");
                    $("#pm_coniugeLocalita_txt").addClass("required");
                }
                if (data.errors.pm_coniugeProvincia) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeProvincia);
                    $("#pm_coniugeProvincia").addClass("required");
                    $("#pm_coniugeProvincia_txt").addClass("required");
                }
                if (data.errors.pm_coniugeEmail) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeEmail);
                    $("#pm_coniugeEmail").addClass("required");
                    $("#pm_coniugeEmail_txt").addClass("required");
                }
                if (data.errors.pm_coniugeTel) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeTel);
                    $("#pm_coniugeTel").addClass("required");
                    $("#pm_coniugeTel_txt").addClass("required");
                }
                if (data.errors.pm_coniugeStatoCivile) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeStatoCivile);
                    $("#pm_coniugeStatoCivile").addClass("required");
                    $("#pm_coniugeStatoCivile_txt").addClass("required");
                }
                if (data.errors.pm_coniugeAttoNascita) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeAttoNascita);
                    $("#pm_coniugeAttoNascita").addClass("required");
                    $("#pm_coniugeAttoNascita_txt").addClass("required");
                }
                if (data.errors.pm_coniugeAttoNascitaData) {
                    $("#pm_frm_dati_pnl_return").append(data.errors.pm_coniugeAttoNascitaData);
                    $("#pm_coniugeAttoNascitaData").addClass("required");
                    $("#pm_coniugeAttoNascitaData_txt").addClass("required");
                }               
                
                $("#pm_frm_dati_pnl_return").append("</ul>");            
                $("#pm_frm_dati_pnl_return").addClass("alert alert-warning");
                
                $('html, body').animate({
                    scrollTop: $("#pm_frm_dati_pnl_return").offset().top
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
    $('#pm_conferma_invia').click(function(){
        
        $('#ElaborazioneRichiestaModal').modal('show');
        
        var form = $('#pm_conferma_invia');
        formData = new FormData();
        formParams = form.serializeArray();

        $.each(formParams, function(i,val) {
            formData.append(val.name, val.value);
        });
        
        console.log(formData);
        
        /* prendo la pratica e inserisco il numero che genero e lo inserisco anche nella riga con status bozza */
        $.ajax({
            url: "save_pratica.php",
            type: $('#pm_conferma_invia').attr("method"),
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
    /* END pm_ pubblicazione_matrimonoi */
    
    /* START be_ bonus_economici */    
    /* script inerenti gli upload dei documenti */
    $('#be_uploadPotereFirma').change(function(e) {
        $('#be_uploadPotereFirma_file').empty();
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
                $('#be_uploadPotereFirma_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#be_uploadPotereFirma').val('');
             return false;
        }        
    });
    $('#be_uploadIsee').change(function(e) {
        $('#be_uploadIsee_file').empty();
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
                $('#be_uploadIsee_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                return true;
            }
        } else {
             alert('Il file deve pesare al massimo 500 Kb');
             $('#be_uploadIsee').val('');
             return false;
        }        
    });
    $('#be_uploadDocumentazione').change(function(e) {
        $('#be_uploadDocumentazione_file').empty();
        
        var totalfiles = document.getElementById('be_uploadDocumentazione').files.length;
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
                    $('#be_uploadDocumentazione_file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
                    return true;
                }
            } else {
                 alert('Il file deve pesare al massimo 500 Kb');
                 $('#be_uploadDocumentazione').val('');
                 return false;
            }                
        }
    });

    /* script inerenti le tre action del form principale */
    $('#be_btn_back').click(function(){
        window.location.href = 'index.php';
    });
    $('#be_salva_richiesta_btn_save').click(function(){
        $('#SalvaRichiestaModal').modal('toggle');
        
        var form = $('#be_frm_dati');
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
            type: $('#be_frm_dati').attr("method"),
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
    $('#be_btn_concludi_richiesta').click(function(){
        /* tolgo tutti i required */
            $("#be_richiedente_nome").removeClass("required");
            $("#be_richiedente_nome_txt").removeClass("required");
            $("#be_richiedente_cognome").removeClass("required");
            $("#be_richiedente_cognome_txt").removeClass("required");
            $("#be_richiedente_cf").removeClass("required");
            $("#be_richiedente_cf_txt").removeClass("required");
            $("#be_richiedente_data_nascita").removeClass("required");
            $("#be_richiedente_data_nascita_txt").removeClass("required");
            $("#be_richiedente_luogo_nascita").removeClass("required");
            $("#be_richiedente_luogo_nascita_txt").removeClass("required");
            $("#be_richiedente_via").removeClass("required");
            $("#be_richiedente_via_txt").removeClass("required");
            $("#be_richiedente_localita").removeClass("required");
            $("#be_richiedente_localita_txt").removeClass("required");
            $("#be_richiedente_provincia").removeClass("required");
            $("#be_richiedente_provincia_txt").removeClass("required");
            $("#be_richiedente_email").removeClass("required");
            $("#be_richiedente_email_txt").removeClass("required");
            $("#be_richiedente_tel").removeClass("required");
            $("#be_richiedente_tel_txt").removeClass("required");
            $("#be_rb_qualita_di").removeClass("required");
            $("#be_rb_qualita_di_txt").removeClass("required");
            $("#be_beneficiario_nome").removeClass("required");
            $("#be_beneficiario_nome_txt").removeClass("required");
            $("#be_beneficiario_cognome").removeClass("required");
            $("#be_beneficiario_cognome_txt").removeClass("required");
            $("#be_beneficiario_cf").removeClass("required");
            $("#be_beneficiario_cf_txt").removeClass("required");
            $("#be_beneficiario_data_nascita").removeClass("required");
            $("#be_beneficiario_data_nascita_txt").removeClass("required");
            $("#be_beneficiario_luogo_nascita").removeClass("required");
            $("#be_beneficiario_luogo_nascita_txt").removeClass("required");
            $("#be_beneficiario_via").removeClass("required");
            $("#be_beneficiario_via_txt").removeClass("required");
            $("#be_beneficiario_localita").removeClass("required");
            $("#be_beneficiario_localita_txt").removeClass("required");
            $("#be_beneficiario_provincia").removeClass("required");
            $("#be_beneficiario_provincia_txt").removeClass("required");
            $("#be_beneficiario_email").removeClass("required");
            $("#be_beneficiario_email_txt").removeClass("required");
            $("#be_beneficiario_tel").removeClass("required");
            $("#be_beneficiario_tel_txt").removeClass("required");
            $("#be_importo_contributo").removeClass("required");
            $("#be_importo_contributo_txt").removeClass("required");
            $("#be_finalita_contributo").removeClass("required");
            $("#be_finalita_contributo_txt").removeClass("required");
            $("#ckb_pagamento").removeClass("required");
            $("#ckb_pagamento_txt").removeClass("required");
            $("#be_uploadPotereFirma").removeClass("required");
            $("#be_uploadPotereFirma_txt").removeClass("required");
            $("#be_uploadIsee").removeClass("required");
            $("#be_uploadIsee_txt").removeClass("required");
            $("#be_uploadDocumentazione").removeClass("required");
            $("#be_uploadDocumentazione_txt").removeClass("required");

        var form = $('#be_frm_dati');
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
            type: $('#be_frm_dati').attr("method"),
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false
        }).done(function (data) {
            if (!data.success) {
                $("#be_frm_dati_pnl_return").empty();
                $("#be_frm_dati_pnl_return").append(
                    "<div style='color: var(--bs-orange);'>ATTENZIONE</div>"
                );
                $("#be_frm_dati_pnl_return").append("<div>Ci sono alcune informazioni mancanti o errate</div>");
                $("#be_frm_dati_pnl_return").append("<ul>");

                /* script per segnalare i dati mancanti */
                if (data.errors.be_richiedente_nome) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_richiedente_nome);
                    $("#be_richiedente_nome").addClass("required");
                    $("#be_richiedente_nome_txt").addClass("required");
                }
                if (data.errors.be_richiedente_cognome) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_richiedente_cognome);
                    $("#be_richiedente_cognome").addClass("required");
                    $("#be_richiedente_cognome_txt").addClass("required");
                }
                if (data.errors.be_richiedente_cf) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_richiedente_cf);
                    $("#be_richiedente_cf").addClass("required");
                    $("#be_richiedente_cf_txt").addClass("required");
                }
                if (data.errors.be_richiedente_data_nascita) {
                    $("#be_frm_dati_pnl_return").append(data.be_richiedente_data_nascita);
                    $("#be_richiedente_data_nascita").addClass("required");
                    $("#be_richiedente_data_nascita_txt").addClass("required");
                }
                if (data.errors.be_richiedente_luogo_nascita) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_richiedente_luogo_nascita);
                    $("#be_richiedente_luogo_nascita").addClass("required");
                    $("#be_richiedente_luogo_nascita_txt").addClass("required");
                }
                if (data.errors.be_richiedente_via) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_richiedente_via);
                    $("#be_richiedente_via").addClass("required");
                    $("#be_richiedente_via_txt").addClass("required");
                }
                if (data.errors.be_richiedente_localita) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_richiedente_localita);
                    $("#be_richiedente_localita").addClass("required");
                    $("#be_richiedente_localita_txt").addClass("required");
                }
                if (data.errors.be_richiedente_provincia) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_richiedente_provincia);
                    $("#be_richiedente_provincia").addClass("required");
                    $("#be_richiedente_provincia_txt").addClass("required");
                }
                if (data.errors.be_richiedente_email) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_richiedente_email);
                    $("#be_richiedente_email").addClass("required");
                    $("#be_richiedente_email_txt").addClass("required");
                }
                if (data.errors.be_richiedente_tel) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_richiedente_tel);
                    $("#be_richiedente_tel").addClass("required");
                    $("#be_richiedente_tel_txt").addClass("required");
                }
                if (data.errors.be_rb_qualita_di) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_rb_qualita_di);
                    $("#be_rb_qualita_di_txt").addClass("required");
                }
                if (data.errors.be_beneficiario_nome) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_beneficiario_nome);
                    $("#be_beneficiario_nome").addClass("required");
                    $("#be_beneficiario_nome_txt").addClass("required");
                }
                if (data.errors.be_beneficiario_cognome) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_beneficiario_cognome);
                    $("#be_beneficiario_cognome").addClass("required");
                    $("#be_beneficiario_cognome_txt").addClass("required");
                }
                if (data.errors.be_beneficiario_cf) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_beneficiario_cf);
                    $("#be_beneficiario_cf").addClass("required");
                    $("#be_beneficiario_cf_txt").addClass("required");
                }
                if (data.errors.be_beneficiario_data_nascita) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_beneficiario_data_nascita);
                    $("#be_beneficiario_data_nascita").addClass("required");
                    $("#be_beneficiario_data_nascita_txt").addClass("required");
                }
                if (data.errors.be_beneficiario_luogo_nascita) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_beneficiario_luogo_nascita);
                    $("#be_beneficiario_luogo_nascita").addClass("required");
                    $("#be_beneficiario_luogo_nascita_txt").addClass("required");
                }
                if (data.errors.be_beneficiario_via) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_beneficiario_via);
                    $("#be_beneficiario_via").addClass("required");
                    $("#be_beneficiario_via_txt").addClass("required");
                }
                if (data.errors.be_beneficiario_localita) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_beneficiario_localita);
                    $("#be_beneficiario_localita").addClass("required");
                    $("#be_beneficiario_localita_txt").addClass("required");
                }
                if (data.errors.be_beneficiario_provincia) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_beneficiario_provincia);
                    $("#be_beneficiario_provincia").addClass("required");
                    $("#be_beneficiario_provincia_txt").addClass("required");
                }
                if (data.errors.be_beneficiario_email) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_beneficiario_email);
                    $("#be_beneficiario_email").addClass("required");
                    $("#be_beneficiario_email_txt").addClass("required");
                }
                if (data.errors.be_beneficiario_tel) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_beneficiario_tel);
                    $("#be_beneficiario_tel").addClass("required");
                    $("#be_beneficiario_tel_txt").addClass("required");
                }
                if (data.errors.be_importo_contributo) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_importo_contributo);
                    $("#be_importo_contributo").addClass("required");
                    $("#be_importo_contributo_txt").addClass("required");
                }
                if (data.errors.be_finalita_contributo) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_finalita_contributo);
                    $("#be_finalita_contributo").addClass("required");
                    $("#be_finalita_contributo_txt").addClass("required");
                }
                if (data.errors.ckb_pagamento) {
                    $("#be_frm_dati_pnl_return").append(data.errors.ckb_pagamento);
                    $("#ckb_pagamento").addClass("required");
                    $("#ckb_pagamento_txt").addClass("required");
                }
                if (data.errors.be_uploadPotereFirma) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_uploadPotereFirma);
                    $("#be_uploadPotereFirma").addClass("required");
                    $("#be_uploadPotereFirma_txt").addClass("required");
                }
                if (data.errors.be_uploadIsee) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_uploadIsee);
                    $("#be_uploadIsee").addClass("required");
                    $("#be_uploadIsee_txt").addClass("required");
                }
                if (data.errors.be_uploadDocumentazione) {
                    $("#be_frm_dati_pnl_return").append(data.errors.be_uploadDocumentazione);
                    $("#be_uploadDocumentazione").addClass("required");
                    $("#be_uploadDocumentazione_txt").addClass("required");
                }

                $("#be_frm_dati_pnl_return").append("</ul>");

            
                $("#be_frm_dati_pnl_return").addClass("alert alert-warning");
                
                $('html, body').animate({
                    scrollTop: $("#be_frm_dati_pnl_return").offset().top
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
    $('#be_conferma_invia').click(function(){
        
        $('#ElaborazioneRichiestaModal').modal('show');
        
        var form = $('#be_conferma_invia');
        formData = new FormData();
        formParams = form.serializeArray();

        $.each(formParams, function(i,val) {
            formData.append(val.name, val.value);
        });
        
        console.log(formData);
        
        /* prendo la pratica e inserisco il numero che genero e lo inserisco anche nella riga con status bozza */
        $.ajax({
            url: "save_pratica.php",
            type: $('#be_conferma_invia').attr("method"),
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
    /* END be_ */                
});

$(function(){
    /* Cancella Attività - START */
    $(".deleteLink").click(function(){
       var ServizioId = $(this).data("servizio-id");
       var PraticaId = $(this).data("pratica-id");
       var StatusId = $(this).data("status-id");
       var ActualUrl = $(this).data("link");
       
       $("#confirmServizioId").val(ServizioId);
       $("#confirmPraticaId").val(PraticaId);
       $("#confirmStatusId").val(StatusId);
       $("#confirmLink").val(ActualUrl);
       
       $('#confirmDialog').modal('toggle');
       
       event.preventDefault();
    });
    

    $(".deleteAttivita").click(function(){
        formData = new FormData();
        formData.append('servizioId', $("#confirmServizioId").val());
        formData.append('praticaId', $("#confirmPraticaId").val());
        formData.append('statusId', $("#confirmStatusId").val());
        formData.append('ActualUrl', $("#confirmLink").val());

        $.ajax({
            type: "POST",
            url: "delete_bozza.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                window.location.href = data.redirect;
            },
            error: function (desc)
            {
                console.log(desc.responseText);
            }
        });

        event.preventDefault();
    });
    /* Cancella Attività - END */
    
    /* Cancella Messaggi - START */
    $(".deleteMsgConfirm").click(function(){
       var MsgId = $(this).data("msg-id");
       var ActualUrl = $(this).data("link");
       $("#confirmMsgId").val(MsgId);
       $("#confirmLink").val(ActualUrl);
       $('#confirmDialogMsg').modal('toggle');
        event.preventDefault();
    });
    $(".deleteMsg").click(function(){
        formData = new FormData();
        formData.append('MsgId', $("#confirmMsgId").val());
        formData.append('ActualUrl', $("#confirmLink").val());
        $.ajax({
            type: "POST",
            url: "delete_msg.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                window.location.href = data.redirect;
            },
            error: function (desc)
            {
                console.log(desc.responseText);
            }
        });
        event.preventDefault();
    });
        
    $(".deleteThisMsgConfirm").click(function(){
       var ServizioId = $(this).data("servizio-id");
       var ActualUrl = $(this).data("link");
       $("#confirmServizioId").val(ServizioId);
       $("#confirmLink").val(ActualUrl);
       $('#confirmDialogThisMsg').modal('toggle');
        event.preventDefault();
    });
    $(".deleteThisMsg").click(function(){
        formData = new FormData();
        formData.append('ServizioId', $("#confirmServizioId").val());
        formData.append('ActualUrl', $("#confirmLink").val());
        $.ajax({
            type: "POST",
            url: "delete_this_msg.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                window.location.href = data.redirect;
            },
            error: function (desc)
            {
                console.log(desc.responseText);
            }
        });
        event.preventDefault();
    });
    
    $(".deleteAllMsgConfirm").click(function(){
        var ActualUrl = $(this).data("link");
        $("#confirmLink").val(ActualUrl);
        $('#confirmDialogAllMsg').modal('toggle');
        event.preventDefault();
    });
    $(".deleteAllMsg").click(function(){
        formData = new FormData();
        formData.append('ActualUrl', $("#confirmLink").val());
        $.ajax({
            type: "POST",
            url: "delete_all_msg.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                window.location.href = data.redirect;
            },
            error: function (desc)
            {
                console.log(desc.responseText);
            }
        });
        event.preventDefault();
    });
    /* Cancella Messaggi - END */
    
    /* Apri modal per Voto - START */
    $(".addVote").click(function(){
        var ServizioId = $(this).data("servizio-id");
        var PraticaId = $(this).data("pratica-id");
        var ActualUrl = $(this).data("link");
        
        $("#modalRating #tutorial #ServizioId").val(ServizioId);
        $("#modalRating #tutorial #PraticaId").val(PraticaId);
        $("#modalRating #tutorial #ActualUrl").val(ActualUrl);
        
        $('#modalRating').modal('toggle');
        event.preventDefault();
    });    
    /* Apri modal per Voto - END */
});

/* funzioni rating onpage - START */
$("#valutazione_positiva").hide();
$("#valutazione_negativa").hide();

function highlightStar(id) {
    removeHighlight();
    $('#tutorial li').each(function(index) {
        $(this).addClass('highlight');
        if(index+1 >= id){
            return false;
        }
    });
}

function removeHighlight() {
    $('#tutorial li').removeClass('highlight');
}

function addRating(id){
    rating = id;
    $("#tutorial #loader-icon").hide();
    if(rating <= 3){
        $("#tutorial #rating").val(rating);
        $("#valutazione_positiva").hide();
        $("#valutazione_negativa").show();
    }else{
        $("#tutorial #rating").val(rating);
        $("#valutazione_positiva").show();
        $("#valutazione_negativa").hide();
    }
}

function resetRating() {
    $('#tutorial li').removeClass('highlight');
}

$(function(){
    $("#risultato-rating").hide();
    $("#btn_invia_feedback_positivo").click(function(){
        rating = parseInt($("#tutorial #rating").val());
        if($("input[name='positiva']:checked").length > 0){
            formData = new FormData();
            formData.append("userCf", $("#tutorial #userCf").val());
            formData.append("ServizioId",$("#tutorial #ServizioId").val());
            formData.append("PraticaId", $("#tutorial #PraticaId").val());
            formData.append("rating", rating);
            formData.append("positiva", $("input[name='positiva']:checked").val());
            formData.append("negativa", '');
            formData.append("commento", $("#commento_positivo").val());

            $.ajax({
                type: "POST",
                url: "../fun/addRating.php",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data)
                {
                    $("#rating-box").hide();
                    $("#valutazione_positiva").hide();
                    $("#valutazione_negativa").hide();
                    $("#risultato-rating").show();
                },
                error: function (desc)
                {
                    console.log(desc.statusText);
                }
            });
        }else{
            $('#label_commento_positivo').addClass('required');
            event.preventDefault();
        }
    });   
    $("#btn_invia_feedback_negativo").click(function(){
        rating = parseInt($("#tutorial #rating").val());
        if($("input[name='negativa']:checked").length > 0 && $("#commento_negativo").val() != ''){
            formData = new FormData();
            formData.append("userCf", $("#tutorial #userCf").val());
            formData.append("ServizioId",$("#tutorial #ServizioId").val());
            formData.append("PraticaId", $("#tutorial #PraticaId").val());
            formData.append("rating", rating);
            formData.append("positiva", '');
            formData.append("negativa", $("input[name='negativa']:checked").val());
            formData.append("commento", $("#commento_negativo").val());

            $.ajax({
                type: "POST",
                url: "../fun/addRating.php",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data)
                {
                    $("#rating-box").hide();
                    $("#valutazione_positiva").hide();
                    $("#valutazione_negativa").hide();
                    $("#risultato-rating").show();
                },
                error: function (desc)
                {
                    console.log(desc.statusText);
                }
            });
        }else{
            if($("input[name='negativa']:checked").length == 0){
                $('#valutazione_negativa .feed_title p').addClass('required');
            }else{
                $('#valutazione_negativa .feed_title p').removeClass('required');
            }
            if($("#commento_negativo").val() == ''){
                $('#commento_negativo').addClass('required');
            }else{
                $('#commento_negativo').removeClass('required');
            }
            event.preventDefault();            
        }
    });
});
/* funzioni rating onpage - END */

/* funzioni rating modal - START */
$("#modalRating #valutazione_positiva").hide();
$("#modalRating #valutazione_negativa").hide();

function highlightStarModal(id) {
    removeHighlightModal();
    $('#modalRating #tutorial li').each(function(index) {
        $(this).addClass('highlight');
        if(index+1 >= id){
            return false;
        }
    });
}

function removeHighlightModal() {
    $('#modalRating #tutorial li').removeClass('highlight');
}

function addRatingModal(id){
    rating = id;
    $("#modalRating #tutorial #loader-icon").hide();
    if(rating <= 3){
        $("#modalRating #tutorial #rating").val(rating);
        $("#modalRating #valutazione_positiva").hide();
        $("#modalRating #valutazione_negativa").show();
    }else{
        $("#modalRating #tutorial #rating").val(rating);
        $("#modalRating #valutazione_positiva").show();
        $("#modalRating #valutazione_negativa").hide();
    }
}

function resetRatingModal() {
    $('#modalRating #tutorial li').removeClass('highlight');
}

$(function(){
    $("#modalRating #risultato-rating").hide();
    
    $("#modalRating .btnCloseAndReload").click(function(){
        window.location.href = $("#modalRating #tutorial #ActualUrl").val();
        event.preventDefault();
    });
    
    $("#modalRating #btn_invia_feedback_positivo").click(function(){
        rating = parseInt($("#modalRating #tutorial #rating").val());
        if($("#modalRating input[name='negativa']:checked").length > 0 && $("#modalRating #commento_negativo").val() != ''){
            formData = new FormData();
            formData.append("userCf", $("#modalRating #tutorial #userCf").val());
            formData.append("ServizioId",$("#modalRating #tutorial #ServizioId").val());
            formData.append("PraticaId", $("#modalRating #tutorial #PraticaId").val());
            formData.append("rating", rating);
            formData.append("positiva", '');
            formData.append("negativa", $("#modalRating input[name='negativa']:checked").val());
            formData.append("commento", $("#commento_negativo").val());

            $.ajax({
                type: "POST",
                url: "./fun/addRating.php",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data)
                {
                    $("#modalRating #rating-box").hide();
                    $("#modalRating #valutazione_positiva").hide();
                    $("#modalRating #valutazione_negativa").hide();
                    $("#modalRating #risultato-rating").show();
                },
                error: function (desc)
                {
                    console.log(desc.statusText);
                }
            });
        }else{
            if($("#modalRating input[name='negativa']:checked").length == 0){
                $('#modalRating #valutazione_negativa .feed_title p').addClass('required');
            }else{
                $('#modalRating #valutazione_negativa .feed_title p').removeClass('required');
            }
            if($("#modalRating #commento_negativo").val() == ''){
                $('#modalRating #commento_negativo').addClass('required');
            }else{
                $('#modalRating #commento_negativo').removeClass('required');
            }
            event.preventDefault();            
        }
    });
    
    $("#modalRating #btn_invia_feedback_negativo").click(function(){
        rating = parseInt($("#modalRating #tutorial #rating").val());
        if($("#modalRating input[name='negativa']:checked").length > 0 && $("#modalRating #commento_negativo").val() != ''){
            formData = new FormData();
            formData.append("userCf", $("#modalRating #tutorial #userCf").val());
            formData.append("ServizioId",$("#modalRating #tutorial #ServizioId").val());
            formData.append("PraticaId", $("#modalRating #tutorial #PraticaId").val());
            formData.append("rating", rating);
            formData.append("positiva", '');
            formData.append("negativa", $("#modalRating input[name='negativa']:checked").val());
            formData.append("commento", $("#modalRating #commento_negativo").val());

            $.ajax({
                type: "POST",
                url: "./fun/addRating.php",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data)
                {
                    $("#modalRating #rating-box").hide();
                    $("#modalRating #valutazione_positiva").hide();
                    $("#modalRating #valutazione_negativa").hide();
                    $("#modalRating #risultato-rating").show();
                },
                error: function (desc)
                {
                    console.log(desc.statusText);
                }
            });
        }else{
            if($("#modalRating input[name='negativa']:checked").length == 0){
                $('#modalRating #valutazione_negativa .feed_title p').addClass('required');
            }else{
                $('#modalRating #valutazione_negativa .feed_title p').removeClass('required');
            }
            if($("#modalRating #commento_negativo").val() == ''){
                $('#modalRating #commento_negativo').addClass('required');
            }else{
                $('#modalRating #commento_negativo').removeClass('required');
            }
            event.preventDefault();            
        }
    });
});
/* funzioni rating modal - END */

/* funzioni cerca - START */
$('#input-search').bind("enterKey",function(e){
    if($('#input-search').val() == ''){
        event.preventDefault();
    }else{
        window.location.href = 'cerca.php?txt=' + $('#input-search').val();
    }
});
$('#input-search').keyup(function(e){
    if(e.keyCode == 13)
    {
        $(this).trigger("enterKey");
    }
});
$(".btn-search").click(function(){
    if($('#input-search').val() == ''){
        event.preventDefault();
    }else{
        if($('#input-search-where').val() == ''){
            window.location.href = 'cerca.php?txt=' + $('#input-search').val();
        }else{
            window.location.href = '../cerca.php?txt=' + $('#input-search').val();
        }
    }
});

/* funzioni cerca - END */