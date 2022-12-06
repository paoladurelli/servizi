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

date_default_timezone_set('Europe/Rome');

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
	        $this->Cell(0, 10, 'Pagina ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . ' - Crm Prenotazioni  - Data e Ora Stampa ' . date('d-m-Y H:i'), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

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
     $isee = $dati_rich['reddito_isee'];

    $fascia = "";
    if($isee <= 6000){
        $fascia = "Fascia 1";
    } else if($isee >= 6001 && $isee <= 9000){
        $fascia = "Fascia 2";
    } else if($isee >= 9001 && $isee <= 12000){
        $fascia = "Fascia 3";
    } else if($isee >= 12001){
        $fascia = "Fascia 4";
    }

}

    $label_data = "Data e Ora";
//    $info_evento = $conn->query("SELECT * FROM eventi_calendario WHERE riferimento_ticket = '$id'");
//$info_evento_array = $info_evento->fetch_array(MYSQLI_BOTH);
//
//$dataoraapp = $info_evento_array['start'];
//$dataoraapptimes = strtotime($dataoraapp);
//$data_app_legg = date("d-m-Y H:i", $dataoraapptimes);


$getdatiutente = $conn->query("SELECT nome,cognome FROM utenti WHERE username='$mittente'");
$row_datiutente = $getdatiutente->fetch_array(MYSQLI_BOTH);
$nomeecognome = $row_datiutente[0].' '.$row_datiutente[1];
$PRINT_VAR = 'Riepilogo Informazioni Domanda N. ' . $id . ' - ' . $data_apertura;

$result_ticket_azioni = $conn->query("SELECT * FROM azioni WHERE id_ticket = '$id' ORDER BY id ASC");
//while($rowfiglio = $result_ticket_azioni->fetch_array(MYSQLI_BOTH)){
//    $textlength = strlen($rowfiglio[6]);
//    $rowheight = 8;
//    if ($textlength > 48){ // alocate as you need
//        if ($textlength > 144){
//            $rowheight = $rowheight *2.8;
//        } else if ($textlength > 96){
//            $rowheight = $rowheight *2;
//        } else {
//            $rowheight = $rowheight *1.4;
//        }
//    }
//
//
//}
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


$riga_mensa ='';

$result_figli_mensa = $conn->query("SELECT * FROM figli_mensa WHERE riferimento_ticket = '$id' ORDER BY id ASC");

$number_figli_mensa = $result_figli_mensa -> num_rows;

if($number_figli_mensa >0){
    $riga_mensa = "<h4 style=\"text-align: center; margin-bottom: 25px;\">FIGLI MENSA</h4>
<br>";
} else {
    $riga_mensa = "";
}


