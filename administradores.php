<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos();

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Obtener los datos enviados por POST
$username = $_POST['username'];
$passwd = $_POST['passwd'];
// $username = "Miguel";
// $passwd = "cafeteria123";

// Consulta para verificar las credenciales del administrador
$query = "SELECT * FROM administrador WHERE username = '$username' AND passwd = '$passwd'";
$result = $conn->query($query);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Credenciales válidas
    $response = true;
} else {
    // Credenciales inválidas
    $response = false;
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);

// Cerrar la conexión
$conn->close();

?>