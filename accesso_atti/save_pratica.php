<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';


include '../fun/utility.php';
$configDB = require '../env/config.php';
$configData = require '../env/config_servizi.php';
$configSmtp = require '../env/config_smtp.php';
session_start();

$data = [];

   $data['success'] = false;
   
   
/* controllo che non sia un refresh della pagina che creerebbe una nuova riga - controllo quindi che la riga con status tmp non abbia il campo numero pratica già popolato */
    $connessioneCheck = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlCheck = "SELECT id FROM accesso_atti WHERE richiedenteCf = '". $_SESSION['CF']."' and id = " . $_POST['pratican'] ." and status_id = 0 and numeroPratica = ''";
    $data['error'] = $sqlCheck;
    $resultCheck = $connessioneCheck->query($sqlCheck);
    
    if ($resultCheck->num_rows > 0) {
        
        /* genero numero pratica */
        $connessioneNP = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sqlNP = "SELECT NumeroPratica FROM accesso_atti WHERE status_id > 1 ORDER BY id DESC LIMIT 1";
        $resultNP = $connessioneNP->query($sqlNP);

        if ($resultNP->num_rows > 0) {
            while($rowNP = $resultNP->fetch_assoc()) {
                /* prendo il nuovo numeroPratica */
                $LastPratica = $rowNP['NumeroPratica'];
                $numberPraticaTmp = substr($LastPratica, -8);
                $numberPraticaTmp2 = filter_var($numberPraticaTmp, FILTER_SANITIZE_NUMBER_INT) + 1;
                $length = 8;
                $NumeroPratica = "AA".str_pad($numberPraticaTmp2,$length,"0", STR_PAD_LEFT);
            }
        }else{
            $NumeroPratica = "AA00000001";
        }

        /* DATI ESTRAPOLATI DA DB - start */
        /* estrapolo i dati salvati con status tmp */
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM `accesso_atti` WHERE id = " . $_POST['pratican'];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                
                $fromMail = $configSmtp['smtp_username'];
                $fromName = $configData['nome_comune'] . " - Servizi Online";

                /* rinomino i file */
                $upload_location = "../uploads/accesso_atti/";
                
                $NewuploadTitoloDichiarato = "";
                if(!empty($row["uploadTitoloDichiarato"])){
                    $uploadTitoloDichiarato = $row["uploadTitoloDichiarato"];
                    $NewuploadTitoloDichiarato = str_replace("_bozza_","_".$NumeroPratica."_",$uploadTitoloDichiarato);
                    if (file_exists($upload_location.$uploadTitoloDichiarato)){
                        $renamed= rename($upload_location.$uploadTitoloDichiarato,$upload_location.$NewuploadTitoloDichiarato);
                    }else{
                        $data['error'] = "The original file that you want to rename doesn't exist";
                    }
                }
                $NewuploadAffittuario = "";
                if(!empty($row["uploadAffittuario"])){
                    $uploadAffittuario = $row["uploadAffittuario"];
                    $NewuploadAffittuario = str_replace("_bozza_","_".$NumeroPratica."_",$uploadAffittuario);
                    if (file_exists($upload_location.$uploadAffittuario)){
                        $renamed= rename($upload_location.$uploadAffittuario,$upload_location.$NewuploadAffittuario);
                    }else{
                        $data['error'] = "The original file that you want to rename doesn't exist";
                    }
                }
                $NewuploadAltroSoggetto = "";
                if(!empty($row["uploadAltroSoggetto"])){
                    $uploadPotereFirma = $row["uploadAltroSoggetto"];
                    $NewuploadAltroSoggetto = str_replace("_bozza_","_".$NumeroPratica."_",$uploadAltroSoggetto);
                    if (file_exists($upload_location.$uploadAltroSoggetto)){
                        $renamed= rename($upload_location.$uploadAltroSoggetto,$upload_location.$NewuploadAltroSoggetto);
                    }else{
                        $data['error'] = "The original file that you want to rename doesn't exist";
                    }
                }
                $NewuploadNotaioRogante = "";
                if(!empty($row["uploadNotaioRogante"])){
                    $uploadNotaioRogante = $row["uploadNotaioRogante"];
                    $NewuploadNotaioRogante = str_replace("_bozza_","_".$NumeroPratica."_",$uploadNotaioRogante);
                    if (file_exists($upload_location.$uploadNotaioRogante)){
                        $renamed= rename($upload_location.$uploadNotaioRogante,$upload_location.$NewuploadNotaioRogante);
                    }else{
                        $data['error'] = "The original file that you want to rename doesn't exist";
                    }                    
                }
                $NewuploadAltriTitoloDescrizione = "";
                if(!empty($row["uploadAltriTitoloDescrizione"])){
                    $uploadAltriTitoloDescrizione = $row["uploadAltriTitoloDescrizione"];
                    $NewuploadAltriTitoloDescrizione = str_replace("_bozza_","_".$NumeroPratica."_",$uploadAltriTitoloDescrizione);
                    if (file_exists($upload_location.$uploadAltriTitoloDescrizione)){
                        $renamed= rename($upload_location.$uploadAltriTitoloDescrizione,$upload_location.$NewuploadAltriTitoloDescrizione);
                    }else{
                        $data['error'] = "The original file that you want to rename doesn't exist";
                    }                    
                }
                $NewuploadCartaIdentitaFronte = "";
                if(!empty($row["uploadCartaIdentitaFronte"])){
                    $uploadCartaIdentitaFronte = $row["uploadCartaIdentitaFronte"];
                    $NewuploadCartaIdentitaFronte = str_replace("_bozza_","_".$NumeroPratica."_",$uploadCartaIdentitaFronte);
                    if (file_exists($upload_location.$uploadCartaIdentitaFronte)){
                        $renamed= rename($upload_location.$uploadCartaIdentitaFronte,$upload_location.$NewuploadCartaIdentitaFronte);
                    }else{
                        $data['error'] = "The original file that you want to rename doesn't exist";
                    }                    
                }
                $NewuploadCartaIdentitaRetro = "";
                if(!empty($row["uploadCartaIdentitaRetro"])){
                    $uploadCartaIdentitaRetro = $row["uploadCartaIdentitaRetro"];
                    $NewuploadCartaIdentitaRetro = str_replace("_bozza_","_".$NumeroPratica."_",$uploadCartaIdentitaRetro);
                    if (file_exists($upload_location.$uploadCartaIdentitaRetro)){
                        $renamed= rename($upload_location.$uploadCartaIdentitaRetro,$upload_location.$NewuploadCartaIdentitaRetro);
                    }else{
                        $data['error'] = "The original file that you want to rename doesn't exist";
                    }                    
                }
                $NewuploadAttoNotarile = "";
                if(!empty($row["uploadAttoNotarile"])){
                    $uploadAttoNotarile = $row["uploadAttoNotarile"];
                    $NewuploadAttoNotarile = str_replace("_bozza_","_".$NumeroPratica."_",$uploadAttoNotarile);
                    if (file_exists($upload_location.$uploadAttoNotarile)){
                        $renamed= rename($upload_location.$uploadAttoNotarile,$upload_location.$NewuploadAttoNotarile);
                    }else{
                        $data['error'] = "The original file that you want to rename doesn't exist";
                    }                    
                }

                /* salvo tutti i dati in una riga nuova con status 2 */
                $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlINS = "INSERT INTO accesso_atti(status_id,UfficioDestinatarioId,richiedenteCf,richiedenteNome,richiedenteCognome,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,pgRuolo,pgDenominazione,pgTipologia,pgSedeLegaleIndirizzo,pgSedeLegaleLocalita,pgSedeLegaleProvincia,pgSedeLegaleCap,pgCf,pgPiva,pgTelefono,pgEmail,pgPec,richiedenteTitolo,richiedenteProfessionistaIncaricatoDa,richiedenteProfessionistaIncaricatoDaNome,richiedenteProfessionistaIncaricatoDaCognome,richiedenteProfessionistaIncaricatoDaCf,richiedenteProfessionistaIncaricatoDaAltroSoggetto,richiedenteProfessionistaIncaricatoDaDescrizioneTitolo,richiestaTipo,richiestaAtti,richiestaAttiTipoDocumento,richiestaAttiProtocollo,richiestaAttiData,collocazioneTerritorialeCodiceCatastale,collocazioneTerritorialeSezione,collocazioneTerritorialeFoglio,collocazioneTerritorialeParticella,collocazioneTerritorialeSubalterno,collocazioneTerritorialeCategoria,collocazioneTerritorialeIndirizzo,collocazioneTerritorialeLocalita,collocazioneTerritorialeProvincia,motivo,motivoAltro,modoRitiro,modoRitiroPostaIndirizzo,modoRitiroPostaLocalita,modoRitiroPostaProvincia,modoRitiroPostaCap,annotazioni,uploadTitoloDichiarato,uploadAffittuario,uploadAltroSoggetto,uploadNotaioRogante,uploadAltriTitoloDescrizione,uploadCartaIdentitaFronte,uploadCartaIdentitaRetro,uploadAttoNotarile,NumeroPratica) VALUES (2,'".$row['UfficioDestinatarioId']."','".$row['richiedenteCf']."','".addslashes($row['richiedenteNome'])."','".addslashes($row['richiedenteCognome'])."','".$row['richiedenteDataNascita']."','".addslashes($row['richiedenteLuogoNascita'])."','".addslashes($row['richiedenteVia'])."','".addslashes($row['richiedenteLocalita'])."','".$row['richiedenteProvincia']."','".$row['richiedenteEmail']."','".$row['richiedenteTel']."','".$row['pgRuolo']."','".addslashes($row['pgDenominazione'])."','".$row['pgTipologia']."','".addslashes($row['pgSedeLegaleIndirizzo'])."','".addslashes($row['pgSedeLegaleLocalita'])."','".$row['pgSedeLegaleProvincia']."','".$row['pgSedeLegaleCap']."','".$row['pgCf']."','".$row['pgPiva']."','".$row['pgTelefono']."','".$row['pgEmail']."','".$row['pgPec']."','".addslashes($row['richiedenteTitolo'])."','".addslashes($row['richiedenteProfessionistaIncaricatoDa'])."','".addslashes($row['richiedenteProfessionistaIncaricatoDaNome'])."','".addslashes($row['richiedenteProfessionistaIncaricatoDaCognome'])."','".$row['richiedenteProfessionistaIncaricatoDaCf']."','".addslashes($row['richiedenteProfessionistaIncaricatoDaAltroSoggetto'])."','".addslashes($row['richiedenteProfessionistaIncaricatoDaDescrizioneTitolo'])."','".addslashes($row['richiestaTipo'])."','".addslashes($row['richiestaAtti'])."','".addslashes($row['richiestaAttiTipoDocumento'])."','".addslashes($row['richiestaAttiProtocollo'])."','".$row['richiestaAttiData']."','".$row['collocazioneTerritorialeCodiceCatastale']."','".$row['collocazioneTerritorialeSezione']."','".$row['collocazioneTerritorialeFoglio']."','".$row['collocazioneTerritorialeParticella']."','".$row['collocazioneTerritorialeSubalterno']."','".$row['collocazioneTerritorialeCategoria']."','".addslashes($row['collocazioneTerritorialeIndirizzo'])."','".addslashes($row['collocazioneTerritorialeLocalita'])."','".$row['collocazioneTerritorialeProvincia']."','".addslashes($row['motivo'])."','".addslashes($row['motivoAltro'])."','".$row['modoRitiro']."','".addslashes($row['modoRitiroPostaIndirizzo'])."','".addslashes($row['modoRitiroPostaLocalita'])."','".$row['modoRitiroPostaProvincia']."','".$row['modoRitiroPostaCap']."','".addslashes($row['annotazioni'])."','".$NewuploadTitoloDichiarato."','".$NewuploadAffittuario."','".$NewuploadAltroSoggetto."','".$NewuploadNotaioRogante."','".$NewuploadAltriTitoloDescrizione."','".$NewuploadCartaIdentitaFronte."','".$NewuploadCartaIdentitaRetro."','".$NewuploadAttoNotarile."','".$NumeroPratica."')";
                $connessioneINS->query($sqlINS);

                /* ricavo il nuovo id */
                $sqlINS = "SELECT id FROM accesso_atti WHERE richiedenteCf = '". $_SESSION['CF'] ."' and status_id = 2 ORDER BY id DESC LIMIT 1";
                $resultINS = $connessioneINS->query($sqlINS);
                if ($resultINS->num_rows > 0) {
                // output data of each row
                    while($rowINS = $resultINS->fetch_assoc()) {
                        /* prendo il nuovo id */
                        $new_id = $rowINS['id'];
                    }
                }
                $data['pratica'] = $NumeroPratica;

                /* vado ad inserire nella bozza il numero pratica - questo mi serve per lo storico. */
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE accesso_atti SET NumeroPratica = '".$NumeroPratica."' WHERE id = ".$_POST['pratican'];
                $connessioneUPD->query($sqlUPD);

                /* salvo nelle attitivà la creazione o modifica della bozza per accesso_atti */
                    $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id,data_attivita) VALUES ('". $_SESSION['CF'] ."',6,".$new_id.",2,'".date('Y-m-d')."')";
                    $connessioneINS->query($sqlINS);


                /* salvo nei messaggi che ho una bozza da completare per accesso_atti */
                    $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo,data_msg) VALUES ('". $_SESSION['CF'] ."',6,'La tua domanda di accesso agli atti è stata inviata.<br/>Il numero della pratica è: <b>".$NumeroPratica."</b>','".date('Y-m-d')."')";
                    $connessioneINS->query($sqlINS);  
                    
                /* preparo il pdf da allegare alla mail del comune */
                    include '../lib/tcpdf/TCPDF-master/tcpdf.php';
                    include '../lib/tcpdf/TCPDF-master/examples/aa_pdf_comune.php'; 

                /* mando mail al comune - start */
                    $phpmailer = new PHPMailer();
                    $phpmailer->isSMTP();
                    $phpmailer->Host = $configSmtp['smtp_host'];
                    $phpmailer->SMTPAuth = $configSmtp['smtp_auth'];
                    $phpmailer->Port = $configSmtp['smtp_port'];
                    $phpmailer->SMTPSecure = $configSmtp['smtp_secure'];
                    $phpmailer->Username = $configSmtp['smtp_username'];
                    $phpmailer->Password = $configSmtp['smtp_password'];
                    $phpmailer->setFrom($fromMail,$fromName);
                    $phpmailer->addAddress('paola.durelli@proximalab.it', 'Proxima');
                    $phpmailer->addAddress($configData['mail_comune'], 'Comune di ' . $configData['nome_comune']);
                    $phpmailer->Subject = 'Comune di '. $configData['nome_comune'] . ' - Domanda di accesso agli atti - '.$NumeroPratica.' - '. $_SESSION['CF'];

                    /* Add Static Attachment */
                    /* allego la pratica completa appena creata */

                    $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/pratiche/'. $NumeroPratica . '.pdf';
                    $phpmailer->AddAttachment($attachment , $NumeroPratica . '.pdf');
                    
                    /* se ci sono altri documenti, li allego */

                    if($NewuploadTitoloDichiarato <> ''){
                        $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/accesso_atti/'. $NewuploadTitoloDichiarato;
                        $phpmailer->AddAttachment($attachment , $NewuploadTitoloDichiarato);
                    }
                    if($NewuploadAffittuario <> ''){
                        $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/accesso_atti/'. $NewuploadAffittuario;
                        $phpmailer->AddAttachment($attachment , $NewuploadAffittuario);
                    }
                    if($NewuploadAltroSoggetto <> ''){
                        $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/accesso_atti/'. $NewuploadAltroSoggetto;
                        $phpmailer->AddAttachment($attachment , $NewuploadAltroSoggetto);
                    }
                    if($NewuploadNotaioRogante <> ''){
                        $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/accesso_atti/'. $NewuploadNotaioRogante;
                        $phpmailer->AddAttachment($attachment , $NewuploadNotaioRogante);
                    }
                    if($NewuploadAltriTitoloDescrizione <> ''){
                        $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/accesso_atti/'. $NewuploadAltriTitoloDescrizione;
                        $phpmailer->AddAttachment($attachment , $NewuploadAltriTitoloDescrizione);
                    }
                    if($NewuploadCartaIdentitaFronte <> ''){
                        $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/accesso_atti/'. $NewuploadCartaIdentitaFronte;
                        $phpmailer->AddAttachment($attachment , $NewuploadCartaIdentitaFronte);
                    }
                    if($NewuploadCartaIdentitaRetro <> ''){
                        $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/accesso_atti/'. $NewuploadCartaIdentitaRetro;
                        $phpmailer->AddAttachment($attachment , $NewuploadCartaIdentitaRetro);
                    }
                    if($NewuploadAttoNotarile <> ''){
                        $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/accesso_atti/'. $NewuploadAttoNotarile;
                        $phpmailer->AddAttachment($attachment , $NewuploadAttoNotarile);
                    }
                    
                    $phpmailer->isHTML(true);
                    
                    $message = file_get_contents('../template/mail/toComune.html');
                    $message = str_replace('%nome%', $_SESSION['Nome'], $message); 
                    $message = str_replace('%cognome%', $_SESSION['Cognome'], $message);
                    $message = str_replace('%codicefiscale%', $_SESSION['CF'], $message);
                    $message = str_replace('%numeropratica%', $NumeroPratica, $message);
                    $message = str_replace('%servizioselezionato%', 'domanda di accesso agli atti', $message);
                    $message = str_replace('%urlservizi%', $configData['url_servizi'], $message);
                    $message = str_replace('%nomecomune%', $configData['nome_comune'], $message);
                    $message = str_replace('%anno%', date('Y'), $message);
                    $phpmailer->Body = $message;

                    if($phpmailer->send()){
                    }else{
                        $data['error'] .= 'Message could not be sent.';
                        $data['error'] .= 'Mailer Error: ' . $phpmailer->ErrorInfo;
                    } 
                /* mando mail al comune - end */

                /* mando mail all'utente - start */
                    $phpmailer2 = new PHPMailer();
                    $phpmailer2->isSMTP();
                    $phpmailer2->Host = $configSmtp['smtp_host'];
                    $phpmailer2->SMTPAuth = $configSmtp['smtp_auth'];
                    $phpmailer2->Port = $configSmtp['smtp_port'];
                    $phpmailer2->SMTPSecure = $configSmtp['smtp_secure'];
                    $phpmailer2->Username = $configSmtp['smtp_username'];
                    $phpmailer2->Password = $configSmtp['smtp_password'];
                    $phpmailer->setFrom($fromMail,$fromName);
                    $phpmailer2->addAddress('paola.durelli@proximalab.it', 'Proxima');
                    $phpmailer2->addAddress($_SESSION["Email"]);
                    $phpmailer2->Subject = 'Comune di '. $configData['nome_comune'] . ' - Accesso agli atti ';
                    $phpmailer2->isHTML(true);
                    
                    $message2 = file_get_contents('../template/mail/toUser.html');
                    $message2 = str_replace('%nome%', $_SESSION['Nome'], $message2); 
                    $message2 = str_replace('%cognome%', $_SESSION['Cognome'], $message2);
                    $message2 = str_replace('%codicefiscale%', $_SESSION['CF'], $message2);
                    $message2 = str_replace('%numeropratica%', $NumeroPratica, $message2);
                    $message2 = str_replace('%servizioselezionato%', 'domanda di accesso agli atti', $message2);
                    $message2 = str_replace('%urlservizi%', $configData['url_servizi'], $message);
                    $message2 = str_replace('%nomecomune%', $configData['nome_comune'], $message2);
                    $message2 = str_replace('%telcomune%', $configData['tel_comune'], $message2);
                    $message2 = str_replace('%mailcomune%', $configData['mail_comune'], $message2);
                    $message2 = str_replace('%anno%', date('Y'), $message2);

                    $phpmailer2->Body = $message2;

                    if($phpmailer2->send()){
                        $data['error'] .= 'Message has been sent';
                    }else{
                        $data['error'] .= 'Message could not be sent.';
                        $data['error'] .= 'Mailer Error: ' . $phpmailer2->ErrorInfo;
                    }
                /* mando mail all'utente - end */
            }   
        }
        $data['success'] = true;
        $data['id'] = $new_id;
    }

    echo json_encode($data);