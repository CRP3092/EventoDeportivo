<?php
function conn() {
    $conexion = new mysqli("localhost", "root", "", "eventos_deportivos");
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    return $conexion;
}
?>
