<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
session_start();

$connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    
$richiedenteNome = isset($_POST['pm_richiedente_nome']) ? addslashes($_POST['pm_richiedente_nome']) : "";
$richiedenteCognome = isset($_POST['pm_richiedente_cognome']) ? addslashes($_POST['pm_richiedente_cognome']) : "";
$richiedenteCf = isset($_POST['pm_richiedente_cf']) ? $_POST['pm_richiedente_cf'] : "";
$richiedenteDataNascita = isset($_POST['pm_richiedente_data_nascita']) ? $_POST['pm_richiedente_data_nascita'] : "";
$richiedenteLuogoNascita = isset($_POST['pm_richiedente_luogo_nascita']) ? addslashes($_POST['pm_richiedente_luogo_nascita']) : "";
$richiedenteStatoNascita = isset($_POST['pm_richiedenteStatoNascita']) ? addslashes($_POST['pm_richiedenteStatoNascita']) : "";
$richiedenteVia = isset($_POST['pm_richiedente_via']) ? addslashes($_POST['pm_richiedente_via']) : "";
$richiedenteLocalita = isset($_POST['pm_richiedente_localita']) ? addslashes($_POST['pm_richiedente_localita']) : "";
$richiedenteProvincia = isset($_POST['pm_richiedente_provincia']) ? $_POST['pm_richiedente_provincia'] : "";
$richiedenteEmail = isset($_POST['pm_richiedente_email']) ? $_POST['pm_richiedente_email'] : "";
$richiedenteTel = isset($_POST['pm_richiedente_tel']) ? $_POST['pm_richiedente_tel'] : "";
$richiedenteStatoCivile = isset($_POST['pm_richiedenteStatoCivile']) ? $_POST['pm_richiedenteStatoCivile'] : "";
$richiedenteAttoNascita = isset($_POST['pm_richiedenteAttoNascita']) ? $_POST['pm_richiedenteAttoNascita'] : "";
$richiedenteAttoNascitaData = isset($_POST['pm_richiedenteAttoNascitaData']) ? $_POST['pm_richiedenteAttoNascitaData'] : "";

$coniugeNome = isset($_POST['pm_coniugeNome']) ? $_POST['pm_coniugeNome'] : "";
$coniugeCognome = isset($_POST['pm_coniugeCognome']) ? $_POST['pm_coniugeCognome'] : "";
$coniugeCf = isset($_POST['pm_coniugeCf']) ? $_POST['pm_coniugeCf'] : "";
$coniugeDataNascita = isset($_POST['pm_coniugeDataNascita']) ? $_POST['pm_coniugeDataNascita'] : "";
$coniugeLuogoNascita = isset($_POST['pm_coniugeLuogoNascita']) ? $_POST['pm_coniugeLuogoNascita'] : "";
$coniugeStatoNascita = isset($_POST['pm_coniugeStatoNascita']) ? $_POST['pm_coniugeStatoNascita'] : "";
$coniugeVia = isset($_POST['pm_coniugeVia']) ? $_POST['pm_coniugeVia'] : "";
$coniugeLocalita = isset($_POST['pm_coniugeLocalita']) ? $_POST['pm_coniugeLocalita'] : "";
$coniugeProvincia = isset($_POST['pm_coniugeProvincia']) ? $_POST['pm_coniugeProvincia'] : "";
$coniugeEmail = isset($_POST['pm_coniugeEmail']) ? $_POST['pm_coniugeEmail'] : "";
$coniugeTel = isset($_POST['pm_coniugeTel']) ? $_POST['pm_coniugeTel'] : "";
$coniugeStatoCivile = isset($_POST['pm_coniugeStatoCivile']) ? $_POST['pm_coniugeStatoCivile'] : "";
$coniugeAttoNascita = isset($_POST['pm_coniugeAttoNascita']) ? $_POST['pm_coniugeAttoNascita'] : "";
$coniugeAttoNascitaData = isset($_POST['pm_coniugeAttoNascitaData']) ? $_POST['pm_coniugeAttoNascitaData'] : "";

