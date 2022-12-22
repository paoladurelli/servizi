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

    $ConcorsoId = isset($_POST['pc_ConcorsoId']) ? $_POST['pc_ConcorsoId'] : "0";
    $cittadinoItaliano = 0;
    $cittadinoEuropeo = 0;
    if(isset($_POST['pc_cittadino'])){
        if($_POST['pc_cittadino']== "I"){
            $cittadinoItaliano = 1;
            $cittadinoEuropeo = 0;
        }else{
            $cittadinoItaliano = 0;
            $cittadinoEuropeo = 1;
        }
    }
    $statoEuropeo = isset($_POST['pc_statoEuropeo']) ? addslashes($_POST['pc_statoEuropeo']) : "";
    $conoscenzaLingua = isset($_POST['pc_conoscenzaLingua']) ? $_POST['pc_conoscenzaLingua'] : "0";
    $idoneitaFisica = isset($_POST['pc_idoneitaFisica']) ? $_POST['pc_idoneitaFisica'] : "0";
    $dirittiCiviliPolitici = isset($_POST['pc_dirittiCiviliPolitici']) ? $_POST['pc_dirittiCiviliPolitici'] : "0";
    $destituzionePA = isset($_POST['pc_destituzionePA']) ? $_POST['pc_destituzionePA'] : "0";
    $fedinaPulita = isset($_POST['pc_fedina']) ? $_POST['pc_fedina'] : "0" ;
    $condanne = isset($_POST['pc_condanne']) ? addslashes($_POST['pc_condanne']) : "";
    $obbligoLeva = isset($_POST['pc_obbligoLeva']) ? $_POST['pc_obbligoLeva'] : "0";
    $titoloStudio = isset($_POST['pc_titoloStudio']) ? addslashes($_POST['pc_titoloStudio']) : "";
    $titoloStudioScuola = isset($_POST['pc_titoloStudioScuola']) ? addslashes($_POST['pc_titoloStudioScuola']) : "";
    $titoloStudioData = isset($_POST['pc_titoloStudioData']) ? addslashes($_POST['pc_titoloStudioData']) : "";
    $titoloStudioVoto = isset($_POST['pc_titoloStudioVoto']) ? addslashes($_POST['pc_titoloStudioVoto']) : "";
    $conoscenzaInformatica = isset($_POST['pc_conoscenzaInformatica']) ? $_POST['pc_conoscenzaInformatica'] : "0";
    $conoscenzaLinguaEstera = isset($_POST['pc_conoscenzaLinguaEstera']) ? addslashes($_POST['pc_conoscenzaLinguaEstera']) : "";
    $titoliPreferenza = isset($_POST['pc_titoliPreferenza']) ? addslashes($_POST['pc_titoliPreferenza']) : "";
    $necessitaHandicap = isset($_POST['pc_necessitaHandicap']) ? addslashes($_POST['pc_necessitaHandicap']) : "";
    $dirittoRiserva = isset($_POST['pc_dirittoRiserva']) ? $_POST['pc_dirittoRiserva'] : "0";
    $accettazioneCondizioniBando = isset($_POST['pc_accettazioneCondizioniBando']) ? $_POST['pc_accettazioneCondizioniBando'] : "0";
    $accettazioneDisposizioniComune = isset($_POST['pc_accettazioneDisposizioniComune']) ? $_POST['pc_accettazioneDisposizioniComune'] : "0";
    $accettazioneComunicazioneVariazioniDomicilio =isset($_POST['pc_accettazioneComunicazioneVariazioniDomicilio']) ? $_POST['pc_accettazioneComunicazioneVariazioniDomicilio'] : "0";

    $writeMessages = false;
