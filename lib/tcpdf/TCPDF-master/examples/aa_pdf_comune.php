<?php

/* file di inclusione */
$configData = require '../env/config_servizi.php';
$configDB = require '../env/config.php';

/* con l'id vado a richiamare i dati salvati */
    if(isset($new_id) && $new_id<>''){
        /* DATI ESTRAPOLATI DA DB - start */ 
        $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
        $sql = "SELECT * FROM accesso_atti WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $new_id;
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $numeroPratica = $row["NumeroPratica"];
                
                $ufficioDestinatario = UfficioDestinatarioById($row["UfficioDestinatarioId"]);
                
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
                /* blocco Azienda */
                $box_azienda = "";
                if($row["pgRuolo"]!=""){
                    $box_azienda = "<p>&nbsp;</p>";
                    $box_azienda .= "<p>In qualità di <b>".$row["pgRuolo"]."</b><p>";
                    $box_azienda .= "<p><b>".$row["pgDenominazione"]." ".$row["pgTipologia"]."</b></p>";
                    $box_azienda .= "<p>Sede Legale <b>". $row["pgSedeLegaleIndirizzo"] ." ". $row["pgSedeLegaleLocalita"] ."(".$row["pgSedeLegaleProvincia"].") - " . $row["pgSedeLegaleCap"] ."</b></p>";
                    $box_azienda .= "<p>Codice Fiscale <b>". $row["pgCf"] ."</b> - Partita IVA <b>". $row["pgPiva"] . "</b></p>";
                    $box_azienda .= "<p>Telefono <b>". $row["pgTelefono"] . "</b> - Email <b>" . $row["pgEmail"] . "</b> - PEC <b>" .$row["pgPec"] . "</b></p>";                
                }
                
                $box_titolo = "In quanto <b>";
                
                switch($row["richiedenteTitolo"]){
                    case "DI":
                        $box_titolo .= "Diretto interessato</b>";
                        break;
                    case "PI":
                        $box_titolo .= "Proprietario dell'immobile oggetto del procedimento</b>";
                        break;
                    case "AI":
                        $box_titolo .= "Affittuario dell'immobile oggetto del procedimento</b>, pertanto si allegherà documentazione comprovante il titolo dichiarato";
                        break;
                    case "RI":
                        $box_titolo .= "Professionista incaricato ";
                        if($row['richiedenteProfessionistaIncaricatoDa'] == "Tribunale"){
                            $box_titolo .= "dal tribunale altro organo giudiziario</b>";
                        } 
                        if($row['richiedenteProfessionistaIncaricatoDa'] == "Proprietario"){
                            $box_titolo .= "dal proprietario dell'immobile</b>: " . $row['richiedenteProfessionistaIncaricatoDaNome'] . " " . $row['richiedenteProfessionistaIncaricatoDaCognome'] . "(c.f.: " . $row['richiedenteProfessionistaIncaricatoDaCf'] . ")";
                        } 
                        if($row['richiedenteProfessionistaIncaricatoDa'] == "Altro"){
                            $box_titolo .= "da altro soggetto</b>: " . $row['richiedenteProfessionistaIncaricatoDaAltroSoggetto'];
                        } 
                        break;
                    case "NR":
                        $box_titolo .= "Notaio rogante</b>, pertanto si allegherà documentazione comprovante il titolo dichiarato";
                        break;
                    case "AT":
                        $box_titolo .= "Altro titolo</b>, pertanto si allegherà documentazione comprovante il titolo dichiarato";
                        break;
                    default :
                        $box_titolo = "";
                        break;
                }
                
                $box_richiesta = "<p>di esercitare il diritto di accesso agli atti attraverso la richiesta di: <b>";
                
                switch($row["richiestaTipo"]){
                    case "PresaVisione":
                        $box_richiesta .= "Presa Visione</b>";
                        break;
                    case "CopiaInformatizzata":
                        $box_richiesta .= "Copia informatizzata</b>";
                        break;
                    case "CopiaCartaSemplice":
                        $box_richiesta .= "Copia Carta Semplice</b>";
                        break;
                    case "CopiaConformeOriginale":
                        $box_richiesta .= "Copia conforme all'originale</b>";
                        break;                    
                    case "Altro":
                        $box_richiesta .= "Altro</b>";
                        break;
                    default :
                        $box_richiesta .= "";
                        break;
                }
                $box_richiesta .= "</p>";
                
                $box_documenti = "<p>dei seguenti atti o documenti amministrativi</p>";
                $box_documenti .= "<p><b>".$row['richiestaAtti']."</b></p>";
                if($row['richiestaAttiTipoDocumento']!=""){
                    $box_documenti .= "<p>estremi identificativi degli atti o documenti: <b>" . $row['richiestaAttiTipoDocumento'] . " prot. ". $row['richiestaAttiProtocollo'] . " del " . $row['richiestaAttiData']."</b>";
                }
                
                if($row['collocazioneTerritorialeCodiceCatastale']!=""){
                    $box_documenti .= "<p>collocazione territoriale:<br>Codice Catastale <b>" . $row['$collocazioneTerritorialeCodiceCatastale'] . " sez. ". $row['collocazioneTerritorialeSezione'] . " foglio " . $row['collocazioneTerritorialeFoglio'] . " psrticella " . $row['collocazioneTerritorialeParticella'] . " subalterno " . $row['collocazioneTerritorialeSubalterno'] . " categoria ". $row['collocazioneTerritorialeCategoria'] . "</b><br>";
                    $box_documenti .= "Indirizzo: " . $row['collocazioneTerritorialeIndirizzo'] . " " . $row['collocazioneTerritorialeLocalita'] . " (". $row['collocazioneTerritorialeProvincia'] . ")</p>";
                }

                $motivo = "<b>";
                switch($row["motivo"]){
                    case "AttoNotarile":
                        $motivo .= "Atto Notarile</b>";
                        break;
                    case "Controversia":
                        $motivo .= "Controversia</b>";
                        break;
                    case "DocumentazionePersonale":
                        $motivo .= "Documentazione Personale</b>";
                        break;
                    case "Mutuo":
                        $motivo .= "Mutuo</b>";
                        break;
                    case "PresentazioneProgettoEdilizio":
                        $motivo .= "Presentazione Progetto Edilizio</b>";
                        break;
                    case "PresuntaLesioneDiInteressi":
                        $motivo .= "Presunta Lesione Di Interessi</b>";
                        break;
                    case "VerificaConformitaEdilizia":
                        $motivo .= "Verifica Conformità Edilizia</b>";
                        break;
                    case "AltraMotivazione":
                        $motivo .= "Altra Motivazione</b> " . $row['motivoAltro'];
                        break;
                }
                
                $box_ritiro = "<p><b>";
                switch($row["modoRitiro"]){
                    case "Ufficio":
                        $box_ritiro .= "di poterli ritirare presso l'ufficio competente</b>";
                        break;
                    case "Email":
                        $box_ritiro .= "di riceverli all'indirizzo e-mail sopra indicato</b>";
                        break;
                    case "IndirizzoInserito":
                        $box_ritiro .= "di riceverli a mezzo posta all'indirizzo sopra indicato</b>";
                        break;
                    case "AltroIndirizzo":
                        $box_ritiro .= "di riceverli a mezzo posta al seguente indirizzo</b>: " . $row['modoRitiroPostaIndirizzo'] . " " . $row['modoRitiroPostaLocalita'] . " (". $row['modoRitiroPostaProvincia'] . ") - " . $row['modoRitiroPostaCap'];
                        break;
                }
                if($row['annotazioni']!= ""){
                    $box_ritiro .= "</p><p>" . $row['annotazioni'];
                }
                $box_ritiro .= "</p>";
                
                $allegati = "";
                if($row['uploadCartaIdentitaFronte'] != "" && $row['uploadCartaIdentitaRetro'] != ""){
                    $allegati .= "Carta d'Identità<br>";
                }
                if($row['uploadTitoloDichiarato'] != "" || $row['uploadAffittuario'] != "" || $row['uploadAltroSoggetto'] != "" || $row['uploadNotaioRogante'] != "" || $row['uploadAltriTitoloDescrizione'] != ""){
                    $allegati .= "Documentazione comprovante il titolo dichiarato<br>";
                }
                if($row['uploadAttoNotarile'] != ""){
                    $allegatiTmp .= "copia dell'atto notarile con il quale è stata conferita la procura";
                }
                
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
            <h3>Domanda di accesso ai documenti amministrativi</h3>
            <p>Ai sensi della Legge 07/08/1990, n. 241 e del Decreto del Presidente della Repubblica 12/04/2006, n. 184</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>Ufficio Destinatario <b>$ufficioDestinatario</b></p>
            <p>Il sottoscritto/a <b>$cognome $nome</b></p>
            <p>nato/a a <b>$luogonascita</b> il <b>$datanascita</b>  C.F. <b>$cf</b></p>
            <p>residente a <b>$richiedenteLocalita - $richiedenteProvincia</b> in <b>$richiedenteVia</b></p>
            <p>tel./tell. <b>$richiedenteTel</b> e- mail <b>$email</b></p>
            $box_azienda
            $box_titolo
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>CHIEDE</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">        
            $box_richiesta
            $box_documenti
        </td>
    </tr>        
    <tr>
        <td style="padding: 12px 10px;">
            <p>Valendosi della facoltà prevista dall'articolo 46 e dall'articolo 47 del Decreto del Presidente della Repubblica 28/12/2000, n. 445, consapevole delle sanzioni penali previste dall'articolo 76 del Decreto del Presidente della Repubblica 28/12/2000, n. 445 e dall'articolo 483 del Codice Penale nel caso di dichiarazioni non veritiere e di falsità in atti,</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>DICHIARA:</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>di avere un interesse personale e concreto ovvero pubblico o diffuso all'accesso per la tutela di situazioni giuridicamente rilevanti per il seguente motivo: $motivo</p>
            <p>e di essere consapevole che in presenza di controinteressati l'Amministrazione è tenuta, ai sensi dell'articolo 3 del Decreto del Presidente della Repubblica 12/04/2006, n. 184, a dare comunicazione della presente richiesta agli stessi, i quali possono farne motivata opposizione entro dieci giorni.</p>
            <p>Previa verifica e conferma da parte dell'ufficio competente circa la sussistenza del diritto, dei costi, dell'eventuale regolarizzazione dell'istanza, del rispetto alle disposizioni in materia di bollo e fatti salvi eventuali motivi ostativi di natura tecnica ed organizzativa,</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>CHIEDE</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">        
            $box_ritiro
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>ALLEGA</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>$allegati</p>
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
