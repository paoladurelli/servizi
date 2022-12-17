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

/* mando mail */
$phpmailer = new PHPMailer();
$phpmailer->isSMTP();
$phpmailer->Host = $configSmtp['smtp_host'];
$phpmailer->SMTPAuth = $configSmtp['smtp_auth'];
$phpmailer->Port = $configSmtp['smtp_port'];
$phpmailer->SMTPSecure = $configSmtp['smtp_secure'];
$phpmailer->Username = $configSmtp['smtp_username'];
$phpmailer->Password = $configSmtp['smtp_password'];
$phpmailer->setFrom('test@nuovoportale.proximalab.it','ProximaLab');
$phpmailer->addAddress('paola.durelli@proximalab.it', 'Proxima');
$phpmailer->Subject = 'Comune di '. $configData['nome_comune'] . ' - Domanda di contributo  - DCTEST001 - '. $_SESSION['CF'];
$phpmailer->isHTML(true);

$message = file_get_contents('../template/mail/toComune.html');
$message = str_replace('%nome%', $_SESSION['Nome'], $message); 
$message = str_replace('%cognome%', $_SESSION['Cognome'], $message);
$message = str_replace('%codicefiscale%', $_SESSION['CF'], $message);
$message = str_replace('%numeropratica%', 'DCTEST0001', $message);
$message = str_replace('%servizioselezionato%', 'domanda di contributo economico', $message);
$message = str_replace('%urlservizi%', $configData['url_servizi'], $message);
$message = str_replace('%nomecomune%', $configData['nome_comune'], $message);
$message = str_replace('%anno%', date('Y'), $message);

$phpmailer->Body = $message;

echo $message;

if($phpmailer->send()){
    echo "message send";
}else{
    echo "Mailer Error: " . $phpmailer->ErrorInfo;
} 
