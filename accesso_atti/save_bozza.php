<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
session_start();

$connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    
$richiedenteNome = isset($_POST['aa_richiedente_nome']) ? addslashes($_POST['aa_richiedente_nome']) : "";
$richiedenteCognome = isset($_POST['aa_richiedente_cognome']) ? addslashes($_POST['aa_richiedente_cognome']) : "";
$richiedenteCf = isset($_POST['aa_richiedente_cf']) ? $_POST['aa_richiedente_cf'] : "";
$richiedenteDataNascita = isset($_POST['aa_richiedente_data_nascita']) ? $_POST['aa_richiedente_data_nascita'] : "";
$richiedenteLuogoNascita = isset($_POST['aa_richiedente_luogo_nascita']) ? addslashes($_POST['aa_richiedente_luogo_nascita']) : "";
$richiedenteVia = isset($_POST['aa_richiedente_via']) ? addslashes($_POST['aa_richiedente_via']) : "";
$richiedenteLocalita = isset($_POST['aa_richiedente_localita']) ? addslashes($_POST['aa_richiedente_localita']) : "";
$richiedenteProvincia = isset($_POST['aa_richiedente_provincia']) ? $_POST['aa_richiedente_provincia'] : "";
$richiedenteEmail = isset($_POST['aa_richiedente_email']) ? $_POST['aa_richiedente_email'] : "";
$richiedenteTel = isset($_POST['aa_richiedente_tel']) ? $_POST['aa_richiedente_tel'] : "";

