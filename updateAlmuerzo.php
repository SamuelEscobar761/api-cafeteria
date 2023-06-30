<?php
require_once 'header_admin.php';
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos("admin_cafeteria", "admin123");

// Obtener los datos de la solicitud
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$para_llevar = $_POST["para_llevar"];
$descripcion = $_POST["descripcion"];
$precio = $_POST["precio"];
$guarniciones = $_POST["guarniciones"];
$ensaladas = $_POST["ensaladas"];
$salsas = $_POST["salsas"];

// Preparar la sentencia SQL
$sql = "UPDATE almuerzo
SET nombre = '$nombre',
para_llevar = $para_llevar,
descripcion = '$descripcion',
precio = '$precio',
guarniciones = '$guarniciones',
ensaladas = '$ensaladas',
salsas = '$salsas'
WHERE id = '$id';";
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