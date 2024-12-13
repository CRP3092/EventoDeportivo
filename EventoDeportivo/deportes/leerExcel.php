<?php
include 'procesar.php';

$ruta_csv = 'C\wamp64\www\DAW\eventoDeportivo\deportes\Prueba.csv';
$handle = fopen($ruta_csv, 'r');
$test = fgetcsv($handle, 1000, ',');
print_r($test);
while(($fila = fgetcsv($handle, 1000, ',')) !== false){
    print_r($fila);
}
echo($fila);

?>