<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
$configData = require '../env/config_servizi.php';
session_start();

$errors = [];
$data = [];

/* check validazione */
if($_POST['am_richiedente_nome']==""){
    $errors['am_richiedente_nome'] = "<li><a href='#dc_richiedente_nome_txt'>Nome del richiedente</a></li>";
}
if($_POST['am_richiedente_cognome']==""){
    $errors['am_richiedente_cognome'] = "<li><a href='#am_richiedente_cognome_txt'>Cognome del richiedente</a></li>";
}
if($_POST['am_richiedente_cf']=="" && !isValidCodiceFiscale($_POST['am_richiedente_cf'])){
    $errors['am_richiedente_cf'] = "<li><a href='#am_richiedente_cf_txt'>Codice Fiscale del richiedente</a></li>";
}
if($_POST['am_richiedente_data_nascita']==""){
    $errors['am_richiedente_data_nascita'] = "<li><a href='#am_richiedente_data_nascita_txt'>Data di nascita del richiedente</a></li>";
}
if($_POST['am_richiedente_luogo_nascita']==""){
    $errors['am_richiedente_luogo_nascita'] = "<li><a href='#am_richiedente_luogo_nascita_txt'>Luogo di Nascita del richiedente</a></li>";
}
if($_POST['am_richiedente_via']==""){
    $errors['am_richiedente_via'] = "<li><a href='#am_richiedente_via_txt'>Via del richiedente</a></li>";
}
if($_POST['am_richiedente_localita']=="" || $_POST['am_richiedente_localita'] <> $configData['nome_comune']){
    $errors['am_richiedente_localita'] = "<li><a href='#am_richiedente_localita_txt'>Località del richiedente</a></li>";
}
if($_POST['am_richiedente_provincia']==""){
    $errors['am_richiedente_provincia'] = "<li><a href='#am_richiedente_provincia_txt'>Provincia del richiedente</a></li>";
}
if($_POST['am_richiedente_email']=="" || (!filter_var($_POST['am_richiedente_email'], FILTER_VALIDATE_EMAIL))){
    $errors['am_richiedente_email'] = "<li><a href='#am_richiedente_email_txt'>Email del richiedente</a></li>";
}
if($_POST['am_richiedente_tel']=="" || !isValidTelephoneNumber($_POST['am_richiedente_tel']) == "error"){
    $errors['am_richiedente_tel'] = "<li><a href='#am_richiedente_tel_txt'>Telefono del richiedente</a></li>";
}

if ($_POST['am_minoreNome']==""){
    $errors['am_minoreNome'] = "<li><a href='#am_minoreNome_txt'>Nome del minore</a></li>";
}

if ($_POST['am_minoreCognome']==""){
    $errors['am_minoreCognome'] = "<li><a href='#am_minoreCognome_txt'>Cognome del minore</a></li>";
}

if ($_POST['am_minoreDataNascita']==""){
    $errors['am_minoreDataNascita'] = "<li><a href='#am_minoreDataNascita_txt'>Data di nascita del minore</a></li>";
}

if ($_POST['am_minoreLuogoNascita']==""){
    $errors['am_minoreLuogoNascita'] = "<li><a href='#am_minoreLuogoNascita_txt'>Luogo di nascita del minore</a></li>";
}

if(!isset($_POST['am_tipoRichiesta']) || $_POST['am_tipoRichiesta']==""){
    $errors['am_tipoRichiesta'] = "<li><a href='#am_tipoRichiesta_txt'>Tipo di richiesta</a></li>";
}

if(!isset($_POST['am_DichiarazioneCittadinanza']) || $_POST['am_DichiarazioneCittadinanza']==""){
    $errors['am_DichiarazioneCittadinanza'] = "<li><a href='#am_DichiarazioneCittadinanza_txt'>Cittadinanza</a></li>";
}

