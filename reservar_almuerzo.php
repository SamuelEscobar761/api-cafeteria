<?php
require_once 'header_admin.php';
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos("admin_cafeteria", "admin123");

// Verificar si hay algún error en la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Datos para insertar en la tabla reserva
$codigo_cliente = $_POST['codigo_cliente'];
$id_almuerzo = $_POST['id_almuerzo'];
$guarniciones = json_decode($_POST['guarniciones'], true); // Decodificar el JSON de guarniciones
$ensaladas = json_decode($_POST['ensaladas'], true); // Decodificar el JSON de ensaladas
$salsas = json_decode($_POST['salsas'], true); // Decodificar el JSON de ensaladas
$fecha = date("Y-m-d"); // Fecha actual

// Consulta para insertar los datos en la tabla reserva
$sql = "INSERT INTO reserva (codigo_cliente, id_almuerzo, fecha)
        VALUES ('$codigo_cliente', '$id_almuerzo', '$fecha')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    // Obtener el ID del registro recién insertado
    $id_insertado = $conn->insert_id;

    // Obtener los IDs de las guarniciones utilizando los nombres proporcionados
    $ids_guarniciones = array();
    foreach ($guarniciones as $nombre_guarnicion) {
        $sql_guarnicion = "SELECT id FROM guarnicion WHERE nombre = '$nombre_guarnicion'";
        $result = $conn->query($sql_guarnicion);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_guarnicion = $row['id'];
            $ids_guarniciones[] = $id_guarnicion;
        }
    }

    // Insertar los datos en la tabla reserva_guarnicion
    foreach ($ids_guarniciones as $id_guarnicion) {
        $sql_guarnicion = "INSERT INTO reserva_guarnicion (id_reserva, id_guarnicion)
                      VALUES ('$id_insertado', '$id_guarnicion')";
        $conn->query($sql_guarnicion);
    }

    // Obtener los IDs de las ensaladas utilizando los nombres proporcionados
    $ids_ensaladas = array();
    foreach ($ensaladas as $nombre_ensalada) {
        $sql_ensalada = "SELECT id FROM ensalada WHERE nombre = '$nombre_ensalada'";
        $result = $conn->query($sql_ensalada);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_ensalada = $row['id'];
            $ids_ensaladas[] = $id_ensalada;
        }
    }

    // Insertar los datos en la tabla reserva_ensalada
    foreach ($ids_ensaladas as $id_ensalada) {
        $sql_ensalada = "INSERT INTO reserva_ensalada (id_reserva, id_ensalada)
                      VALUES ('$id_insertado', '$id_ensalada')";
        $conn->query($sql_ensalada);
    }

    // Obtener los IDs de las salsas utilizando los nombres proporcionados
    $ids_salsas = array();
    foreach ($salsas as $nombre_salsa) {
        $sql_salsa = "SELECT id FROM salsa WHERE nombre = '$nombre_salsa'";
        $result = $conn->query($sql_salsa);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $id_salsa = $row['id'];
            $ids_salsas[] = $id_salsa;
        }
    }

    // Insertar los datos en la tabla reserva_salsa
    foreach ($ids_salsas as $id_salsa) {
        $sql_salsa = "INSERT INTO reserva_salsa (id_reserva, id_salsa)
                      VALUES ('$id_insertado', '$id_salsa')";
        $conn->query($sql_salsa);
    }

    echo $id_insertado;
} else {
    echo "Error al insertar el registro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
