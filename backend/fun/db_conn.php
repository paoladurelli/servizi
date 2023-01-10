<?php

// inclusione del file config
$configDB = require 'env/config.php';

$connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass']);
/*
if(!$connessione) {
      echo "cè qualche errore nella connessione";
}else{
      echo "tutto ok";
}
*/