while ($rowfiglio = $result_figli_mensa->fetch_array(MYSQLI_BOTH)) {

    $riga_mensa .= '<br><table class="styled-table">
  <tr style=" background-color: #305631;  font-weight: bold;  color: #ffffff;">
    <th style="    border-bottom: 1px solid #f3f3f3;  padding: 12px 15px;">Cognome e Nome</th>
    <th style="    border-bottom: 1px solid #f3f3f3;  padding: 12px 15px;">CF</th>
    <th style="    border-bottom: 1px solid #f3f3f3;  padding: 12px 15px;">Tipo Scuola</th>
  </tr>
';

  $textlength = strlen($rowfiglio[6]);

  $rowheight = 8;
    $id_figlio = $rowfiglio[0];
    $res_figlio = $rowfiglio[4];
    $via_figlio = $rowfiglio[5];
    $anno_scuola_f = $rowfiglio[6];
    $classe_f = $rowfiglio[7];
    $sezione_figlio = $rowfiglio[8];
    $datan_figlio = $rowfiglio[11];
    $tipo_pagamento = $rowfiglio[12];
    if ($tipo_pagamento == 1){
        $tipo_pagamento = "Tramite Credito Prepagato presso la cartoleria Azzurro Pastello";
    } else if($tipo_pagamento == 2){
        $tipo_pagamento = "Tramite addebito in C/C: nel caso di prima domanda (compilare apposito modulo online)";
    } else if($tipo_pagamento == 3){
        $tipo_pagamento = "Tramite addebito in C/C: si conferma iban anno precedente";
    }


  if ($textlength > 48) { // alocate as you need

      if ($textlength > 144) {

          $rowheight = $rowheight * 2.8;

      } else if ($textlength > 96) {

          $rowheight = $rowheight * 2;

      } else {

          $rowheight = $rowheight * 1.4;

      }
  }

  if($rowfiglio[9] == 1){
      $dieta = "SI";
  } else {
      $dieta = "NO";
  }

    if($rowfiglio[10] == 1){
        $tipo_scuola = "Infanzia";
    } else {
        $tipo_scuola = "Primaria";
    }


    $riga_mensa .= '<tr style=" border-bottom: 1px solid #dddddd;">' . '<td style="padding: 12px 15px;   border-bottom: 1px solid #f3f3f3;">'. $rowfiglio[2] .'</td>' .'<td style="  padding: 12px 15px;   border-bottom: 1px solid #f3f3f3;">'. $rowfiglio[3] .'</td>'  . '<td style="  padding: 12px 15px;  border-bottom: 1px solid #f3f3f3;">'. $tipo_scuola .'</td>' . '</tr>';


        $row_info_figlio = '<br><br><table style="padding: 6px 15px;">
<tr>
 <th style="padding: 12px 15px;font-weight: bold;">Nato il</th>
  <th style="padding: 12px 15px;font-weight: bold;">Residente a</th>
  <th style="padding: 12px 15px;font-weight: bold;">In Via</th>
</tr>

<tr>
 <td style="text-transform:capitalize; padding: 12px 15px;"> '.$datan_figlio .'</td>
  <td style="text-transform:capitalize; padding: 12px 15px;">'.$res_figlio .'</td>
  <td style="text-transform:capitalize; padding: 12px 15px;">'.$via_figlio .' </td>
</tr>
<br>

<tr>
  <td style="padding: 12px 15px;font-weight: bold;">Classe</td>
  <td style="padding: 12px 15px;font-weight: bold;">Sezione</td>
   <td style="padding: 12px 15px;font-weight: bold;">Dieta</td>
</tr>

<tr>
  <td style="text-transform:capitalize; padding: 12px 15px;"> '.$anno_scuola_f .' </td>
  <td style="text-transform:capitalize; padding: 12px 15px;"> '.$sezione_figlio .'</td>
   <td style="text-transform:capitalize; padding: 12px 15px;">'.$dieta .'</td>
 
</tr>

<tr>
  <td style="padding: 12px 15px;font-weight: bold; width: 500px;">Tipo di Pagamento</td>
</tr>
<tr>
  <td style="text-transform:capitalize; padding: 12px 15px; width: 100%;"> '.$tipo_pagamento .' </td>
</tr>

';
    if($rowfiglio[9] == 1){
    $getdatidietafiglio = $conn->query("SELECT * FROM dieta_mensa WHERE riferimento_figlio='$id_figlio'");
    $mensa_figliorow = $getdatidietafiglio->fetch_array(MYSQLI_BOTH);
    $check1 = $mensa_figliorow[2];
    $check2 = $mensa_figliorow[3];
    $check3 = $mensa_figliorow[4];
    $check4 = $mensa_figliorow[5];
    $note = $mensa_figliorow[6];
        if($check1 == 1){
            $check1 = "<h4 >V</h4>";
        } else {
            $check1 = "<h4 >X</h4>";
        }
        if($check2 == 1){
            $check2 = "<h4 >V</h4>";
        } else {
            $check2 = "<h4 >X</h4>";
        }
        if($check3 == 1){
            $check3 = "<h4 >V</h4>";
        } else {
            $check3 = "<h4 >X</h4>";
        }
        if($check4 == 1){
            $check4 = "<h4 >V</h4>";
        } else {
            $check4 = "<h4 >X</h4>";
        }


    $dieta_row_figlio = '<h4 style="text-align: center;">DIETA</h4><table style="padding: 6px 15px;">
<tr>
<th style="padding: 12px 15px;font-weight: bold; text-align: center; font-size: 0.95em;">No Carne di Maiale</th>
<th style="padding: 12px 15px;font-weight: bold; text-align: center; font-size: 0.95em;">No Carne</th>
<th style="padding: 12px 15px;font-weight: bold; text-align: center; font-size: 0.95em;">No Carne e Pesce</th>
<th style="padding: 12px 15px;font-weight: bold; text-align: center; font-size: 0.95em;">Dieta speciale per motivi di salute</th>
</tr>
<tr>
<td style="text-transform:capitalize; padding: 12px 15px; text-align: center;">'.$check1 .'</td>
<td style="text-transform:capitalize; padding: 12px 15px; text-align: center;">'.$check2 .'</td>
<td style="text-transform:capitalize; padding: 12px 15px; text-align: center;">'.$check3 .' </td>
<td style="text-transform:capitalize; padding: 12px 15px; text-align: center;">'.$check4 .' </td>
</tr><br>';
        if($note){
            $dieta_row_figlio .= "<h4>Note</h4>" . $note;
        }

    } else {
        $dieta_row_figlio = "";
    }
    $riga_mensa .="</table>" . $row_info_figlio . $dieta_row_figlio;
}


