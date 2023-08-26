<?php

require '../../../vendor/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;


// $printer = new Printer(new FilePrintConnector("php://stdout"));
$connector = new FilePrintConnector("php://stdout");
$printer = new Printer($connector);
// echo "<br>";
// print_r($$connector);

try {
    // Carrega o conteúdo do arquivo HTML
    $htmlContent = file_get_contents('./imprimir.php');
    
    // Imprime o conteúdo na impressora
    $printer->textRaw($htmlContent);
    // print_r($printer);
    
    // Corte de papel (opcional)
    $printer->cut();
    $printer->close();
    
} catch (Exception $e) {

    echo $e->getMessage() . "\n";

}

?>