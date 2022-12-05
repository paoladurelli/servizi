<?php
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    
    $sql = "CALL View_messaggi('".$_SESSION['CF']."')";
    $result = $connessione->query($sql);
   
    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $date = date_create($row["data_msg"]);
            
            echo '<div class="card shadow-sm mb-3 px-4 pt-4 pb-4">
                <div class="card-header border-0 p-0 m-0">
                    <date class="date-xsmall">'.date_format($date,"d/m/Y").'</date>
                </div>
                <div class="card-body p-0 my-2">
                    <h3 class="title-small-semi-bold t-primary m-0 mb-1"><a href="messaggi_view.php?rif='.$row["messaggi_id"].'" class="text-decoration-none">'.$row["NomeServizio"].'</a></h3>
                    <p class="text-paragraph text-truncate">'.substr($row["testo"],0,40).'...</p>
                </div>
                </div>';
        }
    } else {
        echo "Nessun messaggio presente";
    }
    $connessione->close();                                            
