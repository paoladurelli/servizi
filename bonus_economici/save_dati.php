<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
$configData = require '../env/config_servizi.php';
session_start();

$errors = [];
$data = [];

/* check validazione */
if($_POST['be_richiedente_nome']==""){
    $errors['be_richiedente_nome'] = "<li><a href='#be_richiedente_nome_txt'>Inserire il Nome del richiedente</a></li>";
}
if($_POST['be_richiedente_cognome']==""){
    $errors['be_richiedente_cognome'] = "<li><a href='#be_richiedente_cognome_txt'>Inserire il Cognome del richiedente</a></li>";
}
if($_POST['be_richiedente_cf']==""){
    $errors['be_richiedente_cf'] = "<li><a href='#be_richiedente_cf_txt'>Inserire il Codice Fiscale del richiedente</a></li>";
}
if(!isValidCodiceFiscale($_POST['be_richiedente_cf'])){
    $errors['be_richiedente_cf'] = "<li><a href='#be_richiedente_cf_txt'>Codice Fiscale non valido</a></li>";
}
if($_POST['be_richiedente_data_nascita']==""){
    $errors['be_richiedente_data_nascita'] = "<li><a href='#be_richiedente_data_nascita_txt'>Inserire la Data di nascita del richiedente</a></li>";
}
if($_POST['be_richiedente_luogo_nascita']==""){
    $errors['be_richiedente_luogo_nascita'] = "<li><a href='#be_richiedente_luogo_nascita_txt'>Inserire il Luogo di Nascita del richiedente</a></li>";
}
if($_POST['be_richiedente_via']==""){
    $errors['be_richiedente_via'] = "<li><a href='#be_richiedente_via_txt'>Inserire la Via del richiedente</a></li>";
}
if($_POST['be_richiedente_localita']==""){
    $errors['be_richiedente_localita'] = "<li><a href='#be_richiedente_localita_txt'>Inserire la Località del richiedente</a></li>";
}
if($_POST['be_richiedente_localita'] <> $configData['nome_comune']){
    $errors['be_richiedente_localita'] = "<li><a href='#be_richiedente_localita_txt'>Località inserita NON corriponde con il Comune</a></li>";
}
if($_POST['be_richiedente_provincia']==""){
    $errors['be_richiedente_provincia'] = "<li><a href='#be_richiedente_provincia_txt'>Inserire la Provincia del richiedente</a></li>";
}
if($_POST['be_richiedente_email']==""){
    $errors['be_richiedente_email'] = "<li><a href='#be_richiedente_email_txt'>Inserire la Email del richiedente</a></li>";
}
if(!filter_var($_POST['be_richiedente_email'], FILTER_VALIDATE_EMAIL)){
    $errors['be_richiedente_email'] = "<li><a href='#be_richiedente_email_txt'>Email del richiedente NON corretta</a></li>";
}
if($_POST['be_richiedente_tel']==""){
    $errors['be_richiedente_tel'] = "<li><a href='#be_richiedente_tel_txt'>Inserire il Telefono del richiedente</a></li>";
}
if(!isValidTelephoneNumber($_POST['be_richiedente_tel']) == "error"){
    $errors['be_richiedente_tel'] = "<li><a href='#be_richiedente_tel_txt'>Telefono del richiedente NON corretto</a></li>";
}
if(!isset($_POST['be_rb_qualita_di'])){
    $errors['be_rb_qualita_di'] = "<li><a href='#be_rb_qualita_di_txt'>Inserire la Qualifica del richiedente</a></li>";
}
if($_POST['be_beneficiario_nome']==""){
    $errors['be_beneficiario_nome'] = "<li><a href='#be_beneficiario_nome_txt'>Inserire il Nome del beneficiario</a></li>";
}
if($_POST['be_beneficiario_cognome']==""){
    $errors['be_beneficiario_cognome'] = "<li><a href='#be_beneficiario_cognome_txt'>Inserire il Cognome del beneficiario</a></li>";
}
if($_POST['be_beneficiario_cf']==""){
    $errors['be_beneficiario_cf'] = "<li><a href='#be_beneficiario_cf_txt'>Inserire il Codice fiscale del beneficiario</a></li>";
}
if(!isValidCodiceFiscale($_POST['be_beneficiario_cf'])){
    $errors['be_beneficiario_cf'] = "<li><a href='#be_beneficiario_cf_txt'>Codice fiscale del beneficiario NON corretto</a></li>";
}
if($_POST['be_beneficiario_data_nascita']==""){
    $errors['be_beneficiario_data_nascita'] = "<li><a href='#be_beneficiario_data_nascita_txt'>Inserire la Data di nascita del beneficiario</a></li>";
}
if($_POST['be_beneficiario_luogo_nascita']==""){
    $errors['be_beneficiario_luogo_nascita'] = "<li><a href='#be_beneficiario_luogo_nascita_txt'>Inserire il Luogo di nascita del beneficiario</a></li>";
}
if($_POST['be_beneficiario_via']==""){
    $errors['be_beneficiario_via'] = "<li><a href='#be_beneficiario_via_txt'>Inserire la Via e il numero civico del beneficiario</a></li>";
}
if($_POST['be_beneficiario_localita']==""){
    $errors['be_beneficiario_localita'] = "<li><a href='#be_beneficiario_localita_txt'>Inserire la Località del beneficiario</a></li>";
}
if($_POST['be_beneficiario_localita'] <> $configData['nome_comune']){
    $errors['be_beneficiario_localita'] = "<li><a href='#be_beneficiario_localita_txt'>La Località del beneficiario inserita NON corriponde con il Comune</a></li>";
}
if($_POST['be_beneficiario_provincia']==""){
    $errors['be_beneficiario_provincia'] = "<li><a href='#be_beneficiario_provincia_txt'>Inserire la Provincia del beneficiario</a></li>";
}
if($_POST['be_beneficiario_email'] ==""){
    $errors['be_beneficiario_email'] = "<li><a href='#be_beneficiario_email_txt'>Inserire la E-mail del beneficiario</a></li>";
}
if(!filter_var($_POST['be_beneficiario_email'], FILTER_VALIDATE_EMAIL)){
    $errors['be_beneficiario_email'] = "<li><a href='#be_beneficiario_email_txt'>E-mail del beneficiario NON corretta</a></li>";
}
if($_POST['be_beneficiario_tel']==""){
    $errors['be_beneficiario_tel'] = "<li><a href='#be_beneficiario_tel_txt'>Inserire il Telefono del beneficiario</a></li>";
}
if(!isValidTelephoneNumber($_POST['be_beneficiario_tel']) == "error"){
    $errors['be_beneficiario_tel'] = "<li><a href='#be_beneficiario_tel_txt'>Telefono del beneficiario NON corretto</a></li>";
}
if($_POST['be_importo_contributo']==""){
    $errors['be_importo_contributo'] = "<li><a href='#be_importo_contributo_txt'>Inserire l'Importo del contributo</a></li>";
}
if($_POST['be_finalita_contributo']==""){
    $errors['be_finalita_contributo'] = "<li><a href='#be_finalita_contributo_txt'>Inserire la Finalità del contributo</a></li>";
}
if (!isset($_POST['ckb_pagamento'])){
    $errors['ckb_pagamento'] = "<li><a href='#ckb_pagamento_txt'>Selezionare il Metodo di pagamento</a></li>";
}

