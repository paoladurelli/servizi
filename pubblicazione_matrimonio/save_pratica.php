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
    $sqlCheck = "SELECT id FROM pubblicazione_matrimonio WHERE richiedenteCf = '". $_SESSION['CF']."' and id = " . $_POST['pratican'] ." and status_id = 0 and numeroPratica = ''";
    $data['error'] = $sqlCheck;
    $resultCheck = $connessioneCheck->query($sqlCheck);
    
    if ($resultCheck->num_rows > 0) {
        
        /* genero numero pratica */
        $connessioneNP = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sqlNP = "SELECT NumeroPratica FROM pubblicazione_matrimonio WHERE status_id > 1 ORDER BY id DESC LIMIT 1";
        $resultNP = $connessioneNP->query($sqlNP);

        if ($resultNP->num_rows > 0) {
            while($rowNP = $resultNP->fetch_assoc()) {
                /* prendo il nuovo numeroPratica */
                $LastPratica = $rowNP['NumeroPratica'];
                $numberPraticaTmp = substr($LastPratica, -8);
                $numberPraticaTmp2 = filter_var($numberPraticaTmp, FILTER_SANITIZE_NUMBER_INT) + 1;
                $length = 8;
                $NumeroPratica = "PM".str_pad($numberPraticaTmp2,$length,"0", STR_PAD_LEFT);
            }
        }else{
            $NumeroPratica = "PM00000001";
        }

        /* DATI ESTRAPOLATI DA DB - start */
        /* estrapolo i dati salvati con status tmp */
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM `pubblicazione_matrimonio` WHERE id = " . $_POST['pratican'];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                
                $fromMail = $configSmtp['smtp_username'];
                $fromName = $configData['nome_comune'] . " - Servizi Online";

                /* salvo tutti i dati in una riga nuova con status 2 */
                $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlINS = "INSERT INTO `pubblicazione_matrimonio`(status_id,richiedenteNome,richiedenteCognome,richiedenteCf,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,richiedenteStatoNascita,richiedenteStatoCivile,richiedenteAttoNascita,richiedenteAttoNascitaData,coniugeNome,coniugeCognome,coniugeCf,coniugeDataNascita,coniugeLuogoNascita,coniugeStatoNascita,coniugeVia,coniugeLocalita,coniugeProvincia,coniugeEmail,coniugeTel,coniugeStatoCivile,coniugeAttoNascita,coniugeAttoNascitaData,NumeroPratica) VALUES (2,'".addslashes($row['richiedenteNome'])."','".addslashes($row['richiedenteCognome'])."','".$row['richiedenteCf']."','".$row['richiedenteDataNascita']."','".addslashes($row['richiedenteLuogoNascita'])."','".addslashes($row['richiedenteVia'])."','".addslashes($row['richiedenteLocalita'])."','".$row['richiedenteProvincia']."','".$row['richiedenteEmail']."','".$row['richiedenteTel']."','".addslashes($row['richiedenteStatoNascita'])."','".addslashes($row['richiedenteStatoCivile'])."','".addslashes($row['richiedenteAttoNascita'])."','".addslashes($row['richiedenteAttoNascitaData'])."','".addslashes($row['coniugeNome'])."','".addslashes($row['coniugeCognome'])."','".addslashes($row['coniugeCf'])."','".addslashes($row['coniugeDataNascita'])."','".addslashes($row['coniugeLuogoNascita'])."','".addslashes($row['coniugeStatoNascita'])."','".addslashes($row['coniugeVia'])."','".addslashes($row['coniugeLocalita'])."','".addslashes($row['coniugeProvincia'])."','".addslashes($row['coniugeEmail'])."','".addslashes($row['coniugeTel'])."','".addslashes($row['coniugeStatoCivile'])."','".addslashes($row['coniugeAttoNascita'])."','".addslashes($row['coniugeAttoNascitaData'])."','".$NumeroPratica."')";
                $connessioneINS->query($sqlINS);

                /* ricavo il nuovo id */
                $sqlINS = "SELECT id FROM pubblicazione_matrimonio WHERE richiedenteCf = '". $_SESSION['CF'] ."' and status_id = 2 ORDER BY id DESC LIMIT 1";
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
                $sqlUPD = "UPDATE pubblicazione_matrimonio SET NumeroPratica = '".$NumeroPratica."' WHERE id = ".$_POST['pratican'];
                $connessioneUPD->query($sqlUPD);

                /* salvo nelle attitivà la creazione o modifica della bozza per pubblicazione_matrimonio */
                    $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id,data_attivita) VALUES ('". $_SESSION['CF'] ."',5,".$new_id.",2,'".date('Y-m-d')."')";
                    $connessioneINS->query($sqlINS);


                /* salvo nei messaggi che ho una bozza da completare per pubblicazione_matrimonio */
                    $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo,data_msg) VALUES ('". $_SESSION['CF'] ."',5,'La tua richiesta di pubblicazione di matrimonio è stata inviata.<br/>Il numero della pratica è: <b>".$NumeroPratica."</b>','".date('Y-m-d')."')";
                    $connessioneINS->query($sqlINS);  
                    
                /* preparo il pdf da allegare alla mail del comune */
                    include '../lib/tcpdf/TCPDF-master/tcpdf.php';
                    include '../lib/tcpdf/TCPDF-master/examples/pm_pdf_comune.php'; 

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
                    $phpmailer->Subject = 'Comune di '. $configData['nome_comune'] . ' - Richiesta di pubblicazione di matrimonio  - '.$NumeroPratica.' - '. $_SESSION['CF'];

                    /* Add Static Attachment */
                    /* allego la pratica completa appena creata */

                    $attachment = $_SERVER['DOCUMENT_ROOT'].'uploads/pratiche/'. $NumeroPratica . '.pdf';
                    $phpmailer->AddAttachment($attachment , $NumeroPratica . '.pdf');
                    $phpmailer->isHTML(true);
                    
                    $message = file_get_contents('../template/mail/toComune.html');
                    $message = str_replace('%nome%', $_SESSION['Nome'], $message); 
                    $message = str_replace('%cognome%', $_SESSION['Cognome'], $message);
                    $message = str_replace('%codicefiscale%', $_SESSION['CF'], $message);
                    $message = str_replace('%numeropratica%', $NumeroPratica, $message);
                    $message = str_replace('%servizioselezionato%', 'richiesta di pubblicazione di matrimonio', $message);
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
                    $phpmailer2->Subject = 'Comune di '. $configData['nome_comune'] . ' - Richiesta di pubblicazione di matrimonio ';
                    $phpmailer2->isHTML(true);
                    
                    $message2 = file_get_contents('../template/mail/toUser.html');
                    $message2 = str_replace('%nome%', $_SESSION['Nome'], $message2); 
                    $message2 = str_replace('%cognome%', $_SESSION['Cognome'], $message2);
                    $message2 = str_replace('%codicefiscale%', $_SESSION['CF'], $message2);
                    $message2 = str_replace('%numeropratica%', $NumeroPratica, $message2);
                    $message2 = str_replace('%servizioselezionato%', 'domanda di contributo economico', $message2);
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