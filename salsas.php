<?php
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos("cliente_cafeteria", "cliente123");

// Obtener los datos de la solicitud
$id_almuerzo = $_POST["id_almuerzo"];
// $id_almuerzo = 1;


$sql = "SELECT * FROM salsa";
$result = $conn->query($sql);

$salsas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $salsa = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"],
        );
        $salsas[] = $salsa;
    }
    echo json_encode($salsas);
} else {
    // El cliente no fue encontrado
    echo json_encode([]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>