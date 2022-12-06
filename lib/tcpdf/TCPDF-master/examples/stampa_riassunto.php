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
if (isset($_POST['ragionesociale'])) {
    $ragionesociale = $_POST['ragionesociale'];
    if ($ragionesociale == "") {
        //echo "<script>window.location.href = '../../../index.php';</script>";
    }
} else {
    //echo "<script>window.location.href = '../../../index.php';</script>";
}
if (isset($_POST['data_start'])) {
    $datastart = $_POST['data_start'];
    if ($datastart == "") {
        //echo "<script>window.location.href = '../../../index.php';</script>";
    }
} else {
    //echo "<script>window.location.href = '../../../index.php';</script>";
}
if (isset($_POST['data_stop'])) {
    $datastop = $_POST['data_stop'];
    if ($datastop == "") {
        //echo "<script>window.location.href = '../../../index.php';</script>";
    }
} else {
    //echo "<script>window.location.href = '../../../index.php';</script>";
}

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        // Logo
        $image_file = K_PATH_IMAGES . 'header_pdf.jpg';
        $this->Image($image_file, 10, 10, 185, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Pagina ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . ' - CRM Manutenzioni', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ProximaLAB');

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
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------
$resultTicketTotali = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totaliRagioneSociale = $resultTicketTotali->num_rows;
//echo "<script>alert('$totaliRagioneSociale');</script>";

$resultTicketRagSocRisolti = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='RISOLTO' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totRisolti = $resultTicketRagSocRisolti->num_rows;
//echo "<script>alert('$totRisolti');</script>";

$resultTicketRagSocInEssere = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='IN ESSERE' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totInEssere = $resultTicketRagSocInEssere->num_rows;
//echo "<script>alert($totInEssere);</script>";

$resultTicketRagSocPresoInCarico = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='PRESO IN CARICO' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totPresoInCarico = $resultTicketRagSocPresoInCarico->num_rows;
//echo "<script>alert($totPresoInCarico);</script>";

$resultTicketRagSocRiassegnato = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='RIASSEGNATO' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totRiassegnato = $resultTicketRagSocRiassegnato->num_rows;
//echo "<script>alert($totRiassegnato);</script>";

$resultTicketRagSocSospeso = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='SOSPESO' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totSospeso = $resultTicketRagSocSospeso->num_rows;

$resultTicketRagSocAnnullato = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='ANNULLATO' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totAnnullato = $resultTicketRagSocAnnullato->num_rows;

$resultTicketRagSocInElaborazione = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='IN ELABORAZIONE' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totInElaborazione = $resultTicketRagSocInElaborazione->num_rows;
//--------
$resultTicketRagSocInSollecito = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='IN SOLLECITO' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totInSollecito = $resultTicketRagSocInSollecito->num_rows;

$resultTicketRagSocSecondoSollecito = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='SECONDO SOLLECITO' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totSecondoSollecito = $resultTicketRagSocSecondoSollecito->num_rows;

$resultTicketRagSocRiaperto = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='RIAPERTO' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totRiaperto = $resultTicketRagSocRiaperto->num_rows;

$resultTicketRagSocInGestione = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='IN GESTIONE' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totInGestione = $resultTicketRagSocInGestione->num_rows;

$resultTicketRagSocIntRichiesta = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='INTEGRAZIONE RICHIESTA' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totIntRichiesta = $resultTicketRagSocIntRichiesta->num_rows;

$resultTicketRagSocPreventivo = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND stato ='PREVENTIVO' AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
$totPreventivo = $resultTicketRagSocPreventivo->num_rows;

if ($totaliRagioneSociale == 0) {
    $perc_in_essere = 0;
    $perc_risolti = 0;
    $perc_in_carico = 0;
    $perc_riassegnato = 0;
    $perc_sospeso = 0;
    $totAnnullato = 0;
    $totInElaborazione = 0;
    $totInSollecito = 0;
    $totSecondoSollecito = 0;
    $totRiaperto = 0;
    $totInGestione = 0;
    $totIntRichiesta = 0;
    $totPreventivo = 0;
    $contatore_totalestati = 0;
} else {
    $contatore_totalestati = 0;
    if ($totInEssere == 0) {
        $perc_in_essere = 0;
    } else {
        $perc_in_essere = ($totInEssere / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }
    if ($totRisolti == 0) {
        $perc_risolti = 0;
    } else {
        $perc_risolti = ($totRisolti / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }

    if ($totPresoInCarico == 0) {
        $perc_in_carico = 0;
    } else {
        $perc_in_carico = ($totPresoInCarico / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }

    if ($totRiassegnato == 0) {
        $perc_riassegnato = 0;
    } else {
        $perc_riassegnato = ($totRiassegnato / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }
    if ($totSospeso == 0) {
        $perc_sospeso = 0;
    } else {
//        echo"<script>alert('sospeso' .$totSospeso)</script>";
        $perc_sospeso = ($totSospeso / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }
    if ($totAnnullato == 0) {
        $perc_annullato = 0;
    } else {
        $perc_annullato = ($totAnnullato / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }
    if ($totInElaborazione == 0) {
        $perc_in_elaborazione = 0;
    } else {
        $perc_in_elaborazione = ($totInElaborazione / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }
//    ------------------------------------------
    if ($totInSollecito == 0) {
        $perc_sollecito = 0;
    } else {
        $perc_sollecito = ($totInSollecito / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }
    if ($totSecondoSollecito == 0) {
        $perc_secondo_sollecito = 0;
    } else {
        $perc_secondo_sollecito = ($totSecondoSollecito / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }
    if ($totRiaperto == 0) {
        $perc_riaperto = 0;
    } else {
        $perc_riaperto = ($totRiaperto / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }
    if ($totInGestione == 0) {
        $perc_in_gestione = 0;
    } else {
        $perc_in_gestione = ($totInGestione / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }
    if ($totIntRichiesta == 0) {
        $perc_int_richiesta = 0;
    } else {
        $perc_int_richiesta = ($totIntRichiesta / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }
    if ($totPreventivo == 0) {
        $perc_preventivo = 0;
    } else {
//        echo"<script>alert($totPreventivo)</script>";
        $perc_preventivo = ($totPreventivo / $totaliRagioneSociale) * 100;
        $contatore_totalestati++;
    }
}
// set font
$pdf->SetFont('helvetica', 'B', 17);
$spazio = "";
// add a page
$pdf->AddPage();
$result_ticket_totale = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
if ($result_ticket_totale->num_rows > 0) {

    while ($row = $result_ticket_totale->fetch_array(MYSQLI_BOTH)) {
        $data_apertura = $row[1];
        $messaggio = $row[9];
        $oggetto = $row[5];
        $stato = $row[3];
        $destinatario = $row[7];
        $tipo_richiesta = $row[4];
    }
    $xc = 60;
    $yc = 90;
    $r = 30;
    $variabilegrafica = 0;
    $variabilegrafica_arrivo = 0;
    $divisore = 100;
    if ($perc_risolti > 0) {
        $variabilegrafica_arrivo = ($perc_risolti * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(40, 167, 69);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_in_essere > 0) {
        $variabilegrafica_arrivo = ($perc_in_essere * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(220, 53, 69);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_in_carico > 0) {
        $variabilegrafica_arrivo = ($perc_in_carico * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(255, 165, 0);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_riassegnato > 0) {
        $variabilegrafica_arrivo = ($perc_riassegnato * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(255, 193, 7);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_sospeso > 0) {
        $variabilegrafica_arrivo = ($perc_sospeso * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(184, 126, 255);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_annullato > 0) {
        $variabilegrafica_arrivo = ($perc_annullato * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(52, 58, 64);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_in_elaborazione > 0) {
        $variabilegrafica_arrivo = ($perc_in_elaborazione * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(255, 186, 90);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_sollecito > 0) {
        $variabilegrafica_arrivo = ($perc_sollecito * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(85, 161, 255);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_secondo_sollecito > 0) {
        $variabilegrafica_arrivo = ($perc_secondo_sollecito * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(85, 161, 255);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_riaperto > 0) {
        $variabilegrafica_arrivo = ($perc_riaperto * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(220, 53, 69);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_in_gestione > 0) {
        $variabilegrafica_arrivo = ($perc_in_gestione * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(255, 159, 113);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_int_richiesta > 0) {
        $variabilegrafica_arrivo = ($perc_int_richiesta * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(93, 172, 255);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }
    if ($perc_preventivo > 0) {
        $variabilegrafica_arrivo = ($perc_preventivo * 360 / $divisore) + $variabilegrafica;
        $pdf->SetFillColor(18, 66, 255);
        $pdf->PieSector($xc, $yc, $r, $variabilegrafica, $variabilegrafica_arrivo, 'FD', false, 0, 2);
        $variabilegrafica = $variabilegrafica_arrivo;
    }

    $pdf->SetFont('helvetica', 'B', 13);
    $PRINT_VAR = 'Riepilogo Ticket di ' . $ragionesociale . ' dal ' . $datastart . ' al ' . $datastop;
    $pdf->Cell(0, 13, $PRINT_VAR, 0, 1);
    $pdf->SetFont('helvetica', '', 8);
    $pdf->Ln(6);
    if ($perc_risolti > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(40, 167, 69);
        $pdf->Cell(0, 5, 'TICKET RISOLTI: ' . round($perc_risolti, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_in_essere > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(220, 53, 69);
        $pdf->Cell(0, 5, 'TICKET IN ESSERE: ' . round($perc_in_essere, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_in_carico > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(255, 165, 0);
        $pdf->Cell(0, 5, 'TICKET PRESI IN CARICO: ' . round($perc_in_carico, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_riassegnato > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(255, 193, 7);
        $pdf->Cell(0, 5, 'TICKET RIASSEGNATI: ' . round($perc_riassegnato, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_sospeso > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(184, 126, 255);
        $pdf->Cell(0, 5, 'TICKET SOSPESI: ' . round($perc_sospeso, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_annullato > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(52, 58, 64);
        $pdf->Cell(0, 5, 'TICKET ANNULLATI: ' . round($perc_annullato, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_in_elaborazione > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(255, 186, 90);
        $pdf->Cell(0, 5, 'TICKET IN ELABORAZIONE: ' . round($perc_in_elaborazione, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_sollecito > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(85, 161, 255);
        $pdf->Cell(0, 5, 'TICKET IN SOLLECITO: ' . round($perc_sollecito, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_secondo_sollecito > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(85, 161, 255);
        $pdf->Cell(0, 5, 'TICKET CON SECONDO SOLLECITO: ' . round($perc_secondo_sollecito, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_riaperto > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(220, 53, 69);
        $pdf->Cell(0, 5, 'TICKET RIAPERTI: ' . round($perc_riaperto, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_in_gestione > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(255, 159, 113);
        $pdf->Cell(0, 5, 'TICKET IN GESTIONE: ' . round($perc_in_gestione, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_int_richiesta > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(93, 172, 255);
        $pdf->Cell(0, 5, 'TICKET CON UNA RICHIESTA DI INTEGRAZIONE IN CORSO: ' . round($perc_int_richiesta, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    if ($perc_preventivo > 0) {
        $pdf->Cell(80, 5, '', 0, 0);
        $pdf->SetTextColor(18, 66, 255);
        $pdf->Cell(0, 5, 'TICKET IN STATO DI RICEZIONE PREVENTIVO: ' . round($perc_preventivo, 1) . ' %', 0, 1, 'R');
        $pdf->SetTextColor(0, 0, 0);
    }
    $pdf->SetY(130);
    // SE on VISUALIZZA TEMPI DI PRESA IN CARICO ABILITATI ///// SE vuoto VISUALIZZA TEMPI DI PRESA IN CARICO DISABILITATI //
    $presa_carico_print_abilitato = $_POST['presa_carico'];
    $result_ticket_totale_due = $conn->query("SELECT * FROM ticket WHERE destinatario IN (SELECT username FROM utenti WHERE ragionesociale = '$ragionesociale') AND (str_to_date(data_apertura,\"%d/%m/%Y\") BETWEEN str_to_date('$datastart',\"%d/%m/%Y\") AND str_to_date('$datastop',\"%d/%m/%Y\"))");
    while ($rowazioni = $result_ticket_totale_due->fetch_array(MYSQLI_BOTH)) {
        $pdf->SetFont('helvetica', '', 8);
        $pdf->Cell(20, 5, 'ID', 0, 0);
        $pdf->Cell(25, 5, 'Data', 0, 0);
        $pdf->Cell(65, 5, 'Entità Problema', 0, 0);
        $result_primo_presa_in_carico= $conn->query("SELECT * FROM azioni WHERE id_ticket = '$rowazioni[0]' AND stato_azione = 'PRESO IN CARICO' ORDER BY id ASC");
        if($presa_carico_print_abilitato == 'on' && $result_primo_presa_in_carico->num_rows > 0){
            $pdf->Cell(40, 5, 'Stato', 0, 0);
            $pdf->Cell(0, 5, 'Tempo Presa in Carico', 0, 1);
        }else{
        if ($rowazioni[3] == 'RISOLTO') {
            $pdf->Cell(40, 5, 'Stato', 0, 0);
            $pdf->Cell(0, 5, 'Tempo di Risoluzione', 0, 1);
        } else {
            $pdf->Cell(0, 5, 'Stato', 0, 1);
        }}
        $pdf->SetFont('helvetica', '', 11);
        $pdf->Cell(20, 6, $rowazioni[0], 1, 0);
        $pdf->Cell(25, 6, $rowazioni[1], 1, 0);
        $pdf->Cell(65, 6, $rowazioni[4], 1, 0, 'L');
        if ($rowazioni[3] == 'RISOLTO') {
            $date1 = str_replace('/', '-', $rowazioni[1]);
            $data1 = $date1 . ' ' . $rowazioni[2];
            $data1 = strtotime($data1);
            $date2 = str_replace('/', '-', $rowazioni[14]);
            $data2 = $date2 . ' ' . $rowazioni[15];
            $data2 = strtotime($data2);
            $diff_ore = ($data2 - $data1) / 3600;
            $diff = $data2 - $data1;
            if ($diff_ore > 24) {
                if ($diff_ore / 24 > 1) {
//                numero di giorni
                    $gg = floor($diff_ore / 24);
//                calcolo rimuovo i gg dal conto
                    $change = $diff - (86400 * $gg);
                    $orario1 = $change;
                } else {
                    $gg = 1;
                }
                if ($orario1 < 3600) {
                    $a = $orario1 / 60;
                    $orario = $gg . 'G ' . $a . "M";
                } else {
                    $a = floor($orario1 / 3600);
                    $b = ($orario1 % 3600) / 60;
                    $orario = $gg . "G " . $a . 'H ' . $b . 'M';
                }
//                $orario = $diff_ore/24;
////                resto ore eccendenti
//                $resto = $diff_ore % 24;
//                $orario = floor($orario);
//                $orario .= " Giorno " .$resto . " Ore" ;
            } else if ($diff_ore < 1 && $diff_ore > 0) {
                $orario = $diff / 60 . "M";
            } else if ($diff == 0) {
                $orario = "1M";
            } else if ($diff_ore == 24) {
                $orario = "1G";
            } else {
                $ciao = floor(($data2 - $data1) / 3600);
                $ciao2 = ($data2 - $data1) % 3600;
                $ciao2 = $ciao2 / 60;
                if ($ciao2 == 0) {
                    $orario = round($ciao, 0) . "H";
                } else {
                    $orario = round($ciao, 0) . "H " . "$ciao2" . "M";
                }

            }
        }

        if($presa_carico_print_abilitato == 'on'){

            if($result_primo_presa_in_carico->num_rows > 0){
            $rowPSQ = $result_primo_presa_in_carico->fetch_array(MYSQLI_BOTH);
            $date1PS = str_replace('/', '-', $rowazioni[1]);
            $data1PS = $date1PS . ' ' . $rowazioni[2];
            $data1PS = strtotime($data1PS);
            $date2PS = str_replace('/', '-', $rowPSQ[2]);
            $data2PS = $date2PS . ' ' . $rowPSQ[3];
            $data2PS = strtotime($data2PS);
            $diff_orePS = ($data2PS - $data1PS) / 3600;
            $diffPS = $data2PS - $data1PS;
            if ($diff_orePS > 24) {
                if ($diff_orePS / 24 > 1) {
//                numero di giorni
                    $ggPS = floor($diff_orePS / 24);
//                calcolo rimuovo i gg dal conto
                    $changePS = $diffPS - (86400 * $ggPS);
                    $orario1PS = $changePS;
                } else {
                    $ggPS = 1;
                }
                if ($orario1PS < 3600) {
                    $aPS = $orario1PS / 60;
                    $orarioPS = $ggPS . 'G ' . $aPS . "M";
                } else {
                    $aPS = floor($orario1PS / 3600);
                    $bPS = ($orario1PS % 3600) / 60;
                    $orarioPS = $ggPS . "G " . $aPS . 'H ' . $bPS . 'M';
                }
//                $orario = $diff_ore/24;
////                resto ore eccendenti
//                $resto = $diff_ore % 24;
//                $orario = floor($orario);
//                $orario .= " Giorno " .$resto . " Ore" ;
            } else if ($diff_orePS < 1 && $diff_orePS > 0) {
                $orarioPS = $diffPS / 60 . "M";
            } else if ($diffPS == 0) {
                $orarioPS = "1M";
            } else if ($diff_orePS == 24) {
                $orarioPS = "1G";
            } else {
                $ciaoPS = floor(($data2PS - $data1PS) / 3600);
                $ciao2PS = ($data2PS - $data1PS) % 3600;
                $ciao2PS = $ciao2PS / 60;
                if ($ciao2 == 0) {
                    $orarioPS = round($ciaoPS, 0) . "H";
                } else {
                    $orarioPS = round($ciaoPS, 0) . "H " . "$ciao2PS" . "M";
                }

            }
            if ($rowazioni[3] == 'INTEGRAZIONE RICHIESTA') {
                $pdf->Cell(40, 6, 'RICH. PREVENTIVO', 1, 0);
            } else if ($rowazioni[3] == 'SECONDO SOLLECITO') {
                $pdf->Cell(40, 6, 'S. SOLLECITO', 1, 0);
            } else {
                $pdf->Cell(40, 6, $rowazioni[3], 1, 0);
            }

            $pdf->Cell(0, 6, $orarioPS, 1, 1);
            }else{
                if ($rowazioni[3] == 'INTEGRAZIONE RICHIESTA') {
                    $pdf->Cell(0, 6, 'RICH. PREVENTIVO', 1, 1);
                } else if ($rowazioni[3] == 'SECONDO SOLLECITO') {
                    $pdf->Cell(0, 6, 'S. SOLLECITO', 1, 1);
                } else {
                    $pdf->Cell(0, 6, $rowazioni[3], 1, 1);
                }
            }
        }else{
        if ($rowazioni[3] == 'RISOLTO') {
            if ($rowazioni[3] == 'INTEGRAZIONE RICHIESTA') {
                $pdf->Cell(40, 6, 'RICH. PREVENTIVO', 1, 0);
            } else if ($rowazioni[3] == 'SECONDO SOLLECITO') {
                $pdf->Cell(40, 6, 'S. SOLLECITO', 1, 0);
            } else {
                $pdf->Cell(40, 6, $rowazioni[3], 1, 0);
            }

            $pdf->Cell(0, 6, $orario, 1, 1);
        } else {
            if ($rowazioni[3] == 'INTEGRAZIONE RICHIESTA') {
                $pdf->Cell(0, 6, 'RICH. PREVENTIVO', 1, 1);
            } else if ($rowazioni[3] == 'SECONDO SOLLECITO') {
                $pdf->Cell(0, 6, 'S. SOLLECITO', 1, 1);
            } else {
                $pdf->Cell(0, 6, $rowazioni[3], 1, 1);
            }
        }
        }

        if ($rowazioni[9] != "") {
            $pdf->Ln(1);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->Cell(0, 4, 'Descrizione intervento', 0, 1);
            $pdf->SetFont('helvetica', '', 11);
            $pdf->MultiCell(0, 5, $rowazioni[9], 1, 'L');
        }
        $pdf->Ln(7);
    }
} else {
    $PRINT_VAR = 'Riepilogo Ticket di ' . $ragionesociale . ' dal ' . $datastart . ' al ' . $datastop;
    $pdf->Cell(0, 13, $PRINT_VAR, 0, 1);
    $pdf->SetFont('helvetica', '', 15);
    $pdf->Ln(6);
//    $pdf->Cell(20, 13, '', 0, 0);
    $pdf->SetTextColor(255, 0, 0);
    $pdf->Cell(0, 5, 'Nessun risultato trovato per la fascia di date fornita.', 0, 1);
    $pdf->SetTextColor(0, 0, 0);
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
$filename = "Documento-riassuntivo-ticket-" . $ragionesociale . ".pdf";
$pdf->Output($filename, 'D');

//============================================================+
// END OF FILE
//============================================================+
