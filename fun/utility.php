<?php

/* funzioni per la validazione - start */
function isDigits(string $s, int $minDigits = 9, int $maxDigits = 14): bool {
    return preg_match('/^[0-9]{'.$minDigits.','.$maxDigits.'}\z/', $s);
}

function isValidTelephoneNumber(string $telephone, int $minDigits = 9, int $maxDigits = 14): bool {
    if (preg_match('/^[+][0-9]/', $telephone)) { //is the first character + followed by a digit
        $count = 1;
        $telephone = str_replace(['+'], '', $telephone, $count); //remove +
    }
    
    //remove white space, dots, hyphens and brackets
    $telephone = str_replace([' ', '.', '-', '(', ')'], '', $telephone); 

    //are we left with digits only?
    return isDigits($telephone, $minDigits, $maxDigits); 
}

function isValidCodiceFiscale($cf){
    /* funzione temporanea - se vengono passati i parametri potremmo utilizzare: https://github.com/Schema31/php-it-tax-code-sdk */
     if($cf=='')
	return false;

     if(strlen($cf)!= 16)
	return false;

     $cf=strtoupper($cf);
     if(!preg_match("/[A-Z0-9]+$/", $cf))
	return false;
     $s = 0;
     for($i=1; $i<=13; $i+=2){
	$c=$cf[$i];
	if('0'<=$c and $c<='9')
	     $s+=ord($c)-ord('0');
	else
	     $s+=ord($c)-ord('A');
     }

     for($i=0; $i<=14; $i+=2){
	$c=$cf[$i];
	switch($c){
             case '0':  $s += 1;  break;
	     case '1':  $s += 0;  break;
             case '2':  $s += 5;  break;
	     case '3':  $s += 7;  break;
	     case '4':  $s += 9;  break;
	     case '5':  $s += 13;  break;
	     case '6':  $s += 15;  break;
	     case '7':  $s += 17;  break;
	     case '8':  $s += 19;  break;
	     case '9':  $s += 21;  break;
	     case 'A':  $s += 1;  break;
	     case 'B':  $s += 0;  break;
	     case 'C':  $s += 5;  break;
	     case 'D':  $s += 7;  break;
	     case 'E':  $s += 9;  break;
	     case 'F':  $s += 13;  break;
	     case 'G':  $s += 15;  break;
	     case 'H':  $s += 17;  break;
	     case 'I':  $s += 19;  break;
	     case 'J':  $s += 21;  break;
	     case 'K':  $s += 2;  break;
	     case 'L':  $s += 4;  break;
	     case 'M':  $s += 18;  break;
	     case 'N':  $s += 20;  break;
	     case 'O':  $s += 11;  break;
	     case 'P':  $s += 3;  break;
             case 'Q':  $s += 6;  break;
	     case 'R':  $s += 8;  break;
	     case 'S':  $s += 12;  break;
	     case 'T':  $s += 14;  break;
	     case 'U':  $s += 16;  break;
	     case 'V':  $s += 10;  break;
	     case 'W':  $s += 22;  break;
	     case 'X':  $s += 25;  break;
	     case 'Y':  $s += 24;  break;
	     case 'Z':  $s += 23;  break;
	}
    }

    if( chr($s%26+ord('A'))!=$cf[15] )
	return false;

    return true;
}

