<?php

/* FUNZIONI PER LA PROTOCOLLAZIONE - start */
function getNumeroProtocollo(){
    $configDB = require '../env/config.php';
    $connessioneGNP = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlGNP = "SELECT * FROM config_settings WHERE id = 1";
    $resultGNP = $connessioneGNP->query($sqlGNP);
    if ($resultGNP->num_rows > 0) {
        while($rowGNP = $resultGNP->fetch_assoc()) {
            $startValue = $rowGNP["value"];
            $prefix = $rowGNP["prefix"];
            $suffix = $rowGNP["suffix"];
        }
    }
    $connessioneGNP->close();
    
    $numberProtocolloTmp = substr($startValue, -6);
    $numberProtocolloTmp2 = filter_var($numberProtocolloTmp, FILTER_SANITIZE_NUMBER_INT) + 1;
    $length = 6;
    $value = str_pad($numberProtocolloTmp2,$length,"0", STR_PAD_LEFT);
    
    return  $prefix.$value."/".$suffix;
}

function getNumeroProtocolloNumber(){
    $configDB = require '../env/config.php';
    $connessioneGNP = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlGNP = "SELECT * FROM config_settings WHERE id = 1";
    $resultGNP = $connessioneGNP->query($sqlGNP);
    if ($resultGNP->num_rows > 0) {
        while($rowGNP = $resultGNP->fetch_assoc()) {
            $startValue = $rowGNP["value"];
        }
    }
    $connessioneGNP->close();
    
    $numberProtocolloTmp = substr($startValue, -6);
    $numberProtocolloTmp2 = filter_var($numberProtocolloTmp, FILTER_SANITIZE_NUMBER_INT) + 1;
    $length = 6;
    $value = str_pad($numberProtocolloTmp2,$length,"0", STR_PAD_LEFT);
    
    return  $value;
}

function setNumeroProtocollo($numberProtocollo){
    $configDB = require '../env/config.php';
    $connessioneGNP = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlGNP = "UPDATE `config_settings` SET value='".$numberProtocollo."' WHERE id = 1";
    $resultGNP = $connessioneGNP->query($sqlGNP);
    if($resultGNP){
        return true;
    }else{
        return false;
    }
    $connessioneGNP->close();
}
/* FUNZIONI PER LA PROTOCOLLAZIONE - end */

/* FUNZIONI PER L'INVIO DI NOTIFICHE ALL'APP IO - start */
function SendToAppIo($table,$NumeroPratica){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT * FROM ".$table." WHERE richiedenteCf = '".$_SESSION['CF']."'";
    $result = $connessione->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $nome = $row['richiedenteNome'];
            $cognome = $row['richiedenteCognome'];
            $cf = $row['richiedenteCf'];
        }
    }
    $connessione->close();

    $cf_destinatario = $cf;
    $messaggio_per_user = 'Gentile '. $nome . ' '. $cognome . ',\n\n Ti avvisiamo che la tua pratica: <b>'.$NumeroPratica.'</b> è stata inviata. \n\n';
    $messaggio_per_user .= 'Cordiali saluti. \n\n';

/* leggo la chiave dal file di configurazione */
    $configIO = require '../env/config_io.php';
    if($configIO[$table] == ''){
        $appio_key = $configIO['default'];
    }else{
        $appio_key = $configIO[$table];
    }
    
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.io.italia.it/api/v1/profiles/' . strtoupper($cf_destinatario),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Ocp-Apim-Subscription-Key:' . $appio_key .''
        ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    $array = json_decode($response, true);
    if ($array['sender_allowed']) {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.io.italia.it/api/v1/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{
          "time_to_live": 3600,
          "content": {
            "subject": "Avviso Invio pratica",
            "markdown": "'. $messaggio_per_user.'"
          },
          "fiscal_code": "'. strtoupper($cf_destinatario) .'"
        }',
            CURLOPT_HTTPHEADER => array(
                'Ocp-Apim-Subscription-Key:' .$appio_key . '',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
    }
}
/* FUNZIONI PER L'INVIO DI NOTIFICHE ALL'APP IO - end */

