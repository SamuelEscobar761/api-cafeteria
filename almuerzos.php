<?php
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos();

// Obtener los datos de la solicitud
$fecha = date("Y-m-d");


$sql = "SELECT * FROM almuerzo RIGHT JOIN almuerzo_fecha ON almuerzo.id = almuerzo_fecha.id_almuerzo where almuerzo_fecha.fecha = '$fecha'  AND almuerzo.disponible = 1";
$result = $conn->query($sql);

$almuerzos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $almuerzo = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"],
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