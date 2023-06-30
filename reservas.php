<?php
require_once 'header_admin.php';
require_once 'db_connection.php';

// Obtener la conexión a la base de datos
$conn = conectarBaseDatos("admin_cafeteria", "admin123");

$sql = "SELECT
r.id_reserva AS id,
r.fecha AS fecha,
c.codigo AS codigoCliente,
c.telefono AS telefonoCliente,
c.nombre AS nombreCliente,
c.correo AS correoCliente,
a.nombre AS almuerzoNombre,
r.entregado,
GROUP_CONCAT(DISTINCT gu.nombre) AS listaGuarniciones,
GROUP_CONCAT(DISTINCT en.nombre) AS listaEnsaladas,
GROUP_CONCAT(DISTINCT sa.nombre) AS listaSalsas
FROM reserva AS r
JOIN cliente AS c ON r.codigo_cliente = c.codigo
JOIN almuerzo AS a ON r.id_almuerzo = a.id
LEFT JOIN reserva_guarnicion AS rg ON r.id_reserva = rg.id_reserva
LEFT JOIN guarnicion AS gu ON rg.id_guarnicion = gu.id
LEFT JOIN reserva_ensalada AS re ON r.id_reserva = re.id_reserva
LEFT JOIN ensalada AS en ON re.id_ensalada = en.id
LEFT JOIN reserva_salsa AS rs ON r.id_reserva = rs.id_reserva
LEFT JOIN salsa AS sa ON rs.id_salsa = sa.id
GROUP BY r.id_reserva;";

$result = $conn->query($sql);

$reservas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reserva = array(
            "id" => $row["id"],
            "fecha" => $row["fecha"],
            "codigoCliente" => $row["codigoCliente"],
            "telefonoCliente" => $row["telefonoCliente"],
            "nombreCliente" => $row["nombreCliente"],
            "correoCliente" => $row["correoCliente"],
            "almuerzoNombre" => $row["almuerzoNombre"],
            "entregado" => (bool)$row["entregado"],
            "listaGuarniciones" => $row["listaGuarniciones"] !== null ? explode(",", $row["listaGuarniciones"]) : [],
            "listaEnsaladas" => $row["listaEnsaladas"] !== null ? explode(",", $row["listaEnsaladas"]) : [],
            "listaSalsas" => $row["listaSalsas"] !== null ? explode(",", $row["listaSalsas"]) : [],
        );
        $reservas[] = $reserva;
    }
    echo json_encode($reservas);
} else {
    echo json_encode([]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
