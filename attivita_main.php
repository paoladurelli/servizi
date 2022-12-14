<?php
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

    $sql = "SELECT attivita.id as attivita_id, attivita.data_attivita, attivita.pratica_id as pratica_id, attivita.servizio_id as ServizioId, attivita.status_id as StatusId, servizi.NomeServizio as NomeServizio, status.nome as NomeStatus FROM attivita
            LEFT JOIN servizi ON attivita.servizio_id = servizi.id
            LEFT JOIN status ON attivita.status_id = status.id
            WHERE attivita.cf = '".$_SESSION['CF']."'
            AND attivita.status_id != 0
            ORDER BY attivita.data_attivita DESC, attivita.id DESC";
    $result = $connessione->query($sql);
   
    if ($result->num_rows > 0) {
    // output data of each row
        $i=1;

        while($row = $result->fetch_assoc()) {
            $date = date_create($row["data_attivita"]);
            if($row['StatusId'] != "0" || (NumeroPraticaById($row["ServizioId"],$row["pratica_id"]) != '')){
                echo '<div class="col-lg-6">
                    <div class="cmp-card-latest-messages mb-4">
                        <div class="card shadow-sm px-4 pt-4 pb-4">
                            <div class="card-header border-0 p-0 m-0">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <date class="date-xsmall">'.date_format($date,"d/m/Y").'</date>
                                        <p class="title-small-semi-bold t-primary m-0 mb-1"><a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="text-decoration-none">'.$row["NomeServizio"].'</a></p>
                                    </div>
                                    <div class="col-lg-3 img-responsive">
                                        <img src=".\media\images\icons\status_'.$row["StatusId"].'.png" title="'.$row["NomeStatus"].'" alt="'.$row["NomeStatus"].'"/><br/>
                                        <span class="date-xsmall">'.strtoupper($row["NomeStatus"]).'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0 my-2">
                                <div class="row">
                                    <div class="col-lg-12">
                                        '.CfAltroByPraticaId($row['ServizioId'],$row["pratica_id"]).
                                        '<p class="text-paragraph">Numero Pratica: '.NumeroPraticaById($row["ServizioId"],$row["pratica_id"]).'</p>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                '.ViewThumbAllegatiById($row["ServizioId"],$row["pratica_id"]).'
                                            </div>
                                            <div class="col-lg-3">
                                                '.DownloadRicevutaById($row["ServizioId"],$row["pratica_id"]).'
                                            </div>
                                        </div>
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