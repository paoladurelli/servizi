<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
session_start();

$connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    
/* salvo tutti i dati nel DB nella tabella domanda_contributo */
if(!isset($_POST['dc_bozza_id']) || $_POST['dc_bozza_id'] == ''){

    $sqlINS = "INSERT INTO `domanda_contributo`(status_id,richiedenteNome,richiedenteCognome,richiedenteCf,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,inQualitaDi,beneficiarioNome,beneficiarioCognome,beneficiarioCf,beneficiarioDataNascita,beneficiarioLuogoNascita,beneficiarioVia,beneficiarioLocalita,beneficiarioProvincia,beneficiarioEmail,beneficiarioTel,importoContributo,finalitaContributo,tipoPagamento_id) VALUES (1,'".$_POST['dc_richiedente-nome']."','".$_POST['dc_richiedente-cognome']."','".$_POST['dc_richiedente-cf']."','".$_POST['dc_richiedente-data-nascita']."','".$_POST['dc_richiedente-luogo-nascita']."','".$_POST['dc_richiedente-via']."','".$_POST['dc_richiedente-localita']."','".$_POST['dc_richiedente-provincia']."','".$_POST['dc_richiedente-email']."','".$_POST['dc_richiedente-tel']."','".$_POST['dc_rb_qualita_di']."','".$_POST['dc_beneficiario-nome']."','".$_POST['dc_beneficiario-cognome']."','".$_POST['dc_beneficiario-cf']."','".$_POST['dc_beneficiario-data-nascita']."','".$_POST['dc_beneficiario-luogo-nascita']."','".$_POST['dc_beneficiario-via']."','".$_POST['dc_beneficiario-localita']."','".$_POST['dc_beneficiario-provincia']."','".$_POST['dc_beneficiario-email']."','".$_POST['dc_beneficiario-tel']."','".$_POST['dc_importo-contributo']."','".$_POST['dc_finalita-contributo']."','".$_POST['ckb_pagamento']."')";
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
    $sqlUPD = "UPDATE domanda_contributo SET richiedenteNome = '".$_POST['dc_richiedente-nome']."', richiedenteCognome = '".$_POST['dc_richiedente-cognome']."', richiedenteCf = '".$_POST['dc_richiedente-cf']."', richiedenteDataNascita = '".$_POST['dc_richiedente-data-nascita']."', richiedenteLuogoNascita = '".$_POST['dc_richiedente-luogo-nascita']."', richiedenteVia = '".$_POST['dc_richiedente-via']."', richiedenteLocalita = '".$_POST['dc_richiedente-localita']."', richiedenteProvincia = '".$_POST['dc_richiedente-provincia']."', richiedenteEmail = '".$_POST['dc_richiedente-email']."', richiedenteTel = '".$_POST['dc_richiedente-tel']."', inQualitaDi = '".$_POST['dc_rb_qualita_di']."', beneficiarioNome = '".$_POST['dc_beneficiario-nome']."', beneficiarioCognome = '".$_POST['dc_beneficiario-cognome']."', beneficiarioCf = '".$_POST['dc_beneficiario-cf']."', beneficiarioDataNascita = '".$_POST['dc_beneficiario-data-nascita']."', beneficiarioLuogoNascita = '".$_POST['dc_beneficiario-luogo-nascita']."', beneficiarioVia = '".$_POST['dc_beneficiario-via']."', beneficiarioLocalita = '".$_POST['dc_beneficiario-localita']."', beneficiarioProvincia = '".$_POST['dc_beneficiario-provincia']."', beneficiarioEmail = '".$_POST['dc_beneficiario-email']."', beneficiarioTel = '".$_POST['dc_beneficiario-tel']."', importoContributo = '".$_POST['dc_importo-contributo']."', finalitaContributo = '".$_POST['dc_finalita-contributo']."', tipoPagamento_id = '".$_POST['ckb_pagamento']."' WHERE id = '".$_POST['dc_bozza_id']."'";
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
          $filename = "dc_potere_firma_bozza_" . $new_id . $ext;
          // File path
          $path = $upload_location.$filename;

          // Upload file
        if(move_uploaded_file($_FILES['dc_uploadPotereFirma']['tmp_name'],$path)){
            $files_arr[] = $path;
            /* salvo nel DB i nomi */
            $sqlUPD = "UPDATE domanda_contributo SET uploadPotereFirma = '".$filename."' WHERE id = ".$new_id;
            echo $sqlUPD;
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
                    $sqlUPD = "UPDATE domanda_contributo SET uploadDocumentazione = 'uploadDocumentazione;".$filename."' WHERE id = ".$new_id;
                    $connessioneUPD->query($sqlUPD);
                 }
              }
           }
        }
    }
    /* dc_uploadDocumentazione - end */

/* salvo nelle attitivà la creazione della bozza per domanda_contributo */
    
    
/* salvo nei messaggi che ho una bozza da completare per domanda_contributo */
    
    
    
/* invio risposta al js */
echo json_encode('allright');
die;