/* LOAD SOCIAL - start */
function LoadSocial(){
    $configSOCIAL = require '../env/config_social.php';

    $social = '<ul class="list-inline text-left social mt-15">';
        if($configSOCIAL['facebook'] != ''){
            $social .= '<li class="list-inline-item"><a class="text-white" href="'.$configSOCIAL['facebook'].'" target="_blank"><svg class="icon"><use href="../lib/svg/sprites.svg#it-facebook" xlink:href="../lib/sprites.svg#it-facebook"></use></svg></a></li>';
        }
        if($configSOCIAL['instagram'] != ''){
            $social .= '<li class="list-inline-item"><a class="text-white" href="'.$configSOCIAL['instagram'].'" target="_blank"><svg class="icon"><use href="../lib/svg/sprites.svg#it-instagram" xlink:href="../lib/svg/sprites.svg#it-instagram"></use></svg></a></li>';
        }
        if($configSOCIAL['linkedin'] != ''){
            $social .= '<li class="list-inline-item"><a class="text-white" href="'.$configSOCIAL['linkedin'].'" target="_blank"><svg class="icon"><use href="../lib/svg/sprites.svg#it-linkedin" xlink:href="../lib/svg/sprites.svg#it-linkedin"></use></svg></a></li>';
        }
        if($configSOCIAL['rss'] != ''){
            $social .= '<li class="list-inline-item"><a class="text-white" href="'.$configSOCIAL['rss'].'" target="_blank"><svg class="icon"><use href="../lib/svg/sprites.svg#it-rss" xlink:href="../lib/svg/sprites.svg#it-rss"></use></svg></a></li>';
        }
        if($configSOCIAL['twitter'] != ''){
            $social .= '<li class="list-inline-item"><a class="text-white" href="'.$configSOCIAL['twitter'].'" target="_blank"><svg class="icon"><use href="../lib/svg/sprites.svg#it-twitter" xlink:href="../lib/svg/sprites.svg#it-twitter"></use></svg></a></li>';
        }
        if($configSOCIAL['telegram'] != ''){
            $social .= '<li class="list-inline-item"><a class="text-white" href="'.$configSOCIAL['telegram'].'" target="_blank"><svg class="icon"><use href="../lib/svg/sprites.svg#it-telegram" xlink:href="../lib/svg/sprites.svg#it-telegram"></use></svg></a></li>';
        }
        if($configSOCIAL['whatsapp'] != ''){
            $social .= '<li class="list-inline-item"><a class="text-white" href="'.$configSOCIAL['whatsapp'].'" target="_blank"><svg class="icon"><use href="../lib/svg/sprites.svg#it-whatsapp" xlink:href="../lib/svg/sprites.svg#it-whatsapp"></use></svg></a></li>';
        }
        if($configSOCIAL['youtube'] != ''){
            $social .= '<li class="list-inline-item"><a class="text-white" href="'.$configSOCIAL['youtube'].'" target="_blank"><svg class="icon"><use href="../lib/svg/sprites.svg#it-youtube" xlink:href="../lib/svg/sprites.svg#it-youtube"></use></svg></a></li>';
        }
    $social .= '</ul>';
    
    return $social;
}
/* LOAD SOCIAL - end */

