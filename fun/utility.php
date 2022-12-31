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

function isValidPartitaIva($partitaivaOrig){
    $partitaiva = trim($partitaivaOrig);
    if (strlen($partitaiva) == 11) {
            $tot = 0;
            $dispari = 0;
      	
        for($i = 0; $i < 10; $i += 2)
            $dispari += substr($partitaiva, $i, 1);
      
        for($i = 1; $i < 10; $i += 2) {
            $tot = substr($partitaiva, $i, 1) * 2;
            $tot = ($tot / 10) + ($tot % 10);
            $dispari += $tot;
        }
      				
        $controllo = substr($partitaiva,10, 1);
      				
        if((($dispari % 10) == 0 && ($controllo == 0)) || ((10 - ($dispari % 10)) == $controllo)) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function isValidIBAN($iban){
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

function isValidCarta($carta){
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

/* CALL MENU - start */
function ViewMenuPratiche($selected){
    $selectedIcon = '<span class="active"><svg class="icon me-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right-circle"></use></svg>';
    $menuText = '<div class="col-12 p-0 menu-servizi">
        <div class="cmp-nav-tab mb-4 mb-lg-5 mt-lg-4">
            <div class="row">
                <div class="col-lg-3 text-center">';
                if($selected == 1){ $menuText .= $selectedIcon; }
                $menuText .= 'INFORMATIVA SULLA PRIVACY</div>
                <div class="col-lg-3 text-center">';
                if($selected == 2){ $menuText .= $selectedIcon; }
                $menuText .= 'COMPILAZIONE DATI</span></div>
                <div class="col-lg-3 text-center">';
                if($selected == 3){ $menuText .= $selectedIcon; }
                $menuText .= 'TERMINI E CONDIZIONI</div>
                <div class="col-lg-3 text-center">';
                if($selected == 4){ $menuText .= $selectedIcon; }
                $menuText .= 'RIEPILOGO</div>
            </div>
        </div>
    </div>';
    return $menuText;
}
/* CALL MENU - end */


function NomeServizioById($Servizio_id){
    $configDB = require './env/config.php';
    $connessioneNomeServizioById = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlNomeServizioById = "SELECT NomeServizio FROM servizi WHERE id = ". $Servizio_id;
    $resultNomeServizioById = $connessioneNomeServizioById->query($sqlNomeServizioById);
    if ($resultNomeServizioById->num_rows > 0) {
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
        case 5: $table = "pubblicazione_matrimonio"; break;
        case 6: $table = "accesso_atti"; break;
        case 9: $table = "assegno_maternita"; break;
        case 10: $table = "bonus_economici"; break;
        case 11: $table = "domanda_contributo"; break;
        case 16: $table = "partecipazione_concorso"; break;
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
        case 5:
            /* pubblicazione_matrimonio */
            $configDB = require './env/config.php';
            $connessioneCABPI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlCABPI = "SELECT coniugeCf FROM pubblicazione_matrimonio WHERE id = ". $pratica_id;
            $resultCABPI = $connessioneCABPI->query($sqlCABPI);
            if ($resultCABPI->num_rows > 0) {
                while($rowCABPI = $resultCABPI->fetch_assoc()) {
                    return "<p class='mb-1'>C.F. del coniuge: ". $rowCABPI["coniugeCf"] . "</p>";
                }
            }
            $connessioneCABPI->close();
            break;
        case 6:
            /* accesso_atti */
            return "";
            break;
        case 9: 
            /* assegno_maternita */
            return "";
            break;
        case 10: 
            /* bonus_economici */
            $configDB = require './env/config.php';
            $connessioneCABPI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlCABPI = "SELECT beneficiarioCf FROM bonus_economici WHERE id = ". $pratica_id;
            $resultCABPI = $connessioneCABPI->query($sqlCABPI);
            if ($resultCABPI->num_rows > 0) {
                while($rowCABPI = $resultCABPI->fetch_assoc()) {
                    return "<p class='mb-1'>C.F. del beneficiario: ". $rowCABPI["beneficiarioCf"] . "</p>";
                }
            }
            $connessioneCABPI->close();
            break;
        case 11: 
            /* domanda_contributo */
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
        case 16: 
            /* partecipazione_concorso */
            return "";
            break;
    }

}

function ViewThumbAllegatiById($ServizioId,$PraticaId){
    $configDB = require './env/config.php';
    switch($ServizioId) {
        case 5:
            /* pubblicazione_matrimonio */
            return "";
            break;
        case 6:
            /* accesso_atti */
            $connessioneVTABI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT uploadTitoloDichiarato, uploadAffittuario, uploadAltroSoggetto, uploadNotaioRogante, uploadAltriTitoloDescrizione, uploadCartaIdentitaFronte, uploadCartaIdentitaRetro, uploadAttoNotarile, NumeroPratica FROM accesso_atti WHERE id = ". $PraticaId;
            $resultVTABI = $connessioneVTABI->query($sqlVTABI);
            if ($resultVTABI->num_rows > 0) {
                while($rowVTABI = $resultVTABI->fetch_assoc()) {
                    $returnText = "";
                    /* uploadTitoloDichiarato */
                    if($rowVTABI['uploadTitoloDichiarato'] != "" || $rowVTABI['uploadTitoloDichiarato'] != NULL){
                        $fileName = $rowVTABI['uploadTitoloDichiarato'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/accesso_atti/'.$rowVTABI['uploadTitoloDichiarato'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadTitoloDichiarato']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Documentazione comprovante il titolo dichiarato' title='Documentazione comprovante il titolo dichiarato' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadTitoloDichiarato']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Documentazione comprovante il titolo dichiarato' title='Documentazione comprovante il titolo dichiarato' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadAffittuario */
                    if($rowVTABI['uploadAffittuario'] != "" || $rowVTABI['uploadAffittuario'] != NULL){
                        $fileName = $rowVTABI['uploadAffittuario'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/accesso_atti/'.$rowVTABI['uploadAffittuario'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadAffittuario']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Documentazione dichiarante che il soggetto è l'affittuario dell'immobile oggetto del procedimento' title='Documentazione dichiarante che il soggetto è l'affittuario dell'immobile oggetto del procedimento' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadAffittuario']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Documentazione dichiarante che il soggetto è l'affittuario dell'immobile oggetto del procedimento' title='Documentazione dichiarante che il soggetto è l'affittuario dell'immobile oggetto del procedimento' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadAltroSoggetto */
                    if($rowVTABI['uploadAltroSoggetto'] != "" || $rowVTABI['uploadAltroSoggetto'] != NULL){
                        $fileName = $rowVTABI['uploadAltroSoggetto'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/accesso_atti/'.$rowVTABI['uploadAltroSoggetto'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadAltroSoggetto']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Documentazione comprovante il titolo di 'Altro soggetto'' title='Documentazione comprovante il titolo di 'Altro soggetto'' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadAltroSoggetto']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Documentazione comprovante il titolo di 'Altro soggetto'' title='Documentazione comprovante il titolo di 'Altro soggetto'' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadNotaioRogante */
                    if($rowVTABI['uploadNotaioRogante'] != "" || $rowVTABI['uploadNotaioRogante'] != NULL){
                        $fileName = $rowVTABI['uploadNotaioRogante'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/accesso_atti/'.$rowVTABI['uploadNotaioRogante'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadNotaioRogante']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Documentazione comprovante il titolo dichiarato di 'notaio rogante'' title='Documentazione comprovante il titolo dichiarato di 'notaio rogante'' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadNotaioRogante']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Documentazione comprovante il titolo dichiarato di 'notaio rogante'' title='Documentazione comprovante il titolo dichiarato di 'notaio rogante'' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadAltriTitoloDescrizione */
                    if($rowVTABI['uploadAltriTitoloDescrizione'] != "" || $rowVTABI['uploadAltriTitoloDescrizione'] != NULL){
                        $fileName = $rowVTABI['uploadAltriTitoloDescrizione'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/accesso_atti/'.$rowVTABI['uploadAltriTitoloDescrizione'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadAltriTitoloDescrizione']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Documentazione comprovante il titolo dichiarato di 'altro titolo -> descrizione titolo'' title='Documentazione comprovante il titolo dichiarato di 'altro titolo -> descrizione titolo'' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadAltriTitoloDescrizione']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Documentazione comprovante il titolo dichiarato di 'altro titolo -> descrizione titolo'' title='Documentazione comprovante il titolo dichiarato di 'altro titolo -> descrizione titolo'' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadCartaIdentitaFronte*/
                    if($rowVTABI['uploadCartaIdentitaFronte'] != "" || $rowVTABI['uploadCartaIdentitaFronte'] != NULL){
                        $fileName = $rowVTABI['uploadCartaIdentitaFronte'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/accesso_atti/'.$rowVTABI['uploadCartaIdentitaFronte'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadCartaIdentitaRetro */
                    if($rowVTABI['uploadCartaIdentitaRetro'] != "" || $rowVTABI['uploadCartaIdentitaRetro'] != NULL){
                        $fileName = $rowVTABI['uploadCartaIdentitaRetro'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/accesso_atti/'.$rowVTABI['uploadCartaIdentitaRetro'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadAttoNotarile */
                    if($rowVTABI['uploadAttoNotarile'] != "" || $rowVTABI['uploadAttoNotarile'] != NULL){
                        $fileName = $rowVTABI['uploadAttoNotarile'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/accesso_atti/'.$rowVTABI['uploadAttoNotarile'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadAttoNotarile']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Atto notarile con il quale è stata conferita la procura' title='Atto notarile con il quale è stata conferita la procura' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/accesso_atti/".$rowVTABI['uploadAttoNotarile']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Atto notarile con il quale è stata conferita la procura' title='Atto notarile con il quale è stata conferita la procura' class='thumb-view' /></a>";
                            }
                        }
                    }
                }
                return $returnText;
            }
            $connessioneVTABI->close();
            break;
        case 9: 
            /* assegno_maternita */
            $connessioneVTABI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT uploadCartaIdentitaFronte, uploadCartaIdentitaRetro, uploadTitoloSoggiorno, uploadDichiarazioneDatoreLavoro, NumeroPratica FROM assegno_maternita WHERE id = ". $PraticaId;
            $resultVTABI = $connessioneVTABI->query($sqlVTABI);
            if ($resultVTABI->num_rows > 0) {
                while($rowVTABI = $resultVTABI->fetch_assoc()) {
                    $returnText = "";
                    /* uploadCartaIdentitaFronte*/
                    if($rowVTABI['uploadCartaIdentitaFronte'] != "" || $rowVTABI['uploadCartaIdentitaFronte'] != NULL){
                        $fileName = $rowVTABI['uploadCartaIdentitaFronte'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/assegno_maternita/'.$rowVTABI['uploadCartaIdentitaFronte'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadCartaIdentitaRetro */
                    if($rowVTABI['uploadCartaIdentitaRetro'] != "" || $rowVTABI['uploadCartaIdentitaRetro'] != NULL){
                       $fileName = $rowVTABI['uploadCartaIdentitaRetro'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/assegno_maternita/'.$rowVTABI['uploadCartaIdentitaRetro'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadTitoloSoggiorno */
                    if($rowVTABI['uploadTitoloSoggiorno'] != "" || $rowVTABI['uploadTitoloSoggiorno'] != NULL){
                        $fileName = $rowVTABI['uploadTitoloSoggiorno'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/assegno_maternita/'.$rowVTABI['uploadTitoloSoggiorno'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadTitoloSoggiorno']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Titolo di Soggiorno' title='Titolo di Soggiorno' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadTitoloSoggiorno']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Titolo di Soggiorno' title='Titolo di Soggiorno' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadDichiarazioneDatoreLavoro */
                    if($rowVTABI['uploadDichiarazioneDatoreLavoro'] != "" || $rowVTABI['uploadDichiarazioneDatoreLavoro'] != NULL){
                        $fileName = $rowVTABI['uploadDichiarazioneDatoreLavoro'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/assegno_maternita/'.$rowVTABI['uploadDichiarazioneDatoreLavoro'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadDichiarazioneDatoreLavoro']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Dichiarazione del Datore di Lavoro' title='Dichiarazione del Datore di Lavoro' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/assegno_maternita/".$rowVTABI['uploadDichiarazioneDatoreLavoro']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Dichiarazione del Datore di Lavoro' title='Dichiarazione del Datore di Lavoro' class='thumb-view' /></a>";
                            }
                        }
                    }
                }
                return $returnText;
            }
            $connessioneVTABI->close();
            break;
        case 10:
            /* bonus_economici */
            $connessioneVTABI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT uploadPotereFirma, uploadIsee, uploadDocumentazione, NumeroPratica FROM bonus_economici WHERE id = ". $PraticaId;
            $resultVTABI = $connessioneVTABI->query($sqlVTABI);
            if ($resultVTABI->num_rows > 0) {
                while($rowVTABI = $resultVTABI->fetch_assoc()) {
                    $returnText = "";
                    /* potere firma */
                    if($rowVTABI['uploadPotereFirma'] != "" || $rowVTABI['uploadPotereFirma'] != NULL){
                        $fileName = $rowVTABI['uploadPotereFirma'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/bonus_economici/'.$rowVTABI['uploadPotereFirma'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/bonus_economici/".$rowVTABI['uploadPotereFirma']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Potere di Firma' title='Potere di Firma' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/bonus_economici/".$rowVTABI['uploadPotereFirma']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Potere di Firma' title='Potere di Firma' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* Isee */
                    if($rowVTABI['uploadIsee'] != "" || $rowVTABI['uploadIsee'] != NULL){
                        $fileName = $rowVTABI['uploadIsee'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/bonus_economici/'.$rowVTABI['uploadIsee'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/bonus_economici/".$rowVTABI['uploadIsee']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='ISEE' title='ISEE' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/bonus_economici/".$rowVTABI['uploadIsee']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='ISEE' title='ISEE' class='thumb-view' /></a>";
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
                            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/bonus_economici/'.$tmpUploadDocumentazione)){
                                if( $ext == "pdf"){
                                    $returnText .="<a href='./uploads/bonus_economici/".$tmpUploadDocumentazione."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Documentazione' title='Documentazione' class='thumb-view' /></a>";
                                }else{
                                    $returnText .="<a href='./uploads/bonus_economici/".$tmpUploadDocumentazione."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Documentazione' title='Documentazione' class='thumb-view' /></a>";
                                }
                            }
                        }
                    }
                }
                return $returnText;
            }
            $connessioneVTABI->close();
            break;
        case 11:
            /* domanda_contributo */
            $connessioneVTABI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT uploadPotereFirma, uploadDocumentazione, NumeroPratica FROM domanda_contributo WHERE id = ". $PraticaId;
            $resultVTABI = $connessioneVTABI->query($sqlVTABI);
            if ($resultVTABI->num_rows > 0) {
                while($rowVTABI = $resultVTABI->fetch_assoc()) {
                    $returnText = "";
                    /* potere firma */
                    if($rowVTABI['uploadPotereFirma'] != "" || $rowVTABI['uploadPotereFirma'] != NULL){
                        $fileName = $rowVTABI['uploadPotereFirma'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/domanda_contributo/'.$rowVTABI['uploadPotereFirma'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/domanda_contributo/".$rowVTABI['uploadPotereFirma']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Potere di Firma' title='Potere di Firma' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/domanda_contributo/".$rowVTABI['uploadPotereFirma']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Potere di Firma' title='Potere di Firma' class='thumb-view' /></a>";
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
                            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/domanda_contributo/'.$tmpUploadDocumentazione)){
                                if( $ext == "pdf"){
                                    $returnText .="<a href='./uploads/domanda_contributo/".$tmpUploadDocumentazione."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Documentazione' title='Documentazione' class='thumb-view' /></a>";
                                }else{
                                    $returnText .="<a href='./uploads/domanda_contributo/".$tmpUploadDocumentazione."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Documentazione' title='Documentazione' class='thumb-view' /></a>";
                                }
                            }
                        }
                    }
                }
                return $returnText;
            }
            $connessioneVTABI->close();
            break;
        case 16: 
            /* partecipazione_concorso */
            $connessioneVTABI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT uploadCartaIdentitaFronte,uploadCartaIdentitaRetro,uploadCV,uploadTitoliPreferenza,NumeroPratica FROM partecipazione_concorso WHERE id = ". $PraticaId;
            $resultVTABI = $connessioneVTABI->query($sqlVTABI);
            if ($resultVTABI->num_rows > 0) {
                while($rowVTABI = $resultVTABI->fetch_assoc()) {
                    $returnText = "";
                    /* uploadCartaIdentitaFronte*/
                    if($rowVTABI['uploadCartaIdentitaFronte'] != "" || $rowVTABI['uploadCartaIdentitaFronte'] != NULL){
                        $fileName = $rowVTABI['uploadCartaIdentitaFronte'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/partecipazione_concorso/'.$rowVTABI['uploadCartaIdentitaFronte'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/partecipazione_concorso/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/partecipazione_concorso/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadCartaIdentitaRetro */
                    if($rowVTABI['uploadCartaIdentitaRetro'] != "" || $rowVTABI['uploadCartaIdentitaRetro'] != NULL){
                        $fileName = $rowVTABI['uploadCartaIdentitaRetro'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/partecipazione_concorso/'.$rowVTABI['uploadCartaIdentitaRetro'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/partecipazione_concorso/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/partecipazione_concorso/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadCV */
                    if($rowVTABI['uploadCV'] != "" || $rowVTABI['uploadCV'] != NULL){
                        $fileName = $rowVTABI['uploadCV'];
                        $fileNameParts = explode('.', $fileName);
                        $ext = end($fileNameParts);
                        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/partecipazione_concorso/'.$rowVTABI['uploadCV'])){
                            if( $ext == "pdf"){
                                $returnText .= "<a href='./uploads/partecipazione_concorso/".$rowVTABI['uploadCV']."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Curriculum Vitae' title='Curriculum Vitae' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='./uploads/partecipazione_concorso/".$rowVTABI['uploadCV']."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Curriculum Vitae' title='Curriculum Vitae' class='thumb-view' /></a>";
                            }
                        }
                    }
                    /* uploadTitoliPreferenza */
                    if($rowVTABI['uploadTitoliPreferenza'] != "" || $rowVTABI['uploadTitoliPreferenza'] != NULL){
                        $tmpUploadTitoliPreferenza1 = substr($rowVTABI["uploadTitoliPreferenza"],0,-1);
                        $tmpUploadTitoliPreferenzas = explode(';', $tmpUploadTitoliPreferenza1);
                        $uploadTitoliPreferenza = "";
                        foreach($tmpUploadTitoliPreferenzas as $tmpUploadTitoliPreferenza) {
                            $fileNameParts = explode('.', $tmpUploadTitoliPreferenza);
                            $ext = end($fileNameParts);                            
                            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/partecipazione_concorso/'.$tmpUploadTitoliPreferenza)){
                                if( $ext == "pdf"){
                                    $returnText .="<a href='./uploads/partecipazione_concorso/".$tmpUploadTitoliPreferenza."' target='_blank'><img src='./media/images/icons/pdf.png' alt='Titoli di Preferenza' title='Titoli di Preferenza' class='thumb-view' /></a>";
                                }else{
                                    $returnText .="<a href='./uploads/partecipazione_concorso/".$tmpUploadTitoliPreferenza."' target='_blank'><img src='./media/images/icons/jpg.png' alt='Titoli di Preferenza' title='Titoli di Preferenza' class='thumb-view' /></a>";
                                }
                            }
                        }
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
        case 5:
            /* pubblicazione_matrimonio */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT status_id FROM pubblicazione_matrimonio WHERE id = ". $PraticaId;
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if($rowDRBI['status_id'] > 1){
                        return '
                        <form action="./lib/tcpdf/TCPDF-master/examples/pm_pdf_pratica.php" method="POST" id="pm_frm_download_pdf" name="pm_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="pm_download_pdf_id" id="pm_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="pm_download_pdf_pratica" id="pm_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="./media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
                        </form>';
                    }
                }
            }
            $connessioneDRBI->close();
            break;
        case 6:
            /* accesso_atti */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT status_id FROM accesso_atti WHERE id = ". $PraticaId;
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if($rowDRBI['status_id'] > 1){
                        return '
                        <form action="./lib/tcpdf/TCPDF-master/examples/aa_pdf_pratica.php" method="POST" id="aa_frm_download_pdf" name="aa_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="aa_download_pdf_id" id="aa_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="aa_download_pdf_pratica" id="aa_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="./media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
                        </form>';
                    }
                }
            }
            $connessioneDRBI->close();
            break;
        case 9: 
            /* assegno_maternita */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT status_id FROM assegno_maternita WHERE id = ". $PraticaId;
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if($rowDRBI['status_id'] > 1){
                        return '
                        <form action="./lib/tcpdf/TCPDF-master/examples/am_pdf_pratica.php" method="POST" id="am_frm_download_pdf" name="am_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="am_download_pdf_id" id="am_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="am_download_pdf_pratica" id="am_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="./media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
                        </form>';
                    }
                }
            }
            $connessioneDRBI->close();
            break;
        case 10:
            /* bonus_economici */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT status_id FROM bonus_economici WHERE id = ". $PraticaId;
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if($rowDRBI['status_id'] > 1){
                        return '
                        <form action="./lib/tcpdf/TCPDF-master/examples/be_pdf_pratica.php" method="POST" id="be_frm_download_pdf" name="be_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="be_download_pdf_id" id="be_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="be_download_pdf_pratica" id="be_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="./media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
                        </form>';
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
                        return '
                        <form action="./lib/tcpdf/TCPDF-master/examples/dc_pdf_pratica.php" method="POST" id="dc_frm_download_pdf" name="dc_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="dc_download_pdf_id" id="dc_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="dc_download_pdf_pratica" id="dc_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="./media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
                        </form>';
                    }
                }
            }
            $connessioneDRBI->close();
            break;
        case 16: 
            /* partecipazione_concorso */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT status_id FROM partecipazione_concorso WHERE id = ". $PraticaId;
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if($rowDRBI['status_id'] > 1){
                        return '
                        <form action="./lib/tcpdf/TCPDF-master/examples/pc_pdf_pratica.php" method="POST" id="pc_frm_download_pdf" name="pc_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="pc_download_pdf_id" id="pc_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="pc_download_pdf_pratica" id="pc_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="./media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
                        </form>';
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
        case 5:
            /* pubblicazione_matrimonio */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT NumeroPratica FROM pubblicazione_matrimonio WHERE id = ". $PraticaId ." AND status_id > 1";
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/pratiche/'.$rowDRBI['NumeroPratica'].'.pdf')){
                        return "<a href='./uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='./media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
                    }
                }
            }
            $connessioneDRBI->close();
            break;
        case 6:
            /* accesso_atti */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT NumeroPratica FROM accesso_atti WHERE id = ". $PraticaId ." AND status_id > 1";
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/pratiche/'.$rowDRBI['NumeroPratica'].'.pdf')){
                        return "<a href='./uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='./media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
                    }
                }
            }
            $connessioneDRBI->close();
            break;
        case 9: 
            /* assegno_maternita */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT NumeroPratica FROM assegno_maternita WHERE id = ". $PraticaId ." AND status_id > 1";
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/pratiche/'.$rowDRBI['NumeroPratica'].'.pdf')){
                        return "<a href='./uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='./media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
                    }
                }
            }
            $connessioneDRBI->close();
            break;
        case 10:
            /* bonus_economici */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT NumeroPratica FROM bonus_economici WHERE id = ". $PraticaId ." AND status_id > 1";
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/pratiche/'.$rowDRBI['NumeroPratica'].'.pdf')){
                        return "<a href='./uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='./media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
                    }
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
                    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/pratiche/'.$rowDRBI['NumeroPratica'].'.pdf')){
                        return "<a href='./uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='./media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
                    }
                }
            }
            $connessioneDRBI->close();
            break;
        case 16: 
            /* partecipazione_concorso */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT NumeroPratica FROM partecipazione_concorso WHERE id = ". $PraticaId ." AND status_id > 1";
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/pratiche/'.$rowDRBI['NumeroPratica'].'.pdf')){
                        return "<a href='./uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='./media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
                    }
                }
            }
            $connessioneDRBI->close();
            break;
    }                              
}

