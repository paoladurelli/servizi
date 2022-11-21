<?php
/* file di inclusione */
$configDB = require '../env/config.php';
$connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

$sql = "CALL view_anagrafica()";
$result = $connessione->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "nome: " . $row["nome"]. " - cognome: " . $row["cognome"]. " " . $row["codice_fiscale"]. "<br>";
    }
} else {
    echo "0 results";
}
$connessione->close();
