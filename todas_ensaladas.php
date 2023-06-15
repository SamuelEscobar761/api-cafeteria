<?php
require_once 'header_admin.php';
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos();

$sql = "SELECT * FROM ensalada";
$result = $conn->query($sql);

$ensaladas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ensalada = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"],
            "cantidad" => $row["cantidad"],
            "unidad_medida" => $row["unidad_medida"],
            "disponible" => $row["disponible"],
        );
        $ensaladas[] = $ensalada;
    }
    echo json_encode($ensaladas);
} else {
    echo json_encode([]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>