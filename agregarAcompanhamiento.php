<?php
require_once 'header_admin.php';
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos("admin_cafeteria", "admin123");

// Obtener los datos de la solicitud
$nombre = $_POST["nombre"];
$tabla = $_POST["tabla"];

// Preparar la sentencia SQL
$sql = "INSERT INTO $tabla(nombre) VALUES ('$nombre')";
echo $sql;

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Datos insertados correctamente";
} else {
    echo $sql;
    echo "Error al insertar datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();

?>