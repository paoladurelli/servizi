<?php
    /* file di inclusione */
    $configData = require './env/config_servizi.php';
    $configDB = require './env/config.php';
    include './fun/utility.php';

    /* pagina iniziale */
    session_start();

    
    include './template/head.php';
    include './template/header.php';
?>
<main>
    <div id="pnl_metodi_pagamento">
        <?php echo ViewMetodiPagamento(); ?>
    </div>
    <div class="row before-section-small">
        <div class="col-12 text-right">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddPagamentoModal"><svg class="icon"><use href="../lib/svg/sprites.svg#it-plus"></use></svg>Aggiungi</button>
        </div>
    </div>
</main>
<?php include './template/footer.php'; 