$UfficioDestinatarioId = isset($_POST['aa_UfficioDestinatarioId']) ? $_POST['aa_UfficioDestinatarioId'] : "";
$pgRuolo = isset($_POST['aa_pgRuolo']) ? $_POST['aa_pgRuolo'] : "";
$pgDenominazione = isset($_POST['aa_pgDenominazione']) ? $_POST['aa_pgDenominazione'] : "";
$pgTipologia = isset($_POST['aa_pgTipologia']) ? $_POST['aa_pgTipologia'] : "";
$pgSedeLegaleIndirizzo = isset($_POST['aa_pgSedeLegaleIndirizzo']) ? $_POST['aa_pgSedeLegaleIndirizzo'] : "";
$pgSedeLegaleLocalita = isset($_POST['aa_$pgSedeLegaleLocalita']) ? $_POST['aa_$pgSedeLegaleLocalita'] : "";
$pgSedeLegaleProvincia = isset($_POST['aa_pgSedeLegaleProvincia']) ? $_POST['aa_pgSedeLegaleProvincia'] : "";
$pgSedeLegaleCap = isset($_POST['aa_pgSedeLegaleCap']) ? $_POST['aa_pgSedeLegaleCap'] : "";
$pgCf = isset($_POST['aa_pgCf']) ? $_POST['aa_pgCf'] : "";
$pgPiva = isset($_POST['aa_pgPiva']) ? $_POST['aa_pgPiva'] : "";
$pgTelefono = isset($_POST['aa_pgTelefono']) ? $_POST['aa_pgTelefono'] : "";
$pgEmail = isset($_POST['aa_pgEmail']) ? $_POST['aa_pgEmail'] : "";
$pgPec = isset($_POST['aa_pgPec']) ? $_POST['aa_pgPec'] : "";
$richiedenteTitolo = isset($_POST['aa_richiedenteTitolo']) ? $_POST['aa_richiedenteTitolo'] : "";
$richiedenteProfessionistaIncaricatoDa = isset($_POST['aa_richiedenteProfessionistaIncaricatoDa']) ? $_POST['aa_richiedenteProfessionistaIncaricatoDa'] : "";
$richiedenteProfessionistaIncaricatoDaNome = isset($_POST['aa_richiedenteProfessionistaIncaricatoDaNome']) ? $_POST['aa_richiedenteProfessionistaIncaricatoDaNome'] : "";
$richiedenteProfessionistaIncaricatoDaCognome = isset($_POST['aa_richiedenteProfessionistaIncaricatoDaCognome']) ? $_POST['aa_richiedenteProfessionistaIncaricatoDaCognome'] : "";
$richiedenteProfessionistaIncaricatoDaCf = isset($_POST['aa_richiedenteProfessionistaIncaricatoDaCf']) ? $_POST['aa_richiedenteProfessionistaIncaricatoDaCf'] : "";
$richiedenteProfessionistaIncaricatoDaAltroSoggetto = isset($_POST['aa_richiedenteProfessionistaIncaricatoDaAltroSoggetto']) ? $_POST['aa_richiedenteProfessionistaIncaricatoDaAltroSoggetto'] : "";
$richiedenteProfessionistaIncaricatoDaDescrizioneTitolo = isset($_POST['aa_richiedenteProfessionistaIncaricatoDaDescrizioneTitolo']) ? $_POST['aa_richiedenteProfessionistaIncaricatoDaDescrizioneTitolo'] : "";
$richiestaTipo = isset($_POST['aa_richiestaTipo']) ? $_POST['aa_richiestaTipo'] : "";
$richiestaAtti = isset($_POST['aa_richiestaAtti']) ? $_POST['aa_richiestaAtti'] : "";
$richiestaAttiTipoDocumento = isset($_POST['aa_richiestaAttiTipoDocumento']) ? $_POST['aa_richiestaAttiTipoDocumento'] : "";
$richiestaAttiProtocollo = isset($_POST['aa_richiestaAttiProtocollo']) ? $_POST['aa_richiestaAttiProtocollo'] : "";
$richiestaAttiData = isset($_POST['aa_richiestaAttiData']) ? $_POST['aa_richiestaAttiData'] : "";
$collocazioneTerritorialeCodiceCatastale = isset($_POST['aa_collocazioneTerritorialeCodiceCatastale']) ? $_POST['aa_collocazioneTerritorialeCodiceCatastale'] : "";
$collocazioneTerritorialeSezione = isset($_POST['aa_collocazioneTerritorialeSezione']) ? $_POST['aa_collocazioneTerritorialeSezione'] : "";
$collocazioneTerritorialeFoglio = isset($_POST['aa_collocazioneTerritorialeFoglio']) ? $_POST['aa_collocazioneTerritorialeFoglio'] : "";
$collocazioneTerritorialeParticella = isset($_POST['aa_collocazioneTerritorialeParticella']) ? $_POST['aa_collocazioneTerritorialeParticella'] : "";
$collocazioneTerritorialeSubalterno = isset($_POST['aa_collocazioneTerritorialeSubalterno']) ? $_POST['aa_collocazioneTerritorialeSubalterno'] : "";
$collocazioneTerritorialeCategoria = isset($_POST['aa_collocazioneTerritorialeCategoria']) ? $_POST['aa_collocazioneTerritorialeCategoria'] : "";
$collocazioneTerritorialeIndirizzo = isset($_POST['aa_collocazioneTerritorialeIndirizzo']) ? $_POST['aa_collocazioneTerritorialeIndirizzo'] : "";
$collocazioneTerritorialeLocalita = isset($_POST['aa_collocazioneTerritorialeLocalita']) ? $_POST['aa_collocazioneTerritorialeLocalita'] : "";
$collocazioneTerritorialeProvincia = isset($_POST['aa_collocazioneTerritorialeProvincia']) ? $_POST['aa_collocazioneTerritorialeProvincia'] : "";
$motivo = isset($_POST['aa_motivo']) ? $_POST['aa_motivo'] : "";
$motivoAltro = isset($_POST['aa_motivoAltro']) ? $_POST['aa_motivoAltro'] : "";
$modoRitiro = isset($_POST['aa_modoRitiro']) ? $_POST['aa_modoRitiro'] : "";
$modoRitiroPostaIndirizzo = isset($_POST['aa_modoRitiroPostaIndirizzo']) ? $_POST['aa_modoRitiroPostaIndirizzo'] : "";
$modoRitiroPostaLocalita = isset($_POST['aa_modoRitiroPostaLocalita']) ? $_POST['aa_modoRitiroPostaLocalita'] : "";
$modoRitiroPostaProvincia = isset($_POST['aa_modoRitiroPostaProvincia']) ? $_POST['aa_modoRitiroPostaProvincia'] : "";
$modoRitiroPostaCap = isset($_POST['aa_modoRitiroPostaCap']) ? $_POST['aa_modoRitiroPostaCap'] : "";
$annotazioni = isset($_POST['aa_annotazioni']) ? $_POST['aa_annotazioni'] : "";

