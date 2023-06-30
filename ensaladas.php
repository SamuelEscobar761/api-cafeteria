<?php
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos("cliente_cafeteria", "cliente123");

// Obtener los datos de la solicitud
$id_almuerzo = $_POST["id_almuerzo"];
// $id_almuerzo = 1;


$sql = "SELECT * FROM ensalada";
$result = $conn->query($sql);

$ensaladas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ensalada = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"],
        );
        $ensaladas[] = $ensalada;
    }
    echo json_encode($ensaladas);
} else {
    // El cliente no fue encontrado
    echo json_encode([]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>