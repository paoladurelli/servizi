<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
session_start();

$connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    
$richiedenteNome = isset($_POST['pc_richiedente_nome']) ? addslashes($_POST['pc_richiedente_nome']) : "";
$richiedenteCognome = isset($_POST['pc_richiedente_cognome']) ? addslashes($_POST['pc_richiedente_cognome']) : "";
$richiedenteCf = isset($_POST['pc_richiedente_cf']) ? $_POST['pc_richiedente_cf'] : "";
$richiedenteDataNascita = isset($_POST['pc_richiedente_data_nascita']) ? $_POST['pc_richiedente_data_nascita'] : "";
$richiedenteLuogoNascita = isset($_POST['pc_richiedente_luogo_nascita']) ? addslashes($_POST['pc_richiedente_luogo_nascita']) : "";
$richiedenteVia = isset($_POST['pc_richiedente_via']) ? addslashes($_POST['pc_richiedente_via']) : "";
$richiedenteLocalita = isset($_POST['pc_richiedente_localita']) ? addslashes($_POST['pc_richiedente_localita']) : "";
$richiedenteProvincia = isset($_POST['pc_richiedente_provincia']) ? $_POST['pc_richiedente_provincia'] : "";
$richiedenteEmail = isset($_POST['pc_richiedente_email']) ? $_POST['pc_richiedente_email'] : "";
$richiedenteTel = isset($_POST['pc_richiedente_tel']) ? $_POST['pc_richiedente_tel'] : "";
$inQualitaDi = isset($_POST['pc_rb_qualita_di']) ? $_POST['pc_rb_qualita_di'] : "";
$beneficiarioNome = isset($_POST['pc_beneficiario_nome']) ? addslashes($_POST['pc_beneficiario_nome']) : "";
$beneficiarioCognome = isset($_POST['pc_beneficiario_cognome']) ? addslashes($_POST['pc_beneficiario_cognome']) : "";
$beneficiarioCf = isset($_POST['pc_beneficiario_cf']) ? $_POST['pc_beneficiario_cf'] : "";
$beneficiarioDataNascita = isset($_POST['pc_beneficiario_data_nascita']) ? $_POST['pc_beneficiario_data_nascita'] : "";
$beneficiarioLuogoNascita = isset($_POST['pc_beneficiario_luogo_nascita']) ? addslashes($_POST['pc_beneficiario_luogo_nascita']) : "";
$beneficiarioVia = isset($_POST['pc_beneficiario_via']) ? addslashes($_POST['pc_beneficiario_via']) : "";
$beneficiarioLocalita = isset($_POST['pc_beneficiario_localita']) ? addslashes($_POST['pc_beneficiario_localita']) : "";
$beneficiarioProvincia = isset($_POST['pc_beneficiario_provincia']) ? $_POST['pc_beneficiario_provincia'] : "";
$beneficiarioEmail = isset($_POST['pc_beneficiario_email']) ? $_POST['pc_beneficiario_email'] : "";
$beneficiarioTel = isset($_POST['pc_beneficiario_tel']) ? $_POST['pc_beneficiario_tel'] : "";
$importoContributo = isset($_POST['pc_importo_contributo']) ? $_POST['pc_importo_contributo'] : "";
$finalitaContributo = isset($_POST['pc_finalita_contributo']) ? addslashes($_POST['pc_finalita_contributo']) : "";
$tipoPagamento_id = isset($_POST['ckb_pagamento']) ? $_POST['ckb_pagamento'] : "";