if(isset($_POST['am_DichiarazioneCittadinanza'])){
    if($_POST['am_DichiarazioneCittadinanza']=="E" && empty($_POST['am_DichiarazioneSoggiornoNumero'])){
        $errors['am_DichiarazioneSoggiornoNumero'] = "<li><a href='#am_DichiarazioneSoggiornoNumero_txt'>Numero titolo di soggiorno</a></li>";
    }
    if($_POST['am_DichiarazioneCittadinanza']=="E" && empty($_POST['am_DichiarazioneSoggiornoQuestura'])){
        $errors['am_DichiarazioneSoggiornoQuestura'] = "<li><a href='#am_DichiarazioneSoggiornoQuestura_txt'>Questura di rilascio del titolo di soggiorno</a></li>";
    }
    if($_POST['am_DichiarazioneCittadinanza']=="E" && empty($_POST['am_DichiarazioneSoggiornoData'])){
        $errors['am_DichiarazioneSoggiornoData'] = "<li><a href='#dam_DichiarazioneSoggiornoData_txt'>Data di rilascio del titolo di soggiorno</a></li>";
    }
    if($_POST['am_DichiarazioneCittadinanza']=="E" && empty($_POST['am_DichiarazioneSoggiornoDataRinnovo']) && empty($_POST['am_DichiarazioneSoggiornoData'])){
        $errors['am_DichiarazioneSoggiornoDataRinnovo'] = "<li><a href='#am_DichiarazioneSoggiornoDataRinnovo_txt'>Data di rinnovo del titolo di soggiorno</a></li>";
    }
}

if (!isset($_POST['am_DichiarazioneAffidamento'])) {
    $am_DichiarazioneAffidamento = 0;
}else{
    $am_DichiarazioneAffidamento = $_POST['am_DichiarazioneAffidamento'];
}

if (isset($_POST['am_DichiarazioneAffidamento']) && $_POST['am_DichiarazioneAffidamentoData']==""){
    $errors['am_DichiarazioneAffidamentoData'] = "<li><a href='#am_DichiarazioneAffidamentoData_txt'>Data inizio affido</a></li>";
}

if ($_POST['ckb_pagamento']==""){
    $errors['ckb_pagamento'] = "<li><a href='#ckb_pagamento_txt'>Metodo di pagamento</a></li>";
}

if (empty($_FILES['am_uploadCartaIdentitaFronte'])){
    $errors['am_uploadCartaIdentitaFronte'] = "<li><a href='#am_uploadCartaIdentitaFronte_txt'>Fronte della carta di identità</a></li>";
}

if (empty($_FILES['am_uploadCartaIdentitaRetro'])){
    $errors['am_uploadCartaIdentitaRetro'] = "<li><a href='#am_uploadCartaIdentitaRetro_txt'>Retro della carta di identità</a></li>";
}

if (isset($_POST['am_DichiarazioneCittadinanza']) && $_POST['am_DichiarazioneCittadinanza']=="E" && empty($_FILES['am_uploadTitoloSoggiorno'])){
    $errors['am_uploadTitoloSoggiorno'] = "<li><a href='#am_uploadTitoloSoggiorno_txt'>Titolo di Soggiorno oppure ricevuta della richiesta di rilascio del permesso di soggiorno</a></li>";
}

