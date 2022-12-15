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
                $datanascita = date("d/m/Y", strtotime($row["richiedenteDataNascita"]));
                $luogonascita = $row["richiedenteLuogoNascita"];
                $richiedenteVia = $row["richiedenteVia"];
                $richiedenteLocalita = $row["richiedenteLocalita"];
                $richiedenteProvincia = $row["richiedenteProvincia"];
                $richiedenteTel = $row["richiedenteTel"];
                
                $minoreNome = $row["minoreNome"];
                $minoreCognome = $row["minoreCognome"];
                $minoreDataNascita = date("d/m/Y", strtotime($row["minoreDataNascita"]));
                $minoreLuogoNascita = $row["minoreLuogoNascita"];
                
                $tipoRichiesta = $row["tipoRichiesta"];
                $DichiarazioneCittadinanza = $row["DichiarazioneCittadinanza"];
                $DichiarazioneSoggiornoNumero = $row["DichiarazioneSoggiornoNumero"];
		$DichiarazioneSoggiornoQuestura = $row["DichiarazioneSoggiornoQuestura"];
	 	$DichiarazioneSoggiornoData = $row["DichiarazioneSoggiornoData"];
	 	$DichiarazioneSoggiornoDataRinnovo = $row["DichiarazioneSoggiornoDataRinnovo"];
	 	$DichiarazioneAffidamento = $row["DichiarazioneAffidamento"];
	 	$DichiarazioneAffidamentoData = $row["DichiarazioneAffidamentoData"];
	 	$tipoPagamento_id = $row["tipoPagamento_id"];
	 	$uploadCartaIdentitaFronte = $row["uploadCartaIdentitaFronte"];
	 	$uploadCartaIdentitaRetro = $row["uploadCartaIdentitaRetro"];
	 	$uploadTitoloSoggiorno = $row["uploadTitoloSoggiorno"];
	 	$uploadDichiarazioneDatoreLavoro = $row["uploadDichiarazioneDatoreLavoro"];
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

if($tipoRichiesta == "AM"){
    $tipoRichiestaText = "l’assegno di maternità";
}else{
    $tipoRichiestaText = "la quota differenziale dell’assegno di maternità";
}

if($DichiarazioneCittadinanza == "I"){
    $cittadinanza = "<p>di essere cittadina italiana o di uno stato appartenente all’Unione Europea;</p>";
}else{
    $cittadinanza = "<p>di essere cittadina extracomunitaria in possesso di titolo di soggiorno in corso di validità n. <b>".$DichiarazioneSoggiornoNumero."</b> rilasciata dalla Questura di <b>".$DichiarazioneSoggiornoQuestura."</b> il <b>$DichiarazioneSoggiornoData</b>, oppure di aver presentato richiesta di rinnovo in data <b>".$DichiarazioneSoggiornoDataRinnovo."</b>, ed appartenente ad una delle seguenti tipologie:<br>- permesso di soggiorno CE per soggiornanti di lungo periodo;<br>- altro tipo di permesso valido che consente l’esercizio dell’attività lavorativa;<br></p>";
}

if($DichiarazioneAffidamento <> 0){
    $affidamento = "<p>che il figlio per il quale viene richiesto l’assegno di maternità è in affidamento dal <b>".$DichiarazioneAffidamentoData."</b> (in caso di adozione o affidamento preadottivo)</p>";
}else{
    $affidamento = "";
}

$modalitaPagamento = "  " . MetodoPagamentoById($tipoPagamento_id);

$allegati = "";
if($uploadCartaIdentitaFronte <> '' && $uploadCartaIdentitaRetro <> ''){
    $allegati .= "- Copia documento di identità<br>";
}
        
if($uploadTitoloSoggiorno <> ''){
    $allegati .= "- Copia titolo di soggiorno oppure ricevuta della richiesta di rilascio del permesso di soggiorno<br>";
}
        
if($uploadDichiarazioneDatoreLavoro <> ''){
    $allegati .= "- Copia della dichiarazione del datore di lavoro relativa all’importo percepito per la maternità (nel caso di richiesta della quota differenziale dell’assegno di maternità)<br>";
}


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
            <h3>ISTANZA PER LA CONCESSIONE DELL’ASSEGNO DI MATERNITÀ CONCESSO DAI COMUNI art. 74 del D. lgs n. 151/2001</h3>
            <p><em>da presentare entro 6 mesi dalla nascita del minore o dell’ingresso del nucleo del minore per adozione o per affidamento preadottivo</em></p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>La sottoscritta <b>$cognome $nome</b> nata a <b>$luogonascita</b> il <b>$datanascita</b>,</p>
            <p>residente a <b>$richiedenteLocalita - $richiedenteProvincia</b>, in <b>$richiedenteVia</b> codice fiscale <b>$cf</b></p>
            <p>n. tel. <b>$richiedenteTel</b> e- mail <b>$email</b></p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>Madre del bambino:</p>
            <p><b>$minoreCognome $minoreNome</b><br>Nato/a a <b>$minoreLuogoNascita</b> il <b>$minoreDataNascita</b> con me residente</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>CHIEDE</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>$tipoRichiestaText</p>
            <p>Ai sensi degli artt. 46, 47 e 48 del DPR 445/2000, consapevole delle responsabilità penali e delle sanzioni previste in caso di non veridicità del contenuto della presente dichiarazione, di dichiarazione mendace o di formazione di atti falsi di cui agli artt. 75 e 76 del DPR 445/2000, sotto la propria responsabilità </p>
        </td>
    </tr>        
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>DICHIARA:</h4>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            $cittadinanza
            <p>di non svolgere attività lavorativa e quindi di non essere beneficiaria di trattamenti previdenziali di maternità a carico dell’Istituto Nazionale per la Previdenza Sociale (INPS) o di altro ente previdenziale per la stessa nascita/adozione;<br>
            oppure</p>
            <p>di essere beneficiaria di trattamento previdenziale o economico di maternità inferiore rispetto a quello previsto dalle norme vigenti per la concessione del beneficio, come da dichiarazione del datore di lavoro allegata;</p>
            <p>di non aver presentato, per il medesimo evento, domanda per assegno di maternità a carico dello Stato di cui all’art. 75 del D.Lgs. 151/2021;</p>
            <p>di non aver presentato analoga richiesta presso altro Comune per lo stesso figlio/i (in caso di trasferimento di residenza);</p>
            <p>di essere in possesso di ISEE minori in corso di validità e congruente allo stato di famiglia (quindi comprensivo del figlio/i per i quali si chiede l’assegno), privo di omissioni e/o difformità;</p>
            $affidamento
            <p>di essere a conoscenza dell’obbligo di comunicare al Comune ogni evento che determini la variazione del nucleo familiare.</p>
        </td>
    </tr> 
    <tr>
        <td style="padding: 12px 10px; text-align: center;">
            <h4>COMUNICA</h4>
        </td>
    </tr>        
    <tr>
        <td style="padding: 12px 10px;">
            <p>che l’eventuale erogazione dell’assegno avverrà a mezzo accredito su $modalitaPagamento</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>ALLEGA<br>
            $allegati</p>
        </td>
    </tr>
    <tr>
        <td style="padding: 12px 10px;">
            <p>$nome_comune, $data_compilazione</p>
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
