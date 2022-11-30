<?php
/* resetto eventuali session ancora aperte */
session_start();
if (!empty($_SESSION["CF"])){
    unset($_SESSION["CF"]);
    unset($_SESSION["Nome"]);
    unset($_SESSION["Cognome"]);
    unset($_SESSION["Email"]);
}

header("location: https://www.nuovoportale.proximalab.it/user/logout");
die();