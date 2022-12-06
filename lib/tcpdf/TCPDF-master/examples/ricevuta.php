<?php
//============================================================+
// File name   : example_003.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 003 for TCPDF class
//               Custom Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+
session_name('MensaTrasporto');

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

require '../../../PHPMailer/src/Exception.php';
require '../../../PHPMailer/src/PHPMailer.php';
require '../../../PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


date_default_timezone_set('Europe/Rome');

require_once '../../../connessione_mysql.php';
session_start();
$utentino = $_SESSION['utente'];

$allegati_array = array();
//echo $utentino;
if(isset($_GET['id']) && isset($_GET['token'])) {
    $id = $_GET['id'];
    $token = $_GET['token'];

    $getdatitoken = $conn->query("SELECT token_stampa FROM ticket WHERE id='$id' AND token_stampa = '$token'");
    $row_generico_token = $getdatitoken->num_rows;


    if($id == "" || $token == "" || $row_generico_token < 1) {
        echo "<script>window.location.href = '../../../index.php';</script>";
    }
//    echo "<script>alert($id);</script>";
} else {
    echo "<script>window.location.href = '../../../index.php';</script>";
}
$result_ticket_totale = $conn->query("SELECT * FROM ticket WHERE id = '$id'");


$result_ticket_destinatario = $conn->query("SELECT * FROM ticket WHERE (mittente = '$utentino' OR destinatario = '$utentino') AND id = $id");
while ($row = $result_ticket_destinatario->fetch_array(MYSQLI_BOTH)) {
    $destinatario = $row[7];
}

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
		$this->SetFont('helvetica', 'I', 8);
		// Page number
	        $this->Cell(0, 10, 'Pagina ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . ' - Domanda Borsa di Studio - Data e Ora Stampa ' . date('d-m-Y H:i'), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}


}
//$fullPathToFile = '../../allegati/87/1_1649683187_prova.pdf';


// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

//$pdf2 = new FPDI();


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Proximalab');

$pdf->setHeaderMargin(20);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

while ($row = $result_ticket_totale->fetch_array(MYSQLI_BOTH)) {
    $data_apertura = $row[1];
    $messaggio = $row[9];
    $oggetto = $row[5];
    $stato = $row[3];
    $mittente = $row[6];
    $destinatario = $row[7];
    $data_evento = $row[20];
//    $numero_telefono = $row[24];
    $tipo_richiesta = $row[4];

     $dati_rich_qr = $conn->query("SELECT * FROM dati_richiesta WHERE riferimento_ticket = '$id'");
    $dati_rich = $dati_rich_qr->fetch_array(MYSQLI_BOTH);
     $residenza = $dati_rich['residente_a'];
     $via_resid = $dati_rich['in_via'];
     $telefono = $dati_rich['telefono'];
//     $pec = $dati_rich['pec'];
     $pec = "";

//    $mobile_phone = $dati_rich['mobile_phone'];

    $scuola_classe_freq = $dati_rich['scuola_classe_freq'];

    $km_tot = $dati_rich['km_tot'];
    $orario_partenza = $dati_rich['orario_partenza'];
    $orario_rientro = $dati_rich['orario_rientro'];
    $durata_viaggi = $dati_rich['durata_viaggi'];

    $mezzi_utilizzati = $dati_rich['mezzi_utilizzati'];
    $spese_complessive = $dati_rich['spese_complessive'];
    $eventuali_note = $dati_rich['eventuali_note'];

    $intestatario_conto = $dati_rich['intestatario_conto'];
    $iban_conto = $dati_rich['iban_conto'];

    $isminorenne = $dati_rich['studente_minorenne'];


     $equip_head = "";
    $eqip_content = "";

    if(1 == 1){
        $titolo_leggibile = "Titolo di studio richiesto dal bando";
    }

}

    $label_data = "Data e Ora";



$getdatiutente = $conn->query("SELECT nome,cognome, ragionesociale, data_nascita, luogo_nascita, email FROM utenti WHERE username='$mittente'");
$row_datiutente = $getdatiutente->fetch_array(MYSQLI_BOTH);
$nomeecognome = $row_datiutente[0].' '.$row_datiutente[1];
$cf = $row_datiutente[2];
$data_nascita = $row_datiutente[3];
$luogo_nascita = $row_datiutente[4];
$email = $row_datiutente['email'];

$PRINT_VAR = 'Riepilogo Informazioni Domanda N. ' . $id . ' - ' . $data_apertura;

$result_ticket_azioni = $conn->query("SELECT * FROM azioni WHERE id_ticket = '$id' ORDER BY id ASC");

if ($stato == 'IN ESSERE' || $stato == 'RIAPERTO') {

    $colore = '224, 78, 92';

} else if ($stato == 'PRESO IN CARICO') {

    $colore = '255, 165, 0';

} else if ($stato == 'IN SOLLECITO') {

    $colore = '114, 0, 0';
  }

else if ($stato == 'SECONDO SOLLECITO') {

    $colore = '114, 0, 0';

} else if ($stato == 'SOSPESO') {

    $colore = '184, 126, 255';


} else if ($stato == 'RISOLTO' || $stato == 'CONFERMATA') {

    $colore = '40, 167, 69';

} else if ($stato == 'IN GESTIONE') {

    $colore = '255, 159, 113';


} else if ($stato == 'ANNULLATO') {

    $colore = '204, 201, 202';


} else if ($stato == 'RIASSEGNATO') {

    $colore = '255, 193, 7';

} else if ($stato == 'PAGAMENTO') {

    $colore = '127, 188, 255';


}else if ($stato == 'INTEGRAZIONE RICHIESTA') {

    $colore = '127, 188, 255';

} else if ($stato == 'PREVENTIVO') {

    $colore = '79, 110, 255';


} else {

    $colore = '255, 255, 255';

}

