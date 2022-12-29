<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
$configData = require '../env/config_servizi.php';
session_start();

$errors = [];
$data = [];

/* check validazione */
if($_POST['pc_richiedente_nome']==""){
    $errors['pc_richiedente_nome'] = "<li><a href='#pc_richiedente_nome_txt'>Inserire il Nome del richiedente</a></li>";
}
if($_POST['pc_richiedente_cognome']==""){
    $errors['pc_richiedente_cognome'] = "<li><a href='#pc_richiedente_cognome_txt'>Inserire il Cognome del richiedente</a></li>";
}
if($_POST['pc_richiedente_cf']==""){
    $errors['pc_richiedente_cf'] = "<li><a href='#pc_richiedente_cf_txt'>Inserire il Codice Fiscale del richiedente</a></li>";
}
if(!isValidCodiceFiscale($_POST['pc_richiedente_cf'])){
    $errors['pc_richiedente_cf'] = "<li><a href='#pc_richiedente_cf_txt'>Codice Fiscale non valido</a></li>";
}
if($_POST['pc_richiedente_data_nascita']==""){
    $errors['pc_richiedente_data_nascita'] = "<li><a href='#pc_richiedente_data_nascita_txt'>Inserire la Data di nascita del richiedente</a></li>";
}
if($_POST['pc_richiedente_luogo_nascita']==""){
    $errors['pc_richiedente_luogo_nascita'] = "<li><a href='#pc_richiedente_luogo_nascita_txt'>Inserire il Luogo di Nascita del richiedente</a></li>";
}
if($_POST['pc_richiedente_via']==""){
    $errors['pc_richiedente_via'] = "<li><a href='#pc_richiedente_via_txt'>Inserire la Via del richiedente</a></li>";
}
if($_POST['pc_richiedente_localita']==""){
    $errors['pc_richiedente_localita'] = "<li><a href='#pc_richiedente_localita_txt'>Inserire la Località del richiedente</a></li>";
}
if($_POST['pc_richiedente_localita'] <> $configData['nome_comune']){
    $errors['pc_richiedente_localita'] = "<li><a href='#pc_richiedente_localita_txt'>Località inserita NON corriponde con il Comune</a></li>";
}
if($_POST['pc_richiedente_provincia']==""){
    $errors['pc_richiedente_provincia'] = "<li><a href='#pc_richiedente_provincia_txt'>Inserire la Provincia del richiedente</a></li>";
}
if($_POST['pc_richiedente_email']==""){
    $errors['pc_richiedente_email'] = "<li><a href='#pc_richiedente_email_txt'>Inserire la Email del richiedente</a></li>";
}
if(!filter_var($_POST['pc_richiedente_email'], FILTER_VALIDATE_EMAIL)){
    $errors['pc_richiedente_email'] = "<li><a href='#pc_richiedente_email_txt'>Email del richiedente NON corretta</a></li>";
}
if($_POST['pc_richiedente_tel']==""){
    $errors['pc_richiedente_tel'] = "<li><a href='#pc_richiedente_tel_txt'>Inserire il Telefono del richiedente</a></li>";
}
if(!isValidTelephoneNumber($_POST['pc_richiedente_tel']) == "error"){
    $errors['pc_richiedente_tel'] = "<li><a href='#pc_richiedente_tel_txt'>Telefono del richiedente NON corretto</a></li>";
}
if(!isset($_POST['pc_cittadino'])){
    $errors['pc_cittadino'] = "<li><a href='#pc_cittadino_txt'>Seleziona la tua cittadinanza</a></li>";
}
if(isset($_POST['pc_cittadino']) && $_POST['pc_cittadino']== "E" && empty($_POST['pc_statoEuropeo'])){
    $errors['pc_statoEuropeo'] = "<li><a href='#pc_statoEuropeo_txt'>Inserire di quale paese europei si è cittadini</a></li>";
}
if(isset($_POST['pc_fedina']) && $_POST['pc_fedina'] == 0 && empty($_POST['pc_condanne'])){
    $errors['pc_condanne'] = "<li><a href='#pc_condanne_txt'>Inserire le condanne riportate</a></li>";
}
if(isset($_POST['pc_titoloStudioHas'])){
    if(empty($_POST['pc_titoloStudio'])){
        $errors['pc_titoloStudio'] = "<li><a href='#pc_titoloStudioHas_txt'>Inserire il titolo di studio</a></li>";
    }
    if(empty($_POST['pc_titoloStudioScuola'])){
        $errors['pc_titoloStudioScuola'] = "<li><a href='#pc_titoloStudioHas_txt'>Inserire l'istituto in cui si è conseguito il titolo di studio</a></li>";
    }
    if(empty($_POST['pc_titoloStudioData'])){
        $errors['pc_titoloStudioData'] = "<li><a href='#pc_titoloStudioHas_txt'>Inserire la data nella quale si è conseguito il titolo di studio</a></li>";
    }
    if(empty($_POST['pc_titoloStudioVoto'])){
        $errors['pc_titoloStudioVoto'] = "<li><a href='#pc_titoloStudioHas_txt'>Inserire la votazione finale del titolo di studio</a></li>";
    }
}
if(isset($_POST['pc_conoscenzaInformatica']) && empty($_POST['pc_conoscenzaLinguaEstera'])){
    $errors['pc_conoscenzaLinguaEstera'] = "<li><a href='#pc_conoscenzaInformatica_txt'>Inserire almeno una lingua straniera</a></li>";
}
if(isset($_POST['pc_titoliPreferenzaHas']) && empty($_POST['pc_titoliPreferenza'])){
    $errors['pc_titoliPreferenza'] = "<li><a href='#pc_titoliPreferenzaHas_txt'>Inserire il Titolo di Preferenza</a></li>";
}
if (!isset($_POST['pc_accettazioneCondizioniBando'])){
    $errors['pc_accettazioneCondizioniBando'] = "<li><a href='#pc_accettazioneCondizioniBando_txt'>Spuntare l'accettazione di tutte le prescrizioni e condizioni contenute nel bando di concorso</a></li>";
}
if (!isset($_POST['pc_accettazioneDisposizioniComune'])){
    $errors['pc_accettazioneDisposizioniComune'] = "<li><a href='#pc_accettazioneDisposizioniComune_txt'>Spuntare l'accettazione di tutte le disposizioni che regolano lo stato giuridico ed economici dei dipendenti del Comune</a></li>";
}
if (!isset($_POST['pc_accettazioneComunicazioneVariazioniDomicilio'])){
    $errors['pc_accettazioneComunicazioneVariazioniDomicilio'] = "<li><a href='#pc_accettazioneComunicazioneVariazioniDomicilio_txt'>Spuntare l'accettazione di impegnarsi a comunicare, per iscritto, al Comune le eventuali successive variazioni di domicilio</a></li>";
}
if(empty($_FILES['pc_uploadCartaIdentitaFronte']) && $_POST['pc_uploadCartaIdentitaFronteSaved'] ==''){
    $errors['pc_uploadCartaIdentitaFronte'] = "<li><a href='#pc_uploadCartaIdentitaFronte_txt'>Allegare la copia del fronte della Carta di Identità</a></li>";
}
if(empty($_FILES['pc_uploadCartaIdentitaRetro']) && $_POST['pc_uploadCartaIdentitaRetroSaved'] ==''){
    $errors['pc_uploadCartaIdentitaRetro'] = "<li><a href='#pc_uploadCartaIdentitaRetro_txt'>Allegare la copia del retro della Carta di Identità</a></li>";
}
if(empty($_FILES['pc_uploadCV']) && $_POST['pc_uploadCVSaved'] ==''){
    $errors['pc_uploadCV'] = "<li><a href='#pc_uploadCV_txt'>Allegare il Curriculum Vitae</a></li>";
}
if (isset($_POST['am_DichiarazioneCittadinanza']) && $_POST['am_DichiarazioneCittadinanza']=="E" && (empty($_FILES['pc_uploadTitoliPreferenza']) && $_POST['pc_uploadTitoliPreferenzaSaved'] =='')){
    $errors['pc_uploadTitoliPreferenza'] = "<li><a href='#pc_uploadTitoliPreferenzao_txt'>Allegare il Titolo di Preferenza</a></li>";
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {

    if($_POST['pc_cittadino']== "I"){
        $pc_cittadinoItaliano = 1;
        $pc_cittadinoEuropeo = 0;
    }else{
        $pc_cittadinoItaliano = 0;
        $pc_cittadinoEuropeo = 1;
    }

    if(isset($_POST['pc_conoscenzaLingua'])){
        $pc_conoscenzaLingua = 1;
    }else{
        $pc_conoscenzaLingua = 0;
    }
    if(isset($_POST['pc_idoneitaFisica'])){
        $pc_idoneitaFisica = 1;
    }else{
        $pc_idoneitaFisica = 0;
    }
    if(isset($_POST['pc_dirittiCiviliPolitici'])){
        $pc_dirittiCiviliPolitici = 1;
    }else{
        $pc_dirittiCiviliPolitici = 0;
    }
    if(isset($_POST['pc_destituzionePA'])){
        $pc_destituzionePA = 1;
    }else{
        $pc_destituzionePA = 0;
    }

    if(isset($_POST['pc_obbligoLeva'])){
        if($_POST['pc_obbligoLeva'] == "1"){
            $pc_obbligoLeva = 1;
        }else{
            $pc_obbligoLeva = 0;
        }
    }else{
        $pc_obbligoLeva = 0;
    }

    if(isset($_POST['pc_fedina'])){
        $pc_fedina = 1;
    }else{
        $pc_fedina = 0;
    }
    
    if(isset($_POST['pc_conoscenzaInformatica'])){
        $pc_conoscenzaInformatica = 1;
    }else{
        $pc_conoscenzaInformatica = 0;
    }
    
    if(isset($_POST['pc_dirittoRiserva'])){
        $pc_dirittoRiserva = 1;
    }else{
        $pc_dirittoRiserva = 0;
    }
    
    /* salvo tutti i dati nel DB nella tabella partecipazione_concorso con status 0 */    
    $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlINS = "INSERT INTO partecipazione_concorso (status_id, id_orig, richiedenteCf, richiedenteNome, richiedenteCognome, richiedenteDataNascita, richiedenteLuogoNascita, richiedenteVia, richiedenteLocalita, richiedenteProvincia, richiedenteEmail, richiedenteTel, ConcorsoId, cittadinoItaliano, cittadinoEuropeo, statoEuropeo, conoscenzaLingua, idoneitaFisica, dirittiCiviliPolitici, destituzionePA, fedinaPulita, condanne, obbligoLeva, titoloStudio, titoloStudioScuola, titoloStudioData, titoloStudioVoto, conoscenzaInformatica, conoscenzaLinguaEstera, titoliPreferenza, necessitaHandicap, dirittoRiserva, accettazioneCondizioniBando, accettazioneDisposizioniComune, accettazioneComunicazioneVariazioniDomicilio) VALUES (0,'".$_POST['pc_bozza_id']."','".addslashes($_POST['pc_richiedente_cf'])."','".addslashes($_POST['pc_richiedente_nome'])."','".addslashes($_POST['pc_richiedente_cognome'])."','".$_POST['pc_richiedente_data_nascita']."','".addslashes($_POST['pc_richiedente_luogo_nascita'])."','".addslashes($_POST['pc_richiedente_via'])."','".addslashes($_POST['pc_richiedente_localita'])."','".$_POST['pc_richiedente_provincia']."','".$_POST['pc_richiedente_email']."','".$_POST['pc_richiedente_tel']."','".$_POST['pc_ConcorsoId']."','".$pc_cittadinoItaliano."','".$pc_cittadinoEuropeo."','".$_POST['pc_statoEuropeo']."','".$pc_conoscenzaLingua."','".$pc_idoneitaFisica."','".$pc_dirittiCiviliPolitici."','".$pc_destituzionePA."','".$pc_fedina."','".addslashes($_POST['pc_condanne'])."','".$pc_obbligoLeva."','".addslashes($_POST['pc_titoloStudio'])."','".addslashes($_POST['pc_titoloStudioScuola'])."','".$_POST['pc_titoloStudioData']."','".$_POST['pc_titoloStudioVoto']."','".$pc_conoscenzaInformatica."','".$_POST['pc_conoscenzaLinguaEstera']."','".addslashes($_POST['pc_titoliPreferenza'])."','".addslashes($_POST['pc_necessitaHandicap'])."','".$pc_dirittoRiserva."','".$_POST['pc_accettazioneCondizioniBando']."','".$_POST['pc_accettazioneDisposizioniComune']."','".$_POST['pc_accettazioneComunicazioneVariazioniDomicilio']."')";
    $connessioneINS->query($sqlINS);
    
    $sqlINS = "SELECT id FROM partecipazione_concorso WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 0 ORDER BY id DESC LIMIT 1";
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
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE partecipazione_concorso SET uploadCartaIdentitaFronte = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['pc_uploadCartaIdentitaFronteSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE partecipazione_concorso SET uploadCartaIdentitaFronte = '".$_POST['pc_uploadCartaIdentitaFronteSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
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
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE partecipazione_concorso SET uploadCartaIdentitaRetro = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['pc_uploadCartaIdentitaRetroSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE partecipazione_concorso SET uploadCartaIdentitaRetro = '".$_POST['pc_uploadCartaIdentitaRetroSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
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
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE partecipazione_concorso SET uploadCV = '".$filename."' WHERE id = ".$new_id;
                $connessioneUPD->query($sqlUPD);
            }
        }
    }else{
        if($_POST['pc_uploadCVSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE partecipazione_concorso SET uploadCV = '".$_POST['pc_uploadCVSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
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
                        $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                        $sqlUPD = "UPDATE partecipazione_concorso SET uploadTitoliPreferenza = CONCAT(uploadTitoliPreferenza, '".$filename.";') WHERE id = ".$new_id;
                        $connessioneUPD->query($sqlUPD);
                    }
                }
            }
        }
    }else{
        if($_POST['pc_uploadTitoliPreferenzaSaved'] != ''){
            /* salvo nel DB i nomi */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE partecipazione_concorso SET uploadTitoliPreferenza = '".$_POST['pc_uploadTitoliPreferenzaSaved']."' WHERE id = ".$new_id;
            $connessioneUPD->query($sqlUPD);
        }
    }
    /* pc_uploadTitoliPreferenza - end */


    $data['success'] = true;
    $data['message'] = $new_id;
}
echo json_encode($data);