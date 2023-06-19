<?php
// Directorio de destino
$directorio = '../uploads_qr/';

// Verificar si el directorio existe, si no, crearlo
if (!is_dir($directorio)) {
    mkdir($directorio, 0755, true);
}

// Verificar si se recibió una imagen a través de FILES
if (isset($_FILES['imagen'])) {
    // Obtener la información de la imagen desde FILES
    $imagen = $_FILES['imagen'];
    
    // Obtener el nombre y la extensión del archivo original
    $nombre_original = $imagen['name'];
    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION);
    
    // Generar un nombre único para la imagen
    $nombre_imagen = uniqid() . '.' . $extension;
    
    // Ruta completa del archivo
    $ruta_imagen = $directorio . $nombre_imagen;
    
    // Mover la imagen al directorio de destino
    move_uploaded_file($imagen['tmp_name'], $ruta_imagen);
    
    echo $ruta_imagen;
} else {
    echo 'No se ha proporcionado ninguna imagen.';
}
?>