if((!empty($_POST['be_rb_qualita_di']) && $_POST['be_rb_qualita_di']!="D") && (empty($_FILES['be_uploadPotereFirma']) && $_POST['be_uploadPotereFirmaSaved'] =='')){
    $errors['be_uploadPotereFirma'] = "<li><a href='#be_uploadPotereFirma_txt'>Allegare il Documento che attesta potere di firma</a></li>";
}

if(empty($_FILES['be_uploadIsee']) && $_POST['be_uploadIseeSaved'] ==''){
    $errors['be_uploadIsee'] = "<li><a href='#be_uploadIsee_txt'>Allegare ISEE</a></li>";
}

if(empty($_FILES['be_uploadDocumentazione']) && $_POST['be_uploadDocumentazioneSaved'] ==''){
    $errors['be_uploadDocumentazione'] = "<li><a href='#be_uploadDocumentazione_txt'>Allegare la Documentazione</a></li>";
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    /* salvo tutti i dati nel DB nella tabella bonus_economici con status 0 */    
    $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlINS = "INSERT INTO `bonus_economici`(status_id,id_orig,richiedenteNome,richiedenteCognome,richiedenteCf,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,inQualitaDi,beneficiarioNome,beneficiarioCognome,beneficiarioCf,beneficiarioDataNascita,beneficiarioLuogoNascita,beneficiarioVia,beneficiarioLocalita,beneficiarioProvincia,beneficiarioEmail,beneficiarioTel,importoContributo,finalitaContributo,tipoPagamento_id) VALUES (0,'".$_POST['be_bozza_id']."','".addslashes($_POST['be_richiedente_nome'])."','".addslashes($_POST['be_richiedente_cognome'])."','".$_POST['be_richiedente_cf']."','".$_POST['be_richiedente_data_nascita']."','".addslashes($_POST['be_richiedente_luogo_nascita'])."','".addslashes($_POST['be_richiedente_via'])."','".addslashes($_POST['be_richiedente_localita'])."','".$_POST['be_richiedente_provincia']."','".$_POST['be_richiedente_email']."','".$_POST['be_richiedente_tel']."','".$_POST['be_rb_qualita_di']."','".addslashes($_POST['be_beneficiario_nome'])."','".addslashes($_POST['be_beneficiario_cognome'])."','".$_POST['be_beneficiario_cf']."','".$_POST['be_beneficiario_data_nascita']."','".addslashes($_POST['be_beneficiario_luogo_nascita'])."','".addslashes($_POST['be_beneficiario_via'])."','".addslashes($_POST['be_beneficiario_localita'])."','".$_POST['be_beneficiario_provincia']."','".$_POST['be_beneficiario_email']."','".$_POST['be_beneficiario_tel']."','".$_POST['be_importo_contributo']."','".addslashes($_POST['be_finalita_contributo'])."','".$_POST['ckb_pagamento']."')";
    $connessioneINS->query($sqlINS);
    
    $sqlINS = "SELECT id FROM bonus_economici WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 0 ORDER BY id DESC LIMIT 1";
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
    $upload_location = "../uploads/bonus_economici/";
    // To store uploaded files path
    $files_arr = array();

    /* be_uploadPotereFirma - start */
    if(isset($_FILES['be_uploadPotereFirma']['name']) && $_FILES['be_uploadPotereFirma']['name'] != ''){
        // File name INIT
        $filename = $_FILES['be_uploadPotereFirma']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "be_potere_firma_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['be_uploadPotereFirma']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE bonus_economici SET uploadPotereFirma = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['be_uploadPotereFirmaSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE bonus_economici SET uploadPotereFirma = '".$_POST['be_uploadPotereFirmaSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
        }
    }
    /* be_uploadPotereFirma - end */

    /* be_uploadIsee - start */
    if(isset($_FILES['be_uploadIsee']['name']) && $_FILES['be_uploadIsee']['name'] != ''){
        // File name INIT
        $filename = $_FILES['be_uploadIsee']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "be_isee_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['be_uploadIsee']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE bonus_economici SET uploadIsee = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['be_uploadIseeSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE bonus_economici SET uploadIsee = '".$_POST['be_uploadIseeSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
        }
    }
    /* be_uploadIsee - end */

    /* be_uploadDocumentazione - start */
    if(isset($_FILES['be_uploadDocumentazione']) && $_FILES['be_uploadDocumentazione'] != ''){
        // Count total files
        $countfiles = count($_FILES['be_uploadDocumentazione']['name']);
        // Loop all files
        for($index = 0;$index < $countfiles;$index++){

            if(isset($_FILES['be_uploadDocumentazione']['name'][$index]) && $_FILES['be_uploadDocumentazione']['name'][$index] != ''){
                // File name INIT
                $filename = $_FILES['be_uploadDocumentazione']['name'][$index];

                // Get extension
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                // Valid image extension
                $valid_ext = array("png","jpeg","jpg","pdf");

                // Check extension
                if(in_array($ext, $valid_ext)){
                    //New file name
                    $filename = "be_documentazione_bozza_" . $new_id . "_" . $index. "." . $ext;
                    // File path
                    $path = $upload_location.$filename;

                    // Upload file
                    if(move_uploaded_file($_FILES['be_uploadDocumentazione']['tmp_name'][$index],$path)){
                        $files_arr[] = $path;
                        /* salvo nel DB i nomi */
                        $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                        $sqlUPD = "UPDATE bonus_economici SET uploadDocumentazione = CONCAT(uploadDocumentazione, '".$filename.";') WHERE id = ".$new_id;
                        $connessioneUPD->query($sqlUPD);
                    }
                }
            }
        }
    }else{
        if($_POST['be_uploadDocumentazioneSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE bonus_economici SET uploadDocumentazione = '".$_POST['be_uploadDocumentazioneSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
        }
    }
    /* be_uploadDocumentazione - end */


    $data['success'] = true;
    $data['message'] = $new_id;
}
echo json_encode($data);