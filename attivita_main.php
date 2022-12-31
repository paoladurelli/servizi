<?php
    $configDB = require './env/config.php';
    include './fun/utilityDB.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

    $sql = "SELECT attivita.id as attivita_id, attivita.data_attivita, attivita.pratica_id as pratica_id, attivita.servizio_id as ServizioId, attivita.status_id as StatusId, servizi.NomeServizio as NomeServizio, status.nome as NomeStatus FROM attivita
            LEFT JOIN servizi ON attivita.servizio_id = servizi.id
            LEFT JOIN status ON attivita.status_id = status.id
            WHERE attivita.cf = '".$_SESSION['CF']."'
            ORDER BY attivita.data_attivita DESC, attivita.id DESC";
    /* paginazione - START*/        
        $perpage = $configDB['PER_PAGE_LIMIT'];
        $currentPage = 1;
        if (isset($_GET['pageNumber'])) {
            $currentPage = $_GET['pageNumber'];
        }
        $startPage = ($currentPage - 1) * $perpage;
        $href = "attivita_list.php?";
        if (! empty($_GET['type']) && $_GET['type'] == "prev-next-link") {
            $href = $href . "type=prev-next-link&";
        } else {
            $href = $href . "type=number-link&";
        }
        if ($startPage < 0) {
            $startPage = 0;
        }
        $query = $sql . " limit " . $startPage . "," . $perpage;
        
        if (! empty($result)) {
            $count = getRecordCount($sql);
            $perpage = showperpage($count, $perpage, $href);
        }
    /* paginazione - END */
    $result = $connessione->query($query);
   
    if ($result->num_rows > 0) {
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
                                    <div class="col-10">
                                        <p class="title-small-semi-bold t-primary m-0 mb-1"><a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="text-decoration-none">'.$row["NomeServizio"].'</a></p>
                                    </div>
                                    <div class="col-2 text-right">
                                        <img src=".\media\images\icons\status_'.$row["StatusId"].'.png" title="'.$row["NomeStatus"].'" alt="'.$row["NomeStatus"].'"/><br/>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-lg-12 after-section-small">
                                        '.CfAltroByPraticaId($row['ServizioId'],$row["pratica_id"]).
                                    '</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">';
                                        if($row['StatusId'] > 1){
                                            echo '<div class="row">
                                                <div class="col-12 text-right">
                                                    <a href="'.CreateLinkAttivita($row["ServizioId"],$row["pratica_id"],$row["StatusId"]).'" class="btn-small btn-primary">Consulta</a>
                                                </div>
                                            </div>';
                                        }else{
                                            echo '<div class="row">
                                                <div class="col-12 text-right">
                                                    <a class="btn-small btn-secondary mr-2 deleteLink" data-servizio-id="'.$row["ServizioId"].'" data-pratica-id="'.$row["pratica_id"].'" data-status-id="'.$row["StatusId"].'">Elimina</a>
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
    
        
        echo '<nav aria-label="pagination">
            <ul class="pagination float-end" id="previous-next">'.$perpage.'</ul>
        </nav>';
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
