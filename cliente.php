<?php
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos();

// Obtener los datos de la solicitud
$codigo = $_POST["codigo"];
$correo = $_POST["correo"];
$passwd = $_POST["passwd"];
// $codigo = "56825";
// $correo = "samueb8@gmail.com";
// $passwd = "pbbs1959";


// Consultar el cliente en la base de datos
$sql = "SELECT * FROM cliente WHERE codigo = $codigo AND contrasena = '$passwd' AND correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // El cliente fue encontrado, retornar los datos
    $row = $result->fetch_assoc();
    $cliente = array(
        "codigo" => $row["codigo"],
        "nombre" => $row["nombre"],
        "email" => $row["correo"],
        "telefono" => $row["telefono"],
    );
    
    // Retornar los datos en formato JSON
    echo json_encode($cliente);
} else {
    // El cliente no fue encontrado
    echo json_encode([]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>