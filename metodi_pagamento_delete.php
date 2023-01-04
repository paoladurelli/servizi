<?php
include './fun/utility.php';
$configDB = require './env/config.php';
$configData = require './env/config_servizi.php';
session_start();

/* salvo tutti i dati nel DB nella tabella domanda_contributo con status 0 */  

$connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$sql = "DELETE FROM metodi_pagamento WHERE id = '". $_POST['del_id']."'";
$connessione->query($sql);

$data['success'] = true;

echo json_encode($data);