if($isminorenne == 1){
    $riga_minorenne = "Domanda Effettuata da " . $nomeecognome . " ( $cf ) per studente Minorenne.";
    $studente_text = "Studente";

    $getdatiminore = $conn->query("SELECT name_surname, cf_minore, data_nascita, luogo_nascita  FROM studente_minorenne WHERE riferimento_ticket='$id'");
    $row_datiminore = $getdatiminore->fetch_array(MYSQLI_BOTH);
    $nomeecognome = $row_datiminore['name_surname'];
    $cf = $row_datiminore['cf_minore'];
    $data_nascita = $row_datiminore['data_nascita'];
    $luogo_nascita = $row_datiminore['luogo_nascita'];


} else {
    $riga_minorenne = "";
    $studente_text = "";
}



// set some text to print
$html = <<<EOF
<style>
.styled-table {
  padding: 12px 15px;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
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
 <br><h1> $PRINT_VAR </h1>
 <br>
 <br>
 <br>
<h4> $riga_minorenne</h4>
<br>
 
<table style="padding: 12px 15px;">
<tr>
 <th style="padding: 12px 15px;font-weight: bold;">Nome e Cognome $studente_text</th>
  <th style="padding: 12px 15px;font-weight: bold;">Codice Fiscale $studente_text</th>
  <th style="padding: 12px 15px;font-weight: bold;">Data di Nascita $studente_text</th>
</tr>

<tr>
 <td style="text-transform:capitalize; padding: 12px 15px;"> $nomeecognome</td>
  <td style="text-transform:capitalize; padding: 12px 15px; background-color: rgb($colore); !important">$cf</td>
  <td style="text-transform:capitalize; padding: 12px 15px;">$data_nascita </td>
</tr>
<br>

<tr>
 <th style="padding: 12px 15px;font-weight: bold;">Luogo di Nascita $studente_text</th>
  <th style="padding: 12px 15px;font-weight: bold;">Residente a</th>
  <th style="padding: 12px 15px;font-weight: bold;">In Via</th>
</tr>

<tr>
  <td style="text-transform:capitalize; padding: 12px 15px;">$luogo_nascita </td>
 <td style="text-transform:capitalize; padding: 12px 15px;"> $residenza</td>
  <td style="text-transform:capitalize; padding: 12px 15px; ">$via_resid</td>
</tr>
<br>


<tr>
    <td style="padding: 12px 15px;font-weight: bold;">Telefono</td>
  <td style="padding: 12px 15px;font-weight: bold;">Email</td>
  <td style="padding: 12px 15px;font-weight: bold;">Tot. Km</td>
</tr>

<tr>
  <td style="text-transform:capitalize; padding: 12px 15px;"> $telefono </td>
  <td style="text-transform:capitalize; padding: 12px 15px;">$email</td>
  <td style="text-transform:capitalize; padding: 12px 15px;">$km_tot</td>
</tr>


<tr>
    <td style="padding: 12px 15px;font-weight: bold;">Orario Partenza</td>
  <td style="padding: 12px 15px;font-weight: bold;">Orario Rientro</td>
      <td style="padding: 12px 15px;font-weight: bold;">Durata Viaggi</td>
</tr>
<tr>
  <td style="text-transform:capitalize; padding: 12px 15px;"> $orario_partenza </td>
  <td style="text-transform:capitalize; padding: 12px 15px;"> $orario_rientro</td>
    <td style="text-transform:capitalize; padding: 12px 15px;"> $durata_viaggi </td>
</tr>

<tr>
    <td style="padding: 12px 15px;font-weight: bold;">Mezzi di Trasporto</td>
  <td style="padding: 12px 15px;font-weight: bold;">Spese Tot. Trasporto</td>
  <td style="padding: 12px 15px;font-weight: bold;"> </td>
</tr>
<tr>
  <td style="text-transform:capitalize; padding: 12px 15px;"> $mezzi_utilizzati </td>
  <td style="text-transform:capitalize; padding: 12px 15px;"> $spese_complessive</td>
   <td style="text-transform:capitalize; padding: 12px 15px;">  </td>
</tr>

<br>
</table>
<br>
<h4>DATI PER IL PAGAMENTO</h4>
<br>
<table style="padding: 12px 15px;">
<tr>
    <td style="padding: 12px 15px;font-weight: bold;">Intestatario Conto </td>
    <td style="padding: 12px 15px;font-weight: bold;">Codice IBAN</td>
</tr>
<tr>
  <td style="text-transform:capitalize; padding: 12px 15px;"> $intestatario_conto </td>
  <td style="text-transform:capitalize; padding: 12px 15px;"> $iban_conto </td>
</tr>
</table>
<br>



<h4>EVENTUALI NOTE</h4>
<br><br>
$eventuali_note
<br>
<table class="styled-table">


</table>
<br>




EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


$pagine_totali_pdf = $pdf->getNumPages();

$pdfdoc1 = $pdf->Output('Ricevuta_domanda.pdf', 'I');



//============================================================+
// END OF FILE
//============================================================+
