<?php
require_once 'header_admin.php';
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos("admin_cafeteria", "admin123");

$sql = "SELECT * FROM guarnicion";
$result = $conn->query($sql);

$guarniciones = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $guarnicion = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"],
            "cantidad" => $row["cantidad"],
            "unidad_medida" => $row["unidad_medida"],
            "disponible" => $row["disponible"],
        );
        $guarniciones[] = $guarnicion;
    }
    echo json_encode($guarniciones);
} else {
    echo json_encode([]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>