/* LOAD MENU - start */
function ViewMenuMain($selected = null){
    $tags[] = '';
        switch($selected) {
        case 1: 
            $tags[1] = ' active" href="#"';
            $tags[2] = '" href="messaggi_list.php"';
            $tags[3] = '" href="pratiche_list.php"';
            $tags[4] = '" href="servizi_list.php"';
            break;
        case 2: 
            $tags[1] = '" href="bacheca.php"';
            $tags[2] = ' active" href="#"';
            $tags[3] = '" href="pratiche_list.php"';
            $tags[4] = '" href="servizi_list.php"';
            break;
        case 3: 
            $tags[1] = '" href="bacheca.php"';
            $tags[2] = '" href="messaggi_list.php"';
            $tags[3] = ' active" href="#"';
            $tags[4] = '" href="servizi_list.php"';
            break;
        case 4: 
            $tags[1] = '" href="bacheca.php"';
            $tags[2] = '" href="messaggi_list.php"';
            $tags[3] = '" href="pratiche_list.php"';
            $tags[4] = ' active" href="#"';
            break;
        default :
            $tags[1] = '" href="bacheca.php"';
            $tags[2] = '" href="messaggi_list.php"';
            $tags[3] = '" href="pratiche_list.php"';
            $tags[4] = '" href="servizi_list.php"';
            break;
    }
    $menumain = '<div class="col-12 p-0">
        <div class="cmp-nav-tab mb-3 mb-lg-3 mt-lg-3">
            <ul class="nav nav-tabs nav-tabs-icon-text w-100 flex-nowrap">
                <li class="nav-item w-100 me-2 p-1">
                    <a class="nav-link text-center pe-lg-none pb-lg-15 ps-lg-3 me-xl-5 text-tab'.$tags[1].'>
                        <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true">
                            <use href="../lib/svg/sprites.svg#it-pa"></use>
                        </svg>
                        <span class="d-none d-xl-block">Scrivania</span>
                    </a>
                </li>
                <li class="nav-item w-100 me-2 p-1">
                    <a class="nav-link text-center pe-lg-none pb-lg-15 ps-lg-3 me-xl-5 text-tab'.$tags[3].'>
                        <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true">
                            <use href="../lib/svg/sprites.svg#it-files"></use>
                        </svg>
                        <span class="d-none d-xl-block">Pratiche</span>
                    </a>
                </li>
                <li class="nav-item w-100 me-2 p-1">
                    <a class="nav-link text-center pe-lg-none pb-lg-15 ps-lg-3 me-xl-5 text-tab'.$tags[4].'>
                        <svg class="icon me-0 me-lg-1 mr-lg-10" aria-hidden="true">
                            <use href="../lib/svg/sprites.svg#it-settings"></use>
                        </svg>
                        <span class="d-none d-xl-block">Servizi</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>';
    return $menumain;
}

function MenuPratiche($SelectedType = null){
    $menuPratiche = '';
    /* ricevute */
    $menuPratiche .= '<li class="nav-item"><a class="';
    if($SelectedType == 'I'){
        $menuPratiche .= ' active" href="#"';
    }else{
        $menuPratiche .= '" href="praticheRicevute_list.php"';
    }
    $menuPratiche .= '><span class="title-medium">Pratiche Ricevute</span><span class="float-right menu-numbers">'.CountPraticheRicevute().'</span></a></li>';
    
    /* in lavorazione */
    $menuPratiche .= '<li class="nav-item"><a class="';
    if($SelectedType == 'L'){
        $menuPratiche .= ' active" href="#"';
    }else{
        $menuPratiche .= '" href="praticheLavorazione_list.php"';
    }
    $menuPratiche .= '><span class="title-medium">Pratiche in Lavorazione</span><span class="float-right menu-numbers">'.CountPraticheInLavorazione().'</span></a></li>';
    
    /* confermate */
    $menuPratiche .= '<li class="nav-item"><a class="';
    if($SelectedType == 'A'){
        $menuPratiche .= ' active" href="#"';
    }else{
        $menuPratiche .= '" href="praticheAccettate_list.php"';
    }
    $menuPratiche .= '><span class="title-medium">Pratiche Accettate</span><span class="float-right menu-numbers">'.CountPraticheAccettate().'</span></a></li>';    
    
    /* rifiutate */
    $menuPratiche .= '<li class="nav-item"><a class="';
    if($SelectedType == 'R'){
        $menuPratiche .= ' active" href="#"';
    }else{
        $menuPratiche .= '" href="praticheRifiutate_list.php"';
    }
    $menuPratiche .= '><span class="title-medium">Pratiche Rifiutate</span><span class="float-right menu-numbers">'.CountPraticheRifiutate().'</span></a></li>';
    
    return $menuPratiche;
}


