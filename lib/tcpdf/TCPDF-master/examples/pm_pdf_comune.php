<?php

/* file di inclusione */
$configData = require '../env/config_servizi.php';
$configDB = require '../env/config.php';

/* con l'id vado a richiamare i dati salvati */
    if(isset($new_id) && $new_id<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM pubblicazione_matrimonio WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $new_id;
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

                $richiedenteStatoNascita = $row["richiedenteStatoNascita"];
                $richiedenteVia = $row["richiedenteVia"];
                $richiedenteLocalita = $row["richiedenteLocalita"];
                $richiedenteProvincia = $row["richiedenteProvincia"];
                $richiedenteTel = $row["richiedenteTel"];
                $richiedenteStatoCivile = $row["richiedenteStatoCivile"];
                $richiedenteAttoNascita = $row["richiedenteAttoNascita"];
                $richiedenteAttoNascitaData = $row["richiedenteAttoNascitaData"];
                $coniugeNome = $row["coniugeNome"];
                $coniugeCognome = $row["coniugeCognome"];
                $coniugeCf = $row["coniugeCf"];
                $coniugeDataNascita = date("d/m/Y", strtotime($row["coniugeDataNascita"]));
                $coniugeLuogoNascita = $row["coniugeLuogoNascita"];
                $coniugeStatoNascita = $row["coniugeStatoNascita"];
                $coniugeVia = $row["coniugeVia"];
                $coniugeLocalita = $row["coniugeLocalita"];
                $coniugeProvincia = $row["coniugeProvincia"];
                $coniugeEmail = $row["coniugeEmail"];
                $coniugeTel = $row["coniugeTel"];
                $coniugeStatoCivile = $row["coniugeStatoCivile"];
                $coniugeAttoNascita = $row["coniugeAttoNascita"];
                $coniugeAttoNascitaData = $row["coniugeAttoNascitaData"];

                
                $data_compilazione = date("d/m/Y", strtotime($row["data_compilazione"]));

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
            <h3>RICHIESTA DI PUBBLICAZIONE DI MATRIMONIO</h3>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>Il sottoscritto/a <b>$cognome $nome</b></p>
            <p>nato/a a <b>$luogonascita</b> (<b>$richiedenteStatoNascita</b>) il <b>$datanascita</b>  C.F. <b>$cf</b></p>
            <p>Atto di nascita n. <b>$richiedenteAttoNascita</b> del <b>$richiedenteAttoNascitaData</b></p>
            <p>Stato civile: <b>$richiedenteStatoCivile</b></p>
            <p>residente a <b>$richiedenteLocalita - $richiedenteProvincia</b> in <b>$richiedenteVia</b></p>
            <p>tel./tell. <b>$richiedenteTel</b> e- mail <b>$email</b></p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>CHIEDE</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>la pubblicazione di matrimonio con <b>$coniugeCognome $coniugeNome</b></p>
            <p>nato/a a <b>$coniugeLuogoNascita</b> (<b>$coniugeStatoNascita</b>) il <b>$coniugeDataNascita</b>  C.F. <b>$coniugeCf</b></p>
            <p>Atto di nascita n. <b>$coniugeAttoNascita</b> del <b>$coniugeAttoNascitaData</b></p>
            <p>Stato civile: <b>$coniugeStatoCivile</b></p>
            <p>residente a <b>$coniugeLocalita - $coniugeProvincia</b> in <b>$coniugeVia</b></p>
            <p>tel./tell. <b>$coniugeTel</b> e- mail <b>$coniugeEmail</b></p>
        
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>Ai sensi degli artt. 46, 47 e 48 del DPR 445/2000, consapevole delle responsabilità penali e delle sanzioni previste in caso di non veridicità del contenuto della presente dichiarazione, di dichiarazione mendace o di formazione di atti falsi di cui agli artt. 75 e 76 del DPR 445/2000, sotto la propria responsabilità.</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>DICHIARANO:</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>- di essere di stato libero<br>
            - non osta al loro matrimonio alcun impedimento di parentela, di affinità, di adozione e di affiliazione ai sensi dell'art. 87 del codice civile,<br>
            - gli sposi non hanno contratto fra loro precedente matrimonio, né alcuno di essi si trova nelle condizioni indicate negli art. 85 e 88 del codice civile, né risulta sussistere altro impedimento stabilito dalla legge.</p>
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
