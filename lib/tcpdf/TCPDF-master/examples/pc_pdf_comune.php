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
        $sql = "SELECT * FROM assegno_maternita WHERE richiedenteCf = '". $_SESSION['CF']."' and id =" . $new_id;
        $result = $connessione->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $numeroPratica = $row['NumeroPratica'];
                
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
                
                if($row["cittadinoItaliano"] == 1){
                   $cittadino = "<p>di essere cittadino/a italiano/a</p>";
                }else{
                    if($row["cittadinoEuropeo"] == 1){ 
                       $cittadino = "<p>di essere cittadino/a " . $row["statoEuropeo"] . "</p>";
                    }
                }
                if($row["conoscenzaLingua"] == 1){
                    $conoscenzaLingua = "<p>di conoscere la lingua italiana</p>";
                }                
                if($row["idoneitaFisica"] == 1){
                    $idoneitaFisica = "<p>di essere fisicamente idoneo/a all’impiego</p>";
                }                
                if($row["dirittiCiviliPolitici"] == 1){
                    $dirittiCiviliPolitici = "<p>di godere dei diritti civili e politici</p>";
                }                
                if($row["destituzionePA"] == 1){
                    $destituzionePA = "<p>di non essere stato destituito, dispensato o comunque licenziato dall’impiego presso una pubblica amministrazione per persistente insufficiente rendimento e di non essere stato dichiarato decaduto o licenziato da altro pubblico impiego per averlo conseguito mediante esibizione di documenti falsi o viziati da invalidità non sanabile (art.127 DPR 10/01/1957 n.3)</p>";
                }
                if($row["fedinaPulita"] == 1){
                    $fedina = "<p>di non aver riportato condanne penali e di non aver procedimenti penali pendenti a proprio carico che impediscano, ai sensi delle vigenti disposizioni in materia, la costituzione del rapporto d’impiego con la Pubblica Amministrazione</p>";
                }elseif($row["condanne"]<>"") {
                    $fedina = "<p>di aver riportato le seguenti condanne (anche se sia concessa amnistia, condono indulto o perdono giudiziale) o di avere seguenti procedimenti penali in corso: <b>" . $row["condanne"] . "</b></p>";
                }
                if($row["obbligoLeva"] == 1){
                    $obbligoLeva = "<p>di essere in regola nei confronti dell’obbligo di leva per i candidati di sesso maschile nati entro il 31/12/1985 ai sensi dell’art.1, Legge 23/8/2004, n.226</p>";
                }
                if($row["titoloStudio"] <> ""){
                    $titoloStudio = "<p>di essere in possesso del seguente titolo di studio <b>" . $row["titoloStudio"]."</b>";
                    $titoloStudio.= " conseguito presso <b>".$row["titoloStudioScuola"]."</b>";
                    $titoloStudio.= " il <b>".$row["titoloStudioData"]."</b>"; /* DA FARE!!!!!!!!!!! */
                    $titoloStudio.= " con votazione finale di <b>".$row["titoloStudioVoto"]."</b></p>";
                }
                if($row["conoscenzaInformatica"] == 1){
                    $conoscenzaInformatica = "<p>di conoscere l’uso delle apparecchiature, delle applicazioni informatiche più diffuse e di scegliere la seguente lingua straniera (inglese o francese) " . $row["conoscenzaLinguaEstera"] . "</p>";
                }
                if($row["titoliPreferenza"] <> ""){
                    $titoliPreferenza = "<p>di essere in possesso dei seguenti titoli di preferenza (a parità di valutazione) <b>".$row["titoliPreferenza"]."</b></p>";
                }
                if($row["necessitaHandicap"] <> ""){
                    $necessitaHandicap = "<p>per i portatori di handicap: indicare le necessità, per l’effettuazione delle prove, in relazione al proprio handicap, di eventuali tempi aggiuntivi e/o ausili specifici ai sensi dell’art. 20, comma 2 della L. 5.02.1992, n. 104 e dell’art. 16 della legge 68/99<br/><b>".$row["necessitaHandicap"]."</b></p>";
                }
                
                if($row["dirittoRiserva"] == 1){
                    $dirittoRiserva = "<p>di aver diritto alla riserva ai sensi dell’art1014 e dell’art. 678, comma 9, del D.Lgs66/2010</p>";
                }
                if($row["accettazioneCondizioniBando"] == 1){
                    $accettazioneCondizioniBando = "<p>di accettare espressamente ed incondizionatamente tutte le prescrizioni e condizioni contenute nel bando di concorso</p>";
                }
                if($row["accettazioneDisposizioniComune"] == 1){
                    $accettazioneDisposizioniComune = "<p>di accettare, in caso di presa di servizio, tutte le disposizioni che regolano lo stato giuridico ed economico dei dipendenti del Comune di ". $configData['nome_comune'] ."</p>";
                }
                if($row["accettazioneComunicazioneVariazioniDomicilio"] == 1){
                    $accettazioneComunicazioneVariazioniDomicilio = "<p>di impegnarsi a comunicare, per iscritto, al Comune di ". $configData['nome_comune'] ." le eventuali successive variazioni di domicilio e riconosce che il Comune sarà esonerato da ogni responsabilità in caso di irreperibilità del destinatario o disguidi del servizio postale e/o telematico.</p>";
                }
                $allegati = "";
                if($row["uploadCartaIdentitaFronte"] <> '' && $row["uploadCartaIdentitaRetro"] <> ''){
                    $allegati .= "- Copia documento di identità<br>";
                }

                if($row["uploadCV"] <> ''){
                    $allegati .= "- Curriculum Vitae<br>";
                }

                if($row["uploadTitoliPreferenza"] <> ''){
                    $allegati .= "- Titoli di Preferenza<br>";
                }
                
                $data_compilazione = date("d/m/Y", strtotime($row["data_compilazione"]));
            }
        }
        $connessione->close();
    }