/* LOAD MENU - end */

/* FUNZIONI PER I SERVIZI - start */
function NomeServizioById($Servizio_id){
    $configDB = require '../env/config.php';
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
    $configDB = require '../env/config.php';
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
    $configDB = require '../env/config.php';
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

function MenuServizi($SelectedService = null){
    $configDB = require '../env/config.php';
    $connessioneMS = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sqlMS = "SELECT id,LinkServizio FROM servizi WHERE Attivo = 1";
    $resultMS = $connessioneMS->query($sqlMS);
    if ($resultMS->num_rows > 0) {
        $menuServizi = "";
        while($rowMS = $resultMS->fetch_assoc()) {
            $menuServizi .= '<li class="nav-item"><a class="';
            if($SelectedService == $rowMS['id']){
                $menuServizi .= ' active" href="#"';
            }else{
                $menuServizi .= '" href="#?sid='.$rowMS['id'].'"';
            }
            $menuServizi .= '><span class="title-medium">'.ucfirst(str_replace("_"," ",$rowMS["LinkServizio"])).'</span></a></li>';
        }
    }
    $connessioneMS->close();
    
    return $menuServizi;
}

function MenuDettaglioServizi($urlComune,$mailComune){
    $menuDettaglioServizi = '';
    $menuDettaglioServizi .= '<li><a href="#a_chi_rivolto">A chi è rivolto</a></li>';
    $menuDettaglioServizi .= '<li><a href="#contenuto">Descrizione</a></li>';
    $menuDettaglioServizi .= '<li><a href="#come_fare">Come fare</a></li>';
    $menuDettaglioServizi .= '<li><a href="#cosa_serve">Cosa serve</a></li>';
    $menuDettaglioServizi .= '<li><a href="#cosa_siottiene">Cosa si ottiene</a></li>';
    $menuDettaglioServizi .= '<li><a href="#tempi_scadenze">Tempi e scadenze</a></li>';
    $menuDettaglioServizi .= '<li><a href="#accedi_al_servizio">Accedi al servizio</a></li>';
    $menuDettaglioServizi .= '<li><a href="#accedi_al_servizio_digitale">Accedi al servizio digitale</a></li>';
    $menuDettaglioServizi .= '<li><a href="#contatti">Contatti</a></li>';
    $menuDettaglioServizi .= '<li><a href="'.$urlComune.'/prenotazione-appuntamento">Prenota Appuntamento</a></li>';
    $menuDettaglioServizi .= '<li><a href="mailto:'.$mailComune.'?subject=Segnalazione disservizio: Domanda per bonus economici">Segnalazione disservizio</a></li>';
    $menuDettaglioServizi .= '<li><a href="'.$urlComune.'/richiesta-assistenza">Richiesta assistenza</a></li>';
    
    return $menuDettaglioServizi;
}
/* FUNZIONI PER I SERVIZI - end */

/* FUNZIONI PER I METODI DI PAGAMENTO - start */
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

function ViewMetodiPagamento($selected = null){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT * FROM metodi_pagamento WHERE cf = '". $_SESSION['CF']."'";
    $result = $connessione->query($sql);
    $html = '<div id="pnl_metodi_pagamento">';
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $html .= '<div class="row">';
                $html .= '<div class="col-12 col-xl-9"><p class="form-check">';
                    $html .= '<input type="radio" class="form-check-input" id="ckb_pagamento'.$row['id'].'" name="ckb_pagamento" value="'.$row['id'].'" ';
                    if($row["predefinito"] == '1'){ 
                        $html .= 'checked'; 
                    }else{
                        if($row['id'] == $selected){
                            $html .= 'checked'; 
                        }
                    }
                    $html .= ' /><label class="form-check-label" for="ckb_pagamento'.$row['id'].'">' . NomeMetodoPagamentoById($row["tipo_pagamento"]) . ' ' . $row["numero_pagamento"].'</label>';
                $html .= '</p></div>';
                $html .= '<div class="col-12 col-xl-3 float-right mt-10">';
                $html .= '<a href="#" class="btn-small btn-secondary float-right metodi_pagamento_delete" id="'.$row['id'].'" alt="cancella metodo di pagamento" title="cancella metodo di pagamento">Elimina</a>';
                $html .= '<a href="#" class="btn-small btn-primary float-right metodi_pagamento_update mr-10" id="'.$row['id'].'" alt="modifica metodo di pagamento" title="modifica metodo di pagamento">Modifica</a>';
                $html .= '</div>';
            $html .= '</div>';
        }
    }
    $html .= '</div>
    <div class="row before-section-small mt-1">
        <div class="col-12 text-right">
            <button type="button" class="btn btn-primary pt-3" data-bs-toggle="modal" data-bs-target="#AddPagamentoModal"><svg class="icon"><use href="../lib/svg/sprites.svg#it-plus"></use></svg>Aggiungi</button>
        </div>
    </div>';
    $connessione->close();
    return $html;
}
/* FUNZIONI PER I METODI DI PAGAMENTO - end */

