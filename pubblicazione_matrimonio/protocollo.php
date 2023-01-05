<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
session_start();

$data = [];

    /* se la protocollazione è attiva inserisco il numero di protocollo - start */
    if($configDB['ProtocollazioneAttiva']){
        $newProtocollo = getNumeroProtocollo();
        $newProtocolloNumber = getNumeroProtocolloNumber();
                
        $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sqlUPD = "UPDATE pubblicazione_matrimonio SET NumeroProtocollo='".$newProtocollo."' WHERE id = '56'";
        $connessioneUPD->query($sqlUPD);
        
        setNumeroProtocollo($newProtocolloNumber);
    }
    /* se la protocollazione è attiva inserisco il numero di protocollo - end */