function ConcorsoById($ConcorsoId){
    $configDB = require '../env/config.php';
    $connessioneCBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlCBI = "SELECT testo as Concorso FROM `concorsi` WHERE id = ". $ConcorsoId;
    $resultCBI = $connessioneCBI->query($sqlCBI);
    if ($resultCBI->num_rows > 0) {
        while($rowCBI = $resultCBI->fetch_assoc()) {
            return $rowCBI['Concorso'];
        }
    }
    $connessioneCBI->close();
}

function GetDataScadenzaConcorsoById($PraticaId){
    $configDB = require '../env/config.php';
    $connessioneGDSCBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlGDSCBI = "SELECT concorsi.scadenza as DataScadenza FROM partecipazione_concorso LEFT JOIN concorsi ON partecipazione_concorso.ConcorsoId = concorsi.id WHERE partecipazione_concorso.id = ". $PraticaId;
    $resultGDSCBI = $connessioneGDSCBI->query($sqlGDSCBI);    
    if ($resultGDSCBI->num_rows > 0) {
        while($rowGDSCBI = $resultGDSCBI->fetch_assoc()) {
            $Date = $rowGDSCBI["DataScadenza"];
            return '<span class="date-step-giorno">' . date('d', strtotime($Date)). '</span><br><span class="date-step-mese">'. date('M/Y', strtotime($Date)) . '</span>';
        }
    }
    $connessioneGDSCBI->close();
}

