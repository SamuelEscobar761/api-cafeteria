<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: Content-Type");
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos();

$sql = "SELECT * FROM almuerzo";
$result = $conn->query($sql);

$almuerzos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $almuerzo = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"],
            "disponible" => $row["disponible"],
            "para_llevar" => $row["para_llevar"],
            "descripcion" => $row["descripcion"],
            "precio" => $row["precio"],
            "imagen" => $row["imagen"],
            "guarniciones" => $row["guarniciones"],
            "ensaladas" => $row["ensaladas"],
            "salsas" => $row["salsas"],
        );
        $almuerzos[] = $almuerzo;
    }
    echo json_encode($almuerzos);
} else {
    echo json_encode([]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>