/* FUNZIONI ATTIVITA' - start */
function CreateLinkAttivita($ServizioId,$pratica_id){
    $prefissoServizio = PrefissoServizioById($ServizioId);
    $linkServizio = $prefissoServizio."dettaglio.php?pratica_id=".$pratica_id;
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
    $configDB = require '../env/config.php';
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
            $configDB = require '../env/config.php';
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
            $configDB = require '../env/config.php';
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
            $configDB = require '../env/config.php';
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
    $configDB = require '../env/config.php';
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
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadTitoloDichiarato']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Documentazione comprovante il titolo dichiarato' title='Documentazione comprovante il titolo dichiarato' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadTitoloDichiarato']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Documentazione comprovante il titolo dichiarato' title='Documentazione comprovante il titolo dichiarato' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadAffittuario']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Documentazione dichiarante che il soggetto è l'affittuario dell'immobile oggetto del procedimento' title='Documentazione dichiarante che il soggetto è l'affittuario dell'immobile oggetto del procedimento' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadAffittuario']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Documentazione dichiarante che il soggetto è l'affittuario dell'immobile oggetto del procedimento' title='Documentazione dichiarante che il soggetto è l'affittuario dell'immobile oggetto del procedimento' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadAltroSoggetto']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Documentazione comprovante il titolo di 'Altro soggetto'' title='Documentazione comprovante il titolo di 'Altro soggetto'' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadAltroSoggetto']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Documentazione comprovante il titolo di 'Altro soggetto'' title='Documentazione comprovante il titolo di 'Altro soggetto'' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadNotaioRogante']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Documentazione comprovante il titolo dichiarato di 'notaio rogante'' title='Documentazione comprovante il titolo dichiarato di 'notaio rogante'' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadNotaioRogante']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Documentazione comprovante il titolo dichiarato di 'notaio rogante'' title='Documentazione comprovante il titolo dichiarato di 'notaio rogante'' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadAltriTitoloDescrizione']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Documentazione comprovante il titolo dichiarato di 'altro titolo -> descrizione titolo'' title='Documentazione comprovante il titolo dichiarato di 'altro titolo -> descrizione titolo'' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadAltriTitoloDescrizione']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Documentazione comprovante il titolo dichiarato di 'altro titolo -> descrizione titolo'' title='Documentazione comprovante il titolo dichiarato di 'altro titolo -> descrizione titolo'' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadAttoNotarile']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Atto notarile con il quale è stata conferita la procura' title='Atto notarile con il quale è stata conferita la procura' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/accesso_atti/".$rowVTABI['uploadAttoNotarile']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Atto notarile con il quale è stata conferita la procura' title='Atto notarile con il quale è stata conferita la procura' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/assegno_maternita/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/assegno_maternita/".$rowVTABI['uploadTitoloSoggiorno']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Titolo di Soggiorno' title='Titolo di Soggiorno' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/assegno_maternita/".$rowVTABI['uploadTitoloSoggiorno']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Titolo di Soggiorno' title='Titolo di Soggiorno' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/assegno_maternita/".$rowVTABI['uploadDichiarazioneDatoreLavoro']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Dichiarazione del Datore di Lavoro' title='Dichiarazione del Datore di Lavoro' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/assegno_maternita/".$rowVTABI['uploadDichiarazioneDatoreLavoro']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Dichiarazione del Datore di Lavoro' title='Dichiarazione del Datore di Lavoro' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/bonus_economici/".$rowVTABI['uploadPotereFirma']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Potere di Firma' title='Potere di Firma' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/bonus_economici/".$rowVTABI['uploadPotereFirma']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Potere di Firma' title='Potere di Firma' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/bonus_economici/".$rowVTABI['uploadIsee']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='ISEE' title='ISEE' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/bonus_economici/".$rowVTABI['uploadIsee']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='ISEE' title='ISEE' class='thumb-view' /></a>";
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
                                    $returnText .="<a href='../uploads/bonus_economici/".$tmpUploadDocumentazione."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Documentazione' title='Documentazione' class='thumb-view' /></a>";
                                }else{
                                    $returnText .="<a href='../uploads/bonus_economici/".$tmpUploadDocumentazione."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Documentazione' title='Documentazione' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/domanda_contributo/".$rowVTABI['uploadPotereFirma']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Potere di Firma' title='Potere di Firma' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/domanda_contributo/".$rowVTABI['uploadPotereFirma']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Potere di Firma' title='Potere di Firma' class='thumb-view' /></a>";
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
                                    $returnText .="<a href='../uploads/domanda_contributo/".$tmpUploadDocumentazione."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Documentazione' title='Documentazione' class='thumb-view' /></a>";
                                }else{
                                    $returnText .="<a href='../uploads/domanda_contributo/".$tmpUploadDocumentazione."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Documentazione' title='Documentazione' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/partecipazione_concorso/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/partecipazione_concorso/".$rowVTABI['uploadCartaIdentitaFronte']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Carta Identita Fronte' title='Carta Identita Fronte' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/partecipazione_concorso/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/partecipazione_concorso/".$rowVTABI['uploadCartaIdentitaRetro']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Carta Identita Retro' title='Carta Identita Retro' class='thumb-view' /></a>";
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
                                $returnText .= "<a href='../uploads/partecipazione_concorso/".$rowVTABI['uploadCV']."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Curriculum Vitae' title='Curriculum Vitae' class='thumb-view' /></a>";
                            }else{
                                $returnText .= "<a href='../uploads/partecipazione_concorso/".$rowVTABI['uploadCV']."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Curriculum Vitae' title='Curriculum Vitae' class='thumb-view' /></a>";
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
                                    $returnText .="<a href='../uploads/partecipazione_concorso/".$tmpUploadTitoliPreferenza."' target='_blank'><img src='../media/images/icons/pdf.png' alt='Titoli di Preferenza' title='Titoli di Preferenza' class='thumb-view' /></a>";
                                }else{
                                    $returnText .="<a href='../uploads/partecipazione_concorso/".$tmpUploadTitoliPreferenza."' target='_blank'><img src='../media/images/icons/jpg.png' alt='Titoli di Preferenza' title='Titoli di Preferenza' class='thumb-view' /></a>";
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
    $configDB = require '../env/config.php';
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
                        <form action="../lib/tcpdf/TCPDF-master/examples/pm_pdf_pratica.php" method="POST" id="pm_frm_download_pdf" name="pm_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="pm_download_pdf_id" id="pm_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="pm_download_pdf_pratica" id="pm_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="../media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
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
                        <form action="../lib/tcpdf/TCPDF-master/examples/aa_pdf_pratica.php" method="POST" id="aa_frm_download_pdf" name="aa_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="aa_download_pdf_id" id="aa_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="aa_download_pdf_pratica" id="aa_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="../media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
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
                        <form action="../lib/tcpdf/TCPDF-master/examples/am_pdf_pratica.php" method="POST" id="am_frm_download_pdf" name="am_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="am_download_pdf_id" id="am_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="am_download_pdf_pratica" id="am_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="../media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
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
                        <form action="../lib/tcpdf/TCPDF-master/examples/be_pdf_pratica.php" method="POST" id="be_frm_download_pdf" name="be_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="be_download_pdf_id" id="be_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="be_download_pdf_pratica" id="be_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="../media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
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
                        <form action="../lib/tcpdf/TCPDF-master/examples/dc_pdf_pratica.php" method="POST" id="dc_frm_download_pdf" name="dc_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="dc_download_pdf_id" id="dc_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="dc_download_pdf_pratica" id="dc_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="../media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
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
                        <form action="../lib/tcpdf/TCPDF-master/examples/pc_pdf_pratica.php" method="POST" id="pc_frm_download_pdf" name="pc_frm_download_pdf" style="display: inline;">
                            <input type="hidden" name="pc_download_pdf_id" id="pc_download_pdf_id" value="'.$PraticaId.'" />
                            <input type="hidden" name="pc_download_pdf_pratica" id="pc_download_pdf_pratica" value="'.NumeroPraticaById($ServizioId,$PraticaId).'" />
                            <input type="image" name="submit" src="../media/images/icons/pdf.png" alt="Ricevuta" title="Ricevuta" border="0" alt="Submit" class="thumb-view" />
                        </form>';
                    }
                }
            }
            $connessioneDRBI->close();
            break;
    }
}    