function LoadSelectUfficioDestinatario($ufficioDestinatarioId){
    $configDB = require '../env/config.php';
    $txtOption = "";
    $connessioneLSUD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlLSUD = "SELECT * FROM uffici ORDER BY sort ASC";
    $resultLSUD = $connessioneLSUD->query($sqlLSUD);    
    if ($resultLSUD->num_rows > 0) {
        while($rowLSUD = $resultLSUD->fetch_assoc()) {
            $txtOption .= "<option value='" . $rowLSUD["Id"] . "'";
                if($rowLSUD["Id"] == $ufficioDestinatarioId){
                    $txtOption .= " selected";
                }
            $txtOption .= ">" . $rowLSUD["Nome"] . "</option>";
        }
    }
    $connessioneLSUD->close();
    
    return $txtOption;
}

function LoadTextUfficioDestinatario($ufficioDestinatarioId){
    $configDB = require '../env/config.php';
    $txtOption = "";
    $connessioneLSUD = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlLSUD = "SELECT * FROM uffici WHERE Id = ". $ufficioDestinatarioId;
    $resultLSUD = $connessioneLSUD->query($sqlLSUD);    
    if ($resultLSUD->num_rows > 0) {
        while($rowLSUD = $resultLSUD->fetch_assoc()) {
            $txtOption .= $rowLSUD["Nome"];
        }
    }
    $connessioneLSUD->close();
    
    return $txtOption;
}

