/* CUSTOM SCRIPTS PER SERVIZI */

$('input[type=radio][name=rb_qualita_di]').change(function() {
    if (this.value === 'D') {
        $('#beneficiario-nome').val($('#richiedente-nome').val());
        $('#beneficiario-nome').prop( "disabled", true );
        $('#beneficiario-cognome').val($('#richiedente-cognome').val());
        $('#beneficiario-cognome').prop( "disabled", true );
        $('#beneficiario-cf').val($('#richiedente-cf').val());
        $('#beneficiario-cf').prop( "disabled", true );
        $('#beneficiario-data-nascita').val($('#richiedente-data-nascita').val());
        $('#beneficiario-data-nascita').prop( "disabled", true );
        $('#beneficiario-luogo-nascita').val($('#richiedente-luogo-nascita').val());
        $('#beneficiario-luogo-nascita').prop( "disabled", true );
        /* Indirizzo */
        $('#beneficiario-via').val($('#richiedente-via').val());
        $('#beneficiario-via').prop( "disabled", true );
        $('#beneficiario-località').val($('#richiedente-località').val());
        $('#beneficiario-località').prop( "disabled", true );
        $('#beneficiario-provincia').val($('#richiedente-provincia').val());
        $('#beneficiario-provincia').prop( "disabled", true );
        /* Contatti */
        $('#beneficiario-email').val($('#richiedente-email').val());
        $('#beneficiario-email').prop( "disabled", true );
        $('#beneficiario-tel').val($('#richiedente-tel').val());
        $('#beneficiario-tel').prop( "disabled", true );
    }
    else{
        $('#beneficiario-nome').val('');
        $('#beneficiario-nome').prop( "disabled", false );
        $('#beneficiario-cognome').val('');
        $('#beneficiario-cognome').prop( "disabled", false );
        $('#beneficiario-cf').val('');
        $('#beneficiario-cf').prop( "disabled", false );
        $('#beneficiario-data-nascita').val('');
        $('#beneficiario-data-nascita').prop( "disabled", false );
        $('#beneficiario-luogo-nascita').val('');
        $('#beneficiario-luogo-nascita').prop( "disabled", false );
        /* Indirizzo */
        $('#beneficiario-via').val('');
        $('#beneficiario-via').prop( "disabled", false );
        $('#beneficiario-località').val('');
        $('#beneficiario-località').prop( "disabled", false );
        $('#beneficiario-provincia').val('');
        $('#beneficiario-provincia').prop( "disabled", false );
        /* Contatti */
        $('#beneficiario-email').val('');
        $('#beneficiario-email').prop( "disabled", false );
        $('#beneficiario-tel').val('');
        $('#beneficiario-tel').prop( "disabled", false );
    }
});



$(document).ready(function () {
    $("#frm_add_metodo_pagamento").submit(function (event) {
        $("#pnl_return").removeClass();
        $("#pnl_return").empty();

        if($("#ck_pagamento_predefinito").is(':checked') ) { 
            $ck_pagamento_predefinito = 1;
        }else{
            $ck_pagamento_predefinito = 0;
        }
        
        var formData = {
            sel_tipo_pagamento: $("#sel_tipo_pagamento").val(),
            txt_numero_pagamento: $("#txt_numero_pagamento").val(),
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
                $("#pnl_return").addClass("alert alert-warning");
                if (data.errors.sel_tipo_pagamento) {
                    $("#pnl_return").append(
                        '<div>' + data.errors.sel_tipo_pagamento + "</div>"
                    );
                }

                if (data.errors.txt_numero_pagamento) {
                    $("#pnl_return").append(
                        '<div>' + data.errors.txt_numero_pagamento + "</div>"
                    );
                }

            } else {
                $("#pnl_data").hide();
                $("#pnl_return").addClass("alert alert-success");
                $("#pnl_return").append(data.message);
                $("#btn_save_close").attr("data-bs-dismiss","modal");
                $("#btn_save_close").empty().append("Chiudi");
            }
        })
        .fail(function (data) {
            $("form").html(
                '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
            );
        });
        event.preventDefault();
    });
});


/*
function getUserData(nome){
    alert(nome);
    $('#beneficiario-nome').val(nome);    
}
 */

