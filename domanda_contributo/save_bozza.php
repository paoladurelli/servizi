<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
session_start();

$connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    
$richiedenteNome = isset($_POST['dc_richiedente_nome']) ? $_POST['dc_richiedente_nome'] : "";
$richiedenteCognome = isset($_POST['dc_richiedente_cognome']) ? $_POST['dc_richiedente_cognome'] : "";
$richiedenteCf = isset($_POST['dc_richiedente_cf']) ? $_POST['dc_richiedente_cf'] : "";
$richiedenteDataNascita = isset($_POST['dc_richiedente_data_nascita']) ? $_POST['dc_richiedente_data_nascita'] : "";
$richiedenteLuogoNascita = isset($_POST['dc_richiedente_luogo_nascita']) ? $_POST['dc_richiedente_luogo_nascita'] : "";
$richiedenteVia = isset($_POST['dc_richiedente_via']) ? $_POST['dc_richiedente_via'] : "";
$richiedenteLocalita = isset($_POST['dc_richiedente_localita']) ? $_POST['dc_richiedente_localita'] : "";
$richiedenteProvincia = isset($_POST['dc_richiedente_provincia']) ? $_POST['dc_richiedente_provincia'] : "";
$richiedenteEmail = isset($_POST['dc_richiedente_email']) ? $_POST['dc_richiedente_email'] : "";
$richiedenteTel = isset($_POST['dc_richiedente_tel']) ? $_POST['dc_richiedente_tel'] : "";
$inQualitaDi = isset($_POST['dc_rb_qualita_di']) ? $_POST['dc_rb_qualita_di'] : "";
$beneficiarioNome = isset($_POST['dc_beneficiario_nome']) ? $_POST['dc_beneficiario_nome'] : "";
$beneficiarioCognome = isset($_POST['dc_beneficiario_cognome']) ? $_POST['dc_beneficiario_cognome'] : "";
$beneficiarioCf = isset($_POST['dc_beneficiario_cf']) ? $_POST['dc_beneficiario_cf'] : "";
$beneficiarioDataNascita = isset($_POST['dc_beneficiario_data_nascita']) ? $_POST['dc_beneficiario_data_nascita'] : "";
$beneficiarioLuogoNascita = isset($_POST['dc_beneficiario_luogo_nascita']) ? $_POST['dc_beneficiario_luogo_nascita'] : "";
$beneficiarioVia = isset($_POST['dc_beneficiario_via']) ? $_POST['dc_beneficiario_via'] : "";
$beneficiarioLocalita = isset($_POST['dc_beneficiario_localita']) ? $_POST['dc_beneficiario_localita'] : "";
$beneficiarioProvincia = isset($_POST['dc_beneficiario_provincia']) ? $_POST['dc_beneficiario_provincia'] : "";
$beneficiarioEmail = isset($_POST['dc_beneficiario_email']) ? $_POST['dc_beneficiario_email'] : "";
$beneficiarioTel = isset($_POST['dc_beneficiario_tel']) ? $_POST['dc_beneficiario_tel'] : "";
$importoContributo = isset($_POST['dc_importo_contributo']) ? $_POST['dc_importo_contributo'] : "";
$finalitaContributo = isset($_POST['dc_finalita_contributo']) ? $_POST['dc_finalita_contributo'] : "";
$tipoPagamento_id = isset($_POST['ckb_pagamento']) ? $_POST['ckb_pagamento'] : "";