function isValidIBAN($iban)
{
    if(strlen($iban) < 5) return false;
    $iban = strtolower(str_replace(' ','',$iban));
    $Countries = array('al'=>28,'ad'=>24,'at'=>20,'az'=>28,'bh'=>22,'be'=>16,'ba'=>20,'br'=>29,'bg'=>22,'cr'=>21,'hr'=>21,'cy'=>28,'cz'=>24,'dk'=>18,'do'=>28,'ee'=>20,'fo'=>18,'fi'=>18,'fr'=>27,'ge'=>22,'de'=>22,'gi'=>23,'gr'=>27,'gl'=>18,'gt'=>28,'hu'=>28,'is'=>26,'ie'=>22,'il'=>23,'it'=>27,'jo'=>30,'kz'=>20,'kw'=>30,'lv'=>21,'lb'=>28,'li'=>21,'lt'=>20,'lu'=>20,'mk'=>19,'mt'=>31,'mr'=>27,'mu'=>30,'mc'=>27,'md'=>24,'me'=>22,'nl'=>18,'no'=>15,'pk'=>24,'ps'=>29,'pl'=>28,'pt'=>25,'qa'=>29,'ro'=>24,'sm'=>27,'sa'=>24,'rs'=>22,'sk'=>24,'si'=>19,'es'=>24,'se'=>24,'ch'=>21,'tn'=>24,'tr'=>26,'ae'=>23,'gb'=>22,'vg'=>24);
    $Chars = array('a'=>10,'b'=>11,'c'=>12,'d'=>13,'e'=>14,'f'=>15,'g'=>16,'h'=>17,'i'=>18,'j'=>19,'k'=>20,'l'=>21,'m'=>22,'n'=>23,'o'=>24,'p'=>25,'q'=>26,'r'=>27,'s'=>28,'t'=>29,'u'=>30,'v'=>31,'w'=>32,'x'=>33,'y'=>34,'z'=>35);

    if(array_key_exists(substr($iban,0,2), $Countries) && strlen($iban) == $Countries[substr($iban,0,2)]){
                
        $MovedChar = substr($iban, 4).substr($iban,0,4);
        $MovedCharArray = str_split($MovedChar);
        $NewString = "";

        foreach($MovedCharArray AS $key => $value){
            if(!is_numeric($MovedCharArray[$key])){
                if(!isset($Chars[$MovedCharArray[$key]])) return false;
                $MovedCharArray[$key] = $Chars[$MovedCharArray[$key]];
            }
            $NewString .= $MovedCharArray[$key];
        }
        
        if(bcmod($NewString, '97') == 1)
        {
            return true;
        }
    }
    return false;
}

function isValidCarta($carta)
{
    if(strlen($carta) < 5) return false;
    $carta = strtolower(str_replace(' ','',$carta));

    if (strlen($carta) == 16) {
        return true;
    }
    
    if(is_numeric($carta)){
        return true;
    }
    
    return false;
}

/* funzioni per la validazione - end */

function NomeServizioById($Servizio_id){
    $configDB = require './env/config.php';
    $connessioneNomeServizioById = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlNomeServizioById = "SELECT NomeServizio FROM servizi WHERE id = ". $Servizio_id;
    $resultNomeServizioById = $connessioneNomeServizioById->query($sqlNomeServizioById);

    if ($resultNomeServizioById->num_rows > 0) {
    // output data of each row
        while($rowNomeServizioById = $resultNomeServizioById->fetch_assoc()) {
            return $rowNomeServizioById["NomeServizio"];
        }
    }
    $connessioneNomeServizioById->close();
}

function LinkServizioById($Servizio_id){
    $configDB = require './env/config.php';
    $connessioneLinkServizioById = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlLinkServizioById = "SELECT LinkServizio FROM servizi WHERE id = ". $Servizio_id;
    $resultLinkServizioById = $connessioneLinkServizioById->query($sqlLinkServizioById);

    if ($resultLinkServizioById->num_rows > 0) {
    // output data of each row
        while($rowLinkServizioById = $resultLinkServizioById->fetch_assoc()) {
            return $rowLinkServizioById["LinkServizio"];
        }
    }
    $connessioneLinkServizioById->close();
}

function PrefissoServizioById($Servizio_id){
    $configDB = require './env/config.php';
    $connessioneLinkServizioById = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlLinkServizioById = "SELECT PrefissoServizio FROM servizi WHERE id = ". $Servizio_id;
    $resultLinkServizioById = $connessioneLinkServizioById->query($sqlLinkServizioById);

    if ($resultLinkServizioById->num_rows > 0) {
    // output data of each row
        while($rowLinkServizioById = $resultLinkServizioById->fetch_assoc()) {
            return $rowLinkServizioById["PrefissoServizio"];
        }
    }
    $connessioneLinkServizioById->close();
}

