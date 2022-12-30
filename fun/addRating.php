<?php
if(!empty($_POST["rating"]) && !empty($_POST["userCf"]) && !empty($_POST["ServizioId"]) && !empty($_POST["PraticaId"])) {
    $configDB = require '../env/config.php';
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
    $sql = "INSERT INTO rating (ServizioId,PraticaId,userCf,rating,negative,positive,comment) VALUES ('".$_POST["ServizioId"]."','".$_POST["PraticaId"]."','".$_POST["userCf"]."','".$_POST["rating"]."','".$_POST["negativa"]."','".$_POST["positiva"]."','".$_POST["commento"]."')";
    $result = $connessione->query($sql);

    $data['success'] = true;
}
echo json_encode($data);
