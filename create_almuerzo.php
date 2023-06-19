<?php
require_once 'header_admin.php';
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$data = json_decode(file_get_contents('php://input'), true);
$conn = conectarBaseDatos();

// Obtener los datos de la solicitud
$nombre = $data['nombre'];
$para_llevar = intval($data['paraLlevar']);
$descripcion = $data['descripcion'];
$precio = $data['precio'];
$imagen = $data['imagen'] || NULL;
$guarniciones = $data['numGuarniciones'];
$ensaladas = $data['numEnsaladas'];
$salsas = $data['numSalsas'];

// Revisar si el numero de telefono esta vacio
if($imagen == ''){
    $imagen = 'NULL';
}

// Preparar la sentencia SQL
$sql = "INSERT INTO almuerzo (nombre, para_llevar, descripcion, precio, imagen, guarniciones, ensaladas, salsas)
VALUES ('$nombre', '$para_llevar', '$descripcion', $precio, '$imagen', '$guarniciones', '$ensaladas', '$salsas')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Datos insertados correctamente";
} else {
    echo "Error al insertar datos: " . $conn->error;
}

// Cerrar la conexión
$conn->close();

?>