$writeMessages = false;
/* salvo tutti i dati nel DB nella tabella pubblicazione_matrimonio */
if(!isset($_POST['pm_bozza_id']) || $_POST['pm_bozza_id'] == ''){

    $sqlINS = "INSERT INTO `pubblicazione_matrimonio`(status_id,richiedenteNome,richiedenteCognome,richiedenteCf,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,richiedenteStatoNascita,richiedenteStatoCivile,richiedenteAttoNascita,richiedenteAttoNascitaData,coniugeNome,coniugeCognome,coniugeCf,coniugeDataNascita,coniugeLuogoNascita,coniugeStatoNascita,coniugeVia,coniugeLocalita,coniugeProvincia,coniugeEmail,coniugeTel,coniugeStatoCivile,coniugeAttoNascita,coniugeAttoNascitaData) VALUES (1,'".$richiedenteNome."','".$richiedenteCognome."','".$richiedenteCf."','".$richiedenteDataNascita."','".$richiedenteLuogoNascita."','".$richiedenteVia."','".$richiedenteLocalita."','".$richiedenteProvincia."','".$richiedenteEmail."','".$richiedenteTel."','".$richiedenteStatoNascita."','".$richiedenteStatoCivile."','".$richiedenteAttoNascita."','".$richiedenteAttoNascitaData."','".$coniugeNome."','".$coniugeCognome."','".$coniugeCf."','".$coniugeDataNascita."','".$coniugeLuogoNascita."','".$coniugeStatoNascita."','".$coniugeVia."','".$coniugeLocalita."','".$coniugeProvincia."','".$coniugeEmail."','".$coniugeTel."','".$coniugeStatoCivile."','".$coniugeAttoNascita."','".$coniugeAttoNascitaData."')";
    $connessioneINS->query($sqlINS);

    $sqlINS = "SELECT id FROM pubblicazione_matrimonio WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 1 ORDER BY id DESC LIMIT 1";
    $resultINS = $connessioneINS->query($sqlINS);

    if ($resultINS->num_rows > 0) {
    // output data of each row
        while($row = $resultINS->fetch_assoc()) {
            /* tutto ok */
            /* prendo l'id che mi servirà per costruire i nomi dei documenti */
            $new_id = $row['id'];
            $writeMessages = true;
        }
    }
}else{
    /* se esiste già la bozza vado a modificarne i dati */
    $sqlUPD = "UPDATE pubblicazione_matrimonio SET richiedenteNome = '". $richiedenteNome ."', richiedenteCognome = '". $richiedenteCognome ."', richiedenteCf = '". $richiedenteCf ."', richiedenteDataNascita = '". $richiedenteDataNascita ."', richiedenteLuogoNascita = '". $richiedenteLuogoNascita ."', richiedenteVia = '". $richiedenteVia ."', richiedenteLocalita = '". $richiedenteLocalita ."', richiedenteProvincia = '". $richiedenteProvincia ."', richiedenteEmail = '". $richiedenteEmail ."', richiedenteTel = '". $richiedenteTel ."', richiedenteStatoNascita = '". $richiedenteStatoNascita ."', richiedenteStatoCivile = '". $richiedenteStatoCivile ."', richiedenteAttoNascita = '". $richiedenteAttoNascita ."', richiedenteAttoNascitaData = '". $richiedenteAttoNascitaData ."', coniugeNome = '". $coniugeNome ."', coniugeCognome = '". $coniugeCognome ."', coniugeCf = '". $coniugeCf ."', coniugeDataNascita = '". $coniugeDataNascita ."', coniugeLuogoNascita = '". $coniugeLuogoNascita ."', coniugeStatoNascita = '". $coniugeStatoNascita ."', coniugeVia = '". $coniugeVia ."', coniugeLocalita = '". $coniugeLocalita ."', coniugeProvincia = '". $coniugeProvincia ."', coniugeEmail = '". $coniugeEmail ."', coniugeTel = '". $coniugeTel ."', coniugeStatoCivile = '". $coniugeStatoCivile ."', coniugeAttoNascita = '". $coniugeAttoNascita ."', coniugeAttoNascitaData = '". $coniugeAttoNascitaData ."' WHERE id = '".$_POST['pm_bozza_id']."'";
    $connessioneUPD->query($sqlUPD);
    $new_id = $_POST['pm_bozza_id'];
}

if($writeMessages){    
    /* salvo nelle attitivà la creazione o modifica della bozza per pubblicazione_matrimonio */
    $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id,data_attivita) VALUES ('".$_POST['pm_richiedente_cf']."',5,".$new_id.",1,'".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);

    /* salvo nei messaggi che ho una bozza da completare per pubblicazione_matrimonio */
    $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo,data_msg) VALUES ('".$_POST['pm_richiedente_cf']."',5,'La tua richiesta di pubblicazione di matrimonio è stata salvata come  bozza','".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);
}    
/* invio risposta al js */
echo json_encode('allright');