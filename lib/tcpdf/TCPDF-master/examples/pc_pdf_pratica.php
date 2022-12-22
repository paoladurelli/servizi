<?php

/* file di inclusione */
include '../../../../fun/utility.php';
$configData = require '../../../../env/config_servizi.php';
$configDB = require '../../../../env/config.php';

session_start();

$numeroPratica = $_POST['pc_download_pdf_pratica'];

/* con l'id vado a richiamare i dati salvati */
    if(isset($_POST["pc_download_pdf_id"]) && $_POST["pc_download_pdf_id"]<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM partecipazione_concorso WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $_POST["pc_download_pdf_id"];
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $cf = $row["richiedenteCf"];
                $nome = $row["richiedenteNome"];
                $cognome = $row["richiedenteCognome"];
                $email = $row["richiedenteEmail"];
                $datanascita = $row["richiedenteDataNascita"];
                $luogonascita = $row["richiedenteLuogoNascita"];
                $richiedenteVia = $row["richiedenteVia"];
                $richiedenteLocalita = $row["richiedenteLocalita"];
                $richiedenteProvincia = $row["richiedenteProvincia"];
                $richiedenteTel = $row["richiedenteTel"];
                
                $Concorso = ConcorsoById($row["ConcorsoId"]);

            }
        }
        $connessione->close();
    }

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
            // Logo
            $image_file = K_PATH_IMAGES.'header_pdf.jpg';
            $this->Image($image_file, 10, 10, 185, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            // Set font
    }

    // Page footer
    public function Footer() {
            // Position at 15 mm from bottom
            $this->SetY(-15);
            // Set font
            $this->SetFont('helvetica','I',8);
            // Page number
            $this->Cell(0,10,'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages() . ' - ServiziOnLine / Domanda per assegno di maternità',0,false,'C',0,'',0,false,'T','M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION,PDF_UNIT,PDF_PAGE_FORMAT,true,'UTF-8',false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Proximalab');

$pdf->setHeaderMargin(20);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO,PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE,PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN,'',PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA,'',PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
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

// Set some content to print
$html = <<<EOD
<style>
.styled-table {
  padding: 12px 15px;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 10px;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    background-color: white;
    color: black;
    text-align: left;

}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}

</style>
<br><h1> Iscrizione ad un concorso - <em>Ricevuta</em> </h1>
<br>
<br>
<h3>Numero Pratica: $numeroPratica</h3>
<br>
<br>
<h4>CONCORSO</h4>
<br>
<table style="padding: 12px 10px;">
    <tr>
        <td style="padding: 12px 10px; width: 60%; font-weight: normal;">$Concorso</td>
    </tr>
</table>
<br>
<h4>DATI RICHIEDENTE</h4>
<br> 
<table style="padding: 12px 10px;">
    <tr>
        <th style="padding: 12px 10px; width: 40%; font-weight: 600;">Nome e Cognome</th>
        <td style="padding: 12px 10px; width: 60%; font-weight: normal;">$nome $cognome</td>
    </tr>
    <tr>
        <th style="padding: 12px 10px; width: 40%; font-weight: 600;">Codice Fiscale</th>
        <td style="padding: 12px 10px; width: 60%; font-weight: normal;">$cf</td>
    </tr>

    <tr>
        <th style="padding: 12px 10px; width: 40%; font-weight: 600;">Data di Nascita</th>
        <td style="padding: 12px 10px; width: 60%; font-weight: normal;">$datanascita</td>
    </tr>
    <tr>
        <th style="padding: 12px 10px; width: 40%; font-weight: 600;">Luogo di Nascita</th>
        <td style="padding: 12px 10px; width: 60%; font-weight: normal;">$luogonascita</td>
    </tr>
    <tr>    
        <th style="padding: 12px 10px; width: 40%; font-weight: 600;">Residente a</th>
        <td style="padding: 12px 10px; width: 60%; font-weight: normal;">$richiedenteLocalita - $richiedenteProvincia</td>
    </tr>
    <tr>
        <th style="padding: 12px 10px; width: 40%; font-weight: 600;">In Via</th>
        <td style="padding: 12px 10px; width: 60%; font-weight: normal;">$richiedenteVia</td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; width: 40%; font-weight: 600;">Telefono</td>
        <td style="padding: 12px 10px; width: 60%; font-weight: normal;">$richiedenteTel</td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; width: 40%; font-weight: 600;">Email</td>
        <td style="padding: 12px 10px; width: 60%; font-weight: normal;">$email</td>
    </tr>
</table>
EOD;

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0,0,'','',$html,0,1,0,true,'',true);


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('Ricevuta_pratica_'.$numeroPratica.'.pdf','D');

//============================================================+
// END OF FILE
//============================================================+
