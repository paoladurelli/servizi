<?php
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    /*View_attivita_limit*/
    $sql = "SELECT attivita.id as attivita_id, attivita.data_attivita, attivita.pratica_id as pratica_id, attivita.servizio_id as ServizioId, attivita.status_id as StatusId, servizi.NomeServizio as NomeServizio, status.nome as NomeStatus FROM attivita
            LEFT JOIN servizi ON attivita.servizio_id = servizi.id
            LEFT JOIN status ON attivita.status_id = status.id
            WHERE attivita.cf = '".$_SESSION['CF']."'
            AND attivita.status_id != 0
            ORDER BY attivita.data_attivita DESC, attivita.id DESC
            LIMIT 6";
    $result = $connessione->query($sql);
   
    if ($result->num_rows > 0) {
    // output data of each row
        $i=1;
        echo '<div class="row">
            <div class="col-12">
                <div class="row">';
        while($row = $result->fetch_assoc()) {
            $date = date_create($row["data_attivita"]);
            if($row['StatusId'] != "0" || (NumeroPraticaById($row["ServizioId"],$row["pratica_id"]) != '')){
                echo '<div class="col-lg-6">
                    <div class="cmp-card-latest-messages mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header border-0 p-lg-0 m-0">
                                <div class="row mb-2">
                                    <div class="col-6">
                                        <date class="date-xsmall">'.date_format($date,"d/m/Y").'</date>
                                    </div>
                                    <div class="col-6 text-right">';
                                    if($row['StatusId'] > 1){
                                        echo '<date class="date-xsmall">Nr Pratica: <b>'.NumeroPraticaById($row["ServizioId"],$row["pratica_id"]).'</b></date>';
                                    }
                                    echo '</div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <p class="title-small-semi-bold t-primary m-0 mb-1"><a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="text-decoration-none">'.$row["NomeServizio"].'</a></p>
                                    </div>
                                    <div class="col-2 text-right">
                                        <img src=".\media\images\icons\status_'.$row["StatusId"].'.png" title="'.$row["NomeStatus"].'" alt="'.$row["NomeStatus"].'"/><br/>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-lg-1">
                                <div class="row">
                                    <div class="col-lg-12 after-section-small">
                                        '.CfAltroByPraticaId($row['ServizioId'],$row["pratica_id"]).
                                    '</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">';
                                        if($row['StatusId'] > 1){
                                            echo '<div class="row">';
                                            if(!CheckRatingByCfServiceMain($row["ServizioId"],$row["pratica_id"])){
                                                echo '<div class="col-12 text-right">
                                                    <a href="#" class="btn-small btn-vote addVote" data-servizio-id="'.$row["ServizioId"].'" data-pratica-id="'.$row["pratica_id"].'"  data-link="'.$_SERVER['REQUEST_URI'].'"><span>&#9733;</span> Valuta</a>
                                                    <a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="btn-small btn-primary">Consulta</a>
                                                </div>';
                                            }else{
                                                echo '<div class="col-6 text-left">';
                                                    echo ViewRatingStar($row["ServizioId"],$row["pratica_id"]);
                                                echo '</div>';
                                                echo '<div class="col-6 text-right">
                                                    <a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="btn-small btn-primary">Consulta</a>
                                                </div>';
                                            }
                                            echo '</div>';
                                        }else{
                                            echo '<div class="row">
                                                <div class="col-12 text-right">
                                                    <a class="btn-small btn-secondary mr-2 deleteLink" data-servizio-id="'.$row["ServizioId"].'" data-pratica-id="'.$row["pratica_id"].'" data-status-id="'.$row["StatusId"].'" data-link="'.$_SERVER['REQUEST_URI'].'" >Elimina</a>
                                                    <a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="btn-small btn-primary">Completa</a>
                                                </div>
                                            </div>';
                                        }
                                    echo '</div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-12 mt-3">
                                                <p class="text-allegati-xsmall">ALLEGATI</p>
                                                '.ViewThumbAllegatiById($row["ServizioId"],$row["pratica_id"]);
                                                if($row['StatusId'] > 1){
                                                    echo DownloadPraticaById($row["ServizioId"],$row["pratica_id"]);
                                                    echo DownloadRicevutaById($row["ServizioId"],$row["pratica_id"]);
                                                }
                                            echo '</div>
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
                echo '</div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-right mb-4">
                <a href="attivita_list.php" class="btn btn-primary mr-10">Vedi altre attività</a>
            </div>
        </div>';
    } else {
        echo "Nessuna attività presente";
    }
    $connessione->close();
