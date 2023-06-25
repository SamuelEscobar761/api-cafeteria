<?php
require_once 'header_admin.php';
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos("admin_cafeteria", "admin123");

// Obtener los datos de la solicitud
$id = $_POST["id"];

// Preparar la sentencia SQL
$sql = "UPDATE reserva
SET entregado = NOT entregado
WHERE id_reserva = '$id';
";

$result = $conn->query($sql);

echo "Reserva modificada correctamente";

// Cerrar la conexión a la base de datos
$conn->close();
?>
