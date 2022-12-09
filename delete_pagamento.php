<?php
include './fun/utility.php';
$configDB = require './env/config.php';
$configData = require './env/config_servizi.php';
session_start();

/* salvo tutti i dati nel DB nella tabella domanda_contributo con status 0 */  

$connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$sql = "DELETE FROM metodi_pagamento WHERE id = '". $_POST['del_id']."'";
$connessione->query($sql);


$sql = "SELECT * FROM metodi_pagamento WHERE cf = '". $_SESSION['CF']."'";
$result = $connessione->query($sql);
$data['newDiv'] = '';
if ($result->num_rows > 0) {
// output data of each row
    while($row = $result->fetch_assoc()) {
        $data['newDiv'] .= '<div class="row mb-3">';
            $data['newDiv'] .= '<div class="col-11"><p><label>';
                $data['newDiv'] .= '<input type="radio" id="ckb_pagamento" name="ckb_pagamento" value="'.$row['id'].'" ';
                if($row["predefinito"]=='1'){ $data['newDiv'] .= 'checked'; }
                $data['newDiv'] .= ' />&nbsp;' . NomeMetodoPagamentoByIdMain($row["tipo_pagamento"]) . ' ' . $row["numero_pagamento"];
            $data['newDiv'] .= '</label></p></div>';
            $data['newDiv'] .= '<div class="col-1">';
                $data['newDiv'] .= '<a href="#" class="delete_class" id="'.$row["id"].'" alt="cancella metodo di pagamento" title="cancella metodo di pagamento"><svg class="bg-light icon align-bottom"><use href="../lib/svg/sprites.svg#it-close-circle"></use></svg></a>';
            $data['newDiv'] .= '</div>';
        $data['newDiv'] .= '</div>';
    }
}
$connessione->close();

$data['success'] = true;

echo json_encode($data);