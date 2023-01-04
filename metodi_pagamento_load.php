<?php
include './fun/utility.php';
$configDB = require './env/config.php';
$configData = require './env/config_servizi.php';
session_start();

/* carico i dati dei metodi di pagamento */  
$connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$sql = "SELECT * FROM metodi_pagamento WHERE cf = '". $_SESSION['CF']."' and id = ".$_POST['upd_id'];
$result = $connessione->query($sql);
$data['newDiv'] = '';
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data['sel_tipo_pagamento'] = $row['tipo_pagamento'];
        $data['txt_numero_pagamento'] = $row['numero_pagamento'];
        $data['ck_pagamento_predefinito'] = $row['predefinito'];
    }
}
$connessione->close();

$data['success'] = true;

echo json_encode($data);