if (isset($_POST['am_tipoRichiesta']) && $_POST['am_tipoRichiesta']=="QD" && empty($_FILES['am_uploadDichiarazioneDatoreLavoro'])){
    $errors['am_uploadDichiarazioneDatoreLavoro'] = "<li><a href='#am_uploadDichiarazioneDatoreLavoro_txt'>Dichiarazione del datore di lavoro</a></li>";
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    /* salvo tutti i dati nel DB nella tabella domanda_contributo con status 0 */    
    $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlINS = "INSERT INTO `assegno_maternita` (status_id,richiedenteCf,richiedenteNome,richiedenteCognome,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,minoreNome,minoreCognome,minoreDataNascita,minoreLuogoNascita,tipoRichiesta,DichiarazioneCittadinanza,DichiarazioneSoggiornoNumero,DichiarazioneSoggiornoQuestura,DichiarazioneSoggiornoData,DichiarazioneSoggiornoDataRinnovo,DichiarazioneAffidamento,DichiarazioneAffidamentoData,tipoPagamento_id) VALUES (0,'".$_POST['am_richiedente_cf']."','".$_POST['am_richiedente_nome']."','".$_POST['am_richiedente_cognome']."','".$_POST['am_richiedente_data_nascita']."','".$_POST['am_richiedente_luogo_nascita']."','".$_POST['am_richiedente_via']."','".$_POST['am_richiedente_localita']."','".$_POST['am_richiedente_provincia']."','".$_POST['am_richiedente_email']."','".$_POST['am_richiedente_tel']."','".$_POST['am_minoreNome']."','".$_POST['am_minoreCognome']."','".$_POST['am_minoreDataNascita']."','".$_POST['am_minoreLuogoNascita']."','".$_POST['am_tipoRichiesta']."','".$_POST['am_DichiarazioneCittadinanza']."','".$_POST['am_DichiarazioneSoggiornoNumero']."','".$_POST['am_DichiarazioneSoggiornoQuestura']."','".$_POST['am_DichiarazioneSoggiornoData']."','".$_POST['am_DichiarazioneSoggiornoDataRinnovo']."','".$am_DichiarazioneAffidamento."','".$_POST['am_DichiarazioneAffidamentoData']."','".$_POST['ckb_pagamento']."')";
    $connessioneINS->query($sqlINS);

    $sqlINS = "SELECT id FROM assegno_maternita WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 0 ORDER BY id DESC LIMIT 1";
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
    $upload_location = "../uploads/assegno_maternita/";
    // To store uploaded files path
    $files_arr = array();

    /* am_uploadCartaIdentitaFronte - start */
    if(isset($_FILES['am_uploadCartaIdentitaFronte']['name']) && $_FILES['am_uploadCartaIdentitaFronte']['name'] != ''){
        // File name INIT
        $filename = $_FILES['am_uploadCartaIdentitaFronte']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "am_ci_fronte_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['am_uploadCartaIdentitaFronte']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE assegno_maternita SET uploadCartaIdentitaFronte = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* am_uploadCartaIdentitaFronte - end */

    /* am_uploadCartaIdentitaRetro - start */
    if(isset($_FILES['am_uploadCartaIdentitaRetro']['name']) && $_FILES['am_uploadCartaIdentitaRetro']['name'] != ''){
        // File name INIT
        $filename = $_FILES['am_uploadCartaIdentitaRetro']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "am_ci_retro_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['am_uploadCartaIdentitaRetro']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE assegno_maternita SET uploadCartaIdentitaRetro = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* am_uploadCartaIdentitaRetro - end */

    /* am_uploadTitoloSoggiorno - start */
    if(isset($_FILES['am_uploadTitoloSoggiorno']['name']) && $_FILES['am_uploadTitoloSoggiorno']['name'] != ''){
        // File name INIT
        $filename = $_FILES['am_uploadTitoloSoggiorno']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "am_titolo_soggiorno_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['am_uploadTitoloSoggiorno']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE assegno_maternita SET uploadTitoloSoggiorno = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* am_uploadTitoloSoggiorno - end */

    /* am_uploadDichiarazioneDatoreLavoro - start */
    if(isset($_FILES['am_uploadDichiarazioneDatoreLavoro']['name']) && $_FILES['am_uploadDichiarazioneDatoreLavoro']['name'] != ''){
        // File name INIT
        $filename = $_FILES['am_uploadDichiarazioneDatoreLavoro']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "am_dichiarazione_datore_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['am_uploadDichiarazioneDatoreLavoro']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE assegno_maternita SET uploadDichiarazioneDatoreLavoro = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* am_uploadDichiarazioneDatoreLavoro - end */


        $data['success'] = true;
        $data['message'] = $new_id;
}
echo json_encode($data);