<?php
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    
    $sql = "CALL View_messaggi_limit('".$_SESSION['CF']."',5)";
    $result = $connessione->query($sql);
   
    if ($result->num_rows > 0) {
    // output data of each row
        $i=1;

        while($row = $result->fetch_assoc()) {
            $date = date_create($row["data_msg"]);
            
            echo '<div class="cmp-card-latest-messages mb-3" data-bs-toggle="modal" data-bs-target="#modal-message'.$i.'" id="'.$i.'">
                <div class="card shadow-sm px-4 pt-4 pb-4">
                    <div class="card-header border-0 p-0 m-0">
                        <date class="date-xsmall">'.date_format($date,"d/m/Y").'</date>
                    </div>
                    <div class="card-body p-0 my-2">
                        <h3 class="title-small-semi-bold t-primary m-0 mb-1"><a href="#" class="text-decoration-none">'.$row["NomeServizio"].'</a></h3>
                        <p class="text-paragraph text-truncate">'.substr($row["testo"],0,40).'...</p>
                    </div>
                </div>
            </div>';
            
            $modal_messaggi .= '<div class="modal fade it-dialog-scrollable" tabindex="-1" role="dialog" id="modal-message'.$i.'" aria-labelledby="modal-message-modal-title">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content modal-dimensions h-100">
                        <div class="cmp-modal__header modal-header pb-0">
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Chiudi finestra modale"></button>
                            <div class="cmp-modal__header mt-30 mt-lg-50">
                            <date class="date-regular w-100">'.date_format($date,"d/m/Y").'</date>
                            <h2 id="modal-message-modal-title" class="title-xxxlarge mt-2 mb-0">'.$row["NomeServizio"].'</h2>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="mb-60 mb-lg-80">
                            '.$row["testo"].'
                        </div>
                    </div>
                </div>
            </div>';
            
            $i++;   
        }
    } else {
        echo "Nessun messaggio presente";
    }
    $connessione->close();                                            


