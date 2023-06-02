<?php
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos();

// Obtener los datos de la solicitud
$id_almuerzo = $_POST["id_almuerzo"];
// $id_almuerzo = 1;


$sql = "SELECT * FROM guarnicion RIGHT JOIN almuerzo_guarnicion ON guarnicion.id = almuerzo_guarnicion.id_guarnicion where almuerzo_guarnicion.id_almuerzo = '$id_almuerzo'  AND almuerzo_guarnicion.disponible = 1";
$result = $conn->query($sql);

$guarniciones = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $guarnicion = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"],
        );
        $guarniciones[] = $guarnicion;
    }
    echo json_encode($guarniciones);
} else {
    // El cliente no fue encontrado
    echo json_encode([]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>