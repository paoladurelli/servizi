<?php
include '../fun/utility.php';
session_start();

$errors = [];
$data = [];

if (empty($_POST['sel_tipo_pagamento'])) {
    $errors['sel_tipo_pagamento'] = 'Tipo di pagamento richiesto.';
}

if (empty($_POST['txt_numero_pagamento'])) {
    $errors['txt_numero_pagamento'] = 'Numero richiesto.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Success';
    
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    if($_POST['ck_pagamento_predefinito'] == 1){
        $sql = "UPDATE metodi_pagamento SET predefinito = 0 WHERE cf = '".$_SESSION['CF']."'";
        $connessione->query($sql);
    }
    $sql = "INSERT INTO `metodi_pagamento`(`cf`, `tipo_pagamento`, `numero_pagamento`, `predefinito`) VALUES ('".$_SESSION['CF']."','".$_POST['sel_tipo_pagamento']."','".$_POST['txt_numero_pagamento']."',".$_POST['ck_pagamento_predefinito'].")";
    $connessione->query($sql);

    $sql = "SELECT * FROM metodi_pagamento WHERE cf = '". $_SESSION['CF']."' ORDER BY id DESC LIMIT 1";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            $data['new_row'] = '<div class="row mb-3">';
                $data['new_row'] .= '<div class="col-12"><p><label>';
                    $data['new_row'] .= '<input type="radio" name="ckb_pagamento" value="'.$row['id'].'" ';
                    if($row["predefinito"]==1){ $data['new_row'] .= 'checked'; }
                    $data['new_row'] .= ' />&nbsp;' . NomeMetodoPagamentoById($row["tipo_pagamento"]) . ' ' . $row["numero_pagamento"];
                $data['new_row'] .= '</label></p></div>';
            $data['new_row'] .= '</div>';
        }
    }
}
echo json_encode($data);