<?php
require_once( '.\lib\php-pdftk\vendor\autoload.php' );

use mikehaertl\pdftk\Pdf;

// Fill form with data array
$pdf = new Pdf('uploads\domanda_contributo.pdf');
$result = $pdf->fillForm([
        'cf'=>'DRLPLA80S48L400S'
    ])
    ->needAppearances()
    ->saveAs('uploads\filled.pdf');

// Always check for errors
if ($result === false) {
    echo $pdf->getError();
}



