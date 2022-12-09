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
                    return "<p class='text-paragraph'>C.F. del beneficiario: ". $rowCABPI["beneficiarioCf"] . "</p>";
                }
            }
            $connessioneCABPI->close();
            break;
    }

}