function DownloadPraticaById($ServizioId,$PraticaId){
    $configDB = require '../env/config.php';
    switch($ServizioId) {
        case 5:
            /* pubblicazione_matrimonio */
            $connessioneDRBI = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
            $sqlVTABI = "SELECT NumeroPratica FROM pubblicazione_matrimonio WHERE id = ". $PraticaId ." AND status_id > 1";
            $resultDRBI = $connessioneDRBI->query($sqlVTABI);
            if ($resultDRBI->num_rows > 0) {
                while($rowDRBI = $resultDRBI->fetch_assoc()) {
                    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/uploads/pratiche/'.$rowDRBI['NumeroPratica'].'.pdf')){
                        return "<a href='../uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='../media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
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
                        return "<a href='../uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='../media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
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
                        return "<a href='../uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='../media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
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
                        return "<a href='../uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='../media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
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
                        return "<a href='../uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='../media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
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
                        return "<a href='../uploads/pratiche/".$rowDRBI['NumeroPratica'].".pdf' target='_blank'><img src='../media/images/icons/pdf.png' alt='Pratica' title='Pratica' class='thumb-view' /></a>";
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

function countSent(){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountSent FROM attivita WHERE status_id > 0";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            return $row['CountSent'];
        }
    }
    $connessione->close();
}

function CountPraticheRicevute(){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountSent FROM attivita WHERE status_id = 2";
    $result = $connessione->query($sql);
   
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['CountSent'] > 0){
                $countSent = $row['CountSent'];
            }else{
                $countSent = 0;
            }
        }
    }
    $connessione->close();
    return $countSent;
}    
 
