<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
$configData = require '../env/config_servizi.php';
session_start();

$errors = [];
$data = [];

/* check validazione */
if($_POST['aa_richiedente_nome']==""){
    $errors['aa_richiedente_nome'] = "<li><a href='#aa_richiedente_nome_txt'>Inserire il Nome del richiedente</a></li>";
}
if($_POST['aa_richiedente_cognome']==""){
    $errors['aa_richiedente_cognome'] = "<li><a href='#aa_richiedente_cognome_txt'>Inserire il Cognome del richiedente</a></li>";
}
if($_POST['aa_richiedente_cf']==""){
    $errors['aa_richiedente_cf'] = "<li><a href='#aa_richiedente_cf_txt'>Inserire il Codice Fiscale del richiedente</a></li>";
}
if(!isValidCodiceFiscale($_POST['aa_richiedente_cf'])){
    $errors['aa_richiedente_cf'] = "<li><a href='#aa_richiedente_cf_txt'>Codice Fiscale non valido</a></li>";
}
if($_POST['aa_richiedente_data_nascita']==""){
    $errors['aa_richiedente_data_nascita'] = "<li><a href='#aa_richiedente_data_nascita_txt'>Inserire la Data di nascita del richiedente</a></li>";
}
if($_POST['aa_richiedente_luogo_nascita']==""){
    $errors['aa_richiedente_luogo_nascita'] = "<li><a href='#aa_richiedente_luogo_nascita_txt'>Inserire il Luogo di Nascita del richiedente</a></li>";
}
if($_POST['aa_richiedente_via']==""){
    $errors['aa_richiedente_via'] = "<li><a href='#aa_richiedente_via_txt'>Inserire la Via del richiedente</a></li>";
}
if($_POST['aa_richiedente_localita']==""){
    $errors['aa_richiedente_localita'] = "<li><a href='#aa_richiedente_localita_txt'>Inserire la Località del richiedente</a></li>";
}
if($_POST['aa_richiedente_localita'] <> $configData['nome_comune']){
    $errors['aa_richiedente_localita'] = "<li><a href='#aa_richiedente_localita_txt'>Località inserita NON corriponde con il Comune</a></li>";
}
if($_POST['aa_richiedente_provincia']==""){
    $errors['aa_richiedente_provincia'] = "<li><a href='#aa_richiedente_provincia_txt'>Inserire la Provincia del richiedente</a></li>";
}
if($_POST['aa_richiedente_email']==""){
    $errors['aa_richiedente_email'] = "<li><a href='#aa_richiedente_email_txt'>Inserire la Email del richiedente</a></li>";
}
if(!filter_var($_POST['aa_richiedente_email'], FILTER_VALIDATE_EMAIL)){
    $errors['aa_richiedente_email'] = "<li><a href='#aa_richiedente_email_txt'>Email del richiedente NON corretta</a></li>";
}
if($_POST['aa_richiedente_tel']==""){
    $errors['aa_richiedente_tel'] = "<li><a href='#aa_richiedente_tel_txt'>Inserire il Telefono del richiedente</a></li>";
}
if(!isValidTelephoneNumber($_POST['aa_richiedente_tel']) == "error"){
    $errors['aa_richiedente_tel'] = "<li><a href='#aa_richiedente_tel_txt'>Telefono del richiedente NON corretto</a></li>";
}
if($_POST['aa_UfficioDestinatarioId']=="0" || $_POST['aa_UfficioDestinatarioId']==""){
    $errors['aa_UfficioDestinatarioId'] = "<li><a href='#aa_UfficioDestinatarioId_txt'>Selezionare l'ufficio destinatario della richiesta</a></li>";
}
if($_POST['aa_pgRuolo'] != "" || $_POST['aa_pgDenominazione'] != "" || $_POST['aa_pgTipologia'] != "" || $_POST['aa_pgSedeLegaleIndirizzo'] != "" || $_POST['aa_pgSedeLegaleLocalita'] != "" || $_POST['aa_pgSedeLegaleProvincia'] != "" || $_POST['aa_pgSedeLegaleCap'] != "" || $_POST['aa_pgCf'] != "" || $_POST['aa_pgPiva'] != "" || $_POST['aa_pgTelefono'] != "" || $_POST['aa_pgEmail'] != "" || $_POST['aa_pgPec'] != ""){
    /* uno dei campi dell'azienda non è vuoto, quindi faccio i controlli sull'azienda */
    if($_POST['aa_pgRuolo'] == ""){
        $errors['aa_pgRuolo'] = "<li><a href='#aa_pgRuolo_txt'>Inserire il ruolo avente in azienda</a></li>";
    }
    if($_POST['aa_pgDenominazione'] == ""){
        $errors['aa_pgDenominazione'] = "<li><a href='#aa_pgDenominazione_txt'>Inserire la denominazione dell'azienda</a></li>";
    }
    if($_POST['aa_pgTipologia'] == ""){
        $errors['aa_pgTipologia'] = "<li><a href='#aa_pgTipologia_txt'>Inserire la tipologia di azienda</a></li>";
    }    
    if($_POST['aa_pgSedeLegaleIndirizzo'] == ""){
        $errors['aa_pgSedeLegaleIndirizzo'] = "<li><a href='#aa_pgSedeLegaleIndirizzo_txt'>Inserire l'indirizzo della sede legale dell'azienda</a></li>";
    }    
    if($_POST['aa_pgSedeLegaleLocalita'] == ""){
        $errors['aa_pgSedeLegaleLocalita'] = "<li><a href='#aa_pgSedeLegaleLocalita_txt'>Inserire il comune della sede legale dell'azienda</a></li>";
    }    
    if($_POST['aa_pgSedeLegaleProvincia'] == ""){
        $errors['aa_pgSedeLegaleProvincia'] = "<li><a href='#aa_pgSedeLegaleProvincia_txt'>Inserire la provincia della sede legale dell'azienda</a></li>";
    }    
    if($_POST['aa_pgSedeLegaleCap'] == ""){
        $errors['aa_pgSedeLegaleCap'] = "<li><a href='#aa_pgSedeLegaleCap_txt'>Inserire il cap della sede legale dell'azienda</a></li>";
    }    
    if($_POST['aa_pgCf']==""){
        $errors['aa_pgCf'] = "<li><a href='#aa_pgCf_txt'>Inserire il Codice Fiscale dell'azienda</a></li>";
    }
    if($_POST['aa_pgPiva']==""){
        $errors['aa_pgPiva'] = "<li><a href='#aa_pgPiva_txt'>Inserire la Partita IVA dell'azienda</a></li>";
    }
    if($_POST['aa_pgTelefono']==""){
        $errors['aa_pgTelefono'] = "<li><a href='#aa_pgTelefono_txt'>Inserire il Telefono dell'azienda</a></li>";
    }
    if(!isValidTelephoneNumber($_POST['aa_pgTelefono']) == "error"){
        $errors['aa_pgTelefono'] = "<li><a href='#aa_pgTelefono_txt'>Telefono dell'azienda NON corretto</a></li>";
    }
    if($_POST['aa_pgEmail']==""){
        $errors['aa_pgEmail'] = "<li><a href='#aa_pgEmail_txt'>Inserire la Email dell'azienda</a></li>";
    }
    if(!filter_var($_POST['aa_pgEmail'], FILTER_VALIDATE_EMAIL)){
        $errors['aa_pgEmail'] = "<li><a href='#aa_pgEmail_txt'>Email dell'azienda NON corretta</a></li>";
    }    
    if($_POST['aa_pgPec']==""){
        $errors['aa_pgPec'] = "<li><a href='#aa_pgPec_txt'>Inserire la PEC dell'azienda</a></li>";
    }
    if(!filter_var($_POST['aa_pgPec'], FILTER_VALIDATE_EMAIL)){
        $errors['aa_pgPec'] = "<li><a href='#aa_pgPec_txt'>PEC dell'azienda NON corretta</a></li>";
    }
}
if(!isset($_POST['aa_richiedenteTitolo'])){
    $errors['aa_richiedenteTitolo'] = "<li><a href='#aa_richiedenteTitolo_txt'>Selezionare in quale qualità si richiede l'accesso</a></li>";
}else{
    if($_POST['aa_richiedenteTitolo'] == "AI" && empty($_FILE['aa_uploadAffittuario']) && $_POST['aa_uploadAffittuarioSaved'] == ""){
        $errors['aa_uploadAffittuario'] = "<li><a href='#aa_uploadAffittuario_txt'>Caricare il documento che attesti il ruolo di affittuario</a></li>";
    }
    if($_POST['aa_richiedenteTitolo'] == "NR" && empty($_FILE['aa_uploadNotaioRogante']) && $_POST['aa_uploadNotaioRoganteSaved'] == ""){
        $errors['aa_uploadNotaioRogante'] = "<li><a href='#aa_uploadNotaioRogante_txt'>Caricare il documento che attesti il ruolo di notaio rogante</a></li>";
    }
    if($_POST['aa_richiedenteTitolo'] == "AT" && empty($_FILE['aa_uploadAltriTitoloDescrizione']) && $_POST['aa_uploadAltriTitoloDescrizioneSaved'] == ""){
        $errors['aa_uploadAltriTitoloDescrizione'] = "<li><a href='#aa_uploadAltriTitoloDescrizione_txt'>Caricare il documento che attesti il titolo del proprio ruolo</a></li>";
    }
    if($_POST['aa_richiedenteTitolo'] == "RI"){
        if($_POST['aa_richiedenteProfessionistaIncaricatoDa'] == ""){
            $errors['aa_richiedenteProfessionistaIncaricatoDa'] = "<li><a href='#aa_richiedenteProfessionistaIncaricatoDa_txt'>Selezionare da quale soggetto si è stati incaricati</a></li>";
        }
        if($_POST['aa_richiedenteProfessionistaIncaricatoDa'] == "Proprietario" && $_POST['aa_richiedenteProfessionistaIncaricatoDaNome'] == ""){
            $errors['aa_richiedenteProfessionistaIncaricatoDaNome'] = "<li><a href='#aa_richiedenteProfessionistaIncaricatoDaNome_txt'>Inserire il nome del soggetto dalla quale si è stati incaricati</a></li>";
        }
        if($_POST['aa_richiedenteProfessionistaIncaricatoDa'] == "Proprietario" && $_POST['aa_richiedenteProfessionistaIncaricatoDaCognome'] == ""){
            $errors['aa_richiedenteProfessionistaIncaricatoDaCognome'] = "<li><a href='#aa_richiedenteProfessionistaIncaricatoDaCognome_txt'>Inserire il cognome del soggetto dalla quale si è stati incaricati</a></li>";
        }
        if($_POST['aa_richiedenteProfessionistaIncaricatoDa'] == "Proprietario" && $_POST['aa_richiedenteProfessionistaIncaricatoDaCf'] == ""){
            $errors['aa_richiedenteProfessionistaIncaricatoDaCf'] = "<li><a href='#aa_richiedenteProfessionistaIncaricatoDaCf_txt'>Inserire il codice fiscale del soggetto dalla quale si è stati incaricati</a></li>";
        }
        if($_POST['aa_richiedenteProfessionistaIncaricatoDa'] == "Proprietario" && !isValidCodiceFiscale($_POST['aa_richiedenteProfessionistaIncaricatoDaCf'])){
            $errors['aa_richiedenteProfessionistaIncaricatoDaCf'] = "<li><a href='#aa_richiedenteProfessionistaIncaricatoDaCf_txt'>Inserire il codice fiscale CORRETTO del soggetto dalla quale si è stati incaricati</a></li>";
        }
    }
}
if(!isset($_POST['aa_richiestaTipo'])){
    $errors['aa_richiestaTipo'] = "<li><a href='#aa_richiestaTipo_txt'>Selezionare la tipologia di richiesta</a></li>";
}
if($_POST['aa_richiestaAtti'] == ""){
    $errors['aa_richiestaAtti'] = "<li><a href='#aa_richiestaAtti_txt'>Indicare per quali atti si richiede l'accesso</a></li>";
}
if(!isset($_POST['aa_motivo'])){
    $errors['aa_motivo'] = "<li><a href='#aa_motivo_txt'>Indicare il motivo per la quale si richiede l'accesso agli atti</a></li>";
}else{
    if($_POST['aa_motivo'] == "AltraMotivazione" && $_POST['aa_motivoAltro'] == ""){
        $errors['aa_motivoAltro'] = "<li><a href='#aa_motivoAltro_txt'>Indicare il motivo per la quale si richiede l'accesso agli atti</a></li>";
    }
}
if(!isset($_POST['aa_modoRitiro'])){
    $errors['aa_modoRitiro'] = "<li><a href='#aa_modoRitiro_txt'>Indicare in quale modo di vogliono ritirare gli atti</a></li>";
}else{
    if($_POST['aa_modoRitiro'] == "AltroIndirizzo" && $_POST['aa_modoRitiroPostaIndirizzo'] == ""){
        $errors['aa_modoRitiroPostaIndirizzo'] = "<li><a href='#aa_modoRitiroPostaIndirizzo_txt'>Indicare l'indirizzo dove si vogliono ricevere gli atti</a></li>";
    }
    if($_POST['aa_modoRitiro'] == "AltroIndirizzo" && $_POST['aa_modoRitiroPostaLocalita'] == ""){
        $errors['aa_modoRitiroPostaLocalita'] = "<li><a href='#aa_modoRitiroPostaLocalita_txt'>Indicare il comune dove si vogliono ricevere gli atti</a></li>";
    }
    if($_POST['aa_modoRitiro'] == "AltroIndirizzo" && $_POST['aa_modoRitiroPostaProvincia'] == ""){
        $errors['aa_modoRitiroPostaProvincia'] = "<li><a href='#aa_modoRitiroPostaProvincia_txt'>Indicare la provincia dove si vogliono ricevere gli atti</a></li>";
    }
    if($_POST['aa_modoRitiro'] == "AltroIndirizzo" && $_POST['aa_modoRitiroPostaCap'] == ""){
        $errors['aa_modoRitiroPostaCap'] = "<li><a href='#aa_modoRitiroPostaCap_txt'>Indicare il CAP dove si vogliono ricevere gli atti</a></li>";
    }

}
if(empty($_FILES['aa_uploadCartaIdentitaFronte']) && $_POST['aa_uploadCartaIdentitaFronteSaved'] ==''){
    $errors['aa_uploadCartaIdentitaFronte'] = "<li><a href='#aa_uploadCartaIdentitaFronte_txt'>Allegare il fronte della Carta d'Identità</a></li>";
}
if(empty($_FILES['aa_uploadCartaIdentitaRetro']) && $_POST['aa_uploadCartaIdentitaRetroSaved'] ==''){
    $errors['aa_uploadCartaIdentitaRetro'] = "<li><a href='#aa_uploadCartaIdentitaRetro_txt'>Allegare il retro della Carta d'Identità</a></li>";
}

