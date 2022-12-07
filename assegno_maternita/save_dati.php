<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
$configData = require '../env/config_servizi.php';
session_start();

$errors = [];
$data = [];

/* check validazione */
if($_POST['am_richiedente_nome']==""){
    $errors['am_richiedente_nome'] = "<li>Nome del richiedente</li>";
}
if($_POST['am_richiedente_cognome']==""){
    $errors['am_richiedente_cognome'] = "<li>Cognome del richiedente</li>";
}
if($_POST['am_richiedente_cf']==""){
    $errors['am_richiedente_cf'] = "<li>Codice Fiscale del richiedente</li>";
}
if($_POST['am_richiedente_data_nascita']==""){
    $errors['am_richiedente_data_nascita'] = "<li>Data di nascita del richiedente</li>";
}
if($_POST['am_richiedente_luogo_nascita']==""){
    $errors['am_richiedente_luogo_nascita'] = "<li>Luogo di Nascita del richiedente</li>";
}
if($_POST['am_richiedente_via']==""){
    $errors['am_richiedente_via'] = "<li>Via del richiedente</li>";
}
if($_POST['am_richiedente_localita']=="" || $_POST['am_richiedente_localita'] <> $configData['nome_comune']){
    $errors['am_richiedente_localita'] = "<li>Località del richiedente</li>";
}
if($_POST['am_richiedente_provincia']==""){
    $errors['am_richiedente_provincia'] = "<li>Provincia del richiedente</li>";
}
if($_POST['am_richiedente_email']==""){
    $errors['am_richiedente_email'] = "<li>Email del richiedente</li>";
}
if($_POST['am_richiedente_tel']==""){
    $errors['am_richiedente_tel'] = "<li>Telefono del richiedente</li>";
}

if ($_POST['am_minoreNome']==""){
    $errors['am_minoreNome'] = "<li>Nome del minore</li>";
}

if ($_POST['am_minoreCognome']==""){
    $errors['am_minoreCognome'] = "<li>Cognome del minore</li>";
}

if ($_POST['am_minoreDataNascita']==""){
    $errors['am_minoreDataNascita'] = "<li>Data di nascita del minore</li>";
}

if ($_POST['am_minoreLuogoNascita']==""){
    $errors['am_minoreLuogoNascita'] = "<li>Luogo di nascita del minore</li>";
}

if(empty($_POST['am_tipoRichiesta']) || $_POST['am_tipoRichiesta']==""){
    $errors['am_tipoRichiesta'] = "<li>Tipo di richiesta</li>";
}

if(empty($_POST['am_DichiarazioneCittadinanza']) || $_POST['am_DichiarazioneCittadinanza']==""){
    $errors['am_DichiarazioneCittadinanza'] = "<li>Cittadinanza</li>";
}

if($_POST['am_DichiarazioneCittadinanza']=="E" && empty($_POST['am_DichiarazioneSoggiornoNumero'])){
    $errors['am_DichiarazioneSoggiornoNumero'] = "<li>Numero titolo di soggiorno</li>";
}

if($_POST['am_DichiarazioneCittadinanza']=="E" && empty($_POST['am_DichiarazioneSoggiornoQuestura'])){
    $errors['am_DichiarazioneSoggiornoQuestura'] = "<li>Questura di rilascio del titolo di soggiorno</li>";
}

if($_POST['am_DichiarazioneCittadinanza']=="E" && empty($_POST['am_DichiarazioneSoggiornoData'])){
    $errors['am_DichiarazioneSoggiornoData'] = "<li>Data di rilascio del titolo di soggiorno</li>";
}

if($_POST['am_DichiarazioneCittadinanza']=="E" && empty($_POST['am_DichiarazioneSoggiornoDataRinnovo']) && empty($_POST['am_DichiarazioneSoggiornoData'])){
    $errors['am_DichiarazioneSoggiornoDataRinnovo'] = "<li>Data di rinnovo del titolo di soggiorno</li>";
}

if (!empty($_POST['am_DichiarazioneAffidamento']=="")&& $_POST['am_DichiarazioneAffidamentoData']==""){
    $errors['am_DichiarazioneAffidamentoData'] = "<li>Data inizio affido</li>";
}

