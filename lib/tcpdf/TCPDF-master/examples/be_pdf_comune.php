<?php

/* file di inclusione */
$configData = require '../env/config_servizi.php';
$configDB = require '../env/config.php';

function MetodoPagamentoById($Pagamento_id){
    $configDB = require '../env/config.php';
    $connessioneNMPBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlNMPBI = "SELECT tipo_pagamento.Nome as NomePagamento, metodi_pagamento.numero_pagamento as NumeroPagamento FROM `metodi_pagamento` LEFT JOIN tipo_pagamento ON metodi_pagamento.tipo_pagamento = tipo_pagamento.id WHERE metodi_pagamento.id = ". $Pagamento_id;
    $resultNMPBI = $connessioneNMPBI->query($sqlNMPBI);

    if ($resultNMPBI->num_rows > 0) {
    // output data of each row
        while($rowNMPBI = $resultNMPBI->fetch_assoc()) {
            return $rowNMPBI["NomePagamento"] . " <b>" . $rowNMPBI["NumeroPagamento"] . "</b>";
        }
    }
    $connessioneNMPBI->close();
}

/* con l'id vado a richiamare i dati salvati */
    if(isset($new_id) && $new_id<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM bonus_economici WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $new_id;
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $numeroPratica = $row["NumeroPratica"];
                $cf = $row["richiedenteCf"];
                $nome = $row["richiedenteNome"];
                $cognome = $row["richiedenteCognome"];
                $email = $row["richiedenteEmail"];
                $datanascita = date("d/m/Y", strtotime($row["richiedenteDataNascita"]));
                $luogonascita = $row["richiedenteLuogoNascita"];
                $richiedenteVia = $row["richiedenteVia"];
                $richiedenteLocalita = $row["richiedenteLocalita"];
                $richiedenteProvincia = $row["richiedenteProvincia"];
                $richiedenteTel = $row["richiedenteTel"];

                $beneficiarioNome = $row["beneficiarioNome"];
                $beneficiarioCognome = $row["beneficiarioCognome"];
                $beneficiarioCf = $row["beneficiarioCf"];
                $beneficiarioDataNascita = date("d/m/Y", strtotime($row["beneficiarioDataNascita"]));
                $beneficiarioLuogoNascita = $row["beneficiarioLuogoNascita"];
                $beneficiarioVia = $row["beneficiarioVia"];
                $beneficiarioLocalita = $row["beneficiarioLocalita"];
                $beneficiarioProvincia = $row["beneficiarioProvincia"];
                $beneficiarioEmail = $row["beneficiarioEmail"];
                $beneficiarioTel = $row["beneficiarioTel"];
                
                $inQualitaDi = $row["inQualitaDi"];
                
                $importoContributo = $row["importoContributo"];
                $finalitaContributo = $row["finalitaContributo"];
                
                $uploadPotereFirma = $row["uploadPotereFirma"];
                $uploadIsee = $row["uploadIsee"];
                $uploadDocumentazione = $row["uploadDocumentazione"];
                
                $data_compilazione = date("d/m/Y", strtotime($row["data_compilazione"]));

                $tipoPagamento_id = $row["tipoPagamento_id"];
            }
        }
    }

// create new PDF document
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'header_pdf.jpg';
        $this->Image($image_file, 10, 10, 185, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    }

    // Page footer
    public function Footer() {
        $configData = require '../env/config_servizi.php';
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica','I',8);
        $footer_text = "<table style='width: 100%;'><tr><td style='text-align: center;'>Cap.".$configData['cap_comune']." – ".$configData['indirizzo_comune']." – ".$configData['CFPIVA_comune']."<br>Tel ". $configData['tel_comune'] ." - PEC: ". $configData['pec_comune'] ."<br>". $configData['url_comune'] ." – e-mail: " . $configData['mail_comune'] ."</td></tr></table>";
        $this->writeHTML($footer_text, false, true, false, true); 
    }
}
    
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Proximalab');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO,PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE,PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica','N',10);
$spazio = "";
// add a page
$pdf->AddPage();


$nome_comune = $configData['nome_comune'];

$qualita = "in qualità di: ";