/* salvo tutti i dati nel DB nella tabella partecipazione_concorso */
if(!isset($_POST['pc_bozza_id']) || $_POST['pc_bozza_id'] == ''){

    $sqlINS = "INSERT INTO `partecipazione_concorso`(status_id,richiedenteNome,richiedenteCognome,richiedenteCf,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,inQualitaDi,beneficiarioNome,beneficiarioCognome,beneficiarioCf,beneficiarioDataNascita,beneficiarioLuogoNascita,beneficiarioVia,beneficiarioLocalita,beneficiarioProvincia,beneficiarioEmail,beneficiarioTel,importoContributo,finalitaContributo,tipoPagamento_id) VALUES (1,'".$richiedenteNome."','".$richiedenteCognome."','".$richiedenteCf."','".$richiedenteDataNascita."','".$richiedenteLuogoNascita."','".$richiedenteVia."','".$richiedenteLocalita."','".$richiedenteProvincia."','".$richiedenteEmail."','".$richiedenteTel."','".$inQualitaDi."','".$beneficiarioNome."','".$beneficiarioCognome."','".$beneficiarioCf."','".$beneficiarioDataNascita."','".$beneficiarioLuogoNascita."','".$beneficiarioVia."','".$beneficiarioLocalita."','".$beneficiarioProvincia."','".$beneficiarioEmail."','".$beneficiarioTel."','".$importoContributo."','".$finalitaContributo."','".$tipoPagamento_id."')";
    $connessioneINS->query($sqlINS);

    $sqlINS = "SELECT id FROM partecipazione_concorso WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 1 ORDER BY id DESC LIMIT 1";
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
    $sqlUPD = "UPDATE partecipazione_concorso SET richiedenteNome = '". $richiedenteNome ."', richiedenteCognome = '". $richiedenteCognome ."', richiedenteCf = '". $richiedenteCf ."', richiedenteDataNascita = '". $richiedenteDataNascita ."', richiedenteLuogoNascita = '". $richiedenteLuogoNascita ."', richiedenteVia = '". $richiedenteVia ."', richiedenteLocalita = '". $richiedenteLocalita ."', richiedenteProvincia = '". $richiedenteProvincia ."', richiedenteEmail = '". $richiedenteEmail ."', richiedenteTel = '". $richiedenteTel ."', inQualitaDi = '". $inQualitaDi ."', beneficiarioNome = '". $beneficiarioNome ."', beneficiarioCognome = '". $beneficiarioCognome ."', beneficiarioCf = '". $beneficiarioCf ."', beneficiarioDataNascita = '". $beneficiarioDataNascita ."', beneficiarioLuogoNascita = '". $beneficiarioLuogoNascita ."', beneficiarioVia = '". $beneficiarioVia ."', beneficiarioLocalita = '". $beneficiarioLocalita ."', beneficiarioProvincia = '". $beneficiarioProvincia ."', beneficiarioEmail = '". $beneficiarioEmail ."', beneficiarioTel = '". $beneficiarioTel ."', importoContributo = '". $importoContributo ."', finalitaContributo = '". $finalitaContributo ."', tipoPagamento_id = '". $tipoPagamento_id ."' WHERE id = '".$_POST['pc_bozza_id']."'";
    $connessioneUPD->query($sqlUPD);
    $new_id = $_POST['pc_bozza_id'];
}

/* carico i file allegati rinominandoli con bozza_<id_bozza> */
    // Upload Location
    $upload_location = "../uploads/partecipazione_concorso/";
    // To store uploaded files path
    $files_arr = array();

    /* pc_uploadPotereFirma - start */
    if(isset($_FILES['pc_uploadPotereFirma']['name']) && $_FILES['pc_uploadPotereFirma']['name'] != ''){
        // File name INIT
        $filename = $_FILES['pc_uploadPotereFirma']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "pc_potere_firma_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['pc_uploadPotereFirma']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE partecipazione_concorso SET uploadPotereFirma = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* pc_uploadPotereFirma - end */

    /* pc_uploadDocumentazione - start */
    if(isset($_FILES['pc_uploadDocumentazione']) && $_FILES['pc_uploadDocumentazione'] != ''){
        // Count total files
        $countfiles = count($_FILES['pc_uploadDocumentazione']['name']);
        // Loop all files
        for($index = 0;$index < $countfiles;$index++){

            if(isset($_FILES['pc_uploadDocumentazione']['name'][$index]) && $_FILES['pc_uploadDocumentazione']['name'][$index] != ''){
                // File name INIT
                $filename = $_FILES['pc_uploadDocumentazione']['name'][$index];

                // Get extension
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                // Valid image extension
                $valid_ext = array("png","jpeg","jpg","pdf");

                // Check extension
                if(in_array($ext, $valid_ext)){
                    //New file name
                    $filename = "pc_documentazione_bozza_" . $new_id . "_" . $index. "." . $ext;
                    // File path
                    $path = $upload_location.$filename;

                    // Upload file
                    if(move_uploaded_file($_FILES['pc_uploadDocumentazione']['tmp_name'][$index],$path)){
                        $files_arr[] = $path;
                        /* salvo nel DB i nomi */
                        $sqlUPD = "UPDATE partecipazione_concorso SET uploadDocumentazione = CONCAT(uploadDocumentazione, '".$filename.";') WHERE id = ".$new_id;
                        $connessioneUPD->query($sqlUPD);
                    }
                }
            }
        }
    }
    /* pc_uploadDocumentazione - end */

/* salvo nelle attitivà la creazione o modifica della bozza per partecipazione_concorso */
    $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id,data_attivita) VALUES ('".$_POST['pc_richiedente_cf']."',16,".$new_id.",1,'".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);
    
    
/* salvo nei messaggi che ho una bozza da completare per partecipazione_concorso */
    $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo,data_msg) VALUES ('".$_POST['pc_richiedente_cf']."',16,'La tua richiesta di iscrizione al concorso è stata salvata come  bozza','".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);
    
/* invio risposta al js */
echo json_encode('allright');