/* salvo tutti i dati nel DB nella tabella domanda_contributo */
if(!isset($_POST['dc_bozza_id']) || $_POST['dc_bozza_id'] == ''){

    $sqlINS = "INSERT INTO `domanda_contributo`(status_id,richiedenteNome,richiedenteCognome,richiedenteCf,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,inQualitaDi,beneficiarioNome,beneficiarioCognome,beneficiarioCf,beneficiarioDataNascita,beneficiarioLuogoNascita,beneficiarioVia,beneficiarioLocalita,beneficiarioProvincia,beneficiarioEmail,beneficiarioTel,importoContributo,finalitaContributo,tipoPagamento_id) VALUES (1,'".$richiedenteNome."','".$richiedenteCognome."','".$richiedenteCf."','".$richiedenteDataNascita."','".$richiedenteLuogoNascita."','".$richiedenteVia."','".$richiedenteLocalita."','".$richiedenteProvincia."','".$richiedenteEmail."','".$richiedenteTel."','".$inQualitaDi."','".$beneficiarioNome."','".$beneficiarioCognome."','".$beneficiarioCf."','".$beneficiarioDataNascita."','".$beneficiarioLuogoNascita."','".$beneficiarioVia."','".$beneficiarioLocalita."','".$beneficiarioProvincia."','".$beneficiarioEmail."','".$beneficiarioTel."','".$importoContributo."','".$finalitaContributo."','".$tipoPagamento_id."')";
    $connessioneINS->query($sqlINS);

    $sqlINS = "SELECT id FROM domanda_contributo WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 1 ORDER BY id DESC LIMIT 1";
    $resultINS = $connessioneINS->query($sqlINS);

    if ($resultINS->num_rows > 0) {
    // output data of each row
        while($row = $resultINS->fetch_assoc()) {
            /* tutto ok */
            /* prendo l'id che mi servirà per costruire i nomi dei documenti */
            $new_id = $row['id'];
        }
    }
}else{
    /* se esiste già la bozza vado a modificarne i dati */
    $sqlUPD = "UPDATE domanda_contributo SET richiedenteNome = '". $richiedenteNome ."', richiedenteCognome = '". $richiedenteCognome ."', richiedenteCf = '". $richiedenteCf ."', richiedenteDataNascita = '". $richiedenteDataNascita ."', richiedenteLuogoNascita = '". $richiedenteLuogoNascita ."', richiedenteVia = '". $richiedenteVia ."', richiedenteLocalita = '". $richiedenteLocalita ."', richiedenteProvincia = '". $richiedenteProvincia ."', richiedenteEmail = '". $richiedenteEmail ."', richiedenteTel = '". $richiedenteTel ."', inQualitaDi = '". $inQualitaDi ."', beneficiarioNome = '". $beneficiarioNome ."', beneficiarioCognome = '". $beneficiarioCognome ."', beneficiarioCf = '". $beneficiarioCf ."', beneficiarioDataNascita = '". $beneficiarioDataNascita ."', beneficiarioLuogoNascita = '". $beneficiarioLuogoNascita ."', beneficiarioVia = '". $beneficiarioVia ."', beneficiarioLocalita = '". $beneficiarioLocalita ."', beneficiarioProvincia = '". $beneficiarioProvincia ."', beneficiarioEmail = '". $beneficiarioEmail ."', beneficiarioTel = '". $beneficiarioTel ."', importoContributo = '". $importoContributo ."', finalitaContributo = '". $finalitaContributo ."', tipoPagamento_id = '". $tipoPagamento_id ."' WHERE id = '".$_POST['dc_bozza_id']."'";
    $connessioneUPD->query($sqlUPD);
    $new_id = $_POST['dc_bozza_id'];
}

/* carico i file allegati rinominandoli con bozza_<id_bozza> */
    // Upload Location
    $upload_location = "../uploads/domanda_contributo/";
    // To store uploaded files path
    $files_arr = array();

    /* dc_uploadPotereFirma - start */
    if(isset($_FILES['dc_uploadPotereFirma']['name']) && $_FILES['dc_uploadPotereFirma']['name'] != ''){
        // File name INIT
        $filename = $_FILES['dc_uploadPotereFirma']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "dc_potere_firma_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['dc_uploadPotereFirma']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE domanda_contributo SET uploadPotereFirma = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* dc_uploadPotereFirma - end */

    /* dc_uploadDocumentazione - start */
    if(isset($_FILES['dc_uploadDocumentazione']) && $_FILES['dc_uploadDocumentazione'] != ''){
        // Count total files
        $countfiles = count($_FILES['dc_uploadDocumentazione']['name']);
        // Loop all files
        for($index = 0;$index < $countfiles;$index++){

            if(isset($_FILES['dc_uploadDocumentazione']['name'][$index]) && $_FILES['dc_uploadDocumentazione']['name'][$index] != ''){
                // File name INIT
                $filename = $_FILES['dc_uploadDocumentazione']['name'][$index];

                // Get extension
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                // Valid image extension
                $valid_ext = array("png","jpeg","jpg","pdf");

                // Check extension
                if(in_array($ext, $valid_ext)){
                    //New file name
                    $filename = "dc_documentazione_bozza_" . $new_id . "_" . $index. "." . $ext;
                    // File path
                    $path = $upload_location.$filename;

                    // Upload file
                    if(move_uploaded_file($_FILES['dc_uploadDocumentazione']['tmp_name'][$index],$path)){
                        $files_arr[] = $path;
                        /* salvo nel DB i nomi */
                        $sqlUPD = "UPDATE domanda_contributo SET uploadDocumentazione = CONCAT(uploadDocumentazione, '".$filename.";') WHERE id = ".$new_id;
                        $connessioneUPD->query($sqlUPD);
                    }
                }
            }
        }
    }
    /* dc_uploadDocumentazione - end */

/* salvo nelle attitivà la creazione o modifica della bozza per domanda_contributo */
    $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id) VALUES ('".$_POST['dc_richiedente_cf']."',11,".$new_id.",1)";
    $connessioneINS->query($sqlINS);
    
    
/* salvo nei messaggi che ho una bozza da completare per domanda_contributo */
    $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo) VALUES ('".$_POST['dc_richiedente_cf']."',11,'La tua domanda di contributo è stata salvata come  bozza')";
    $connessioneINS->query($sqlINS);
    
/* invio risposta al js */
echo json_encode('allright');