<?php

function conectarBaseDatos() {
    $conn = new mysqli("192.168.85.162", "cliente_cafeteria", "pbbs1959", "cafeteria");

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    return $conn;
}
?>