$result_figli_trasp = $conn->query("SELECT * FROM figli_trasporto WHERE riferimento_ticket = '$id' ORDER BY id ASC");

$riga_trasporto = "";

$number_figli_trasp = $result_figli_trasp -> num_rows;

if($number_figli_trasp > 0){
    $riga_trasporto = "<h4 style=\"text-align: center; margin-bottom: 25px;\">FIGLI TRASPORTO</h4>";
} else {
    $riga_trasporto = "";
}

while ($rowfiglio = $result_figli_trasp->fetch_array(MYSQLI_BOTH)) {

    $riga_trasporto .= '<table class="styled-table">
  <tr style=" background-color: #305631;  font-weight: bold;  color: #ffffff;">
    <th style="    border-bottom: 1px solid #f3f3f3;  padding: 12px 15px;">Cognome e Nome</th>
    <th style="    border-bottom: 1px solid #f3f3f3;  padding: 12px 15px;">CF</th>
    <th style="    border-bottom: 1px solid #f3f3f3;  padding: 12px 15px;">Tipo Scuola</th>
  </tr>
';

    $textlength = strlen($rowfiglio[6]);

    $rowheight = 8;
    $id_figlio = $rowfiglio[0];
    $res_figlio = $rowfiglio[4];
    $via_figlio = $rowfiglio[5];
    $anno_scuola_f = $rowfiglio[6];
    $classe_f = $rowfiglio[7];
    $sezione_figlio = $rowfiglio[8];
    $datan_figlio = $rowfiglio[11];
//    $tipo_pagamento = $rowfiglio[12];
//    if ($tipo_pagamento == 1){
//        $tipo_pagamento = "Tramite Credito Prepagato presso la cartoleria Azzurro Pastello";
//    } else if($tipo_pagamento == 2){
//        $tipo_pagamento = "Tramite addebito in C/C: nel caso di prima domanda (compilare apposito modulo online)";
//    } else if($tipo_pagamento == 3){
//        $tipo_pagamento = "Tramite addebito in C/C: si conferma iban anno precedente";
//    }


    if ($textlength > 48) { // alocate as you need

        if ($textlength > 144) {

            $rowheight = $rowheight * 2.8;

        } else if ($textlength > 96) {

            $rowheight = $rowheight * 2;

        } else {

            $rowheight = $rowheight * 1.4;

        }
    }

    if($rowfiglio[10] == 1){
        $agevolata = "SI";
    } else {
        $agevolata = "NO";
    }

    if($rowfiglio[10] == 1){
        $tipo_scuola = "Infanzia";
    } else {
        $tipo_scuola = "Primaria";
    }


    $riga_trasporto .= '<tr style=" border-bottom: 1px solid #dddddd;">' . '<td style="padding: 12px 15px;   border-bottom: 1px solid #f3f3f3;">'. $rowfiglio[2] .'</td>' .'<td style="  padding: 12px 15px;   border-bottom: 1px solid #f3f3f3;">'. $rowfiglio[3] .'</td>'  . '<td style="  padding: 12px 15px;  border-bottom: 1px solid #f3f3f3;">'. $tipo_scuola .'</td>' . '</tr>';


    $row_info_figlio = '<br><br><table style="padding: 6px 15px;">
<tr>
 <th style="padding: 12px 15px;font-weight: bold;">Nato il</th>
  <th style="padding: 12px 15px;font-weight: bold;">Residente a</th>
  <th style="padding: 12px 15px;font-weight: bold;">In Via</th>
</tr>

<tr>
 <td style="text-transform:capitalize; padding: 12px 15px;"> '.$datan_figlio .'</td>
  <td style="text-transform:capitalize; padding: 12px 15px;">'.$res_figlio .'</td>
  <td style="text-transform:capitalize; padding: 12px 15px;">'.$via_figlio .' </td>
</tr>
<br>

<tr>
  <td style="padding: 12px 15px;font-weight: bold;">Classe</td>
  <td style="padding: 12px 15px;font-weight: bold;">Sezione</td>
   <td style="padding: 12px 15px;font-weight: bold;">Tariffa agevolata</td>
</tr>

<tr>
  <td style="text-transform:capitalize; padding: 12px 15px;"> '.$anno_scuola_f .' </td>
  <td style="text-transform:capitalize; padding: 12px 15px;"> '.$sezione_figlio .'</td>
   <td style="text-transform:capitalize; padding: 12px 15px;">'.$agevolata .'</td>
 
</tr>

';
//    if($rowfiglio[9] == 1){
//        $getdatidietafiglio = $conn->query("SELECT * FROM dieta_mensa WHERE riferimento_figlio='$id_figlio'");
//        $mensa_figliorow = $getdatidietafiglio->fetch_array(MYSQLI_BOTH);
//        $check1 = $mensa_figliorow[2];
//        $check2 = $mensa_figliorow[3];
//        $check3 = $mensa_figliorow[4];
//        $check4 = $mensa_figliorow[5];
//        $note = $mensa_figliorow[6];
//        if($check1 == 1){
//            $check1 = "<h2 >V</h2>";
//        } else {
//            $check1 = "<h2 >X</h2>";
//        }
//        if($check2 == 1){
//            $check2 = "<h2 >V</h2>";
//        } else {
//            $check2 = "<h2 >X</h2>";
//        }
//        if($check3 == 1){
//            $check3 = "<h2 >V</h2>";
//        } else {
//            $check3 = "<h2 >X</h2>";
//        }
//        if($check4 == 1){
//            $check4 = "<h2 >V</h2>";
//        } else {
//            $check4 = "<h2 >X</h2>";
//        }
//
//    }
//    $dieta_row_figlio = '<h4 style="text-align: center;">DIETA</h4><table style="padding: 6px 15px;">
//<tr>
//<th style="padding: 12px 15px;font-weight: bold; text-align: center;">No Carne di Maiale</th>
//<th style="padding: 12px 15px;font-weight: bold; text-align: center;">No Carne</th>
//<th style="padding: 12px 15px;font-weight: bold; text-align: center;">No Carne e Pesce</th>
//<th style="padding: 12px 15px;font-weight: bold; text-align: center;">Dieta speciale per motivi di salute</th>
//</tr>
//<tr>
//<td style="text-transform:capitalize; padding: 12px 15px; text-align: center;">'.$check1 .'</td>
//<td style="text-transform:capitalize; padding: 12px 15px; text-align: center;">'.$check2 .'</td>
//<td style="text-transform:capitalize; padding: 12px 15px; text-align: center;">'.$check3 .' </td>
//<td style="text-transform:capitalize; padding: 12px 15px; text-align: center;">'.$check4 .' </td>
//</tr><br>';

    $riga_trasporto .="</table>" . $row_info_figlio;
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
<table style="padding: 12px 15px;">
<tr>
 <th style="padding: 12px 15px;font-weight: bold;">Utente</th>
  <th style="padding: 12px 15px;font-weight: bold;">Residente a</th>
  <th style="padding: 12px 15px;font-weight: bold;">In Via</th>
</tr>

<tr>
 <td style="text-transform:capitalize; padding: 12px 15px;"> $nomeecognome</td>
  <td style="text-transform:capitalize; padding: 12px 15px; background-color: rgb($colore); !important">$residenza</td>
  <td style="text-transform:capitalize; padding: 12px 15px;">$via_resid </td>
</tr>
<br>

<tr>
    <td style="padding: 12px 15px;font-weight: bold;">Telefono</td>
  <td style="padding: 12px 15px;font-weight: bold;">Reddito ISEE</td>
  <td style="padding: 12px 15px;font-weight: bold;">Fascia di Appartenenza</td>
</tr>

<tr>
  <td style="text-transform:capitalize; padding: 12px 15px;"> $telefono </td>
  <td style="text-transform:capitalize; padding: 12px 15px;"> $isee €</td>
  <td style="text-transform:capitalize; padding: 12px 15px;">$fascia</td>
</tr>

<br>





</table>

<br>
<table class="styled-table">


</table>
<br>


$riga_mensa


$riga_trasporto


EOF;

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


// output some RTL HTML content

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('Ticket_sala.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+
