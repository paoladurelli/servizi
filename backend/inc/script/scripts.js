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
    
    /* metti in lavorazione la pratica */
    $(".changeStatusLavorazione").click(function(){
        var ServizioId = $(this).data("servizio");
        var PraticaId = $(this).data("id");
        
        formData = new FormData();
        formData.append("ServizioId",ServizioId);
        formData.append("PraticaId", PraticaId);
        
        $.ajax({
            type: "POST",
            url: "ChangeStatusLavorazione.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                if(data.success){
                    window.location.href = 'praticheLavorazione_list.php';
                }
            },
            error: function (data)
            {
                console.log(data.desc);
            }
        });
        event.preventDefault();
    });
    /* accetta la pratica */
    $(".changeStatusAccetta").click(function(){
        var ServizioId = $(this).data("servizio");
        var PraticaId = $(this).data("id");
        
        formData = new FormData();
        formData.append("ServizioId",ServizioId);
        formData.append("PraticaId", PraticaId);
        
        $.ajax({
            type: "POST",
            url: "ChangeStatusAccetta.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                if(data.success){
                    window.location.href = 'praticheAccettate_list.php';
                }
            },
            error: function (desc)
            {
                console.log(desc.statusText);
            }
        });
        event.preventDefault();
    });
    /* rifiuta la pratica */
    $(".changeStatusRifiuta").click(function(){
        var ServizioId = $(this).data("servizio");
        var PraticaId = $(this).data("id");
        var NumeroPratica = $(this).data("numero");
        $("#RifiutaPraticaModal #PraticaRifiutata").text(NumeroPratica);
        $("#RifiutaPraticaModal #ConfermaRifiutoServizioId").val(ServizioId);
        $("#RifiutaPraticaModal #ConfermaRifiutoPraticaId").val(PraticaId);
       
        $('#RifiutaPraticaModal').modal('show');
       
        event.preventDefault();
    });
    $("#conferma_rifiuto_btn_conferma").click(function(){
        formData = new FormData();
        formData.append('ServizioId', $("#RifiutaPraticaModal #ConfermaRifiutoServizioId").val());
        formData.append('PraticaId', $("#RifiutaPraticaModal #ConfermaRifiutoPraticaId").val());
        formData.append('Motivazione', $("#RifiutaPraticaModal #ConfermaRifiutoMotivazione").val());
        $.ajax({
            type: "POST",
            url: "ChangeStatusRifiuta.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                if(data.success){
                    window.location.href = 'praticheRifiutate_list.php';
                }
            },
            error: function (desc)
            {
                console.log(desc.statusText);
            }
        });
        event.preventDefault();
    });
    /* crea nuova bozza */
    $(".creaBozza").click(function(){
        var ServizioId = $(this).data("servizio");
        var PraticaId = $(this).data("id");
        var NumeroPratica = $(this).data("numero");
        
        formData = new FormData();
        formData.append("ServizioId",ServizioId);
        formData.append("PraticaId", PraticaId);
        
        $.ajax({
            type: "POST",
            url: "CreaBozza.php",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data)
            {
                if(data.success){
                    $("#CreaBozzaModal #PraticaRifiutata").text(NumeroPratica);
                    $('#CreaBozzaModal').modal('show');
                    event.preventDefault();
                }
            },
            error: function (desc)
            {
                console.log(desc.statusText);
            }
        });
        event.preventDefault();
    });
});

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
        window.location.href = '../cerca.php?txt=' + $('#input-search').val();
    }
});

/* funzioni cerca - END */