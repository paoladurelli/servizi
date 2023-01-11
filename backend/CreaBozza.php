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

$data['success'] = true;

SetLog($_POST["ServizioId"] . "-" . $_POST["PraticaId"]);

if(!empty($_POST["ServizioId"]) && !empty($_POST["PraticaId"])) {
    $servizio_id = $_POST["ServizioId"];
    $pratica_id = $_POST["PraticaId"];
    $NumeroPratica = NumeroPraticaById($servizio_id,$pratica_id);

    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
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

    $connessione->query("CREATE TEMPORARY TABLE tmptable_1 SELECT * FROM ".$table." WHERE id = '".$pratica_id."'");
    $connessione->query("UPDATE tmptable_1 SET id = NULL");
    $connessione->query("UPDATE tmptable_1 SET status_id = 1");
    $connessione->query("UPDATE tmptable_1 SET data_compilazione = NULL");
    $connessione->query("UPDATE tmptable_1 SET NumeroPratica = NULL");
    $connessione->query("UPDATE tmptable_1 SET NumeroProtocollo = NULL");
    $connessione->query("UPDATE tmptable_1 SET ultimo_aggiornamento = NULL");
    $connessione->query("INSERT INTO ".$table." SELECT * FROM tmptable_1 LIMIT 1");
    $connessione->query("DROP TEMPORARY TABLE IF EXISTS tmptable_1");
    
    $sqlINS = "SELECT * FROM ".$table." WHERE status_id = 1 ORDER BY id DESC LIMIT 1";
    $resultINS = $connessione->query($sqlINS);
    if ($resultINS->num_rows > 0) {
    // output data of each row
        while($row = $resultINS->fetch_assoc()) {
            $connessione->query("INSERT INTO attivita (cf,servizio_id, pratica_id, status_id) VALUES ('".$row['richiedenteCf']."','".$servizio_id."','".$row['id']."','1')");
        }
    }
    
    $result = $connessione->query("SELECT * FROM ".$table." WHERE id = '".$pratica_id."'");
        
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $cf_destinatario = $row['richiedenteCf'];
            $mail_destinatario = $row['richiedenteEmail'];
            $cognome_destinatario = $row['richiedenteCognome'];
            $nome_destinatario = $row['richiedenteNome'];
            
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
            $phpmailer->Subject = 'Comune di '. $configData['nome_comune'] . ' - '.$servizioName.' | Creazione nuova bozza';
            $phpmailer->isHTML(true);

            $message = file_get_contents('template/mail/NuovaBozzaToUser.html');
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
                $data['desc'] = SendToAppIoCreateNewDraft($table,$pratica_id,$cf_destinatario);
            }
            /* invio messaggio all'App IO - end */

        $data['success'] = true;
        }
    }
    $connessione->close();
}
echo json_encode($data);

