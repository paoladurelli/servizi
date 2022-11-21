<?php

/* file di inclusione */
    $configDB = require 'env/config.php';
    
/* mi connetto al DB per vedere se il codice fiscale è già presente nell'anagrafica */
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

    $sql = "SELECT * FROM servizi WHERE attivo=1";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="row">';
        /* Codice fiscale esistente. */
        while($row = $result->fetch_assoc()) {
            echo '<div class="col-md-3">' . $row["NomeServizio"] . '</div>';
        }
        echo '</div>';
    }