/* salvo tutti i dati nel DB nella tabella partecipazione_concorso */
if(!isset($_POST['pc_bozza_id']) || $_POST['pc_bozza_id'] == ''){

    $sqlINS = "INSERT INTO `partecipazione_concorso`(status_id, richiedenteCf, richiedenteNome, richiedenteCognome, richiedenteDataNascita, richiedenteLuogoNascita, richiedenteVia, richiedenteLocalita, richiedenteProvincia, richiedenteEmail, richiedenteTel, ConcorsoId, cittadinoItaliano, cittadinoEuropeo, statoEuropeo, conoscenzaLingua, idoneitaFisica, dirittiCiviliPolitici, destituzionePA, fedinaPulita, condanne, obbligoLeva, titoloStudio, titoloStudioScuola, titoloStudioData, titoloStudioVoto, conoscenzaInformatica, conoscenzaLinguaEstera, titoliPreferenza, necessitaHandicap, dirittoRiserva, accettazioneCondizioniBando, accettazioneDisposizioniComune, accettazioneComunicazioneVariazioniDomicilio) VALUES (1, '".$richiedenteCf."','".$richiedenteNome."','".$richiedenteCognome."','".$richiedenteDataNascita."','".$richiedenteLuogoNascita."','".$richiedenteVia."','".$richiedenteLocalita."','".$richiedenteProvincia."','".$richiedenteEmail."','".$richiedenteTel."','".$ConcorsoId."','".$cittadinoItaliano."','".$cittadinoEuropeo."','".$statoEuropeo."','".$conoscenzaLingua."','".$idoneitaFisica."','".$dirittiCiviliPolitici."','".$destituzionePA."','".$fedinaPulita."','".$condanne."','".$obbligoLeva."','".$titoloStudio."','".$titoloStudioScuola."','".$titoloStudioData."','".$titoloStudioVoto."','".$conoscenzaInformatica."','".$conoscenzaLinguaEstera."','".$titoliPreferenza."','".$necessitaHandicap."','".$dirittoRiserva."','".$accettazioneCondizioniBando."','".$accettazioneDisposizioniComune."','".$accettazioneComunicazioneVariazioniDomicilio."')";
    $connessioneINS->query($sqlINS);

    $sqlINS = "SELECT id FROM partecipazione_concorso WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 1 ORDER BY id DESC LIMIT 1";
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
    $sqlUPD = "UPDATE `partecipazione_concorso` SET richiedenteCf='".$richiedenteCf."', richiedenteNome='".$richiedenteNome."', richiedenteCognome='".$richiedenteCognome."', richiedenteDataNascita='".$richiedenteDataNascita."', richiedenteLuogoNascita='".$richiedenteLuogoNascita."', richiedenteVia='".$richiedenteVia."', richiedenteLocalita='".$richiedenteLocalita."', richiedenteProvincia='".$richiedenteProvincia."', richiedenteEmail='".$richiedenteEmail."', richiedenteTel='".$richiedenteTel."', ConcorsoId='".$ConcorsoId."', cittadinoItaliano='".$cittadinoItaliano."', cittadinoEuropeo='".$cittadinoEuropeo."', statoEuropeo='".$statoEuropeo."', conoscenzaLingua='".$conoscenzaLingua."', idoneitaFisica='".$idoneitaFisica."', dirittiCiviliPolitici='".$dirittiCiviliPolitici."', destituzionePA='".$destituzionePA."', fedinaPulita='".$fedinaPulita."', condanne='".$condanne."', obbligoLeva='".$obbligoLeva."', titoloStudio='".$titoloStudio."', titoloStudioScuola='".$titoloStudioScuola."', titoloStudioData='".$titoloStudioData."', titoloStudioVoto='".$titoloStudioVoto."', conoscenzaInformatica='".$conoscenzaInformatica."', conoscenzaLinguaEstera='".$conoscenzaLinguaEstera."', titoliPreferenza='".$titoliPreferenza."', necessitaHandicap='".$necessitaHandicap."', dirittoRiserva='".$dirittoRiserva."', accettazioneCondizioniBando='".$accettazioneCondizioniBando."', accettazioneDisposizioniComune='".$accettazioneDisposizioniComune."', accettazioneComunicazioneVariazioniDomicilio='".$accettazioneComunicazioneVariazioniDomicilio."' WHERE id = '".$_POST['pc_bozza_id']."'";
    $connessioneUPD->query($sqlUPD);
    $new_id = $_POST['pc_bozza_id'];
}