$writeMessages = false;
/* salvo tutti i dati nel DB nella tabella accesso_atti */
if(!isset($_POST['aa_bozza_id']) || $_POST['aa_bozza_id'] == ''){

    $sqlINS = "INSERT INTO `accesso_atti`(`status_id`,`UfficioDestinatarioId`, `richiedenteCf`, `richiedenteNome`, `richiedenteCognome`, `richiedenteDataNascita`, `richiedenteLuogoNascita`, `richiedenteVia`, `richiedenteLocalita`, `richiedenteProvincia`, `richiedenteEmail`, `richiedenteTel`, `pgRuolo`, `pgDenominazione`, `pgTipologia`, `pgSedeLegaleIndirizzo`, `pgSedeLegaleLocalita`, `pgSedeLegaleProvincia`, `pgSedeLegaleCap`, `pgCf`, `pgPiva`, `pgTelefono`, `pgEmail`, `pgPec`, `richiedenteTitolo`, `richiedenteProfessionistaIncaricatoDa`, `richiedenteProfessionistaIncaricatoDaNome`, `richiedenteProfessionistaIncaricatoDaCognome`, `richiedenteProfessionistaIncaricatoDaCf`, `richiedenteProfessionistaIncaricatoDaAltroSoggetto`, `richiedenteProfessionistaIncaricatoDaDescrizioneTitolo`, `richiestaTipo`, `richiestaAtti`, `richiestaAttiTipoDocumento`, `richiestaAttiProtocollo`, `richiestaAttiData`, `collocazioneTerritorialeCodiceCatastale`, `collocazioneTerritorialeSezione`, `collocazioneTerritorialeFoglio`, `collocazioneTerritorialeParticella`, `collocazioneTerritorialeSubalterno`, `collocazioneTerritorialeCategoria`, `collocazioneTerritorialeIndirizzo`, `collocazioneTerritorialeLocalita`, `collocazioneTerritorialeProvincia`, `motivo`, `motivoAltro`, `modoRitiro`, `modoRitiroPostaIndirizzo`, `modoRitiroPostaLocalita`, `modoRitiroPostaProvincia`, `modoRitiroPostaCap`, `annotazioni`) VALUES (1,'".$UfficioDestinatarioId."','".$richiedenteCf."','".$richiedenteNome."','".$richiedenteCognome."','".$richiedenteDataNascita."','".$richiedenteLuogoNascita."','".$richiedenteVia."','".$richiedenteLocalita."','".$richiedenteProvincia."','".$richiedenteEmail."','".$richiedenteTel."','".$pgRuolo."','".$pgDenominazione."','".$pgTipologia."','".$pgSedeLegaleIndirizzo."','".$pgSedeLegaleLocalita."','".$pgSedeLegaleProvincia."','".$pgSedeLegaleCap."','".$pgCf."','".$pgPiva."','".$pgTelefono."','".$pgEmail."','".$pgPec."','".$richiedenteTitolo."','".$richiedenteProfessionistaIncaricatoDa."','".$richiedenteProfessionistaIncaricatoDaNome."','".$richiedenteProfessionistaIncaricatoDaCognome."','".$richiedenteProfessionistaIncaricatoDaCf."','".$richiedenteProfessionistaIncaricatoDaAltroSoggetto."','".$richiedenteProfessionistaIncaricatoDaDescrizioneTitolo."','".$richiestaTipo."','".$richiestaAtti."','".$richiestaAttiTipoDocumento."','".$richiestaAttiProtocollo."','".$richiestaAttiData."','".$collocazioneTerritorialeCodiceCatastale."','".$collocazioneTerritorialeSezione."','".$collocazioneTerritorialeFoglio."','".$collocazioneTerritorialeParticella."','".$collocazioneTerritorialeSubalterno."','".$collocazioneTerritorialeCategoria."','".$collocazioneTerritorialeIndirizzo."','".$collocazioneTerritorialeLocalita."','".$collocazioneTerritorialeProvincia."','".$motivo."','".$motivoAltro."','".$modoRitiro."','".$modoRitiroPostaIndirizzo."','".$modoRitiroPostaLocalita."','".$modoRitiroPostaProvincia."','".$modoRitiroPostaCap."','".$annotazioni."')";
    $connessioneINS->query($sqlINS);

    $sqlINS = "SELECT id FROM accesso_atti WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 1 ORDER BY id DESC LIMIT 1";
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
    $sqlUPD = "UPDATE accesso_atti SET UfficioDestinatarioId='".$UfficioDestinatarioId."',richiedenteCf='".$richiedenteCf."',richiedenteNome='".$richiedenteNome."',richiedenteCognome='".$richiedenteCognome."',richiedenteDataNascita='".$richiedenteDataNascita."',richiedenteLuogoNascita='".$richiedenteLuogoNascita."',richiedenteVia='".$richiedenteVia."',richiedenteLocalita='".$richiedenteLocalita."',richiedenteProvincia='".$richiedenteProvincia."',richiedenteEmail='".$richiedenteEmail."',richiedenteTel='".$richiedenteTel."',pgRuolo='".$pgRuolo."',pgDenominazione='".$pgDenominazione."',pgTipologia='".$pgTipologia."',pgSedeLegaleIndirizzo='".$pgSedeLegaleIndirizzo."',pgSedeLegaleLocalita='".$pgSedeLegaleLocalita."',pgSedeLegaleProvincia='".$pgSedeLegaleProvincia."',pgSedeLegaleCap='".$pgSedeLegaleCap."',pgCf='".$pgCf."',pgPiva='".$pgPiva."',pgTelefono='".$pgTelefono."',pgEmail='".$pgEmail."',pgPec='".$pgPec."',richiedenteTitolo='".$richiedenteTitolo."',richiedenteProfessionistaIncaricatoDa='".$richiedenteProfessionistaIncaricatoDa."',richiedenteProfessionistaIncaricatoDaNome='".$richiedenteProfessionistaIncaricatoDaNome."',richiedenteProfessionistaIncaricatoDaCognome='".$richiedenteProfessionistaIncaricatoDaCognome."',richiedenteProfessionistaIncaricatoDaCf='".$richiedenteProfessionistaIncaricatoDaCf."',richiedenteProfessionistaIncaricatoDaAltroSoggetto='".$richiedenteProfessionistaIncaricatoDaAltroSoggetto."',richiedenteProfessionistaIncaricatoDaDescrizioneTitolo='".$richiedenteProfessionistaIncaricatoDaDescrizioneTitolo."',richiestaTipo='".$richiestaTipo."',richiestaAtti='".$richiestaAtti."',richiestaAttiTipoDocumento='".$richiestaAttiTipoDocumento."',richiestaAttiProtocollo='".$richiestaAttiProtocollo."',richiestaAttiData='".$richiestaAttiData."',collocazioneTerritorialeCodiceCatastale='".$collocazioneTerritorialeCodiceCatastale."',collocazioneTerritorialeSezione='".$collocazioneTerritorialeSezione."',collocazioneTerritorialeFoglio='".$collocazioneTerritorialeFoglio."',collocazioneTerritorialeParticella='".$collocazioneTerritorialeParticella."',collocazioneTerritorialeSubalterno='".$collocazioneTerritorialeSubalterno."',collocazioneTerritorialeCategoria='".$collocazioneTerritorialeCategoria."',collocazioneTerritorialeIndirizzo='".$collocazioneTerritorialeIndirizzo."',collocazioneTerritorialeLocalita='".$collocazioneTerritorialeLocalita."',collocazioneTerritorialeProvincia='".$collocazioneTerritorialeProvincia."',motivo='".$motivo."',motivoAltro='".$motivoAltro."',modoRitiro='".$modoRitiro."',modoRitiroPostaIndirizzo='".$modoRitiroPostaIndirizzo."',modoRitiroPostaLocalita='".$modoRitiroPostaLocalita."',modoRitiroPostaProvincia='".$modoRitiroPostaProvincia."',modoRitiroPostaCap='".$modoRitiroPostaCap."',annotazioni='".$annotazioni."' WHERE id = '".$_POST['aa_bozza_id']."'";
    $connessioneUPD->query($sqlUPD);
    $new_id = $_POST['aa_bozza_id'];
}