function NomeMetodoPagamentoByIdMain($Pagamento_id){
    $configDB = require './env/config.php';
    $connessioneNMPBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlNMPBI = "SELECT Nome as NomeTipoPagamento FROM tipo_pagamento WHERE id = ". $Pagamento_id;
    $resultNMPBI = $connessioneNMPBI->query($sqlNMPBI);

    if ($resultNMPBI->num_rows > 0) {
    // output data of each row
        while($rowNMPBI = $resultNMPBI->fetch_assoc()) {
            return $rowNMPBI["NomeTipoPagamento"];
        }
    }
    $connessioneNMPBI->close();
}


function NomeMetodoPagamentoById($Pagamento_id){
    $configDB = require '../env/config.php';
    $connessioneNMPBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlNMPBI = "SELECT Nome as NomeTipoPagamento FROM tipo_pagamento WHERE id = ". $Pagamento_id;
    $resultNMPBI = $connessioneNMPBI->query($sqlNMPBI);

    if ($resultNMPBI->num_rows > 0) {
    // output data of each row
        while($rowNMPBI = $resultNMPBI->fetch_assoc()) {
            return $rowNMPBI["NomeTipoPagamento"];
        }
    }
    $connessioneNMPBI->close();
}

function ViewAllTipiPagamento(){
    $configDB = require '../env/config.php';
    $connessioneVATP = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlVATP = "SELECT * FROM tipo_pagamento";
    $resultVATP = $connessioneVATP->query($sqlVATP);    
    if ($resultVATP->num_rows > 0) {
        echo '<option value="">Seleziona tipo di pagamento</option>';
        while($rowVATP = $resultVATP->fetch_assoc()) {
            echo '<option value="' . $rowVATP["id"] . '">' . $rowVATP["Nome"] . '</option>';
        }
        
    }
    $connessioneVATP->close();
}

function ViewTipiPagamentoById($ID){
    $configDB = require '../env/config.php';
    $connessioneVATP = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlVATP = "SELECT * FROM tipo_pagamento WHERE id = ". $ID;
    $resultVATP = $connessioneVATP->query($sqlVATP);    
    if ($resultVATP->num_rows > 0) {
        while($rowVATP = $resultVATP->fetch_assoc()) {
            return $rowVATP["Nome"];
        }
    }
    $connessioneVATP->close();
}

function CreateLinkAttivita($ServizioId,$pratica_id,$StatusId){
    $linkServizio = LinkServizioById($ServizioId);
    $prefissoServizio = PrefissoServizioById($ServizioId);
    if($StatusId == 1){
        $linkServizio .= "/compilazione_dati.php?".$prefissoServizio."bozza_id=".$pratica_id;
    }else{
        $linkServizio .= "/dettaglio.php?".$prefissoServizio."pratica_id=".$pratica_id;
    }
    
    return $linkServizio;
}

function NameStatusById($status_id){
    $configDB = require '../env/config.php';
    $connessioneVATP = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlVATP = "SELECT nome FROM status WHERE id = ". $status_id;
    $resultVATP = $connessioneVATP->query($sqlVATP);    
    if ($resultVATP->num_rows > 0) {
        while($rowVATP = $resultVATP->fetch_assoc()) {
            return $rowVATP["nome"];
        }
    }
    $connessioneVATP->close();
}

function NumeroPraticaById($servizio_id,$pratica_id){
    switch($servizio_id) {
        case 9: $table = "assegno_maternita"; break;
        case 11: $table = "domanda_contributo"; break;
    }
    $configDB = require './env/config.php';
    $connessioneNPBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlNPBI = "SELECT NumeroPratica FROM " . $table . " WHERE id = ". $pratica_id;
    $resultNPBI = $connessioneNPBI->query($sqlNPBI);
    if ($resultNPBI->num_rows > 0) {
        while($rowNPBI = $resultNPBI->fetch_assoc()) {
            return $rowNPBI["NumeroPratica"];
        }
    }
    $connessioneNPBI->close();
}