/* carico i file allegati rinominandoli con bozza_<id_bozza> */
    // Upload Location
    $upload_location = "../uploads/partecipazione_concorso/";
    // To store uploaded files path
    $files_arr = array();

    /* pc_uploadCartaIdentitaFronte - start */
    if(isset($_FILES['pc_uploadCartaIdentitaFronte']['name']) && $_FILES['pc_uploadCartaIdentitaFronte']['name'] != ''){
        // File name INIT
        $filename = $_FILES['pc_uploadCartaIdentitaFronte']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "pc_CartaIdentitaFronte_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['pc_uploadCartaIdentitaFronte']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE partecipazione_concorso SET uploadCartaIdentitaFronte = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* pc_uploadCartaIdentitaFronte - end */
    
    /* pc_uploadCartaIdentitaRetro - start */
    if(isset($_FILES['pc_uploadCartaIdentitaRetro']['name']) && $_FILES['pc_uploadCartaIdentitaRetro']['name'] != ''){
        // File name INIT
        $filename = $_FILES['pc_uploadCartaIdentitaRetro']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "pc_CartaIdentitaRetro_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['pc_uploadCartaIdentitaRetro']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE partecipazione_concorso SET uploadCartaIdentitaRetro = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* pc_uploadCartaIdentitaRetro - end */
    
    /* pc_uploadCV - start */
    if(isset($_FILES['pc_uploadCV']['name']) && $_FILES['pc_uploadCV']['name'] != ''){
        // File name INIT
        $filename = $_FILES['pc_uploadCV']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "pc_CV_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['pc_uploadCV']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE partecipazione_concorso SET uploadCV = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* pc_uploadCV - end */

    /* pc_uploadTitoliPreferenza - start */
    if(isset($_FILES['pc_uploadTitoliPreferenza']) && $_FILES['pc_uploadTitoliPreferenza'] != ''){
        // Count total files
        $countfiles = count($_FILES['pc_uploadTitoliPreferenza']['name']);
        // Loop all files
        for($index = 0;$index < $countfiles;$index++){

            if(isset($_FILES['pc_uploadTitoliPreferenza']['name'][$index]) && $_FILES['pc_uploadTitoliPreferenza']['name'][$index] != ''){
                // File name INIT
                $filename = $_FILES['pc_uploadTitoliPreferenza']['name'][$index];

                // Get extension
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

                // Valid image extension
                $valid_ext = array("png","jpeg","jpg","pdf");

                // Check extension
                if(in_array($ext, $valid_ext)){
                    //New file name
                    $filename = "pc_TitoliPreferenza_bozza_" . $new_id . "_" . $index. "." . $ext;
                    // File path
                    $path = $upload_location.$filename;

                    // Upload file
                    if(move_uploaded_file($_FILES['pc_uploadTitoliPreferenza']['tmp_name'][$index],$path)){
                        $files_arr[] = $path;
                        /* salvo nel DB i nomi */
                        $sqlUPD = "UPDATE partecipazione_concorso SET uploadTitoliPreferenza = CONCAT(uploadTitoliPreferenza, '".$filename.";') WHERE id = ".$new_id;
                        $connessioneUPD->query($sqlUPD);
                    }
                }
            }
        }
    }
    /* pc_uploadTitoliPreferenza - end */

if($writeMessages){
    /* salvo nelle attitivà la creazione o modifica della bozza per partecipazione_concorso */
    $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id,data_attivita) VALUES ('".$_POST['pc_richiedente_cf']."',16,".$new_id.",1,'".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);
    
    
    /* salvo nei messaggi che ho una bozza da completare per partecipazione_concorso */
    $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo,data_msg) VALUES ('".$_POST['pc_richiedente_cf']."',16,'La tua richiesta di iscrizione al concorso è stata salvata come  bozza','".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);
}    
/* invio risposta al js */
echo json_encode('allright');