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

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Custom Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */
// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
require_once '../../../connessione_mysql.php';
session_start();
$utentino = $_SESSION['utente'];
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    if($id== "") {
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
		$this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages() . ' - CRM Segnalazioni', 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');

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
$pdf->SetFont('helvetica', 'B', 17);
$spazio = "";
// add a page
$pdf->AddPage();

while ($row = $result_ticket_totale->fetch_array(MYSQLI_BOTH)) {
    $data_apertura = $row[1];
    $messaggio = $row[9];
    $oggetto = $row[5];
    $stato = $row[3];
    $mittente = $row[6];
    $destinatario = $row[7];
    $tipo_richiesta = $row[4];
}
$getdatiutente = $conn->query("SELECT nome,cognome FROM utenti WHERE username='$mittente'");
$row_datiutente = $getdatiutente->fetch_array(MYSQLI_BOTH);
$nomeecognome = $row_datiutente[0].' '.$row_datiutente[1];
$PRINT_VAR = 'Riepilogo Informazioni Ticket N. ' . $id . ' - ' . $data_apertura;
$pdf->Cell(0,13,$PRINT_VAR,0,1);
$pdf->SetFont('helvetica', '', 8);
$pdf->Ln(1);
$pdf->Cell(40,6,'Stato del ticket',0,0);
$pdf->Cell(70,6,'Aperto da',0,0);
$pdf->Cell(0,6,'Tipo di richiesta',0,1);
$pdf->SetFont('helvetica', '', 13);
if($stato == 'IN ESSERE' ||$stato == 'RIAPERTO'){
    $pdf->SetFillColor(224, 78, 92);
    $pdf->Cell(27,6,$stato,0,0, 'L',true);
    $pdf->Cell(13,6,'',0,0, 'L');
}else if($stato == 'PRESO IN CARICO'){
    $pdf->SetFillColor(255,165,0);
    $pdf->SetFont('helvetica', '', 12);
    $pdf->Cell(40,6,'PRESO IN CARICO',0,0, 'L',true);
    $pdf->SetFont('helvetica', '', 13);
}else if($stato == 'IN SOLLECITO'){
    $pdf->SetFillColor(114,0,0);
    $pdf->Cell(34,6,$stato,0,0, 'L',true);
    $pdf->Cell(6,6,'',0,0, 'L');
}else if($stato == 'SECONDO SOLLECITO'){
    $pdf->SetFillColor(114,0,0);
    $pdf->Cell(34,6,'S. SOLLECITO',0,0, 'L',true);
    $pdf->Cell(6,6,'',0,0, 'L');
}else if($stato == 'SOSPESO'){
    $pdf->SetFillColor(184,126,255);
    $pdf->Cell(25,6,$stato,0,0, 'L',true);
    $pdf->Cell(15,6,'',0,0, 'L');
}else if($stato == 'RISOLTO'){
    $pdf->SetFillColor(40,167,69);
    $pdf->Cell(22,6,$stato,0,0, 'L',true);
    $pdf->Cell(18,6,'',0,0, 'L');
}else if($stato == 'IN GESTIONE'){
    $pdf->SetFillColor(255,159,113);
    $pdf->Cell(31,6,$stato,0,0, 'L',true);
    $pdf->Cell(9,6,'',0,0, 'L');
}else if($stato == 'ANNULLATO'){
    $pdf->SetFillColor(204, 201, 202);
    $pdf->Cell(30,6,$stato,0,0, 'L',true);
    $pdf->Cell(10,6,'',0,0, 'L');
}else if($stato == 'RIASSEGNATO'){
    $pdf->SetFillColor(255,193,7);
    $pdf->Cell(35,6,$stato,0,0, 'L',true);
    $pdf->Cell(5,6,'',0,0, 'L');
}else if($stato == 'INTEGRAZIONE RICHIESTA'){
    $pdf->SetFillColor(127,188,255);
    $pdf->SetFont('helvetica', '', 11);
    $pdf->Cell(39,6,'RICH. PREVENTIVO',0,0, 'L',true);
    $pdf->Cell(1,6,'',0,0, 'L');
    $pdf->SetFont('helvetica', '', 13);
}else if($stato == 'PREVENTIVO'){
    $pdf->SetFillColor(79,110,255);
    $pdf->Cell(32,6,'PREVENTIVO',0,0, 'L',true);
    $pdf->Cell(8,6,'',0,0, 'L');
}else{
    $pdf->SetFillColor(255,255,255);
    $pdf->Cell(40,6,$stato,0,0, 'L',true);
}
$pdf->Cell(70,6,$nomeecognome,0,0);
$pdf->Cell(0,6,$tipo_richiesta,0,1);
$pdf->Ln(5);
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0,4,'Oggetto del ticket',0,1);
$pdf->SetFont('helvetica', '', 13);
$pdf->Cell(0,5,$oggetto,0,1);
$pdf->Ln(6);
$pdf->SetFont('helvetica', '', 8);
$pdf->Cell(0,6,'Descrizione del ticket',0,1);
$pdf->SetFont('helvetica', '', 11);
$pdf->MultiCell(0,8,$messaggio,0,'L');
$pdf->Ln(6);
$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(0,6,'Azioni effettuate',0,3,'C',true);
$pdf->Ln(3);
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('helvetica', '', 8);
$pdf->SetFont('helvetica', '', 11);
$pdf->Cell(20,5,'N°',0,0);
$pdf->Cell(30,5,'Data',0,0);
$pdf->Cell(40,5,'Dettaglio stato',0,0);
$pdf->Cell(0,5,'Oggetto',0,1);
$result_ticket_azioni = $conn->query("SELECT * FROM azioni WHERE id_ticket = '$id' ORDER BY id ASC");
while($rowazioni = $result_ticket_azioni->fetch_array(MYSQLI_BOTH)){
    $pdf->SetFont('helvetica', '', 11);
    $textlength = strlen($rowazioni[6]);
    $rowheight = 8;
    if ($textlength > 48){ // alocate as you need
        if ($textlength > 144){
            $rowheight = $rowheight *2.8;
        } else if ($textlength > 96){
            $rowheight = $rowheight *2;
        } else {
            $rowheight = $rowheight *1.4;
        }
    }
    $pdf->Cell(20,$rowheight,$rowazioni[0],1,0);
    $pdf->Cell(30,$rowheight,$rowazioni[2],1,0);
    if($rowazioni[4] == 'INTEGRAZIONE RICHIESTA'){
        $pdf->Cell(40,$rowheight,'RICH. PREVENTIVO',1,0,'L');
//        $pdf->MultiCell(40,$maxnocells * 6,'RICH. PREVENTIVO','1','L',0,0);

    }else if($rowazioni[4] == 'SECONDO SOLLECITO'){
        $pdf->Cell(40,$rowheight,'S. SOLLECITO',1,0,'L');
    }else{
        $pdf->Cell(40,$rowheight,$rowazioni[4],1,0,'L');
    }
    $pdf->MultiCell(0,$rowheight,$rowazioni[6],1,1);
    if($rowazioni[9] != ""){
    $pdf->SetFont('helvetica', '', 9);
    $pdf->MultiCell(0,5,$rowazioni[9],1,'L');
    }
    $pdf->Ln(3);
}

// set some text to print
$html = <<<EOD
$titoloRiepilogo
$tabellaInfoTicket
$tabellaInfoTicketMessaggio
$titoloAzioni
$azioni
EOD;

// print a block of text using Write()
//$pdf->Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
// ---------------------------------------------------------

//Close and output PDF document
ob_end_clean();
$pdf->Output('Documento-riassuntivo-ticket.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+
