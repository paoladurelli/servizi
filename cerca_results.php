<?php
/* file di inclusione */
    $configDB = require 'env/config.php';
    
/* mi connetto al DB */
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

    $search = $_GET['txt'];
    $resultText = '';

/* vado a cercare nella tabella Servizi il nome delle tabelle dei servizi attivi */
    $sql = "SELECT LinkServizio,PrefissoServizio,NomeServizio FROM servizi WHERE Attivo = 1";
    $result = $connessione->query($sql);
    $FinalCount = 0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            
            $table = $row['LinkServizio'];
            $prefix = $row['PrefissoServizio'];
            $NomeServizio = $row['NomeServizio'];
            
            $sqlMain = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_NAME = '".$table."' AND TABLE_SCHEMA = '".$configDB['db_name']."'";
            
            /* estraggo i campi della tabella del servizio che sto analizzando */
            $columns = $connessione->query($sqlMain);

            /*metto ciuscun like in un array*/
            $queryLikes = array();
            while ($column = mysqli_fetch_assoc($columns)) {
                $queryLikes[] = $column['COLUMN_NAME'] . " LIKE '%$search%'";
            }

            /* faccio partire la ricerca con i filtri */
            $query = "SELECT * FROM ".$table." WHERE richiedenteCf LIKE '".$_SESSION['CF']."' AND (" . implode(" OR ", $queryLikes) . ")";
    
            $FinalResult = $connessione->query($query);
            
            $FinalCount = $FinalCount + $FinalResult->num_rows;
            
            if ($FinalResult->num_rows > 0) {
                while($FinalRow = $FinalResult->fetch_assoc()) {
                    if($FinalRow['NumeroPratica'] != ''){
                        $resultText .= '<li class="mb-10"><a href="' . $row["LinkServizio"] . '/dettaglio.php?'.$prefix.'pratica_id='.$FinalRow['id'].'"><b>'.$NomeServizio.'</b> - Consulta la pratica '.$FinalRow['NumeroPratica'].'</a></li>';
                    }else{
                        $resultText .= '<li class="mb-10"><a href="' . $row["LinkServizio"] . '/compilazione_dati.php?'.$prefix.'bozza_id='.$FinalRow['id'].'"><b>'.$NomeServizio.'</b> - Completa la bozza</a></li>';
                    }
                }
            }
        }
    }

    /* output Finale */
    if($FinalCount > 0){
        echo '<div class="row">';
            echo '<div class="col-12">';
            echo '<p>Trovati '.$FinalCount.' risultati</p>';
                echo '<ul>';    
                    echo $resultText;
                echo '</ul>';
            echo '</div>';
        echo '</div>';
    }else{
        echo '<div class="row">';
            echo '<div class="col-12">';
                echo 'Per questa ricerca non è stata trovata alcuna pratica';
            echo '</div>';
        echo '</div>';
    }