function CfAltroByPraticaId($servizio_id,$pratica_id){
    switch($servizio_id) {
        case 9: 
            /* assegno_maternita */
            return "";
            break;
        case 11: 
            $configDB = require './env/config.php';
            $connessioneCABPI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlCABPI = "SELECT beneficiarioCf FROM domanda_contributo WHERE id = ". $pratica_id;
            $resultCABPI = $connessioneCABPI->query($sqlCABPI);
            if ($resultCABPI->num_rows > 0) {
                while($rowCABPI = $resultCABPI->fetch_assoc()) {
                    return "<p class='mb-1'>C.F. del beneficiario: ". $rowCABPI["beneficiarioCf"] . "</p>";
                }
            }
            $connessioneCABPI->close();
            break;
    }

}

function ViewThumbAllegatiById($ServizioId,$PraticaId){
    $configDB = require './env/config.php';
    switch($ServizioId) {
        case 9: 
            /* assegno_maternita */
            $connessioneVTABI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT uploadCartaIdentitaFronte, uploadCartaIdentitaRetro, uploadTitoloSoggiorno, uploadDichiarazioneDatoreLavoro FROM assegno_maternita WHERE id = ". $PraticaId;
            $resultVTABI = $connessioneVTABI->query($sqlVTABI);
            if ($resultVTABI->num_rows > 0) {
                while($rowVTABI = $resultVTABI->fetch_assoc()) {
                    
                    $returnText = "";

                    if(($rowVTABI['uploadCartaIdentitaFronte'] != "" || $rowVTABI['uploadCartaIdentitaFronte'] != NULL) || ($rowVTABI['uploadCartaIdentitaRetro'] != "" || $rowVTABI['uploadCartaIdentitaRetro'] != NULL) || ($rowVTABI['uploadTitoloSoggiorno'] != "" || $rowVTABI['uploadTitoloSoggiorno'] != NULL) || ($rowVTABI['uploadDichiarazioneDatoreLavoro'] != "" || $rowVTABI['uploadDichiarazioneDatoreLavoro'] != NULL)){
                        $returnText = "<div class='col-lg-12'><p class='text-allegati-xsmall'>ALLEGATI</p>";
                    }
                    
                    
                    /* uploadCartaIdentitaFronte*/
                    if($rowVTABI['uploadCartaIdentitaFronte'] != "" || $rowVTABI['uploadCartaIdentitaFronte'] != NULL){
                        $fileName = $rowVTABI['uploadCartaIdentitaFronte'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/servizi/uploads/assegno_maternita/'.$rowVTABI['uploadCartaIdentitaFronte'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='./media/images/icons/pdf.png'/></a>";
                            }else{
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='./media/images/icons/jpg.png'/></a>";
                            }
                        }
                    }
                    
                    /* uploadCartaIdentitaRetro */
                    if($rowVTABI['uploadCartaIdentitaRetro'] != "" || $rowVTABI['uploadCartaIdentitaRetro'] != NULL){
                        $fileName = $rowVTABI['uploadCartaIdentitaRetro'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/servizi/uploads/assegno_maternita/'.$rowVTABI['uploadCartaIdentitaRetro'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='./media/images/icons/pdf.png'/></a>";
                            }else{
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='./media/images/icons/jpg.png'/></a>";
                            }
                        }
                    }

                    /* uploadTitoloSoggiorno */
                    if($rowVTABI['uploadTitoloSoggiorno'] != "" || $rowVTABI['uploadTitoloSoggiorno'] != NULL){
                        $fileName = $rowVTABI['uploadTitoloSoggiorno'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/servizi/uploads/assegno_maternita/'.$rowVTABI['uploadTitoloSoggiorno'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadTitoloSoggiorno']."' target='_blank'><img src='./media/images/icons/pdf.png'/></a>";
                            }else{
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadTitoloSoggiorno']."' target='_blank'><img src='./media/images/icons/jpg.png'/></a>";
                            }
                        }
                    }

                    /* uploadDichiarazioneDatoreLavoro */
                    if($rowVTABI['uploadDichiarazioneDatoreLavoro'] != "" || $rowVTABI['uploadDichiarazioneDatoreLavoro'] != NULL){
                        $fileName = $rowVTABI['uploadDichiarazioneDatoreLavoro'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/servizi/uploads/assegno_maternita/'.$rowVTABI['uploadDichiarazioneDatoreLavoro'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadDichiarazioneDatoreLavoro']."' target='_blank'><img src='./media/images/icons/pdf.png'/></a>";
                            }else{
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadDichiarazioneDatoreLavoro']."' target='_blank'><img src='./media/images/icons/jpg.png'/></a>";
                            }
                        }
                    }

                    if(($rowVTABI['uploadCartaIdentitaFronte'] != "" || $rowVTABI['uploadCartaIdentitaFronte'] != NULL) || ($rowVTABI['uploadCartaIdentitaRetro'] != "" || $rowVTABI['uploadCartaIdentitaRetro'] != NULL) || ($rowVTABI['uploadTitoloSoggiorno'] != "" || $rowVTABI['uploadTitoloSoggiorno'] != NULL) || ($rowVTABI['uploadDichiarazioneDatoreLavoro'] != "" || $rowVTABI['uploadDichiarazioneDatoreLavoro'] != NULL)){
                        $returnText .= "</div>";
                    }
                    
                }
                
                return $returnText;
            }
            $connessioneVTABI->close();
            break;
        case 11:
            /* domanda_contributo */
            $connessioneVTABI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT uploadPotereFirma, uploadDocumentazione FROM domanda_contributo WHERE id = ". $PraticaId;
            $resultVTABI = $connessioneVTABI->query($sqlVTABI);
            if ($resultVTABI->num_rows > 0) {
                while($rowVTABI = $resultVTABI->fetch_assoc()) {
                    
                    $returnText = "";
                    
                    if(($rowVTABI['uploadPotereFirma'] != "" || $rowVTABI['uploadPotereFirma'] != NULL) || ($rowVTABI['uploadDocumentazione'] != "" || $rowVTABI['uploadDocumentazione'] != NULL)){
                        $returnText .= "<div class='col-lg-12'><p class='text-allegati-xsmall'>ALLEGATI</p>";
                    }
                    
                    /* potere firma */
                    if($rowVTABI['uploadPotereFirma'] != "" || $rowVTABI['uploadPotereFirma'] != NULL){
                        $fileName = $rowVTABI['uploadPotereFirma'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/servizi/uploads/domanda_contributo/'.$rowVTABI['uploadPotereFirma'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/domanda_contributo/".$rowVTABI['uploadPotereFirma']."' target='_blank'><img src='./media/images/icons/pdf.png'/></a>";
                            }else{
                                $returnText .= "<a href='./uploads/domanda_contributo/".$rowVTABI['uploadPotereFirma']."' target='_blank'><img src='./media/images/icons/jpg.png'/></a>";
                            }
                        }
                    }
                    
                    /* documentazione */
                    if($rowVTABI['uploadDocumentazione'] != "" || $rowVTABI['uploadDocumentazione'] != NULL){
                        $tmpUploadDocumentazione1 = substr($rowVTABI["uploadDocumentazione"],0,-1);
                        $tmpUploadDocumentaziones = explode(';', $tmpUploadDocumentazione1);
                        $uploadDocumentazione = "";
                        foreach($tmpUploadDocumentaziones as $tmpUploadDocumentazione) {
                            $fileNameParts = explode('.', $tmpUploadDocumentazione);
                            $ext = end($fileNameParts);
                            
                            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/servizi/uploads/domanda_contributo/'.$tmpUploadDocumentazione)){
                                if( $ext == "pdf"){
                                    $returnText .="<a href='./uploads/domanda_contributo/".$tmpUploadDocumentazione."' target='_blank'><img src='./media/images/icons/pdf.png'/></a>";
                                }else{
                                    $returnText .="<a href='./uploads/domanda_contributo/".$tmpUploadDocumentazione."' target='_blank'><img src='./media/images/icons/jpg.png'/></a>";
                                }
                            }
                        }
                    }
                    if(($rowVTABI['uploadPotereFirma'] != "" || $rowVTABI['uploadPotereFirma'] != NULL) || ($rowVTABI['uploadDocumentazione'] != "" || $rowVTABI['uploadDocumentazione'] != NULL)){
                        $returnText .= "</div>";
                    }
                }
                return $returnText;
            }
            $connessioneVTABI->close();
            break;
    }    
}

