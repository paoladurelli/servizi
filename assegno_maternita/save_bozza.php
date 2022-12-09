<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
session_start();

$connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

$richiedenteNome = isset($_POST['am_richiedente_nome']) ? $_POST['am_richiedente_nome'] : "";
$richiedenteCognome = isset($_POST['am_richiedente_cognome']) ? $_POST['am_richiedente_cognome'] : "";
$richiedenteCf = isset($_POST['am_richiedente_cf']) ? $_POST['am_richiedente_cf'] : "";
$richiedenteDataNascita = isset($_POST['am_richiedente_data_nascita']) ? $_POST['am_richiedente_data_nascita'] : "";
$richiedenteLuogoNascita = isset($_POST['am_richiedente_luogo_nascita']) ? $_POST['am_richiedente_luogo_nascita'] : "";
$richiedenteVia = isset($_POST['am_richiedente_via']) ? $_POST['am_richiedente_via'] : "";
$richiedenteLocalita = isset($_POST['am_richiedente_localita']) ? $_POST['am_richiedente_localita'] : "";
$richiedenteProvincia = isset($_POST['am_richiedente_provincia']) ? $_POST['am_richiedente_provincia'] : "";
$richiedenteEmail = isset($_POST['am_richiedente_email']) ? $_POST['am_richiedente_email'] : "";
$richiedenteTel = isset($_POST['am_richiedente_tel']) ? $_POST['am_richiedente_tel'] : "";
$minoreNome = isset($_POST['am_minoreNome']) ? $_POST['am_minoreNome'] : "";
$minoreCognome = isset($_POST['am_minoreCognome']) ? $_POST['am_minoreCognome'] : "";
$minoreDataNascita = isset($_POST['am_minoreDataNascita']) ? $_POST['am_minoreDataNascita'] : "";
$minoreLuogoNascita = isset($_POST['am_minoreLuogoNascita']) ? $_POST['am_minoreLuogoNascita'] : "";
$tipoRichiesta = isset($_POST['am_tipoRichiesta']) ? $_POST['am_tipoRichiesta'] : "";
$DichiarazioneCittadinanza = isset($_POST['am_DichiarazioneCittadinanza']) ? $_POST['am_DichiarazioneCittadinanza'] : "";
$DichiarazioneSoggiornoNumero = isset($_POST['am_DichiarazioneSoggiornoNumero']) ? $_POST['am_DichiarazioneSoggiornoNumero'] : "";
$DichiarazioneSoggiornoQuestura = isset($_POST['am_DichiarazioneSoggiornoQuestura']) ? $_POST['am_DichiarazioneSoggiornoQuestura'] : "";
$DichiarazioneSoggiornoData = isset($_POST['am_DichiarazioneSoggiornoData']) ? $_POST['am_DichiarazioneSoggiornoData'] : "";
$DichiarazioneSoggiornoDataRinnovo = isset($_POST['am_DichiarazioneSoggiornoDataRinnovo']) ? $_POST['am_DichiarazioneSoggiornoDataRinnovo'] : "";
$DichiarazioneAffidamento = isset($_POST['am_DichiarazioneAffidamento']) ? $_POST['am_DichiarazioneAffidamento'] : "";
$DichiarazioneAffidamentoData = isset($_POST['am_DichiarazioneAffidamentoData']) ? $_POST['am_DichiarazioneAffidamentoData'] : "";
$tipoPagamento_id = isset($_POST['ckb_pagamento']) ? $_POST['ckb_pagamento'] : "";


