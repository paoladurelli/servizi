<?php
function NomeServizioById($Servizio_id){
    $configDBNomeServizioById = require './env/config.php';
    $connessioneNomeServizioById = mysqli_connect($configDBNomeServizioById['db_host'],$configDBNomeServizioById['db_user'],$configDBNomeServizioById['db_pass'],$configDBNomeServizioById['db_name']);
    $sqlNomeServizioById = "SELECT NomeServizio FROM servizi WHERE id = ". $Servizio_id;
    $resultNomeServizioById = $connessioneNomeServizioById->query($sqlNomeServizioById);

    if ($resultNomeServizioById->num_rows > 0) {
    // output data of each row
        while($rowNomeServizioById = $resultNomeServizioById->fetch_assoc()) {
            return $rowNomeServizioById["NomeServizio"];
        }
    }
    $connessioneNomeServizioById->close();
}

