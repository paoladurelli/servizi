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

    $sqlINS = "INSERT INTO `accesso_atti`(status_id,richiedenteNome,richiedenteCognome,richiedenteCf,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,inQualitaDi,beneficiarioNome,beneficiarioCognome,beneficiarioCf,beneficiarioDataNascita,beneficiarioLuogoNascita,beneficiarioVia,beneficiarioLocalita,beneficiarioProvincia,beneficiarioEmail,beneficiarioTel,importoContributo,finalitaContributo,tipoPagamento_id) VALUES (1,'".$richiedenteNome."','".$richiedenteCognome."','".$richiedenteCf."','".$richiedenteDataNascita."','".$richiedenteLuogoNascita."','".$richiedenteVia."','".$richiedenteLocalita."','".$richiedenteProvincia."','".$richiedenteEmail."','".$richiedenteTel."','".$inQualitaDi."','".$beneficiarioNome."','".$beneficiarioCognome."','".$beneficiarioCf."','".$beneficiarioDataNascita."','".$beneficiarioLuogoNascita."','".$beneficiarioVia."','".$beneficiarioLocalita."','".$beneficiarioProvincia."','".$beneficiarioEmail."','".$beneficiarioTel."','".$importoContributo."','".$finalitaContributo."','".$tipoPagamento_id."')";
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
    $sqlUPD = "UPDATE accesso_atti SET richiedenteNome = '". $richiedenteNome ."', richiedenteCognome = '". $richiedenteCognome ."', richiedenteCf = '". $richiedenteCf ."', richiedenteDataNascita = '". $richiedenteDataNascita ."', richiedenteLuogoNascita = '". $richiedenteLuogoNascita ."', richiedenteVia = '". $richiedenteVia ."', richiedenteLocalita = '". $richiedenteLocalita ."', richiedenteProvincia = '". $richiedenteProvincia ."', richiedenteEmail = '". $richiedenteEmail ."', richiedenteTel = '". $richiedenteTel ."', inQualitaDi = '". $inQualitaDi ."', beneficiarioNome = '". $beneficiarioNome ."', beneficiarioCognome = '". $beneficiarioCognome ."', beneficiarioCf = '". $beneficiarioCf ."', beneficiarioDataNascita = '". $beneficiarioDataNascita ."', beneficiarioLuogoNascita = '". $beneficiarioLuogoNascita ."', beneficiarioVia = '". $beneficiarioVia ."', beneficiarioLocalita = '". $beneficiarioLocalita ."', beneficiarioProvincia = '". $beneficiarioProvincia ."', beneficiarioEmail = '". $beneficiarioEmail ."', beneficiarioTel = '". $beneficiarioTel ."', importoContributo = '". $importoContributo ."', finalitaContributo = '". $finalitaContributo ."', tipoPagamento_id = '". $tipoPagamento_id ."' WHERE id = '".$_POST['aa_bozza_id']."'";
    $connessioneUPD->query($sqlUPD);
    $new_id = $_POST['aa_bozza_id'];
}

/* carico i file allegati rinominandoli con bozza_<id_bozza> */
    // Upload Location
    $upload_location = "../uploads/accesso_atti/";
    // To store uploaded files path
    $files_arr = array();


$uploadAffittuario
$uploadAltroSoggetto
$uploadNotaioRogante
$uploadAltriTitoloDescrizione
$uploadCartaIdentitaFronte
$uploadCartaIdentitaRetro
$uploadAttoNotarile

    
    
    /* aa_uploadPotereFirma - start */
    if(isset($_FILES['aa_uploadPotereFirma']['name']) && $_FILES['aa_uploadPotereFirma']['name'] != ''){
        // File name INIT
        $filename = $_FILES['aa_uploadPotereFirma']['name'];

        // Get extension
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        // Valid image extension
        $valid_ext = array("png","jpeg","jpg","pdf");

        // Check extension
        if(in_array($ext, $valid_ext)){
            //New file name
            $filename = "aa_potere_firma_bozza_" . $new_id. "." . $ext;
            // File path
            $path = $upload_location.$filename;

            // Upload file
            if(move_uploaded_file($_FILES['aa_uploadPotereFirma']['tmp_name'],$path)){
                $files_arr[] = $path;
                /* salvo nel DB i nomi */
                $sqlUPD = "UPDATE accesso_atti SET uploadPotereFirma = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }
    /* aa_uploadPotereFirma - end */


if($writeMessages){    
    /* salvo nelle attitivà la creazione o modifica della bozza per accesso_atti */
    $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id,data_attivita) VALUES ('".$_POST['aa_richiedente_cf']."',11,".$new_id.",1,'".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);

    /* salvo nei messaggi che ho una bozza da completare per accesso_atti */
    $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo,data_msg) VALUES ('".$_POST['aa_richiedente_cf']."',11,'La tua domanda di contributo è stata salvata come  bozza','".date('Y-m-d')."')";
    $connessioneINS->query($sqlINS);
}    
/* invio risposta al js */
echo json_encode('allright');