<?php
include './fun/utility.php';
session_start();

$errors = [];
$data = [];

if (empty($_POST['sel_tipo_pagamento'])) {
    $errors['sel_tipo_pagamento'] = 'Tipo di pagamento richiesto.';
}
if (empty($_POST['txt_numero_pagamento'])) {
    $errors['txt_numero_pagamento'] = 'Numero richiesto.';
}else{
    if($_POST['sel_tipo_pagamento'] == "1"  && (!isValidIBAN($_POST['txt_numero_pagamento']))){
        $errors['txt_numero_pagamento'] = 'IBAN non corretto.';
    }
    if($_POST['sel_tipo_pagamento'] == "2"  && (!isValidCarta($_POST['txt_numero_pagamento']))){
        $errors['txt_numero_pagamento'] = 'Numero Carta non corretto.';
    }
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $configDB = require './env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    if(!empty($_POST['upd_id'])){
        $sql = "UPDATE metodi_pagamento SET tipo_pagamento='".$_POST['sel_tipo_pagamento']."', numero_pagamento='".$_POST['txt_numero_pagamento']."', predefinito='".$_POST['ck_pagamento_predefinito']."'  WHERE id = ".$_POST['upd_id'];
    }else{
        $sql = "INSERT INTO `metodi_pagamento`(`cf`, `tipo_pagamento`, `numero_pagamento`, `predefinito`) VALUES ('".$_SESSION['CF']."','".$_POST['sel_tipo_pagamento']."','".$_POST['txt_numero_pagamento']."',".$_POST['ck_pagamento_predefinito'].")";
    }
    $connessione->query($sql);
    $data['success'] = true;
    $data['message'] = 'Success';
}
echo json_encode($data);