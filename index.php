<?php
    require_once 'db_connection.php';

    try {
    $db = conectarBaseDatos("cliente_cafeteria", "cliente123");
    // Configura el modo de errores de PDO para mostrar excepciones
    echo "Conexion exitosa";
    } catch(PDOException $e) {
    // Manejo de errores en caso de no poder conectar a la base de datos
    echo "Error de conexión: " . $e->getMessage();
    die();
    }
?>