If(!isset($_POST['aa_richiedenteProfessionistaIncaricatoDa'])){
    $aa_richiedenteProfessionistaIncaricatoDa = "";
}else{
    $aa_richiedenteProfessionistaIncaricatoDa = $_POST['aa_richiedenteProfessionistaIncaricatoDa'];
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    /* salvo tutti i dati nel DB nella tabella accesso_atti con status 0 */    
    $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlINS = "INSERT INTO accesso_atti(status_id,id_orig,UfficioDestinatarioId,richiedenteCf,richiedenteNome,richiedenteCognome,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,pgRuolo,pgDenominazione,pgTipologia,pgSedeLegaleIndirizzo,pgSedeLegaleLocalita,pgSedeLegaleProvincia,pgSedeLegaleCap,pgCf,pgPiva,pgTelefono,pgEmail,pgPec,richiedenteTitolo,richiedenteProfessionistaIncaricatoDa,richiedenteProfessionistaIncaricatoDaNome,richiedenteProfessionistaIncaricatoDaCognome,richiedenteProfessionistaIncaricatoDaCf,richiedenteProfessionistaIncaricatoDaAltroSoggetto,richiedenteProfessionistaIncaricatoDaDescrizioneTitolo,richiestaTipo,richiestaAtti,richiestaAttiTipoDocumento,richiestaAttiProtocollo,richiestaAttiData,collocazioneTerritorialeCodiceCatastale,collocazioneTerritorialeSezione,collocazioneTerritorialeFoglio,collocazioneTerritorialeParticella,collocazioneTerritorialeSubalterno,collocazioneTerritorialeCategoria,collocazioneTerritorialeIndirizzo,collocazioneTerritorialeLocalita,collocazioneTerritorialeProvincia,motivo,motivoAltro,modoRitiro,modoRitiroPostaIndirizzo,modoRitiroPostaLocalita,modoRitiroPostaProvincia,modoRitiroPostaCap,annotazioni) VALUES (0,'".$_POST['aa_bozza_id']."','".$_POST['aa_UfficioDestinatarioId']."','".$_POST['aa_richiedente_cf']."','".addslashes($_POST['aa_richiedente_nome'])."','".addslashes($_POST['aa_richiedente_cognome'])."','".$_POST['aa_richiedente_data_nascita']."','".addslashes($_POST['aa_richiedente_luogo_nascita'])."','".addslashes($_POST['aa_richiedente_via'])."','".addslashes($_POST['aa_richiedente_localita'])."','".$_POST['aa_richiedente_provincia']."','".$_POST['aa_richiedente_email']."','".$_POST['aa_richiedente_tel']."','".$_POST['aa_pgRuolo']."','".addslashes($_POST['aa_pgDenominazione'])."','".$_POST['aa_pgTipologia']."','".addslashes($_POST['aa_pgSedeLegaleIndirizzo'])."','".addslashes($_POST['aa_pgSedeLegaleLocalita'])."','".$_POST['aa_pgSedeLegaleProvincia']."','".$_POST['aa_pgSedeLegaleCap']."','".$_POST['aa_pgCf']."','".$_POST['aa_pgPiva']."','".$_POST['aa_pgTelefono']."','".$_POST['aa_pgEmail']."','".$_POST['aa_pgPec']."','".addslashes($_POST['aa_richiedenteTitolo'])."','".$aa_richiedenteProfessionistaIncaricatoDa."','".addslashes($_POST['aa_richiedenteProfessionistaIncaricatoDaNome'])."','".addslashes($_POST['aa_richiedenteProfessionistaIncaricatoDaCognome'])."','".$_POST['aa_richiedenteProfessionistaIncaricatoDaCf']."','".addslashes($_POST['aa_richiedenteProfessionistaIncaricatoDaAltroSoggetto'])."','".addslashes($_POST['aa_richiedenteProfessionistaIncaricatoDaDescrizioneTitolo'])."','".addslashes($_POST['aa_richiestaTipo'])."','".addslashes($_POST['aa_richiestaAtti'])."','".addslashes($_POST['aa_richiestaAttiTipoDocumento'])."','".addslashes($_POST['aa_richiestaAttiProtocollo'])."','".$_POST['aa_richiestaAttiData']."','".$_POST['aa_collocazioneTerritorialeCodiceCatastale']."','".$_POST['aa_collocazioneTerritorialeSezione']."','".$_POST['aa_collocazioneTerritorialeFoglio']."','".$_POST['aa_collocazioneTerritorialeParticella']."','".$_POST['aa_collocazioneTerritorialeSubalterno']."','".$_POST['aa_collocazioneTerritorialeCategoria']."','".addslashes($_POST['aa_collocazioneTerritorialeIndirizzo'])."','".addslashes($_POST['aa_collocazioneTerritorialeLocalita'])."','".$_POST['aa_collocazioneTerritorialeProvincia']."','".addslashes($_POST['aa_motivo'])."','".addslashes($_POST['aa_motivoAltro'])."','".$_POST['aa_modoRitiro']."','".addslashes($_POST['aa_modoRitiroPostaIndirizzo'])."','".addslashes($_POST['aa_modoRitiroPostaLocalita'])."','".$_POST['aa_modoRitiroPostaProvincia']."','".$_POST['aa_modoRitiroPostaCap']."','".addslashes($_POST['aa_annotazioni'])."')";
    $connessioneINS->query($sqlINS);
    
    $sqlINS = "SELECT id FROM accesso_atti WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 0 ORDER BY id DESC LIMIT 1";
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
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE accesso_atti SET uploadAffittuario = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['aa_uploadAffittuarioSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE accesso_atti SET uploadAffittuario = '".$_POST['aa_uploadAffittuarioSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
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
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE accesso_atti SET uploadAltroSoggetto = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['aa_uploadAltroSoggettoSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE accesso_atti SET uploadAltroSoggetto = '".$_POST['aa_uploadAltroSoggettoSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
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
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE accesso_atti SET uploadNotaioRogante = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['aa_uploadNotaioRoganteSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE accesso_atti SET uploadNotaioRogante = '".$_POST['aa_uploadNotaioRoganteSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
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
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE accesso_atti SET uploadAltriTitoloDescrizione = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['aa_uploadAltriTitoloDescrizioneSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE accesso_atti SET uploadAltriTitoloDescrizione = '".$_POST['aa_uploadAltriTitoloDescrizioneSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
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
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE accesso_atti SET uploadCartaIdentitaFronte = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['aa_uploadCartaIdentitaFronteSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE accesso_atti SET uploadCartaIdentitaFronte = '".$_POST['aa_uploadCartaIdentitaFronteSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
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
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE accesso_atti SET uploadCartaIdentitaRetro = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['aa_uploadCartaIdentitaRetroSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE accesso_atti SET uploadCartaIdentitaRetro = '".$_POST['aa_uploadCartaIdentitaRetroSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
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
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE accesso_atti SET uploadAttoNotarile = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['aa_uploadAttoNotarileSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE accesso_atti SET uploadAttoNotarile = '".$_POST['aa_uploadAttoNotarileSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
        }
    }
    /* aa_uploadAttoNotarile - end */



    $data['success'] = true;
    $data['message'] = $new_id;
}
echo json_encode($data);