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

        while($row = $result->fetch_assoc()) {
            $date = date_create($row["data_attivita"]);
            if($row['StatusId'] != "0" || (NumeroPraticaById($row["ServizioId"],$row["pratica_id"]) != '')){
                echo '<div class="col-lg-6">
                    <div class="cmp-card-latest-messages mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header border-0 p-0 m-0">
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
                                    <div class="col-lg-9">
                                        <p class="title-small-semi-bold t-primary m-0 mb-1"><a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="text-decoration-none">'.$row["NomeServizio"].'</a></p>
                                    </div>
                                    <div class="col-lg-3 text-right">
                                        <img src=".\media\images\icons\status_'.$row["StatusId"].'.png" title="'.$row["NomeStatus"].'" alt="'.$row["NomeStatus"].'"/><br/>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-lg-12 after-section-small">
                                        '.CfAltroByPraticaId($row['ServizioId'],$row["pratica_id"]).
                                    '</div>
                                    <div class="col-lg-12">
                                        <div class="row">
                                            '.ViewThumbAllegatiById($row["ServizioId"],$row["pratica_id"]);
                                            if($row['StatusId'] > 1){
                                                echo DownloadPraticaById($row["ServizioId"],$row["pratica_id"]);
                                                echo DownloadRicevutaById($row["ServizioId"],$row["pratica_id"]);
                                            }else{
                                                echo '<div class="col-12 text-right">
                                                    <a class="btn-small btn-secondary mr-2 deleteLink" data-servizio-id="'.$row["ServizioId"].'" data-pratica-id="'.$row["pratica_id"].'" data-status-id="'.$row["StatusId"].'">Elimina</a>
                                                    <a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="btn-small btn-primary">Completa</a>
                                                </div>';
                                            }
                                        echo '</div>';
                                        if($row['StatusId'] > 1){
                                            echo '<div class="row">
                                                <div class="col-12 text-right">
                                                    <a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="btn-small btn-primary mt-3">Consulta</a>
                                                </div>
                                            </div>';
                                        }        
                                    echo '</div>
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
?>

    <div class="modal fade" tabindex="-1" role="dialog" id="confirmDialog" aria-labelledby="confirmDialogTitle">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5 no_toc" id="confirmDialogTitle">Elimina attività</h2>
                </div>
                <div class="modal-body">
                    <p>Cliccando su "Elimina" la tua bozza verrà cancellata definitivamente.</p>
                    <h6>Vuoi eliminare la bozza?</h6>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="confirmServizioId" id="confirmServizioId" />
                    <input type="hidden" name="confirmPraticaId" id="confirmPraticaId" />
                    <input type="hidden" name="confirmStatusId" id="confirmStatusId" />
                    <button class="btn btn-default btn-sm" type="button" data-bs-dismiss="modal">Chiudi</button>
                    <button class="btn btn-primary btn-sm deleteAttivita" type="submit">Elimina</button>
                </div>
            </div>
        </div>
    </div>