function UfficioDestinatarioById($ufficioDestinatarioId){
    $configDB = require '../env/config.php';
    $connessioneUDBY = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlUDBY = "SELECT Nome FROM uffici WHERE Id = ". $ufficioDestinatarioId;
    $resultUDBY = $connessioneUDBY->query($sqlUDBY);    
    if ($resultUDBY->num_rows > 0) {
        while($rowUDBY = $resultUDBY->fetch_assoc()) {
            return $rowUDBY["Nome"];
        }
    }
    $connessioneUDBY->close();
}

function CreateTempTable(){
    $configDB = require './env/config.php';
    $connessioneCTT = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlCTT = "SELECT LinkServizio FROM servizi WHERE Attivo = 1";
    $resultCTT = $connessioneCTT->query($sqlCTT);
    if ($resultCTT->num_rows > 0) {
        $i = 1;
        $tmpTable = "";
        while($rowCTT = $resultCTT->fetch_assoc()) {
            $tmpTable .= "select t".$i.".id as id, t".$i.".NumeroPratica as NumeroPratica, t".$i.".richiedenteCf as CodiceFiscale, t".$i.".status_id as StatusId, t".$i.".data_compilazione as DataCompilazione from ".$rowCTT["LinkServizio"]." t".$i." union ";
            $i++;
        }
    }
    $connessioneCTT->close();
    
    $tmpTable = substr($tmpTable, 0, -6);
            
    return $tmpTable;
}

