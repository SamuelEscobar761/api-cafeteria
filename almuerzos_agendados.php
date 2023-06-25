<?php
require_once 'header_admin.php';
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos("admin_cafeteria", "admin123");
// Obtener los datos de la solicitud
if (isset($_POST["date"])) {
    $date = $_POST["date"];
    // Resto del código
  } else {
    echo "Fecha no definida no encontramos date en post";
    // Manejo de error cuando la clave "date" no está definida
  }
  


$sql = "SELECT almuerzo.id, almuerzo.nombre FROM almuerzo RIGHT JOIN almuerzo_fecha ON almuerzo.id = almuerzo_fecha.id_almuerzo where almuerzo_fecha.fecha = '$date'  AND almuerzo.disponible = 1";
$result = $conn->query($sql);

$almuerzos = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $almuerzo = array(
            "id" => $row["id"],
            "nombre" => $row["nombre"]
        );
        $almuerzos[] = $almuerzo;
    }
    echo json_encode($almuerzos);
} else {
    echo json_encode([]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>