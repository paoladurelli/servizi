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
    $sqlCheck = "SELECT id FROM domanda_contributo WHERE richiedenteCf = '". $_SESSION['CF']."' and id = " . $_POST['pratican'] ." and status_id = 0 and numeroPratica = ''";
    $data['error'] = $sqlCheck;
    $resultCheck = $connessioneCheck->query($sqlCheck);
    
    if ($resultCheck->num_rows > 0) {
        
        /* genero numero pratica */
        $connessioneNP = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sqlNP = "SELECT NumeroPratica FROM domanda_contributo WHERE status_id > 1 ORDER BY id DESC LIMIT 1";
        $resultNP = $connessioneNP->query($sqlNP);

        if ($resultNP->num_rows > 0) {
            while($rowNP = $resultNP->fetch_assoc()) {
                /* prendo il nuovo numeroPratica */
                $LastPratica = $rowNP['NumeroPratica'];
                $numberPraticaTmp = substr($LastPratica, -8);
                $numberPraticaTmp2 = filter_var($numberPraticaTmp, FILTER_SANITIZE_NUMBER_INT) + 1;
                $length = 8;
                $NumeroPratica = "DC".str_pad($numberPraticaTmp2,$length,"0", STR_PAD_LEFT);
            }
        }else{
            $NumeroPratica = "DC00000001";
        }

        /* DATI ESTRAPOLATI DA DB - start */
        /* estrapolo i dati salvati con status tmp */
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM `domanda_contributo` WHERE id = " . $_POST['pratican'];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                /* rinomino i file */
                $uploadPotereFirma = $row["uploadPotereFirma"];
                $NewuploadPotereFirma = str_replace("_bozza_","_".$NumeroPratica."_",$uploadPotereFirma);

                $upload_location = "../uploads/domanda_contributo/";

                if (file_exists($upload_location.$uploadPotereFirma)){
                    $renamed= rename($upload_location.$uploadPotereFirma,$upload_location.$NewuploadPotereFirma);
                }else{
                    $data['error'] = "The original file that you want to rename doesn't exist";
                }

                $NewuploadDocumentazione = "";

                $tmpUploadDocumentazione1 = substr($row["uploadDocumentazione"],0,-1);
                $tmpUploadDocumentaziones = explode(';', $tmpUploadDocumentazione1);
                $uploadDocumentazione = "";
                foreach($tmpUploadDocumentaziones as $tmpUploadDocumentazione) {
                    $uploadDocumentazione = $tmpUploadDocumentazione;
                    $NewuploadDocumentazioneTmp = str_replace("_bozza_","_".$NumeroPratica."_",$uploadDocumentazione);

                    if (file_exists($upload_location.$uploadDocumentazione)){
                        $renamed= rename($upload_location.$uploadDocumentazione,$upload_location.$NewuploadDocumentazioneTmp);
                    }else{
                        $data['error'] = "The original file that you want to rename doesn't exist";
                    }
                    $NewuploadDocumentazione .= $NewuploadDocumentazioneTmp.";";
                }

                $data['pratica'] = $NewuploadDocumentazione;

                /* salvo tutti i dati in una riga nuova con status 2 */
                $connessioneINS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlINS = "INSERT INTO `domanda_contributo`(status_id,richiedenteNome,richiedenteCognome,richiedenteCf,richiedenteDataNascita,richiedenteLuogoNascita,richiedenteVia,richiedenteLocalita,richiedenteProvincia,richiedenteEmail,richiedenteTel,inQualitaDi,beneficiarioNome,beneficiarioCognome,beneficiarioCf,beneficiarioDataNascita,beneficiarioLuogoNascita,beneficiarioVia,beneficiarioLocalita,beneficiarioProvincia,beneficiarioEmail,beneficiarioTel,importoContributo,finalitaContributo,tipoPagamento_id,uploadPotereFirma,uploadDocumentazione,NumeroPratica) VALUES (2,'".$row['richiedenteNome']."','".$row['richiedenteCognome']."','".$row['richiedenteCf']."','".$row['richiedenteDataNascita']."','".$row['richiedenteLuogoNascita']."','".$row['richiedenteVia']."','".$row['richiedenteLocalita']."','".$row['richiedenteProvincia']."','".$row['richiedenteEmail']."','".$row['richiedenteTel']."','".$row['inQualitaDi']."','".$row['beneficiarioNome']."','".$row['beneficiarioCognome']."','".$row['beneficiarioCf']."','".$row['beneficiarioDataNascita']."','".$row['beneficiarioLuogoNascita']."','".$row['beneficiarioVia']."','".$row['beneficiarioLocalita']."','".$row['beneficiarioProvincia']."','".$row['beneficiarioEmail']."','".$row['beneficiarioTel']."','".$row['importoContributo']."','".$row['finalitaContributo']."','".$row['tipoPagamento_id']."','".$NewuploadPotereFirma."','".$NewuploadDocumentazione."','".$NumeroPratica."')";
                $connessioneINS->query($sqlINS);

                /* ricavo il nuovo id */
                $sqlINS = "SELECT id FROM domanda_contributo WHERE richiedenteCf = '". $_SESSION['CF'] ."' and status_id = 2 ORDER BY id DESC LIMIT 1";
                $resultINS = $connessioneINS->query($sqlINS);
                if ($resultINS->num_rows > 0) {
                // output data of each row
                    while($row = $resultINS->fetch_assoc()) {
                        /* prendo il nuovo id */
                        $new_id = $row['id'];
                    }
                }

                $data['pratica'] = $NumeroPratica . "-" . $new_id;

                /* vado ad inserire nella bozza il numero pratica - questo mi serve per lo storico. */
                $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
                $sqlUPD = "UPDATE domanda_contributo SET NumeroPratica = '".$NumeroPratica."' WHERE id = ".$_POST['pratican'];
                $connessioneUPD->query($sqlUPD);

                /* salvo nelle attitivà la creazione o modifica della bozza per domanda_contributo */
                    $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id) VALUES ('". $_SESSION['CF'] ."',11,".$new_id.",2)";
                    $connessioneINS->query($sqlINS);


                /* salvo nei messaggi che ho una bozza da completare per domanda_contributo */
                    $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo) VALUES ('". $_SESSION['CF'] ."',11,'La tua domanda di contributo è stata inviata.<br/>Il numero della pratica è: <b>".$NumeroPratica."</b>')";
                    $connessioneINS->query($sqlINS);            


                /* mando mail al comune - start */
                    $phpmailer = new PHPMailer();
                    $phpmailer->isSMTP();
                    $phpmailer->Host = $configSmtp['smtp_host'];
                    $phpmailer->SMTPAuth = $configSmtp['smtp_auth'];
                    $phpmailer->Port = $configSmtp['smtp_port'];
                    $phpmailer->SMTPSecure = $configSmtp['smtp_secure'];
                    $phpmailer->Username = $configSmtp['smtp_username'];
                    $phpmailer->Password = $configSmtp['smtp_password'];
                    $phpmailer->setFrom($configData['mail_comune'], 'Comune di ' . $configData['nome_comune']);
                    $phpmailer->addAddress('paola.durelli@proximalab.it', 'Proxima');
                    $phpmailer->addAddress($configData['mail_comune'], 'Comune di ' . $configData['nome_comune']);
                    $phpmailer->Subject = 'Comune di '. $configData['nome_comune'] . ' - Domanda di contributo  - '.$NumeroPratica.' - '. $_SESSION['CF'];
                    $phpmailer->isHTML(true);
                    $mailContent = '
                        <p>L\'utente ' . $_SESSION['Nome'] . ' ' . $_SESSION['Cognome'] . '(C.F. '.$_SESSION['CF'].') ha inviato una domanda contributo.<br/>'
                            . 'Il numero della pratica &egrave;: <b>'.$NumeroPratica.'</b><br/>
                            <a href="'.$configData['url_servizi'].'/backend">Accedi al Backend per vedere i dati</a></p>
                        ';
                    $phpmailer->Body = $mailContent;


                    if($phpmailer->send()){
                        $data['error'] .= 'Message has been sent';
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
                    $phpmailer2->Subject = 'Comune di '. $configData['nome_comune'] . ' - Domanda di contributo ';
                    $phpmailer2->isHTML(true);
                    $mailContent2 = '
                        <p>Ciao ' . $_SESSION['Nome'] . ' ' . $_SESSION['Cognome'] . ',<br/>
                            la tua domanda contributo &egrave; stata inviata correttamente.<br/>
                            Il numero della pratica &egrave;: <b>'.$NumeroPratica.'</b><br/>
                            Presto riceverai una nostra risposta.<br/>
                            Grazie<br/>
                            <em>Comune di '. $configData['nome_comune'] . '</em></p>

                        <p>Per qualsiasi dubbio contattaci:<br/>
                        Tel: '. $configData['tel_comune'] .'<br/>
                        Email: ' . $configData['pec_comune'] . '</p>';
                    $phpmailer2->Body = $mailContent2;


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
        $data['pratica'] = $NumeroPratica;
        $data['id'] = $new_id;
    }


    echo json_encode($data);
