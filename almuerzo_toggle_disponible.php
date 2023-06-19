<?php
require_once 'header_admin.php';
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$data = json_decode(file_get_contents('php://input'), true);
$conn = conectarBaseDatos();

// Obtener los datos de la solicitud
$id = $data['id'];

// Preparar la sentencia SQL
$sql = "UPDATE almuerzo
SET disponible = CASE WHEN disponible = 1 THEN 0 ELSE 1 END
WHERE id = '$id';";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Almuerzo modificado correctamente";
} else {
    echo "Error al insertar datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();

?>