function MenuAttivita($CodiceFiscale,$SelectedService = null){
    $configDB = require './env/config.php';
    $connessioneMA = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlMA = "SELECT id,LinkServizio FROM servizi WHERE Attivo = 1";
    $resultMA = $connessioneMA->query($sqlMA);
    if ($resultMA->num_rows > 0) {
        $menuAttivita = "";
        while($rowMA = $resultMA->fetch_assoc()) {
            $menuAttivita .= '<li class="nav-item"><a class="';
            if($SelectedService == $rowMA['id']){
                $menuAttivita .= ' active" href="#"';
            }else{
                $menuAttivita .= '" href="servizio_list.php?sid='.$rowMA['id'].'"';
            }
            $menuAttivita .= '><span class="title-medium">'.ucfirst(str_replace("_"," ",$rowMA["LinkServizio"])).'</span><span class="float-right menu-numbers">'.CountServizio($CodiceFiscale,$rowMA["LinkServizio"]).'</span></a></li>';
        }
    }
    $connessioneMA->close();
    
    return $menuAttivita;
}

function CountServizio($CodiceFiscale,$Table){
    $configDB = require './env/config.php';
    $connessioneCS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlCS = "SELECT Count(id) as CountServiceRows FROM ".$Table." WHERE richiedenteCf = '".$CodiceFiscale."' AND status_id > 1";
    $resultCS = $connessioneCS->query($sqlCS);
    if ($resultCS->num_rows > 0) {
        while($rowCS = $resultCS->fetch_assoc()) {
            $countServizio = $rowCS["CountServiceRows"];
        }
    }
    $connessioneCS->close();
    return $countServizio;
}
function countSent($cf,$sid = null){
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountSent FROM attivita
        WHERE cf = '".$cf."'";
        if($sid != null){
            $sql .= " AND servizio_id = '".$sid."'";
        }
        $sql .= " AND status_id > 0";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            return $row['CountSent'];
        }
    }
    $connessione->close();
}