function CountPraticheInLavorazione(){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountWorking FROM attivita WHERE status_id = 3";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['CountWorking'] > 0){
                $countWorking = $row['CountWorking'];
            }else{
                $countWorking = 0;
            }
        }
    }
    $connessione->close();
    return $countWorking;
}

function CountPraticheAccettate(){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountAccepted FROM attivita WHERE status_id = 4";
    $result = $connessione->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['CountAccepted'] > 0){
                $countAccepted = $row['CountAccepted'];
            }else{
                $countAccepted = 0;
            }
        }
    }
    $connessione->close();
    return $countAccepted;
}

function CountPraticheRifiutate(){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountRefused FROM attivita WHERE status_id = 5";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['CountRefused'] > 0){
                $countRefused = $row['CountRefused'];
            }else{
                $countRefused = 0;
            }
        }
    }
    $connessione->close();
    return $countRefused;
}

function ProgressBarRicevute(){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountSent FROM attivita WHERE status_id > 1";
    $result = $connessione->query($sql);
   
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['CountSent'] > 0){
                $countSent = $row['CountSent'];
                $percentageSent = ($countSent*100)/countSent();
            }else{
                $countSent = 0;
                $percentageSent = 0;
            }
        }
    }
    $connessione->close();
    return '<svg class="radial-progress sent" data-percentage="'.$percentageSent.'" viewBox="0 0 80 80">
        <circle class="incomplete" cx="40" cy="40" r="35"></circle>
        <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
        <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">'.$countSent.'</text>
    </svg>
    <p>Pratiche inviate</p>';
}    
 
