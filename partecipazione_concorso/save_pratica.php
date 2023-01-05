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
$sqlCheck = "SELECT id FROM partecipazione_concorso WHERE richiedenteCf = '". $_SESSION['CF']."' and id = " . $_POST['pratican'] ." and status_id = 0 and numeroPratica = ''";
$data['error'] = $sqlCheck;
$resultCheck = $connessioneCheck->query($sqlCheck);

if ($resultCheck->num_rows > 0) {

    /* genero numero pratica */
    $connessioneNP = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlNP = "SELECT NumeroPratica FROM partecipazione_concorso WHERE status_id > 1 ORDER BY id DESC LIMIT 1";
    $resultNP = $connessioneNP->query($sqlNP);

    if ($resultNP->num_rows > 0) {
        while($rowNP = $resultNP->fetch_assoc()) {
            /* prendo il nuovo numeroPratica */
            $LastPratica = $rowNP['NumeroPratica'];
            $numberPraticaTmp = substr($LastPratica, -8);
            $numberPraticaTmp2 = filter_var($numberPraticaTmp, FILTER_SANITIZE_NUMBER_INT) + 1;
            $length = 8;
            $NumeroPratica = "PC".str_pad($numberPraticaTmp2,$length,"0", STR_PAD_LEFT);
        }
    }else{
        $NumeroPratica = "PC00000001";
    }

    /* DATI ESTRAPOLATI DA DB - start */
    /* estrapolo i dati salvati con status tmp */
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT * FROM `partecipazione_concorso` WHERE id = " . $_POST['pratican'];
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {

            $fromMail = $configSmtp['smtp_username'];
            $fromName = $configData['nome_comune'] . " - Servizi Online";

            /* rinomino i file */
            $upload_location = "../uploads/partecipazione_concorso/";

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

            $NewuploadCV = "";
            if(!empty($row["uploadCV"])){
                $uploadCV = $row["uploadCV"];
                $NewuploadCV = str_replace("_bozza_","_".$NumeroPratica."_",$uploadCV);
                if (file_exists($upload_location.$uploadCV)){
                    $renamed= rename($upload_location.$uploadCV,$upload_location.$NewuploadCV);
                }else{
                    $data['error'] = "The original file that you want to rename doesn't exist";
                }                    
            }


            $NewuploadTitoliPreferenza = "";
            if(!empty($row["uploadTitoliPreferenza"])){
                $tmpUploadTitoliPreferenza1 = substr($row["uploadTitoliPreferenza"],0,-1);
                $tmpUploadTitoliPreferenzas = explode(';', $tmpUploadTitoliPreferenza1);
                $uploadTitoliPreferenza = "";
                foreach($tmpUploadTitoliPreferenzas as $tmpUploadTitoliPreferenza) {
                    $uploadTitoliPreferenza = $tmpUploadTitoliPreferenza;
                    $NewuploadTitoliPreferenzaTmp = str_replace("_bozza_","_".$NumeroPratica."_",$uploadTitoliPreferenza);

                    if (file_exists($upload_location.$uploadTitoliPreferenza)){
                        $renamed= rename($upload_location.$uploadTitoliPreferenza,$upload_location.$NewuploadTitoliPreferenzaTmp);
                    }else{
                        $data['error'] = "The original file that you want to rename doesn't exist";
                    }
                    $NewuploadTitoliPreferenza .= $NewuploadTitoliPreferenzaTmp.";";
                }
            }

            /* salvo tutti i dati in una riga nuova con status 2 */
            $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlINS = "INSERT INTO `partecipazione_concorso` (status_id,richiedenteCf, richiedenteNome, richiedenteCognome, richiedenteDataNascita, richiedenteLuogoNascita, richiedenteVia, richiedenteLocalita, richiedenteProvincia, richiedenteEmail, richiedenteTel, ConcorsoId, cittadinoItaliano, cittadinoEuropeo, statoEuropeo, conoscenzaLingua, idoneitaFisica, dirittiCiviliPolitici, destituzionePA, fedinaPulita, condanne, obbligoLeva, titoloStudio, titoloStudioScuola, titoloStudioData, titoloStudioVoto, conoscenzaInformatica, conoscenzaLinguaEstera, titoliPreferenza, necessitaHandicap, dirittoRiserva, accettazioneCondizioniBando, accettazioneDisposizioniComune, accettazioneComunicazioneVariazioniDomicilio,uploadCartaIdentitaFronte,uploadCartaIdentitaRetro,uploadCV,uploadTitoliPreferenza,NumeroPratica) VALUES (2,'".$row['richiedenteCf']."','".addslashes($row['richiedenteNome'])."','".addslashes($row['richiedenteCognome'])."','".$row['richiedenteDataNascita']."','".addslashes($row['richiedenteLuogoNascita'])."','".addslashes($row['richiedenteVia'])."','".addslashes($row['richiedenteLocalita'])."','".$row['richiedenteProvincia']."','".$row['richiedenteEmail']."','".$row['richiedenteTel']."','".$row['ConcorsoId']."','".$row['cittadinoItaliano']."','".$row['cittadinoEuropeo']."','".$row['statoEuropeo']."','".$row['conoscenzaLingua']."','".$row['idoneitaFisica']."','".$row['dirittiCiviliPolitici']."','".$row['destituzionePA']."','".$row['fedinaPulita']."','".addslashes($row['condanne'])."','".$row['obbligoLeva']."','".addslashes($row['titoloStudio'])."','".addslashes($row['titoloStudioScuola'])."','".$row['titoloStudioData']."','".$row['titoloStudioVoto']."','".$row['conoscenzaInformatica']."','".$row['conoscenzaLinguaEstera']."','".addslashes($row['titoliPreferenza'])."','".addslashes($row['necessitaHandicap'])."','".$row['dirittoRiserva']."','".$row['accettazioneCondizioniBando']."','".$row['accettazioneDisposizioniComune']."','".$row['accettazioneComunicazioneVariazioniDomicilio']."','".$NewuploadCartaIdentitaFronte."','".$NewuploadCartaIdentitaRetro."','".$NewuploadCV."','".$NewuploadTitoliPreferenza."','".$NumeroPratica."')";
            $connessioneINS->query($sqlINS);

            /* ricavo il nuovo id */
            $sqlINS = "SELECT id FROM partecipazione_concorso WHERE richiedenteCf = '". $_SESSION['CF'] ."' and status_id = 2 ORDER BY id DESC LIMIT 1";
            $resultINS = $connessioneINS->query($sqlINS);
            if ($resultINS->num_rows > 0) {
            // output data of each row
                while($rowINS = $resultINS->fetch_assoc()) {
                    /* prendo il nuovo id */
                    $new_id = $rowINS['id'];
                }
            }
            $data['pratica'] = $NumeroPratica;

            /* vado ad eliminare la bozza e la tmp */
            $connessioneDEL = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlDEL = "DELETE FROM attivita WHERE cf = '". $_SESSION['CF'] ."' AND servizio_id = 16 AND status_id = 1 AND pratica_id = ".$row['id_orig'];
            $connessioneDEL->query($sqlDEL);

            $sqlDEL = "DELETE FROM attivita WHERE cf = '". $_SESSION['CF'] ."' AND servizio_id = 16 AND status_id = 0 AND pratica_id = ".$_POST['pratican'];
            $connessioneDEL->query($sqlDEL);                

            $sqlDEL = "DELETE FROM partecipazione_concorso WHERE id = ".$row['id_orig'];
            $connessioneDEL->query($sqlDEL);

            $sqlDEL = "DELETE FROM partecipazione_concorso WHERE id = ".$_POST['pratican'];
            $connessioneDEL->query($sqlDEL);

            /* salvo nelle attitivà la creazione o modifica della bozza per partecipazione_concorso */
                $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id,data_attivita) VALUES ('". $_SESSION['CF'] ."',16,".$new_id.",2,'".date('Y-m-d')."')";
                $connessioneINS->query($sqlINS);


            /* salvo nei messaggi che ho una bozza da completare per partecipazione_concorso */
                $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo,data_msg) VALUES ('". $_SESSION['CF'] ."',16,'La tua richiesta di iscrizione al concorso è stata inviata.<br/>Il numero della pratica è: <b>".$NumeroPratica."</b>','".date('Y-m-d')."')";
                $connessioneINS->query($sqlINS);  

            /* preparo il pdf da allegare alla mail del comune */
                include '../lib/tcpdf/TCPDF-master/tcpdf.php';
                include '../lib/tcpdf/TCPDF-master/examples/pc_pdf_comune.php'; 

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
                $phpmailer->Subject = 'Comune di '. $configData['nome_comune'] . ' - Iscrizione al concorso  - '.$NumeroPratica.' - '. $_SESSION['CF'];

                /* Add Static Attachment */
                /* allego la pratica completa appena creata */
                $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/pratiche/'. $NumeroPratica . '.pdf';
                $phpmailer->AddAttachment($attachment , $NumeroPratica . '.pdf');

                /* se ci sono altri documenti, li allego */
                if($NewuploadCartaIdentitaFronte <> ''){
                    $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/partecipazione_concorso/'. $NewuploadCartaIdentitaFronte;
                    $phpmailer->AddAttachment($attachment , $NewuploadCartaIdentitaFronte);
                }
                if($NewuploadCartaIdentitaRetro <> ''){
                    $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/partecipazione_concorso/'. $NewuploadCartaIdentitaRetro;
                    $phpmailer->AddAttachment($attachment , $NewuploadCartaIdentitaRetro);
                }
                if($NewuploadCV <> ''){
                    $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/partecipazione_concorso/'. $NewuploadCV;
                    $phpmailer->AddAttachment($attachment , $NewuploadCV);
                }
                if($NewuploadTitoliPreferenza <> ''){
                    $tmpUploadTitoliPreferenza1 = substr($NewuploadTitoliPreferenza,0,-1);
                    $tmpUploadTitoliPreferenzas = explode(';', $tmpUploadTitoliPreferenza1);

                    foreach($tmpUploadTitoliPreferenzas as $tmpUploadTitoliPreferenza) {
                        $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/partecipazione_concorso/'. $tmpUploadTitoliPreferenza;
                        $phpmailer->AddAttachment($attachment , $tmpUploadTitoliPreferenza);
                    }
                }

                $phpmailer->isHTML(true);

                $message = file_get_contents('../template/mail/toComune.html');
                $message = str_replace('%nome%', $_SESSION['Nome'], $message); 
                $message = str_replace('%cognome%', $_SESSION['Cognome'], $message);
                $message = str_replace('%codicefiscale%', $_SESSION['CF'], $message);
                $message = str_replace('%numeropratica%', $NumeroPratica, $message);
                $message = str_replace('%servizioselezionato%', 'iscrizione ad un concorso', $message);
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
                $phpmailer2->setFrom($configData['mail_comune'], 'Comune di ' . $configData['nome_comune']);
                $phpmailer2->addAddress('paola.durelli@proximalab.it', 'Proxima');
                $phpmailer2->addAddress($_SESSION["Email"]);
                $phpmailer2->Subject = 'Comune di '. $configData['nome_comune'] . ' - Iscrizione al concorso ';
                $phpmailer2->isHTML(true);

                $message2 = file_get_contents('../template/mail/toUser.html');
                $message2 = str_replace('%nome%', $_SESSION['Nome'], $message2); 
                $message2 = str_replace('%cognome%', $_SESSION['Cognome'], $message2);
                $message2 = str_replace('%codicefiscale%', $_SESSION['CF'], $message2);
                $message2 = str_replace('%numeropratica%', $NumeroPratica, $message2);
                $message2 = str_replace('%servizioselezionato%', 'iscrizione ad un concorso', $message2);
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

    /* se la protocollazione è attiva inserisco il numero di protocollo - start */
    if($configDB['ProtocollazioneAttiva']){
        $newProtocollo = getNumeroProtocollo();
        $newProtocolloNumber = getNumeroProtocolloNumber();

        $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sqlUPD = "UPDATE partecipazione_concorso SET NumeroProtocollo='".$newProtocollo."' WHERE id = '".$new_id."'";
        $connessioneUPD->query($sqlUPD);                

        setNumeroProtocollo($newProtocolloNumber);
    }
    /* se la protocollazione è attiva inserisco il numero di protocollo - end */
    
    /* invio messaggio all'App IO - start */
    if($configDB['AppIoAttiva']){
        SendToAppIo('partecipazione_concorso',$NumeroPratica);
    }
    /* invio messaggio all'App IO - end */
    
    $data['success'] = true;
    $data['id'] = $new_id;
}

echo json_encode($data);