// Extend the TCPDF class to create custom Header and Footer
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
        <td style="padding: 12px 10px;">
            <p>Il/La sottoscritto/a <b>$cognome $nome</b> nato/a a <b>$luogonascita</b> il <b>$datanascita</b>,</p>
            <p>residente a <b>$richiedenteLocalita - $richiedenteProvincia</b>, in <b>$richiedenteVia</b> tel. <b>$richiedenteTel</b></p>
            <p>codice fiscale <b>$cf</b></p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>CHIEDE</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>di essere ammesso/a al <b>$Concorso</b></p>
        </td>
    </tr>        
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>A TAL FINE DICHIARA sotto la propria responsabilità:</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            $cittadino
            $conoscenzaLingua
            $idoneitaFisica
            $dirittiCiviliPolitici
            $destituzionePA
            $fedina
            $obbligoLeva
            $titoloStudio
            $conoscenzaInformatica
            $titoliPreferenza
            $necessitaHandicap
            $dirittoRiserva
            <p>Il recapito telematico presso il quale dovranno essere inviate eventuali comunicazioni è il seguente<br/>indirizzo e-mail <b>$email</b> n. tel. <b>$richiedenteTel</b></p>
            $accettazioneCondizioniBando
            $accettazioneDisposizioniComune
            $accettazioneComunicazioneVariazioniDomicilio
            <p></p>
            <p>Il/la sottoscritto/a dichiara ai sensi dell’art. 76 del D.P.R. 445 del 28/12/2000, di essere a conoscenza delle responsabilità penali cui può andare incontro in caso di dichiarazioni mendaci.<br><em>(Le dichiarazioni sopra riportate sostituiscono a tutti gli effetti le corrispondenti certificazioni ai sensi dell’art.46 D.P.R. 445 del 28.12.2000)</em></p>
            <p></p>
            <p>Il/la sottoscritto/a autorizza ai sensi dell’art. 23 del D. Lgs. 196 del 30.06.2003 e del Regolamento(UE) 2016/679, il Comune di $nome_comune al trattamento dei propri dati sia personali che eventualmente sensibili ai soli fini del presente procedimento concorsuale e dell’eventuale assunzione, qualora assunto in servizio.</p>
        </td>
    </tr> 
    <tr>
        <td style="padding: 12px 10px;">
            <p>ALLEGATI:<br>
            $allegati</p>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td style="padding: 12px 10px;">
            <p>$nome_comune, $data_compilazione</p>
        </td>
        <td style="padding: 12px 10px; text-align: right;">
            <p>$cognome $nome</p>
        </td>        
    </tr>
</table>
EOD;

$pdf->writeHTMLCell(0,0,'','',$html,0,1,0,true,'',true);

$filePath = realpath('../uploads/pratiche/');

$pdf->Output($filePath . '/'.$numeroPratica.'.pdf', 'F');

//============================================================+
// END OF FILE
//============================================================+
