<?php
/* resetto eventuali session ancora aperte */
session_start();
if (!empty($_SESSION["CF"])){
    unset($_SESSION["CF"]);
    unset($_SESSION["Nome"]);
    unset($_SESSION["Cognome"]);
    unset($_SESSION["Email"]);
}


if(!empty($_POST['cf'])){
/* leggo il form che mi viene mandato dal sito */
    $nome = $_POST['name'];
    $cognome = $_POST['surname'];
    $cf = $_POST['cf'];
    $datanascita = $_POST['data_nascita'];
    $luogonascita = $_POST['luogo_nascita'] .' ('.$_POST['provincia_nascita'].')';
    $email = $_POST['mail'];
    $servizio = $_POST["servizio_id"];

/* file di inclusione */
    $configDB = require 'env/config.php';
    
/* mi connetto al DB per vedere se il codice fiscale è già presente nell'anagrafica */
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

    $sql = "SELECT * FROM anagrafica WHERE CodiceFiscale='" . $cf . "'";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        /* Codice fiscale esistente. */
        while($row = $result->fetch_assoc()) {
            $cf = $row["CodiceFiscale"];
            $nome = $row["Nome"];
            $cognome = $row["Cognome"];
            $email = $row["Email"];
        }
    } else {
        /*Codice Fiscale Inesistente, lo creo */
        $sql = "INSERT INTO `anagrafica`(`CodiceFiscale`, `Nome`, `Cognome`, `Email`, `DataNascita`, `LuogoNascita`) VALUES ('".$cf."','".$nome."','".$cognome."','".$email."','".$datanascita."','".$luogonascita."')";
        $result = $connessione->query($sql);
    }
    $connessione->close();

    /* inizializzo le Session. */
    $_SESSION['CF'] = $cf;
    $_SESSION['Nome'] = $nome;
    $_SESSION['Cognome'] = $cognome;
    $_SESSION['Email'] = $email;
    
    if($servizio == ''){
        /* se non è segnalato alcun servizio, faccio il redirect alla dashboard del cliente */
        header("location: ./bacheca.php");
    }else{
        /* faccio i diversi redirect in base al post che ci arriva dal sito del comune */
        header("location: ./".$servizio);
    }
}else{
    header("location: https://www.nuovoportale.proximalab.it/area-riservata");
    die();
}