function ProgressBarInviate($cf,$sid = null){
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountSent FROM attivita
        WHERE cf = '".$cf."'";
        if($sid != null){
            $sql .= " AND servizio_id = '".$sid."'";
        }
        $sql .= " AND status_id > 1";
    $result = $connessione->query($sql);
   
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $countSent = $row['CountSent'];
            $percentageSent = ($countSent*100)/countSent($cf,$sid);
        }
    }
    $connessione->close();
    return '<div class="col-lg-3 col-6 text-center">
        <svg class="radial-progress sent" data-percentage="'.$percentageSent.'" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">'.$countSent.'</text>
        </svg>
        <p>Pratiche inviate</p>
    </div>';
}    
 
function ProgressBarInLavorazione($cf,$sid = null){
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountWorking FROM attivita
        WHERE attivita.cf = '".$cf."'";
        if($sid != null){
            $sql .= " AND servizio_id = '".$sid."'";
        }
        $sql .= " AND attivita.status_id = 3";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $countWorking = $row['CountWorking'];
            $percentageWorking = ($countWorking*100)/countSent($cf,$sid);
        }
    }
    $connessione->close();
    return '<div class="col-lg-3 col-6 text-center">
        <svg class="radial-progress working" data-percentage="'.$percentageWorking.'" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">'.$countWorking.'</text>
        </svg>
        <p>Pratiche in lavorazione</p>
    </div>';
}