if ($_POST['ckb_pagamento']==""){
    $errors['ckb_pagamento'] = "<li>Metodo di pagamento</li>";
}

if ($_FILES['am_uploadCartaIdentitaFronte']==""){
    $errors['am_uploadCartaIdentitaFronte'] = "<li>Fronte della carta di identità</li>";
}

if ($_FILES['am_uploadCartaIdentitaRetro']==""){
    $errors['am_uploadCartaIdentitaRetro'] = "<li>Retro della carta di identità</li>";
}

if ($_POST['am_DichiarazioneCittadinanza']=="E" && $_FILES['am_uploadTitoloSoggiorno']==""){
    $errors['am_uploadTitoloSoggiorno'] = "<li>Titolo di Soggiorno oppure ricevuta della richiesta di rilascio del permesso di soggiorno</li>";
}

if ($_POST['am_tipoRichiesta']=="QD" && $_FILES['am_uploadDichiarazioneDatoreLavoro']==""){
    $errors['am_uploadDichiarazioneDatoreLavoro'] = "<li>Dichiarazione del datore di lavoro</li>";
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {

    if(!isset($_POST['am_bozza_id']) || $_POST['am_bozza_id'] == ''){
        /* salvo tutti i dati nel DB nella tabella domanda_contributo con status 0 */    
        $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sqlINS = "INSERT INTO `assegno_maternita` (status_id,richiedenteCf,richiedenteNome,richiedenteCognome,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,minoreNome,minoreCognome,minoreDataNascita,minoreLuogoNascita,tipoRichiesta,DichiarazioneCittadinanza,DichiarazioneSoggiornoNumero,DichiarazioneSoggiornoQuestura,DichiarazioneSoggiornoData,DichiarazioneSoggiornoDataRinnovo,DichiarazioneAffidamento,DichiarazioneAffidamentoData,tipoPagamento_id,uploadCartaIdentitaFronte,uploadCartaIdentitaRetro,uploadTitoloSoggiorno,uploadDichiarazioneDatoreLavoro) VALUES (0,'".$_POST['am_richiedente-nome']."','".$_POST['am_richiedente-cognome']."','".$_POST['am_richiedente-cf']."','".$_POST['am_richiedente-data-nascita']."','".$_POST['am_richiedente-luogo-nascita']."','".$_POST['am_richiedente-via']."','".$_POST['am_richiedente-localita']."','".$_POST['am_richiedente-provincia']."','".$_POST['am_richiedente-email']."','".$_POST['am_richiedente-tel']."','".$_POST['am_minoreNome']."','".$_POST['am_minoreCognome']."','".$_POST['am_minoreDataNascita']."','".$_POST['am_minoreLuogoNascita']."','".$_POST['am_tipoRichiesta']."','".$_POST['am_DichiarazioneCittadinanza']."','".$_POST['am_DichiarazioneSoggiornoNumero']."','".$_POST['am_DichiarazioneSoggiornoQuestura']."','".$_POST['am_DichiarazioneSoggiornoData']."','".$_POST['am_DichiarazioneSoggiornoDataRinnovo']."','".$_POST['am_DichiarazioneAffidamento']."','".$_POST['am_DichiarazioneAffidamentoData']."','".$_POST['ckb_pagamento']."','".$_POST['am_uploadCartaIdentitaFronte']."','".$_POST['am_uploadCartaIdentitaRetro']."','".$_POST['am_uploadTitoloSoggiorno']."','".$_POST['am_uploadDichiarazioneDatoreLavoro']."')";
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

    }else{
        /* se la bozza esiste già vado solo a mettere come status: 0 */
        $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sqlUPD = "UPDATE assegno_maternita SET status_id = 0 WHERE id = '".$_POST['am_bozza_id']."'";
        $connessioneUPD->query($sqlUPD);
        $new_id = $_POST['am_bozza_id'];
    }
    
        $data['success'] = true;
        $data['message'] = $new_id;
}
echo json_encode($data);