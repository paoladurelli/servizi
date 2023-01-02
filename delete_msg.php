<?php
include './fun/utility.php';
$configDB = require './env/config.php';
$configData = require './env/config_servizi.php';
session_start();

$errors = [];
$data = [];

/* Elimina messaggio */

$connessioneMessaggio = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);
$sqlMessaggio = "DELETE FROM messaggi WHERE id = ".$_POST['MsgId'];
$connessioneMessaggio->query($sqlMessaggio);

if (($resultMessaggio = $connessioneMessaggio->query($sqlMessaggio)) !== FALSE)
{
    if($_POST['ActualUrl']!=''){
        $data['redirect'] = $_POST['ActualUrl'];
    }else{
        $data['redirect'] = './messaggi_list.php';
    }
    $data['success'] = true;
}
else
{
    $data['success'] = false;
}
echo json_encode($data);
