<?php
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    
    $sql = "SELECT messaggi.id as messaggi_id, messaggi.testo, messaggi.data_msg, servizi.NomeServizio as NomeServizio FROM messaggi
            LEFT JOIN servizi ON messaggi.servizio_id = servizi.id 
            WHERE messaggi.CF_to = '".$_SESSION['CF']."'
            ORDER BY messaggi.data_msg DESC, messaggi.id DESC
            LIMIT 4";
    $result = $connessione->query($sql);
   
    if ($result->num_rows > 0) {
    // output data of each row
        $i=1;

        while($row = $result->fetch_assoc()) {
            $date = date_create($row["data_msg"]);
            
            echo '<div class="col-lg-6">
                <div class="card shadow-sm mb-4 px-4 pt-4 pb-4">
                    <div class="card-header border-0 p-0 m-0">
                        <date class="date-xsmall">'.date_format($date,"d/m/Y").'</date>
                    </div>
                    <div class="card-body p-0 mb-2">
                        <p class="title-small-semi-bold t-primary m-0 mb-1">'.$row["NomeServizio"].'</p>
                        <p class="text-paragraph">'.$row["testo"].'</p>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <a class="btn-small btn-secondary mr-2 deleteMsgConfirm" data-msg-id="'.$row["messaggi_id"].'" data-link="'.$_SERVER['REQUEST_URI'].'" >Elimina</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo "Nessun messaggio presente";
    }
    $connessione->close();                                            


