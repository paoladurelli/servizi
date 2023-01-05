<?php
    $configDB = require './env/config.php';
    include './fun/utilityDB.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

    $sql = "SELECT messaggi.id as messaggi_id, messaggi.testo, messaggi.data_msg, servizi.NomeServizio as NomeServizio FROM messaggi
            LEFT JOIN servizi ON messaggi.servizio_id = servizi.id 
            WHERE messaggi.CF_to = '".$_SESSION['CF']."'
            AND servizi.id = '".$_GET['sid']."'
            ORDER BY messaggi.data_msg DESC, messaggi.id DESC";
    /* paginazione - START*/        
        $perpage = $configDB['PER_PAGE_LIMIT'];
        $currentPage = 1;
        if (isset($_GET['pageNumber'])) {
            $currentPage = $_GET['pageNumber'];
        }
        $startPage = ($currentPage - 1) * $perpage;
        $href = "msg_servizio_list.php?sid=".$_GET['sid']."&";
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
            $date = date_create($row["data_msg"]);
            
            echo '<div class="col-lg-6">
                <div class="card shadow-sm mb-4 px-4 pt-4 pb-4">
                    <div class="card-header border-0 p-0 m-0">
                        <date class="date-xsmall">'.date_format($date,"d/m/Y").'</date>
                    </div>
                    <div class="card-body p-0 my-2">
                        <h3 class="title-small-semi-bold t-primary m-0 mb-1">'.$row["NomeServizio"].'</h3>
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
    
        
        echo '<nav aria-label="pagination">
            <ul class="pagination float-end" id="previous-next">'.$perpage.'</ul>
        </nav>';
    } else {
        echo "<div class='col-12'>Nessun messaggio presente</div>";
    }
    $connessione->close();
