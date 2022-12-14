<?php
/* resetto eventuali session ancora aperte */
session_start();
if (!empty(trim($_SESSION["CF"]))){
    unset($_SESSION["CF"]);
    unset($_SESSION["Nome"]);
    unset($_SESSION["Cognome"]);
    unset($_SESSION["Email"]);
}

/* file di inclusione */
    $configDB = require 'env/config.php';
    
/* mi connetto al DB per vedere se il codice fiscale è già presente nell'anagrafica */
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

    $sql = "SELECT * FROM anagrafica WHERE CodiceFiscale='DRLPLA80S48L400S'";
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
        $sql = "INSERT INTO `anagrafica`(`CodiceFiscale`, `Nome`, `Cognome`, `Email`, `DataNascita`, `LuogoNascita`) VALUES ('GCFLGA52M15F244X','Luigia','Giucofferi','prova1@prova.it','1952/03/15', 'Carvico (BG)')";
        $result = $connessione->query($sql);
        $cf = 'DPLPLA80S48L400S';
        $nome = 'Giovanna';
        $cognome = 'Rossi';
        $email = 'prova@prova.it';
    }
    $connessione->close();

    /* inizializzo le Session. */
    $_SESSION['CF'] = $cf;
    $_SESSION['Nome'] = $nome;
    $_SESSION['Cognome'] = $cognome;
    $_SESSION['Email'] = $email;
    
    /* faccio il redirect alla dashboard del cliente */
    
    header("location: ./bacheca.php");
    /* TO DO */
    /* fare i diversi redirect in base al post che ci arriva dal sito del comune */
