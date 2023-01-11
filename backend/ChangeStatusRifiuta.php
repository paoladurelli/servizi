<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';

$configDB = require '../env/config.php';
$configData = require '../env/config_servizi.php';
$configSmtp = require '../env/config_smtp.php';

include 'fun/utility.php';

$data['success'] = false;

if(!empty($_POST["ServizioId"]) && !empty($_POST["PraticaId"])) {
    $servizio_id = $_POST["ServizioId"];
    $pratica_id = $_POST["PraticaId"];
    
    switch($servizio_id) {
        case 5: 
            $table = "pubblicazione_matrimonio"; 
            $servizioName = "Richiesta di pubblicazione di matrimonio"; 
            break;
        case 6: 
            $table = "accesso_atti"; 
            $servizioName = "Accesso agli atti"; 
            break;
        case 9: 
            $table = "assegno_maternita"; 
            $servizioName = "Richiesta assegno di maternita'";
            break;
        case 10: 
            $table = "bonus_economici"; 
            $servizioName = "Richiesta di bonus economici"; 
            break;
        case 11: 
            $table = "domanda_contributo"; 
            $servizioName = "Domanda di contributo economico"; 
            break;
        case 16: 
            $table = "partecipazione_concorso"; 
            $servizioName = "Iscrizione al concorso";
            break;
    }

    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sqlINS = "SELECT * FROM ".$table." WHERE id = '".$pratica_id."'";
        $resultINS = $connessione->query($sqlINS);
        if ($resultINS->num_rows > 0) {
            while($rowINS = $resultINS->fetch_assoc()) {
                $NumeroPratica = $rowINS['NumeroPratica'];
                $cf_destinatario = $rowINS['richiedenteCf'];
                $mail_destinatario = $rowINS['richiedenteEmail'];
                $cognome_destinatario = $rowINS['richiedenteCognome'];
                $nome_destinatario = $rowINS['richiedenteNome'];
            }
        }
        $sql = "UPDATE " . $table . " SET status_id = '5' WHERE id = '". $pratica_id."'";
        $result = $connessione->query($sql);
        if($result){
            $sqlA = "UPDATE attivita SET status_id = '5' WHERE servizio_id = '".$servizio_id."' AND pratica_id = '". $pratica_id."'";
            $resultA = $connessione->query($sqlA);
            if($resultA){
                /* invio mail all'utente - start */
                $fromMail = $configSmtp['smtp_username'];
                $fromName = $configData['nome_comune'] . " - Servizi Online";

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
                $phpmailer->addAddress($mail_destinatario,$mail_destinatario);
                $phpmailer->Subject = 'Comune di '. $configData['nome_comune'] . ' - '.$servizioName.' | Nr Pratica: '. $NumeroPratica;
                $phpmailer->isHTML(true);

                $message = file_get_contents('template/mail/RifiutataToUser.html');
                $message = str_replace('%nome%', $cognome_destinatario, $message); 
                $message = str_replace('%cognome%', $nome_destinatario, $message);
                $message = str_replace('%codicefiscale%', $cf_destinatario, $message);
                $message = str_replace('%numeropratica%', $NumeroPratica, $message);
                $message = str_replace('%servizioselezionato%', $servizioName, $message);
                $message = str_replace('%urlservizi%', $configData['url_servizi'], $message);
                $message = str_replace('%nomecomune%', $configData['nome_comune'], $message);
                $message = str_replace('%telcomune%', $configData['tel_comune'], $message);
                $message = str_replace('%mailcomune%', $configData['mail_comune'], $message);
                $message = str_replace('%anno%', date('Y'), $message);

                $phpmailer->Body = $message;
                $phpmailer->send();
                /* mando mail all'utente - end */

                /* invio messaggio all'App IO - start */
                if($configDB['AppIoAttiva']){
                    $data['desc'] = SendToAppIoChangeStatus($table,$pratica_id,$cf_destinatario,'rifiutata');
                }
                /* invio messaggio all'App IO - end */
                
                $data['success'] = true;
            }
        }
    $connessione->close();
}
echo json_encode($data);

