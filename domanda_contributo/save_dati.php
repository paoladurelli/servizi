<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
$configData = require '../env/config_servizi.php';
session_start();

$errors = [];
$data = [];

/* check validazione */
if($_POST['dc_richiedente_nome']==""){
    $errors['dc_richiedente_nome'] = "<li><a href='#dc_richiedente_nome_txt'>Nome del richiedente</a></li>";
}
if($_POST['dc_richiedente_cognome']==""){
    $errors['dc_richiedente_cognome'] = "<li><a href='#dc_richiedente_cognome_txt'>Cognome del richiedente</a></li>";
}
if($_POST['dc_richiedente_cf']=="" && !isValidCodiceFiscale($_POST['dc_richiedente_cf'])){
    $errors['dc_richiedente_cf'] = "<li><a href='#dc_richiedente_cf_txt'>Codice Fiscale del richiedente</a></li>";
}
if($_POST['dc_richiedente_data_nascita']==""){
    $errors['dc_richiedente_data_nascita'] = "<li><a href='#dc_richiedente_data_nascita_txt'>Data di nascita del richiedente</a></li>";
}
if($_POST['dc_richiedente_luogo_nascita']==""){
    $errors['dc_richiedente_luogo_nascita'] = "<li><a href='#dc_richiedente_luogo_nascita_txt'>Luogo di Nascita del richiedente</a></li>";
}
if($_POST['dc_richiedente_via']==""){
    $errors['dc_richiedente_via'] = "<li><a href='#dc_richiedente_via_txt'>Via del richiedente</a></li>";
}
if($_POST['dc_richiedente_localita']=="" || $_POST['dc_richiedente_localita'] <> $configData['nome_comune']){
    $errors['dc_richiedente_localita'] = "<li><a href='#dc_richiedente_localita_txt'>Località del richiedente</a></li>";
}
if($_POST['dc_richiedente_provincia']==""){
    $errors['dc_richiedente_provincia'] = "<li><a href='#dc_richiedente_provincia_txt'>Provincia del richiedente</a></li>";
}

if($_POST['dc_richiedente_email']=="" || (!filter_var($_POST['dc_richiedente_email'], FILTER_VALIDATE_EMAIL))){
    $errors['dc_richiedente_email'] = "<li><a href='#dc_richiedente_email_txt'>Email del richiedente</a></li>";
}
if($_POST['dc_richiedente_tel']=="" || !isValidTelephoneNumber($_POST['dc_richiedente_tel']) == "error"){
    $errors['dc_richiedente_tel'] = "<li><a href='#dc_richiedente_tel_txt'>Telefono del richiedente</a></li>";
}
if(!isset($_POST['dc_rb_qualita_di'])){
    $errors['dc_rb_qualita_di'] = "<li><a href='#dc_rb_qualita_di_txt'>Qualifica del richiedente</a></li>";
}
if($_POST['dc_beneficiario_nome']==""){
    $errors['dc_beneficiario_nome'] = "<li><a href='#dc_beneficiario_nome_txt'>Nome del beneficiario</a></li>";
}
if($_POST['dc_beneficiario_cognome']==""){
    $errors['dc_beneficiario_cognome'] = "<li><a href='#dc_beneficiario_cognome_txt'>Cognome del beneficiario</a></li>";
}
if($_POST['dc_beneficiario_cf']=="" && !isValidCodiceFiscale($_POST['dc_beneficiario_cf'])){
    $errors['dc_beneficiario_cf'] = "<li><a href='#dc_beneficiario_cf_txt'>Codice fiscale del beneficiario</a></li>";
}
if($_POST['dc_beneficiario_data_nascita']==""){
    $errors['dc_beneficiario_data_nascita'] = "<li><a href='#dc_beneficiario_data_nascita_txt'>Data di nascita del beneficiario</a></li>";
}
if($_POST['dc_beneficiario_luogo_nascita']==""){
    $errors['dc_beneficiario_luogo_nascita'] = "<li><a href='#dc_beneficiario_luogo_nascita_txt'>Luogo di nascita del beneficiario</a></li>";
}
if($_POST['dc_beneficiario_via']==""){
    $errors['dc_beneficiario_via'] = "<li><a href='#dc_beneficiario_via_txt'>Via e numero civico del beneficiario</a></li>";
}
if($_POST['dc_beneficiario_localita']=="" || $_POST['dc_beneficiario_localita'] <> $configData['nome_comune']){
    $errors['dc_beneficiario_localita'] = "<li><a href='#dc_beneficiario_localita_txt'>Località del beneficiario</a></li>";
}
if($_POST['dc_beneficiario_provincia']==""){
    $errors['dc_beneficiario_provincia'] = "<li><a href='#dc_beneficiario_provincia_txt'>Provincia del beneficiario</a></li>";
}
if($_POST['dc_beneficiario_email'] =="" || (!filter_var($_POST['dc_beneficiario_email'], FILTER_VALIDATE_EMAIL))){
    $errors['dc_beneficiario_email'] = "<li><a href='#dc_beneficiario_email_txt'>E-mail del beneficiario</a></li>";
}
if($_POST['dc_beneficiario_tel']=="" || !isValidTelephoneNumber($_POST['dc_beneficiario_tel']) == "error"){
    $errors['dc_beneficiario_tel'] = "<li><a href='#dc_beneficiario_tel_txt'>Telefono del beneficiario</a></li>";
}
if($_POST['dc_importo_contributo']==""){
    $errors['dc_importo_contributo'] = "<li><a href='#dc_importo_contributo_txt'>Importo del contributo</a></li>";
}
if($_POST['dc_finalita_contributo']==""){
    $errors['dc_finalita_contributo'] = "<li><a href='#dc_finalita_contributo_txt'>Finalità del contributo</a></li>";
}
if (!isset($_POST['ckb_pagamento'])){
    $errors['ckb_pagamento'] = "<li><a href='#ckb_pagamento_txt'>Metodo di pagamento</a></li>";
}