function ProgressBarInLavorazione(){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountWorking FROM attivita WHERE status_id = 3";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['CountWorking'] > 0){
                $countWorking = $row['CountWorking'];
                $percentageWorking = ($countWorking*100)/countSent();
            }else{
                $countWorking = 0;
                $percentageWorking = 0;
            }
        }
    }
    $connessione->close();
    return '<svg class="radial-progress working" data-percentage="'.$percentageWorking.'" viewBox="0 0 80 80">
        <circle class="incomplete" cx="40" cy="40" r="35"></circle>
        <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
        <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">'.$countWorking.'</text>
    </svg>
    <p>Pratiche in lavorazione</p>';
}

function ProgressBarAccettate(){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountAccepted FROM attivita WHERE status_id = 4";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['CountAccepted'] > 0){
                $countAccepted = $row['CountAccepted'];
                $percentageAccepted = ($countAccepted*100)/countSent();
            }else{
                $countAccepted = 0;
                $percentageAccepted = 0;
            }
        }
    }
    $connessione->close();
    return '<svg class="radial-progress accepted" data-percentage="'.$percentageAccepted.'" viewBox="0 0 80 80">
        <circle class="incomplete" cx="40" cy="40" r="35"></circle>
        <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
        <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">'.$countAccepted.'</text>
    </svg>
    <p>Pratiche accettate</p>';
}

function ProgressBarRifiutate(){
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "SELECT COUNT(id) AS CountRefused FROM attivita WHERE status_id = 5";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($row['CountRefused'] > 0){
                $countRefused = $row['CountRefused'];
                $percentageRefused = ($countRefused*100)/countSent();
            }else{
                $countRefused = 0;
                $percentageRefused = 0;
            }
        }
    }
    $connessione->close();
    return '<svg class="radial-progress refused" data-percentage="'.$percentageRefused.'" viewBox="0 0 80 80">
        <circle class="incomplete" cx="40" cy="40" r="35"></circle>
        <circle class="complete" cx="40" cy="40" r="35" style="stroke-dashoffset: 220;"></circle>
        <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)">'.$countRefused.'</text>
    </svg>
    <p>Pratiche rifiutate</p>';
}

function LegendaStatus(){
    $configDB = require '../env/config.php';
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
                            <img src="..\media\images\icons\status_'.$rowLS["id"].'.png" title="'.$rowLS["nome"].'" alt="'.$rowLS["nome"].'"/>
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
/* funzioni ATTIVITA' - end */
