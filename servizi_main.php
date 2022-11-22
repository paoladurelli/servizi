<?php

/* file di inclusione */
    $configDB = require 'env/config.php';
    
/* mi connetto al DB per vedere se il codice fiscale è già presente nell'anagrafica */
    $connessione = mysqli_connect($configDB['db_host'],$configDB['db_user'],$configDB['db_pass'],$configDB['db_name']);

    $sql = "SELECT * FROM servizi WHERE attivo=1";
    $result = $connessione->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="row">';
        /* Codice fiscale esistente. */
        while($row = $result->fetch_assoc()) {
            echo '<div class="col-md-6 col-lg-4 col-sm-6 mb-10">';
                echo '<div class="card h-100">';
                    echo '<div class="card-body pb-0">';
                        echo '<div class="row">';
                            echo '<div class="col-md-2">';
                                echo '<svg class="icon"><use href="./lib/svg/sprites.svg#it-settings" xlink:href="./lib/svg/sprites.svg#it-settings"></use></svg>';
                            echo '</div>';
                            echo '<div class="col-md-10" style="margin-top: 5px !important;">';
                                echo '<h4 class="card-title text_resized mb-5">';
                                    echo '<a href="' . $row["LinkServizio"] . '" class="mr-5 text_resized">' . $row["NomeServizio"] . '</a>';
                                echo '</h4>';
                                echo '<p class="descrizione_menu_block">';
                                    echo '<b>Ufficio</b>: ' . $row["NomeUfficio"] . '<br/>';
                                    echo '<b>Area</b>: ' . $row["NomeArea"] . '<br/>';
                                    echo $row["DescrizioneServizio"];
                                echo '</p>';
                                echo '<a href="' . $row["LinkServizio"] . '" class="read-more-news-list pulsante_leggi_dipiu">VAI ALLA PAGINA <svg class="icon"><use href="./lib/svg/sprite.svg#it-chevron-right" xlink:href="./lib/svg/sprite.svg#it-chevron-right"></use></svg></a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }