<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
$configData = require '../env/config_servizi.php';
session_start();

$errors = [];
$data = [];

/* check validazione */
if($_POST['pm_richiedente_nome']==""){
    $errors['pm_richiedente_nome'] = "<li><a href='#pm_richiedente_nome_txt'>Inserire il Nome del richiedente</a></li>";
}
if($_POST['pm_richiedente_cognome']==""){
    $errors['pm_richiedente_cognome'] = "<li><a href='#pm_richiedente_cognome_txt'>Inserire il Cognome del richiedente</a></li>";
}
if($_POST['pm_richiedente_cf']==""){
    $errors['pm_richiedente_cf'] = "<li><a href='#pm_richiedente_cf_txt'>Inserire il Codice Fiscale del richiedente</a></li>";
}
if(!isValidCodiceFiscale($_POST['pm_richiedente_cf'])){
    $errors['pm_richiedente_cf'] = "<li><a href='#pm_richiedente_cf_txt'>Codice Fiscale non valido</a></li>";
}
if($_POST['pm_richiedente_data_nascita']==""){
    $errors['pm_richiedente_data_nascita'] = "<li><a href='#pm_richiedente_data_nascita_txt'>Inserire la Data di nascita del richiedente</a></li>";
}
if($_POST['pm_richiedente_luogo_nascita']==""){
    $errors['pm_richiedente_luogo_nascita'] = "<li><a href='#pm_richiedente_luogo_nascita_txt'>Inserire il Luogo di Nascita del richiedente</a></li>";
}
if($_POST['pm_richiedente_via']==""){
    $errors['pm_richiedente_via'] = "<li><a href='#pm_richiedente_via_txt'>Inserire la Via del richiedente</a></li>";
}
if($_POST['pm_richiedente_localita']==""){
    $errors['pm_richiedente_localita'] = "<li><a href='#pm_richiedente_localita_txt'>Inserire la Località del richiedente</a></li>";
}
if($_POST['pm_richiedente_localita'] <> $configData['nome_comune']){
    $errors['pm_richiedente_localita'] = "<li><a href='#pm_richiedente_localita_txt'>Località inserita NON corriponde con il Comune</a></li>";
}
if($_POST['pm_richiedente_provincia']==""){
    $errors['pm_richiedente_provincia'] = "<li><a href='#pm_richiedente_provincia_txt'>Inserire la Provincia del richiedente</a></li>";
}
if($_POST['pm_richiedente_email']==""){
    $errors['pm_richiedente_email'] = "<li><a href='#pm_richiedente_email_txt'>Inserire la Email del richiedente</a></li>";
}
if(!filter_var($_POST['pm_richiedente_email'], FILTER_VALIDATE_EMAIL)){
    $errors['pm_richiedente_email'] = "<li><a href='#pm_richiedente_email_txt'>Email del richiedente NON corretta</a></li>";
}
if($_POST['pm_richiedente_tel']==""){
    $errors['pm_richiedente_tel'] = "<li><a href='#pm_richiedente_tel_txt'>Inserire il Telefono del richiedente</a></li>";
}
if(!isValidTelephoneNumber($_POST['pm_richiedente_tel']) == "error"){
    $errors['pm_richiedente_tel'] = "<li><a href='#pm_richiedente_tel_txt'>Telefono del richiedente NON corretto</a></li>";
}
if($_POST['pm_richiedenteStatoNascita']==""){
    $errors['pm_richiedenteStatoNascita'] = "<li><a href='#pm_richiedenteStatoNascita_txt'>Inserire lo Stato di Nascita del richiedente</a></li>";
}
if($_POST['pm_richiedenteStatoCivile']==""){
    $errors['pm_richiedenteStatoCivile'] = "<li><a href='#pm_richiedenteStatoCivile_txt'>Inserire lo Stato Civile del richiedente</a></li>";
}
if($_POST['pm_richiedenteAttoNascita']==""){
    $errors['pm_richiedenteAttoNascita'] = "<li><a href='#pm_richiedenteAttoNascita_txt'>Inserire il numero dell'atto di nascita del richiedente</a></li>";
}
if($_POST['pm_richiedenteAttoNascitaData']==""){
    $errors['pm_richiedenteAttoNascitaData'] = "<li><a href='#pm_richiedenteAttoNascitaData_txt'>Inserire l'anno dell'atto di nascita del richiedente</a></li>";
}
if($_POST['pm_coniugeNome']==""){
    $errors['pm_coniugeNome'] = "<li><a href='#pm_coniugeNome_txt'>Inserire il Nome del coniuge</a></li>";
}
if($_POST['pm_coniugeCognome']==""){
    $errors['pm_coniugeCognome'] = "<li><a href='#pm_coniugeCognome_txt'>Inserire il Cognome del coniuge</a></li>";
}
if($_POST['pm_coniugeCf']==""){
    $errors['pm_coniugeCf'] = "<li><a href='#pm_coniugeCf_txt'>Inserire il Codice Fiscale del coniuge</a></li>";
}
if(!isValidCodiceFiscale($_POST['pm_coniugeCf'])){
    $errors['pm_coniugeCf'] = "<li><a href='#pm_coniugeCf_txt'>Codice Fiscale del coniuge non valido</a></li>";
}
if($_POST['pm_coniugeDataNascita']==""){
    $errors['pm_coniugeDataNascita'] = "<li><a href='#pm_coniugeDataNascita_txt'>Inserire la Data di nascita del coniuge</a></li>";
}
if($_POST['pm_coniugeLuogoNascita']==""){
    $errors['pm_coniugeLuogoNascita'] = "<li><a href='#pm_coniugeLuogoNascita_txt'>Inserire il Luogo di Nascita del coniuge</a></li>";
}
if($_POST['pm_coniugeStatoNascita']==""){
    $errors['pm_coniugeStatoNascita'] = "<li><a href='#pm_coniugeStatoNascita_txt'>Inserire lo Stato di Nascita del coniuge</a></li>";
}
if($_POST['pm_coniugeVia']==""){
    $errors['pm_coniugeVia'] = "<li><a href='#pm_coniugeVia_txt'>Inserire la via del coniuge</a></li>";
}
if($_POST['pm_coniugeLocalita']==""){
    $errors['pm_coniugeLocalita'] = "<li><a href='#pm_coniugeLocalita_txt'>Inserire il Comune del coniuge</a></li>";
}
if($_POST['pm_coniugeProvincia']==""){
    $errors['pm_coniugeProvincia'] = "<li><a href='#pm_coniugeProvincia_txt'>Inserire la provincia del coniuge</a></li>";
}
if($_POST['pm_coniugeEmail']==""){
    $errors['pm_coniugeEmail'] = "<li><a href='#pm_coniugeEmail_txt'>Inserire l'Email del coniuge</a></li>";
}
if(!filter_var($_POST['pm_coniugeEmail'], FILTER_VALIDATE_EMAIL)){
    $errors['pm_coniugeEmail'] = "<li><a href='#pm_coniugeEmail_txt'>Email del coniuge NON corretta</a></li>";
}
if($_POST['pm_coniugeTel']==""){
    $errors['pm_coniugeTel'] = "<li><a href='#pm_coniugeTel_txt'>Inserire il Telefono del coniuge</a></li>";
}
if(!isValidTelephoneNumber($_POST['pm_coniugeTel']) == "error"){
    $errors['pm_coniugeTel'] = "<li><a href='#pm_coniugeTel_txt'>Telefono del coniuge NON corretto</a></li>";
}
if($_POST['pm_coniugeStatoCivile']==""){
    $errors['pm_coniugeStatoCivile'] = "<li><a href='#pm_coniugeStatoCivile_txt'>Inserire lo Stato Civile del coniuge</a></li>";
}
if($_POST['pm_coniugeAttoNascita']==""){
    $errors['pm_coniugeAttoNascita'] = "<li><a href='#pm_coniugeAttoNascita_txt'>Inserire il numero dell'atto di nascita del coniuge</a></li>";
}
if($_POST['pm_coniugeAttoNascitaData']==""){
    $errors['pm_coniugeAttoNascitaData'] = "<li><a href='#pm_coniugeAttoNascitaData_txt'>Inserire l'anno dell'atto di nascita del coniuge</a></li>";
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    /* salvo tutti i dati nel DB nella tabella pubblicazione_matrimonio con status 0 */    
    $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlINS = "INSERT INTO `pubblicazione_matrimonio`(status_id,richiedenteNome,richiedenteCognome,richiedenteCf,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,richiedenteStatoNascita,richiedenteStatoCivile,richiedenteAttoNascita,richiedenteAttoNascitaData,coniugeNome,coniugeCognome,coniugeCf,coniugeDataNascita,coniugeLuogoNascita,coniugeStatoNascita,coniugeVia,coniugeLocalita,coniugeProvincia,coniugeEmail,coniugeTel,coniugeStatoCivile,coniugeAttoNascita,coniugeAttoNascitaData) VALUES (0,'".addslashes($_POST['pm_richiedente_nome'])."','".addslashes($_POST['pm_richiedente_cognome'])."','".$_POST['pm_richiedente_cf']."','".$_POST['pm_richiedente_data_nascita']."','".addslashes($_POST['pm_richiedente_luogo_nascita'])."','".addslashes($_POST['pm_richiedente_via'])."','".addslashes($_POST['pm_richiedente_localita'])."','".$_POST['pm_richiedente_provincia']."','".$_POST['pm_richiedente_email']."','".$_POST['pm_richiedente_tel']."','".addslashes($_POST['pm_richiedenteStatoNascita'])."','".addslashes($_POST['pm_richiedenteStatoCivile'])."','".addslashes($_POST['pm_richiedenteAttoNascita'])."','".addslashes($_POST['pm_richiedenteAttoNascitaData'])."','".addslashes($_POST['pm_coniugeNome'])."','".addslashes($_POST['pm_coniugeCognome'])."','".addslashes($_POST['pm_coniugeCf'])."','".addslashes($_POST['pm_coniugeDataNascita'])."','".addslashes($_POST['pm_coniugeLuogoNascita'])."','".addslashes($_POST['pm_coniugeStatoNascita'])."','".addslashes($_POST['pm_coniugeVia'])."','".addslashes($_POST['pm_coniugeLocalita'])."','".addslashes($_POST['pm_coniugeProvincia'])."','".addslashes($_POST['pm_coniugeEmail'])."','".addslashes($_POST['pm_coniugeTel'])."','".addslashes($_POST['pm_coniugeStatoCivile'])."','".addslashes($_POST['pm_coniugeAttoNascita'])."','".addslashes($_POST['pm_coniugeAttoNascitaData'])."')";
    $connessioneINS->query($sqlINS);
    
    $sqlINS = "SELECT id FROM pubblicazione_matrimonio WHERE richiedenteCf = '". $_SESSION['CF']."' and status_id = 0 ORDER BY id DESC LIMIT 1";
    $resultINS = $connessioneINS->query($sqlINS);

    if ($resultINS->num_rows > 0) {
    // output data of each row
        while($row = $resultINS->fetch_assoc()) {
            /* tutto ok */
            /* prendo l'id che mi servirà per costruire i nomi dei documenti */
            $new_id = $row['id'];
        }
    }

    $data['success'] = true;
    $data['message'] = $new_id;
}
echo json_encode($data);