<?php
include '../fun/utility.php';
$configDB = require '../env/config.php';
session_start();

$data = [];

   $data['success'] = false;

    /* genero numero pratica */
    $connessioneNP = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlNP = "SELECT NumeroPratica FROM domanda_contributo WHERE status_id > 1 ORDER BY id DESC LIMIT 1";
    $resultNP = $connessioneNP->query($sqlNP);
    
    if ($resultNP->num_rows > 0) {
    // output data of each row
        while($rowNP = $resultNP->fetch_assoc()) {
            /* tutto ok */
            /* prendo l'id che mi servirà per costruire i nomi dei documenti */
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
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT * FROM `domanda_contributo` WHERE id = " . $_POST['pratican'];
    $result = $connessione->query($sql);
    
    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {

            /* rinomino i file */
            $uploadPotereFirma = $row["uploadPotereFirma"];
            $NewuploadPotereFirma = str_replace("_bozza_","_".$NumeroPratica."_",$uploadPotereFirma);

            // Upload Location
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
            
            $data['pratica'] = $NumeroPratica . "-" . $_POST['pratican'];

            /* vado ad inserire nella bozza il numero pratica - questo mi serve per lo storico. */
            $connessioneUPD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlUPD = "UPDATE domanda_contributo SET NumeroPratica = '".$NumeroPratica."' WHERE id = ".$_POST['pratican'];
            $connessioneUPD->query($sqlUPD);

            /* salvo nelle attitivà la creazione o modifica della bozza per domanda_contributo */
                $sqlINS = "INSERT INTO attivita (cf,servizio_id,pratica_id,status_id) VALUES ('".$row['richiedenteCf']."',11,".$_POST['pratican'].",2)";
                $connessioneINS->query($sqlINS);


            /* salvo nei messaggi che ho una bozza da completare per domanda_contributo */
                $sqlINS = "INSERT INTO messaggi (CF_to,servizio_id,testo) VALUES ('".$row['richiedenteCf']."',11,'La tua domanda di contributo è stata inviata.<br/>Il numero della pratica è: <b>".$NumeroPratica."</b>')";
                $connessioneINS->query($sqlINS);            
            
                
            /* creo pdf della richiesta */
                
                
            /* mando mail al comune */
                
                
            /* mando mail all'utente */
        }   
    }
    
    $data['success'] = true;
    $data['message'] = $NumeroPratica;

    echo json_encode($data);
