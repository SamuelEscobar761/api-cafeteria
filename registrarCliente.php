<?php
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos();

// Obtener los datos de la solicitud
$nombre = $_POST["nombre"];
$codigo = $_POST["codigo"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$passwd = $_POST["passwd"];

// Revisar si el numero de telefono esta vacio
if($telefono == ''){
    $telefono = 'NULL';
}

// Preparar la sentencia SQL
$sql = "INSERT INTO cliente (nombre, codigo, correo, telefono, contrasena) VALUES ('$nombre', $codigo, '$correo', $telefono, '$passwd')";

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