if((!empty($_POST['dc_rb_qualita_di']) && $_POST['dc_rb_qualita_di']!="D") && empty($_FILES['dc_uploadPotereFirma'])){
    $errors['dc_uploadPotereFirma'] = "<li><a href='#dc_uploadPotereFirma_txt'>Documento che attesta potere di firma</a></li>";
}

if(empty($_FILES['dc_uploadDocumentazione'])){
    $errors['dc_uploadDocumentazione'] = "<li><a href='#dc_uploadDocumentazione_txt'>Documentazione</a></li>";
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    /* salvo tutti i dati nel DB nella tabella domanda_contributo con status 0 */    
    $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlINS = "INSERT INTO `domanda_contributo`(status_id,richiedenteNome,richiedenteCognome,richiedenteCf,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,inQualitaDi,beneficiarioNome,beneficiarioCognome,beneficiarioCf,beneficiarioDataNascita,beneficiarioLuogoNascita,beneficiarioVia,beneficiarioLocalita,beneficiarioProvincia,beneficiarioEmail,beneficiarioTel,importoContributo,finalitaContributo,tipoPagamento_id) VALUES (0,'".$_POST['dc_richiedente_nome']."','".$_POST['dc_richiedente_cognome']."','".$_POST['dc_richiedente_cf']."','".$_POST['dc_richiedente_data_nascita']."','".$_POST['dc_richiedente_luogo_nascita']."','".$_POST['dc_richiedente_via']."','".$_POST['dc_richiedente_localita']."','".$_POST['dc_richiedente_provincia']."','".$_POST['dc_richiedente_email']."','".$_POST['dc_richiedente_tel']."','".$_POST['dc_rb_qualita_di']."','".$_POST['dc_beneficiario_nome']."','".$_POST['dc_beneficiario_cognome']."','".$_POST['dc_beneficiario_cf']."','".$_POST['dc_beneficiario_data_nascita']."','".$_POST['dc_beneficiario_luogo_nascita']."','".$_POST['dc_beneficiario_via']."','".$_POST['dc_beneficiario_localita']."','".$_POST['dc_beneficiario_provincia']."','".$_POST['dc_beneficiario_email']."','".$_POST['dc_beneficiario_tel']."','".$_POST['dc_importo_contributo']."','".$_POST['dc_finalita_contributo']."','".$_POST['ckb_pagamento']."')";
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
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
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
                        $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
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