/* carico i file allegati rinominandoli con bozza_<id_bozza> */
    // Upload Location
    $upload_location = "../uploads/accesso_atti/";
    // To store uploaded files path
    $files_arr = array();
    
    /* aa_uploadAffittuario - start */
    if(isset($_FILES['aa_uploadAffittuario']['name']) && $_FILES['aa_uploadAffittuario']['name'] != ''){
        // File name INIT
        $filename = $_FILES['aa_uploadAffittuario']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "aa_Affittuario_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['aa_uploadAffittuario']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE accesso_atti SET uploadAffittuario = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* aa_uploadAffittuario - end */
    
    /* aa_uploadAltroSoggetto - start */
    if(isset($_FILES['aa_uploadAltroSoggetto']['name']) && $_FILES['aa_uploadAltroSoggetto']['name'] != ''){
        // File name INIT
        $filename = $_FILES['aa_uploadAltroSoggetto']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "aa_AltroSoggetto_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['aa_uploadAltroSoggetto']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE accesso_atti SET uploadAltroSoggetto = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* aa_uploadAltroSoggetto - end */
    
    /* aa_uploadNotaioRogante - start */
    if(isset($_FILES['aa_uploadNotaioRogante']['name']) && $_FILES['aa_uploadNotaioRogante']['name'] != ''){
        // File name INIT
        $filename = $_FILES['aa_uploadNotaioRogante']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "aa_NotaioRogante_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['aa_uploadNotaioRogante']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE accesso_atti SET uploadNotaioRogante = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* aa_uploadNotaioRogante - end */
    
    /* aa_uploadAltriTitoloDescrizione - start */
    if(isset($_FILES['aa_uploadAltriTitoloDescrizione']['name']) && $_FILES['aa_uploadAltriTitoloDescrizione']['name'] != ''){
        // File name INIT
        $filename = $_FILES['aa_uploadAltriTitoloDescrizione']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "aa_AltriTitoloDescrizione_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['aa_uploadAltriTitoloDescrizione']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE accesso_atti SET uploadAltriTitoloDescrizione = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* aa_uploadAltriTitoloDescrizione - end */
    
    /* aa_uploadCartaIdentitaFronte - start */
    if(isset($_FILES['aa_uploadCartaIdentitaFronte']['name']) && $_FILES['aa_uploadCartaIdentitaFronte']['name'] != ''){
        // File name INIT
        $filename = $_FILES['aa_uploadCartaIdentitaFronte']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "aa_CartaIdentitaFronte_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['aa_uploadCartaIdentitaFronte']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE accesso_atti SET uploadCartaIdentitaFronte = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* aa_uploadCartaIdentitaFronte - end */
    
    /* aa_uploadCartaIdentitaRetro - start */
    if(isset($_FILES['aa_uploadCartaIdentitaRetro']['name']) && $_FILES['aa_uploadCartaIdentitaRetro']['name'] != ''){
        // File name INIT
        $filename = $_FILES['aa_uploadCartaIdentitaRetro']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "aa_CartaIdentitaRetro_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['aa_uploadCartaIdentitaRetro']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE accesso_atti SET uploadCartaIdentitaRetro = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* aa_uploadCartaIdentitaRetro - end */
    
    /* aa_uploadAttoNotarile - start */
    if(isset($_FILES['aa_uploadAttoNotarile']['name']) && $_FILES['aa_uploadAttoNotarile']['name'] != ''){
        // File name INIT
        $filename = $_FILES['aa_uploadAttoNotarile']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "aa_AttoNotarile_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['aa_uploadAttoNotarile']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE accesso_atti SET uploadAttoNotarile = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* aa_uploadAttoNotarile - end */
    

if($writeMessages){    
    /* salvo nelle attitivà la creazione o modifica della bozza per accesso_atti */
    $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id,data_attivita) VALUES ('".$_POST['aa_richiedente_cf']."',6,".$new_id.",1,'".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);

    /* salvo nei messaggi che ho una bozza da completare per accesso_atti */
    $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo,data_msg) VALUES ('".$_POST['aa_richiedente_cf']."',6,'La tua domanda di accesso agli atti è stata salvata come  bozza','".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);
}    
/* invio risposta al js */
echo json_encode('allright');