switch($inQualitaDi) {
    case "D": 
        $qualita .= "<b>diretto interessato</b>";
        $documentazioneRichiesta = "ISEE<br>documentazione utile al riconoscimento del contributo (esempi: contratto affitto, bollette, spese sanitarie, debiti…)<br>";
        break;
    case "T": 
        $qualita .= "<b>tutore</b> ";
        $qualita .= "di<br>
            cognome e nome <b>".$beneficiarioCognome." ".$beneficiarioNome."</b><br>
            nato/a a <b>".$beneficiarioLuogoNascita."</b> il <b>".$beneficiarioDataNascita."</b>   C.F. <b>".$beneficiarioCf."</b><br/>
            residente a <b>".$beneficiarioLocalita." - ".$beneficiarioProvincia."</b> in via <b>".$beneficiarioVia."</b><br/>
            tel./tell.<b>".$beneficiarioTel."</b> e- mail <b>".$beneficiarioEmail."</b><br/>";
        $documentazioneRichiesta = "documento che attesta potere di firma<br>ISEE<br>documentazione utile al riconoscimento del contributo (esempi: contrato affitto, bollette, spese sanitarie, debiti…)<br>";
        break;
    case "A": 
        $qualita .= "<b>amministratore di sostegno</b> ";
        $qualita .= "di<br>
            cognome e nome <b>".$beneficiarioCognome." ".$beneficiarioNome."</b><br>
            nato/a a <b>".$beneficiarioLuogoNascita."</b> il <b>".$beneficiarioDataNascita."</b>   C.F. <b>".$beneficiarioCf."</b><br/>
            residente a <b>".$beneficiarioLocalita." - ".$beneficiarioProvincia."</b> in via <b>".$beneficiarioVia."</b><br/>
            tel./tell.<b>".$beneficiarioTel."</b> e- mail <b>".$beneficiarioEmail."</b><br/>";
        $documentazioneRichiesta = "documento che attesta potere di firma<br>ISEE<br>documentazione utile al riconoscimento del contributo (esempi: contrato affitto, bollette, spese sanitarie, debiti…)<br>";
        break;
    case "P": 
        $qualita .= "<b>procuratore</b> ";
        $qualita .= "di<br>
            cognome e nome <b>".$beneficiarioCognome." ".$beneficiarioNome."</b><br>
            nato/a a <b>".$beneficiarioLuogoNascita."</b> il <b>".$beneficiarioDataNascita."</b>   C.F. <b>".$beneficiarioCf."</b><br/>
            residente a <b>".$beneficiarioLocalita." - ".$beneficiarioProvincia."</b> in via <b>".$beneficiarioVia."</b><br/>
            tel./tell.<b>".$beneficiarioTel."</b> e- mail <b>".$beneficiarioEmail."</b><br/>";
        $documentazioneRichiesta = "documento che attesta potere di firma<br>ISEE<br>documentazione utile al riconoscimento del contributo (esempi: contrato affitto, bollette, spese sanitarie, debiti…)<br>";
        break;
    case "E": 
        $qualita .= "<b>persona delegata</b> ";
        $qualita .= "di<br>
            cognome e nome <b>".$beneficiarioCognome." ".$beneficiarioNome."</b><br>
            nato/a a <b>".$beneficiarioLuogoNascita."</b> il <b>".$beneficiarioDataNascita."</b>   C.F. <b>".$beneficiarioCf."</b><br/>
            residente a <b>".$beneficiarioLocalita." - ".$beneficiarioProvincia."</b> in via <b>".$beneficiarioVia."</b><br/>
            tel./tell.<b>".$beneficiarioTel."</b> e- mail <b>".$beneficiarioEmail."</b><br/>";
        $documentazioneRichiesta = "documento che attesta potere di firma<br>ISEE<br>documentazione utile al riconoscimento del contributo (esempi: contrato affitto, bollette, spese sanitarie, debiti…)<br>";
        break;
}

$modalitaPagamento = "  " . MetodoPagamentoById($tipoPagamento_id);

// Set some content to print
$html = <<<EOD
<table>
    <tr>
        <td style="padding: 12px 10px; text-align:right;">
            <h5>Numero Pratica: $numeroPratica</h6>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h3>RICHIESTA DI BONUS ECONOMICO</h3>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>Il sottoscritto/a <b>$cognome $nome</b></p>
            <p>nato/a a <b>$luogonascita</b> il <b>$datanascita</b>  C.F. <b>$cf</b></p>
            <p>residente a <b>$richiedenteLocalita - $richiedenteProvincia</b> in <b>$richiedenteVia</b></p>
            <p>tel./tell. <b>$richiedenteTel</b> e- mail <b>$email</b></p>
            <p>$qualita</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>CHIEDE</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>un contributo di € <b>$importoContributo</b> finalizzato a <b>$finalitaContributo</b></p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>Ai sensi degli artt. 46, 47 e 48 del DPR 445/2000, consapevole delle responsabilità penali e delle sanzioni previste in caso di non veridicità del contenuto della presente dichiarazione, di dichiarazione mendace o di formazione di atti falsi di cui agli artt. 75 e 76 del DPR 445/2000, sotto la propria responsabilità.</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>DICHIARA:</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>
                <ul>
                    <li>di essere in possesso di ISEE in corso di validità e congruente allo stato di famiglia privo di omissioni e/o difformità;</li>
                    <li>l’insussistenza di rapporti di parentela, entro il quarto grado, o di altri vincoli anche di lavoro o professionali, in corso o riferibili ai due anni precedenti, con gli Amministratori e i Dirigenti del Comune di $nome_comune</li>
                    <li>di essere a conoscenza che a seguito della presente istanza sarà istruita la pratica e potrà essere richiesta eventuale integrazione di documenti e colloqui con assistente sociale</li>
                </ul>
            </p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>COMUNICA</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>a) che per il pagamento viene indicata la seguente modalità:</p>
            <p>$modalitaPagamento</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>ALLEGA</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>$documentazioneRichiesta</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>$nome_comune, $data_compilazione</p>
        </td>
    </tr>
</table>
EOD;
// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.

/*$pdf->writeHTML($html);*/
$pdf->writeHTMLCell(0,0,'','',$html,0,1,0,true,'',true);

$filePath = realpath('../uploads/pratiche/');

$pdf->Output($filePath . '/'.$numeroPratica.'.pdf', 'F'); 


//============================================================+
// END OF FILE
//============================================================+
