<?php
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    /*View_attivita_limit*/
    $sql = "CALL View_attivita_limit('".$_SESSION['CF']."',5)";
    $result = $connessione->query($sql);
   
    if ($result->num_rows > 0) {
    // output data of each row
        $i=1;

        while($row = $result->fetch_assoc()) {
            $date = date_create($row["data_attivita"]);
            
            echo '<div class="cmp-card-latest-messages mb-3">
                <div class="card shadow-sm px-4 pt-4 pb-4">
                    <div class="card-header border-0 p-0 m-0">
                        <div class="row">
                            <div class="col-lg-10">
                                <p class="title-small-semi-bold t-primary m-0 mb-1"><a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="text-decoration-none">'.$row["NomeServizio"].'</a></p>
                            </div>
                            <div class="col-lg-2 img-responsive">
                                <img src=".\media\images\icons\status_'.$row["StatusId"].'.png" title="'.$row["NomeStatus"].'" alt="'.$row["NomeStatus"].'"/>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 my-2">
                        <div class="row">
                            <div class="col-lg-10">
                                '.CfAltroByPraticaId($row['ServizioId'],$row["pratica_id"]);
                                if($row["StatusId"] != 1){
                                    echo '<p class="text-paragraph">Numero Pratica: '.NumeroPraticaById($row["ServizioId"],$row["pratica_id"]).'</p>';
                                }
                                echo '<p class="text-paragraph">Stato: '.$row["NomeStatus"].'</p>
                                <date class="date-xsmall">'.date_format($date,"d/m/Y").'</date>
                            </div>
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