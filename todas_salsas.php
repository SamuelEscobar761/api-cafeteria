<?php
require_once 'header_admin.php';
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos();

$sql = "SELECT * FROM salsa";
$result = $conn->query($sql);

$salsas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $salsa = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"],
            "disponible" => $row["disponible"],
        );
        $salsas[] = $salsa;
    }
    echo json_encode($salsas);
} else {
    echo json_encode([]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>