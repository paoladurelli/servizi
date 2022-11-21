<!doctype html>
<html lang="it">
<?php 
    /* file di inclusione */
    $configData = require './env/config_servizi.php';
?>    

    <head>
    <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Area personale - <?php echo $configData['nome_comune']; ?></title>
        <link rel="stylesheet" href="./lib/css/bootstrap-italia-comuni.min.css">
        <link href="./inc/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="skiplink">
            <a class="visually-hidden-focusable" href="#main-container">Vai ai contenuti</a>
            <a class="visually-hidden-focusable" href="#footer">Vai al footer</a>
        </div><!-- /skiplink -->