function DownloadRicevutaById($ServizioId,$PraticaId){
    $configDB = require './env/config.php';
    
    switch($ServizioId) {
        case 9: 
            /* assegno_maternita */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT status_id FROM assegno_maternita WHERE id = ". $PraticaId;
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if($rowDRBI['status_id'] > 1){
                        return '<div class="col-lg-12 text-center"><p class="text-allegati-xsmall">RICEVUTA</p>
                        <form action="./lib/tcpdf/TCPDF-master/examples/am_pdf_pratica.php" method="POST" id="am_frm_download_pdf" name="am_frm_download_pdf">
                            <input type="hidden" name="am_download_pdf_id" id="am_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="am_download_pdf_pratica" id="am_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="./media/images/icons/pdf.png" border="0" alt="Submit" />
                        </form></div>';
                    }
                }
            }
            $connessioneDRBI->close();
            break;
        case 11:
            /* domanda_contributo */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT status_id FROM domanda_contributo WHERE id = ". $PraticaId;
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if($rowDRBI['status_id'] > 1){
                        return '<div class="col-lg-12 text-center"><p class="text-allegati-xsmall">RICEVUTA</p>
                        <form action="./lib/tcpdf/TCPDF-master/examples/dc_pdf_pratica.php" method="POST" id="dc_frm_download_pdf" name="dc_frm_download_pdf">
                            <input type="hidden" name="dc_download_pdf_id" id="dc_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="dc_download_pdf_pratica" id="dc_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="./media/images/icons/pdf.png" border="0" alt="Submit" />
                        </form></div>';
                    }
                }
            }
            $connessioneDRBI->close();
            break;
    }
}    

function DownloadPraticaById($ServizioId,$PraticaId){
    $configDB = require './env/config.php';
    
    switch($ServizioId) {
        case 9: 
            /* assegno_maternita */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT NumeroPratica FROM assegno_maternita WHERE id = ". $PraticaId ." AND status_id > 1";
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    return "<div class='col-lg-12 text-center'><p class='text-allegati-xsmall'>PRATICA</p><a href='./uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='./media/images/icons/pdf.png' alt='Pratica ".$rowDRBI['NumeroPratica']."' title='Pratica ".$rowDRBI['NumeroPratica']."' /></a></div>";
                }
            }
            $connessioneDRBI->close();
            break;
        case 11:
            /* domanda_contributo */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT NumeroPratica FROM domanda_contributo WHERE id = ". $PraticaId ." AND status_id > 1";
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    return "<div class='col-lg-12 text-center'><p class='text-allegati-xsmall'>PRATICA</p><a href='./uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='./media/images/icons/pdf.png' alt='Pratica ".$rowDRBI['NumeroPratica']."' title='Pratica ".$rowDRBI['NumeroPratica']."' /></a></div>";
                }
            }
            $connessioneDRBI->close();
            break;
    }                              
}