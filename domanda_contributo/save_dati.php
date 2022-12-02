<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
session_start();

$errors = [];
$data = [];

/* check validazione */
if($_POST['dc_richiedente-nome']==""){
    $errors['dc_richiedente-nome'] = "Nome del richiedente non inserito<br/>";
}
if($_POST['dc_richiedente-cognome']==""){
    $errors['dc_richiedente-cognome'] = "Cognome del richiedente non inserito<br/>";
}
if($_POST['dc_richiedente-cf']==""){
    $errors['dc_richiedente-cf'] = "Codice Fiscale del richiedente non inserito<br/>";
}
if($_POST['dc_richiedente-data-nascita']==""){
    $errors['dc_richiedente-data-nascita'] = "Data di nascita del richiedente non inserita<br/>";
}
if($_POST['dc_richiedente-luogo-nascita']==""){
    $errors['dc_richiedente-luogo-nascita'] = "Luogo di Nascita del richiedente non inserito<br/>";
}
if($_POST['dc_richiedente-via']==""){
    $errors['dc_richiedente-via'] = "Via del richiedente non inserita<br/>";
}
if($_POST['dc_richiedente-localita']==""){
    $errors['dc_richiedente-localita'] = "Località del richiedente non inserita<br/>";
}
if($_POST['dc_richiedente-provincia']==""){
    $errors['dc_richiedente-provincia'] = "Provincia del richiedente non inserita<br/>";
}
if($_POST['dc_richiedente-email']==""){
    $errors['dc_richiedente-email'] = "Email del richiedente non inserita<br/>";
}
if($_POST['dc_richiedente-tel']==""){
    $errors['dc_richiedente-tel'] = "Telefono del richiedente non inserito<br/>";
}
if(empty($_POST['dc_rb_qualita_di']) || $_POST['dc_rb_qualita_di']==""){
    $errors['dc_rb_qualita_di'] = "Qualifica del richiedente non inserita<br/>";
}
if($_POST['dc_beneficiario-nome']==""){
    $errors['dc_beneficiario-nome'] = "Nome del beneficiario non inserito<br/>";
}
if($_POST['dc_beneficiario-cognome']==""){
    $errors['dc_beneficiario-cognome'] = "Cognome del beneficiario non inserito<br/>";
}
if($_POST['dc_beneficiario-cf']==""){
    $errors['dc_beneficiario-cf'] = "Codice fiscale del beneficiario non inserito<br/>";
}
if($_POST['dc_beneficiario-data-nascita']==""){
    $errors['dc_beneficiario-data-nascita'] = "Data di nascita del beneficiario non inserita<br/>";
}
if($_POST['dc_beneficiario-luogo-nascita']==""){
    $errors['dc_beneficiario-luogo-nascita'] = "Luogo di nascita del beneficiario non inserito<br/>";
}
if($_POST['dc_beneficiario-via']==""){
    $errors['dc_beneficiario-via'] = "Via e numero civico del beneficiario non inseriti<br/>";
}
if($_POST['dc_beneficiario-localita']==""){
    $errors['dc_beneficiario-localita'] = "Località del beneficiario non inserita<br/>";
}
if($_POST['dc_beneficiario-provincia']==""){
    $errors['dc_beneficiario-provincia'] = "Provincia del beneficiario non inserita<br/>";
}
if($_POST['dc_beneficiario-email']==""){
    $errors['dc_beneficiario-email'] = "E-mail del beneficiario non inserita<br/>";
}
if($_POST['dc_beneficiario-tel']==""){
    $errors['dc_beneficiario-tel'] = "Telefono del beneficiario non inserito<br/>";
}
if($_POST['dc_importo-contributo']==""){
    $errors['dc_importo-contributo'] = "Importo del contributo non inserito<br/>";
}
if($_POST['dc_finalita-contributo']==""){
    $errors['dc_finalita-contributo'] = "Finalità del contributo non inserita<br/>";
}
if($_POST['ckb_pagamento']==""){
    $errors['ckb_pagamento'] = "Metodo di pagamento non selezionato<br/>";
}

if((!empty($_POST['dc_rb_qualita_di']) && $_POST['dc_rb_qualita_di']!="D") && empty($_FILES['dc_uploadPotereFirma'])){
    $errors['dc_uploadPotereFirma'] = "Documento che attesta potere di firma non inserito<br/>";
}


if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

    /* salvo tutti i dati nel DB nella tabella domanda_contributo con status 0 */
    $sqlINS = "INSERT INTO `domanda_contributo`(status_id,richiedenteNome,richiedenteCognome,richiedenteCf,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,inQualitaDi,beneficiarioNome,beneficiarioCognome,beneficiarioCf,beneficiarioDataNascita,beneficiarioLuogoNascita,beneficiarioVia,beneficiarioLocalita,beneficiarioProvincia,beneficiarioEmail,beneficiarioTel,importoContributo,finalitaContributo,tipoPagamento_id) VALUES (0,'".$_POST['dc_richiedente-nome']."','".$_POST['dc_richiedente-cognome']."','".$_POST['dc_richiedente-cf']."','".$_POST['dc_richiedente-data-nascita']."','".$_POST['dc_richiedente-luogo-nascita']."','".$_POST['dc_richiedente-via']."','".$_POST['dc_richiedente-localita']."','".$_POST['dc_richiedente-provincia']."','".$_POST['dc_richiedente-email']."','".$_POST['dc_richiedente-tel']."','".$_POST['dc_rb_qualita_di']."','".$_POST['dc_beneficiario-nome']."','".$_POST['dc_beneficiario-cognome']."','".$_POST['dc_beneficiario-cf']."','".$_POST['dc_beneficiario-data-nascita']."','".$_POST['dc_beneficiario-luogo-nascita']."','".$_POST['dc_beneficiario-via']."','".$_POST['dc_beneficiario-localita']."','".$_POST['dc_beneficiario-provincia']."','".$_POST['dc_beneficiario-email']."','".$_POST['dc_beneficiario-tel']."','".$_POST['dc_importo-contributo']."','".$_POST['dc_finalita-contributo']."','".$_POST['ckb_pagamento']."')";
    $connessioneINS->query($sqlINS);

    $sqlINS = "SELECT id FROM domanda_contributo WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 0 ORDER BY id DESC LIMIT 1";
    $resultINS = $connessioneINS->query($sqlINS);

    if ($resultINS->num_rows > 0) {
    // output data of each row
        while($row = $resultINS->fetch_assoc()) {
            /* tutto ok */
            /* prendo l'id che mi servirà per costruire i nomi dei documenti */
            $new_id = $row['id'];
        }
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
    
    $data['success'] = true;
    $data['message'] = $new_id;
}
echo json_encode($data);