function ProgressBarAccettate($cf,$sid = null){
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountAccepted FROM attivita
        WHERE attivita.cf = '".$cf."'";
        if($sid != null){
            $sql .= " AND servizio_id = '".$sid."'";
        }
        $sql .= " AND attivita.status_id = 4";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $countAccepted = $row['CountAccepted'];
            $percentageAccepted = ($countAccepted*100)/countSent($cf,$sid);
        }
    }
    $connessione->close();
    return '<div class="col-lg-3 col-6 text-center">
        <svg class="radial-progress accepted" data-percentage="'.$percentageAccepted.'" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">'.$countAccepted.'</text>
        </svg>
        <p>Pratiche accettate</p>
    </div>';    
}

function ProgressBarRifiutate($cf,$sid = null){
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountRefused FROM attivita
        WHERE attivita.cf = '".$cf."'";
        if($sid != null){
            $sql .= " AND servizio_id = '".$sid."'";
        }
        $sql .= " AND attivita.status_id = 5";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $countRefused = $row['CountRefused'];
            $percentageRefused = ($countRefused*100)/countSent($cf,$sid);
        }
    }
    $connessione->close();
    return '<div class="col-lg-3 col-6 text-center">
        <svg class="radial-progress refused" data-percentage="'.$percentageRefused.'" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
            <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">'.$countRefused.'</text>
        </svg>
        <p>Pratiche rifiutate</p>
    </div>';
}

function ProgressBarBozze($cf){
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountSent, servizio_id AS ServizioId FROM attivita
        WHERE cf = '".$cf."'
        AND status_id = 1
        GROUP BY ServizioId";
    $result = $connessione->query($sql);
    $return = '';
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $countSent = $row['CountSent'];
            $percentageSent = ($countSent*100)/$countSent;
            $return .='<div class="col-lg-3 col-6 text-center">
                <svg class="radial-progress draft" data-percentage="'.$percentageSent.'" viewBox="0 0 80 80">
                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                    <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">'.$countSent.'</text>
                </svg>
                <p>'.NomeServizioById($row['ServizioId']).'</p>
            </div>';
        }
    }
    $connessione->close();
    return $return;
}

