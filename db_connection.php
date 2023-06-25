<?php
function conectarBaseDatos($usuario, $contrasena) {
    $conn = new mysqli("localhost", $usuario, $contrasena, "cafeteria");

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    return $conn;
}

?>