/* salvo tutti i dati nel DB nella tabella domanda_contributo */
if(!isset($_POST['am_bozza_id']) || $_POST['am_bozza_id'] == ''){

    $sqlINS = "INSERT INTO `assegno_maternita`(status_id,richiedenteCf,richiedenteNome,richiedenteCognome,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,minoreNome,minoreCognome,minoreDataNascita,minoreLuogoNascita,tipoRichiesta,DichiarazioneCittadinanza,DichiarazioneSoggiornoNumero,DichiarazioneSoggiornoQuestura,DichiarazioneSoggiornoData,DichiarazioneSoggiornoDataRinnovo,DichiarazioneAffidamento,DichiarazioneAffidamentoData,tipoPagamento_id) VALUES (1,'".$richiedenteCf."','".$richiedenteNome."','".$richiedenteCognome."','".$richiedenteDataNascita."','".$richiedenteLuogoNascita."','".$richiedenteVia."','".$richiedenteLocalita."','".$richiedenteProvincia."','".$richiedenteEmail."','".$richiedenteTel."','".$minoreNome."','".$minoreCognome."','".$minoreDataNascita."','".$minoreLuogoNascita."','".$tipoRichiesta."','".$DichiarazioneCittadinanza."','".$DichiarazioneSoggiornoNumero."','".$DichiarazioneSoggiornoQuestura."','".$DichiarazioneSoggiornoData."','".$DichiarazioneSoggiornoDataRinnovo."','".$DichiarazioneAffidamento."','".$DichiarazioneAffidamentoData."','".$tipoPagamento_id."')";
    $connessioneINS->query($sqlINS);

    $sqlINS = "SELECT id FROM assegno_maternita WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 1 ORDER BY id DESC LIMIT 1";
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
    $sqlUPD = "UPDATE assegno_maternita SET richiedenteNome = '".$richiedenteNome."', richiedenteCognome = '".$richiedenteCognome."', richiedenteCf = '".$richiedenteCf."', richiedenteDataNascita = '".$richiedenteDataNascita."', richiedenteLuogoNascita = '".$richiedenteLuogoNascita."', richiedenteVia = '".$richiedenteVia."', richiedenteLocalita = '".$richiedenteLocalita."', richiedenteProvincia = '".$richiedenteProvincia."', richiedenteEmail = '".$richiedenteEmail."', richiedenteTel = '".$richiedenteTel."', minoreNome = '".$minoreNome."', minoreCognome = '".$minoreCognome."', minoreDataNascita = '".$minoreDataNascita."', minoreLuogoNascita = '".$minoreLuogoNascita."', tipoRichiesta = '".$tipoRichiesta."', DichiarazioneCittadinanza = '".$DichiarazioneCittadinanza."', DichiarazioneSoggiornoNumero = '".$DichiarazioneSoggiornoNumero."', DichiarazioneSoggiornoQuestura = '".$DichiarazioneSoggiornoQuestura."', DichiarazioneSoggiornoData = '".$DichiarazioneSoggiornoData."', DichiarazioneSoggiornoDataRinnovo = '".$DichiarazioneSoggiornoDataRinnovo."', DichiarazioneAffidamento = '".$DichiarazioneAffidamento."', DichiarazioneAffidamentoData = '".$DichiarazioneAffidamentoData."', tipoPagamento_id = '".$tipoPagamento_id."' WHERE id = '".$_POST['am_bozza_id']."'";
    $connessioneUPD->query($sqlUPD);
    $new_id = $_POST['am_bozza_id'];
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
            $filename = "am_cartaidentita_fronte_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['am_uploadCartaIdentitaFronte']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
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
            $filename = "am_cartaidentita_retro_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['am_uploadCartaIdentitaRetro']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
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
            $filename = "am_dichiarazione_datore_lavoro_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['am_uploadDichiarazioneDatoreLavoro']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE assegno_maternita SET uploadDichiarazioneDatoreLavoro = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* am_uploadDichiarazioneDatoreLavoro - end */

/* salvo nelle attitivà la creazione o modifica della bozza per domanda_contributo */
    $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id,data_attivita) VALUES ('".$_POST['am_richiedente_cf']."',9,".$new_id.",1,'".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);
    
    
/* salvo nei messaggi che ho una bozza da completare per domanda_contributo */
    $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo,data_msg) VALUES ('".$_POST['am_richiedente_cf']."',9,'La tua domanda per l\'assegno di maternità è stata salvata come bozza','".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);
    
/* invio risposta al js */
echo json_encode('allright');