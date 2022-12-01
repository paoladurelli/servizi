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
        $('#dc_beneficiario-nome').val($('#dc_richiedente-nome').val());
        $('#dc_beneficiario-nome').prop( "disabled", true );
        $('#dc_beneficiario-cognome').val($('#dc_richiedente-cognome').val());
        $('#dc_beneficiario-cognome').prop( "disabled", true );
        $('#dc_beneficiario-cf').val($('#dc_richiedente-cf').val());
        $('#dc_beneficiario-cf').prop( "disabled", true );
        $('#dc_beneficiario-data-nascita').val($('#dc_richiedente-data-nascita').val());
        $('#dc_beneficiario-data-nascita').prop( "disabled", true );
        $('#dc_beneficiario-luogo-nascita').val($('#dc_richiedente-luogo-nascita').val());
        $('#dc_beneficiario-luogo-nascita').prop( "disabled", true );
        /* Indirizzo */
        $('#dc_beneficiario-via').val($('#dc_richiedente-via').val());
        $('#dc_beneficiario-via').prop( "disabled", true );
        $('#dc_beneficiario-localita').val($('#dc_richiedente-localita').val());
        $('#dc_beneficiario-localita').prop( "disabled", true );
        $('#dc_beneficiario-provincia').val($('#dc_richiedente-provincia').val());
        $('#dc_beneficiario-provincia').prop( "disabled", true );
        /* Contatti */
        $('#dc_beneficiario-email').val($('#dc_richiedente-email').val());
        $('#dc_beneficiario-email').prop( "disabled", true );
        $('#dc_beneficiario-tel').val($('#dc_richiedente-tel').val());
        $('#dc_beneficiario-tel').prop( "disabled", true );
    }
    else{
        $('#dc_beneficiario-nome').val('');
        $('#dc_beneficiario-nome').prop( "disabled", false );
        $('#dc_beneficiario-cognome').val('');
        $('#dc_beneficiario-cognome').prop( "disabled", false );
        $('#dc_beneficiario-cf').val('');
        $('#dc_beneficiario-cf').prop( "disabled", false );
        $('#dc_beneficiario-data-nascita').val('');
        $('#dc_beneficiario-data-nascita').prop( "disabled", false );
        $('#dc_beneficiario-luogo-nascita').val('');
        $('#dc_beneficiario-luogo-nascita').prop( "disabled", false );
        /* Indirizzo */
        $('#dc_beneficiario-via').val('');
        $('#dc_beneficiario-via').prop( "disabled", false );
        $('#dc_beneficiario-localita').val('');
        $('#dc_beneficiario-localita').prop( "disabled", false );
        $('#dc_beneficiario-provincia').val('');
        $('#dc_beneficiario-provincia').prop( "disabled", false );
        /* Contatti */
        $('#dc_beneficiario-email').val('');
        $('#dc_beneficiario-email').prop( "disabled", false );
        $('#dc_beneficiario-tel').val('');
        $('#dc_beneficiario-tel').prop( "disabled", false );
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
        $('#dc_uploadPotereFirma-file').empty();
        let fileName = e.target.files[0].name;
        var _size = e.target.files[0].size;
        var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
        i=0;while(_size>900){_size/=1024;i++;}
        var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
        let fileSize = exactSize;
        $('#dc_uploadPotereFirma-file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
    });

    $('#dc_uploadDocumentazione').change(function(e) {
        $('#dc_uploadDocumentazione-file').empty();
        
        var totalfiles = document.getElementById('dc_uploadDocumentazione').files.length;
        for (var index = 0; index < totalfiles; index++) {
            let fileName = e.target.files[index].name;
            var _size = e.target.files[index].size;
            var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
            i=0;while(_size>900){_size/=1024;i++;}
            var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
            let fileSize = exactSize;
            $('#dc_uploadDocumentazione-file').append('<li class="upload-file success"><svg class="icon icon-sm" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-file"></use></svg><p><span class="visually-hidden">File caricato:</span>' + fileName + '<span class="upload-file-weight">' + fileSize + '</span></p><button disabled><span class="visually-hidden">Caricamento ultimato</span><svg class="icon" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-check"></use></svg></button></li>');
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

        /* TO DO*/
        $.ajax({
            type: $('#dc_frm_dati').attr("method"),
            url: "save_bozza.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                alert(data);
                /* fai redirect alla pagina attivita_list.php */                
            },
            error: function (desc)
            {
                console.log(desc.responseText);
            }
        });
        
        event.preventDefault();
    });
    
    
    $('#dc_btn_concludi_richiesta').click(function(){
        /* TO DO */
        /* validazione e salvataggio come tmp */
        $.ajax({
            type: "POST",
            url: "save_dati.php",
            data: $('#dc_frm_dati').serialize(),
            dataType: "json",
            encode: true
        }).done(function (data) {
            if (!data.success) {
                /* script per segnalare i dati mancanti */
                for(var index = 0; index < data.length; index++) {
                    var src = data[index];
                    alert(src);
                }
            } else {
                
            }
        })
        .fail(function (data) {
            console.log(data);
        });

        event.preventDefault();
        
        
        
        window.location.href = 'dichiarazioni.php';
    });
    
    
    /* END dc_ */
    
});


/*
function getUserData(nome){
    alert(nome);
    $('#beneficiario-nome').val(nome);    
}
 */