function LegendaStatus(){
    $configDB = require './env/config.php';
    $connessioneLS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlLS = "SELECT * FROM status ORDER BY sort";
    $resultLS = $connessioneLS->query($sqlLS);
    $TextToReturn = '';
    if ($resultLS->num_rows > 0) {
        $numResults = $resultLS->num_rows;
        $TextToReturn = '<div class="row box-legenda d-lg-none">
            <div class="col-12">
                <div class="row">
                    <div class="col-12 mb-3">
                        <p class="title-xsmall">LEGENDA</p>
                    </div>
                </div>';
                $counter = 0;
                while($rowLS = $resultLS->fetch_assoc()) {
                    if (++$counter == $numResults) {
                        $TextToReturn .= '<div class="row mb-2">';
                    }else{
                        $TextToReturn .= '<div class="row mb-4">';
                    }
                        $TextToReturn .= '<div class="col-2">
                            <img src=".\media\images\icons\status_'.$rowLS["id"].'.png" title="'.$rowLS["nome"].'" alt="'.$rowLS["nome"].'"/>
                        </div>
                        <div class="col-10">
                            <p>'.$rowLS["nome"].'</p>
                        </div>
                    </div>';
                }

            $TextToReturn .= '</div>
        </div>';
    }
    $connessioneLS->close();
    return $TextToReturn;
}

function CheckRatingByCfService($cf,$servizio){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT id AS Checked FROM rating
        WHERE userCf = '".$cf."'
        AND ServizioId = '".$servizio."'";
    $result = $connessione->query($sql);
    $return = '';
    if ($result->num_rows > 0) {
        return true;
    }else{
        return false;
    }
    $connessione->close();
}

function CallRatingLayout($prefix,$praticai,$servizio){
    
    $html = '<div class="it-page-section mb-50 mb-lg-90" id="'.$prefix.'valuta_servizio">
        <div class="cmp-card">
            <div class="card">
                <div class="card-header border-0 p-0 mb-lg-30 m-0">
                    <div>
                        <h2 class="title-xxlarge mb-3">Valuta il servizio</h2>
                    </div>
                </div>
                <div class="card-body" style="margin-bottom:40px;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="risultato-rating" class="text-center">Votazione inviata correttamente.</div>
                            <div class="rating-box" id="rating-box">
                                <div class="feed_title">Quanto è stato facile usare questo servizio?</div>
                                <div id="tutorial">
                                    <input type="hidden" name="userCf" id="userCf" value="'.$_SESSION['CF'].'" />
                                    <input type="hidden" name="ServizioId" id="ServizioId" value="'.$servizio.'" />
                                    <input type="hidden" name="PraticaId" id="PraticaId" value="'.$praticai.'" />
                                    <input type="hidden" name="rating" id="rating" value="" />
                                    <ul>';
                                        $i = 0;
                                        for ($i = 0; $i <= 4; $i ++) {
                                            $html .= '<li id="star-'.$i.'" onmouseover="highlightStar('.$i.');" onClick="addRating('.$i.');">&#9733;</li>';
                                        }
                                        $html .= '<div id="loader-icon">
                                            <img src="./media/images/loader.gif" id="image-size" />
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <div id="valutazione_positiva" class="hide">
                                <div class="feed_title">Quali sono stati gli aspetti che hai preferito?</div>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="positiva" id="positiva1" value="1" />
                                        <label class="form-check-label" for="positiva1">Le indicazioni erano chiare;</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="positiva" id="positiva2" value="2" />
                                        <label class="form-check-label" for="positiva2">Le indicazioni erano complete;</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="positiva" id="positiva3" value="3" />
                                        <label class="form-check-label" for="positiva3">Capivo sempre che stavo procedendo correttamente;</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="positiva" id="positiva4" value="4" />
                                        <label class="form-check-label" for="positiva4">Non ho avuto problemi tecnici;</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="positiva" id="positiva5" value="5" />
                                        <label class="form-check-label" for="positiva5">Altro.</label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" id="commento_positivo_txt">
                                            <textarea id="commento_positivo" name="commento_positivo" rows="4" placeholder="Breve commento"></textarea>
                                        </label>
                                    </div>
                                    <button type="button" id="btn_invia_feedback_positivo" name="btn_invia_feedback_positivo" class="btn btn-primary">Invia Feedback <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
                                </div>
                            </div>
                            <div id="valutazione_negativa" class="hide">
                                <div class="feed_title">Dove hai incontrato le maggiori difficoltà?</div>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="negativa" id="negativa1" value="1" />
                                        <label class="form-check-label" for="negativa1">A volte le indicazioni non erano chiare;</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="negativa" id="negativa2" value="2" />
                                        <label class="form-check-label" for="negativa2">A volte le indicazioni non erano complete;</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="negativa" id="negativa3" value="3" />
                                        <label class="form-check-label" for="negativa3">A volte non capivo se stavo procedendo correttamente;</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="negativa" id="negativa4" value="4" />
                                        <label class="form-check-label" for="negativa4">Ho avuto problemi tecnici;</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="negativa" id="negativa5" value="5" />
                                        <label class="form-check-label" for="negativa5">Altro.</label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label" id="commento_negativo_txt">
                                            <textarea id="commento_negativo" name="commento_negativo" rows="4" placeholder="Breve commento"></textarea>
                                        </label>
                                    </div>
                                    <button type="button" id="btn_invia_feedback_negativo" name="btn_invia_feedback_negativo" class="btn btn-primary">Invia Feedback <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true"><use href="../lib/svg/sprites.svg#it-arrow-right"></use></svg></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    return $html;
}