<?php
include './fun/utility.php';
$configDB = require './env/config.php';
$configData = require './env/config_servizi.php';
session_start();

$errors = [];
$data = [];

/* salvo tutti i dati nel DB nella tabella domanda_contributo con status 0 */    
$connessioneServizi = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$sqlServizi = "SELECT LinkServizio FROM `servizi` WHERE id = ".$_POST['servizioId'];
$resultServizi = $connessioneServizi->query($sqlServizi);

if ($resultServizi->num_rows > 0) {
// output data of each row
    while($rowServizi = $resultServizi->fetch_assoc()) {
        /* prendo il nome della tabella, dalla quale eliminerò la bozza */
        $table = $rowServizi['LinkServizio'];
    }
}

/* Elimina attivita */
$connessioneAttivita = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$sqlAttivita = "DELETE FROM attivita WHERE servizio_id = ".$_POST['servizioId']." AND pratica_id = ".$_POST['praticaId']." AND status_id = ".$_POST['statusId'];
$connessioneAttivita->query($sqlAttivita);
if (($resultAttivita = $connessioneAttivita->query($sqlAttivita)) !== FALSE)
{

    /* Elimina dalla tabella del servizio */
    $connessioneServizio = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlServizio = "DELETE FROM ".$table." WHERE id = ".$_POST['praticaId'];

    if (($resultServizio = $connessioneServizio->query($sqlServizio)) !== FALSE)
    {
        $data['success'] = true;
    }
    else
    {
        $data['success'] = false;
        $errors['description'] = $conn->error;
    }
    
}
else
{
    $data['success'] = false;
    $errors['description'] = $conn->error;
}

echo json_encode($data);
