<?php

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
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "INSERT INTO `metodi_pagamento`(`cf`, `tipo_pagamento`, `numero_pagamento`, `predefinito`) VALUES ('".$_SESSION['CF']."','".$_POST['sel_tipo_pagamento']."','".$_POST['txt_numero_pagamento']."','".$_POST['ck_pagamento_predefinito']."')";
    $result = $connessione->query($sql);
    if($result){
        $data['success'] = true;
        $data['message'] = 'Success!';
    }else{
        $data['success'] = false;
        $data['errors'] = 'Dati non salvati. Riprova più tardi.';
    }
    $connessione.close();
}

echo json_encode($data);