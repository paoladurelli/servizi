<?php
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

    $sql = "CALL View_attivita('".$_SESSION['CF']."')";
    $result = $connessione->query($sql);
   
    if ($result->num_rows > 0) {
    // output data of each row
        $i=1;

        while($row = $result->fetch_assoc()) {
            $date = date_create($row["data_attivita"]);
            if($row['StatusId'] != "0" || (NumeroPraticaById($row["ServizioId"],$row["pratica_id"]) != '')){
                echo '<div class="col-lg-6">
                    <div class="cmp-card-latest-messages mb-4" id="'.$i.'">
                        <div class="card shadow-sm px-4 pt-4 pb-4 ">
                            <div class="card-header border-0 p-0 m-0">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <date class="date-xsmall">'.date_format($date,"d/m/Y").'</date>
                                        <p class="title-small-semi-bold t-primary m-0 mb-1"><a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="text-decoration-none">'.$row["NomeServizio"].'</a></p>
                                    </div>
                                    <div class="col-lg-3 img-responsive text-center">
                                        <img src=".\media\images\icons\status_'.$row["StatusId"].'.png" title="'.$row["NomeStatus"].'" alt="'.$row["NomeStatus"].'"/><br/>
                                        <span class="date-xsmall">'. strtoupper($row["NomeStatus"]) .'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0 my-2">
                                <div class="row">
                                    <div class="col-lg-12">
                                        '.CfAltroByPraticaId($row['ServizioId'],$row["pratica_id"]).'
                                        <p class="text-paragraph">Numero Pratica: '.NumeroPraticaById($row["ServizioId"],$row["pratica_id"]).'</p>
                                     </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        '.ViewThumbAllegatiById($row["ServizioId"],$row["pratica_id"]).'
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        '.DownloadRicevutaById($row["ServizioId"],$row["pratica_id"]).'
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                $i++;
            }
        }
    } else {
        echo "Nessun messaggio presente";
    }
    $connessione->close();